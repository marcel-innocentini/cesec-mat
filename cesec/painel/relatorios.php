<?php 
$pag = "relatorios";
require_once("../conexao.php"); 

@session_start();   

?>



<div class="title" align="center">
<hr>
<h5 text="dark" >- Quadro geral de relatórios -</h5>
<hr>
</div>

     
<!-- DataTales Example -->
<div class="card shadow mb-4">

<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Nome do aluno</th>
                            <th>Cadastro</th>                            
                            <th align="center">Ficha cadastral</th>
                            <th align="center">Relatório de notas</th>
                            <th align="center">Relatório de frequência</th>
                            <th align="center">Relatório geral</th>
						</tr>
					</thead>

					<tbody>

			   		<?php 
					//RECUPERAR DADOS DOS ALUNOS EXISTENTES
			   		$query = $pdo->query("SELECT * FROM alunos order by nome ");
			   		$res = $query->fetchAll(PDO::FETCH_ASSOC);

			   		for ($i=0; $i < count($res); $i++) { 
				  		foreach ($res[$i] as $key => $value) {
				  		}                      
							
                        $nome = $res[$i]['nome'];  
				  	    $cadastro = $res[$i]['cadastro'];
                        $id = $res[$i]['id'];                                                                 

				  	?>
			 
				  		<tr>
							<td><?php echo $nome ?></td>
							<td><?php echo $cadastro ?></td>
                            <td align="center">
                            <a target="_blank" title="Ficha cadastral" href="../rel/ficha.php?id=<?php echo $id ?>"><span class="ml-2"><i class="fas fa-address-book ml-1 text-primary fa-1x"></i></span></a>
                            </td>
                            <td align="center">
                            <a target="_blank" title="Relatório de notas" href="../rel/relatorio-notas.php?id=<?php echo $id ?>"><span class="ml-2"><i class="fas fa-brain ml-1 text-primary fa-1x"></i></span></a>
                            </td>
                            <td align="center">
                            <a target="_blank" title="Relatório de frequências" href="../rel/relatorio-freq.php?id=<?php echo $id ?>"><span class="ml-2"><i class="fas fa-bullhorn ml-1 text-primary fa-1x"></i></span></a>
                            </td>							
							<td align="center">                                                   
                            <a target="_blank" title="Relatório geral" href="../rel/relatorio-geral.php?id=<?php echo $id ?>"><span class="ml-2"><i class="fas fa-globe-americas ml-1 text-primary fa-1x"></i></span></a>						
                            </td>                                   				 
						</tr>
						
            			
					<?php } ?>
	 				</tbody>
 				</table>
			</div>
		</div>

		

  	</div>
</div>
</div>




<!-- Modal -->
<div class="modal fade" id="modalDados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php 
                $id2 = $_GET['id_freq'];    
                if (@$_GET['funcao'] == 'entrada') {
                    $type1 = "text";
                    $type2 = "hidden";
                    $value1 = "Entrada OK?";
                    $value2 = "";

                }else{
                    $type1 = "hidden";
                    $type2 = "text";
                    $value1 = "";
                    $value2 = "Saída OK?";
                }

                ?>    
                
                <h5 class="modal-title" id="exampleModalLabel">Lançar frequência</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" method="POST">
                <div class="modal-body">      
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="text-success" ><b>Entrada</b></label>
                            <input value="<?php echo $value1 ?>" type= "<?php echo $type1 ?>" class="form-control" id="entrada" name="entrada">
                            </div>
                        </div>    
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="text-danger" ><b>Saída</b></label>
                            <input value="<?php echo $value2 ?>"  type="<?php echo $type2 ?>" class="form-control" id="saida" name="saida">
                            </div>
                        </div>                   
                    </div>                  
                
                <small>
                    <div id="mensagem">
                    </div>
                </small> 

            </div>
            <div class="modal-footer">

                <input value="<?php echo @$id2 ?>" type="hidden" name="txtid2" id="txtid2">
                <input value="<?php echo @$_GET['id_turma'] ?>" type="hidden" name="txtid3" id="txtid3">                
                <input value="<?php echo @$_GET['id_aluno'] ?>" type="hidden" name="txtid4" id="txtid4">
    

            <button type="button" id="btn-fechar" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" name="btn-salvar" id="btn-salvar" class="btn btn-primary">Salvar</button>
            </div>
        </form>
        </div>
    </div>
</div>




<?php 

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "saida") {
    echo "<script>$('#modalDados').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "entrada") {
    echo "<script>$('#modalDados').modal('show');</script>";
}

?>




<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM IMAGEM -->
<script type="text/javascript">
    $("#form").submit(function () {
        var pag = "<?=$pag?>";
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: pag + "/inserir.php",
            type: 'POST',
            data: formData,

            success: function (mensagem) {

                $('#mensagem').removeClass()

                if (mensagem.trim() == "Salvo com Sucesso!") {

                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar').click();
                    window.location = "index.php?pag="+pag;

                } else {

                    $('#mensagem').addClass('text-danger')
                }

                $('#mensagem').text(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,
            xhr: function () {  // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function () {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
                return myXhr;
            }
        });
    });
</script>




<script type="text/javascript">
    $(document).ready(function () {
        $('#dataTable').dataTable({
            "ordering": false
        })

    });
</script>



