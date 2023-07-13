 <?php
	if(isset($_GET['id'])){
		
		$id = base64_decode($_GET['id']);
		
		$SQLBusca = $conexao->query("SELECT id, data, documento, tb_empresa_id FROM tb_entrada WHERE id = $id");
		$RSBusca = $SQLBusca->fetch();
		
		$data = date('d/m/Y', strtotime($RSBusca['data']));
		$documento = $RSBusca['documento'];
		
		$empresa = $RSBusca['empresa'];
		
	}
 ?>


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
 
 <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

						<form action="" method="post" enctype="multipart/form-data">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="mediumModalLabel">Nova Entrada</b></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="form-group row">
													<div class = "col-md-2">
														<label>Data</label>
														<input class="au-input au-input--full" type="text" name="data" required onkeyup="mascara(this,'##/##/####')" value = "<?php if(isset($data)){echo $data;}?>" />
													</div>
													
											</div>
											<div class="form-group row">
																	
													<div class = "col-md-4">
														<label>Empresa</label>
														<select class="form-control" name = "empresa">
															<?php
																$SQLBusca = $conexao->query("SELECT * FROM tb_empresa ORDER BY nome");
																while($RSBusca = $SQLBusca->fetch()){
																	?>
																	
																	<option value = "<?php echo $RSBusca['id'];?>" <?php if(isset($empresa)){if($empresa == $RSBusca['id']){echo "selected = 'selected'";}}?>><?php echo $RSBusca['nome'];?></option>
																	
																	<?php
															
																	
																}
															?>
														</select>
													</div>
													
													<div class = "col-md-2">
														<label>Documento</label>
														<input class="au-input au-input--full" type="text" name="documento"  value = "<?php if(isset($documento)){echo $documento;}?>" required />
													</div>
													
													
											</div>
											
																						

												
										</div>
										<div class="modal-footer">
											<a href = "<?php echo '?p='.base64_encode('entradas');?>" class="btn btn-secondary">Cancelar</a>
											<button type = "submit" name = "gravar" class="btn btn-primary">Próximo</button>
										</div>
								</form>
								
								</div>
								
								
								<?php
									if(isset($_POST['gravar'])){
										
										$data = explode('/',$_POST['data']);
										$empresa = $_POST['empresa'];
										$documento = $_POST['documento'];
										
										
										$conexao->query("UPDATE tb_entrada SET data = '".$data[2]."-".$data[1]."-".$data[0]."',documento = '$documento',tb_empresa_id = '$empresa' WHERE id = $id");
										
										echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('produtoentrada')."&id=".base64_encode($id)."'>";
																			
									}
								?>
								
								