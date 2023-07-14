<!-- modal saida_departamento -->
						<div class="modal fade" id="saida_departamento" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<form action="" method="post">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="mediumModalLabel">Parametros do relatório</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											
											<div class="form-group row">
																	
													<div class = "col-md-6">
														<label>Departamento</label>
														<select class="form-control" name = "departamento">
															
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
													
													<div class = "col-md-3">
														<label>Data Inicial</label>
														<input class="au-input au-input--full" type="text" name="inicio" required onkeyup = "mascara(this,'##/##/####')"/>
													</div>
													<div class = "col-md-3">
														<label>Data Final</label>
														<input class="au-input au-input--full" type="text" name="fim" required onkeyup = "mascara(this,'##/##/####')"/>
													</div>
													
													
											</div>
											
												
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
											<button type="submit" class="btn btn-primary" name = "confirmar">Confirmar</button>
										</div>
								</form>
								</div>
							</div>
						</div>
<!-- end modal medium -->


<?php
	if(isset($_POST['confirmar'])){
		
		$departamento = $_POST['departamento'];
		
		$dataInicio = date('Y-d-m', strtotime($_POST['inicio']));
		
		$dataFim = date('Y-d-m', strtotime($_POST['fim']));
		
		echo "<meta http-equiv='refresh' content='0, url=print/saida_departamento.php?dep=$departamento&inicio=$dataInicio&fim=$dataFim'>";
		
		
		
		
	}

?>

<!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                       <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
								
                                    <h2 class="title-1">Relatórios do Estoque</h2>
                                    
																
                                </div>
                            </div>
                        </div>'
                       <div class="row">
                            <div class="col-lg-12">
							
							<form action="" method="post" enctype="multipart/form-data">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="mediumModalLabel">Relatórios do estoque</b></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
								
									<div class="form-group row">
														<div class = "col-md-6">
														<a href = 'Print/produtos.php' target = 'new'>Produtos Cadastrados</a><br/>
														<a href = 'Print/produtos_saldo.php' target = 'new'>Lotes com saldo</a><br/>
														<a href = "#" data-toggle="modal" data-target="#saida_departamento">Saídas por departamento</a><br/>
									</div>
													
													
													
													
									</div>
									
									</div>
									<div class="modal-footer">
											
									</div>
									
									</div>
									
							</form>
                                
                                
                            </div>
                            
                        </div>
						
						
						
						
						
					
                        
                       