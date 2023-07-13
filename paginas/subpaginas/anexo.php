<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

						<form action="" method="post" enctype="multipart/form-data">
								<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="mediumModalLabel">Anexe algum arquivo ou prossiga para finalizar o chamado.</b></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											
											
											<div class="form-group row">
													<div class = "col-md-12">
														<label>Descrição</label>
														<input class="au-input au-input--full" type="text" name="descricao_arquivo" placeholder="Descrição" onkeyup="maiuscula(this)"/>
													</div>
													
											</div>
												
											<div class="form-group row">
													<div class = "col-md-12">
														<label>Arquivo</label>
														<input name="arquivo" id = "arquivo" type="file" />
														<button type = "submit" name = "anexar" class="btn btn-primary">Anexar</button>
													</div>
													
											</div>
											
											 <div class="row">
                            <div class="col-lg-12">
                                
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th colspan = "3" width = "60%">Anexo</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										
											<?php
												$SQLBusca = $conexao->query("SELECT * FROM tb_anexo WHERE tb_chamado_id = ".$_SESSION['solicitacao']);
												while($RSBusca = $SQLBusca->fetch()){
													
													
													echo "<tr>
														  <td width = '10%'><a href='#' title = 'Excluir Item'><i class = 'fa fa-times'></i></a></td>
														  <td>".$RSBusca['descricao']."</td>";
													
												}
											
											?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
											
																						
											
												

												
										</div>
										<div class="modal-footer">
											
											<button type = "submit" name = "avancar" class="btn btn-primary">Avançar</button>
										</div>
						
								
								</div>
						</form>
					</div>
				</div>
</div>


<?php
 
	if(isset($_POST['anexar'])){
	if(isset($_FILES['arquivo']['name']) && $_FILES["arquivo"]["error"] == 0)
	{

		$arquivo_tmp = $_FILES['arquivo']['tmp_name'];
		$nome = $_FILES['arquivo']['name'];
		

		// Pega a extensao
		$extensao = strrchr($nome, '.');

		// Converte a extensao para mimusculo
		$extensao = strtolower($extensao);

		// Somente imagens, .jpg;.jpeg;.gif;.png
		// Aqui eu enfilero as extesões permitidas e separo por ';'
		// Isso server apenas para eu poder pesquisar dentro desta String
		if(strstr('.jpg;.jpeg;.gif;.png;.pdf;.doc;.docx', $extensao))
		{
			// Cria um nome único para esta imagem
			// Evita que duplique as imagens no servidor.
			$novoNome = md5(microtime()) . $extensao;
			
			// Concatena a pasta com o nome
			$destino = 'uploads/'.$novoNome; 
						
			// tenta mover o arquivo para o destino
			if( @move_uploaded_file( $arquivo_tmp, $destino  ))
			{
				$arquivo = "uploads/".$novoNome;
				$descricao = $_POST['descricao_arquivo'];
				$solicitacao = $_SESSION['solicitacao'];
				$conexao->query("INSERT INTO tb_anexo(descricao,anexo,tb_chamado_id) VALUES('$descricao','$arquivo','$solicitacao')");
				echo "<meta http-equiv='refresh' content='0, url=?p=".base64_encode('galeria')."'>";
			}
			else
				echo "Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";
		}
		else
			echo "Você poderá enviar apenas arquivos \"*.jpg;*.jpeg;*.gif;*.png\"<br />";
	}
	else
	{
		echo "Você não enviou nenhum arquivo!";
	}
	
	
	
	
	

}



if(isset($_POST['avancar'])){
		
		$_SESSION['anexo'] = "OK";
		
		echo "<meta http-equiv='refresh' content='0, url='>";
		
	}
 
 ?>