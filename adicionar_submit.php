<?php
include 'config.php';
include 'contatos.class.php';
$contatos = new Contato($pdo);

if(!empty($_POST['email'])){
	$nome = $_POST['nome'];
	$email = $_POST['email'];

	$contatos->adicionar($email, $nome);

	header("Location: /projeto_contato");
}