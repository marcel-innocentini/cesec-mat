<?php 
require_once("../../conexao.php"); 

$id_nota = $_POST['txtid2'];
$id_turma = $_POST['txtid3'];
$id_avaliacao = $_POST['txtid4'];
$id_aluno = $_POST['txtid5'];
$nova_nota = (str_replace(",",".",$_POST['nova_nota']))*100;
$nota_max = (str_replace(",",".",$_POST['txtid6']))*100;

if($nova_nota <= $nota_max){

	if($id_nota == ""){
		$res = $pdo->prepare("INSERT INTO notas SET turma = :id_turma, aluno = :id_aluno, avaliacao = :id_avaliacao, nota = :nova_nota");	

	}else{
		$res = $pdo->prepare("UPDATE notas SET turma = :id_turma, aluno = :id_aluno, avaliacao = :id_avaliacao, nota = :nova_nota WHERE id = '$id_nota'");
	}
		$res->bindValue(":id_turma", $id_turma);
		$res->bindValue(":id_aluno", $id_aluno);
		$res->bindValue(":id_avaliacao", $id_avaliacao);
		$res->bindValue(":nova_nota", $nova_nota);

		$res->execute();
		echo 'Salvo com Sucesso!';
}else{
	echo 'A nota atribuída não pode ser maior que a nota máxima.';
}

?>