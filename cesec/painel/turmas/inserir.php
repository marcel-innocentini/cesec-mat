<?php 
require_once("../../conexao.php"); 

$disciplina = $_POST['disciplina'];
$data_inicio = $_POST['data_inicio'];
$data_final = $_POST['data_final'];
$horario = $_POST['horario'];
$dia = $_POST['dia'];
$ano = $_POST['ano'];
$professor = $_POST['professor'];
$carga_horaria = $_POST['carga_horaria'];

$id = $_POST['txtid2'];


if($id == ""){
	$res = $pdo->prepare("INSERT INTO turmas SET disciplina = :disciplina, data_inicio = :data_inicio, data_final = :data_final, horario = :horario, dia = :dia,  ano = :ano, professor = :professor, carga_horaria = :carga_horaria ");	

}else{
	$res = $pdo->prepare("UPDATE turmas SET disciplina = :disciplina, data_inicio = :data_inicio, data_final = :data_final, horario = :horario, dia = :dia, ano = :ano, professor = :professor, carga_horaria = :carga_horaria WHERE id = '$id'");
	
}

$res->bindValue(":disciplina", $disciplina);
$res->bindValue(":data_inicio", $data_inicio);
$res->bindValue(":data_final", $data_final);
$res->bindValue(":horario", $horario);
$res->bindValue(":dia", $dia);
$res->bindValue(":ano", $ano);
$res->bindValue(":professor", $professor);
$res->bindValue(":carga_horaria", $carga_horaria);


$res->execute();


echo 'Salvo com Sucesso!';

?>