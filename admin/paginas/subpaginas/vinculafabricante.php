 <?php
	if(isset($_GET['id'])){
		$produto = base64_decode($_GET['id']);
		
		$SQLBusca = $conexao->query("SELECT * FROM tb_produto WHERE id = $produto");
		
		$RSBusca = $SQLBusca->fetch();
		$nomeProduto = $RSBusca['nome'];
	}
 
 ?>
 
 <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

						<form action="" method="post">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="mediumModalLabel">Vincular fabricante ao produto - <?php echo $nomeProduto;?></b></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="form-group row">
													<div class = "col-md-12">
														<label>Fabricante</label>
														<select name = "fabricante" class="au-input au-input--full">
															
															<?php
																$SQL = "SELECT * FROM tb_fabricante ORDER BY nome";
																$SQLBusca = $conexao->query($SQL);
																
																while($RSBusca = $SQLBusca->fetch()){
																
															?>
															<option value = "<?php echo $RSBusca['id'];?>"><?php echo $RSBusca['nome'];?></option>
															
																<?php }
																
																
																?>
														</select>
													</div>
											</div>
												

												
										</div>
										<div class="modal-footer">
											<a href = "<?php echo '?p='.base64_encode('produtos');?>" class="btn btn-primary">Cancelar</a>
											<button type = "submit" name = "gravar" class="btn btn-primary">Confirmar</button>
										</div>
								</form>
								
								</div>
								
								<?php
									if(isset($_POST['gravar'])){
										$fabricante = $_POST['fabricante'];
										
										$SQLBusca = $conexao->query("SELECT * FROM tb_lista_fabricante WHERE tb_fabricante_id = $fabricante AND tb_produto_id = $produto");
										
										if($SQLBusca->rowCount() > 0){
											echo "<script>alert('Fabricante já está vinculado ao produto!')</script>";
										}else{
											
											$conexao->query("INSERT INTO tb_lista_fabricante (tb_fabricante_id, tb_produto_id) VALUES($fabricante,$produto)");
											echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('produtos')."'>";
										}
										
										
									}
								?>
								