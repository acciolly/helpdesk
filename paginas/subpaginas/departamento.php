<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

						<form action="" method="post">
								<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="mediumModalLabel">Selecione o departamento</b></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="form-group row">
													<div class = "col-md-12">
														
														<select name = "departamento" class="au-input au-input--full">
															<?php
																$SQLBusca = $conexao->query("SELECT * FROM tb_departamento WHERE tb_setor_id = ".$_SESSION['setor']." ORDER BY nome");
																while($RSBusca = $SQLBusca->fetch()){
															
															?>
															
																		<option value = "<?php echo $RSBusca['id']?>"><?php echo $RSBusca['nome']?></option>
															
																<?php }?>
														</select>
													</div>
												</div>
												

												
										</div>
										<div class="modal-footer">
											<button type = "submit" name = "voltar" class="btn btn-primary">Voltar</button>
											<button type = "submit" name = "avancar" class="btn btn-primary">Avançar</button>
										</div>
						
								
								</div>
						</form>
					</div>
				</div>
</div>

<?php
	if(isset($_POST['avancar'])){
		$_SESSION['departamento'] = $_POST['departamento'];
		echo "<meta http-equiv='refresh' content='0, url='>";
	}
	if(isset($_POST['voltar'])){
		$_SESSION['setor'] = null;
		echo "<meta http-equiv='refresh' content='0, url='>";
	}
?>