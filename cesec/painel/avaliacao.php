<?php 
$pag = "avaliacao";
require_once("../conexao.php"); 

@session_start();
   

?>

<div class="row mt-4 mb-4">
    <a type="button" class="btn-info btn-sm ml-3 d-none d-md-block" href="index.php?pag=<?php echo $pag ?>&funcao=novo">Nova avaliação</a>
    <a type="button" class="btn-info btn-sm ml-3 d-block d-sm-none" href="index.php?pag=<?php echo $pag ?>&funcao=novo">+</a>
    
</div>



<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nº ID da turma</th>
                        <th>Disciplina</th>
                        <th>Turma</th>
                        <th>Tipo</th>
                        <th>Nota máxima</th>
                        <th>Data avaliação</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                   <?php 
                    //RECUPERAR DADOS DAS AVALIAÇÕES CADASTRADAS
                   $query = $pdo->query("SELECT * FROM avaliacao order by turma ");
                   $res = $query->fetchAll(PDO::FETCH_ASSOC);

                   for ($i=0; $i < count($res); $i++) { 
                      foreach ($res[$i] as $key => $value) {
                      }                      
                                           
                      $id = $res[$i]['id'];
                      $turma = $res[$i]['turma'];
                      $tipo = $res[$i]['tipo'];                      
                      $nota_max = ($res[$i]['nota_max'])/100;                      
                      $nota_maxF = number_format($nota_max, 2, ',', '');
                      
                      $data_av = $res[$i]['data_av'];                     
                      $data_avF = implode('/', array_reverse(explode('-', $data_av)));
                    
                        //RECUPERAR DADOS DA TURMA
                        $query_2 = $pdo->query("SELECT * FROM turmas WHERE id = '$turma' ");
                        $res_2 = $query_2->fetchAll(PDO::FETCH_ASSOC);                                        
                                              
                        $id_disc = $res_2[0]['disciplina'];
                        $dia_disc = $res_2[0]['dia'];
                        $hora_disc = $res_2[0]['horario'];


                        //RECUPERAR NOME DA DISCIPLINA
                        $query_3 = $pdo->query("SELECT * FROM disciplinas WHERE id = '$id_disc' ");
                        $res_3 = $query_3->fetchAll(PDO::FETCH_ASSOC);                                        
                                              
                        $nome_disc = $res_3[0]['nome'];                                                   

                      ?>
                 
                      <tr>
                        <td><?php echo $turma ?></td>
                        <td><?php echo $nome_disc ?></td>
                        <td><?php echo $dia_disc ?> <br> <?php echo $hora_disc ?> </td>
                        <td><?php echo $tipo ?></td>
                        <td><?php echo $nota_maxF ?></td>
                        <td><?php echo $data_avF ?></td>                       

                        <td>
                         <a href="index.php?pag=<?php echo $pag ?>&funcao=editar&id=<?php echo $id ?>" class='text-primary mr-1' title='Editar Dados'><i class='far fa-edit'></i></a>
                         <a href="index.php?pag=<?php echo $pag ?>&funcao=excluir&id=<?php echo $id ?>" class='text-danger mr-1' title='Excluir Registro'><i class='far fa-trash-alt'></i></a>
                         
                     </td>
                 </tr>
             <?php } ?>
         </tbody>
     </table>
 </div>
</div>
</div>





<!-- Modal -->
<div class="modal fade" id="modalDados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php 
                if (@$_GET['funcao'] == 'editar') {
                    $titulo = "Editar Registro";
                    $id2 = $_GET['id'];

                    //RECUPERAR DADOS PRÉ-PREENCHIDOS
                    $query = $pdo->query("SELECT * FROM avaliacao where id = '" . $id2 . "' ");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);
                    $total_reg = @count($res);
                             
                    $turma2 = $res[0]['turma'];
                    $tipo2 = $res[0]['tipo'];
                    $nota_max2 = $res[0]['nota_max']/100;
                    $nota_max2F = number_format($nota_max2, 2, ',', '');

                    $data_av2 = $res[0]['data_av'];                      
                    $data_avF2 = implode('/', array_reverse(explode('-', $data_av2)));

                    //RECUPERAR PRÉ-PREENCHIDOS  DA TURMA
                    $query_2 = $pdo->query("SELECT * FROM turmas WHERE id = '$turma2' ");
                    $res_2 = $query_2->fetchAll(PDO::FETCH_ASSOC);                                        
                                          
                    $id_disc2 = $res_2[0]['disciplina'];
                    $dia_disc2 = $res_2[0]['dia'];
                    $hora_disc2 = $res_2[0]['horario'];

                    //RECUPERAR PRÉ-PREENCHIDOS NOME DA DISCIPLINA
                    $query_3 = $pdo->query("SELECT * FROM disciplinas WHERE id = '$id_disc2' ");
                    $res_3 = $query_3->fetchAll(PDO::FETCH_ASSOC);                                        
                                          
                    $nome_disc2 = $res_3[0]['nome'];             

                } else {
                    $titulo = "Inserir Registro";

                }

                ?>
                
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" method="POST">
                <div class="modal-body">

            <!--INSERÇÃO DE DADOS PARA EDIÇÃO 1ª LINHA (APENAS APRESENTAÇÃO E PASSAGEM DE VALUES)-->


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label >Nº ID da turma</label>
                        <input value="<?php echo @$turma2 ?>" type="text" class="form-control" id="turma" name="turma">
                        </div>
                    </div>
                    
                </div>
            <!--INSERÇÃO DE DADOS PARA EDIÇÃO 2ª LINHA-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label >Tipo (incluir data)</label>
                        <input value="<?php echo @$tipo2 ?>" type="text" class="form-control" id="tipo" name="tipo" placeholder="Ex. Prova (21/03/2021)">
                        </div>
                    <div class="form-group">
                        <label >Nota máxima</label>
                        <input value="<?php echo @$nota_max2 ?>" type="text" class="form-control" id="nota_max" name="nota_max">
                        </div>
                    </div>                    
                </div>      
            <!--INSERÇÃO DE DADOS PARA EDIÇÃO 3ª LINHA-->

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label >Data da avaliação</label>
                        <input value="<?php echo @$data_av2 ?>" type="date" class="form-control" id="data_av" name="data_av">
                        </div>
                    </div>  
                    
                </div>            
                
                <small>
                    <div id="mensagem">
                    </div>
                    </small> 

            </div>
            <div class="modal-footer">

            <input value="<?php echo @$_GET['id'] ?>" type="hidden" name="txtid2" id="txtid2">
    

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
                <h5 class="modal-title">Excluir Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja realmente Excluir este Registro?</p>
                <small>
                <div align="center" id="mensagem_excluir" class="text-danger"></div>
                </small>

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



if (@$_GET["funcao"] != null && @$_GET["funcao"] == "confirmar") {

    $id_turma = $_GET['id_turma'];
    $id_aluno = $_GET['id_aluno'];

    $query_r = $pdo->query("SELECT * FROM matriculas where turma = '$id_turma' and aluno = '$id_aluno' ");
    $res_r = $query_r->fetchAll(PDO::FETCH_ASSOC);

    if(@count($res_r) == 0){
         $res = $pdo->query("INSERT INTO matriculas SET turma = '$id_turma', aluno = '$id_aluno', data = curDate()");

    }

    echo "<script>window.location='index.php?pag=$pag&id_turma=$id_turma&id_aluno=$id_aluno&funcao=matriculados';</script>";
   
    
}




if (@$_GET["funcao"] != null && @$_GET["funcao"] == "excluir_matricula") {

    $id_m = $_GET['id_m'];
    $id_turma = $_GET['id_turma'];
   
   
         $res = $pdo->query("DELETE from matriculas WHERE id = '$id_m'");

    echo "<script>window.location='index.php?pag=$pag&id_turma=$id_turma&id_aluno=$id_aluno&funcao=matriculados';</script>";
   
    
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



