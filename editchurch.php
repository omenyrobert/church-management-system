<?php
  require_once('connection.php');
  $upload_dir = 'uploads/';

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "select * from church where id=".$id;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
    }else {
      $errorMsg = 'Could not Find Any Record';
    }
  }

  if(isset($_POST['edit'])){
		$name = $_POST['name'];
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
					unlink($upload_dir.$row['image']);
					move_uploaded_file($imgTmp ,$upload_dir.$userPic);
				}else{
					$errorMsg = 'Image too large';
				}
			}else{
				$errorMsg = 'Please select a valid image';
			}
		}else{

			$userPic = $row['image'];
		}

		if(!isset($errorMsg)){
			$sql = "update church
									set name = '".$name."',

										dob = '".$dob."',

                    gender = '".$gender."',

                    image = '".$userPic."',

                    address = '".$address."',
                    contact = '".$contact."',
                    ministry = '".$ministry."',
                    background = '".$background."'
					where id=".$id;
			$result = mysqli_query($conn, $sql);
			if($result){
				$successMsg = 'New record updated successfully';
				header('Location:database.php');
			}else{
				$errorMsg = 'Error '.mysqli_error($conn);
			}
		}

	}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>systrem</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
  </head>
  <body style="padding: 50px;">

        <div class="container">
        <a href="database.php">Back</a>
                <h3> Edit Church member</h3>
              </div>
              <div class="card-body" style="color: black; font-size: 20px; width: 400px;">
                <form  action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <p style="color: black;">Full Name</p>
                      <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>">
                      <br/>
                    </div>
                    <div class="form-group">
                      <p style="color: black;">Date Of Birth</p>
                      <input type="date" class="form-control" name="dob" value="<?php echo $row['dob'];?>">
                      <br/>
                    </div>
                    <div class="form-group">
                      <p style="color: black;">Gender</p>
                       <SELECT name="gender" class="form-control" >
                       <option value="<?php echo  $row['gender'];?>"><?php echo  $row['gender'];?></option>
                        <option value="Male" >Male</option>
                        <option value="Female" >Female</option>
                      </SELECT>
                      <br/>
                    </div>
                    <div class="form-group">
                      <p style="color: black;">Address</p>
                      <input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>">
                      <br/>
                    </div>
                    <div class="form-group">
                      <p style="color: black;">Contact</p>
                     <input type="type" name="contact" class="form-control" value="<?php echo $row['contact'];?>" >
                     <br/>
                    </div>
                     <div class="form-group">
                      <p style="color: black;">Ministry</p>
                      <SELECT name="ministry" class="form-control">
                      <option value="<?php echo  $row['ministry'];?>"><?php echo  $row['ministry'];?></option>
                        <option value="Men" >Men</option>
                        <option value="Women" >Women</option>
                        <option value="Children" >Children</option>
                        <option value="Youth" >Youth</option>
                        <option value="Married" >Married</option>
                        <option value="Pastoral" >Pastoral</option>
                        <option value="Worship" >Worship</option>
                        <option value="Usher" >Usher</option>
                        <option value="Elders" >Elders</option>
                        <option value="Intercessor" >Intercessor</option>
                      </SELECT>
                      <br/>
                    </div>

                    <div class="form-group">
                      <label>Membership</label>
                      <SELECT name="membership" class="form-control" >
                      <option value="<?php echo  $row['membership'];?>"><?php echo  $row['membership'];?></option>
                        <option value="staff" >Staff</option>
                        <option value="leader" >Leader</option>
                        <option value="member" >Member</option>
                      </SELECT>
                    </div>

                    <div class="form-group">
                      <label>Leader</label>
                      <SELECT name="leader" class="form-control" >
                      <option value="<?php echo  $row['leader'];?>"><?php echo  $row['leader'];?></option>
                        <option value="">none</option>
                        <option value="a.chairperson" >Chair person</option>
                        <option value="b.vice" >Vice Chair Person</option>
                        <option value="c.treasurer" >Treasurer</option>
                        <option value="d.cordinator" >Cordinator</option>
                        <option value="e.events" >Events</option>
                      </SELECT>
                    </div>



                    <div class="form-group col-md-3">
                      <p style="color: black;">Background</p>
                      <textarea type="text" style="width: 300px;" name="background" class="form-control"   placeholder="enter where the person came from">
                        <?php echo $row['background']; ?>
                      </textarea>
                      <br/>
                    </div>
                    <div class="form-group">
                      <p style="color: black;">Choose Image</p>
                      
                        <img src="<?php echo $upload_dir.$row['image'] ?>" width="200">
                        <input type="file" class="form-control" name="image">
                        <br/>
                      </div>
                    </div>
                    <br/>
                    <div class="form-group">
                      <button type="submit" name="edit" class="btn btn-primary">Update</button>
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
