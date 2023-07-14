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
													<div class = "col-md-8">
														<label>Nome</label>
														<input class="au-input au-input--full" type="text" name="nome" placeholder="Nome" required onkeyup="maiuscula(this)" />
													</div>
													
											</div>
											<div class="form-group row">
													<div class = "col-md-2">
														<label>Unidade Medida</label>
														<select class="form-control" name = "un_medida">
															<option value = "UN">UN - Unidade</option>
															<option value = "CX">CX - Caixa</option>
															<option value = "GL">GL - Galão</option>
															<option value = "LT">LT - Litro</option>
															<option value = "SC">SC - Saco</option>
														</select>
													</div>
													
													<div class = "col-md-2">
														<label>Quantidade Mínima</label>
														<input class="au-input au-input--full" type="text" name="qtd_minima" required />
													</div>
													
													<div class = "col-md-2">
														<label>Tipo</label>
														<select class="form-control" name = "categoria">
															<?php
																$SQLBusca = $conexao->query("SELECT * FROM tb_categoria_produto ORDER BY nome");
																while($RSBusca = $SQLBusca->fetch()){
																	?>
																	
																	<option value = "<?php echo $RSBusca['id'];?>"><?php echo $RSBusca['nome'];?></option>
																	
																	<?php
															
																	
																}
															?>
														</select>
													</div>
													
													<div class = "col-md-4">
														<label>Estoque</label>
														<select class="form-control" name = "estoque">
															<?php
																$SQLBusca = $conexao->query("SELECT * FROM tb_estoque ORDER BY nome");
																while($RSBusca = $SQLBusca->fetch()){
																	?>
																	
																	<option value = "<?php echo $RSBusca['id'];?>"><?php echo $RSBusca['nome'];?></option>
																	
																	<?php
															
																	
																}
															?>
														</select>
													</div>
											</div>
											
											<div class="form-group row">
													<div class = "col-md-8">
														<label>Imagem</label>
														<input name="arquivo" id = "arquivo" type="file" />
													</div>
													
											</div>
												

												
										</div>
										<div class="modal-footer">
											<a href = "<?php echo '?p='.base64_encode('produtos');?>" class="btn btn-primary">Cancelar</a>
											<button type = "submit" name = "gravar" class="btn btn-primary">Confirmar</button>
										</div>
								</form>
								
								</div>
								
								
								<?php
									if(isset($_POST['gravar'])){
										
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
													
													$nome = $_POST['nome'];
													$un_medida = $_POST['un_medida'];
													$categoria = $_POST['categoria'];
													$estoque = $_POST['estoque'];
													$qtd_minima = $_POST['qtd_minima'];
													
													$conexao->query("INSERT INTO tb_produto (nome, un_medida, tb_estoque_id, tb_categoria_produto_id, imagem, qtd_minima) VALUES('$nome','$un_medida','$estoque','$categoria','$arquivo',$qtd_minima)");
													echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('produtos')."'>";
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
								
								