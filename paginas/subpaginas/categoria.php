<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

						<form action="" method="post">
								<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="mediumModalLabel">Selecione a categoria do chamado</b></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="form-group row">
													
														
														
															<?php
																$SQLBusca = $conexao->query("SELECT * FROM tb_categoria ORDER BY nome");
																while($RSBusca = $SQLBusca->fetch()){
															
															?>
																	<div class = "col-md-3">
																		<button name = "avancar" type = "submit" align = "center" value = "<?php echo $RSBusca['id'];?>"><img src = "<?php echo $RSBusca['icone'];?>" class = "img-thumbnail" />
																		<?php echo $RSBusca['nome'];?></button>
																	</div>																		
																<?php }?>
														
													
												</div>
												

												
										</div>
										<div class="modal-footer">
											<button type = "submit" name = "voltar" class="btn btn-primary">Voltar</button>
											
										</div>
						
								
								</div>
						</form>
					</div>
				</div>
</div>

<?php
	if(isset($_POST['avancar'])){
		$_SESSION['categoria'] = $_POST['avancar'];
		echo "<meta http-equiv='refresh' content='0, url='>";
	}
	
	if(isset($_POST['voltar'])){
		$_SESSION['departamento'] = null;
		echo "<meta http-equiv='refresh' content='0, url='>";
	}
?>