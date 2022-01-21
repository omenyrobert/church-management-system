<?php

session_start();
// Include database connection file
include_once('connection.php');

if (!isset($_SESSION['ID'])) {
	header("Location:index.php");
	exit();
}


$upload_dir = 'uploads/';

if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  $sql = "select * from church where id = ".$id;
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $image = $row['image'];
    unlink($upload_dir.$image);
    $sql = "delete from church where id=".$id;
    if(mysqli_query($conn, $sql)){
      header('location:database.php');
    }
  }
}

?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>System</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="datatable/dataTable.bootstrap.min.css">
	<style>
		.bod{
	background-color: #101b3c;
	color: white;
}
		.height10{
			height:10px;
		}
		.mtop10{
			margin-top:10px;
		}
		.modal-label{
			position:relative;
			top:7px
		}
    #tabs{
      border: 1px solid #075286;
    }
	</style>
</head>
<body  style=" background-color: white; color: white; ">
<div class="container-fluid">
<a style="color: black;" href="database.php">Back</a>
<p style="color: black;"  onclick="window.print();">print</p>
      <h4 style="color: black;">All Members</h4>
      <table id="myTable" class="table table-bordered" style="width:100%; color: black; background-color: white; ">
                        <thead>
                            <tr><th>Photo</th>
                                <th>Full Name</th>
                                <th>Leadership</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Ministry</th>
                            </tr>
                        </thead>
                        <tbody>
                    
                          <?php
                            $sql = "select * from church WHERE status='1' AND membership='Staff'";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)){
                              while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <tr style="color: black;" >
                            <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['dob'] ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['contact'] ?></td>
                            <td><?php echo $row['ministry'] ?></td>
                          </tr>
                          <?php
                              }
                            }
                          ?>
                        </tbody>
                      </table>
     

    </div>





   <br/>
   <br/>
 			
</div>
</div>
</div>


<script src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="datatable/jquery.dataTables.min.js"></script>
<script src="datatable/dataTable.bootstrap.min.js"></script>
<!-- generate datatable on our table -->

</body>

</html>