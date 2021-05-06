<?php 
$pag = "frequencias";
require_once("../conexao.php"); 

@session_start();   

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));
$hora_hoje = date('H:i:s');

?>
<div class="title" align="center">
<hr>
<h5 text="dark" >- Quadro de gerenciamento de frequências - <?php echo $data_hoje ?> - HORA: <?php echo $hora_hoje ?></h5>
<hr>
</div>

     
<!-- DataTales Example -->
<div class="card shadow mb-4">

<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>ID Turma</th>
                            <th>Disciplina</th>
                            <th>Dia</th>
                            <th>Horário</th>
							<th>Aluno</th>
                            <th>Cadastro</th>							
							<th>Entrada</th>
                            <th>Saída</th>
						</tr>
					</thead>

					<tbody>

			   		<?php 
                    //VERIFICAR SE O ALUNO ESTÀ MATRICULADO EM ALGUMA TURMA
			   		$query = $pdo->query("SELECT * FROM matriculas ");
			   		$res = $query->fetchAll(PDO::FETCH_ASSOC);
                    for ($i=0; $i < count($res); $i++) { 
                        foreach ($res[$i] as $key => $value) {
                        }
                        $id_matricula = $res[$i]['id'];
                        $id_aluno = $res[$i]['aluno']; 
                        $id_turma = $res[$i]['turma'];       

					    //RECUPERAR DADOS DOS ALUNOS MATRICULADOS
			   		    $query_2 = $pdo->query("SELECT * FROM alunos WHERE id = '$id_aluno' ");
			   		    $res_2 = $query_2->fetchAll(PDO::FETCH_ASSOC);			   		
                          
				  	    $nome_aluno = $res_2[0]['nome'];
                        $cadastro = $res_2[0]['cadastro'];

                        //RECUPERAR DADOS DA TURMA
					    $query_4 = $pdo->query("SELECT * FROM turmas WHERE id = '$id_turma' ");
					    $res_4 = $query_4->fetchAll(PDO::FETCH_ASSOC);                                        
										  
					    $id_disciplina = $res_4[0]['disciplina'];
                        $dia = $res_4[0]['dia'];
                        $horario = $res_4[0]['horario'];
                        $data_inicio = $res_4[0]['data_inicio'];
                        
                        //RECUPERAR NOME DA DISCIPLINA
                        $query_5 = $pdo->query("SELECT * FROM disciplinas WHERE id = '$id_disciplina' ");
					    $res_5 = $query_5->fetchAll(PDO::FETCH_ASSOC);                                        
										  
					    $nome_disc = $res_5[0]['nome'];                           
                    
                        //RECUPERAR FREQUÊNCIAS JÁ LANÇADAS
					    $query_6 = $pdo->query("SELECT * FROM frequencia WHERE aluno = '$id_aluno' and turma = '$id_turma' ");
					    $res_6 = $query_6->fetchAll(PDO::FETCH_ASSOC);                                        
										  
					    $id_freq = $res_6[0]['id']; 
                        $tipo = $res_6[0]['tipo']; 
                        $data_freq = $res_6[0]['data_freq'];   
                    					                                                                       

				  	?>
			 
				  		<tr>
							<td><?php echo $id_turma ?></td>
							<td><?php echo $nome_disc ?></td>
							<td><?php echo $dia ?></td>  
                            <td><?php echo $horario ?></td>
                            <td><?php echo $nome_aluno ?></td>
                            <td><?php echo $cadastro ?></td> 
							<td>                                                   
					 		<a href="index.php?pag=<?php echo $pag ?>&funcao=entrada&id_freq=<?php echo $id_freq ?>&id_turma=<?php echo $id_turma ?>&id_aluno=<?php echo $id_aluno ?>" class='text-success mr-1' title='Lançar entrada'><i class="fas fa-sign-in-alt fa-2x"></i></i></a>							
                            </td>
                            <td>                           
					 		<a href="index.php?pag=<?php echo $pag ?>&funcao=saida&id_freq=<?php echo $id_freq ?>&id_turma=<?php echo $id_turma ?>&id_aluno=<?php echo $id_aluno ?>" class='text-danger mr-1' title='Lançar saídas'><i class="fas fa-sign-out-alt fa-2x"></i></a>
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



