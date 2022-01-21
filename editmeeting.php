	<?php
			require_once'connection.php';
		if(ISSET($_POST['editmeet'])){
		$id = $_POST['id'];
	    $about = $_POST['about'];
		$venue = $_POST['venue'];
		$ddate = $_POST['ddate'];
		$ttime = $_POST['ttime'];
		$comment = $_POST['comment'];

		$sql = "UPDATE meeting SET about = '$about', venue = '$venue', ddate = '$ddate', ttime='$ttime', comment='$comment'  WHERE id = '$id'";
 
		$conn->query($sql);
	echo "<script>alert('information updated successfully')</script>";
			echo "<script>window.location='schedules.php'</script>";


	}
		

