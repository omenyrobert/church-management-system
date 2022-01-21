	<?php
			require_once'connection.php';
			
		if(ISSET($_POST['savere'])){
		$date = $_POST['date'];
		$amount = $_POST['amount'];
		$tincome = $_POST['tincome'];
		$comment = $_POST['comment'];

 $sql = "INSERT INTO rejected (date, amount, tincome, comment) VALUES ('$date','$amount', '$tincome','$comment')";
 $conn->query($sql);

$id=$_REQUEST['id'];
 
$conn->query("DELETE FROM `pendingincome` WHERE `id`='$id'") or die("Failed to delete a row!");

	echo "<script>alert('request rejected successfully')</script>";
			echo "<script>window.location='approve.php'</script>";
	}
		