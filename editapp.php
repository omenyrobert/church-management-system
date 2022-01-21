	<?php
			require_once'connection.php';
		if(ISSET($_POST['edit'])){
		$id = $_POST['id'];
		$staff = $_POST['staff'];
		$person = $_POST['person'];
		$about = $_POST['about'];
		$ddate = $_POST['ddate'];
		$ttime = $_POST['ttime'];
		$contact = $_POST['contact'];

		$sql = "UPDATE appointments SET staff = '$staff', person = '$person', about = '$about', ddate='$ddate', ttime='$ttime', contact='$contact'  WHERE id = '$id'";
 
		$conn->query($sql);
	echo "<script>alert('information updated successfully')</script>";
			echo "<script>window.location='schedules.php'</script>";


	}
		

