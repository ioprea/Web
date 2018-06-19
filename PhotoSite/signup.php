<?php
  require_once 'database.php';

  addUser($_POST['username'],$_POST['password'], 1);
  header("location:index.php");

?>
