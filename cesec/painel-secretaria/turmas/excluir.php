<?php 
require_once("../../conexao.php"); 

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM alunos where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	 echo 'Ainda há alunos matriculados nesta turma. Exclua-os antes de concluir!';
	exit();
}else{

    $pdo->query("DELETE FROM turmas WHERE id = '$id'");

echo 'Excluído com Sucesso!';
}

?>