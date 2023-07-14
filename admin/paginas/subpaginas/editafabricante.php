   <?php
	if(isset($_GET['id'])){
		
		$id = base64_decode($_GET['id']);
		
		$SQLBusca = $conexao->query("SELECT * FROM tb_fabricante WHERE id = $id");
		$RSBusca = $SQLBusca->fetch();
		
		$nome = $RSBusca['nome'];
		
		
	}

?>
 
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
														<input class="au-input au-input--full" type="text" name="nome" placeholder="Nome" required onkeyup="maiuscula(this)" value = "<?php if(isset($id)){echo $nome;}?>"/>
													</div>
													
													
											</div>
												

												
										</div>
										<div class="modal-footer">
											<a href = "<?php echo '?p='.base64_encode('fabricantes');?>" class="btn btn-secondary">Cancelar</a>
											<button type = "submit" name = "gravar" class="btn btn-primary">Confirmar</button>
										</div>
								</form>
								
								</div>
								
								<?php
									if(isset($_POST['gravar'])){
										$nome = $_POST['nome'];
										
										$conexao->query("UPDATE tb_fabricante SET nome = '$nome' WHERE id = $id");
										echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('fabricantes')."'>";
									}
								?>
								