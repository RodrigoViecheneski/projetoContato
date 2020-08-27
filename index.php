<?php
session_start();
include 'config.php';
include 'usuarios.class.php';
include 'contatos.class.php';

if(!isset($_SESSION['logado'])){
	header("Location: login.php");
	exit;
}
$usuarios = new Usuarios($pdo);
$usuarios->setUsuario($_SESSION['logado']);

$contatos = new Contato($pdo);

//$contatos->adicionar('rodrigo@gmail.com', 'Rodrigo');

?>

<h1>CONTATOS</h1>
<?php if($usuarios->temPermissao('ADD')): ?>
<a href="adicionar.php">ADICIONAR</a><br><hr><br>
<?php endif; ?>
<a href="sair.php">SAIR</a><br><br>
<?php if($usuarios->temPermissao('SECRET')): ?>
<a href="usuarios.php">GESTÃO DE USUÁRIOS</a>
<?php endif; ?>

<table border="1" width="600px">
	<tr>
		<th>ID</th>
		<th>NOME</th>
		<th>E-MAIL</th>
		<th>AÇÕES</th>
	</tr>
	<?php
		$lista = $contatos->getAll();
		foreach ($lista as $item):
	?>
	<tr>
		<td><?php echo $item['id']; ?></td>
		<td><?php echo $item['nome']; ?></td>
		<td><?php echo $item['email']; ?></td>
		<td>
			<?php if($usuarios->temPermissao('EDIT')): ?>
			<a href="editar.php?id=<?php echo $item['id']; ?>">EDITAR |</a>
			<?php endif; ?>
			<?php if($usuarios->temPermissao('DEL')): ?>
			<a href="excluir.php?id=<?php echo $item['id']; ?>">EXCLUIR</a>
			<?php endif;?>
		</td>
	</tr>
	<?php endforeach;?>
</table>