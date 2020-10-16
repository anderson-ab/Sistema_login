<?php
	require 'usuarios.php';
	$user = new Usuario; 
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Registrar</title>
        <link href="CSS/estilo.css" rel="stylesheet">
		<link href="CSS/cadastro.css" rel="stylesheet">
        
    </head>
    <body>
        <div id="tela-cadastro">
            <h1>Cadastrar usuário</h1>
            <form method="POST">
                <input type="text" name="nome" placeholder="Nome completo"/>
                <input type="text" name="telefone" placeholder="Telefone"/>
                <input type="email" name="email" placeholder="E-mail"/>
                <input type="password" name="senha" placeholder="Senha" minlength="6" maxlenght="12" required/>
				<input type="password" name="confirmarSenha" placeholder="Confirmar senha" maxlenght="12" required/>
				<input type="submit" name="btnCadastrar" value="Cadastrar"/>
            </form><br>
				<a href="index.php">Voltar para Login</a>
        </div>
        <?php
        //verificar se o usuario está enviando informações
		if (isset($_POST['nome']))
		{
			$nome = addslashes($_POST['nome']);
			$telefone = addslashes($_POST['telefone']);
			$email = addslashes($_POST['email']);
			$senha = addslashes($_POST['senha']);
			$confirmarSenha = addslashes($_POST['confirmarSenha']);
			
			if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha))
			{
				$user -> conectar("usuarios", "localhost", "root", "");
				if($user->msgErro == ""){
					if($senha == $confirmarSenha){
						if($user->cadastrar($nome, $email, $senha, $telefone)){
							?>
								<div class="msg-sucesso">
								Cadastrado com sucesso!
								</div>
							<?php
						} else {
							?>
							<div class="msg-erro">
							E-mail já cadastrado!
							</div>
							<?php
							}
					} else {
							?>
							<div class="msg-erro">
							Senha e Confirmar Senha não correspondem!
							</div>
							<?php
						}
				} else {
					echo "ERRO!".$user->msgErro;
					}
					
			} else {
				?>
				<div  class="msg-erro">
				Preencha todos os dados
				</div>
				<?php
				}
		}
        ?>
    </body>
</html>

