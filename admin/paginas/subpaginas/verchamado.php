<?php
	if(isset($_GET['id'])){
		
		$id = base64_decode($_GET['id']);
		
		$SQLBusca = $conexao->query("SELECT tb_chamado.data, tb_chamado.descricao, tb_chamado.hora, tb_pessoa.nome AS solicitante, tb_departamento.nome AS departamento, finalizado, data_finalizado, hora_finalizado, finalizado_como FROM tb_chamado INNER JOIN tb_pessoa ON tb_chamado.tb_pessoa_id = tb_pessoa.id INNER JOIN tb_departamento ON tb_chamado.tb_departamento_id = tb_departamento.id WHERE tb_chamado.id = $id");
		$RSBusca = $SQLBusca->fetch();
		
		$data = date('d/m/Y', strtotime($RSBusca['data']));
		$hora = $RSBusca['hora'];
		$solicitante = $RSBusca['solicitante'];
		$departamento = $RSBusca['departamento'];
		$descricao = $RSBusca['descricao'];
		$finalizado = $RSBusca['finalizado'];
		$data_finalizado = Date('d/m/Y', strtotime($RSBusca['data_finalizado']));
		$hora_finalizado = $RSBusca['hora_finalizado'];
		$finalizado_como = $RSBusca['finalizado_como'];
		
	}

?>

<!-- modal finalizar -->
						<div class="modal fade" id="finalizar" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<form action="" method="post">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="mediumModalLabel">Excluir Item</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											
											<div class = "col-md-12">
												<label>Responder:</label>
													<select name = "escolha" class = "form-control">
														<option = value = "RESOLVIDO">RESOLVIDO</option>
														<option = value = "CANCELADO">CANCELADO</option>
														<option = value = "INDEFERIDO">INDEFERIDO</option>
													</select>
												</div>
												
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
											<button type="submit" class="btn btn-primary" name = "finalizar">Finalizar</button>
											
										</div>
								</form>
								</div>
							</div>
						</div>
<!-- end modal medium -->

<?php
	if(isset($_POST['finalizar'])){
		$escolha = $_POST['escolha'];
		$data = date('Y-m-d');
		$hora = date('H:i');
		$conexao->query("UPDATE tb_chamado SET data_finalizado = '$data', hora_finalizado = '$hora', finalizado_como = '$escolha', finalizado = '1' WHERE id = $id");
		echo "<meta http-equiv='refresh' content='0, url='>";
	}

?>

 <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

						<form action="" method="post" enctype="multipart/form-data">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="mediumModalLabel">Visualizar chamado</b></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="form-group row">
													<div class = "col-md-12">
														<h5><?php echo $data." ".$hora." - ".$solicitante." escreveu:";?></h5>
														<p align = "justify" style = "padding-top:10px;"><?php echo $descricao;?></p>
													</div>
											</div>
											
											<div class="form-group row">
													
													<div class = "col-md-12">
														<label>Anexos:</label>
													
													<?php
														$SQLBusca = $conexao->query("SELECT * FROM tb_anexo WHERE tb_chamado_id = $id");
														while($RSBusca = $SQLBusca->fetch()){
															
															echo "<p><i class = 'bi bi-paperclip'></i><a href = '../".$RSBusca['anexo']."' target = 'blank'>".$RSBusca['descricao']."</a></p>";
															
														}
													?>
													</div>
											</div>
											
											<?php
												$SQLProdutos = $conexao->query("SELECT * FROM tb_lista_produtos WHERE tb_chamado_id = $id");
												
												if($SQLProdutos->rowCount()>0){
													?>
														<div class="form-group row">
													
													<div class = "col-md-12">
														<label>Solicitação de Produtos:</label><br/>
													
													<?php
															echo "<a href = 'print/solicitacao.php?id=$id' target = 'blank'><img src = 'images/pdf.png' width = '8%'/></a>";
															
													?>
													</div>
											</div>
													
													
													<?php
													
													
												}
											?>
											
											<div class="form-group row">
													<?php
													
														$SQLBusca = $conexao->query("SELECT * FROM tb_resposta WHERE tb_chamado_id = $id ORDER BY id ASC");
														while($RSBusca = $SQLBusca->fetch()){
													?>
													<div class = "col-md-12">
														<h5 style = "padding-top: 10px;"><?php echo date('d/m/Y', strtotime($RSBusca['data']))." ".$RSBusca['hora']." - ".$RSBusca['nome_pessoa']." escreveu:";?></h5>
														<p align = "justify" style = "padding-top:10px;"><?php echo $RSBusca['resposta'];?></p>
													</div>
													
													<?php
														}
													?>
											</div>
											
											<?php
												if($finalizado == 0){
											?>
											<div class="form-group row">
												
													<div class = "col-md-12">
														<label>Responder:</label>
														<textarea name = "resposta" class = "form-control" rows = "10"></textarea>
													</div>
											</div>
											<div class="form-group row">
													
													<div class = "col-md-12" align = "right">
														<button type = "submit" name = "responder" class="btn btn-primary">Responder</button>
													</div>
													
											</div>
												
											<script src="https://cdn.tiny.cloud/1/ox6sna8eetk7yi7q9kj387otl2ul37jqcg3h4g7vnd4bsok1/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
												
											<script>
													tinymce.init({
													  selector: 'textarea',
													  plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak table source code media',
													  toolbar_mode: 'floating',
													});
											</script>
											<?php
												
												}else{
													
													echo "<h5>".$data_finalizado." ".$hora_finalizado." - chamado finalizado como: ".$finalizado_como;
													
												}
												
												?>
											
											
												

												
										</div>
										<div class="modal-footer">
											<a href = "<?php echo '?p='.base64_encode('chamados');?>" class="btn btn-primary">Voltar</a>
											
											<?php
												if($finalizado == 0){
											?>
											<a href = "#" name = "finalizar" class="btn btn-primary" data-toggle='modal' data-target='#finalizar'>Finalizar Chamado</a>
												<?php
												
												}
												
												?>
										</div>
								</form>
								
								</div>
								
								<?php
									if(isset($_POST['responder'])){
										$resposta = $_POST['resposta'];
										$data = date('Y-m-d');
										$hora = date('H:i');
										$pessoa = $nomeUser;
										$conexao->query("INSERT INTO tb_resposta(resposta,data,hora,nome_pessoa,tb_chamado_id) VALUES('$resposta','$data','$hora','$pessoa',$id)");
										echo "<meta http-equiv='refresh' content='0, url='>";
									}
								?>
								
								
							