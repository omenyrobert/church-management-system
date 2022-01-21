	<?php
			require_once'connection.php';
		if(ISSET($_POST['editv'])){
		$id = $_POST['id'];
	    $date = $_POST['date'];
		$name = $_POST['name'];
		$gender = $_POST['gender'];
		$address = $_POST['address'];
		$churchfrom = $_POST['churchfrom'];

		$sql = "UPDATE visitors SET date = '$date', name = '$name', gender='$gender',address='$address', churchfrom='$churchfrom'  WHERE id = '$id'";
 
		$conn->query($sql);
	echo "<script>alert('information updated successfully')</script>";
			echo "<script>window.location='schedules.php'</script>";


	}
		

