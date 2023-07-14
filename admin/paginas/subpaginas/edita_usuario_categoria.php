  <?php
	if(isset($_GET['id'])){
		
		$id = base64_decode($_GET['id']);
		
		$SQLBusca = $conexao->query("SELECT * FROM tb_lista_categoria WHERE id = $id");
		$RSBusca = $SQLBusca->fetch();
		
		$usuario = $RSBusca['tb_usuario_id'];
		$categoria = $RSBusca['tb_categoria_id'];
		
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
														<label>Usuário:</label>
														<select name = "usuario" class="au-input au-input--full">
															<?php
																$SQLBusca = $conexao->query("SELECT * FROM tb_usuario ORDER BY nome");
																while($RSBusca = $SQLBusca->fetch()){
															
															?>
															
																		<option value = "<?php echo $RSBusca['id']?>" <?php if(isset($usuario)){if($usuario == $RSBusca['id']){echo "selected = 'selected'";}}?>><?php echo $RSBusca['nome']?></option>
															
																<?php }?>
														</select>
													</div>
													
													<div class = "col-md-12">
														<label>Categoria:</label>
														<select name = "categoria" class="au-input au-input--full">
															<?php
																$SQLBusca = $conexao->query("SELECT * FROM tb_categoria ORDER BY nome");
																while($RSBusca = $SQLBusca->fetch()){
															
															?>
															
																		<option value = "<?php echo $RSBusca['id']?>" <?php if(isset($categoria)){if($categoria == $RSBusca['id']){echo "selected = 'selected'";}}?>><?php echo $RSBusca['nome']?></option>
															
																<?php }?>
														</select>
													</div>
												</div>
												

												
										</div>
										<div class="modal-footer">
											<a href = "<?php echo '?p='.base64_encode('usuario_categoria');?>" class="btn btn-secondary">Cancelar</a>
											<button type = "submit" name = "gravar" class="btn btn-primary">Confirmar</button>
										</div>
								</form>
								
								</div>
								
								<?php
									if(isset($_POST['gravar'])){
										$usuario = $_POST['usuario'];
										$categoria = $_POST['categoria'];
									
										$conexao->query("UPDATE tb_lista_categoria SET tb_usuario_id = '$usuario', tb_categoria_id = '$categoria' WHERE id = $id");
										echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('usuario_categoria')."'>";
									}
								?>
								