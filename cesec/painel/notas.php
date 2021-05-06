<?php 
$pag = "notas";
require_once("../conexao.php"); 

@session_start();   

?>
<div class="title" align="center">
<hr>
<h5 text="dark" >- Quadro de gerenciamento de notas -</h5>
<hr>
</div>

     
<!-- DataTales Example -->
<div class="card shadow mb-4">

<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
                            <th>Aluno</th>
                            <th>ID Turma</th>
                            <th>Disciplina</th>                            
							<th>Avaliação</th>                            
							<th>Máximo</th>                        
							<th>Notas</th>
							<th>Ação</th>
						</tr>
					</thead>

					<tbody>

			   		<?php 
                    
                    //RECUPERAR DADOS DAS NOTAS PRÉ-CADASTRADAS
                    $query_1 = $pdo->query("SELECT * FROM notas order by id asc");
                    $res_1 = $query_1->fetchAll(PDO::FETCH_ASSOC);                                        
                    for ($i=0; $i < count($res_1); $i++) { 
                        foreach ($res_1[$i] as $key => $value) {
                        }                     
                        $id_nota = $res_1[$i]['id'];
                        $id_turma = $res_1[$i]['turma'];
                        $id_aluno = $res_1[$i]['aluno'];
                        $id_avaliacao = $res_1[$i]['avaliacao'];
                        $nota = ($res_1[$i]['nota'])/100;
                        $notaF = number_format($nota, 2, ',', ''); 
                        

                        //RECUPERAR NOME DO ALUNO
                        $query_2 = $pdo->query("SELECT * FROM alunos WHERE id = '$id_aluno' ");
                        $res_2 = $query_2->fetchAll(PDO::FETCH_ASSOC);      
                        $nome_aluno = $res_2[0]['nome'];


                        //RECUPERAR NOME DA DISCIPLINA
                        $query_3 = $pdo->query("SELECT * FROM turmas WHERE id = '$id_turma' ");
                        $res_3 = $query_3->fetchAll(PDO::FETCH_ASSOC);      
                        $id_disc = $res_3[0]['disciplina'];
                        
                        $query_4 = $pdo->query("SELECT * FROM disciplinas WHERE id = '$id_disc' ");
                        $res_4 = $query_4->fetchAll(PDO::FETCH_ASSOC); 
                        $nome_disc = $res_4[0]['nome'];         
                                                         

                        //RECUPERAR TIPO DE AVALIAÇÃO
                        $query_5 = $pdo->query("SELECT * FROM avaliacao WHERE id = '$id_avaliacao' ");
                        $res_5 = $query_5->fetchAll(PDO::FETCH_ASSOC);  
                            
                        $tipo = $res_5[0]['tipo'];
                        $nota_max = ($res_5[0]['nota_max'])/100;
                        $nota_maxF = number_format($nota_max, 2, ',', '');
                        $data_av = $res_5[0]['data_av'];      
                        $data_avF = implode('/', array_reverse(explode('-', $data_av)));              

 
				  	?>
			 
				  		<tr>
							<td><?php echo $nome_aluno ?></td>
							<td><?php echo $id_turma ?></td>
							<td><?php echo $nome_disc ?></td>  
                            <td><?php echo $tipo ?></td>
                            <td><?php echo $nota_maxF ?></td>      
                            <td><?php if($notaF != "0,00"){ ?>
                                <?php echo $notaF ?>
                                <?php } ?>                            
                            </td>    
							<td> 
                            <?php if($nota != ""){  ?>                        
					 		<a href="index.php?pag=<?php echo $pag ?>&funcao=editar&id_nota=<?php echo $id_nota ?>&id_turma=<?php echo $id_turma ?>&id_avaliacao=<?php echo $id_avaliacao ?>&id_aluno=<?php echo $id_aluno ?>" class='text-primary mr-1' title='Lançar notas'><i class='fas fa-pencil-alt '></i></a>							
                                                       
					 		<a href="index.php?pag=<?php echo $pag ?>&funcao=excluir&id=<?php echo $id_nota ?>" class='text-danger mr-1' title='Excluir notas'><i class='far fa-trash-alt '></i></a>
                            <?php } ?>                            
                            
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
                $id2 = $_GET['id_nota'];
                $id3 = $_GET['id_avaliacao'];
                if ($id2 != "") {
                    $titulo = "Alterar nota";                          

                    //RECUPERAR DADOS PRÉ-PREENCHIDOS DA NOTA JÁ LANÇADA
                    $query_7 = $pdo->query("SELECT * FROM notas WHERE id = $id2 ");
                    $res_7 = $query_7->fetchAll(PDO::FETCH_ASSOC);                                        
                                          
                    $nota2 = ($res_7[0]['nota'])/100;
                    $nota2F = number_format($nota2, 2, ',', ''); 
                    
                    //RECUPERAR DADOS DA AVALIAÇÃO
                    $query_8 = $pdo->query("SELECT * FROM avaliacao WHERE id = $id3 ");
                    $res_8 = $query_8->fetchAll(PDO::FETCH_ASSOC);                                        
                                          
                    $nota_max2 = ($res_8[0]['nota_max'])/100;
                    $nota_max2F = number_format($nota_max2, 2, ',', '');
                    
                }else{ 
                    $titulo = "Incluir nova nota";                   
                }
                
                ?>                
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" method="POST">
                <div class="modal-body">      
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label >Informe a nota</label>
                        <?php $visual = 0;
                        if($notaF == "0,00"){ 
                            $visual = "";
                        }else{
                            $visual = $nota2F;
                            } ?>  
                        <input value="<?php echo @$visual ?>" type="text" class="form-control" id="nova_nota" name="nova_nota">
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
                <input value="<?php echo @$_GET['id_avaliacao'] ?>" type="hidden" name="txtid4" id="txtid4">
                <input value="<?php echo @$_GET['id_aluno'] ?>" type="hidden" name="txtid5" id="txtid5">
                <input value="<?php echo @$nota_max2F ?>" type="hidden" name="txtid6" id="txtid6">
    

            <button type="button" id="btn-fechar" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" name="btn-salvar" id="btn-salvar" class="btn btn-primary">Salvar</button>
            </div>
        </form>
        </div>
    </div>
</div>






<div class="modal" id="modal-deletar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluir Nota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div align="center" id="mensagem_excluir" class="text-danger">
                <small>
                <p>Caro queira editar a nota, selecione o outro item.</p>
                <p>Deseja realmente excluir definitivamente esta nota?</p>      
                </small>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-excluir">Cancelar</button>
                <form method="post">

                    <input type="hidden" id="id"  name="id" value="<?php echo @$_GET['id'] ?>" required>

                    <button type="button" id="btn-deletar" name="btn-deletar" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>







<?php 

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "novo") {
    echo "<script>$('#modalDados').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "editar") {
    echo "<script>$('#modalDados').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "excluir") {
    echo "<script>$('#modal-deletar').modal('show');</script>";
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





<!--AJAX PARA EXCLUSÃO DOS DADOS -->
<script type="text/javascript">
    $(document).ready(function () {
        var pag = "<?=$pag?>";
        $('#btn-deletar').click(function (event) {
            event.preventDefault();

            $.ajax({
                url: pag + "/excluir.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function (mensagem) {

                    if (mensagem.trim() === 'Excluído com Sucesso!') {


                        $('#btn-cancelar-excluir').click();
                        window.location = "index.php?pag=" + pag;
                    }

                    $('#mensagem_excluir').text(mensagem)



                },

            })
        })
    })
</script>




<script type="text/javascript">
    $(document).ready(function () {
        $('#dataTable').dataTable({
            "ordering": false
        })

    });
</script>



