<?php
	require_once'connection.php';

if(isset($_POST['addd'])){
	$name = $_POST['name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $ministry = $_POST['ministry'];
    $background=$_POST['background'];
	$membership=$_POST['membership'];
	$leader=$_POST['leader'];

	//image upload

	$msg = "";
	$image = $_FILES['image']['name'];
	$target = "uploads/".basename($image);

	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}

  	$insert_data = "INSERT INTO `church`(name, dob, gender, address, contact, ministry, background, image,status,reason, membership,leader) VALUES
  	 ('$name', '$dob', '$gender', '$address', '$contact', '$ministry', '$background', '$image','1','', '$membership','$leader')";
  	$run_data = mysqli_query($conn,$insert_data);

  	if($run_data){
  			echo "<script>alert('information saved successfully')</script>";
          	echo "<script>window.location='database.php'</script>";
  	}else{
 			echo "<script>alert('information not saved successfully')</script>";
	 echo "<script>window.location='database.php'</script>";
}
}



?>

