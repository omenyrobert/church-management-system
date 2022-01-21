	<?php
			require_once'connection.php';
		if(ISSET($_POST['update'])){
		$id = $_POST['id'];
		$date = $_POST['date'];
		$amount = $_POST['amount'];
		$tincome = $_POST['tincome'];
		$comment = $_POST['comment'];

		$sql = "UPDATE give SET date = '$date', amount = '$amount', tincome = '$tincome', comment='$comment'  WHERE id = '$id'";
 
		$conn->query($sql);
	echo "<script>alert('information updated successfully')</script>";
			echo "<script>window.location='income.php'</script>";


	}
		

