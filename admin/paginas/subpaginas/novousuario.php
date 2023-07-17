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
														<input class="au-input au-input--full" type="text" name="nome" placeholder="Nome" required onkeyup="maiuscula(this)" />
													</div>
													<div class = "col-md-12">
														<label>CPF:</label>
														<input class="au-input au-input--full" type="text" name="cpf" placeholder="CPF" required  />
														
													</div>
													<div class = "col-md-12">
														<label>Senha:</label>
														<input class="au-input au-input--full" type="password" name="senha" placeholder="Senha" required  />
														
													</div>
													
													<div class = "col-md-12">
														<label>Administrador:</label>
														<select name = "admin" class="au-input au-input--full">
															<option value = '1'>SIM</option>
															<option value = '0'>NÃO</option>
														</select>
													</div>
													
													<div class = "col-md-12">
														<label>Acessa os chamados:</label>
														<select name = "chamados" class="au-input au-input--full">
															<option value = '1'>SIM</option>
															<option value = '0'>NÃO</option>
														</select>
													</div>
													
													<div class = "col-md-12">
														<label>Controla o estoque:</label>
														<select name = "estoque" class="au-input au-input--full">
															<option value = '1'>SIM</option>
															<option value = '0'>NÃO</option>
														</select>
													</div>
													
													<div class = "col-md-12">
														<label>Controla o patrimônio:</label>
														<select name = "patrimonio" class="au-input au-input--full">
															<option value = '1'>SIM</option>
															<option value = '0'>NÃO</option>
														</select>
													</div>
												</div>
												

												
										</div>
										<div class="modal-footer">
											<a href = "<?php echo '?p='.base64_encode('usuarios');?>" class="btn btn-primary">Cancelar</a>
											<button type = "submit" name = "gravar" class="btn btn-primary">Confirmar</button>
										</div>
								</form>
								
								</div>
								
								<?php
									if(isset($_POST['gravar'])){
										$nome = $_POST['nome'];
										$cpf = $_POST['cpf'];
										$senha = md5($_POST['senha']);
										$admin = $_POST['admin'];
										$chamados = $_POST['chamados'];
										$estoque = $_POST['estoque'];
										$patrimonio = $_POST['patrimonio'];
										$conexao->query("INSERT INTO tb_usuario (nome,cpf,senha,admin,chamados,estoque,patrimonio) VALUES('$nome','$cpf','$senha','$admin','$chamados','$estoque','$patrimonio')");
										echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('usuarios')."'>";
									}
								?>
								