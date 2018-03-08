<?php

session_start();

if(isset($_SESSION['usuario']) && isset($_SESSION['email'])) {
	unset($_SESSION['usuario']);
	unset($_SESSION['email']);
}

header('Location: index.php');

?>