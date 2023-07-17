<?php
	if(isset($_GET['id'])){
		
		$id = base64_decode($_GET['id']);
		
		$SQLBusca = $conexao->query("SELECT * FROM tb_usuario WHERE id = $id");
		$RSBusca = $SQLBusca->fetch();
		
		$nome = $RSBusca['nome'];
		$cpf = $RSBusca['cpf'];
		$senha = $RSBusca['senha'];
		$admin = $RSBusca['admin'];
		$chamados = $RSBusca['chamados'];
		$estoque = $RSBusca['estoque'];
		$patrimonio = $RSBusca['patrimonio'];
		
		
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
														<input class="au-input au-input--full" type="text" name="nome" placeholder="Nome" required onkeyup="maiuscula(this)" value = "<?php if(isset($id)){echo $nome;}?>" />
													</div>
													<div class = "col-md-12">
														<label>CPF:</label>
														<input class="au-input au-input--full" type="text" name="cpf" placeholder="CPF" required value = "<?php if(isset($id)){echo $cpf;}?>" />
														
													</div>
													<div class = "col-md-6">
														<label>Alterar Senha:</label>
														<select class = "form-control" name = "altSenha">
															<option value = "0">NÃO</option>
															<option value = "1">SIM</option>
														</select>
													</div> 
													<div class = "col-md-6">
														<label>Senha:</label>
														<input class="au-input au-input--full" type="password" name="senha" placeholder="Senha"  />
														
													</div>
													
													<div class = "col-md-12">
														<label>Administrador:</label>
														<select name = "admin" class="form-control">
															<option value = '1' <?php if(isset($admin)){if($admin == 1){echo "selected='selected'";}}?>>SIM</option>
															<option value = '0' <?php if(isset($admin)){if($admin == 0){echo "selected='selected'";}}?>>NÃO</option>
														</select>
													</div>
													
													<div class = "col-md-12">
														<label>Acessa os chamados:</label>
														<select name = "chamados" class="form-control">
															<option value = '1' <?php if(isset($chamados)){if($chamados == 1){echo "selected='selected'";}}?>>SIM</option>
															<option value = '0' <?php if(isset($chamados)){if($chamados == 0){echo "selected='selected'";}}?>>NÃO</option>
														</select>
													</div>
													
													<div class = "col-md-12">
														<label>Controla o estoque:</label>
														<select name = "estoque" class="form-control">
															<option value = '1' <?php if(isset($estoque)){if($estoque == 1){echo "selected='selected'";}}?>>SIM</option>
															<option value = '0' <?php if(isset($estoque)){if($estoque == 0){echo "selected='selected'";}}?>>NÃO</option>
														</select>
													</div>
													
													<div class = "col-md-12">
														<label>Controla o patrimônio:</label>
														<select name = "patrimonio" class="form-control">
															<option value = '1' <?php if(isset($patrimonio)){if($patrimonio == 1){echo "selected='selected'";}}?>>SIM</option>
															<option value = '0' <?php if(isset($patrimonio)){if($patrimonio == 0){echo "selected='selected'";}}?>>NÃO</option>
														</select>
													</div>
												</div>
												

												
										</div>
										<div class="modal-footer">
											<a href = "<?php echo '?p='.base64_encode('usuarios');?>" class="btn btn-secondary">Cancelar</a>
											<button type = "submit" name = "gravar" class="btn btn-primary">Confirmar</button>
										</div>
								</form>
								
								</div>
								
								<?php
									if(isset($_POST['gravar'])){
										$altSenha = $_POST['altSenha'];
										$nome = $_POST['nome'];
										$cpf = $_POST['cpf'];
										$senha = md5($_POST['senha']);
										$admin = $_POST['admin'];
										$chamados = $_POST['chamados'];
										$estoque = $_POST['estoque'];
										$patrimonio = $_POST['patrimonio'];
										if($altSenha == "0"){
											$conexao->query("UPDATE tb_usuario SET nome = '$nome',cpf = '$cpf', admin = '$admin', chamados = '$chamados', estoque = '$estoque', patrimonio = '$patrimonio' WHERE id = $id");
											echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('usuarios')."'>";
										}else if($altSenha == "1"){
											$conexao->query("UPDATE tb_usuario SET nome = '$nome',cpf = '$cpf',senha = '$senha',admin = '$admin', chamados = '$chamados', estoque = '$estoque', patrimonio = '$patrimonio' WHERE id = $id");
											echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('usuarios')."'>";
										}
									}
								?>
								