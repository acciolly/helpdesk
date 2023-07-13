 <script type="text/javascript">
	$(document).ready(function(){

    document.getElementById('produto_saida').focus();
	//Aqui a ativa a imagem de load
    function loading_show(){
		$('#loading').html("<img src='images/loading.gif' width = '30%'/>").fadeIn('fast');
    }
    
    //Aqui desativa a imagem de loading
    function loading_hide(){
        $('#loading').fadeOut('fast');
    }       
    
    
    // aqui a função ajax que busca os dados em outra pagina do tipo html, não é json
    function load_dados(valores, page, div)
    {
        $.ajax
            ({
                type: 'POST',
                dataType: 'html',
                url: page,
                beforeSend: function(){//Chama o loading antes do carregamento
		              loading_show();
				},
                data: valores,
                success: function(msg)
                {
                    loading_hide();
                    var data = msg;
			        $(div).html(data).fadeIn();				
                }
            });
    }
    
    //Aqui eu chamo o metodo de load pela primeira vez sem parametros para pode exibir todos
    load_dados(null, 'pesquisa.php', '#resultado');
    
    
    //Aqui uso o evento key up para começar a pesquisar, se valor for maior q 0 ele faz a pesquisa
    $('#criterio_saida').keyup(function(){
        
        var valores = $('#form_pesquisa').serialize()//o serialize retorna uma string pronta para ser enviada
        
        //pegando o valor do campo #pesquisaCliente
        var $parametro = $(this).val();
		
		
        
        if($parametro.length >= 1)
        {
			
            load_dados(valores, 'pesquisa.php', '#resultado');
        }else
        {
            load_dados(null, 'pesquisa.php', '#resultado');
        }
    });
	
	
	
	
	 $('#produto_saida').blur(function(){
        
        var valores = $('#inclui_item').serialize()//o serialize retorna uma string pronta para ser enviada
        
        //pegando o valor do campo #pesquisaCliente
        var $parametro = $(this).val();
		
		
        
        if($parametro.length >= 1)
        {
			
            load_dados(valores, 'pesquisa.php', '#mostra_produto');
        }else
        {
            load_dados(null, 'pesquisa.php', '#mostra_produto');
        }
    });

	});
	</script>
 
 
	<script>
		
		// Formata o campo valor fonte: www.BB.com.br
	function formataValor(campo) {
	campo.value = filtraCampoValor(campo); 
	vr = campo.value;
	tam = vr.length;

	if ( tam <= 2 ){ 
 		campo.value = vr ; }
 	if ( (tam > 2) && (tam <= 5) ){
 		campo.value = vr.substr( 0, tam - 2 ) + ',' + vr.substr( tam - 2, tam ) ; }
 	if ( (tam >= 6) && (tam <= 8) ){
 		campo.value = vr.substr( 0, tam - 5 ) + '.' + vr.substr( tam - 5, 3 ) + ',' + vr.substr( tam - 2, tam ) ; }
 	if ( (tam >= 9) && (tam <= 11) ){
 		campo.value = vr.substr( 0, tam - 8 ) + '.' + vr.substr( tam - 8, 3 ) + '.' + vr.substr( tam - 5, 3 ) + ',' + vr.substr( tam - 2, tam ) ; }
 	if ( (tam >= 12) && (tam <= 14) ){
 		campo.value = vr.substr( 0, tam - 11 ) + '.' + vr.substr( tam - 11, 3 ) + '.' + vr.substr( tam - 8, 3 ) + '.' + vr.substr( tam - 5, 3 ) + ',' + vr.substr( tam - 2, tam ) ; }
 	if ( (tam >= 15) && (tam <= 18) ){
 		campo.value = vr.substr( 0, tam - 14 ) + '.' + vr.substr( tam - 14, 3 ) + '.' + vr.substr( tam - 11, 3 ) + '.' + vr.substr( tam - 8, 3 ) + '.' + vr.substr( tam - 5, 3 ) + ',' + vr.substr( tam - 2, tam ) ;}
 		
}

//fonte: www.BB.com.br
function filtraCampoValor(campo){
	var s = "";
	var cp = "";
	vr = campo.value;
	tam = vr.length;
	for (i = 0; i < tam ; i++) {  
		if (vr.substring(i,i + 1) >= "0" && vr.substring(i,i + 1) <= "9"){
		 	s = s + vr.substring(i,i + 1);}
	} 
	campo.value = s;
	return cp = campo.value
}
	
	</script>
 
 
 
 
 <?php
	if(isset($_GET['id'])){
		
		$id = base64_decode($_GET['id']);
		
		if(isset($_GET['ex'])){
			
			$ex = base64_decode($_GET['ex']);
			
			$conexao->query("DELETE FROM tb_produto_saida WHERE id = $ex");
			echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('produtosaida')."&id=".base64_encode($id)."'>";
									
			
		}
		
	}
 ?>
 
 
 
 
 <!-- modal produtos -->
						<div class="modal fade" id="produtos" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<form action="" method="post" id = "form_pesquisa">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="mediumModalLabel">Buscar Produto</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class = "container">
												<div class="form-group row">
														<div class = "col-md-10">
															<input type = "text" name = "criterio_saida" id = "criterio_saida" class = "form-control" tabindex="1" placeholder = "Informe o nome do produto..." />
														</div>
														<div class = "col-md-2" id = "loading" align = "center">
															
														</div>
												</div>
												
												<div class="form-group row">
														
														<div class = "col-md-12" id = "resultado">
															
														</div>
												</div>
											</div>
												
										</div>
										<div class="modal-footer">
											<button type = 'submit' name = 'selecionar' class="btn btn-primary">Selecionar</button></a>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
											
										</div>
								</form>
								</div>
							</div>
						</div>
<!-- end modal medium -->


 
 <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

						<form action="" method="post" enctype="multipart/form-data" id="inclui_item" name = "inclui_item">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="mediumModalLabel">Nova Saída</b></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="form-group row">
												<div class = "col-md-2">
														<label>Cód Produto</label>
														<input class="au-input au-input--full" type="text" id = "produto_saida" name="produto_saida" value = "<?php if(isset($_POST['selecionar'])){echo $_POST['opcao'];}?>"/>
												</div>
												
												<div class = "col-md-1" style = "padding-top: 35px">
														<a href = "#" data-toggle="modal" data-target="#produtos"><img src = "images/search.png" width = "40%"/></a>
												</div>	
											</div>
											<div class = "form-group row" id = "mostra_produto">
												
												
											</div>
											
											<div class="form-group row">
												<div class = "col-md-2">
														<label>Quantidade</label>
														<input class="au-input au-input--full" type="text" name="quantidade" />
												</div>
												
												<div class = "col-md-2" style = "padding-top:35px;">
														<button type = "submit" name = "adicionar" class="btn btn-primary btn-block">Adicionar</button>
												</div>
											</div>
											
											<div class = "form-group row">
												<div class = "col-md-12">
													<div class="table-responsive table--no-card m-b-40">
														<table class="table table-borderless table-striped table-earning">
															<thead>
																<tr>
																	<th colspan = "2">Produto</th>
																	<th>Fabricante</th>
																	<th>Quantidade</th>
																	
																</tr>
																
															</thead>
															<tbody>
															
																<?php
																	$SQLBusca = $conexao->query("SELECT tb_produto_saida.id, tb_produto.nome AS produto, tb_fabricante.nome AS fabricante, tb_produto_saida.qtd FROM tb_produto_saida INNER JOIN tb_produto_entrada ON tb_produto_saida.tb_produto_entrada_id = tb_produto_entrada.id INNER JOIN tb_produto ON tb_produto_entrada.tb_produto_id = tb_produto.id INNER JOIN tb_fabricante ON tb_produto_entrada.tb_fabricante_id = tb_fabricante.id WHERE tb_produto_saida.tb_saida_id = $id");
																	while($RSBusca = $SQLBusca->fetch()){
																		
																		echo "<tr>
																			  <td width = '10%'><a href='?p=".base64_encode('produtosaida')."&id=".base64_encode($id)."&ex=".base64_encode($RSBusca['id'])."' title = 'Excluir Item'><i class = 'fa fa-times'></i></a></td>
																			  <td>".$RSBusca['produto']."</td>
																			  <td>".$RSBusca['fabricante']."</td>
																			  <td>".$RSBusca['qtd']."</td>
																			  
																			  </tr>";
																	
																		
																	}
																?>
															
															</tbody>
														</table>
												</div>
											
											</div>
										</div>
										<div class="modal-footer">
											<a href = "<?php echo '?p='.base64_encode('editasaida').'&id='.base64_encode($id);?>" class="btn btn-secondary">Voltar</a>
											<button type = "submit" name = "finalizar" class="btn btn-primary">Finalizar</button>
										</div>
								</form>
								
								</div>
								
														
								
								
								<?php
									if(isset($_POST['adicionar'])){
										$quantidade = $_POST['quantidade'];
										$lote = $_POST['lote'];
										
										$SQLSaldo = $conexao->query("SELECT * FROM v_produtosaida WHERE id = $lote");
										$RSSaldo = $SQLSaldo->fetch();
										
										if($RSSaldo['saldo'] < $quantidade){
											echo "<script>alert('Quantidade insulficiente para a operação! Tente alterar a quantidade para ".$RSSaldo['saldo']." ou menos.')</script>";
										}else{
											
											$conexao->query("INSERT INTO tb_produto_saida(tb_produto_entrada_id, qtd, tb_saida_id) VALUES($lote,'$quantidade',$id)");
										echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('produtosaida')."&id=".base64_encode($id)."'>";
									
										}
										
									}
									if(isset($_POST['finalizar'])){
										
										echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('saidas')."'>";
																			
									}
								?>
								
								