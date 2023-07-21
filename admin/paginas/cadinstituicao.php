<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Register</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
	
	<script type="text/javascript">
	
	function Limpar(valor, validos) {
// retira caracteres invalidos da string
var result = "";
var aux;
for (var i=0; i < valor.length; i++) {
aux = validos.indexOf(valor.substring(i, i+1));
if (aux>=0) {
result += aux;
}
}
return result;
}

//Formata número tipo moeda usando o evento onKeyDown

function Formata(campo,tammax,teclapres,decimal) {
var tecla = teclapres.keyCode;
vr = Limpar(campo.value,"0123456789");
tam = vr.length;
dec=decimal

if (tam < tammax && tecla != 8){ tam = vr.length + 1 ; }

if (tecla == 8 )
{ tam = tam - 1 ; }

if ( tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105 )
{

if ( tam <= dec )
{ campo.value = vr ; }

if ( (tam > dec) && (tam <= 5) ){
campo.value = vr.substr( 0, tam - 2 ) + "," + vr.substr( tam - dec, tam ) ; }
if ( (tam >= 6) && (tam <= 8) ){
campo.value = vr.substr( 0, tam - 5 ) + "." + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - dec, tam ) ; 
}
if ( (tam >= 9) && (tam <= 11) ){
campo.value = vr.substr( 0, tam - 8 ) + "." + vr.substr( tam - 8, 3 ) + "." + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - dec, tam ) ; }
if ( (tam >= 12) && (tam <= 14) ){
campo.value = vr.substr( 0, tam - 11 ) + "." + vr.substr( tam - 11, 3 ) + "." + vr.substr( tam - 8, 3 ) + "." + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - dec, tam ) ; }
if ( (tam >= 15) && (tam <= 17) ){
campo.value = vr.substr( 0, tam - 14 ) + "." + vr.substr( tam - 14, 3 ) + "." + vr.substr( tam - 11, 3 ) + "." + vr.substr( tam - 8, 3 ) + "." + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - 2, tam ) ;}
} 

}
	
function mascaraData(val) {
  var pass = val.value;
  var expr = /[0123456789]/;

  for (i = 0; i < pass.length; i++) {
    // charAt -> retorna o caractere posicionado no índice especificado
    var lchar = val.value.charAt(i);
    var nchar = val.value.charAt(i + 1);

    if (i == 0) {
      // search -> retorna um valor inteiro, indicando a posição do inicio da primeira
      // ocorrência de expReg dentro de instStr. Se nenhuma ocorrencia for encontrada o método retornara -1
      // instStr.search(expReg);
      if ((lchar.search(expr) != 0) || (lchar > 3)) {
        val.value = "";
      }

    } else if (i == 1) {

      if (lchar.search(expr) != 0) {
        // substring(indice1,indice2)
        // indice1, indice2 -> será usado para delimitar a string
        var tst1 = val.value.substring(0, (i));
        val.value = tst1;
        continue;
      }

      if ((nchar != '/') && (nchar != '')) {
        var tst1 = val.value.substring(0, (i) + 1);

        if (nchar.search(expr) != 0)
          var tst2 = val.value.substring(i + 2, pass.length);
        else
          var tst2 = val.value.substring(i + 1, pass.length);

        val.value = tst1 + '/' + tst2;
      }

    } else if (i == 4) {

      if (lchar.search(expr) != 0) {
        var tst1 = val.value.substring(0, (i));
        val.value = tst1;
        continue;
      }

      if ((nchar != '/') && (nchar != '')) {
        var tst1 = val.value.substring(0, (i) + 1);

        if (nchar.search(expr) != 0)
          var tst2 = val.value.substring(i + 2, pass.length);
        else
          var tst2 = val.value.substring(i + 1, pass.length);

        val.value = tst1 + '/' + tst2;
      }
    }

    if (i >= 6) {
      if (lchar.search(expr) != 0) {
        var tst1 = val.value.substring(0, (i));
        val.value = tst1;
      }
    }
  }

  if (pass.length > 10)
    val.value = val.value.substring(0, 10);
  return true;
}

// INICIO FUNÇÃO DE MASCARA MAIUSCULA
function maiuscula(z){
        v = z.value.toUpperCase();
        z.value = v;
    }
//FIM DA FUNÇÃO MASCARA MAIUSCULA
</script>

<script language="JavaScript">
 /*
 A função Mascara tera como valores no argumento os dados inseridos no input (ou no evento onkeypress)
 onkeypress="mascara(this, '## ####-####')"
 onkeypress = chama uma função quando uma tecla é pressionada, no exemplo acima, chama a função mascara e define os valores do argumento na função
 O primeiro valor é o this, é o Apontador/Indicador da Mascara, o '## ####-####' é o modelo / formato da mascara
 no exemplo acima o # indica os números, e o - (hifen) o caracter que será inserido entre os números, ou seja, no exemplo acima o telefone ficara assim: 11-4000-3562
 para o celular de são paulo o modelo deverá ser assim: '## #####-####' [11 98563-1254]
 para o RG '##.###.###.# [40.123.456.7]
 para o CPF '###.###.###.##' [789.456.123.10]
 Ou seja esta mascara tem como objetivo inserir o hifen ou espaço automáticamente quando o usuário inserir o número do celular, cpf, rg, etc 

 lembrando que o hifen ou qualquer outro caracter é contado tambem, como: 11-4561-6543 temos 10 números e 2 hifens, por isso o valor de maxlength será 12
 <input type="text" name="telefone" onkeypress="mascara(this, '## ####-####')" maxlength="12">
 neste código não é possivel inserir () ou [], apenas . (ponto), - (hifén) ou espaço
 */

 function mascara(t, mask){
 var i = t.value.length;
 var saida = mask.substring(1,0);
 var texto = mask.substring(i)
 if (texto.substring(0,1) != saida){
 t.value += texto.substring(0,1);
 }
 }
 </script>

</head>

<body class="" style = "background-color: #E5E5E5;">
    <div class="">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                
								<p>Cadastro da instituição</p>
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
									<div class = "col-md-12">
										<label>Razão Social</label>
										<input class="au-input au-input--full" type="text" name="razao_social" placeholder="Razão Social" />
									</div>
									
                                </div>
								<div class="form-group row">
									<div class = "col-md-6">
										<label>CNPJ (apenas números)</label>
										<input class="au-input au-input--full" type="text" name="cnpj" placeholder="CNPJ" required />
								    </div>
									<div class = "col-md-6">
										<label>Telefone</label>
										<input class="au-input au-input--full" type="text" name="fone" />
								    </div>
									
                                </div>
								
								<div class="form-group row">
									<div class = "col-md-12">
										<label>Email</label>
										<input class="au-input au-input--full" type="text" name="email" placeholder="email"/>
									</div>
									<div class = "col-md-9">
										<label>Endereço</label>
										<input class="au-input au-input--full" type="text" name="endereco" onkeyup="maiuscula(this)"/>
									</div>
									<div class = "col-md-3">
										<label>Nº</label>
										<input class="au-input au-input--full" type="text" name="numero" required />
									</div>
                                </div>
								
								<div class="form-group row">
									<div class = "col-md-12">
										<label>Bairro</label>
										<input class="au-input au-input--full" type="text" name="bairro" onkeyup="maiuscula(this)"/>
									</div>
									<div class = "col-md-8">
										<label>Cidade</label>
										<input class="au-input au-input--full" type="text" name="cidade" onkeyup="maiuscula(this)"/>
									</div>
									<div class = "col-md-4">
										<label>UF</label>
										<select name="uf" class = "form-control">
											<option value="AC">Acre</option>
											<option value="AL">Alagoas</option>
											<option value="AP">Amapá</option>
											<option value="AM">Amazonas</option>
											<option value="BA">Bahia</option>
											<option value="CE">Ceará</option>
											<option value="DF">Distrito Federal</option>
											<option value="ES">Espírito Santo</option>
											<option value="GO">Goiás</option>
											<option value="MA">Maranhão</option>
											<option value="MT">Mato Grosso</option>
											<option value="MS">Mato Grosso do Sul</option>
											<option value="MG">Minas Gerais</option>
											<option value="PA">Pará</option>
											<option value="PB">Paraíba</option>
											<option value="PR">Paraná</option>
											<option value="PE">Pernambuco</option>
											<option value="PI">Piauí</option>
											<option value="RJ">Rio de Janeiro</option>
											<option value="RN">Rio Grande do Norte</option>
											<option value="RS">Rio Grande do Sul</option>
											<option value="RO">Rondônia</option>
											<option value="RR">Roraima</option>
											<option value="SC">Santa Catarina</option>
											<option value="SP">São Paulo</option>
											<option value="SE">Sergipe</option>
											<option value="TO">Tocantins</option>
										</select>
									</div>
                                </div>
								
								<div class="form-group row">
									<div class = "col-md-12">
										<label>Como deseja chamar o(s) setor(es)?</label>
										<input class="au-input au-input--full" type="text" name="lb_setor"/>
									</div>
									<div class = "col-md-12">
										<label>Como deseja chamar o(s) departamento(s)?</label>
										<input class="au-input au-input--full" type="text" name="lb_departamento"/>
									</div>
									<div class = "col-md-12">
										<label>Logo</label>
										<input class="au-input au-input--full" type="file" name="arquivo" />
									</div>
									
                                </div>
                                
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name = "salvar">Salvar</button>
                               
                            </form>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

								<?php
									if(isset($_POST['salvar'])){
										
										if(isset($_FILES['arquivo']['name']) && $_FILES["arquivo"]["error"] == 0)
										{

											$arquivo_tmp = $_FILES['arquivo']['tmp_name'];
											$nome = $_FILES['arquivo']['name'];
											

											// Pega a extensao
											$extensao = strrchr($nome, '.');

											// Converte a extensao para mimusculo
											$extensao = strtolower($extensao);

											// Somente imagens, .jpg;.jpeg;.gif;.png
											// Aqui eu enfilero as extesões permitidas e separo por ';'
											// Isso server apenas para eu poder pesquisar dentro desta String
											if(strstr('.jpg;.jpeg;.gif;.png;.pdf;.doc;.docx', $extensao))
											{
												// Cria um nome único para esta imagem
												// Evita que duplique as imagens no servidor.
												$novoNome = md5(microtime()) . $extensao;
												
												// Concatena a pasta com o nome
												$destino = '../uploads/'.$novoNome; 
															
												// tenta mover o arquivo para o destino
												if( @move_uploaded_file( $arquivo_tmp, $destino  ))
												{
													$arquivo = "uploads/".$novoNome;
													$razao_social = $_POST['razao_social'];
													
													$cnpj = $_POST['cnpj'];
													$fone = $_POST['fone'];
													$email = $_POST['email'];
													$endereco = $_POST['endereco'];
													$numero = $_POST['numero'];
													$bairro = $_POST['bairro'];
													$cidade = $_POST['cidade'];
													$uf = $_POST['uf'];
													$lb_setor = $_POST['lb_setor'];
													$lb_departamento = $_POST['lb_departamento'];
													
													$conexao->query("INSERT INTO tb_instituicao(razao_social,cnpj,fone,email,endereco,numero,bairro,cidade,uf,logo,lb_setor,lb_departamento) VALUES('$razao_social','$cnpj','$fone','$email','$endereco','$numero','$bairro','$cidade','$uf','$arquivo','$lb_setor','$lb_departamento')");
													
													echo "<meta http-equiv='refresh' content='0, url='>";
												}
												else
													echo "Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";
											}
											else
												echo "Você poderá enviar apenas arquivos \"*.jpg;*.jpeg;*.gif;*.png\"<br />";
										}
										else
										{
											echo "Você não enviou nenhum arquivo!";
										}
																			
									}
								?>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->