<?php 
$pag = "turmas";
require_once("../conexao.php"); 

@session_start();
   

?>

<div class="row mt-4 mb-4">
    <a type="button" class="btn-info btn-sm ml-3 d-none d-md-block" href="index.php?pag=<?php echo $pag ?>&funcao=novo">Nova Turma</a>
    <a type="button" class="btn-info btn-sm ml-3 d-block d-sm-none" href="index.php?pag=<?php echo $pag ?>&funcao=novo">+</a>
    
</div>



<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Disciplina</th>
                        <th>Professor</th>
                        <th>Dias da semana</th>
                        <th>Horário</th>
                        <th>Data de início</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                   <?php 

                   $query = $pdo->query("SELECT * FROM turmas order by id desc ");
                   $res = $query->fetchAll(PDO::FETCH_ASSOC);

                   for ($i=0; $i < count($res); $i++) { 
                      foreach ($res[$i] as $key => $value) {
                      }                      
                                           
                      $horario = $res[$i]['horario'];
                      $dia = $res[$i]['dia'];
                      $data_inicio = $res[$i]['data_inicio'];
                      $data_inicio = implode('/', array_reverse(explode('-', $data_inicio)));
                      $id = $res[$i]['id'];

                                         

                      ?>
                 

                      <tr>
                        <td>Matemática</td>
                        <td>Jairo de Paula</td>
                        <td><?php echo $dia ?></td>
                        <td><?php echo $horario ?></td>
                        <td><?php echo $data_inicio ?></td>


                        <td>
                         <a href="index.php?pag=<?php echo $pag ?>&funcao=editar&id=<?php echo $id ?>" class='text-primary mr-1' title='Editar Dados'><i class='far fa-edit'></i></a>
                         <a href="index.php?pag=<?php echo $pag ?>&funcao=excluir&id=<?php echo $id ?>" class='text-danger mr-1' title='Excluir Registro'><i class='far fa-trash-alt'></i></a>
                         <a href="index.php?pag=<?php echo $pag ?>&funcao=matricula&id=<?php echo $id ?>" class='text-success mr-1' title='Matricular Aluno'><i class='fas fa-user-plus'></i></a>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php 
                if (@$_GET['funcao'] == 'editar') {
                    $titulo = "Editar Registro";
                    $id2 = $_GET['id'];

                    $query = $pdo->query("SELECT * FROM turmas where id = '" . $id2 . "' ");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);
                             
                 
                    $horario2 = $res[0]['horario'];
                    $dia2 = $res[0]['dia'];
                    $data_inicio2 = $res[0]['data_inicio'];
                    $data_final2 = $res[0]['data_final'];
                    
                    $ano2 = $res[0]['ano'];

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

                    
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label >Data Início</label>
                    <input value="<?php echo @$data_inicio2 ?>" type="date" class="form-control" id="data_inicio" name="data_inicio">
                </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label >Data Final</label>
                <input value="<?php echo @$data_final2 ?>" type="date" class="form-control" id="data_final" name="data_final">
            </div>
        </div>
        <div class="col-md-4">
         <div class="form-group">
            <label >Horário Aulas</label>
            <input value="<?php echo @$horario2 ?>" type="text" class="form-control" id="horario" name="horario" placeholder="De xx:xx às xx:xx">
        </div>
    </div>
</div>



<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label >Dias das Aulas</label>
            <input value="<?php echo @$dia2 ?>" type="text" class="form-control" id="dia" name="dia" placeholder="Segundas e terças">
        </div>
    </div>
    
<div class="col-md-4">
    <div class="form-group">
        <label >Ano Início</label>
        <input value="<?php echo @$ano2 ?>" type="number" class="form-control" id="ano" name="ano" placeholder="Ano da Turma">
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

                <div align="center" id="mensagem_excluir" class="">

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


<div class="modal" id="modal-matricula" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Matricular Aluno <small><a class="text-dark" title="Ver Alunos Matriculados" href="index.php?pag=<?php echo $pag ?>&funcao=matriculados&id_turma=<?php echo $_GET['id'] ?>"><u>Ver Alunos</u></a></small></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

               <!-- DataTales Example -->
               <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Cadastro</th>
                                    <th>Telefone</th>
                                    <th>Email</th>                                    
                                    <th>Ações</th>
                                </tr>
                            </thead>

                            <tbody>

                               <?php 

                               $query = $pdo->query("SELECT * FROM alunos order by id desc ");
                               $res = $query->fetchAll(PDO::FETCH_ASSOC);

                               for ($i=0; $i < count($res); $i++) { 
                                  foreach ($res[$i] as $key => $value) {
                                  }

                                  $nome = $res[$i]['nome'];
                                  $cadastro = $res[$i]['cadastro'];
                                  $telefone = $res[$i]['telefone'];
                                  $email = $res[$i]['email'];
                                                                    
                                  $id_aluno = $res[$i]['id'];


                                  ?>


                                  <tr>
                                    <td><?php echo $nome ?></td>
                                    <td><?php echo $cadastro ?></td>
                                    <td><?php echo $telefone ?></td>
                                    <td><?php echo $email ?></td>
                                    
                                    <td>

                                     <a href="index.php?pag=<?php echo $pag ?>&funcao=confirmar&id_turma=<?php echo $_GET['id'] ?>&id_aluno=<?php echo $id_aluno ?>" class='text-info mr-1' title='Confirmar Matricula'><i class='fas fa-check'></i></a>
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
</div>
</div>





<div class="modal" id="modal-matriculados" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alunos Matriculados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php 
                 $query = $pdo->query("SELECT * FROM matriculas where turma = '$_GET[id_turma]' order by id desc ");
                               $res = $query->fetchAll(PDO::FETCH_ASSOC);

                               for ($i=0; $i < count($res); $i++) { 
                                  foreach ($res[$i] as $key => $value) {
                                  }

                                  $aluno = $res[$i]['aluno'];
                                  $id_m = $res[$i]['id'];
                                   $query_r = $pdo->query("SELECT * FROM alunos where id = '" . $aluno . "' ");
                    $res_r = $query_r->fetchAll(PDO::FETCH_ASSOC);

                    $nome_aluno = $res_r[0]['nome'];

                 ?>
                <span><small><?php echo $nome_aluno ?><a title="Excluir Matrícula" href="index.php?pag=<?php echo $pag ?>&funcao=excluir_matricula&id_m=<?php echo $id_m ?>&id_turma=<?php echo $_GET['id_turma'] ?>"><span class="ml-2"><i class='fas fa-user-minus text-danger'></i></span></a></small></span>

                <hr style="margin:4px">

            <?php } ?>

               

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


if (@$_GET["funcao"] != null && @$_GET["funcao"] == "matricula") {
    echo "<script>$('#modal-matricula').modal('show');</script>";
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

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "matriculados") {
    echo "<script>$('#modal-matriculados').modal('show');</script>";
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



