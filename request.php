<?php

session_start();

	require_once'connection.php';

if (!isset($_SESSION['ID'])) {
  header("Location:index.php");
  exit();
}


	//offertory and giving
	if(ISSET($_POST['addex'])){
		$date = $_POST['date'];
		$amount = $_POST['amount'];
		$texpense = $_POST['texpense'];
		$comment = $_POST['comment'];

$sql = "INSERT INTO request (date, amount, texpense, comment) VALUES ('$date','$amount', '$texpense','$comment')";
 
		$conn->query($sql);
		 header("location: request.php");
            exit;
	} else
	{
		echo "";
	}





//delete give 
 if(ISSET($_REQUEST['id'])){
		$id=$_REQUEST['id'];
 
		$conn->query("DELETE FROM `request` WHERE `id`='$id'") or die("Failed to delete a row!");
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
       

<h3>Make Request</h3>
   <form method="POST" action="request.php" enctype="multipart/form-data">
                 <div class="row">
				<div class="form-group col-md-3">
					<label>Date</label>
					<input type="date" name="date" required="required" class="form-control"/>
				</div>
				<div class="form-group col-md-3">
					<label>Amount</label>
					<input type="number" name="amount" required="required" class="form-control"/>
				</div>
				<div class="form-group col-md-3">
					<label>For</label>
					<select class="form-control" name="texpense" >
						<option value="Ministries">Ministries</option>
						<option value="Administration">Administration</option>
						<option value="Repair_and_Maintainace">Repair and Maintainace</option>
						<option value="Operational_Expense" >Operational Expense</option>
						<option value="Pastrol">Pastral</option>
                        <option value="Purchase">Purchase</option>
                        <option value="Salary"> Salary </option>
                        <option value="Church_Activities">Church Activities</option>
                        <option value="other">Other Expenditures</option>
					</select> 
				</div>
				<div class="form-group col-md-3">
					<label>Comment</label>
					<input type="text" name="comment" required="required" class="form-control"/>
				</div>
				<center><button class="btn btn-primary" onclick="return mess();" name="addex">Make Request</button></center>
			</div>
			</form>
			<script type="text/javascript">
    
    function mess(){
        alert ("Request added sucessfully");
        return true;
    }
</script>
       </div>
  


       <div class="container">  
  <div class="tab-content">
    <div id="Ministries" class="tab-pane fade in active">
      <h3>Request</h3>
      <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>For</th>
						<th>comment</th>
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
	   					
	   	</tr>





     <?php
   }



?>
</tbody>
<tr><td colspan="1" ><h1>The Total</h1></td>   <td><h1><?php echo $output;?></h1></td></tr>
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