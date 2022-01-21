<?php
  require_once('connection.php');
  $upload_dir = 'uploads/';

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "select * from pendingchurch where id=".$id;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
    }else {
      $errorMsg = 'Could not Find Any Record';
    }
  }

  if(isset($_POST['addd'])){
  $name = $_POST['name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $ministry = $_POST['ministry'];
    $background=$_POST['background'];

  //image upload

  $msg = "";
  $image = $_FILES['image']['name'];
  $target = "uploads/".basename($image);

  if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
      $msg = "Image uploaded successfully";
    }else{
      $msg = "Failed to upload image";
    }

    $insert_data = "INSERT INTO `church`(name, dob, gender, address, contact, ministry, background, image) VALUES
     ('$name', '$dob', '$gender', '$address', '$contact', '$ministry', '$background', '$image')";
    $run_data = mysqli_query($conn,$insert_data);

		  if($run_data){
        echo "<script>alert('information saved successfully')</script>";
            echo "<script>window.location='approve.php'</script>";
    }else{
      echo "<script>alert('information not saved successfully')</script>";
   echo "<script>window.location='approve.php'</script>";
}
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>abc</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
  </head>
  <body style="background-color: #9d0606; color: white;">

    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
      <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                Confirmed
              </div>
              <div class="card-body" style="color: black; font-size: 20px;">
                <form class="" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="name">Full Name</label>
                      <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>">
                    </div>
                    <div class="form-group">
                      <label for="contact">Date Of Birth</label>
                      <input type="date" class="form-control" name="dob" value="<?php echo $row['dob'];?>">
                    </div>
                    <div class="form-group">
                      <label for="email">Gender</label>
                       <SELECT name="gender" class="form-control" >
                        <option value="Male" >Male</option>
                        <option value="Female" >Female</option>
                      </SELECT>
                    </div>
                    <div class="form-group">
                      <label>Address</label>
                      <input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>">
                    </div>
                    <div class="form-group">
                      <label>Contact</label>
                     <input type="type" name="contact" class="form-control" value="<?php echo $row['contact'];?>" >
                    </div>
                     <div class="form-group">
                      <label>Ministry</label>
                      <input type="type" name="ministry" class="form-control" value="<?php echo $row['ministry']; ?>" >
                    </div>
                    <div class="form-group col-md-3">
                      <label>Background</label>
                      <textarea type="text" style="width: 300px;" name="background" class="form-control"   placeholder="enter where the person came from">
                        <?php echo $row['background']; ?>
                      </textarea>
                    </div>
                    <div class="form-group">
                      <label for="image">Choose Image</label>
                      <div class="col-md-4">
                        <img src="<?php echo $upload_dir.$row['image'] ?>" width="100">
                        <input type="file" class="form-control" value="<?php echo $upload_dir.$row['image'] ?>"  name="image" value="">
                      </div>
                    </div>
                    <br/>
                    <div class="form-group">
                      <button type="submit" name="addd" class="btn btn-primary waves">Approve</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    <script src="js/bootstrap.min.js" charset="utf-8"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" charset="utf-8"></script>
  </body>
</html>
