<?php
	if(isset($_GET['ex'])){
		$ex = base64_decode($_GET['ex']);
		$conexao->query("DELETE FROM tb_lista_categoria WHERE id = $ex");
		echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('usuario_categoria')."'>";
	}
?>


<?php
	$SQLBusca = $conexao->query("SELECT tb_lista_categoria.id, tb_usuario.nome, tb_categoria.nome AS categoria FROM tb_lista_categoria INNER JOIN tb_usuario ON tb_lista_categoria.tb_usuario_id = tb_usuario.id INNER JOIN tb_categoria ON tb_lista_categoria.tb_categoria_id = tb_categoria.id");
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
											<a href = "<?php echo '?p='.base64_encode('usuario_categoria').'&ex='.base64_encode($RSBusca['id']);?>" class="btn btn-primary">Confirmar</a>
										</div>
								</form>
								</div>
							</div>
						</div>
<!-- end modal medium -->


						
<!-- end modal medium -->

<?php }?>

<!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                       <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Registros cadastrados</h2>
                                    
										<a href = "?p=<?php echo base64_encode('novo_usuario_categoria');?>" class="au-btn au-btn-icon au-btn--blue">
											<i class="zmdi zmdi-plus"></i>add Registro
										</a>
									
                                </div>
                            </div>
                        </div>'
                       <div class="row">
                            <div class="col-lg-12">
                                
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th colspan = "3" width = "60%">Usuario</th>
												<th>Categoria</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										
											<?php
												$id_modal = 0;
												$SQLBusca = $conexao->query("SELECT tb_lista_categoria.id, tb_usuario.nome, tb_categoria.nome AS categoria FROM tb_lista_categoria INNER JOIN tb_usuario ON tb_lista_categoria.tb_usuario_id = tb_usuario.id INNER JOIN tb_categoria ON tb_lista_categoria.tb_categoria_id = tb_categoria.id");
												while($RSBusca = $SQLBusca->fetch()){
													$id_modal++;
													
													echo "<tr>
														  <td width = '10%'><a href='#' data-toggle='modal' data-target='#excluir".$id_modal."' title = 'Excluir Item'><i class = 'fa fa-times'></i></a></td>
														  <td width = '10%'><a href='?p=".base64_encode('edita_usuario_categoria')."&id=".base64_encode($RSBusca['id'])."' title = 'Editar Registro'><i class = 'fa fa-edit'></i></a></td>
														  <td>".$RSBusca['nome']."</td>
														  <td>".$RSBusca['categoria']."</td>";
													
												}
											
											?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
						
						
						
						
						
                        
                       