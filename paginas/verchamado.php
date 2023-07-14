<!DOCTYPE html>
<html lang="pt">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    
        <div class="page-content--bge5">
            <div class="container">
              


<?php
	$SQLBusca = $conexao->query("SELECT * FROM tb_pessoa WHERE id = ".$_SESSION['solicitante']);
	$RSBusca = $SQLBusca->fetch();
	$nomeUser = $RSBusca['nome'];
	
?>

<?php
	
	
		
		$id = $_SESSION['verchamado'];
		
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
														<p align = "justify" style = "padding-top:10px;"><?php echo str_replace("\n","<br/>",$descricao);?></p>
													</div>
											</div>
											
											<div class="form-group row">
													
													<div class = "col-md-12">
														<label>Anexos:</label>
													
													<?php
														$SQLBusca = $conexao->query("SELECT * FROM tb_anexo WHERE tb_chamado_id = $id");
														while($RSBusca = $SQLBusca->fetch()){
															$descricao = $RSBusca['descricao'];
															if($descricao == "MÍDIA DO WHATS"){
																
																echo "<p><i class = 'bi bi-paperclip'></i><a href = '#' data-toggle='modal' data-target='#veranexowhats".$RSBusca['id']."'>".$RSBusca['descricao']."</a></p>";
																																
															}else{
															
																echo "<p><i class = 'bi bi-paperclip'></i><a href = '../".$RSBusca['anexo']."' target = 'blank'>".$RSBusca['descricao']."</a></p>";
															
															}
															
														}
													?>
													</div>
													
													<?php
												$SQLProdutos = $conexao->query("SELECT * FROM tb_lista_produtos WHERE tb_chamado_id = $id");
												
												if($SQLProdutos->rowCount()>0){
													?>
														
													
													<div class = "col-md-12">
														<label>Solicitação de Produtos:</label><br/>
													
													<?php
															echo "<a href = 'admin/print/solicitacao.php?id=$id' target = 'blank'><img src = 'admin/images/pdf.png' width = '8%'/></a>";
															
													?>
													
													</div>
													
													
													<?php
													
													
												}
											?>
													
													
											</div>
											
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
											<button name = 'voltar' type = 'submit' class="btn btn-primary">Voltar</a>
											
											
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
									if(isset($_POST['voltar'])){
										$_SESSION['verchamado'] = null;
										echo "<meta http-equiv='refresh' content='0, url='>";
									}
								?>
								
								
							 </div>
	</div>
	</div>
	
			</div>
		</div>
		
		
		
		<?php
			$SQLBusca = $conexao->query("SELECT * FROM tb_anexo WHERE tb_chamado_id = ".$id);
			while($RSBusca = $SQLBusca->fetch()){
				
				?>
																
																<!-- modal saida_departamento -->
																			<div class="modal fade" id="veranexowhats<?php echo $RSBusca['id'];?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
																				<div class="modal-dialog modal-lg" role="document">
																					<form action="" method="post">
																						<div class="modal-content">
																							<div class="modal-header">
																								<h5 class="modal-title" id="mediumModalLabel">Mídia do Whats</h5>
																								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																									<span aria-hidden="true">&times;</span>
																								</button>
																							</div>
																							<div class="modal-body">
																								
																								<div class="form-group row">
																														
																										<div class = "col-md-6">
																											<div id = "app<?php echo $RSBusca['id'];?>"></div>
																											
																											
																											<script>
																												function myFunction() {
																												var str = "<?php echo $RSBusca['anexo'];?>";
																												
																												 var enc = window.atob(str);

																												  var image = new File([enc], "random.jpg", {
																													type: "image/jpeg"
																												  });
																												  var file = b64toBlob(str, "image/jpeg");
																												  var fileb = new File(["akkaka"], "ranom", {
																													type: "image/jpeg"
																												  });
																												  console.log(file.size);
																												  console.log(fileb.size);
																												  var imgURL = URL.createObjectURL(file);
																												  console.log(imgURL);
																												  var res = "Encoded String: " + image;
																												  document.getElementById("app<?php echo $RSBusca['id'];?>").innerHTML = "<img src='" + imgURL + "' />";
																												}

																													myFunction();
																												
																												function b64toBlob(b64Data, contentType, sliceSize) {
																												  contentType = contentType || "";
																												  sliceSize = sliceSize || 512;

																												  var byteCharacters = atob(b64Data);
																												  var byteArrays = [];

																												  for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
																													var slice = byteCharacters.slice(offset, offset + sliceSize);

																													var byteNumbers = new Array(slice.length);
																													for (var i = 0; i < slice.length; i++) {
																													  byteNumbers[i] = slice.charCodeAt(i);
																													}

																													var byteArray = new Uint8Array(byteNumbers);

																													byteArrays.push(byteArray);
																												  }

																												  console.log(byteArrays);

																												  return new File(byteArrays, "pot", { type: contentType });
																												}

																												var arr = new Array(5);

																												arr.map((ab, i) => {
																												  console.log(i);
																												  return 1;
																												});
																												console.log(arr);

																														
																										</script>
																										</div>
																										
																										
																										
																										
																								</div>
																								
																									
																							</div>
																							<div class="modal-footer">
																								<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
																								
																							</div>
																					</form>
																					</div>
																				</div>
																			</div>
													<!-- end modal medium -->
	
																
																
																
																
																<?php

			}				
		
		?>
	
	
	

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->