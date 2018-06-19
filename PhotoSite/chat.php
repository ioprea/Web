<?php

	require_once 'database.php';
	if (!isset($_SESSION['username'])) {
		echo "Fail";
		die();
	}

	addChat($_SESSION['username'],$_POST['message']);

?>
