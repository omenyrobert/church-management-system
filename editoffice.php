	<?php
			require_once'connection.php';
		if(ISSET($_POST['update'])){
		$id = $_POST['id'];
		$item = $_POST['item'];
		$det = $_POST['det'];
		$qty = $_POST['qty'];
		$con = $_POST['con'];

		$sql = "UPDATE office SET item = '$item',  det = '$det' , qty = '$qty', con='$con' WHERE id = '$id'";
 
		$conn->query($sql);
	echo "<script>alert('information updated successfully')</script>";
			echo "<script>window.location='office.php'</script>";


	}
		

