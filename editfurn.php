	<?php
			require_once'connection.php';
			$id = $_GET['id'];

		if(ISSET($_POST['update'])){
        $id=$_POST['id'];
		$item = $_POST['item'];
		$det = $_POST['det'];
		$qty = $_POST['qty'];
		$con = $_POST['con'];

		$sql = "UPDATE furniture SET id='$id', item = '$item',  det = '$det' , qty = '$qty', con='$con' WHERE id = '$id'";
 
		$conn->query($sql);
	echo "<script>alert('information updated successfully')</script>";
		echo "<script>window.location='furniture.php'</script>";


	}
		

