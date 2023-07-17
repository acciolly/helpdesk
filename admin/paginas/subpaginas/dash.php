<!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                       <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1"></h2>
                                    
																			
                                </div>
                            </div>
                        </div>'
                       <div class="row">
                            <div class="col-lg-12">
							
							<form action="" method="post" enctype="multipart/form-data">
									<div class="modal-content">
										<div class="modal-header">
											
										</div>
										<div class="modal-body">
										<div class = "row col-md-12">
											<div class = "col-md-6">
												<?php
													$SQLBusca = $conexao->query("SELECT * FROM tb_chamado");
													$abertos = 0;
													$encerrados = 0;
													
													while($RSBusca = $SQLBusca->fetch()){
														
														if($RSBusca['finalizado'] == 0){
															$abertos++;
														}else if($RSBusca['finalizado'] == 1){
															$encerrados++;
														}
													}
												?>
												<input type = "text" id = "abertos" value = "<?php echo $abertos;?>" style = "display:none;"/>
												<input type = "text" id = "encerrados" value = "<?php echo $encerrados;?>"  style = "display:none;" />
									
												<div id="piechart"></div>
											
											</div>
											
											<div class = "col-md-6">
												<?php
													$arrCat = array();
													$arrQtd = array();
													$SQLCat = $conexao->query("SELECT * FROM tb_categoria");
													while($RSCat = $SQLCat->fetch()){
														
														$SQLQTDChamado = $conexao->query("SELECT COUNT(id) AS qtd FROM tb_chamado WHERE tb_categoria_id = ".$RSCat['id']);
														$RSQTDChamado = $SQLQTDChamado->fetch();
														array_push($arrCat, $RSCat['nome']);
														array_push($arrQtd, $RSQTDChamado['qtd']);
														
														
													}
												?>
												
												<div id="ch_cat"></div>
											</div>
										</div>
											
											
									
										</div>
									
									</div>
									
							</form>
                                
                                
                            </div>
                            
                        </div>
						
						
						<script type="text/javascript">
								google.charts.load('current', {'packages':['corechart']});
								google.charts.setOnLoadCallback(drawChart);
								var abertos = parseInt(document.getElementById('abertos').value);
								var encerrados = parseInt(document.getElementById('encerrados').value);
								  function drawChart() {
									
									var data = google.visualization.arrayToDataTable([
									  ['Task', 'Chamados'],
									  ['Abertos',  abertos],
									  ['Encerrados',      encerrados]
									  
									]);

									var options = {
									  title: 'Chamados Abertos e Encerrados'
									};

									var chart = new google.visualization.PieChart(document.getElementById('piechart'));

									chart.draw(data, options);
								  }
						</script>
						
						
						<script type="text/javascript">
								google.charts.load('current', {'packages':['corechart']});
								google.charts.setOnLoadCallback(drawChart);
								
								 function drawChart() {
									
									var data = google.visualization.arrayToDataTable([
									  ['Task', 'Chamados'],
									  <?php
										for($i=0; $i < count($arrCat); $i++){
											
											echo "['".$arrCat[$i]."',".$arrQtd[$i]."],";
											
										}
									  ?>
									  
									  
									  
									]);

									var options = {
									  title: 'Chamados por categoria'
									};

									var chart = new google.visualization.PieChart(document.getElementById('ch_cat'));

									chart.draw(data, options);
								  }
						</script>
						
						
                        
                       