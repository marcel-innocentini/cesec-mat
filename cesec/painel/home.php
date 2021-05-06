<?php
$pag = "home";
 
@session_start();

require_once("../conexao.php"); 


//totais dos cards
$hoje = date('Y-m-d');
$mes_atual = Date('m');
$ano_atual = Date('Y');
$dataInicioMes = $ano_atual."-".$mes_atual."-01";

?>

<div class="title" align="center">
<hr>
<h5 text="dark"  >
- Quadro informativo das turmas em andamento - 
</h5>
<hr>

	

</div>


<div class="row">

<?php 

$query = $pdo->query("SELECT * FROM turmas order by data_inicio ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for ($i=0; $i < count($res); $i++) { 
	foreach ($res[$i] as $key => $value) {
	}

	$id_turma = $res[$i]['id'];
	$data_inicio = $res[$i]['data_inicio'];	    
    $horario = $res[$i]['horario'];
    $dia = $res[$i]['dia'];
    $disciplina = $res[$i]['disciplina'];
    
	
	$data_inicioF = implode('/', array_reverse(explode('-', $data_inicio)));
	$data_finalF = implode('/', array_reverse(explode('-', $data_final)));

	$query_2 = $pdo->query("SELECT * FROM disciplinas WHERE id = '$disciplina' ");
	$res_2 = $query_2->fetchAll(PDO::FETCH_ASSOC);

	$nome_disc = $res_2[0]['nome'];

	if(($disciplina % 2) == "0"){
		$classe = "text-primary";

	}else{
		$classe = "text-success";
	}
	$query_3 = $pdo->query("SELECT * FROM matriculas WHERE turma = '$id_turma' ");
	$res_3 = $query_3->fetchAll(PDO::FETCH_ASSOC);
	$mat = count($res_3);

 ?>	

<div class="col-xl-3 col-md-6 mb-4">
	<a class="text-dark" title="Informações da Turma">
			<div class="card <?php echo $classe ?> shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<p><div class="text-xs font-weight-bold <?php echo $classe ?> text-uppercase"><?php echo $nome_disc ?></div></p>
							<div class="text-xs <?php echo $classe ?>"><?php echo $horario ?> <br> <?php echo $dia ?> </div>
							<p><div class="text-xs font-weight-bold <?php echo $classe ?> text-uppercase"><?php echo $mat ?> alunos matriculados</div></p>
						</div>
						<div class="col-auto" align="center">
							<h6 class="text-xs <?php echo $classe ?>">Início:</h6>
							<i class="far fa-calendar-alt fa-2x  <?php echo $classe ?>"></i><br>
							<span class="text-xs"><?php echo $data_inicioF ?></span>
						</div>
					</div>
				</div>
			</div>
		</a>
		</div>



<?php } ?>


