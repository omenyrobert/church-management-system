	<?php
			require_once'connection.php';
			
		if(ISSET($_POST['conf'])){
		$date = $_POST['date'];
		$amount = $_POST['amount'];
		$texpense = $_POST['texpense'];
		$comment = $_POST['comment'];

	
$sql = "INSERT INTO confirmed (date, amount, texpense, comment) VALUES ('$date','$amount', '$texpense','$comment')";
 
		$conn->query($sql);
	echo "<script>alert('request confirmed successfully')</script>";
			echo "<script>window.location='approve.php'</script>";





	}
		


		

