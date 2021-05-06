<?php 
require_once("../../conexao.php"); 

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];

$antigo = $_POST['antigo'];

$id = $_POST['txtid2'];



if($nome == ""){
	echo 'O nome é Obrigatório!';
	exit();
}

if($cpf == ""){
	echo 'O CPF é Obrigatório!';
	exit();
}

if($email == ""){
	echo 'O email é Obrigatório!';
	exit();
}

if($telefone == ""){
	echo 'O telefone é Obrigatório!';
	exit();
}





//VERIFICAR SE O REGISTRO JÁ EXISTE NO BANCO
if($antigo == $cpf){
	$query = $pdo->query("SELECT * FROM professores where cpf = '$cpf' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		echo 'O CPF já existe no sistema!';
		exit();
	}
}


if($id == ""){
	$res = $pdo->prepare("INSERT INTO professores SET nome = :nome, cpf = :cpf, telefone = :telefone, email = :email");	

}else{	
		$res = $pdo->prepare("UPDATE professores SET nome = :nome, cpf = :cpf, telefone = :telefone, email = :email WHERE id = '$id'");	
	}
		
	

$res->bindValue(":nome", $nome);
$res->bindValue(":cpf", $cpf);
$res->bindValue(":telefone", $telefone);
$res->bindValue(":email", $email);



$res->execute();

echo 'Salvo com Sucesso!';

?>