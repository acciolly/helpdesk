<?php
	if(isset($_GET['id'])){
		$id = base64_decode($_GET['id']);
		$chamado = base64_decode($_GET['ch']);
		$SQLBusca = $conexao->query("SELECT * FROM tb_anexo WHERE id = $id");
		$RSBusca = $SQLBusca->fetch();
		$anexo = $RSBusca['anexo'];
		
	}
?>


<!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                       <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Visualizar Mídia de Whats</h2>
									<a href = "?p=<?php echo base64_encode('verchamado');?>&id=<?php echo base64_encode($chamado)?>" class="au-btn au-btn-icon au-btn--blue">
											Voltar
										</a>
                                    
																		
                                </div>
                            </div>
                        </div>'
                       <div class="row">
                            <div class="col-lg-12">
                                
								<div class="modal-body">
																								
																								<div class="form-group row">
																														
																										<div class = "col-md-12" align = "center">
																											<div id = "app"></div>
																											
																											
																											<script>
																												function myFunction() {
																												var str = "<?php echo $anexo;?>";
																												
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
																												  document.getElementById("app").innerHTML = "<img src='" + imgURL + "' />";
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
                                
                            </div>
                            
                        </div>
						
						
						
						
						
                        
                       