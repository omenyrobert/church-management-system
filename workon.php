
		 	<?php
			require_once'connection.php';

		if(ISSET($_POST['add'])){
       $id = $_POST['id'];
		$date = $_POST['date'];
		$amount = $_POST['amount'];
		$texpense = $_POST['texpense'];
		$comment = $_POST['comment'];

	



$sql = "INSERT INTO expense (id,date, amount, texpense, comment) VALUES ('$id','$date','$amount', '$texpense','$comment')";
 



 if ($conn->query($sql) === TRUE) {
  echo "<script>alert('request workedOn successfully')</script>";
		echo "<script>window.location='expenditure.php'</script>";
            exit;
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
	


	}
		

		

