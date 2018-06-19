<?php
require_once 'database.php';

$target_path = "images/";

if(isset($_POST['add_btn'])) {
	if(isset($_FILES['uploadedFile'])) {
	$target_path = $target_path . basename( $_FILES['uploadedFile']['name']); 
	}
}
 
if( move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $target_path)) { 
    echo basename( $_FILES['uploadedFile']['name']);

    addPhoto($_POST['newName'],
            "images/" . basename($_FILES['uploadedFile']['name']));

    header("location:chatPage.php");
} 
else {
    echo "Error"; 
}
?>