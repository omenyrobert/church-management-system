<?php
	require_once'connection.php';
 
	if(ISSET($_REQUEST['id'])){
		$id=$_REQUEST['id'];
 
		$conn->query("DELETE FROM `furniture` WHERE `id`='$id'") or die("Failed to delete a row!");
		header('location:furniture.php');
	}
?>




