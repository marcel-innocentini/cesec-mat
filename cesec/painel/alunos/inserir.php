<?php 
require_once("../../conexao.php"); 

$nome = $_POST['nome'];
$cadastro = $_POST['cadastro'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];

$antigo = $_POST['antigo'];

$id = $_POST['txtid2'];



if($nome == ""){
	echo 'O nome é Obrigatório!';
	exit();
}

if($cadastro == ""){
	echo 'O cadastro é Obrigatório!';
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
if($antigo != $cadastro){
	$query = $pdo->query("SELECT * FROM alunos where cadastro = '$cadastro' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		echo 'O cadastro já existe no sistema!';
		exit();
	}
}


if($id == ""){
	$res = $pdo->prepare("INSERT INTO alunos SET nome = :nome, cadastro = :cadastro, telefone = :telefone, email = :email");	

}else{	
		$res = $pdo->prepare("UPDATE alunos SET nome = :nome, cadastro = :cadastro, telefone = :telefone, email = :email WHERE id = '$id'");	
	}
		
	

$res->bindValue(":nome", $nome);
$res->bindValue(":cadastro", $cadastro);
$res->bindValue(":telefone", $telefone);
$res->bindValue(":email", $email);



$res->execute();

echo 'Salvo com Sucesso!';

?>