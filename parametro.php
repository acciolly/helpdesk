

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
    <title>Parametro de Conexão</title>

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

	<?php
		$arquivo = "funcoes/parametro.txt";
				$fp = fopen($arquivo,"r");
				$conteudo = fread($fp, filesize($arquivo));
				fclose($fp);
				
				$parametro = explode(";",$conteudo);
				
				$host = $parametro[0];
				$dbname = $parametro[1];
				$user = $parametro[2];
				$pass = $parametro[3];
	
	?>
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin" width = "100">
								<p>HelpDesk</p>
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Servidor</label>
                                    <input class="au-input au-input--full" type="text" name="host" value = "<?php echo $host;?>"required />
                                </div>
								 <div class="form-group">
                                    <label>Nome do Banco</label>
                                    <input class="au-input au-input--full" type="text" name="bd" value = "<?php echo $dbname;?>"required />
                                </div>
								 <div class="form-group">
                                    <label>Usuário</label>
                                    <input class="au-input au-input--full" type="text" name="uid" value = "<?php echo $user;?>"required />
                                </div>
                                <div class="form-group">
                                    <label>Senha</label>
                                    <input class="au-input au-input--full" type="password" name="senha" value = "<?php echo $pass;?>" />
                                </div>
                                
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name = "configurar">Configurar</button>
                                <div class="social-login-content">
                                   
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
	
	<?php
		if(isset($_POST['configurar'])){
			$host = $_POST['host'];
			$bd = $_POST['bd'];
			$uid = $_POST['uid'];
			$senha = $_POST['senha'];
			
			
			$arquivo = "funcoes/parametro.txt";
			$fp = fopen($arquivo,"w+");
			fwrite($fp,"$host;$bd;$uid;$senha;");
			fclose($fp);
			echo "<meta http-equiv='refresh' content='0, url=/helpdesk'>";
			
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