	<?php
			require_once'connection.php';
		if(ISSET($_POST['updateother'])){
		$id = $_POST['id'];
		$date = $_POST['date'];
		$amount = $_POST['amount'];
		$project = $_POST['project'];
		$fro = $_POST['fro'];

		$sql = "UPDATE funds SET date = '$date', amount = '$amount', project = '$project', fro = '$fro'  WHERE id = '$id'";
 
		$conn->query($sql);
	echo "<script>alert('information updated successfully')</script>";
			echo "<script>window.location='otherincomes.php'</script>";


	}
		

