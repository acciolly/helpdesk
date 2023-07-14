    <?php
	if(isset($_GET['id'])){
		
		$id = base64_decode($_GET['id']);
		
		$SQLBusca = $conexao->query("SELECT * FROM tb_departamento WHERE id = $id");
		$RSBusca = $SQLBusca->fetch();
		
		$nome = $RSBusca['nome'];
		$endereco = $RSBusca['endereco'];
		$numero = $RSBusca['numero'];
		$bairro = $RSBusca['bairro'];
		$cidade = $RSBusca['cidade'];
		$fone = $RSBusca['fone'];
		$setor = $RSBusca['tb_setor_id'];
		
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
													<div class = "col-md-10">
														<label>Endereço:</label>
														<input class="au-input au-input--full" type="text" name="endereco" placeholder="Endereço" required onkeyup="maiuscula(this)" value = "<?php if(isset($id)){echo $endereco;}?>"/>
														
													</div>
													<div class = "col-md-2">
														<label>Numero:</label>
														<input class="au-input au-input--full" type="text" name="numero" placeholder="Número" required onkeyup="maiuscula(this)" value = "<?php if(isset($id)){echo $numero;}?>"/>
														
													</div>
													<div class = "col-md-6">
														<label>Bairro:</label>
														<input class="au-input au-input--full" type="text" name="bairro" placeholder="Bairro" required onkeyup="maiuscula(this)" value = "<?php if(isset($id)){echo $bairro;}?>"/>
														
													</div>
													
													<div class = "col-md-6">
														<label>Cidade:</label>
														<input class="au-input au-input--full" type="text" name="cidade" placeholder="Cidade" required onkeyup="maiuscula(this)" value = "<?php if(isset($id)){echo $cidade;}?>"/>
														
													</div>
													
													<div class = "col-md-4">
														<label>Fone:</label>
														<input class="au-input au-input--full" type="text" name="fone" placeholder="Fone" required  onkeyup="maiuscula(this)" value = "<?php if(isset($id)){echo $fone;}?>"/>
														
													</div>
													
													<div class = "col-md-12">
														<label>Setor:</label>
														<select name = "setor" class="au-input au-input--full">
															<?php
																$SQLBusca = $conexao->query("SELECT * FROM tb_setor ORDER BY nome");
																while($RSBusca = $SQLBusca->fetch()){
															
															?>
															
																		<option value = "<?php echo $RSBusca['id']?> <?php if(isset($setor)){if($setor == $RSBusca['id']){echo "selected = 'selected'";}}?>"><?php echo $RSBusca['nome']?></option>
															
																<?php }?>
														</select>
													</div>
													
												</div>
												

												
										</div>
										<div class="modal-footer">
											<a href = "<?php echo '?p='.base64_encode('departamentos');?>" class="btn btn-secondary">Cancelar</a>
											<button type = "submit" name = "gravar" class="btn btn-primary">Confirmar</button>
										</div>
								</form>
								
								</div>
								
								<?php
									if(isset($_POST['gravar'])){
										$nome = $_POST['nome'];
										$endereco = $_POST['endereco'];
										$numero = $_POST['numero'];
										$bairro = $_POST['bairro'];
										$cidade = $_POST['cidade'];
										$fone = $_POST['fone'];
										$setor = $_POST['setor'];
										$conexao->query("UPDATE tb_departamento SET nome = '$nome',endereco = '$endereco',numero = '$numero',bairro = '$bairro',cidade = '$cidade',fone = '$fone',tb_setor_id = '$setor' WHERE id = $id");
										echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('departamentos')."'>";
									}
								?>
								