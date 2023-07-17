 <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

						<form action="" method="post" enctype="multipart/form-data">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="mediumModalLabel">Nova Entrada</b></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="form-group row">
													<div class = "col-md-2">
														<label>Data</label>
														<input class="au-input au-input--full" type="text" name="data" required onkeyup="mascara(this,'##/##/####')" value = "<?php echo date('d/m/Y');?>" />
													</div>
													
											</div>
											<div class="form-group row">
																	
													<div class = "col-md-4">
														<label>Departamento</label>
														<select class="form-control" name = "departamento">
															<option value = "">Não informar...</option>
															<?php
																$SQLBusca = $conexao->query("SELECT * FROM tb_departamento ORDER BY nome");
																while($RSBusca = $SQLBusca->fetch()){
																	?>
																	
																	<option value = "<?php echo $RSBusca['id'];?>"><?php echo $RSBusca['nome'];?></option>
																	
																	<?php
															
																	
																}
															?>
														</select>
													</div>
													
													<div class = "col-md-2">
														<label>Documento</label>
														<input class="au-input au-input--full" type="text" name="documento" required />
													</div>
													
													
											</div>
											
																						

												
										</div>
										<div class="modal-footer">
											<a href = "<?php echo '?p='.base64_encode('saidas');?>" class="btn btn-primary">Cancelar</a>
											<button type = "submit" name = "gravar" class="btn btn-primary">Próximo</button>
										</div>
								</form>
								
								</div>
								
								
								<?php
									if(isset($_POST['gravar'])){
										
										$data = explode('/',$_POST['data']);
										$departamento = $_POST['departamento'];
										$documento = $_POST['documento'];
																			
										$conexao->query("INSERT INTO tb_saida (data,documento,tb_departamento_id) VALUES('".$data[2]."-".$data[1]."-".$data[0]."','$documento','$departamento')");
										
										$SQLBusca = $conexao->query("SELECT id FROM tb_saida ORDER BY id DESC LIMIT 1");
										
										$RSBusca = $SQLBusca->fetch();
										
										$idSaida = $RSBusca['id'];
										
										echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('produtosaida')."&id=".base64_encode($idSaida)."'>";
																			
									}
								?>
								
								