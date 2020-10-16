<?php
	require_once 'usuarios.php';
	$user = new Usuario; 
	

	
	if(isset($_GET['token'])){
         $token = preg_replace('/{^{:alnum:}}/','',$_GET['token']);

                   
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
            <h1>Redefinir Senha</h1>
            <form method="POST">

                <input type="email" name="email" placeholder="E-mail"/>
                <input type="password" name="senha" placeholder="Nova Senha" minlength="6" maxlenght="12" required/>
				<input type="password" name="confirmarSenha" placeholder="Confirmar Nova Senha" maxlenght="12" required/>
				<input type="submit" name="btnCadastrar" value="Redefinir"/>
            </form><br>
				<a href="index.php">Voltar para Login</a>
        </div>
        <?php


        if (isset($_POST['email']))
		{
			$email = addslashes($_POST['email']);
			$senha = addslashes($_POST['senha']);
			$confirmarSenha = addslashes($_POST['confirmarSenha']);
			
			if(!empty($email) && !empty($senha) && !empty($confirmarSenha))
			{
				$user -> conectar("usuarios", "localhost", "root", "");
				if($user->msgErro == ""){
					if($senha == $confirmarSenha){
						if($user->redefinir($email, $senha)){
							?>
								<div class="msg-sucesso">
								Senha redefinida com sucesso!
								</div>
							<?php
						} else {
							?>
							<div class="msg-erro">
							Erro!
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

		}else{
		 die('<h1>Página não encontrada</h1>');
         exit;
     	}
                
        ?>
    </body>
</html>