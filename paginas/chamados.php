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
    <title>Helpdesk</title>

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
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
              
			  
			  
			  <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
						<div class="modal-content">
						
						<form method = "post">
										<div class="modal-header">
											<h5 class="modal-title" id="mediumModalLabel"></b></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
										
										
                       <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Chamados Registrados</h2>
									
									<button type = "submit" name = "novochamado" class="au-btn au-btn-icon au-btn--blue">
											<i class="zmdi zmdi-plus"></i>Novo Chamado
									</button>
                                    
																			
                                </div>
                            </div>
                        </div>'
                       <div class="row">
                            <div class="col-lg-12">
                                
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th colspan = "2">Data</th>
												<th>Protocolo</th>
												<th>Departamento</th>
												<th>Finalizado</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										
										
										
											<?php
												$SQLBusca = $conexao->query("SELECT tb_chamado.id, tb_chamado.data, tb_chamado.protocolo, tb_chamado.hora, tb_pessoa.nome AS solicitante, tb_departamento.nome AS departamento, tb_chamado.finalizado FROM tb_chamado INNER JOIN tb_pessoa ON tb_chamado.tb_pessoa_id = tb_pessoa.id INNER JOIN tb_departamento ON tb_chamado.tb_departamento_id = tb_departamento.id WHERE tb_pessoa_id = ".$_SESSION['solicitante']." ORDER BY tb_chamado.id DESC");
												while($RSBusca = $SQLBusca->fetch()){
																									
													echo "<tr>
															  <td><button type = 'submit' value = '".$RSBusca['id']."' name = 'idchamado'><i class = 'fa fa-eye'></i></button></td>
															  <td>".date('d/m/Y', strtotime($RSBusca['data']))."</td>
															  <td>".$RSBusca['protocolo']."</td>
															  <td>".$RSBusca['departamento']."</td>
															  <td>".$RSBusca['finalizado']."</td>
															
															  
														  </tr>";
													
												}
											
											?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
					</div>
					
					<div class="modal-footer">
											
						<button type = "submit" name = "sair" class="btn btn-primary">Sair</button>
						
					</div>
					
					</form>
				</div>
			</div>
						
						
						<?php
							if(isset($_POST['novochamado'])){
								$_SESSION['chamar'] = "OK";
								echo "<meta http-equiv='refresh' content='0, url='>";
							}
							
							if(isset($_POST['idchamado'])){
								$_SESSION['verchamado'] = $_POST['idchamado'];
								echo "<meta http-equiv='refresh' content='0, url='>";
							}
							
							if(isset($_POST['sair'])){
								session_destroy();
								echo "<meta http-equiv='refresh' content='0, url='>";
							}
						?>
						
                        
                       
			  
			  
            </div>
        </div>

    </div>
	</div>
	</div>
	

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