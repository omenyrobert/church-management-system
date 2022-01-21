<?php
require_once'connection.php';

 if(ISSET($_REQUEST['id'])){
		$id=$_REQUEST['id'];
 
		$conn->query("DELETE FROM `confirmed` WHERE `id`='$id'") or die("Failed to delete a row!");
		
echo "<script>alert('Request deleted successfully')</script>";
			echo "<script>window.location='expenditure.php'</script>";
	
	}
?>