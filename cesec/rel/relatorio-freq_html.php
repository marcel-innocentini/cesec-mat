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
	<title>Relatório de Frequências</title>
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
        <p align="center"><b>RELATÓRIO DE FREQUÊNCIAS DO ALUNO</b></p>
        <br></br>

<p><b>DADOS DO ALUNO: </b></p>
<p><?php echo strtoupper($nome_aluno) ?>, brasileiro(a), cadastrado neste CESEC sob nº <?php echo $cadastro ?>, telefone <?php echo $telefone ?>, email <?php echo $email ?>.</p>
<br>

<p>
<b>DADOS DA UNIDADE ESCOLAR:</b></p>
<p> <?php echo $nome_escola ?>, com sede na <?php echo $endereco_escola ?>, inscrita no CNPJ sob o nº <?php echo $cnpj_escola ?>, e no Cadastro Estadual sob o nº 65.6541.651-23.47</p>
<br>
<br>
<p><b>FREQUÊNCIAS DO ALUNO:</b></p>
		
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Turma</th>
                            <th>Disciplina</th>	
                            <th>Data</th>
                            <th>Entrada</th>
                            <th>Saída</th>
							<th>C. H. diária</th>
							
						</tr>
					</thead>

					<tbody>
						<?php
						//DADOS DAS NOTAS

						$saida = "saida";
						$query_2 = $pdo->query("SELECT * FROM frequencia where aluno = '$id' and tipo = '$saida' ");
						$res_2 = $query_2->fetchAll(PDO::FETCH_ASSOC);

						for ($i=0; $i < count($res_2); $i++) { 
							foreach ($res_2[$i] as $key => $value) {
							}                      
							$turma = $res_2[$i]['turma'];
							$tipo = $res_2[$i]['tipo'];
							$data_freq = $res_2[$i]['data_freq'];
							$hora_saida = $res_2[$i]['hora_freq'];	
							$carga_horaria = $res_2[$i]['carga_horaria'];
							$data_freqF = implode('/', array_reverse(explode('-', $data_freq)));

							if($carga_horaria == "00:00:00"){
								$carga_horaria = "";
							}else{
								$carga_horaria = $carga_horaria;
							}

							$entrada = "entrada";
							$query_7 = $pdo->query("SELECT * FROM frequencia where aluno = '$id' and data_freq = '$data_freq' and tipo = '$entrada' ");
							$res_7 = $query_7->fetchAll(PDO::FETCH_ASSOC);
							$hora_entrada = $res_7[0]['hora_freq'];														
							                      

							$query_3 = $pdo->query("SELECT * FROM turmas where id = '$turma' ");
							$res_3 = $query_3->fetchAll(PDO::FETCH_ASSOC);
							
							$disciplina = $res_3[0]['disciplina'];	
							$professor = $res_3[0]['professor'];	
							

							$query_5 = $pdo->query("SELECT * FROM disciplinas where id = '$disciplina' ");
							$res_5 = $query_5->fetchAll(PDO::FETCH_ASSOC);
							$nome_disc = @$res_5[0]['nome'];

							$query_6 = $pdo->query("SELECT * FROM professores where id = '$professor' ");
							$res_6 = $query_6->fetchAll(PDO::FETCH_ASSOC);
							$nome_prof = @$res_6[0]['nome'];
							$cpf_prof = @$res_6[0]['cpf'];

						?>	
		
						<tr>
							<td><?php echo $turma ?></td>
							<td><?php echo $nome_disc ?></td>
							<td><?php echo $data_freqF ?></td>
							<td><?php echo $hora_entrada ?></td>							 
							<td><?php echo $hora_saida ?></td>  
							<td><?php echo $carga_horaria ?></td>                            
                                               				 
						</tr>		
            			<?php }  ?>
	 				</tbody>
 				</table>
				 <br>

				 <p><b>CONTROLE MENSAL DE FREQUÊNCIA</b></p>	
		
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					
					<tbody>
						<?php
						//DADOS DAS FREQUENCIAS
						$query_7 = $pdo->query("SELECT * FROM frequencia where aluno = '$id' and tipo = 'saida' and MONTH(data_freq) = '01' ");
						$res_7 = $query_7->fetchAll(PDO::FETCH_ASSOC);
						$freq_jan = count($res_7);

						$query_8 = $pdo->query("SELECT * FROM frequencia where aluno = '$id' and tipo = 'saida' and MONTH(data_freq) = '02' ");
						$res_8 = $query_8->fetchAll(PDO::FETCH_ASSOC);
						$freq_fev = count($res_8);

						$query_9 = $pdo->query("SELECT * FROM frequencia where aluno = '$id' and tipo = 'saida' and MONTH(data_freq) = '03' ");
						$res_9 = $query_9->fetchAll(PDO::FETCH_ASSOC);
						$freq_mar = count($res_9);

						$query_10 = $pdo->query("SELECT * FROM frequencia where aluno = '$id' and tipo = 'saida' and MONTH(data_freq) = '04' ");
						$res_10 = $query_10->fetchAll(PDO::FETCH_ASSOC);
						$freq_abr = count($res_10);

						$query_11 = $pdo->query("SELECT * FROM frequencia where aluno = '$id' and tipo = 'saida' and MONTH(data_freq) = '05' ");
						$res_11 = $query_11->fetchAll(PDO::FETCH_ASSOC);
						$freq_mai = count($res_11);

						$query_12 = $pdo->query("SELECT * FROM frequencia where aluno = '$id' and tipo = 'saida' and MONTH(data_freq) = '06' ");
						$res_12 = $query_12->fetchAll(PDO::FETCH_ASSOC);
						$freq_jun = count($res_12);

						$query_13 = $pdo->query("SELECT * FROM frequencia where aluno = '$id' and tipo = 'saida' and MONTH(data_freq) = '07' ");
						$res_13 = $query_13->fetchAll(PDO::FETCH_ASSOC);
						$freq_jul = count($res_13);

						$query_14 = $pdo->query("SELECT * FROM frequencia where aluno = '$id' and tipo = 'saida' and MONTH(data_freq) = '08' ");
						$res_14 = $query_14->fetchAll(PDO::FETCH_ASSOC);
						$freq_ago = count($res_14);

						$query_15 = $pdo->query("SELECT * FROM frequencia where aluno = '$id' and tipo = 'saida' and MONTH(data_freq) = '09' ");
						$res_15 = $query_15->fetchAll(PDO::FETCH_ASSOC);
						$freq_set = count($res_15);

						$query_16 = $pdo->query("SELECT * FROM frequencia where aluno = '$id' and tipo = 'saida' and MONTH(data_freq) = '10' ");
						$res_16 = $query_16->fetchAll(PDO::FETCH_ASSOC);
						$freq_out = count($res_16);

						$query_17 = $pdo->query("SELECT * FROM frequencia where aluno = '$id' and tipo = 'saida' and MONTH(data_freq) = '11' ");
						$res_17 = $query_17->fetchAll(PDO::FETCH_ASSOC);
						$freq_nov = count($res_17);

						$query_18 = $pdo->query("SELECT * FROM frequencia where aluno = '$id' and tipo = 'saida' and MONTH(data_freq) = '12' ");
						$res_18 = $query_18->fetchAll(PDO::FETCH_ASSOC);
						$freq_dez = count($res_18);

						$freq_anual = $freq_jan + $freq_fev + $freq_mar + $freq_abr + $freq_mai + $freq_jun + $freq_jul + $freq_ago + $freq_set + $freq_out + $freq_nov + $freq_dez;
						?>	

						<tr>
						<td><b>Meses</b></td>
						<td>Jan</td>
						<td>Fev</td>
						<td>Mar</td>
						<td>Abr</td>
						<td>Mai</td>
						<td>Jun</td>
						<td>Jul</td>
						<td>Ago</td>
						<td>Set</td>
						<td>Out</td>
						<td>Nov</td>
						<td>Dez</td>
						<td><b>Total</b></td>
						</tr>
						<tr>
						<td><b>Presenças</b></td>
						<td><?php echo $freq_jan ?></td>
						<td><?php echo $freq_fev ?></td>
						<td><?php echo $freq_mar ?></td>
						<td><?php echo $freq_abr ?></td>
						<td><?php echo $freq_mai ?></td>
						<td><?php echo $freq_jun ?></td>
						<td><?php echo $freq_jul ?></td>
						<td><?php echo $freq_ago ?></td>
						<td><?php echo $freq_set ?></td>
						<td><?php echo $freq_out ?></td>
						<td><?php echo $freq_nov ?></td>
						<td><?php echo $freq_dez ?></td>
						<td><b><?php echo $freq_anual ?></b></td>
						</tr>
						</tbody>
						</table>
						            			
	 				</tbody>
 				</table>


<p align="center">
<?php echo ($cidade_escola) .'  '. $data_hoje ?>
</p>
<br><br>
<p align="center">
_________________________________________________<br>
<br>Prof. ________________________________
	
</p>



				<div class="footer">
		<p style="font-size:14px" align="center"><?php echo $rodape_relatorios ?></p> 
	</div>

				</body>
				</html>
