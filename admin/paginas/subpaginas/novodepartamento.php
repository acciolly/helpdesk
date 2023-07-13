 <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

						<form action="" method="post">
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
														<label>Nome</label>
														<input class="au-input au-input--full" type="text" name="nome" placeholder="Nome" required onkeyup="maiuscula(this)" />
													</div>
													<div class = "col-md-10">
														<label>Endereço:</label>
														<input class="au-input au-input--full" type="text" name="endereco" placeholder="Endereço" required onkeyup="maiuscula(this)" />
														
													</div>
													<div class = "col-md-2">
														<label>Numero:</label>
														<input class="au-input au-input--full" type="text" name="numero" placeholder="Número" required onkeyup="maiuscula(this)" />
														
													</div>
													<div class = "col-md-6">
														<label>Bairro:</label>
														<input class="au-input au-input--full" type="text" name="bairro" placeholder="Bairro" required onkeyup="maiuscula(this)" />
														
													</div>
													
													<div class = "col-md-6">
														<label>Cidade:</label>
														<input class="au-input au-input--full" type="text" name="cidade" placeholder="Cidade" required onkeyup="maiuscula(this)" />
														
													</div>
													
													<div class = "col-md-4">
														<label>Fone:</label>
														<input class="au-input au-input--full" type="text" name="fone" placeholder="Fone" required  onkeyup="maiuscula(this)" />
														
													</div>
													
													<div class = "col-md-12">
														<label>Setor:</label>
														<select name = "setor" class="au-input au-input--full">
															<?php
																$SQLBusca = $conexao->query("SELECT * FROM tb_setor ORDER BY nome");
																while($RSBusca = $SQLBusca->fetch()){
															
															?>
															
																		<option value = "<?php echo $RSBusca['id']?>"><?php echo $RSBusca['nome']?></option>
															
																<?php }?>
														</select>
													</div>
													
												</div>
												

												
										</div>
										<div class="modal-footer">
											<a href = "<?php echo '?p='.base64_encode('departamentos');?>" class="btn btn-primary">Cancelar</a>
											<button type = "submit" name = "gravar" class="btn btn-primary">Confirmar</button>
										</div>
								</form>
								
								</div>
								
								<?php
									if(isset($_POST['gravar'])){
										$nome = $_POST['nome'];
										$endereco = $_POST['endereco'];
										$numero = $_POST['numero'];
										$bairro = $_POST['bairro'];
										$cidade = $_POST['cidade'];
										$fone = $_POST['fone'];
										$setor = $_POST['setor'];
										$conexao->query("INSERT INTO tb_departamento (nome,endereco,numero,bairro,cidade,fone,tb_setor_id) VALUES('$nome','$endereco','$numero','$bairro','$cidade','$fone','$setor')");
										echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('departamentos')."'>";
									}
								?>
								