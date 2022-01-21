<?php
session_start();
	require_once'connection.php';

if (!isset($_SESSION['ID'])) {
  header("Location:index.php");
  exit();
}

	//delete other
	if(ISSET($_REQUEST['id'])){
		$id=$_REQUEST['id'];
 
		$conn->query("DELETE FROM `admins` WHERE `id`='$id'") or die("Failed to delete a row!");
	
	}
	

?>






<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Account</title>
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
	</style>
</head>
<body class="bod">
<div class="container-fluid">
	<div class="container-fluid">

   	  	<div  style="background-color: black; height: 300px;" class="container-fluid">
	 <div class="container" style="padding: 20px; ">
<img src="logo.png" width="50%" >
    <h3 style="margin-top: -50px;" >CHURCH MANAGEMENT SYSTEM</h3></div>
</center>
	<h2>CHURCH'S ACCOUNTS</h2>
	<br/><br/><br/><br/>
</div>
<div class="row" style=" width: 100%;">

<div class="col-sm-9" style="display: flex;">
<a href="printmusic.php"><h4 style="color: white;">print</h4></a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="dashboard.php"><h4 style="color: white;">Dashboard</h4></a>&nbsp;&nbsp;&nbsp;&nbsp;
</div>
</div>


			
<table id="myTable" class="table table-bordered " style="color: white; width: 80%;">
  <h3>Manage Accounts</h3>
        <thead>
          <tr>
            <th>Name</th>
            <th>Username</th>
            <th>role</th>
            <td>Action</td>
          </tr>
        </thead>
<tbody>
<?php
include_once('connection.php');




   $query=$conn->query("SELECT * FROM `admins`") or die("Failed to fetch row!");
            while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
        <td><?php echo  $fetch['name'];?></td>
        <td><?php echo $fetch['username'];?></td>
        <td><?php echo $fetch['role'];?></td>
        <td>
          <?php if($_SESSION['ROLE'] == 'admin'){ ?>
         <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_<?php echo $fetch['id']; ?>">Delete</button>
           <?php } ?>
         </td>       
      </tr>



<div class="modal fade" style="color: black;" id="delete_<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Delete Record</h4></center>
            </div>
            <div class="modal-body">  
              <p class="text-center">Are you sure you want to Delete</p>
        <h3 class="text-center">Name&nbsp;&nbsp;<?php echo $fetch['name'].'<br/><br/>username '.$fetch['username'].'<br/><br/>Role '.$fetch['role']; ?></h3>
      </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="accounts.php?id=<?php echo $fetch['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>



     <?php
   }



?>
</tbody>

</table>
</div>
</div>
</div>









	


<script src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="datatable/jquery.dataTables.min.js"></script>
<script src="datatable/dataTable.bootstrap.min.js"></script>
<!-- generate datatable on our table -->

</body>
<footer style="background-color: black; color: white; height: 100px;">
<br/>
</html>