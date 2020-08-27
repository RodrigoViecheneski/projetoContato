<?php
include 'config.php';
include 'contatos.class.php';
$contatos = new contato($pdo);

if(!empty($_POST['id'])){
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$id = $_POST['id'];

	if(!empty($email)){
		$contatos->editar($nome, $email, $id);
	}
	header("Location: /projeto_contato");
}