<?php
	session_start();
	if(!isset($_SESSION['cod_usuario']))
	{
		header("location: index.php");
		exit;
	}
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link href="CSS/estilo.css" rel="stylesheet">
    </head>
    <body>
        <div id="tela-login">
			<div>
				<h1>Área Restrita</h1>
				<a href="sair.php">Sair</a>
			</div>
		</div>
	</body>
</html>
        

