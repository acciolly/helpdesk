<?php
	$SQLBusca = $conexao->query("SELECT * FROM tb_categoria WHERE id = ".$_SESSION['categoria']);
	$RSBusca = $SQLBusca->fetch();
	
	
	if($RSBusca['produtos'] == 1){
		
		$arrCodigo = array();
		$arrQtd = array();
		
		if(isset($_SESSION['codigoProduto'])){
			$arrCodigo = $_SESSION['codigoProduto'];
		}
		if(isset($_SESSION['qtdProduto'])){
			$arrQtd = $_SESSION['qtdProduto'];
		}	
		
		?>
		
		
		<!-- modal carrinho -->
																	<div class="modal fade" id="carrinho" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
																		<div class="modal-dialog modal-lg" role="document">
																			<form action="" method="post">
																				<div class="modal-content">
																					<div class="modal-header">
																						<h5 class="modal-title" id="mediumModalLabel">Itens Solicitados</h5>
																						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																							<span aria-hidden="true">&times;</span>
																						</button>
																					</div>
																					<div class="modal-body">
																						<?php
																							for($i=0; $i < count($arrCodigo); $i++){
																								$SQLProduto = $conexao->query("SELECT * FROM tb_produto WHERE id = ".$arrCodigo[$i]);
																								$RSProduto = $SQLProduto->fetch();
																								echo "<p>".$RSProduto['nome']." - ".$arrQtd[$i]." ".$RSProduto['un_medida']."</p>";
																							}
																						?>
																						
																							
																					</div>
																					<div class="modal-footer">
																						<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
																						<button type="button" class="btn btn-primary" data-toggle='modal' data-target='#finalizar'>Finalizar Pedido</button>
																					</div>
																			</form>
																			</div>
																		</div>
																	</div>
											<!-- end modal medium -->

											<!-- modal Finalizar -->
																	<div class="modal fade" id="finalizar" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
																		<div class="modal-dialog modal-lg" role="document">
																			<form action="" method="post">
																				<div class="modal-content">
																					<div class="modal-header">
																						<h5 class="modal-title" id="mediumModalLabel">Escreva abaixo, se necessário, alguma observação</h5>
																						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																							<span aria-hidden="true">&times;</span>
																						</button>
																					</div>
																					<div class="modal-body">
																						
																						<div class="form-group row">
																							<div class = "col-md-12">
																								
																								<textarea name = "solicitacao" class = "form-control" rows = "15"></textarea>
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
																						
																							
																					</div>
																					<div class="modal-footer">
																						<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
																						<button type="submit" class="btn btn-primary" name = "avancar" >Avançar</button>
																					</div>
																			</form>
																			</div>
																		</div>
																	</div>
											<!-- end modal medium -->

											<?php
												if(isset($_POST['avancar'])){
													
													$data = date('Y-m-d');
													$hora = date('H:i');
													$solicitacao = $_POST['solicitacao'];
													$categoria = $_SESSION['categoria'];
													$departamento = $_SESSION['departamento'];
													$solicitante = $_SESSION['solicitante'];
													$protocolo = date('ymdHis').$departamento.$solicitante;
													
													$conexao->query("INSERT INTO tb_chamado(data,hora,descricao,tb_categoria_id,tb_pessoa_id,tb_departamento_id,protocolo) VALUES('$data','$hora','$solicitacao','$categoria','$solicitante','$departamento','$protocolo')");
													
													$SQLBusca = $conexao->query("SELECT id FROM tb_chamado WHERE tb_pessoa_id = $solicitante ORDER BY id DESC");
													$RSBusca = $SQLBusca->fetch();
													
													for($i = 0; $i < count($arrCodigo); $i++){
														$conexao->query("INSERT INTO tb_lista_produtos(tb_chamado_id, tb_produto_id, qtd) VALUES(".$RSBusca['id'].",".$arrCodigo[$i].",'".$arrQtd[$i]."')");
													}
													
													$_SESSION['solicitacao'] = $RSBusca['id'];
													
													echo "<meta http-equiv='refresh' content='0, url='>";
												}
												
												
												
												
											?>
		
			<div class = "main-content" style = "background-color:white;">
				
                    <div class="container" >
					<form method = "post">
						<div class="form-group row col-md-12">
													
												
													<div class = "col-md-10">
														
														
													</div>
													<div class = "col-md-2" align = 'center'>
														
														<a href = "#" style = "font-size: 50px;" data-toggle='modal' data-target='#carrinho'><i class = "fa fa-shopping-cart"></i></a><br><p><?php echo count($arrCodigo);?> produtos</p>
													</div>
												
						</div>
						
						<div class="form-group row col-md-12">
													
												
													<div class = "col-md-12">
														
														<h2>SOLICITAÇÃO DE MATERIAIS</h2>
													</div>
													
												
						</div>
						
						<div class="form-group row col-md-12">
													
												
													<div class = "col-md-10">
														
														<input class="au-input au-input--full" type="text" name="criterio" placeholder="Pesquisar..." onkeyup="maiuscula(this)" value = "<?php if(isset($_POST['criterio'])){echo $_POST['criterio'];}?>"/>
													</div>
													<div class = "col-md-2">
														
														<button class="btn btn-primary btn-block" type="submit" name="buscar" onkeyup="maiuscula(this)" />Buscar</button>
													</div>
												
						</div>
						</form>
						<div class = 'row col-md-12'>
						
							
						
						<?php
						
							if(isset($_POST['buscar'])){
								$criterio = $_POST['criterio'];
								$SQLBusca = $conexao->query("SELECT tb_produto.id, tb_produto.nome, tb_produto.imagem, tb_categoria_produto.nome AS categoria FROM tb_produto INNER JOIN tb_categoria_produto ON tb_produto.tb_categoria_produto_id = tb_categoria_produto.id WHERE tb_produto.nome LIKE '%$criterio%' OR tb_categoria_produto.nome LIKE '%$criterio%' ORDER BY RAND() LIMIT 20");
								while($RSBusca = $SQLBusca->fetch()){
									echo "<div class = 'col-md-3'><a href = '#' data-toggle='modal' data-target='#".$RSBusca['id']."'>
												<img src = '".$RSBusca['imagem']."' width = '300' class = 'img img-thumbnail' />
												<p align = 'center'>".$RSBusca['nome']."</p>
												<p align = 'center'>".$RSBusca['categoria']."</p>
												</a>
										 </div>";
										 
										 ?>
								
											<!-- modal selecionar -->
																	<div class="modal fade" id="<?php echo $RSBusca['id'];?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
																		<div class="modal-dialog modal-lg" role="document">
																			<form action="" method="post">
																				<div class="modal-content">
																					<div class="modal-header">
																						<h5 class="modal-title" id="mediumModalLabel">Solicitar Item</h5>
																						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																							<span aria-hidden="true">&times;</span>
																						</button>
																					</div>
																					<div class="modal-body">
																						
																						<div class = "row col-md-12">
																							<div class = "col-md-6" align = "right">
																								<?php
																									echo "<img src = '".$RSBusca['imagem']."' width = '300' class = 'img img-thumbnail' />";
																								
																								?>
																							</div>
																							<div class = "col-md-6" align = "left">
																								<?php
																									echo "<p align = 'left'>".$RSBusca['nome']."</p>";
																								
																								?>
																								<label>Quantidade a solicitar</label>
																								<input class="au-input au-input--full" type="number" name="qtd" required />
													
																							</div>
																						
																						</div>
																							
																					</div>
																					<div class="modal-footer">
																						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
																						<button type="submit" class="btn btn-primary" name = "adicionar" value = "<?php echo $RSBusca['id'];?>">Adicionar</button>
																					</div>
																			</form>
																			</div>
																		</div>
																	</div>
											<!-- end modal medium -->								
										 
								
										 
										 <?php
								
								}
								
								if(isset($_POST['adicionar'])){
									
									array_push($arrCodigo,$_POST['adicionar']);
									array_push($arrQTD,$_POST['qtd']);
									
									$_SESSION['codigoProduto'] 		= $arrCodigo;
									$_SESSION['qtdProduto']  		= $arrQtd;
									
									echo "<meta http-equiv='refresh' content='0, url='>";
								}
							}else{
								
								$SQLBusca = $conexao->query("SELECT tb_produto.id, tb_produto.nome, tb_produto.imagem, tb_categoria_produto.nome AS categoria FROM tb_produto INNER JOIN tb_categoria_produto ON tb_produto.tb_categoria_produto_id = tb_categoria_produto.id ORDER BY RAND() LIMIT 20");
								while($RSBusca = $SQLBusca->fetch()){
									echo "<div class = 'col-md-3'><a href = '#' data-toggle='modal' data-target='#".$RSBusca['id']."'>
												<img src = '".$RSBusca['imagem']."' width = '300' class = 'img img-thumbnail' />
												<p align = 'center'>".$RSBusca['nome']."</p>
												<p align = 'center'>".$RSBusca['categoria']."</p>
												</a>
										 </div>";
										 
										 ?>
								
											<!-- modal selecionar -->
																	<div class="modal fade" id="<?php echo $RSBusca['id'];?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
																		<div class="modal-dialog modal-lg" role="document">
																			<form action="" method="post">
																				<div class="modal-content">
																					<div class="modal-header">
																						<h5 class="modal-title" id="mediumModalLabel">Solicitar Item</h5>
																						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																							<span aria-hidden="true">&times;</span>
																						</button>
																					</div>
																					<div class="modal-body">
																						
																						<div class = "row col-md-12">
																							<div class = "col-md-6" align = "right">
																								<?php
																									echo "<img src = '".$RSBusca['imagem']."' width = '300' class = 'img img-thumbnail' />";
																								
																								?>
																							</div>
																							<div class = "col-md-6" align = "left">
																								<?php
																									echo "<p align = 'left'>".$RSBusca['nome']."</p>";
																								
																								?>
																								<label>Quantidade a solicitar</label>
																								<input class="au-input au-input--full" type="number" name="qtd" required />
													
																							</div>
																						
																						</div>
																							
																					</div>
																					<div class="modal-footer">
																						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
																						<button type = "submit" class="btn btn-primary" name = "adicionar" value = "<?php echo $RSBusca['id'];?>">Adicionar</button>
																					</div>
																			</form>
																			</div>
																		</div>
																	</div>
											<!-- end modal medium -->								
										 
								
										 
										 <?php
								
								}
								
								if(isset($_POST['adicionar'])){
									
									array_push($arrCodigo,$_POST['adicionar']);
									array_push($arrQtd,$_POST['qtd']);
									
									$_SESSION['codigoProduto'] 		= $arrCodigo;
									$_SESSION['qtdProduto']  		= $arrQtd;
									
									echo "<meta http-equiv='refresh' content='0, url='>";
									
								}
								
							}
							
							
	
						
						?>
						
						
					</div>
			
					</div>
				
			</div>
		
		
		
		
		
		
		
		<?php
		
		
		
	}
	else{
?>

<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

						<form action="" method="post">
								<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="mediumModalLabel">Descreva abaixo a sua solicitação</b></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											
											<?php
												if($RSBusca['texto'] == 1){
											?>
											<div class="form-group row">
													<div class = "col-md-12">
														
														<textarea name = "solicitacao" class = "form-control" rows = "15"></textarea>
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
											
												<?php }?>
												
																								

												
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
				
				$data = date('Y-m-d');
				$hora = date('H:i');
				$solicitacao = $_POST['solicitacao'];
				$categoria = $_SESSION['categoria'];
				$departamento = $_SESSION['departamento'];
				$solicitante = $_SESSION['solicitante'];
				$protocolo = date('ymdHis').$departamento.$solicitante;
				
				$conexao->query("INSERT INTO tb_chamado(data,hora,descricao,tb_categoria_id,tb_pessoa_id,tb_departamento_id,protocolo) VALUES('$data','$hora','$solicitacao','$categoria','$solicitante','$departamento','$protocolo')");
				
				$SQLBusca = $conexao->query("SELECT id FROM tb_chamado WHERE tb_pessoa_id = $solicitante ORDER BY id DESC");
				$RSBusca = $SQLBusca->fetch();
				
				$_SESSION['solicitacao'] = $RSBusca['id'];
				
				echo "<meta http-equiv='refresh' content='0, url='>";
			}
			
			if(isset($_POST['voltar'])){
				$_SESSION['categoria'] = null;
				echo "<meta http-equiv='refresh' content='0, url='>";
			}
	
	}
?>