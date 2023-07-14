var msgInicial = "Este é um canal exclusivo para abertura de chamados da Prefeitura de Campo Novo do Parecis.";

var _host = "";
var _bd = "";
var _uid = "";
var _pass = "";

const fs = require('fs')
try {
  const data = fs.readFileSync('../funcoes/parametro.txt', 'utf8')
  const array = data.split(";");
  
  _host = array[0];
  _bd = array[1];
  _uid = array[2];
  _pass = array[3];

} catch (err) {
  console.error(err)
}

//hash de MD5
const crypto = require('crypto')

//biblioteca mysql
const mysql = require('mysql2');

//chamando o gerador do qrcode
const qrcode = require('qrcode-terminal');

//chamando a lib do chatbot
const { Client, LocalAuth } = require('whatsapp-web.js');


//conecta ao banco
const connection = mysql.createConnection(
    {
        host: _host,
        user: _uid,
        password: _pass,
        database: _bd
    }
);

connection.connect(function (err){
    if(!err){
        console.log('Conectado ao MySQL.');
    }else{
        console.log('Erro ao conectar na base de dados: '+err.message);
        process.exit();
    }
});

//guarda o whats na variavel client
const client = new Client({
    authStrategy: new LocalAuth()
});

//gera o qr code para acessar o whats
client.on('qr', qr => {
    qrcode.generate(qr, {small: true});
});

//verifica se o whats está conectado
client.on('ready', () => {
    console.log('Whats Conectado!');
});


client.initialize();


var solicitacao = "";

client.on('message', async(message) => {
    
    const contato = await message.getContact();
    const numero = contato.id.user;

    const num = numero.substring(2,4)+"9"+numero.substring(4,12);
    
    //VAI BUSCAR O REGISTRO NA TABELA TB_PESSOA PELO NUMERO DE TELEFONE
    connection.query("SELECT * FROM tb_pessoa WHERE fone LIKE '"+num+"'", function(err, rows){
        //CASO NÃO HAJA ERRO NA CONSULTA
        if(!err){
            //SE A CONSULTA RETORNAR LINHAS
            if(rows.length > 0){
                
                //JOGA AS INFORMAÇÕES DO BANCO NAS VARIAVEIS
                var pessoa = rows[0].id;
                var pessoaNome = rows[0].nome;
                
                //BUSCA O REGISTRO NA TABELA BOT_CHAMADO
                connection.query("SELECT * FROM tb_botchamado WHERE pessoa = "+pessoa+" ORDER BY id DESC LIMIT 1", async function(err, rowsChamado){
                    //SE NÃO HOUVER ERRO NA CONSULTA
                    if(!err){
                        //SE A CONSULTA RETORNAR LINHAS
                        if(rowsChamado.length > 0){
                            //JOGA AS INFORMAÇÕES RECUPERADAS NAS VARIAVEIS                            
                            var parametro = rowsChamado[0].parametro;
                            var valor = rowsChamado[0].valor;

                            //SE VARIAVEL PARAMETRO É INICIA_CONVERSA
                            if(parametro === "INICIA_CONVERSA"){
                                //SE MENSAGEM ENVIADA DE WHATS PELO USUARIO É 1
                                if(message.body === "1"){
                                    //GRAVA NA TABELA TB_BOTCHAMADO VALORES
                                    connection.query("INSERT INTO tb_botchamado(pessoa,parametro,valor) VALUES('"+pessoa+"','INICIA_CHAMADO','1')", function(err){
                                        //SE NÃO HOUVER ERRO
                                        if(!err){
                                            //BUSCA NO BANCO QUANTOS SETORES EXISTEM CADASTRADOS.. SE HOUVER MAIS DO QUE 1 SOLICITA PRO USUARIO SELECIONAR
                                            connection.query("SELECT * FROM tb_setor", function(err, rowsSetor){
                                                if(!err){
                                                    if(rowsSetor.length > 1){
                                                        client.sendMessage("Me fale de qual setor está falando...");
                                                        //ENVIA PARA O USUARIO OS SETORES RECUPERADOS DA TB_SETOR
                                                        for(var i = 0; i < rowsSetor.length; i++){
                                                            client.sendMessage(message.from, rowsSetor[i].id + " - "+rowsSetor[i].nome);
                                                        }
                                                        
                                                        
                                                    }else{
                                                        
                                                        client.sendMessage(message.from, 'OK, me diz de qual departamento está falando:');
                                                        //BUSCA OS DEPARTAMENTOS CADASTRADOS NA TABELA TB_DEPARTAMENTO
                                                        connection.query("SELECT id, nome FROM tb_departamento", function(err,rowsDepartamento){
                                                        if(!err){
                                                            //ENVIA PARA O USUARIO OS DEPARTAMENTOS RECUPERADOS DA TB_DEPARTAMENTO
                                                            for(var i = 0; i < rowsDepartamento.length; i++){
                                                                client.sendMessage(message.from, rowsDepartamento[i].id + " - "+rowsDepartamento[i].nome);
                                                            }
                                                        
                                                        
                                                        }
                                                    });
                                                    }
                                                }
                                            });


                                            
                                        }
                                    });
                                    //SE INFORMA 2 = CONSULTAR CHAMADO
                                }else if(message.body === "2"){
                                    connection.query("INSERT INTO tb_botchamado(pessoa,parametro,valor) VALUES('"+pessoa+"','CONSULTA_CHAMADO','1')", function(err){
                                        client.sendMessage(message.from, 'Informe o número do protocolo que deseja consultar:');
                                    });
                                }else{
                                    //CASO USUARIO INFORME OUTRO NUMERO QUE NÃO SEJA 1 OU 2
                                    client.sendMessage(message.from, 'Opção não disponível. Informe 1 ou 2');
                                }
                            }

                            
                            else if(parametro === "CONSULTA_CHAMADO"){
                                var protocolo = message.body;
                                connection.query("SELECT tb_chamado.id, tb_pessoa.nome, tb_chamado.descricao, tb_chamado.data, tb_chamado.hora FROM tb_chamado INNER JOIN tb_pessoa ON tb_chamado.tb_pessoa_id = tb_pessoa.id WHERE protocolo LIKE '"+protocolo+"'", function(err, rowsConsulta){
                                    if(!err){
                                        if(rowsConsulta.length > 0){
                                            client.sendMessage(message.from,"Essas são as informações do seu protocolo:")
                                            client.sendMessage(message.from, rowsConsulta[0].data + " as " + rowsConsulta[0].hora + " - "+ rowsConsulta[0].nome + " escreveu:");
                                            client.sendMessage(message.from, rowsConsulta[0].descricao);
                                            connection.query("SELECT * FROM tb_resposta WHERE tb_chamado_id = "+rowsConsulta[0].id, function(err, rowsResposta){
                                                if(!err){
                                                    if(rowsResposta.length > 0){
                                                        for(var i = 0; i < rowsResposta.length; i++){
                                                            client.sendMessage(message.from, rowsResposta[i].data+" as "+rowsResposta[i].hora+" - "+rowsResposta[i].nome_pessoa+" escreveu:");
                                                            client.sendMessage(message.from, rowsResposta[i].resposta);
                                                            client.sendMessage(message.from,"Deseja acrescentar uma mensagem?\n1 = SIM\n2 = NÃO");
                                                            connection.query("INSERT INTO tb_botchamado(pessoa,parametro,valor) VALUES('"+pessoa+"','RESPONDER_CHAMADO','"+rowsConsulta[0].id+"')");
                                                        }
                                                    }else{
                                                        client.sendMessage(message.from,"Sem respostas por enquanto...");
                                                        client.sendMessage(message.from,"Deseja acrescentar uma mensagem?\n1 = SIM\n2 = NÃO");
                                                        connection.query("INSERT INTO tb_botchamado(pessoa,parametro,valor) VALUES('"+pessoa+"','RESPONDER_CHAMADO','"+rowsConsulta[0].id+"')");
                                                    }
                                                }else{
                                                    console.log(err.message);
                                                }
                                            });

                                        }else{
                                            client.sendMessage(message.from, 'Desculpe, mas não consigo localizar seu protocolo, reinicie a conversa e tente novamente...');
                                            connection.query("DELETE FROM tb_botchamado WHERE pessoa = "+pessoa);
                                        }
                                    }else{
                                        console.log("Erro: "+err.message);
                                    }
                                });
                            }

                            else if(parametro === "RESPONDER_CHAMADO"){
                                if(message.body === "1"){
                                    client.sendMessage(message.from, 'Certo... escreva em uma mensagem o que deseja acrescentar ou responder:');
                                    connection.query("INSERT INTO tb_botchamado(pessoa,parametro,valor) VALUES('"+pessoa+"','RESPONDEU','"+valor+"')");
                                    
                                }else if(message.body === "2"){
                                    client.sendMessage(message.from, 'OK, estou a disposição para qualquer coisa...');
                                    connection.query("DELETE FROM tb_botchamado WHERE pessoa = "+pessoa);
                                }
                            }

                            else if(parametro === "RESPONDEU"){
                                var resposta = message.body;
                                const hoje = new Date();
                                var data = hoje.getFullYear()+"-"+ String(hoje.getMonth() + 1).padStart(2,'0') + "-"+hoje.getDate();
                                var horaSimples = hoje.getHours()+":"+hoje.getMinutes();
                                

                                connection.query("INSERT INTO tb_resposta(nome_pessoa,resposta,data,hora,tb_chamado_id) VALUES('"+pessoaNome+"','"+resposta+"','"+data+"','"+horaSimples+"',"+valor+")", function(err){
                                    if(!err){
                                        client.sendMessage(message.from, 'Protocolo atualizado, estou a disposição para qualquer coisa...');
                                        connection.query("DELETE FROM tb_botchamado WHERE pessoa = "+pessoa);
                                    }else{
                                        console.log(err.message);
                                    }
                                });

                            }

                            else if(parametro === "INICIA_CHAMADO"){
                                connection.query("SELECT * FROM tb_setor", function(err, rowsSetor){
                                    if(!err){
                                        if(rowsSetor.length > 1){
                                            var setor = message.body;
                                            connection.query("SELECT * FROM tb_setor WHERE id = "+setor, function(err, rowsSet){
                                                if(!err){
                                                    if(rowsSet.length > 0){
                                                        connection.query("INSERT INTO tb_botchamado(pessoa,parametro,valor) VALUES('"+pessoa+"','SETOR','"+setor+"')", function(err,){
                                                            if(!err){
                                                                client.sendMessage(message.from, 'OK, me diz de qual departamento está falando:');
                                                                //BUSCA OS DEPARTAMENTOS CADASTRADOS NA TABELA TB_DEPARTAMENTO
                                                                connection.query("SELECT id, nome FROM tb_departamento WHERE tb_setor_id = "+setor, function(err,rowsDepartamento){
                                                                    if(!err){
                                                                
                                                                        for(var i = 0; i < rowsDepartamento.length; i++){
                                                                            client.sendMessage(message.from, rowsDepartamento[i].id + " - "+rowsDepartamento[i].nome);
                                                                        }
                                                                    
                                                                    
                                                                    }
                                                                });
                                                            }
                                                        });
                                                    }
                                                }else{
                                                    client.sendMessage(message.from, 'O setor informado não existe, informe o setor correto:');
                                                }
                                            });
                                           
                                        }else{
                                            var departamento = message.body;
                                            connection.query("SELECT * FROM tb_departamento WHERE id = "+departamento, function(err, rowsDep){
                                                if(!err){
                                                    if(rowsDep.length > 0){
                                                        connection.query("INSERT INTO tb_botchamado(pessoa,parametro,valor) VALUES('"+pessoa+"','DEPARTAMENTO','"+departamento+"')", function(err){
                                                            if(!err){
                                                                client.sendMessage(message.from, 'Ótimo! para qual serviço deseja abrir um chamado?');
                                                                connection.query("SELECT id, nome FROM tb_categoria WHERE whats = 1", function(err,rowsCategoria){
                                                                    if(!err){
                                                                        
                                                                        for(var i = 0; i < rowsCategoria.length; i++){
                                                                            client.sendMessage(message.from, rowsCategoria[i].id + " - "+rowsCategoria[i].nome);
                                                                        }
                                                                            
                                                                            
                                                                    }
                                                                });
                                                            }
                                                        });
                                                    }else{
                                                        client.sendMessage(message.from, 'O departamento informado não existe, informe o departamento correto:');
                                                    }
                                                }
                                            });

                                        }
                                    }
                                });
                                
                                
                            }
                            else if(parametro === "SETOR"){
                                var departamento = message.body;
                                connection.query("SELECT * FROM tb_departamento WHERE id = "+departamento, function(err, rowsDep){
                                    if(!err){
                                        if(rowsDep.length > 0){
                                            connection.query("INSERT INTO tb_botchamado(pessoa,parametro,valor) VALUES('"+pessoa+"','DEPARTAMENTO','"+departamento+"')", function(err){
                                                if(!err){
                                                    client.sendMessage(message.from, 'Ótimo! para qual serviço deseja abrir um chamado?');
                                                    connection.query("SELECT id, nome FROM tb_categoria WHERE whats = 1", function(err,rowsCategoria){
                                                        if(!err){
                                                            
                                                            for(var i = 0; i < rowsCategoria.length; i++){
                                                                client.sendMessage(message.from, rowsCategoria[i].id + " - "+rowsCategoria[i].nome);
                                                            }
                                                                
                                                                
                                                        }
                                                    });
                                                }
                                            });
                                        }else{
                                            client.sendMessage(message.from, 'O departamento informado não existe, informe o departamento correto:');
                                        }
                                    }
                                });
                            }
                            else if(parametro === "DEPARTAMENTO"){
                                var categoria = message.body;
                                connection.query("SELECT * FROM tb_categoria WHERE id = "+categoria, function(err, rowsCat){
                                    if(!err){
                                        if(rowsCat.length > 0){
                                            connection.query("INSERT INTO tb_botchamado(pessoa,parametro,valor) VALUES('"+pessoa+"','CATEGORIA','"+categoria+"')", function(err){
                                                if(!err){
                                                    client.sendMessage(message.from, 'Agora, escreva a sua solicitação para este chamado. Para finalizar mande uma mensagem apenas com a palavra "FIM"');
                                                    
                                                }
                                            });
                                        }else{
                                            client.sendMessage(message.from, 'A categoria informada não existe, informe a categoria correta:');
                                        }
                                    }
                                })
                                
                            }
                            else if(parametro === "CATEGORIA"){
                                if(message.body === "FIM" || message.body === "fim" || message.body == "Fim"){
                                      
                                      connection.query("INSERT INTO tb_botchamado(pessoa,parametro,valor) VALUES('"+pessoa+"','SOLICITACAO','"+solicitacao+"')", function(err){
                                          if(!err){
                                            client.sendMessage(message.from, 'Deseja anexar alguma imagem a esta solicitação?\n1 = SIM\n2 = NÃO');
                                            solicitacao = "";

                                          }
                                      });
  
                                  }else{
                                      solicitacao = solicitacao+"\n"+message.body;
                                  }
  
                                  
                            }else if(parametro === "SOLICITACAO"){
                                if(message.body === "1"){
                                    client.sendMessage(message.from, 'Envie quantas imagens necessitar. E ao final mande uma mensagem apenas com a palavra "FIM"');

                                    connection.query("INSERT INTO tb_botchamado(pessoa,parametro,valor) VALUES('"+pessoa+"','ANEXAR','0')");



                                }else if(message.body === "2"){
                                    client.sendMessage(message.from, 'Gravando chamado...');
                                              
                                              connection.query("SELECT * FROM tb_botchamado WHERE pessoa = '"+pessoa+"'", function(err, rowsDados){
                                                  if(!err){
  
                                                      var recDepartamento = "";
                                                      var recCategoria = "";
                                                      var recSolicitacao = "";
  
                                                      for(var i = 0; i < rowsDados.length; i++){
                                                          if(rowsDados[i].parametro === "DEPARTAMENTO"){
                                                              recDepartamento = rowsDados[i].valor;
                                                          }
                                                          else if(rowsDados[i].parametro === "CATEGORIA"){
                                                              recCategoria = rowsDados[i].valor;
                                                          }
                                                          else if(rowsDados[i].parametro === "SOLICITACAO"){
                                                              recSolicitacao = rowsDados[i].valor;
                                                          }
                                                      }
  
                                                                                                  
  
                                                      const hoje = new Date();
                                                      var data = hoje.getFullYear()+"-"+ String(hoje.getMonth() + 1).padStart(2,'0') + "-"+hoje.getDate();
                                                      var horaSimples = hoje.getHours()+":"+hoje.getMinutes();
                                                      var horaCompleta = hoje.getHours()+":"+hoje.getMinutes()+":"+hoje.getSeconds();
  
                                                      var protocolo = data.replace("-","").replace("-","")+horaCompleta.replace(":","").replace(":","")+recDepartamento+pessoa;
                                                      
                                                      
                                                      connection.query("INSERT INTO tb_chamado(data,hora,descricao,tb_categoria_id,tb_departamento_id,tb_pessoa_id,protocolo) VALUES('"+data+"','"+horaSimples+"','"+recSolicitacao+"','"+recCategoria+"','"+recDepartamento+"','"+pessoa+"','"+protocolo+"')", function(err){
                                                          if(!err){
                                                              connection.query("DELETE FROM tb_botchamado WHERE pessoa = "+pessoa, function(err){
                                                                  if(!err){
                                                                      client.sendMessage(message.from, 'Chamado finalizado! Seu protocolo:');
                                                                      client.sendMessage(message.from, protocolo);
                                                                  }else{
                                                                      console.log('Erro ao deletar'+err.message)
                                                                  }
                                                              });
                                                          }else{
                                                              console.log('Erro ao realizar operação: gravar chamado: '+err.message);
                                                          }
                                                      });
  
                                                  }
                                              });
                                }
                            }else if(parametro === "ANEXAR"){
                                if(message.hasMedia){
                                    const midia = await message.downloadMedia();
                                    if(midia.mimetype === "image/jpeg"){                                  
                                        connection.query("INSERT INTO tb_botchamado(pessoa,parametro,valor) VALUES('"+pessoa+"','ANEXAR','"+midia.data+"')");
                                    }else{
                                        client.sendMessage(message.from, 'Tipo de arquivo não suportado. Envie apenas imagem no formato jpeg');
                                    }
                                }else if(message.body === "FIM" || message.body === "Fim" || message.body === "fim"){
                                    client.sendMessage(message.from, 'Gravando chamado...');
                                              
                                              connection.query("SELECT * FROM tb_botchamado WHERE pessoa = '"+pessoa+"'", function(err, rowsDados){
                                                  if(!err){
  
                                                      var recDepartamento = "";
                                                      var recCategoria = "";
                                                      var recSolicitacao = "";
  
                                                      for(var i = 0; i < rowsDados.length; i++){
                                                          if(rowsDados[i].parametro === "DEPARTAMENTO"){
                                                              recDepartamento = rowsDados[i].valor;
                                                          }
                                                          else if(rowsDados[i].parametro === "CATEGORIA"){
                                                              recCategoria = rowsDados[i].valor;
                                                          }
                                                          else if(rowsDados[i].parametro === "SOLICITACAO"){
                                                              recSolicitacao = rowsDados[i].valor;
                                                          }
                                                      }
  
                                                                                                  
  
                                                      const hoje = new Date();
                                                      var data = hoje.getFullYear()+"-"+ String(hoje.getMonth() + 1).padStart(2,'0') + "-"+hoje.getDate();
                                                      var horaSimples = hoje.getHours()+":"+hoje.getMinutes();
                                                      var horaCompleta = hoje.getHours()+":"+hoje.getMinutes()+":"+hoje.getSeconds();
  
                                                      var protocolo = data.replace("-","").replace("-","")+horaCompleta.replace(":","").replace(":","")+recDepartamento+pessoa;
                                                      
                                                      
                                                      connection.query("INSERT INTO tb_chamado(data,hora,descricao,tb_categoria_id,tb_departamento_id,tb_pessoa_id,protocolo) VALUES('"+data+"','"+horaSimples+"','"+recSolicitacao+"','"+recCategoria+"','"+recDepartamento+"','"+pessoa+"','"+protocolo+"')", function(err){
                                                          if(!err){
                                                            connection.query("SELECT * FROM tb_chamado WHERE tb_pessoa_id = "+pessoa+" ORDER BY id DESC LIMIT 1", function(err, rowsCham){
                                                                if(!err){
                                                                    connection.query("SELECT * FROM tb_botchamado WHERE pessoa = "+pessoa+" AND parametro LIKE 'ANEXAR'", function(err, rowsAnexo){
                                                                        if(!err){
                                                                            for(var i = 0; i < rowsAnexo.length; i++){
                                                                                if(rowsAnexo[i].valor !== "0"){
                                                                                    connection.query("INSERT INTO tb_anexo(anexo, descricao, tb_chamado_id) VALUES('"+rowsAnexo[i].valor+"','MÍDIA DO WHATS',"+rowsCham[0].id+")");
                                                                                }
                                                                            }

                                                                            connection.query("DELETE FROM tb_botchamado WHERE pessoa = "+pessoa, function(err){
                                                                                if(!err){
                                                                                    client.sendMessage(message.from, 'Chamado finalizado! Seu protocolo:');
                                                                                    client.sendMessage(message.from, protocolo);
                                                                                }else{
                                                                                    console.log('Erro ao deletar'+err.message)
                                                                                }
                                                                            });



                                                                        }
                                                                    });
                                                                }
                                                            });



                                                              
                                                        }else{
                                                           console.log('Erro ao realizar operação: gravar chamado: '+err.message);
                                                        }
                                                      });
  
                                                  }
                                              });
                                }
                            }
                           

                           

                        }else{
                            connection.query("INSERT INTO tb_botchamado(pessoa,parametro,valor) VALUES('"+pessoa+"','INICIA_CONVERSA','1')", function(err){
                                if(!err){
                                    client.sendMessage(message.from, 'Oi '+rows[0].nome+' Em que posso ajudar?\n1 - Para Novo chamado\n2 - Para Consultar chamado');
                                }
                            });
                        }
                    }else{
                        console.log('Erro ao realizar operação: Pesquisa tb_botchamado');
                    }
                });
               
            }else{
                //caso não localizou o numero no cadastro da pessoa então...
                connection.query("SELECT * FROM tb_botcadastro WHERE fone LIKE '"+num+"' ORDER BY id DESC LIMIT 1", function(err, rows){
                    if(!err){
                        if(rows.length > 0){
                            
                            var parametro = rows[0].parametro;
                            
                            if(parametro === "INICIA_CADASTRO"){
                                var nome = message.body.toUpperCase();
                                connection.query("INSERT INTO tb_botcadastro(fone,parametro,valor) VALUES('"+num+"','NOME_PESSOA','"+nome+"')", function(err){
                                    if(!err){
                                        client.sendMessage(message.from, 'Oi '+nome+', informe seu CPF (apenas números):');
                                    }else{
                                        console.log('Erro ao realizar operação');
                                    }
                                });
                            }
                            
                            else if(parametro === "NOME_PESSOA"){
                                var cpf = message.body.replace(".","").replace(".","").replace("-","");
                                connection.query("INSERT INTO tb_botcadastro(fone,parametro,valor) VALUES('"+num+"','CPF_PESSOA','"+cpf+"')", function(err){
                                    if(!err){
                                        client.sendMessage(message.from, 'Agora crie uma senha para acesso ao nosso portal:');
                                    }else{
                                        console.log('Erro ao realizar operação');
                                    }
                                });
                            }
                            else if(parametro === "CPF_PESSOA"){
                                var senha = crypto.createHash('md5').update(message.body).digest("hex");
                                connection.query("INSERT INTO tb_botcadastro(fone,parametro,valor) VALUES('"+num+"','SENHA_PESSOA','"+senha+"')", function(err){
                                    if(!err){
                                        client.sendMessage(message.from, 'Realizando cadastro...');

                                        //recuperar todos os dados
                                        connection.query("SELECT * FROM tb_botcadastro WHERE fone LIKE '"+num+"'", function(err, rows){
                                            if(!err){
                                                var numeroPessoa = "";
                                                var nomePessoa = "";
                                                var cpfPessoa = "";
                                                var senhaPessoa = "";

                                                for(var i = 0; i < rows.length; i++){
                                                    if(rows[i].parametro === "INICIA_CADASTRO"){
                                                        numeroPessoa = rows[i].fone;
                                                    }
                                                    else if(rows[i].parametro === "NOME_PESSOA"){
                                                        nomePessoa = rows[i].valor;
                                                    }
                                                    else if(rows[i].parametro === "CPF_PESSOA"){
                                                        cpfPessoa = rows[i].valor;
                                                    }
                                                    else if(rows[i].parametro === "SENHA_PESSOA"){
                                                        senhaPessoa = rows[i].valor;
                                                    }
                                                }

                                                connection.query("INSERT INTO tb_pessoa(nome,fone,cpf,senha) VALUES('"+nomePessoa+"','"+numeroPessoa+"','"+cpfPessoa+"','"+senhaPessoa+"')", function(err){
                                                    if(!err){
                                                        client.sendMessage(message.from, 'Cadastro Efetuado...');
                                                        client.sendMessage(message.from, 'Diga oi novamente para reiniciar a conversa...');
                                                    }else{
                                                        console.log('Erro ao realizar operação: gravar na tb_pessoa');
                                                    }
                                                });


                                            }else{
                                                console.log('Erro ao realizar operação: Recuperar dados para gravar na tb_pessoa');
                                            }
                                        });



                                    }else{
                                        console.log('Erro ao realizar operação');
                                    }
                                });
                            }




                        }else{
                            connection.query("INSERT INTO tb_botcadastro(fone,parametro,valor) VALUES('"+num+"','INICIA_CADASTRO','1')", function(err){
                                if(!err){
                                    client.sendMessage(message.from, 'Olá!');
                                    client.sendMessage(message.from, msgInicial);
                                    client.sendMessage(message.from, 'Não consigo localizar seu cadastro. Ele é necessário para que suas solicitações sejam protocoladas.');
                                    client.sendMessage(message.from, 'Então neste primeiro acesso vou solicitar algumas informações:');
                                    client.sendMessage(message.from, 'Primeiro, informe seu nome completo:');
                                }else{
                                    console.log('Erro ao realizar operação');
                                }
                            });
                        }
                    }else{
                        console.log('Erro ao realizar pesquisa em table bot');
                    }
                });

            }
        }else{
            console.log('Erro ao realizar pesquisa');
        }
    });
});