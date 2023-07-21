<?php
	$SQLBusca = $conexao->query("SELECT * FROM tb_instituicao ORDER BY id DESC LIMIT 1");
	$RSBusca = $SQLBusca->fetch();
?>

<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                
                   
                      
                            <form action="" method="post" enctype="multipart/form-data">
								<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="mediumModalLabel">Novo item</b></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
                                <div class="form-group row">
									<div class = "col-md-12">
										<label>Razão Social</label>
										<input class="au-input au-input--full" type="text" name="razao_social" value = "<?php echo $RSBusca['razao_social'];?>" required />
									</div>
									
                                </div>
								<div class="form-group row">
									<div class = "col-md-6">
										<label>CNPJ (apenas números)</label>
										<input class="au-input au-input--full" type="text" name="cnpj" value = "<?php echo $RSBusca['cnpj'];?>" required />
								    </div>
									<div class = "col-md-6">
										<label>Telefone</label>
										<input class="au-input au-input--full" type="text" name="fone" value = "<?php echo $RSBusca['fone'];?>" />
								    </div>
									
                                </div>
								
								<div class="form-group row">
									<div class = "col-md-12">
										<label>Email</label>
										<input class="au-input au-input--full" type="text" name="email" placeholder="email" value = "<?php echo $RSBusca['email'];?>"/>
									</div>
									<div class = "col-md-9">
										<label>Endereço</label>
										<input class="au-input au-input--full" type="text" name="endereco" onkeyup="maiuscula(this)" value = "<?php echo $RSBusca['endereco'];?>"/>
									</div>
									<div class = "col-md-3">
										<label>Nº</label>
										<input class="au-input au-input--full" type="text" name="numero" required value = "<?php echo $RSBusca['numero'];?>"/>
									</div>
                                </div>
								
								<div class="form-group row">
									<div class = "col-md-12">
										<label>Bairro</label>
										<input class="au-input au-input--full" type="text" name="bairro" onkeyup="maiuscula(this)" value = "<?php echo $RSBusca['bairro'];?>"/>
									</div>
									<div class = "col-md-8">
										<label>Cidade</label>
										<input class="au-input au-input--full" type="text" name="cidade" onkeyup="maiuscula(this)" value = "<?php echo $RSBusca['cidade'];?>"/>
									</div>
									<div class = "col-md-4">
										<label>UF</label>
										<select name="uf" class = "form-control">
											<option value="AC" <?php if($RSBusca['uf'] == "AC"){echo "selected = 'selected'";}?>>Acre</option>
											<option value="AL" <?php if($RSBusca['uf'] == "AL"){echo "selected = 'selected'";}?>>Alagoas</option>
											<option value="AP" <?php if($RSBusca['uf'] == "AP"){echo "selected = 'selected'";}?>>Amapá</option>
											<option value="AM" <?php if($RSBusca['uf'] == "AM"){echo "selected = 'selected'";}?>>Amazonas</option>
											<option value="BA" <?php if($RSBusca['uf'] == "BA"){echo "selected = 'selected'";}?>>Bahia</option>
											<option value="CE" <?php if($RSBusca['uf'] == "CE"){echo "selected = 'selected'";}?>>Ceará</option>
											<option value="DF" <?php if($RSBusca['uf'] == "DF"){echo "selected = 'selected'";}?>>Distrito Federal</option>
											<option value="ES" <?php if($RSBusca['uf'] == "ES"){echo "selected = 'selected'";}?>>Espírito Santo</option>
											<option value="GO" <?php if($RSBusca['uf'] == "GO"){echo "selected = 'selected'";}?>>Goiás</option>
											<option value="MA" <?php if($RSBusca['uf'] == "MA"){echo "selected = 'selected'";}?>>Maranhão</option>
											<option value="MT" <?php if($RSBusca['uf'] == "MT"){echo "selected = 'selected'";}?>>Mato Grosso</option>
											<option value="MS" <?php if($RSBusca['uf'] == "MS"){echo "selected = 'selected'";}?>>Mato Grosso do Sul</option>
											<option value="MG" <?php if($RSBusca['uf'] == "MG"){echo "selected = 'selected'";}?>>Minas Gerais</option>
											<option value="PA" <?php if($RSBusca['uf'] == "PA"){echo "selected = 'selected'";}?>>Pará</option>
											<option value="PB" <?php if($RSBusca['uf'] == "PB"){echo "selected = 'selected'";}?>>Paraíba</option>
											<option value="PR" <?php if($RSBusca['uf'] == "PR"){echo "selected = 'selected'";}?>>Paraná</option>
											<option value="PE" <?php if($RSBusca['uf'] == "PE"){echo "selected = 'selected'";}?>>Pernambuco</option>
											<option value="PI" <?php if($RSBusca['uf'] == "PI"){echo "selected = 'selected'";}?>>Piauí</option>
											<option value="RJ" <?php if($RSBusca['uf'] == "RJ"){echo "selected = 'selected'";}?>>Rio de Janeiro</option>
											<option value="RN" <?php if($RSBusca['uf'] == "RN"){echo "selected = 'selected'";}?>>Rio Grande do Norte</option>
											<option value="RS" <?php if($RSBusca['uf'] == "RS"){echo "selected = 'selected'";}?>>Rio Grande do Sul</option>
											<option value="RO" <?php if($RSBusca['uf'] == "RO"){echo "selected = 'selected'";}?>>Rondônia</option>
											<option value="RR" <?php if($RSBusca['uf'] == "RR"){echo "selected = 'selected'";}?>>Roraima</option>
											<option value="SC" <?php if($RSBusca['uf'] == "SC"){echo "selected = 'selected'";}?>>Santa Catarina</option>
											<option value="SP" <?php if($RSBusca['uf'] == "SP"){echo "selected = 'selected'";}?>>São Paulo</option>
											<option value="SE" <?php if($RSBusca['uf'] == "SE"){echo "selected = 'selected'";}?>>Sergipe</option>
											<option value="TO" <?php if($RSBusca['uf'] == "TO"){echo "selected = 'selected'";}?>>Tocantins</option>
										</select>
									</div>
                                </div>
								
								<div class="form-group row">
									<div class = "col-md-12">
										<label>Como deseja chamar o(s) setor(es)?</label>
										<input class="au-input au-input--full" type="text" name="lb_setor" value = "<?php echo $RSBusca['lb_setor'];?>"/>
									</div>
									<div class = "col-md-12">
										<label>Como deseja chamar o(s) departamento(s)?</label>
										<input class="au-input au-input--full" type="text" name="lb_departamento" value = "<?php echo $RSBusca['lb_departamento'];?>"/>
									</div>
									<div class = "col-md-12">
										<label>Logo Atual</label>
										<img src = "../<?php echo $RSBusca['logo'];?>" width = '100'/>
										
									</div>
									<div class = "col-md-4">
										
										<input class="au-input au-input--full" type="file" name="arquivo" />
										
									</div>
									<div class = "col-md-4">
										 <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name = "salvar_logo">Salvar Logo</button>
										
									</div>
									
                                </div>
                                
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name = "salvar">Salvar Informações</button>
                               </div>
							  </div>
                            </form>
                           
                  
                
            
			
			<?php
								if(isset($_POST['salvar'])){
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
									
									$conexao->query("SELECT * FROM tb_instituicao SET razao_social = '$razao_social', cnpj = '$cnpj', fone = '$fone', email = '$email', endereco = '$endereco',numero = '$numero', bairro = '$bairro', cidade = '$cidade', uf = '$uf', lb_setor = '$lb_setor', lb_departamento = '$lb_departamento' WHERE id = ".$RSBusca['id']);
									echo "<script>alert('Instituição atualizada com sucesso!')</scrit>";
									
									
									
								}
									if(isset($_POST['salvar_logo'])){
										
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
																										
													$conexao->query("UPDATE tb_instituicao SET logo = '".$arquivo."' WHERE id = ".$RSBusca['id']);
													
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