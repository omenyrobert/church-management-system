<?php

session_start();

	require_once'connection.php';


if (!isset($_SESSION['ID'])) {
  header("Location:index.php");
  exit();
}


$upload_dir = 'uploads/';

  if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql = "select * from pendingchurch where id = ".$id;
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_assoc($result);
      $image = $row['image'];
      unlink($upload_dir.$image);
      $sql = "delete from pendingchurch where id=".$id;
      if(mysqli_query($conn, $sql)){
        header('location:approve.php');
      }
    }
  }








	//offertory and giving
	if(ISSET($_POST['addex'])){
		$date = $_POST['date'];
		$amount = $_POST['amount'];
		$tincome = $_POST['tincome'];
		$comment = $_POST['comment'];

$sql = "INSERT INTO give (date, amount, tincome, comment) VALUES ('$date','$amount', '$tincome','$comment')";

		$conn->query($sql);

$id=$_REQUEST['id'];
$conn->query("DELETE FROM `pendingincome` WHERE `id`='$id'") or die("Failed to delete a row!");

		 header("location: approve.php");
            exit;
	} else
	{
		echo "";
	}








//delete give 
 if(ISSET($_REQUEST['id'])){
		$id=$_REQUEST['id'];
 
		$conn->query("DELETE FROM `pendingincome` WHERE `id`='$id'") or die("Failed to delete a row!");
echo "<script>alert('Request rejected successfully')</script>";
			echo "<script>window.location='approve.php'</script>";
	
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

   <div class="container-fluid">

   	  	<div  style="background-color: black; height: 300px;" class="container-fluid">
	 <div class="container" style="padding: 20px; ">
<img src="logo.png" width="50%" >
    <h3 style="margin-top: -50px;" >CHURCH MANAGEMENT SYSTEM</h3></div>
    <a href="dashboard.php">Back</a>
</center>
	<h2>CHURCH'S Requests</h2>
	<br/><br/><br/><br/>
</div>
      
  


       <div class="container">  
  <div class="tab-content">
    <div id="Ministries" class="tab-pane fade in active">
      <h3>Requested Income Entry</h3>
      <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>For</th>
						<th>comment</th>
						<td>Action</td>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `pendingincome` ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `pendingincome` ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['tincome'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>
	   		<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form_modal<?php echo $fetch['id'];?>"><span class="glyphicon glyphicon-edit"></span>approve</button> 
	   			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_<?php echo $fetch['id']; ?>">Reject</button>
	   		 </td>				
	   	</tr>




<div class="modal fade" style="color: black;" id="delete_<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        	<form method="POST" action="saverejected.php" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Reject</h4></center>
            </div>
            <div class="modal-body">	
            			<div class="form-group">
														<label>Date</label>
														<input type="hidden" name="id" value="<?php echo $fetch['id']?>"/>
														<input type="date" class="form-control" name="date" value="<?php echo $fetch['date'];?>" required="required"/>
													</div>
													<div class="form-group">
														<label>Amount</label>
														<input type="text" class="form-control" name="amount" value="<?php echo $fetch['amount']?>" required="required"/>
													</div>
                                                    
                                                    <div class="form-group ">
					<label>Type of income</label>
					<input type="text" class="form-control" name="tincome" value="<?php echo $fetch['tincome']?>" required="required"/>
				</div>
                                                    

                                                    <div class="form-group">
														<label>Reason</label>
														<input type="text" class="form-control" name="comment" value="<?php echo $fetch['comment']?>" required="required"/>
													</div>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button class="btn btn-danger" name="savere"><span class="glyphicon glyphicon-save"></span> Reject</button>
            </div>
         </form>
        </div>
    </div>
</div>







<div class="modal fade" id="form_modal<?php echo $fetch['id'];?>" style="color: black;" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<form method="POST" action="approve.php" >
											<div class="modal-header">
												<h3 class="modal-title">Approve</h3>
											</div>
											<div class="modal-body">
												<div class="col-md-2"></div>
												<div class="col-md-8">
													<div class="form-group">
														<label>Date</label>
														<input type="hidden" name="id" value="<?php echo $fetch['id']?>"/>
														<input type="text" class="form-control" name="date" value="<?php echo $fetch['date'];?>" required="required"/>
													</div>
													<div class="form-group">
														<label>Amount</label>
														<input type="text" class="form-control" name="amount" value="<?php echo $fetch['amount']?>" required="required"/>
													</div>
                                                    
                                                    <div class="form-group ">
					<label>Type of income</label>
					<input type="text" class="form-control" name="tincome" value="<?php echo $fetch['tincome']?>" required="required"/>
				</div>
                                                    

                                                    <div class="form-group">
														<label>Comment</label>
														<input type="text" class="form-control" name="comment" value="<?php echo $fetch['comment']?>" required="required"/>
													</div>

												</div>	
											</div>
											<div style="clear:both;"></div>
											<div class="modal-footer">
												<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-trash"></span> Close</button>
												<button class="btn btn-warning" name="addex"><span class="glyphicon glyphicon-save"></span> Approve</button>
											</div>
										</form>
									</div>
								</div>
							</div>





     <?php
   }



?>
</tbody>
<tr><td colspan="1" ><h1>The Total</h1></td>   <td><h1><?php echo $output;?></h1></td></tr>
</table>
    </div>








  <div class="container">  
  <div class="tab-content">
    <div id="Ministries" class="tab-pane fade in active">
      <h3>Requested Money</h3>
      <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>For</th>
						<th>comment</th>
						<td>Action</td>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `request` ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `request` ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['texpense'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>
	   		<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form_modal<?php echo $fetch['id'];?>"><span class="glyphicon glyphicon-edit"></span>confirm</button> 
	   			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_<?php echo $fetch['id']; ?>">Reject</button>
	   		 </td>				
	   	</tr>


<div class="modal fade" style="color: black;" id="delete_<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        	<form method="POST" action="saverejectedex.php">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Reject</h4></center>
            </div>
            <div class="modal-body">	
            			<div class="form-group">
														<label>Date</label>
														<input type="hidden" name="id" value="<?php echo $fetch['id']?>"/>
														<input type="date" class="form-control" name="date" value="<?php echo $fetch['date'];?>" required="required"/>
													</div>
													<div class="form-group">
														<label>Amount</label>
														<input type="text" class="form-control" name="amount" value="<?php echo $fetch['amount']?>" required="required"/>
													</div>
                                                    
                                                    <div class="form-group ">
					<label>Type of income</label>
					<input type="text" class="form-control" name="tincome" value="<?php echo $fetch['texpense']?>" required="required"/>
				</div>
                                                    

                                                    <div class="form-group">
														<label>Reason</label>
														<input type="text" class="form-control" name="comment" value="<?php echo $fetch['comment']?>" required="required"/>
													</div>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button class="btn btn-danger" name="savere"><span class="glyphicon glyphicon-save"></span> Reject</button>
            </div>
         </form>
        </div>
    </div>
</div>




<div class="modal fade" id="form_modal<?php echo $fetch['id'];?>" style="color: black;" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<form method="POST" action="confirmrequest.php" >
											<div class="modal-header">
												<h3 class="modal-title">Confirm</h3>
											</div>
											<div class="modal-body">
												<div class="col-md-2"></div>
												<div class="col-md-8">
													<div class="form-group">
														<label>Date</label>
														<input type="hidden" name="id" value="<?php echo $fetch['id']?>"/>
														<input type="text" class="form-control" name="date" value="<?php echo $fetch['date'];?>" required="required"/>
													</div>
													<div class="form-group">
														<label>Amount</label>
														<input type="text" class="form-control" name="amount" value="<?php echo $fetch['amount']?>" required="required"/>
													</div>
                                                    
                                                    <div class="form-group col-md-3">
					<label>Type of expenditure</label>
					<select class="form-control" name="texpense" class="form-control" style="width: 200px;" >
						<option value="Ministries">Ministries</option>
						<option value="Administration">Administration</option>
						<option value="Repair_and_Maintainace">Repair and Maintainace</option>
						<option value="Operational_Expense" >Operational Expense</option>
						<option value="Pastrol" >Pastrol</option>
                        <option value="Salary">Salary</option> 
                        <option value="Purchase">Purchase</option>
                        <option value="Church_Activities">Church Activities</option>
                        <option value="other">Other Expenditures</option>
					</select> 
				</div>
                                                    

                                                    <div class="form-group">
														<label>Comment</label>
														<input type="text" class="form-control" name="comment" value="<?php echo $fetch['comment']?>" required="required"/>
													</div>

												</div>	
											</div>
											<div style="clear:both;"></div>
											<div class="modal-footer">
												<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-trash"></span> Close</button>
												<button class="btn btn-warning" name="conf"><span class="glyphicon glyphicon-save"></span> Confirm</button>
											</div>
										</form>
									</div>
								</div>
							</div>





     <?php
   }



?>
</tbody>
<tr><td colspan="1" ><h1>The Total</h1></td>   <td><h1><?php echo $output;?></h1></td></tr>
</table>
    </div>
      <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Staff</th>
						<th>Person</th>
						<th>About</th>
						<th>Date</th>
						<th>Time</th>
						<th>Contact</th>
						<td>Action</td>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');


   $query=$conn->query("SELECT * FROM `pendingapp`  ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['staff'];?></td>
	   		<td><?php echo $fetch['person'];?></td>
	   		<td><?php echo $fetch['about'];?></td>
	   		<td><?php echo  $fetch['ddate'];?></td>
	   		<td><?php echo $fetch['ttime'];?></td>
	   		<td><?php echo $fetch['contact'];?></td>
	   		<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $fetch['id'];?>"><span class="glyphicon glyphicon-edit"></span> Confirm</button> 
	   		 |<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_<?php echo $fetch['id']; ?>">Reject</button></td>				
	   	</tr>


<div class="modal fade" style="color: black;" id="delete_<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        	<form method="POST" action="saverejectedap.php">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Reject</h4></center>
            </div>
            <div class="modal-body">	
            			<div class="form-group">
														<label>Date</label>
														<input type="hidden" name="id" value="<?php echo $fetch['id']?>"/>
														<input type="text" class="form-control" name="date" value="<?php echo $fetch['ddate'];?>" required="required"/>
													</div>
													<div class="form-group">
														<label>Person</label>
														<input type="text" class="form-control" name="amount" value="<?php echo $fetch['person']?>" required="required"/>
													</div>
                                                    
                                                    <div class="form-group ">
					<label>About</label>
					<input type="text" class="form-control" name="tincome" value="<?php echo $fetch['about']?>" required="required"/>
				</div>
                                                    

                                                    <div class="form-group">
														<label>Contact</label>
														<input type="text" class="form-control" name="comment" value="<?php echo $fetch['contact']?>" required="required"/>
													</div>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button class="btn btn-danger" name="savere"><span class="glyphicon glyphicon-save"></span> Reject</button>
            </div>
         </form>
        </div>
    </div>
</div>




<div class="modal fade" id="edit<?php echo $fetch['id'];?>" style="color: black;" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content" style="padding: 30px;">
                                                 


                                                 <form method="POST" action="approveapp.php"  enctype="multipart/form-data">
                   <input type="hidden" name="id" value="<?php echo $fetch['id']?>"/>
                   <div class="form-group">
					<label>Staff to meet </label>
					<input type="text" name="staff" required="required" value="<?php echo $fetch['staff']?>" class="form-control"/>
				</div>
                  
                  <div class="form-group">
					<label>Person</label>
					<input type="text" name="person" value="<?php echo $fetch['person']?>" required="required" class="form-control"/>
				</div>
               
                 <div class="form-group">
					<label>About</label>
					<input type="text" name="about" value="<?php echo $fetch['about']?>" required="required" class="form-control"/>
				</div>

				<div class="form-group">
					<label>Date</label>
					<input type="text" name="ddate" value="<?php echo $fetch['ddate']?>" required="required" class="form-control"/>
				</div>
				<div class="form-group">
					<label>Time</label>
					<input type="text" name="ttime" value="<?php echo $fetch['ttime']?>" required="required" class="form-control"/>
				</div>
				<div class="form-group">
					<label>Contact</label>
					<input type="text" name="contact" value="<?php echo $fetch['contact']?>" required="required" class="form-control"/>
				</div>
			
				<center><button class="btn btn-primary"  name="edit">Confirm</button></center>
			</form>


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









	


<script src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="datatable/jquery.dataTables.min.js"></script>
<script src="datatable/dataTable.bootstrap.min.js"></script>
<!-- generate datatable on our table -->

</body>
<footer style="background-color: black; color: white; height: 100px;">
<br/>
	<h4 align="center">Designed by Omeny Robert contact macrobert000@gmail.com whatsapp 0757227257</h4></footer>

</html>