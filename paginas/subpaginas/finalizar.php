<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

						<form action="" method="post">
								<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="mediumModalLabel">Solicitação finalizada!</b></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											
											
											<div class="form-group row">
													<div class = "col-md-12">
														
														<p Align = "center">Seu Protocolo</p>
														
														<?php
															$SQLBusca = $conexao->query("SELECT * FROM tb_chamado WHERE id = ".$_SESSION['solicitacao']);
															$RSBusca = $SQLBusca->fetch();
														?>
														<h2 align = "center"><?php echo $RSBusca['protocolo']?></h2>
														
														<p Align = "center">Clique em finalizar para encerrar o atendimento.</p>
													</div>
													
											</div>
												
																							

												
										</div>
										<div class="modal-footer">
											
											<button type = "submit" name = "finalizar" class="btn btn-primary">Finalizar</button>
										</div>
						
								
								</div>
						</form>
					</div>
				</div>
</div>

<?php
	if(isset($_POST['finalizar'])){
		
		$_SESSION['solicitacao'] = null;
		$_SESSION['setor'] = null;
		$_SESSION['departamento'] = null;
		$_SESSION['anexo'] = null;
		$_SESSION['categoria'] = null;
		$_SESSION['chamar'] = null;
		$_SESSION['qtdProduto'] = null;
		$_SESSION['codigoProduto'] == null;
		
		echo "<meta http-equiv='refresh' content='0, url='>";
	}
?>