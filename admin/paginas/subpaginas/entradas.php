<?php
	if(isset($_GET['ex'])){
		$ex = base64_decode($_GET['ex']);
		try{
		$conexao->query("DELETE FROM tb_entrada WHERE id = $ex");
		echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('entradas')."'>";
		}catch(PDOException $e){
			echo "<script>alert('O registro que está tentando excluir possui outros registros vinculados.')</script>";
			echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('produtos')."'>";
		}
	}
	
?>


<?php


if(isset($_POST['filtrar'])){
	$empresa = $_POST['empresa'];
												
												$datainicio = explode('-', $_POST['datainicio']);
												$datafim = explode('/', $_POST['datafim']);
												
												if($datainicio != "" && $datafim == ""){
													$SQL = "SELECT tb_entrada.id, tb_entrada.data, tb_entrada.documento, format((SELECT SUM(tb_produto_entrada.valor_un*tb_produto_entrada.qtd) FROM tb_produto_entrada WHERE tb_produto_entrada.tb_entrada_id = tb_entrada.id),2,'de_DE') AS valor, tb_empresa.nome FROM tb_entrada INNER JOIN tb_empresa ON tb_entrada.tb_empresa_id = tb_empresa.id WHERE tb_empresa.nome LIKE '%$empresa%' AND tb_entrada.data >= '".$datainicio[2]."-".$datainicio[1]."-".$datainicio[0]."' ORDER BY tb_entrada.id DESC LIMIT 50";
												}else if($datainicio != "" && $datafim != ""){
													$SQL = "SELECT tb_entrada.id, tb_entrada.data, tb_entrada.documento, format((SELECT SUM(tb_produto_entrada.valor_un*tb_produto_entrada.qtd) FROM tb_produto_entrada WHERE tb_produto_entrada.tb_entrada_id = tb_entrada.id),2,'de_DE') AS valor, tb_empresa.nome FROM tb_entrada INNER JOIN tb_empresa ON tb_entrada.tb_empresa_id = tb_empresa.id WHERE tb_empresa.nome LIKE '%$empresa%' AND tb_entrada.data BETWEEN '".$datainicio[2]."-".$datainicio[1]."-".$datainicio[0]."' AND '".$datafim[2]."-".$datafim[1]."-".$datafim[0]."' ORDER BY tb_entrada.id DESC LIMIT 50";
												}else if($datainicio == "" && $datafim != ""){
													$SQL = "SELECT tb_entrada.id, tb_entrada.data, tb_entrada.documento, format((SELECT SUM(tb_produto_entrada.valor_un*tb_produto_entrada.qtd) FROM tb_produto_entrada WHERE tb_produto_entrada.tb_entrada_id = tb_entrada.id),2,'de_DE') AS valor, tb_empresa.nome FROM tb_entrada INNER JOIN tb_empresa ON tb_entrada.tb_empresa_id = tb_empresa.id WHERE tb_empresa.nome LIKE '%$empresa%' AND tb_entrada.data <= '".$datafim[2]."-".$datafim[1]."-".$datafim[0]."' ORDER BY tb_entrada.id DESC LIMIT 50";
												}else if($datainicio == "" && $datafim == ""){
													$SQL = "SELECT tb_entrada.id, tb_entrada.data, tb_entrada.documento, format((SELECT SUM(tb_produto_entrada.valor_un*tb_produto_entrada.qtd) FROM tb_produto_entrada WHERE tb_produto_entrada.tb_entrada_id = tb_entrada.id),2,'de_DE') AS valor, tb_empresa.nome FROM tb_entrada INNER JOIN tb_empresa ON tb_entrada.tb_empresa_id = tb_empresa.id WHERE tb_empresa.nome LIKE '%$empresa%' ORDER BY tb_entrada.id DESC LIMIT 50";
												}
												
												$SQLBusca = $conexao->query($SQL);
												
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
											<a href = "<?php echo '?p='.base64_encode('entradas').'&ex='.base64_encode($RSBusca['id']);?>" class="btn btn-primary">Confirmar</a>
										</div>
								</form>
								</div>
							</div>
						</div>
<!-- end modal medium -->



	<?php }
												
	
}else{

	$SQLBusca = $conexao->query("SELECT tb_entrada.id, tb_entrada.data, tb_entrada.documento, format((SELECT SUM(tb_produto_entrada.valor_un*tb_produto_entrada.qtd) FROM tb_produto_entrada WHERE tb_produto_entrada.tb_entrada_id = tb_entrada.id),2,'de_DE') AS valor, tb_empresa.nome FROM tb_entrada INNER JOIN tb_empresa ON tb_entrada.tb_empresa_id = tb_empresa.id ORDER BY tb_entrada.id DESC LIMIT 50");
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
											<a href = "<?php echo '?p='.base64_encode('entradas').'&ex='.base64_encode($RSBusca['id']);?>" class="btn btn-primary">Confirmar</a>
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
                                    <h2 class="title-1">Entradas no estoque</h2>
                                    
									<a href = "?p=<?php echo base64_encode('novaentrada');?>" class="au-btn au-btn-icon au-btn--blue">
											<i class="zmdi zmdi-plus"></i>add Entrada
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
													<div class = "col-md-4">
														<label>Empresa</label>
														<input class="form-control" type="text" name="empresa" placeholder="Empresa" value = "<?php if(isset($_POST['empresa'])){echo $_POST['empresa'];}?>" onkeyup="maiuscula(this)"/>
													</div>
													
													<div class = "col-md-2">
														<label>Data Inicial</label>
														<input class="form-control" type="text" name="datainicio" value = "<?php if(isset($_POST['datainicio'])){echo $_POST['datainicio'];}?>" onkeyup = "mascara(this,'##/##/####')"/>
													</div>
													
													<div class = "col-md-2">
														<label>Data Final</label>
														<input class="form-control" type="text" name="datainicio" value = "<?php if(isset($_POST['datafim'])){echo $_POST['datafim'];}?>" onkeyup = "mascara(this,'##/##/####')"/>
													</div>
													
													
													
													<div class = "col-md-2" align = "right">
													<br/>
														<button type = "submit" name = "filtrar" class="btn btn-primary  btn-block">Filtrar</button> 
													</div>
													<div class = "col-md-2">
													<br/>
														<a href = "<?php echo '?p='.base64_encode('entradas');?>" class="btn btn-secondary btn-block">Limpar</a>
													</div>
									</div>
									
									</div>
									
									</div>
									
							</form>
                                
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th colspan = "3">Data</th>
												<th>Empresa</th>
												<th>Documento</th>
												<th>Valor</th>												
												
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										
											<?php
											
											
											if(isset($_POST['filtrar'])){
												
												$empresa = $_POST['empresa'];
												
												$datainicio = explode('-', $_POST['datainicio']);
												$datafim = explode('/', $_POST['datafim']);
												
												if($datainicio != "" && $datafim == ""){
													$SQL = "SELECT tb_entrada.id, tb_entrada.data, tb_entrada.documento, format((SELECT SUM(tb_produto_entrada.valor_un*tb_produto_entrada.qtd) FROM tb_produto_entrada WHERE tb_produto_entrada.tb_entrada_id = tb_entrada.id),2,'de_DE') AS valor, tb_empresa.nome FROM tb_entrada INNER JOIN tb_empresa ON tb_entrada.tb_empresa_id = tb_empresa.id WHERE tb_empresa.nome LIKE '%$empresa%' AND tb_entrada.data >= '".$datainicio[2]."-".$datainicio[1]."-".$datainicio[0]."' ORDER BY tb_entrada.id DESC LIMIT 50";
												}else if($datainicio != "" && $datafim != ""){
													$SQL = "SELECT tb_entrada.id, tb_entrada.data, tb_entrada.documento, format((SELECT SUM(tb_produto_entrada.valor_un*tb_produto_entrada.qtd) FROM tb_produto_entrada WHERE tb_produto_entrada.tb_entrada_id = tb_entrada.id),2,'de_DE') AS valor, tb_empresa.nome FROM tb_entrada INNER JOIN tb_empresa ON tb_entrada.tb_empresa_id = tb_empresa.id WHERE tb_empresa.nome LIKE '%$empresa%' AND tb_entrada.data BETWEEN '".$datainicio[2]."-".$datainicio[1]."-".$datainicio[0]."' AND '".$datafim[2]."-".$datafim[1]."-".$datafim[0]."' ORDER BY tb_entrada.id DESC LIMIT 50";
												}else if($datainicio == "" && $datafim != ""){
													$SQL = "SELECT tb_entrada.id, tb_entrada.data, tb_entrada.documento, format((SELECT SUM(tb_produto_entrada.valor_un*tb_produto_entrada.qtd) FROM tb_produto_entrada WHERE tb_produto_entrada.tb_entrada_id = tb_entrada.id),2,'de_DE') AS valor, tb_empresa.nome FROM tb_entrada INNER JOIN tb_empresa ON tb_entrada.tb_empresa_id = tb_empresa.id WHERE tb_empresa.nome LIKE '%$empresa%' AND tb_entrada.data <= '".$datafim[2]."-".$datafim[1]."-".$datafim[0]."' ORDER BY tb_entrada.id DESC LIMIT 50";
												}else if($datainicio == "" && $datafim == ""){
													$SQL = "SELECT tb_entrada.id, tb_entrada.data, tb_entrada.documento, format((SELECT SUM(tb_produto_entrada.valor_un*tb_produto_entrada.qtd) FROM tb_produto_entrada WHERE tb_produto_entrada.tb_entrada_id = tb_entrada.id),2,'de_DE') AS valor, tb_empresa.nome FROM tb_entrada INNER JOIN tb_empresa ON tb_entrada.tb_empresa_id = tb_empresa.id WHERE tb_empresa.nome LIKE '%$empresa%' ORDER BY tb_entrada.id DESC LIMIT 50";
												}
												
												$SQLBusca = $conexao->query($SQL);
												
												$id_modal = 0;
												while($RSBusca = $SQLBusca->fetch()){
													$id_modal++;
													echo "<tr>
														  <td width = '10%'><a href='#' data-toggle='modal' data-target='#excluir".$id_modal."' title = 'Excluir Item'><i class = 'fa fa-times'></i></a></td>
														  <td width = '10%'><a href='?p=".base64_encode('editaentrada')."&id=".base64_encode($RSBusca['id'])."' title = 'Editar entrada'><i class = 'fa fa-edit'></i></a></td>
														  <td>".date('d/m/Y', strtotime($RSBusca['data']))."</td>
														  <td>".$RSBusca['nome']."</td>
														  <td>".$RSBusca['documento']."</td>
														  <td>".$RSBusca['valor']."</td>";
												}
												
											}else{
											
												$SQLBusca = $conexao->query("SELECT tb_entrada.id, tb_entrada.data, tb_entrada.documento, format((SELECT SUM(tb_produto_entrada.valor_un*tb_produto_entrada.qtd) FROM tb_produto_entrada WHERE tb_produto_entrada.tb_entrada_id = tb_entrada.id),2,'de_DE') AS valor, tb_empresa.nome FROM tb_entrada INNER JOIN tb_empresa ON tb_entrada.tb_empresa_id = tb_empresa.id ORDER BY tb_entrada.id DESC LIMIT 50");
												
												$id_modal = 0;
												while($RSBusca = $SQLBusca->fetch()){
													$id_modal++;
													echo "<tr>
														  <td width = '10%'><a href='#' data-toggle='modal' data-target='#excluir".$id_modal."' title = 'Excluir Item'><i class = 'fa fa-times'></i></a></td>
														  <td width = '10%'><a href='?p=".base64_encode('editaentrada')."&id=".base64_encode($RSBusca['id'])."' title = 'Editar entrada'><i class = 'fa fa-edit'></i></a></td>
														  <td>".date('d/m/Y', strtotime($RSBusca['data']))."</td>
														  <td>".$RSBusca['nome']."</td>
														  <td>".$RSBusca['documento']."</td>
														  <td>".$RSBusca['valor']."</td>";
												}
												
											}
											
											?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
						
						
						
						
						
                        
                       