<?php
	require_once'connection.php';
 
	if(ISSET($_REQUEST['id'])){
		$id=$_REQUEST['id'];
 
		$conn->query("DELETE FROM `report` WHERE `id`='$id'") or die("Failed to delete a row!");
		echo "<script>alert('information deleted successfully')</script>";
            echo "<script>window.location='report.php'</script>";
	}
?>




