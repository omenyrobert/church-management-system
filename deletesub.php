<?php
	require_once'connection.php';
 
	if(ISSET($_REQUEST['id'])){
		$id=$_REQUEST['id'];
 
		$conn->query("DELETE FROM `subb` WHERE `id`='$id'") or die("Failed to delete a row!");
		echo "<script>alert('deleted  sucessfully')</script>";
			echo "<script>window.location='income.php'</script>";
	}
?>




