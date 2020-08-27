
<?php
include 'config.php';
include 'contatos.class.php';
$contatos = new Contato($pdo);

if(!empty($_GET['id'])){
	$id = $_GET['id'];
	$info = $contatos->getInfo($id);
		if(empty($info['email'])){
			header("Location: /projeto_contato");
			exit;
		}
}else{
	header("Location: /projeto_contato");
	exit;
}

?>



<h1>EDITAR</h1>

<form method="POST" action="editar_submit.php">

	<input type="hidden" name="id" value="<?php echo $info['id']; ?>">

	Nome: <br/>
	<input type="text" name="nome" value="<?php echo $info['nome']; ?>"> <br/><br/>

	Email: <br/>
	<input type="email" name="email" value="<?php echo $info['email']; ?>"><br/><br/>

	<input type="submit" value="Salvar">
	
</form>