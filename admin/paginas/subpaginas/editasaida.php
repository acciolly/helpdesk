 <?php
	if(isset($_GET['id'])){
		$id = base64_decode($_GET['id']);
		$SQLBusca = $conexao->query("SELECT * FROM tb_saida WHERE id = $id");
		$RSBusca = $SQLBusca->fetch();
		
		$data = date('d/m/Y', strtotime($RSBusca['data']));
		$documento = $RSBusca['documento'];
		$departamento = $RSBusca['tb_departamento_id'];
		
	}
 ?>
 
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
														<input class="au-input au-input--full" type="text" name="data" required onkeyup="mascara(this,'##/##/####')" value = "<?php if(isset($data)){echo $data;}?>" />
													</div>
													
											</div>
											<div class="form-group row">
																	
													<div class = "col-md-4">
														<label>Departamento</label>
														<select class="form-control" name = "departamento">
															<option value = "null">Não informar...</option>
															<?php
																$SQLBusca = $conexao->query("SELECT * FROM tb_departamento ORDER BY nome");
																while($RSBusca = $SQLBusca->fetch()){
																	?>
																	
																	<option value = "<?php echo $RSBusca['id'];?>" <?php if(isset($departamento)){if($departamento == $RSBusca['id']){echo "selected = 'selected'";}}?>><?php echo $RSBusca['nome'];?></option>
																	
																	<?php
															
																	
																}
															?>
														</select>
													</div>
													
													<div class = "col-md-2">
														<label>Documento</label>
														<input class="au-input au-input--full" type="text" name="documento" required value = "<?php if(isset($documento)){echo $documento;}?>"/>
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
																			
										$conexao->query("UPDATE tb_saida SET data = '".$data[2]."-".$data[1]."-".$data[0]."',documento = '$documento', tb_departamento_id = $departamento WHERE id = $id");
										
																			
										echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('produtosaida')."&id=".base64_encode($id)."'>";
																			
									}
								?>
								
								