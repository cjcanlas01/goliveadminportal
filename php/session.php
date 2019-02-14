<?php
	session_start();
	if (!$_SESSION['username'] && !$_SESSION['password']) {
	    header('Location: index.php');
	    exit();
	}
?>