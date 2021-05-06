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
	<title>Relatório de Notas</title>
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
        <p align="center"><b>RELATÓRIO DE NOTAS DO ALUNO</b></p>
        <br></br>

<p><b>DADOS DO ALUNO: </b></p>
<p><?php echo strtoupper($nome_aluno) ?>, brasileiro(a), cadastrado neste CESEC sob nº <?php echo $cadastro ?>, telefone <?php echo $telefone ?>, email <?php echo $email ?>.</p>
<br>

<p>
<b>DADOS DA UNIDADE ESCOLAR:</b></p>
<p> <?php echo $nome_escola ?>, com sede na <?php echo $endereco_escola ?>, inscrita no CNPJ sob o nº <?php echo $cnpj_escola ?>, e no Cadastro Estadual sob o nº 65.6541.651-23.47</p>
<br>
<br>
<p><b>AVALIAÇÕES E NOTAS RECEBIDAS:</b></p>
<br>
<p>
		
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Turma</th>
                            <th>Disciplina</th>							                            
                            <th>Avaliação</th>
                            <th>Data</th>
                            <th>Nota máxima</th>
                            <th>Nota do aluno</th>
							<th>Percentual</th>
						</tr>
					</thead>
						<tbody>

						<?php
						//DADOS DAS NOTAS

						$query_2 = $pdo->query("SELECT * FROM notas where aluno = '$id' ");
						$res_2 = $query_2->fetchAll(PDO::FETCH_ASSOC);

						for ($i=0; $i < count($res_2); $i++) { 
							foreach ($res_2[$i] as $key => $value) {
							}                      
							$turma = $res_2[$i]['turma'];
							$avaliacao = $res_2[$i]['avaliacao'];
							$nota = ($res_2[$i]['nota'])/100;	
							$notaF = number_format($nota, 2, ',', '');

							$query_3 = $pdo->query("SELECT * FROM turmas where id = '$turma' ");
							$res_3 = $query_3->fetchAll(PDO::FETCH_ASSOC);
							
							$disciplina = $res_3[0]['disciplina'];
							$professor = $res_3[0]['professor'];
								
							$query_4 = $pdo->query("SELECT * FROM avaliacao where id = '$avaliacao' ");
							$res_4 = $query_4->fetchAll(PDO::FETCH_ASSOC);
							$data_av = @$res_4[0]['data_av'];
							$nota_max = @$res_4[0]['nota_max']/100;
							$nota_maxF = number_format($nota_max, 2, ',', '');
							$tipo = @$res_4[0]['tipo'];
							$data_avF = implode('/', array_reverse(explode('-', $data_av)));

							$query_5 = $pdo->query("SELECT * FROM disciplinas where id = '$disciplina' ");
							$res_5 = $query_5->fetchAll(PDO::FETCH_ASSOC);
							$nome_disc = @$res_5[0]['nome'];

							$query_6 = $pdo->query("SELECT * FROM professores where id = '$professor' ");
							$res_6 = $query_6->fetchAll(PDO::FETCH_ASSOC);
							$nome_prof = $res_6[0]['nome'];
							$cpf_prof = $res_6[0]['cpf'];


							$percentual = ($nota / $nota_max)*100;	
							$percentualF = number_format($percentual, 2, ',', '');	

						?>
												
						<tr>
							<td><?php echo $turma ?></td>
							<td><?php echo $nome_disc ?></td>
							<td><?php echo $tipo ?></td>
							<td><?php echo $data_avF ?></td>
							<td><?php echo $nota_maxF ?></td>
							<td><?php echo $notaF ?></td> 
							<td><?php echo $percentualF ?> %</td>                            
                                               				 
						</tr>		
            			<?php }  ?>
	 				</tbody>
 				</table>

	

<br>
<p align="center">
<?php echo ($cidade_escola) .',  '. $data_hoje ?>
</p>
<br><br>
<p align="center">
_________________________________________________<br>
<br>Prof. _______________________________

</p>



				<div class="footer">
		<p style="font-size:14px" align="center"><?php echo $rodape_relatorios ?></p> 
	</div>

				</body>
				</html>
