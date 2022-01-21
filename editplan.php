	<?php
			require_once'connection.php';
		if(ISSET($_POST['editpl'])){
		$id = $_POST['id'];
	    $plan = $_POST['plan'];
		$period = $_POST['period'];
		$comment = $_POST['comment'];

		$sql = "UPDATE plan SET plan = '$plan', period = '$period', comment='$comment'  WHERE id = '$id'";
 
		$conn->query($sql);
	echo "<script>alert('information updated successfully')</script>";
			echo "<script>window.location='schedules.php'</script>";


	}
		

