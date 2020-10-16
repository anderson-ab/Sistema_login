<!DOCTYPE html>
<?php
	require 'usuarios.php';
	$user = new Usuario;
?>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link href="CSS/estilo.css" rel="stylesheet">
		<link href="CSS/cadastro.css" rel="stylesheet">
    </head>
    <body>
        <div id="tela-login">
        <h1>Login</h1>
        <form method="POST">
            <input type="email" name="email" placeholder="Usuário">
            <input type="password" name="senha"placeholder="Senha">
            <input type="submit" name="btnEntrar" value="Entrar">
            <a href="cadastro.php">Ainda não é inscrito? <strong>Registre-se</strong></a><br>
			<a href="recuperar.php">Esqueceu a senha?</a>
        </form>
        </div>
		
        <?php		
			if (isset($_POST['email'])){
			$email = addslashes($_POST['email']);
			$senha = addslashes($_POST['senha']);
			
				if(!empty($email) && !empty($senha))
				{
					$user->conectar("usuarios", "localhost", "root", "");
					if($user->msgErro == ""){
						if($user->entrar($email, $senha)) {	
							header("location: restrito.php");
						} else {
							?>
								<div class="msg-erro">
								E-mail e/ou senha inválido(s)
								</div>
							<?php
						}
					}else{
						
						echo "ERRO ".$msgErro;
					}
						
				} else {
					?>
					<div class="msg-erro">
					Preencha todos os campos
					</div>
					<?php
				}
			}
        ?>
		
    </body>
</html>
