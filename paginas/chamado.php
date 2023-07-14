

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
	

</head>

<body class="animsition">
    <div class="">
        <div class="page-content--bge5">
            <div class="container">
                
				<?php
					if(isset($_SESSION['setor'])){
						if(isset($_SESSION['departamento'])){
							if(isset($_SESSION['categoria'])){
								if(isset($_SESSION['solicitacao'])){
									if(isset($_SESSION['anexo'])){
										$pagina = "finalizar";
									}else{
										$pagina = "anexo";
									}
								}else{								
									$pagina = "solicitacao";
								}
							}else{
								$pagina = "categoria";
							}
						}else{
							$pagina = "departamento";
						}
					}else{
						$pagina = "setor";
					}
					
					if(file_exists("paginas/subpaginas/".$pagina.".php")){
						require_once "paginas/subpaginas/".$pagina.".php";
					}else{
						echo "Página em construção";
					}	
				?>
				
				
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