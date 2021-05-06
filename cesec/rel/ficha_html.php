<?php 
require_once("../conexao.php"); 
@session_start();

$id = $_GET['id'];

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));


//DADOS DO ALUNO
$query_1 = $pdo->query("SELECT * FROM alunos where id = '$id' ");
$res_1 = $query_1->fetchAll(PDO::FETCH_ASSOC);
$nome_aluno = $res_1[0]['nome'];
$cadastro = $res_1[0]['cadastro'];
$telefone = $res_1[0]['telefone'];
$email = $res_1[0]['email'];



?>

<!DOCTYPE html>
<html>
<head>
	<title>Ficha Cadastral do Aluno</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<style>

		@page {
			margin: 0px;
			margin-bottom:30px;
		
		}
						
		.footer {
			margin-top:20px;
			width:100%;
			background-color: #87ceff;
			padding:10px;
		}

		.cabecalho {    
			background-color: #87ceff;
			padding:10px;
			margin-bottom:30px;
			margin-top:20px;
			width:100%;
			height:100px;
		}

		.titulo{
			margin:0;
			font-size:28px;
			font-family:Arial, Helvetica, sans-serif;
			color:#6e6d6d;

		}

		.subtitulo{
			margin:0;
			font-size:17px;
			font-family:Arial, Helvetica, sans-serif;
		}

		.areaTotais{
			border : 0.5px solid #bcbcbc;
			padding: 15px;
			border-radius: 5px;
			margin-right:25px;
			margin-left:25px;
			position:absolute;
			right:20;
		}

		.areaTotal{
			border : 0.5px solid #bcbcbc;
			padding: 15px;
			border-radius: 5px;
			margin-right:25px;
			margin-left:25px;
			background-color: #f9f9f9;
			margin-top:2px;
		}

		.pgto{
			margin:1px;
		}

		.fonte13{
			font-size:13px;
		}

		.esquerda{
			display:inline;
			width:50%;
			float:left;
		}

		.direita{
			display:inline;
			width:50%;
			float:right;
		}

		.table{
			padding:15px;
			font-family:Verdana, sans-serif;
			margin-top:20px;
		}

		.texto-tabela{
			font-size:12px;
		}


		.esquerda_float{

			margin-bottom:10px;
			float:left;
			display:inline;
		}


		.titulos{
			margin-top:10px;
		}

		.image{
			margin-top:-10px;
		}

		.margem-direita{
			margin-right: 80px;
		}

		hr{
			margin:8px;
			padding:1px;
		}

		.container{
			padding-left:50px;
			padding-right:50px;
			padding-bottom:50px;

		}

	</style>

</head>
<body>


	<div class="cabecalho">
		<div class="container">
			<div class="row titulos">
				<div class="col-sm-2 esquerda_float image">	
					<img src="../img/logo1.png" width="170px">
				</div>
				<div class="col-sm-10 esquerda_float">	
					<h2 class="titulo"><b><?php echo strtoupper($nome_escola) ?></b></h2>
					<h6 class="subtitulo"><?php echo $endereco_escola . ' Tel: '.$telefone_escola  ?></h6>

				</div>
			</div>
		</div>

	</div>

	<div class="container">

		<div class="row">
			<div class="col-sm-8 esquerda">	
				<big> Cadastro Nº <?php echo $cadastro ?>  </big>
			</div>
			<div class="col-sm-4 direita" align="right">	
				<big> <small><?php echo $data_hoje; ?></small> </big>
			</div>
		</div>


		<hr>
        <br></br>
        <p align="center"><b>FICHA CADASTRAL DO ALUNO</b></p>
        <br></br>

<p><b>DADOS DO ALUNO: </b></p>
<p><?php echo strtoupper($nome_aluno) ?>, brasileiro(a), cadastrado neste CESEC sob nº <?php echo $cadastro ?>, telefone <?php echo $telefone ?>, email <?php echo $email ?>.</p>
<br>

<p>
<b>DADOS DA UNIDADE ESCOLAR:</b></p>
<p> <?php echo $nome_escola ?>, com sede na <?php echo $endereco_escola ?>, inscrita no CNPJ sob o nº <?php echo $cnpj_escola ?>, e no Cadastro Estadual sob o nº 65.6541.651-23.47</p>
<br>
<br>
<p><b>TURMAS DAS QUAIS O ALUNO É PARTICIPANTE:</b></p>
<br>


<?php
$query_2 = $pdo->query("SELECT * FROM matriculas where aluno = '$id' order by turma ");
$res_2 = $query_2->fetchAll(PDO::FETCH_ASSOC);
for ($i=0; $i < count($res_2); $i++) { 
	foreach ($res_2[$i] as $key => $value) {
	}                      
	$turma = @$res_2[$i]['turma'];
	$data_mat = @$res_2[$i]['data'];

	$query_3 = $pdo->query("SELECT * FROM turmas where id = '$turma' ");
	$res_3 = $query_3->fetchAll(PDO::FETCH_ASSOC);
	
		$disciplina = $res_3[0]['disciplina'];
		$dia = @$res_3[0]['dia'];
		$professor = @$res_3[0]['professor'];
		$horario = @$res_3[0]['horario'];
		$data_inicio = @$res_3[0]['data_inicio'];
		$data_final = @$res_3[0]['data_final'];


		$query_4 = $pdo->query("SELECT * FROM professores where id = '$professor' ");
		$res_4 = $query_4->fetchAll(PDO::FETCH_ASSOC);
		$nome_prof = @$res_4[0]['nome'];

		$query_5 = $pdo->query("SELECT * FROM disciplinas where id = '$disciplina' ");
		$res_5 = $query_5->fetchAll(PDO::FETCH_ASSOC);
		$nome_disc = @$res_5[0]['nome'];

		//RECUPERAR O TOTAL DE MESES ENTRE DATAS
		//$d1 = new DateTime($data_inicio);
		//$d2 = new DateTime($data_final);
		//$intervalo = $d1->diff( $d2 );
		//$anos = $intervalo->y;
		//$meses = $intervalo->m + ($anos * 12);

		$data_matF = implode('/', array_reverse(explode('-', $data_mat)));
		$data_inicioF = implode('/', array_reverse(explode('-', $data_inicio)));
		$data_finalF = implode('/', array_reverse(explode('-', $data_final)));

		//$valor_total = $valor * $meses;
		//$valor_mensalidadeF = number_format($valor, 2, ',', '.');
		//$valor_totalF = number_format($valor_total, 2, ',', '.');

		?>
	
		<p>
		<b>TURMA nº <?php echo $turma ?></b></p> Disciplina de <?php echo $nome_disc ?>, matriculado em <?php echo $data_matF ?>, ministrada nas <?php echo $dia ?> no horário de <?php echo $horario ?> pelo professor <?php echo $nome_prof ?>, com data de início das aulas em <?php echo $data_inicioF ?> e previsão de término em <?php echo $data_finalF ?>.</p>
		<br>
		<br>

	<?php }  ?>


<p align="center">
<?php echo ($cidade_escola) .', '. $data_hoje ?>
</p>
<br><br>
<p align="center">
_________________________________________________
<br>(Representante do <?php echo $nome_escola ?>)
</p>



				<div class="footer">
		<p style="font-size:14px" align="center"><?php echo $rodape_relatorios ?></p> 
	</div>

				</body>
				</html>
