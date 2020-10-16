<!DOCTYPE html>

<html lang="pt-br">
<?php
	
	header("Content-type: text/html; charset=utf-8");
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese'); 
    date_default_timezone_set('America/Sao_Paulo'); 
 

	require ('PHPMailer-master/src/PHPMailer.php');
	require ('PHPMailer-master/src/SMTP.php');
	require ('PHPMailer-master/src/Exception.php');
	require ('usuarios.php');
	require ('recuperar.php');
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
	$mail = new PHPMailer(true);
	$user = new Usuario;

	if(isset($_POST['btnRecuperar'])){
			$email = addslashes($_POST['email']);
			$token = uniqid();
	        $_SESSION['email'] = $_POST['email'];
	        $_SESSION['token'] = $token;
				if(!empty($email))
				{
					$user->conectar("usuarios", "localhost", "root", "");
					if($user->msgErro == ""){
						if($user->verificar($email)) {

							$mail->SMTPDebug = SMTP::DEBUG_SERVER;
							$mail->isSMTP();
							$mail->Host = 'smtp.gmail.com';
							$mail->SMTPAuth = true;
							$mail-> Username = 'emailteste@gmail.com';
							$mail-> Password = 'teste@2020';
							$mail-> Port = 587;
							
							$mail->setFrom('andreivanminski@gmail.com');
							$mail->addAddress($email);
							
							$mail->isHTML(true);
							$mail->Subject = 'Redefinição de Senha';
							
							$url = 'http://localhost/SistemaLogin/redefinir.php';
													
							$mail->Body = "Foi solicitada uma redefinição da sua senha. Acesse o link abaixo para redefinir sua senha.<br>
					            <h3> <a href=".$url.'?token='.$_SESSION['token'].'">Redefinir a sua senha</a></h3> 
					            <br>            
					            Caso você não tenha solicitado essa redefinição, ignore esta mensagem.<br>';



							if($mail->send()){

								echo "<SCRIPT LANGUAGE='JavaScript'>
										window.alert('E-mail enviado com sucesso');
										window.location.href='recuperar.php';
										</SCRIPT>";
							} else {
								echo 'Email não enviado';
							}
							
							echo "<SCRIPT LANGUAGE='JavaScript'>
										window.alert('Link de redefinição enviado com sucesso');
										window.location.href='recuperar.php';
										</SCRIPT>";
						
						}else {
							echo '<div class="msg-erro">E-mail inválido</div>
							<SCRIPT LANGUAGE="JavaScript">
							window.location.href="recuperar.php";
							</SCRIPT>';
						} 
					}else{
						
						echo "ERRO".$msgErro;
					}
						
				} else {
					echo "Preencha todos os dados";
				}
		}	 
	
?>
</html>
