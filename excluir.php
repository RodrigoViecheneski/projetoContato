<?php
include 'config.php';
include 'contatos.class.php';
$contatos = new Contato($pdo);

if(!empty($_GET['id'])){
	$id = $_GET['id'];
	$contatos->excluir($id);
	header("Location: /projeto_contato");
}else{
	echo '<script type="text/javascript">alert("Erro ao excluir!");</script>';
	header("Location: /projeto_contato");
}