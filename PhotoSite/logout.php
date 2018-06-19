<?php
require_once 'database.php';
session_unset();
session_destroy();
header("location:index.php");
?>
