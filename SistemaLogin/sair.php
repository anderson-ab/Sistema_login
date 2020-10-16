<?php
session_start();
unset($_SESSION['cod_usuario']);
header("location: index.php");
?>