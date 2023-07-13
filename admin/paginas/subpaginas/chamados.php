<!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                       <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Chamados Registrados</h2>
                                    
																			
                                </div>
                            </div>
                        </div>'
                       <div class="row">
                            <div class="col-lg-12">
							
							<form action="" method="post" enctype="multipart/form-data">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="mediumModalLabel">Filtrar Registros</b></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
								
									<div class="form-group row">
													<div class = "col-md-4">
														<label>Categoria</label>
														<select name = "categoria" class="au-input au-input--full">
															
															<?php
																$SQL = "SELECT tb_categoria.id, tb_categoria.nome, tb_lista_categoria.tb_usuario_id FROM tb_categoria INNER JOIN tb_lista_categoria ON tb_lista_categoria.tb_categoria_id = tb_categoria.id WHERE tb_lista_categoria.tb_usuario_id = ".$_SESSION['login']." ORDER BY tb_categoria.nome";
																$SQLBusca = $conexao->query($SQL);
																
																while($RSBusca = $SQLBusca->fetch()){
																
															?>
															<option value = "<?php echo $RSBusca['id'];?>" <?php if(isset($_POST['categoria'])){if($_POST['categoria'] == $RSBusca['id']){echo "selected = 'selected'";}}?>><?php echo $RSBusca['nome'];?></option>
															
																<?php }
																
																$SQLBusca1 = $conexao->query($SQL);
																$RSBusca1 = $SQLBusca1->fetch();
																$categoria = $RSBusca1['id'];
																?>
														</select>														
														
													</div>
													
													<div class = "col-md-4">
														<label>Finalizados</label><br/>
														<select name = "finalizado" class="au-input au-input--full">
															<option value = "2" <?php if(isset($_POST['finalizado'])){if($_POST['finalizado'] == 2){echo "selected = 'selected'";}}?>>Todas</option>
															<option value = "1" <?php if(isset($_POST['finalizado'])){if($_POST['finalizado'] == 1){echo "selected = 'selected'";}}?>>SIM</option>
															<option value = "0" <?php if(isset($_POST['finalizado'])){if($_POST['finalizado'] == 0){echo "selected = 'selected'";}}?>>NÃO</option>
															
																
														</select>				 										
														
													</div>
													
													<div class = "col-md-2" align = "right">
													<br/>
														<button type = "submit" name = "filtrar" class="btn btn-primary">Filtrar</button> 
													</div>
													<div class = "col-md-2">
													<br/>
														<a href = "<?php echo '?p='.base64_encode('chamados');?>" class="btn btn-primary">Limpar Filtros</a>
													</div>
									</div>
									
									</div>
									
									</div>
									
							</form>
                                
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th colspan = "2">Data</th>
												<th>Hora</th>
												<th>Solicitante</th>
												<th>Departamento</th>
												<th>Categoria</th>												
												<th>Finalizado</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										
											<?php
											
											
											if(isset($_POST['filtrar'])){
												
												$categoria = $_POST['categoria'];
												$finalizado = $_POST['finalizado'];
												
												if($finalizado == 0){
													$SQLBusca = $conexao->query("SELECT tb_chamado.id, tb_chamado.data, tb_chamado.hora, tb_pessoa.nome AS solicitante, tb_departamento.nome AS departamento, tb_chamado.finalizado, tb_chamado.finalizado_como, tb_categoria.nome AS categoria FROM tb_chamado INNER JOIN tb_pessoa ON tb_chamado.tb_pessoa_id = tb_pessoa.id INNER JOIN tb_departamento ON tb_chamado.tb_departamento_id = tb_departamento.id INNER JOIN tb_categoria ON tb_chamado.tb_categoria_id = tb_categoria.id WHERE tb_chamado.tb_categoria_id = $categoria AND tb_chamado.finalizado = 0 ORDER BY tb_chamado.id DESC");
												}if($finalizado == 1){
													$SQLBusca = $conexao->query("SELECT tb_chamado.id, tb_chamado.data, tb_chamado.hora, tb_pessoa.nome AS solicitante, tb_departamento.nome AS departamento, tb_chamado.finalizado, tb_chamado.finalizado_como, tb_categoria.nome AS categoria FROM tb_chamado INNER JOIN tb_pessoa ON tb_chamado.tb_pessoa_id = tb_pessoa.id INNER JOIN tb_departamento ON tb_chamado.tb_departamento_id = tb_departamento.id INNER JOIN tb_categoria ON tb_chamado.tb_categoria_id = tb_categoria.id WHERE tb_chamado.tb_categoria_id = $categoria AND tb_chamado.finalizado = 1 ORDER BY tb_chamado.id DESC");
													
												}if($finalizado == 2){
													$SQLBusca = $conexao->query("SELECT tb_chamado.id, tb_chamado.data, tb_chamado.hora, tb_pessoa.nome AS solicitante, tb_departamento.nome AS departamento, tb_chamado.finalizado, tb_chamado.finalizado_como, tb_categoria.nome AS categoria FROM tb_chamado INNER JOIN tb_pessoa ON tb_chamado.tb_pessoa_id = tb_pessoa.id INNER JOIN tb_departamento ON tb_chamado.tb_departamento_id = tb_departamento.id INNER JOIN tb_categoria ON tb_chamado.tb_categoria_id = tb_categoria.id WHERE tb_chamado.tb_categoria_id = $categoria ORDER BY tb_chamado.id DESC");
												}
												
												while($RSBusca = $SQLBusca->fetch()){
													if($RSBusca['finalizado'] == 1){$ch_finalizado = "SIM (".$RSBusca['finalizado_como'].")";}else{$ch_finalizado = "NÃO";}											
													echo "<tr>
															  <td width = '10%'><a href='?p=".base64_encode('verchamado')."&id=".base64_encode($RSBusca['id'])."' title = 'Visualizar Chamado'><i class = 'fa fa-eye'></i></a></td>
															  <td>".date('d/m/Y', strtotime($RSBusca['data']))."</td>
															  <td>".$RSBusca['hora']."</td>
															  <td>".$RSBusca['solicitante']."</td>
															  <td>".$RSBusca['departamento']."</td>
															   <td>".$RSBusca['categoria']."</td>
															  <td>".$ch_finalizado."</td>
															
															  
														  </tr>";
													
												}
												
											}else{
												try{
														$SQLBusca = $conexao->query("SELECT tb_chamado.id, tb_chamado.data, tb_chamado.hora, tb_pessoa.nome AS solicitante, tb_departamento.nome AS departamento, tb_chamado.finalizado, tb_chamado.finalizado_como, tb_categoria.nome AS categoria FROM tb_chamado INNER JOIN tb_pessoa ON tb_chamado.tb_pessoa_id = tb_pessoa.id INNER JOIN tb_departamento ON tb_chamado.tb_departamento_id = tb_departamento.id INNER JOIN tb_categoria ON tb_chamado.tb_categoria_id = tb_categoria.id WHERE tb_categoria.id = $categoria ORDER BY tb_chamado.id DESC");
														while($RSBusca = $SQLBusca->fetch()){
															if($RSBusca['finalizado'] == 1){$ch_finalizado = "SIM (".$RSBusca['finalizado_como'].")";}else{$ch_finalizado = "NÃO";}											
															echo "<tr>
																	  <td width = '10%'><a href='?p=".base64_encode('verchamado')."&id=".base64_encode($RSBusca['id'])."' title = 'Visualizar Chamado'><i class = 'fa fa-eye'></i></a></td>
																	  <td>".date('d/m/Y', strtotime($RSBusca['data']))."</td>
																	  <td>".$RSBusca['hora']."</td>
																	  <td>".$RSBusca['solicitante']."</td>
																	  <td>".$RSBusca['departamento']."</td>
																	   <td>".$RSBusca['categoria']."</td>
																	  <td>".$ch_finalizado."</td>
																	
																	  
																  </tr>";
															
														}
												}catch(PDOException $e){
													echo "<script>alert('Seu usuário atualmente não tem categoria de chamado vinculada a ele...')</script>";
													echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('dash')."'>";
												}
												
											}
											
											?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
						
						
						
						
						
                        
                       