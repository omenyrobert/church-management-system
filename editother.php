	<?php
			require_once'connection.php';
		if(ISSET($_POST['update'])){
		$id = $_POST['id'];
		$item = $_POST['item'];
		$det = $_POST['det'];
		$qty = $_POST['qty'];

		$sql = "UPDATE others SET item = '$item',  det = '$det' , qty = '$qty' WHERE id = '$id'";
 
		$conn->query($sql);
	echo "<script>alert('information updated successfully')</script>";
			echo "<script>window.location='otherassets.php'</script>";


	}
		

