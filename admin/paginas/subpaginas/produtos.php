<?php
	if(isset($_GET['ex'])){
		$ex = base64_decode($_GET['ex']);
		try{
		$conexao->query("DELETE FROM tb_produto WHERE id = $ex");
		echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('produtos')."'>";
		}catch(PDOException $e){
			echo "<script>alert('O registro que está tentando excluir possui outros registros vinculados.')</script>";
			echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('produtos')."'>";
		}
	}
	else if(isset($_GET['exfab'])){
		
		$fabricante = base64_decode($_GET['exfab']);
		$produto = base64_decode($_GET['prod']);
		$conexao->query("DELETE FROM tb_lista_fabricante WHERE tb_fabricante_id = $fabricante AND tb_produto_id = $produto");
		
		echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('produtos')."'>";
		
		
	}
?>


<?php

	if(isset($_POST['filtrar'])){
		$categoria = $_POST['categoria'];
												$nome = $_POST['nome'];
																								
												$SQLBusca = $conexao->query("SELECT tb_produto.id, tb_produto.nome, tb_produto.un_medida, tb_produto.tb_categoria_produto_id, tb_categoria_produto.nome AS categoria, (SELECT COUNT(tb_lista_fabricante.id) FROM tb_lista_fabricante WHERE tb_lista_fabricante.tb_produto_id = tb_produto.id) AS fabricantes FROM tb_produto INNER JOIN tb_categoria_produto ON tb_produto.tb_categoria_produto_id = tb_categoria_produto.id WHERE tb_produto.tb_categoria_produto_id = $categoria AND tb_produto.nome LIKE '%$nome%' ORDER BY tb_produto.nome LIMIT 50");
												
												$id_modal = 0;
												
												while($RSBusca = $SQLBusca->fetch()){
		$id_modal++;
?>
<!-- modal excluir -->
						<div class="modal fade" id="excluir<?php echo $id_modal;?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
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
											
											<p>Deseja realmente excluir item ID <b><?php echo $RSBusca['id']?></b>?</p>
												
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
											<a href = "<?php echo '?p='.base64_encode('produtos').'&ex='.base64_encode($RSBusca['id']);?>" class="btn btn-primary">Confirmar</a>
										</div>
								</form>
								</div>
							</div>
						</div>
<!-- end modal medium -->

<!-- modal fabricantes -->
						<div class="modal fade" id="fabricantes<?php echo $id_modal;?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<form action="" method="post">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="mediumModalLabel">Fabricantes deste produto</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class = "container">
												<div class="form-group row">
														<div class = "col-md-12">
															<ul>
																<?php
																	$SQLFab = $conexao->query("SELECT tb_fabricante.id, tb_fabricante.nome FROM tb_fabricante INNER JOIN tb_lista_fabricante ON tb_lista_fabricante.tb_fabricante_id = tb_fabricante.id WHERE tb_lista_fabricante.tb_produto_id = ".$RSBusca['id']);
																	while($RSFab = $SQLFab->fetch()){
																		
																		echo "<li>".$RSFab['id']." - ".$RSFab['nome']." <a href='?p=".base64_encode('produtos')."&exfab=".base64_encode($RSFab['id'])."&prod=".base64_encode($RSBusca['id'])."' title = 'Desvincular Fabricante'><i class = 'fa fa-times'></i></a></li>";
																		
																	}	
																?>
															
															</ul>
														</div>
												</div>
											</div>
												
										</div>
										<div class="modal-footer">
											<a href = "<?php echo '?p='.base64_encode('vinculafabricante').'&id='.base64_encode($RSBusca['id']);?>" class="btn btn-primary">Vincular Fabricante</a>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
											
										</div>
								</form>
								</div>
							</div>
						</div>
<!-- end modal medium -->

	<?php }
		
		
		
		
		
	}else{

	$SQLBusca = $conexao->query("SELECT * FROM tb_produto ORDER BY nome LIMIT 50");
	$id_modal = 0;
	while($RSBusca = $SQLBusca->fetch()){
		$id_modal++;
?>
<!-- modal excluir -->
						<div class="modal fade" id="excluir<?php echo $id_modal;?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
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
											
											<p>Deseja realmente excluir item ID <b><?php echo $RSBusca['id']?></b>?</p>
												
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
											<a href = "<?php echo '?p='.base64_encode('produtos').'&ex='.base64_encode($RSBusca['id']);?>" class="btn btn-primary">Confirmar</a>
										</div>
								</form>
								</div>
							</div>
						</div>
<!-- end modal medium -->

<!-- modal fabricantes -->
						<div class="modal fade" id="fabricantes<?php echo $id_modal;?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<form action="" method="post">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="mediumModalLabel">Fabricantes deste produto</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class = "container">
												<div class="form-group row">
														<div class = "col-md-12">
															<ul>
																<?php
																	$SQLFab = $conexao->query("SELECT tb_fabricante.id, tb_fabricante.nome FROM tb_fabricante INNER JOIN tb_lista_fabricante ON tb_lista_fabricante.tb_fabricante_id = tb_fabricante.id WHERE tb_lista_fabricante.tb_produto_id = ".$RSBusca['id']);
																	while($RSFab = $SQLFab->fetch()){
																		
																		echo "<li>".$RSFab['id']." - ".$RSFab['nome']." <a href='?p=".base64_encode('produtos')."&exfab=".base64_encode($RSFab['id'])."&prod=".base64_encode($RSBusca['id'])."' title = 'Desvincular Fabricante'><i class = 'fa fa-times'></i></a></li>";
																		
																	}	
																?>
															
															</ul>
														</div>
												</div>
											</div>
												
										</div>
										<div class="modal-footer">
											<a href = "<?php echo '?p='.base64_encode('vinculafabricante').'&id='.base64_encode($RSBusca['id']);?>" class="btn btn-primary">Vincular Fabricante</a>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
											
										</div>
								</form>
								</div>
							</div>
						</div>
<!-- end modal medium -->

	<?php }
	
	}
	?>


<!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                       <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Produtos Cadastrados</h2>
                                    
									<a href = "?p=<?php echo base64_encode('novoproduto');?>" class="au-btn au-btn-icon au-btn--blue">
											<i class="zmdi zmdi-plus"></i>add Produto
										</a>
																			
                                </div>
                            </div>
                        </div>'
                       <div class="row">
                            <div class="col-lg-12">
							
							<form action="" method="post" enctype="multipart/form-data">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="mediumModalLabel">Filtrar Registros</b></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
								
									<div class="form-group row">
													<div class = "col-md-3">
														<label>Tipo de produto</label>
														<select name = "categoria" class="form-control">
															
															<?php
																$SQL = "SELECT * FROM tb_categoria_produto ORDER BY nome";
																$SQLBusca = $conexao->query($SQL);
																
																while($RSBusca = $SQLBusca->fetch()){
																
															?>
															<option value = "<?php echo $RSBusca['id'];?>" <?php if(isset($_POST['categoria'])){if($_POST['categoria'] == $RSBusca['id']){echo "selected = 'selected'";}}?>><?php echo $RSBusca['nome'];?></option>
															
																<?php }
																
																
																?>
														</select>														
														
													</div>
													
													<div class = "col-md-6">
														<label>Nome</label>
														<input class="form-control" type="text" name="nome" placeholder="Nome" value = "<?php if(isset($_POST['nome'])){echo $_POST['nome'];}?>" onkeyup="maiuscula(this)"/>
													</div>
													
													
													
													<div class = "col-md-1" align = "right">
													<br/>
														<button type = "submit" name = "filtrar" class="btn btn-primary">Filtrar</button> 
													</div>
													<div class = "col-md-2">
													<br/>
														<a href = "<?php echo '?p='.base64_encode('produtos');?>" class="btn btn-primary">Limpar Filtros</a>
													</div>
									</div>
									
									</div>
									
									</div>
									
							</form>
                                
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th colspan = "3">Nome</th>
												<th>Categoria</th>
												<th>Un Medida</th>
												<th>Fabricantes</th>												
												
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										
											<?php
											
											
											if(isset($_POST['filtrar'])){
												
												$categoria = $_POST['categoria'];
												$nome = $_POST['nome'];
																								
												$SQLBusca = $conexao->query("SELECT tb_produto.id, tb_produto.nome, tb_produto.un_medida, tb_produto.tb_categoria_produto_id, tb_categoria_produto.nome AS categoria, (SELECT COUNT(tb_lista_fabricante.id) FROM tb_lista_fabricante WHERE tb_lista_fabricante.tb_produto_id = tb_produto.id) AS fabricantes FROM tb_produto INNER JOIN tb_categoria_produto ON tb_produto.tb_categoria_produto_id = tb_categoria_produto.id WHERE tb_produto.tb_categoria_produto_id = $categoria AND tb_produto.nome LIKE '%$nome%' ORDER BY tb_produto.nome LIMIT 50");
												
												$id_modal = 0;
												while($RSBusca = $SQLBusca->fetch()){
													$id_modal++;
													echo "<tr>
														  <td width = '10%'><a href='#' data-toggle='modal' data-target='#excluir".$id_modal."' title = 'Excluir Item'><i class = 'fa fa-times'></i></a></td>
														  <td width = '10%'><a href='?p=".base64_encode('editaproduto')."&id=".base64_encode($RSBusca['id'])."' title = 'Editar Produto'><i class = 'fa fa-edit'></i></a></td>
														  <td>".$RSBusca['nome']."</td>
														  <td>".$RSBusca['categoria']."</td>
														  <td>".$RSBusca['un_medida']."</td>
														  <td><a href = '#' data-toggle='modal' data-target='#fabricantes".$id_modal."' title = 'Ver Fabricantes'><i class = 'fa fa-list-ol'></i></a> ".$RSBusca['fabricantes']."</td>";
												}
												
											}else{
											
												$SQLBusca = $conexao->query("SELECT tb_produto.id, tb_produto.nome, tb_produto.un_medida, tb_produto.tb_categoria_produto_id, tb_categoria_produto.nome AS categoria, (SELECT COUNT(tb_lista_fabricante.id) FROM tb_lista_fabricante WHERE tb_lista_fabricante.tb_produto_id = tb_produto.id) AS fabricantes FROM tb_produto INNER JOIN tb_categoria_produto ON tb_produto.tb_categoria_produto_id = tb_categoria_produto.id ORDER BY tb_produto.nome LIMIT 50");
												
												$id_modal = 0;
												while($RSBusca = $SQLBusca->fetch()){
													$id_modal++;
													echo "<tr>
														  <td width = '10%'><a href='#' data-toggle='modal' data-target='#excluir".$id_modal."' title = 'Excluir Item'><i class = 'fa fa-times'></i></a></td>
														  <td width = '10%'><a href='?p=".base64_encode('editaproduto')."&id=".base64_encode($RSBusca['id'])."' title = 'Editar Produto'><i class = 'fa fa-edit'></i></a></td>
														  <td>".$RSBusca['nome']."</td>
														  <td>".$RSBusca['categoria']."</td>
														  <td>".$RSBusca['un_medida']."</td>
														   <td><a href = '#' data-toggle='modal' data-target='#fabricantes".$id_modal."' title = 'Ver Fabricantes'><i class = 'fa fa-list-ol'></i></a> ".$RSBusca['fabricantes']."</td>";
												}
												
											}
											
											?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
						
						
						
						
						
                        
                       