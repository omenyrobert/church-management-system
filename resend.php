<?php
	require_once'connection.php';

if(isset($_POST['resend'])){
  $id=$_POST['id'];
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

  	$insert_data = "UPDATE `church` set name='$name', dob='$dob', gender='$gender', address='$address', contact='$contact', ministry='$ministry', background='$background', image='$image',status='0', membership='$membership', leader='$leader' WHERE id='$id'";
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





<?php
  require_once('connection.php');
  $upload_dir = 'uploads/';

  if(isset($_POST['resend'])){
		$name = $_POST['name'];
        $id = $_POST['id'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $ministry = $_POST['ministry'];
     $background = $_POST['background'];


		$imgName = $_FILES['image']['name'];
		$imgTmp = $_FILES['image']['tmp_name'];
		$imgSize = $_FILES['image']['size'];

		if($imgName){

			$imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

			$allowExt  = array('jpeg', 'jpg', 'png', 'gif');

			$userPic = time().'_'.rand(1000,9999).'.'.$imgExt;

			if(in_array($imgExt, $allowExt)){

				if($imgSize < 5000000){
					move_uploaded_file($imgTmp ,$upload_dir.$userPic);
				}else{
					$errorMsg = 'Image too large';
				}
			}else{
				$errorMsg = 'Please select a valid image';
			}
		}else{
		}

		if(!isset($errorMsg)){
			$sql = "update church
									set name = '$name',

										dob = '$dob',

                    gender = '$gender',

                    image = '$userPic',

                    address = '$address',
                    contact = '$contact',
                    ministry = '$ministry',
                    background = '$background',
                    status='0',
					where id=".$id;
			$result = mysqli_query($conn, $sql);
			if($result){
				$successMsg = 'New record updated successfully';
				echo "<script>alert('Rejected successfully')</script>";
          	echo "<script>window.location='database.php'</script>";
			}else{
				$errorMsg = 'Error '.mysqli_error($conn);
			}
		}

	}

?>

