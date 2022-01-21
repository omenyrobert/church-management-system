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
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 10;
}

.dropdown:hover .dropdown-content {
    display: block;
}
</style>
</head>
<body  style=" background-color: white; color: white; ">
<div class="container-fluid">
<?php include_once'topnav.php';?>

<div class="row">      
<div class="col-md-2" >
<?php include_once'sidenav.php';?>	
</div>   
       <div class="row">
 

                          <?php
                            $sql = "select * from church WHERE status='1'";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)){
                              while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <div class="col-md-3" style="padding: 5px; color: black;">
                          <div class="dropdown" style="border: 2px solid #f5f5f5; padding: 10px; border-radius: 15px;">
                          <div  style="width: 300px; height: 300px; ">
                          <img src="<?php echo $upload_dir.$row['image'] ?>" style="width: 90%; border-radius: 10px;">
                          </div>
                         
                          <div style="display: flex; justify-content: space-between;"> <h4><?php echo $row['name'] ?></h4>
                            <h4><?php echo $row['contact'] ?></h5> </div>
                           

                            <div class="dropdown-content" style="width: 300px; background-color: #fff; border-radius: 10px; padding: 10px;">
                              Date of Birth &nbsp;&nbsp;<?php echo $row['dob'] ?><br/>
                            Gender &nbsp;&nbsp;<?php echo $row['gender'] ?><br/>
                            Address &nbsp;&nbsp;</Address><?php echo $row['address'] ?><br/>
                          MInistry &nbsp;&nbsp;<?php echo $row['ministry'] ?><br/>
                            Background &nbsp;&nbsp; <?php echo $row['background'] ?>
                              </div>
                              </div>
                              </div>
                          <?php
                              }
                            }
                          ?>
                          </div>
                        

  

   

   			
</div>
</div>
</div>


<script src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="datatable/jquery.dataTables.min.js"></script>
<script src="datatable/dataTable.bootstrap.min.js"></script>
<!-- generate datatable on our table -->
<script>
$(document).ready(function(){
	//inialize datatable
    $('#myTable').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});

</script>
</body>

</html>