<?php 
require_once("../../conexao.php"); 

$entrada = $_POST['entrada'];
$saida = $_POST['saida'];
$id_turma = $_POST['txtid3'];
$id_aluno = $_POST['txtid4'];
$id_freq = $_POST['txtid2'];
$data_freq = date('Y-m-d');
$hora_freq = date('H:i:s');
$tipo = "";
$carga_horaria = 0;

//VERIFICAR SE JÁ FOI DADO ENTRADA PARA O ALUNO NO MESMO DIA
$query_1 = $pdo->query("SELECT * FROM frequencia WHERE aluno = '$id_aluno' and data_freq = '$data_freq' and tipo = 'entrada' ");
$res_1 = $query_1->fetchAll(PDO::FETCH_ASSOC);                                        
					  
$data_freq2 = count($res_1);

//VERIFICAR SE JÁ FOI DADO SAÍDA PARA O ALUNO NO MESMO DIA
$query_3 = $pdo->query("SELECT * FROM frequencia WHERE aluno = '$id_aluno' and data_freq = '$data_freq' and tipo = 'saida' ");
$res_3 = $query_3->fetchAll(PDO::FETCH_ASSOC);                                        
					  
$data_freq3 = count($res_3);


if ($entrada != ""){
	if($data_freq2 > 0){
		echo "Frequência de entrada já lançada hoje para este aluno!!!";
		exit();
	}else{
	$tipo = "entrada";
	$res = $pdo->prepare("INSERT INTO frequencia SET turma = :id_turma, aluno = :id_aluno, tipo = :tipo, data_freq = :data_freq, hora_freq = :hora_freq, carga_horaria = :carga_horaria ");
	
	$res->bindValue(":id_turma", $id_turma);
	$res->bindValue(":id_aluno", $id_aluno);
	$res->bindValue(":tipo", $tipo);
	$res->bindValue(":data_freq", $data_freq);
	$res->bindValue(":hora_freq", $hora_freq);
	$res->bindValue(":carga_horaria", $carga_horaria);

	$res->execute();
	echo 'Salvo com Sucesso!';
	}
}



if ($saida != ""){
	if($data_freq3 > 0){
		echo "Frequência de saída já lançada hoje para este aluno!!!";
		exit();
	}else{
	$tipo = "saida";
	//RECUPERAR HORARIO DA FREQUENCIA DE ENTRADA
	$query_2 = $pdo->query("SELECT * FROM frequencia WHERE aluno = '$id_aluno' and data_freq = '$data_freq' and tipo = 'entrada' ");
	$res_2 = $query_2->fetchAll(PDO::FETCH_ASSOC);                                        
						  
	$horario1 = $res_2[0]['hora_freq'];
	$horario2 = $hora_freq;
	$segundos = (strtotime($horario2) - strtotime($horario1));
	$carga_horaria = gmdate("H:i:s", $segundos);

	$res = $pdo->prepare("INSERT INTO frequencia SET turma = :id_turma, aluno = :id_aluno, tipo = :tipo, data_freq = :data_freq, hora_freq = :hora_freq, carga_horaria = :carga_horaria ");
	$res->bindValue(":id_turma", $id_turma);
	$res->bindValue(":id_aluno", $id_aluno);
	$res->bindValue(":tipo", $tipo);
	$res->bindValue(":data_freq", $data_freq);
	$res->bindValue(":hora_freq", $hora_freq);
	$res->bindValue(":carga_horaria", $carga_horaria);

	$res->execute();
	echo 'Salvo com Sucesso!';
	
	}
}
		

?>