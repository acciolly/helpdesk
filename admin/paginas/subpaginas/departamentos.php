<?php
	if(isset($_GET['ex'])){
		$ex = base64_decode($_GET['ex']);
		try{
			$conexao->query("DELETE FROM tb_departamento WHERE id = $ex");
			
		}catch(PDOException $ex){
			echo "<script>alert('Existem registros relacionados a este!')</script>";
		}
		
		echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('departamentos')."'>";
	}
?>


<?php
	$SQLBusca = $conexao->query("SELECT tb_departamento.id, tb_departamento.nome, tb_departamento.endereco, tb_departamento.numero, tb_departamento.bairro, tb_departamento.cidade, tb_departamento.fone, tb_setor.nome AS setor FROM tb_departamento INNER JOIN tb_setor ON tb_departamento.tb_setor_id = tb_setor.id ORDER BY tb_departamento.nome");
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
											<a href = "<?php echo '?p='.base64_encode('departamentos').'&ex='.base64_encode($RSBusca['id']);?>" class="btn btn-primary">Confirmar</a>
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
                                    <h2 class="title-1">Departamentos Cadastrados</h2>
                                    
										<a href = "?p=<?php echo base64_encode('novodepartamento');?>" class="au-btn au-btn-icon au-btn--blue">
											<i class="zmdi zmdi-plus"></i>add Departamento
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
                                                <th colspan = "3" width = "60%">Nome</th>
                                                <th>Endereço</th>
												<th>Setor</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										
											<?php
												$id_modal = 0;
												$SQLBusca = $conexao->query("SELECT tb_departamento.id, tb_departamento.nome, tb_departamento.endereco, tb_departamento.numero, tb_departamento.bairro, tb_departamento.cidade, tb_departamento.fone, tb_setor.nome AS setor FROM tb_departamento INNER JOIN tb_setor ON tb_departamento.tb_setor_id = tb_setor.id ORDER BY tb_departamento.nome");
												while($RSBusca = $SQLBusca->fetch()){
													$id_modal++;
													
													echo "<tr>
														  <td width = '10%'><a href='#' data-toggle='modal' data-target='#excluir".$id_modal."' title = 'Excluir Item'><i class = 'fa fa-times'></i></a></td>
														  <td width = '10%'><a href='?p=".base64_encode('editasetor')."&id=".base64_encode($RSBusca['id'])."' title = 'Editar Setor'><i class = 'fa fa-edit'></i></a></td>
														  <td>".$RSBusca['nome']."</td>
														  <td>".$RSBusca['endereco']." nº ".$RSBusca['numero'].", ".$RSBusca['bairro']."</td>
														  <td>".$RSBusca['setor']."</td>";
													
												}
											
											?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
						
						
						
						
						
                        
                       