<?php
	if(isset($_GET['id'])){
		
		$id = base64_decode($_GET['id']);
		
		$SQLBusca = $conexao->query("SELECT * FROM tb_categoria WHERE id = $id");
		$RSBusca = $SQLBusca->fetch();
		
		$categoria = $RSBusca['nome'];
		
	}

?>

 <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

						<form action="" method="post" enctype="multipart/form-data">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="mediumModalLabel">Editar item</b></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="form-group row">
													<div class = "col-md-12">
														<label>Descrição</label>
														<input class="au-input au-input--full" type="text" value = "<?php if(isset($categoria)){echo $categoria;} ?>" name="descricao" placeholder="Descrição" required onkeyup="maiuscula(this)" />
													</div>
											</div>
											
											<div class="form-group row">
													<div class = "col-md-12">
														<label>Ícone</label>
														<input name="arquivo" id = "arquivo" type="file" />
														
													</div>
													
											</div>
											
											<div class="form-group row">
													<div class = "col-md-12">
														<label>Chamados via Whatsapp</label>
														<select name = "whats" class="au-input au-input--full">
															<option value = "1" <?php if(isset($RSBusca['whats'])){if($RSBusca['whats'] == 1){echo "selected = 'selected'";}}?>>SIM</option>
															<option value = "0" <?php if(isset($RSBusca['whats'])){if($RSBusca['whats'] == 0){echo "selected = 'selected'";}}?>>NÃO</option>
														</select>														
														
													</div>
													<div class = "col-md-12">
														<label>Chamados via Web</label>
														<select name = "web" class="au-input au-input--full">
															<option value = "1" <?php if(isset($RSBusca['web'])){if($RSBusca['web'] == 1){echo "selected = 'selected'";}}?>>SIM</option>
															<option value = "0" <?php if(isset($RSBusca['web'])){if($RSBusca['web'] == 0){echo "selected = 'selected'";}}?>>NÃO</option>
														</select>														
														
													</div>
													<div class = "col-md-12">
														<label>Mandar texto com anexo</label>
														<select name = "texto" class="au-input au-input--full">
															<option value = "1" <?php if(isset($RSBusca['texto'])){if($RSBusca['texto'] == 1){echo "selected = 'selected'";}}?>>SIM</option>
															<option value = "0" <?php if(isset($RSBusca['texto'])){if($RSBusca['texto'] == 0){echo "selected = 'selected'";}}?>>NÃO</option>
														</select>														
														
													</div>
													
													<div class = "col-md-12">
														<label>Acesso aos produtos do estoque para solicitação de material</label>
														<select name = "produtos" class="au-input au-input--full">
															<option value = "1" <?php if(isset($RSBusca['produtos'])){if($RSBusca['produtos'] == 1){echo "selected = 'selected'";}}?>>SIM</option>
															<option value = "0" <?php if(isset($RSBusca['produtos'])){if($RSBusca['produtos'] == 0){echo "selected = 'selected'";}}?>>NÃO</option>
														</select>														
														
													</div>
													
											</div>
												

												
										</div>
										<div class="modal-footer">
											<a href = "<?php echo '?p='.base64_encode('categorias');?>" class="btn btn-secondary">Cancelar</a>
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
													$descricao = $_POST['descricao'];
													$whats = $_POST['whats'];
													$web = $_POST['web'];
													$texto = $_POST['texto'];
													$produtos = $_POST['produtos'];						
													$conexao->query("UPDATE tb_categoria SET nome = '$descricao', icone = '$arquivo', whats = '$whats', web = '$web', texto = '$texto', produtos = '$produtos' WHERE id = $id");
													echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('categorias')."'>";
												}
												else
													echo "Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";
											}
											else
												echo "Você poderá enviar apenas arquivos \"*.jpg;*.jpeg;*.gif;*.png\"<br />";
										}
										else
										{
													$descricao = $_POST['descricao'];
											        $whats = $_POST['whats'];
													$web = $_POST['web'];
													$texto = $_POST['texto'];
													$produtos = $_POST['produtos'];						
													$conexao->query("UPDATE tb_categoria SET nome = '$descricao', whats = '$whats', web = '$web', texto = '$texto', produtos = '$produtos' WHERE id = $id");
													echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('categorias')."'>";
										}
																			
									}
								?>
								
								