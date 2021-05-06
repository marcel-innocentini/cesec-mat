<?php 
require_once("../../conexao.php"); 

$turma = $_POST['turma'];
$tipo = $_POST['tipo'];
$nota_max = (str_replace(",",".",$_POST['nota_max']))*100;
$data_av = $_POST['data_av'];
$id = $_POST['txtid2'];


if($id == ""){
	$res = $pdo->prepare("INSERT INTO avaliacao SET turma = :turma, tipo = :tipo, nota_max = :nota_max, data_av = :data_av");        	
	
}else{
	$res = $pdo->prepare("UPDATE avaliacao SET turma = :turma, tipo = :tipo, nota_max = :nota_max, data_av = :data_av WHERE id = '$id'");	
}

$res->bindValue(":turma", $turma);
$res->bindValue(":tipo", $tipo);
$res->bindValue(":nota_max", $nota_max);
$res->bindValue(":data_av", $data_av);
$res->execute();

if($id == ""){
	$id_avaliacao = $pdo->lastInsertId();

	$query2 = $pdo->query("SELECT * FROM matriculas WHERE turma = '$turma' ");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC); 
    for ($i=0; $i < count($res2); $i++) { 
        foreach ($res2[$i] as $key => $value) {
		}           
		$id_aluno = $res2[$i]['aluno'];     
		$res3 = $pdo->prepare("INSERT INTO notas SET turma = :turma, aluno = '$id_aluno', avaliacao = '$id_avaliacao', nota = :nota"); 
		
		$res3->bindValue(":turma", $turma);
		$res3->bindValue(":nota", "");
		
		$res3->execute();	
		 
	}
}

echo 'Salvo com Sucesso!';

?>