<?php
class Contato{

	private $pdo;

	public function __construct($pdo){
		$this->pdo = $pdo;
	}

	public function adicionar($email, $nome){
		$emailexistente = $this->existeEmail($email);

		if(count($emailexistente) == 0){
			$sql = "INSERT INTO contatos VALUES(DEFAULT, :nome, :email)";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(':nome', $nome);
			$sql->bindValue(':email', $email);
			$sql->execute();
			return TRUE;
		}else{
			return FALSE;
		}
	}
	public function existeEmail($email){
		$sql ="SELECT id FROM contatos WHERE email = :email";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':email', $email);
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}else{
			$array = array();
		}
		return $array;
	}

	public function getAll(){
		$sql = "SELECT * FROM contatos";
		$sql = $this->pdo->query($sql);

		if($sql->rowCount() > 0){
			return $sql->fetchAll();
		}else{
			return array();
		}
	}

	public function getInfo($id){
		$sql = "SELECT * FROM contatos WHERE id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();

		if($sql->rowCount() > 0){
			return $sql->fetch();
		}else{
			return array();
		}
	}

	public function editar($nome, $email, $id){
		$emailexistente = $this->existeEmail($email);

		if(count($emailexistente) > 0 && $emailexistente['id'] != $id){
			return FALSE;
		}else{
			$sql = "UPDATE contatos SET nome = :nome, email = :email WHERE id = :id";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(':nome', $nome);
			$sql->bindValue(':email', $email);
			$sql->bindValue(':id', $id);
			$sql->execute();
			return TRUE;
		}
	}
	public function excluir($id){
		$sql = "DELETE FROM contatos WHERE id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();
	}
}