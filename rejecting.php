<?php
	require_once'connection.php';

if(isset($_POST['approve'])){
	$id = $_POST['id'];
    $reason = $_POST['reason'];

  	$insert_data = "UPDATE `church` SET  reason='$reason', status='2' WHERE id='$id'";
  	$run_data = mysqli_query($conn,$insert_data);

  	if($run_data){
  			echo "<script>alert('Rejected successfully')</script>";
          	echo "<script>window.location='approvedatabase.php'</script>";
  	}else{
 			echo "<script>alert('information not saved successfully')</script>";
	 echo "<script>window.location='database.php'</script>";
}
}

?>

