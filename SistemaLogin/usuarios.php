<?php

Class Usuario
{
	private	$pdo;
	public $msgErro = "";
	
	public function conectar($nome, $host, $usuario, $senha)
	{
		global $pdo;
		global $msgErro;
		try
		{
		$pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario, $senha);
		} 
		catch (PDOException $e){
			echo 'Falha na conexão'.$msgErro = $e->getMessage();
		}
	}
	public function cadastrar($nome, $email, $senha, $telefone)
	{
		global $pdo;
		//Verifica se o e-mail já está cadastrado
		$sql = $pdo -> prepare("SELECT cod_usuario FROM usuarios WHERE email = :e;");
		$sql->bindValue(":e",$email);
		$sql->execute();
		if($sql->rowCount() > 0){
			return false;
		} else {
			$sql = $pdo->prepare("INSERT INTO `usuarios` (`cod_usuario`, `nome`, `email`, `senha`, `foto`, `nascimento`, `telefone`) VALUES (NULL, :n, :e, :s, '', '', :t);");
			$sql->bindValue(':n',$nome);
			$sql->bindValue(':e',$email);
			$sql->bindValue(':s',md5($senha));
			$sql->bindValue(':t',$telefone);
			$sql->execute();
			return true;
		}
		
	}
	public function entrar($email, $senha)
	{
		global $pdo;
		$sql = $pdo->prepare("SELECT cod_usuario FROM usuarios WHERE email=:e AND senha=:s;");
		$sql->bindValue(':e', $email);
		$sql->bindValue(':s', md5($senha));
		$sql->execute();
		if($sql->rowCount() > 0) {
			//entra no sistema
			$dado = $sql->fetch();
			session_start();
			$_SESSION['cod_usuario'] = $dado['cod_usuario'];
			return true;
		} else {
			return false; 
		}
	}
	public function verificar($email)
	{
		global $pdo;
		$sql = $pdo->prepare("SELECT cod_usuario FROM usuarios WHERE email=:e;");
		$sql->bindValue(':e', $email);
		$sql->execute();
		if($sql->rowCount() > 0) {
			
			return true;
		} else {
			return false; 
		}
	}

	public function redefinir($email, $senha)
	{
		global $pdo;
		//Verifica se o e-mail já está cadastrado
		$sql = $pdo -> prepare("SELECT cod_usuario FROM usuarios WHERE email = :e");
		$sql->bindValue(":e",$email);
		$sql->execute();
		if($sql->rowCount() > 0){
			$sql = $pdo->prepare("UPDATE usuarios set senha = :s where email = :e;");
			$sql->bindValue(':e',$email);
			$sql->bindValue(':s',md5($senha));
			$sql->execute();
			return true;			
		} else {
			return false;
		}
	}
	
}
?>