<?php
require_once'connection.php';

if(ISSET($_REQUEST['id'])){
		$id=$_REQUEST['id'];
 
		$conn->query("DELETE FROM `pendingadmins` WHERE `id`='$id'") or die("Failed to delete a row!");
	echo "<script>alert('Request rejected successfully')</script>";
			echo "<script>window.location='approve.php'</script>";
	}

	?>