   <?php
	if(isset($_GET['id'])){
		
		$id = base64_decode($_GET['id']);
		
		$SQLBusca = $conexao->query("SELECT * FROM tb_empresa WHERE id = $id");
		$RSBusca = $SQLBusca->fetch();
		
		$nome = $RSBusca['nome'];
		$cnpj = $RSBusca['cnpj'];
		
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
													<div class = "col-md-10">
														<label>Nome</label>
														<input class="au-input au-input--full" type="text" name="nome" placeholder="Nome" required onkeyup="maiuscula(this)" value = "<?php if(isset($nome)){echo $nome;}?>"/>
													</div>
													<div class = "col-md-2">
														<label>CNPJ</label>
														<input class="au-input au-input--full" type="text" name="cnpj" placeholder="Nome" onkeyup="maiuscula(this)" value = "<?php if(isset($cnpj)){echo $cnpj;}?>" />
													</div>
													
													
											</div>
												

												
										</div>
										<div class="modal-footer">
											<a href = "<?php echo '?p='.base64_encode('empresas');?>" class="btn btn-secondary">Cancelar</a>
											<button type = "submit" name = "gravar" class="btn btn-primary">Confirmar</button>
										</div>
								</form>
								
								</div>
								
								<?php
									if(isset($_POST['gravar'])){
										$nome = $_POST['nome'];
										$cnpj = $_POST['cnpj'];
										
										$conexao->query("UPDATE tb_empresa SET nome = '$nome', cnpj = '$cnpj' WHERE id = $id");
										echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('empresas')."'>";
									}
								?>
								