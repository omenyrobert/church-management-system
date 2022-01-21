	<?php
			require_once'connection.php';
		if(ISSET($_POST['update'])){
		$id = $_POST['id'];
		$date = $_POST['date'];
		$amount = $_POST['amount'];
		$texpense = $_POST['texpense'];
		$comment = $_POST['comment'];

		$sql = "UPDATE expense SET date = '$date', amount = '$amount', texpense = '$texpense', comment='$comment'  WHERE id = '$id'";
 
		$conn->query($sql);
	echo "<script>alert('information updated successfully')</script>";
			echo "<script>window.location='expenditure.php'</script>";


	}
		

