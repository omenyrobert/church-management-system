<?php
        
        session_start();

	require_once'connection.php';

  if (!isset($_SESSION['ID'])) {
  header("Location:index.php");
  exit();
}




//delete give 
 if(ISSET($_REQUEST['id'])){
		$id=$_REQUEST['id'];
 
		$conn->query("DELETE FROM `rejected` WHERE `id`='$id'") or die("Failed to delete a row!");
		echo "<script>alert('deleted successfully')</script>";
			echo "<script>window.location='rejectedrequest.php'</script>";
	
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
	</style>
</head>
<body class="bod">
<div class="container-fluid">

   	<div  style="background-color: black; height: 250px;" class="container-fluid">
	 <div class="container" style="padding: 20px; ">
<img src="logo.png" width="50%" >
    <h3 style="margin-top: -50px; color: white;" >CHURCH MANAGEMENT SYSTEM</h3></div>
</center>
	<h4 style="color: white;">REJECTED REQUESTS</h4>
	<br/><br/><br/><br/>
      <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount/app</th>
						<th>type</th>
						<th>Reason</th>
						<th>Action</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');


   $query=$conn->query("SELECT * FROM `rejected`  ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['tincome'];?></td>
	   		<td><?php echo  $fetch['comment'];?></td>
	   		 <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_<?php echo $fetch['id']; ?>">Delete</button></td>				
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
				<h3 class="text-center">&nbsp;&nbsp;<?php echo $fetch['amount'].'<br/><br/>'.$fetch['tincome'].'<br/><br/> '.$fetch['comment']; ?></h3>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="rejectedrequest.php?id=<?php echo $fetch['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
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
</div>




			
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