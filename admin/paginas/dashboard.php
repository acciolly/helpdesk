<?php
	if(isset($_GET['p'])){
		$p = base64_decode($_GET['p']);
		
		if($p == "sair"){
			session_destroy();
			echo "<meta http-equiv='refresh' content='0, url=?p'>";
		}
	}
	
	$BuscaUser = $conexao->query("SELECT * FROM tb_usuario WHERE id = ".$_SESSION['login']);
	$RSUser = $BuscaUser->fetch();
	$nomeUser = $RSUser['nome'];
	$admin = $RSUser['admin'];
	$chamados = $RSUser['chamados'];
	$estoque = $RSUser['estoque'];
	$patrimonio = $RSUser['patrimonio'];
	
											
	?>


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
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
	<link href="vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
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
	<link href="css/galeria.css" rel="stylesheet" media="all">
	
	<link href="external/google-code-prettify/prettify.css" rel="stylesheet">
	<script src="external/jquery.hotkeys.js"></script>
    <script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
    <script src="external/google-code-prettify/prettify.js"></script>
	<link href="index.css" rel="stylesheet" />
    <script src="bootstrap-wysiwyg.js"></script>
	<script type="text/javascript" src="js/jquery-2.1.0.js"></script>
	
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	
	<script type="text/javascript">
	
			function Limpar(valor, validos) {
		// retira caracteres invalidos da string
		var result = "";
		var aux;
		for (var i=0; i < valor.length; i++) {
		aux = validos.indexOf(valor.substring(i, i+1));
		if (aux>=0) {
		result += aux;
		}
		}
		return result;
		}

		//Formata número tipo moeda usando o evento onKeyDown

		function Formata(campo,tammax,teclapres,decimal) {
		var tecla = teclapres.keyCode;
		vr = Limpar(campo.value,"0123456789");
		tam = vr.length;
		dec=decimal

		if (tam < tammax && tecla != 8){ tam = vr.length + 1 ; }

		if (tecla == 8 )
		{ tam = tam - 1 ; }

		if ( tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105 )
		{

		if ( tam <= dec )
		{ campo.value = vr ; }

		if ( (tam > dec) && (tam <= 5) ){
		campo.value = vr.substr( 0, tam - 2 ) + "," + vr.substr( tam - dec, tam ) ; }
		if ( (tam >= 6) && (tam <= 8) ){
		campo.value = vr.substr( 0, tam - 5 ) + "." + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - dec, tam ) ; 
		}
		if ( (tam >= 9) && (tam <= 11) ){
		campo.value = vr.substr( 0, tam - 8 ) + "." + vr.substr( tam - 8, 3 ) + "." + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - dec, tam ) ; }
		if ( (tam >= 12) && (tam <= 14) ){
		campo.value = vr.substr( 0, tam - 11 ) + "." + vr.substr( tam - 11, 3 ) + "." + vr.substr( tam - 8, 3 ) + "." + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - dec, tam ) ; }
		if ( (tam >= 15) && (tam <= 17) ){
		campo.value = vr.substr( 0, tam - 14 ) + "." + vr.substr( tam - 14, 3 ) + "." + vr.substr( tam - 11, 3 ) + "." + vr.substr( tam - 8, 3 ) + "." + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - 2, tam ) ;}
		} 

		}
			
		function mascaraData(val) {
		  var pass = val.value;
		  var expr = /[0123456789]/;

		  for (i = 0; i < pass.length; i++) {
			// charAt -> retorna o caractere posicionado no índice especificado
			var lchar = val.value.charAt(i);
			var nchar = val.value.charAt(i + 1);

			if (i == 0) {
			  // search -> retorna um valor inteiro, indicando a posição do inicio da primeira
			  // ocorrência de expReg dentro de instStr. Se nenhuma ocorrencia for encontrada o método retornara -1
			  // instStr.search(expReg);
			  if ((lchar.search(expr) != 0) || (lchar > 3)) {
				val.value = "";
			  }

			} else if (i == 1) {

			  if (lchar.search(expr) != 0) {
				// substring(indice1,indice2)
				// indice1, indice2 -> será usado para delimitar a string
				var tst1 = val.value.substring(0, (i));
				val.value = tst1;
				continue;
			  }

			  if ((nchar != '/') && (nchar != '')) {
				var tst1 = val.value.substring(0, (i) + 1);

				if (nchar.search(expr) != 0)
				  var tst2 = val.value.substring(i + 2, pass.length);
				else
				  var tst2 = val.value.substring(i + 1, pass.length);

				val.value = tst1 + '/' + tst2;
			  }

			} else if (i == 4) {

			  if (lchar.search(expr) != 0) {
				var tst1 = val.value.substring(0, (i));
				val.value = tst1;
				continue;
			  }

			  if ((nchar != '/') && (nchar != '')) {
				var tst1 = val.value.substring(0, (i) + 1);

				if (nchar.search(expr) != 0)
				  var tst2 = val.value.substring(i + 2, pass.length);
				else
				  var tst2 = val.value.substring(i + 1, pass.length);

				val.value = tst1 + '/' + tst2;
			  }
			}

			if (i >= 6) {
			  if (lchar.search(expr) != 0) {
				var tst1 = val.value.substring(0, (i));
				val.value = tst1;
			  }
			}
		  }

		  if (pass.length > 10)
			val.value = val.value.substring(0, 10);
		  return true;
		}

		// INICIO FUNÇÃO DE MASCARA MAIUSCULA
		function maiuscula(z){
				v = z.value.toUpperCase();
				z.value = v;
			}
		//FIM DA FUNÇÃO MASCARA MAIUSCULA
	</script>

	<script language="JavaScript">
		 /*
		 A função Mascara tera como valores no argumento os dados inseridos no input (ou no evento onkeypress)
		 onkeypress="mascara(this, '## ####-####')"
		 onkeypress = chama uma função quando uma tecla é pressionada, no exemplo acima, chama a função mascara e define os valores do argumento na função
		 O primeiro valor é o this, é o Apontador/Indicador da Mascara, o '## ####-####' é o modelo / formato da mascara
		 no exemplo acima o # indica os números, e o - (hifen) o caracter que será inserido entre os números, ou seja, no exemplo acima o telefone ficara assim: 11-4000-3562
		 para o celular de são paulo o modelo deverá ser assim: '## #####-####' [11 98563-1254]
		 para o RG '##.###.###.# [40.123.456.7]
		 para o CPF '###.###.###.##' [789.456.123.10]
		 Ou seja esta mascara tem como objetivo inserir o hifen ou espaço automáticamente quando o usuário inserir o número do celular, cpf, rg, etc 

		 lembrando que o hifen ou qualquer outro caracter é contado tambem, como: 11-4561-6543 temos 10 números e 2 hifens, por isso o valor de maxlength será 12
		 <input type="text" name="telefone" onkeypress="mascara(this, '## ####-####')" maxlength="12">
		 neste código não é possivel inserir () ou [], apenas . (ponto), - (hifén) ou espaço
		 */

		 function mascara(t, mask){
		 var i = t.value.length;
		 var saida = mask.substring(1,0);
		 var texto = mask.substring(i)
		 if (texto.substring(0,1) != saida){
		 t.value += texto.substring(0,1);
		 }
		 }
	</script>
	
	
	<script>
		var cache = {};

		$(document).ready(function() {
			addKeyupEvent($('#criterio'));
		}   

		function addKeyupEvent(element) {
			element.keyup(function(e) {
				var keyword = $(this).val();
				clearTimeout($.data(this, 'timer'));

				if (e.keyCode == 13)
					updateListData(search(keyword, true));
				else
					$(this).data('timer', setTimeout(function(){
						updateListData(search(keyword));
					}, 500));
			});
		}

		function search(keyword, force) {
			if (!force && keyword.length < 4) 
				return '';

			if(cache.hasOwnProperty(keyword))
				return cache[keyword];

			$.ajax({
				type: 'POST',
				url:  'busca_produto.php',
				async: false,
				data: {
				   nome: keyword
				},
				success: function(data) {
				   cache[keyword] = data;
				   return data;
				},
				error: function() {
					throw new Error('Error occured');
				}
			});
		}

		function updateListData(data) {
			 $('#resultado').html(data);
		}
 
 </script>
	
	
	
	
	
												

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="../images/icon/logo.png" alt="CoolAdmin" width = "50%"/>
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        
						<li>
                             <a href="<?php echo '?p='.base64_encode('dash');?>">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
						<?php
							if($chamados == 1){
						?>
						<li>
                            <a href="<?php echo '?p='.base64_encode('chamados');?>">
                                <i class="bi bi-layout-text-sidebar-reverse"></i>Chamados</a>
                        </li>
							<?php } ?>
						
							<?php
								if($estoque == 1){
							
							?>
							<li class="has-sub">
								<a class="js-arrow" href="#">
									<i class="bi bi-boxes"></i>Controle de Estoque</a>
								<ul class="list-unstyled navbar__sub-list js-sub-list"  <?php if(isset($_GET['p'])){$pag = base64_decode($_GET['p']); if($pag == "estoques" || $pag == "tiposproduto" || $pag == "fabricantes" || $pag == "produtos" || $pag == "entradas" || $pag == "saidas" || $pag == "empresas"){echo "style = 'display: block;'";}}?> >
									<li>
										<a href="<?php echo '?p='.base64_encode('estoques');?>">
											<i class="bi bi-house"></i>Estoques</a>
									</li>
									
									<li>
										<a href="<?php echo '?p='.base64_encode('tiposproduto');?>">
											<i class="fas fa-newspaper"></i>Tipos de Produto</a>
									</li>
									
									<li>
										<a href="<?php echo '?p='.base64_encode('fabricantes');?>">
											<i class="bi bi-clipboard-check"></i>Fabricantes</a>
									</li>
									
									<li>
										<a href="<?php echo '?p='.base64_encode('produtos');?>">
											<i class="bi bi-box"></i>Produto</a>
									</li>
									<li>
										<a href="<?php echo '?p='.base64_encode('empresas');?>">
											<i class="bi bi-bank2"></i>Empresas</a>
									</li>
									<li>
										<a href="<?php echo '?p='.base64_encode('entradas');?>">
											<i class="bi bi-download"></i>Entradas</a>
									</li>
									<li>
										<a href="<?php echo '?p='.base64_encode('saidas');?>">
											<i class="bi bi-upload"></i>Saídas</a>
									</li>
									<li>
										<a href="<?php echo '?p='.base64_encode('relatorios_estoque');?>">
											<i class="fa fa-print"></i>Relatórios</a>
									</li>
								</ul>
							</li>
							
								<?php } ?>
								
								<?php
								if($patrimonio == 1){
							
							?>
									<li class="has-sub">
										<a class="js-arrow" href="#">
											<i class="bi bi-archive"></i>Controle de Patrimônio</a>
											<ul class="list-unstyled navbar__sub-list js-sub-list"   <?php if(isset($_GET['p'])){$pag = base64_decode($_GET['p']); if($pag == "patrimonios" || $pag == "tipospatrimonio" || $pag == "manutencoes"){echo "style = 'display: block;'";}}?>>
												<li>
													<a href="<?php echo '?p='.base64_encode('patrimonios');?>">
														<i class="bi bi-clipboard"></i>Patrimônios</a>
												</li>
												
												<li>
													<a href="<?php echo '?p='.base64_encode('tipospatrimonio');?>">
														<i class="bi bi-clipboard-data"></i>Tipo de Patrimônio</a>
												</li>
												
												<li>
													<a href="<?php echo '?p='.base64_encode('manutencoes');?>">
														<i class="bi bi-tools"></i>Manutenções</a>
												</li>
												
											</ul>
									</li>
							
								<?php } ?>
								
								<?php
							if($admin == 1){
						?>
						<li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>Administração</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list" <?php if(isset($_GET['p'])){$pag = base64_decode($_GET['p']); if($pag == "usuarios" || $pag == "categorias" || $pag == "usuario_categoria" || $pag == "setores" || $pag == "departamentos"){echo "style = 'display: block;'";}}?>>
								<li>
									<a href="<?php echo '?p='.base64_encode('usuarios');?>">
										<i class="fas fa-user"></i>Usuários</a>
								</li>
								
								<li>
									<a href="<?php echo '?p='.base64_encode('categorias');?>">
										<i class="fas fa-align-justify"></i>Categorias</a>
								</li>
								
								<li>
									<a href="<?php echo '?p='.base64_encode('usuario_categoria');?>">
										<i class="fas fa-address-card"></i>Usuários x Categ.</a>
								</li>
								<li>
									<a href="<?php echo '?p='.base64_encode('setores');?>">
										<i class="bi bi-bank2"></i>Setores</a>
								</li>
								<li>
									<a href="<?php echo '?p='.base64_encode('departamentos');?>">
										<i class="bi bi-house-door"></i>Departamentos</a>
								</li>
							</ul>
						</li>
						
							<?php } ?>
						
											
						
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="images/icon/logo.png" alt="Cool Admin" width = "70%" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                       						
						<li>
                             <a href="<?php echo '?p='.base64_encode('dash');?>">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
						<?php
							if($chamados == 1){
						?>
						<li>
                            <a href="<?php echo '?p='.base64_encode('chamados');?>">
                                <i class="bi bi-layout-text-sidebar-reverse"></i>Chamados</a>
                        </li>
							<?php } ?>
						
							<?php
								if($estoque == 1){
							
							?>
							<li class="has-sub">
								<a class="js-arrow" href="#">
									<i class="bi bi-boxes"></i>Controle de Estoque</a>
								<ul class="list-unstyled navbar__sub-list js-sub-list"  <?php if(isset($_GET['p'])){$pag = base64_decode($_GET['p']); if($pag == "estoques" || $pag == "tiposproduto" || $pag == "fabricantes" || $pag == "produtos" || $pag == "entradas" || $pag == "saidas" || $pag == "empresas"){echo "style = 'display: block;'";}}?> >
									<li>
										<a href="<?php echo '?p='.base64_encode('estoques');?>">
											<i class="bi bi-house"></i>Estoques</a>
									</li>
									
									<li>
										<a href="<?php echo '?p='.base64_encode('tiposproduto');?>">
											<i class="fas fa-newspaper"></i>Tipos de Produto</a>
									</li>
									
									<li>
										<a href="<?php echo '?p='.base64_encode('fabricantes');?>">
											<i class="bi bi-clipboard-check"></i>Fabricantes</a>
									</li>
									
									<li>
										<a href="<?php echo '?p='.base64_encode('produtos');?>">
											<i class="bi bi-box"></i>Produto</a>
									</li>
									<li>
										<a href="<?php echo '?p='.base64_encode('empresas');?>">
											<i class="bi bi-bank2"></i>Empresas</a>
									</li>
									<li>
										<a href="<?php echo '?p='.base64_encode('entradas');?>">
											<i class="bi bi-download"></i>Entradas</a>
									</li>
									<li>
										<a href="<?php echo '?p='.base64_encode('saidas');?>">
											<i class="bi bi-upload"></i>Saídas</a>
									</li>
									<li>
										<a href="<?php echo '?p='.base64_encode('relatorios_estoque');?>">
											<i class="fa fa-print"></i>Relatórios</a>
									</li>
								</ul>
							</li>
							
								<?php } ?>
								
								<?php
								if($patrimonio == 1){
							
							?>
									<li class="has-sub">
										<a class="js-arrow" href="#">
											<i class="bi bi-archive"></i>Controle de Patrimônio</a>
											<ul class="list-unstyled navbar__sub-list js-sub-list"   <?php if(isset($_GET['p'])){$pag = base64_decode($_GET['p']); if($pag == "patrimonios" || $pag == "tipospatrimonio" || $pag == "manutencoes"){echo "style = 'display: block;'";}}?>>
												<li>
													<a href="<?php echo '?p='.base64_encode('patrimonios');?>">
														<i class="bi bi-clipboard"></i>Patrimônios</a>
												</li>
												
												<li>
													<a href="<?php echo '?p='.base64_encode('tipospatrimonio');?>">
														<i class="bi bi-clipboard-data"></i>Tipo de Patrimônio</a>
												</li>
												
												<li>
													<a href="<?php echo '?p='.base64_encode('manutencoes');?>">
														<i class="bi bi-tools"></i>Manutenções</a>
												</li>
												
											</ul>
									</li>
							
								<?php } ?>
								
								<?php
							if($admin == 1){
						?>
						<li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>Administração</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list" <?php if(isset($_GET['p'])){$pag = base64_decode($_GET['p']); if($pag == "usuarios" || $pag == "categorias" || $pag == "usuario_categoria" || $pag == "setores" || $pag == "departamentos"){echo "style = 'display: block;'";}}?>>
								<li>
									<a href="<?php echo '?p='.base64_encode('usuarios');?>">
										<i class="fas fa-user"></i>Usuários</a>
								</li>
								
								<li>
									<a href="<?php echo '?p='.base64_encode('categorias');?>">
										<i class="fas fa-align-justify"></i>Categorias</a>
								</li>
								
								<li>
									<a href="<?php echo '?p='.base64_encode('usuario_categoria');?>">
										<i class="fas fa-address-card"></i>Usuários x Categ.</a>
								</li>
								<li>
									<a href="<?php echo '?p='.base64_encode('setores');?>">
										<i class="bi bi-bank2"></i>Setores</a>
								</li>
								<li>
									<a href="<?php echo '?p='.base64_encode('departamentos');?>">
										<i class="bi bi-house-door"></i>Departamentos</a>
								</li>
							</ul>
						</li>
						
							<?php } ?>
                        
                        						
                        
                        
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <div class = "col-md-6"></div>
                            <div class="header-button">
                               
								
									<div class="account-wrap">
										<div class="account-item clearfix js-item-menu">
											<div class="image">
												<img src="images/icon/user.png" alt="John Doe" />
											</div>
											<div class="content">
											
												<a class="js-acc-btn" href="#"><?php echo $nomeUser;?></a>
											</div>
											<div class="account-dropdown js-dropdown">
												
												<div class="account-dropdown__body">
													<div class="account-dropdown__item">
														<a href="#">
															<i class="zmdi zmdi-account"></i>Minha Conta
														</a>
													</div>
													
													
												</div>
												<div class="account-dropdown__footer">
													<a href="<?php echo '?p='.base64_encode('sair');?>">
														<i class="zmdi zmdi-power"></i>Sair
													</a>
												</div>
											</div>
										</div>
									</div>
								
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

				<?php
					if(isset($_GET['p'])){
						if($_GET['p'] != ""){
							$p = base64_decode($_GET['p']);
						}else{
							$p = "dash";
						}
					}else{
						$p = "dash";
					}
					
					if(file_exists("paginas/subpaginas/".$p.".php")){
						require_once "paginas/subpaginas/".$p.".php";
					}else{
						echo "Página em construção";
					}	
				?>
				
				 <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © <?php echo date('Y');?> Departamento de Tecnologia - Prefeitura de Campo Novo do Parecis</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            
            <!-- END PAGE CONTAINER-->
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
	
	<script src="js/galeria.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
