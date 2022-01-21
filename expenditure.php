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

$sql = "INSERT INTO expense (date, amount, texpense, comment) VALUES ('$date','$amount', '$texpense','$comment')";
 
		$conn->query($sql);
		 header("location: expenditure.php");
            exit;
	} else
	{
		echo "";
	}





//delete give 
 if(ISSET($_REQUEST['id'])){
		$id=$_REQUEST['id'];
 
		$conn->query("DELETE FROM `expense` WHERE `id`='$id'") or die("Failed to delete a row!");
	
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
</center>
	<h2>CHURCH'S Expenditure</h2>
	<a href="dashboard.php">Dashboard</a>
	<br/><br/><br/><br/>
</div>
       <div class="container">
       	<a href="printexpense.php"><h4 style="color: white;" >Go to print</h4></a>
       	<a href="ViewAllexpense.php"><h4 style="color: white;" >ViewAll</h4></a>
       	<a href="income.php"><h4 style="color: white;" >Income</h4></a>

<div class="container" >
	<h3>Requests for Money</h3>
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

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `confirmed` ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `confirmed` ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['texpense'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>
	   		<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form_modal<?php echo $fetch['id'];?>"><span class="glyphicon glyphicon-edit"></span>work on</button> 
	   			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_<?php echo $fetch['id']; ?>">Delete</button>
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
				<h3 class="text-center">Date&nbsp;&nbsp;<?php echo $fetch['date'].'<br/><br/>Amount '.$fetch['amount'].'<br/><br/>Comment '.$fetch['comment']; ?></h3>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="deleterequest.php?id=<?php echo $fetch['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>







<div class="modal fade" id="form_modal<?php echo $fetch['id'];?>" style="color: black;" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<form method="POST" action="workon.php" >
											<div class="modal-header">
												<h3 class="modal-title">Work On</h3>
											</div>
											<div class="modal-body">
												<div class="col-md-2"></div>
												<div class="col-md-8">
													<div class="form-group">
														<label>Date</label>
														<input type="hidden" name="id" value="<?php echo $fetch['id']?>"/>
														<input type="date" class="form-control" name="date" value="<?php echo $fetch['date'];?>" required="required"/>
													</div>
													<div class="form-group">
														<label>Amount</label>
														<input type="number" class="form-control" name="amount" value="<?php echo $fetch['amount']?>" required="required"/>
													</div>
                                                    
                                                    <div class="form-group">
					<label>for</label>
					<select class="form-control" name="texpense"  >
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
												<button class="btn btn-warning" type="submit" name="add"><span class="glyphicon glyphicon-save"></span> Work On</button>
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

<br/><br/>






   





<br/><br/>
<div style="display: flex; justify-content: space-between;" class="container" >
<a href="ministries.php" style="color: white;" >Ministries</a>	
<a href="pastrol.php" style="color: white;" >Pastrol</a>
<a href="salary.php" style="color: white;" >Salaries</a>
<a href="purchase.php" style="color: white;" >Purchase</a>
<a href="administration.php" style="color: white;" >Administration</a>
<a href="repair.php" style="color: white;" >Repair and Maintance</a>
<a href="activity.php" style="color: white;" >Church Activities</a>
<a href="otherex.php" style="color: white;" >Other Expenditures</a>

</div>
<br/><br/>




       <div class="container">
  <h2>Incomes of the church</h2>

  <ul class="nav nav-pills" style="background-color: black;" >
    <li class="active"><a data-toggle="pill" href="#Ministries" style="color: white;" >Ministries</a></li>
    <li><a data-toggle="pill" href="#Administration" style="color: white;" >Administration</a></li>
    <li><a data-toggle="pill" href="#Repair_and_Maintainace" style="color: white;" >Repair and Maintainace</a></li>
    <li><a data-toggle="pill" href="#Operational_Expense" style="color: white;" >Operational Expense</a></li>
    <li><a data-toggle="pill" href="#Pastrol" style="color: white;" >Pastrol</a></li>
    <li><a data-toggle="pill" href="#Personel_salaries" style="color: white;" >Personel/salaries</a></li>
    <li><a data-toggle="pill" href="#Purchase" style="color: white;" >Purchase</a></li>
     <li><a data-toggle="pill" href="#Church_Activities" style="color: white;" >Church Activities</a></li>
     <li><a data-toggle="pill" href="#otherex" style="color: white;" >Other Expenditures</a></li>
  </ul>
  
  <div class="tab-content">
    <div id="Ministries" class="tab-pane fade in active">
      <h3>Ministries</h3>
      <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>comment</th>
						<td>Action</td>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `expense` WHERE texpense='Ministries' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `expense` WHERE texpense='Ministries' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>
	   		<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#form_modal<?php echo $fetch['id'];?>"><span class="glyphicon glyphicon-edit"></span> Edit</button> 
	   		 |<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_<?php echo $fetch['id']; ?>">Delete</button></td>				
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
				<h3 class="text-center">Date&nbsp;&nbsp;<?php echo $fetch['date'].'<br/><br/>Amount '.$fetch['amount'].'<br/><br/>Comment '.$fetch['comment']; ?></h3>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="expenditure.php?id=<?php echo $fetch['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>




<div class="modal fade" id="form_modal<?php echo $fetch['id'];?>" style="color: black;" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<form method="POST" action="editexpense.php" >
											<div class="modal-header">
												<h3 class="modal-title">Edit and Update</h3>
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
					<select class="form-control" name="texpense" >
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
												<button class="btn btn-warning" name="update"><span class="glyphicon glyphicon-save"></span> Update</button>
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



    <div id="Administration" class="tab-pane fade">
      <h3>Administration</h3>
       
            <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>comment</th>
						<td>Action</td>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `expense` WHERE texpense='Administration' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `expense` WHERE texpense='Administration' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>
	   		<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#form_modal<?php echo $fetch['id'];?>"><span class="glyphicon glyphicon-edit"></span> Edit</button> 
	   		 |<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_<?php echo $fetch['id']; ?>">Delete</button></td>				
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
				<h3 class="text-center">Date&nbsp;&nbsp;<?php echo $fetch['date'].'<br/><br/>Amount '.$fetch['amount'].'<br/><br/>Comment '.$fetch['comment']; ?></h3>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="expenditure.php?id=<?php echo $fetch['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>




<div class="modal fade" id="form_modal<?php echo $fetch['id'];?>" style="color: black;" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<form method="POST" action="editexpense.php" >
											<div class="modal-header">
												<h3 class="modal-title">Edit and Update</h3>
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
					<label>Type of Expenditure</label>
					<select class="form-control" name="texpense" >
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
												<button class="btn btn-warning" name="update"><span class="glyphicon glyphicon-save"></span> Update</button>
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
    <div id="Repair_and_Maintainace" class="tab-pane fade">
      <h3>Repair and Maintainace</h3>
      

      <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>comment</th>
						<td>Action</td>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `expense` WHERE texpense='Repair_and_Maintainace' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `expense` WHERE texpense='Repair_and_Maintainace'") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>
	   		<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#form_modal<?php echo $fetch['id'];?>"><span class="glyphicon glyphicon-edit"></span> Edit</button> 
	   		 |<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_<?php echo $fetch['id']; ?>">Delete</button></td>				
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
				<h3 class="text-center">Date&nbsp;&nbsp;<?php echo $fetch['date'].'<br/><br/>Amount '.$fetch['amount'].'<br/><br/>Comment '.$fetch['comment']; ?></h3>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="expenditure.php?id=<?php echo $fetch['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>




<div class="modal fade" id="form_modal<?php echo $fetch['id'];?>" style="color: black;" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<form method="POST" action="editexpense.php" >
											<div class="modal-header">
												<h3 class="modal-title">Edit and Update</h3>
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
					<select class="form-control" name="texpense" >
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
												<button class="btn btn-warning" name="update"><span class="glyphicon glyphicon-save"></span> Update</button>
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
    <div id="Operational_Expense" class="tab-pane fade">
      <h3>Operational Expense</h3>
     
       
             <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>comment</th>
						<td>Action</td>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `expense` WHERE texpense='Operational_Expense' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `expense` WHERE texpense='Operational_Expense' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>
	   		<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#form_modal<?php echo $fetch['id'];?>"><span class="glyphicon glyphicon-edit"></span> Edit</button> 
	   		 |<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_<?php echo $fetch['id']; ?>">Delete</button></td>				
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
				<h3 class="text-center">Date&nbsp;&nbsp;<?php echo $fetch['date'].'<br/><br/>Amount '.$fetch['amount'].'<br/><br/>Comment '.$fetch['comment']; ?></h3>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="expenditure.php?id=<?php echo $fetch['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>




<div class="modal fade" id="form_modal<?php echo $fetch['id'];?>" style="color: black;" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<form method="POST" action="editexpense.php" >
											<div class="modal-header">
												<h3 class="modal-title">Edit and Update</h3>
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
					<select class="form-control" name="texpense" >
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
												<button class="btn btn-warning" name="update"><span class="glyphicon glyphicon-save"></span> Update</button>
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
     
     <div id="Pastrol" class="tab-pane fade">
      <h3>Pastrol</h3>
     
       
                   <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>comment</th>
						<td>Action</td>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `expense` WHERE texpense='Pastrol' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `expense` WHERE texpense='Pastrol' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>
	   		<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#form_modal<?php echo $fetch['id'];?>"><span class="glyphicon glyphicon-edit"></span> Edit</button> 
	   		 |<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_<?php echo $fetch['id']; ?>">Delete</button></td>				
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
				<h3 class="text-center">Date&nbsp;&nbsp;<?php echo $fetch['date'].'<br/><br/>Amount '.$fetch['amount'].'<br/><br/>Comment '.$fetch['comment']; ?></h3>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="expenditure.php?id=<?php echo $fetch['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>




<div class="modal fade" id="form_modal<?php echo $fetch['id'];?>" style="color: black;" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<form method="POST" action="editexpense.php" >
											<div class="modal-header">
												<h3 class="modal-title">Edit and Update</h3>
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
					<select class="form-control" name="texpense" >
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
												<button class="btn btn-warning" name="update"><span class="glyphicon glyphicon-save"></span> Update</button>
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
     






     <div id="Personel_salaries" class="tab-pane fade">
      <h3>Personel salaries</h3>
    

             <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>comment</th>
						<td>Action</td>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `expense` WHERE texpense='Salary' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `expense` WHERE texpense='Salary' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>
	   		<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#form_modal<?php echo $fetch['id'];?>"><span class="glyphicon glyphicon-edit"></span> Edit</button> 
	   		 |<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_<?php echo $fetch['id']; ?>">Delete</button></td>				
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
				<h3 class="text-center">Date&nbsp;&nbsp;<?php echo $fetch['date'].'<br/><br/>Amount '.$fetch['amount'].'<br/><br/>Comment '.$fetch['comment']; ?></h3>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="expenditure.php?id=<?php echo $fetch['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>




<div class="modal fade" id="form_modal<?php echo $fetch['id'];?>" style="color: black;" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<form method="POST" action="editexpense" >
											<div class="modal-header">
												<h3 class="modal-title">Edit and Update</h3>
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
					<select class="form-control" name="texpense" >
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
												<button class="btn btn-warning" name="update"><span class="glyphicon glyphicon-save"></span> Update</button>
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

        

     <div id="Purchase" class="tab-pane fade">
      <h3>Purchase</h3>
     
       
                    <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>comment</th>
						<td>Action</td>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `expense` WHERE texpense='Purchase' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `expense` WHERE texpense='Purchase' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>
	   		<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#form_modal<?php echo $fetch['id'];?>"><span class="glyphicon glyphicon-edit"></span> Edit</button> 
	   		 |<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_<?php echo $fetch['id']; ?>">Delete</button></td>				
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
				<h3 class="text-center">Date&nbsp;&nbsp;<?php echo $fetch['date'].'<br/><br/>Amount '.$fetch['amount'].'<br/><br/>Comment '.$fetch['comment']; ?></h3>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="expenditure.php?id=<?php echo $fetch['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>




<div class="modal fade" id="form_modal<?php echo $fetch['id'];?>" style="color: black;" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<form method="POST" action="editexpense.php" >
											<div class="modal-header">
												<h3 class="modal-title">Edit and Update</h3>
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
					<select class="form-control" name="texpense" >
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
												<button class="btn btn-warning" name="update"><span class="glyphicon glyphicon-save"></span> Update</button>
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
      
      <div id="Church_Activities" class="tab-pane fade">
      <h3>Church Activities</h3>
      
      
                   <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>comment</th>
						<td>Action</td>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `expense` WHERE texpense='Church_Activities' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `expense` WHERE texpense='Church_Activities' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>
	   		<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#form_modal<?php echo $fetch['id'];?>"><span class="glyphicon glyphicon-edit"></span> Edit</button> 
	   		 |<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_<?php echo $fetch['id']; ?>">Delete</button></td>				
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
				<h3 class="text-center">Date&nbsp;&nbsp;<?php echo $fetch['date'].'<br/><br/>Amount '.$fetch['amount'].'<br/><br/>Comment '.$fetch['comment']; ?></h3>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="expenditure.php?id=<?php echo $fetch['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>




<div class="modal fade" id="form_modal<?php echo $fetch['id'];?>" style="color: black;" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<form method="POST" action="editexpense.php" >
											<div class="modal-header">
												<h3 class="modal-title">Edit and Update</h3>
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
					<select class="form-control" name="texpense" >
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
												<button class="btn btn-warning" name="update"><span class="glyphicon glyphicon-save"></span> Update</button>
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

    
    


          <div id="otherex" class="tab-pane fade">
      <h3>Church Activities</h3>
      
      
                   <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>comment</th>
						<td>Action</td>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `expense` WHERE texpense='other' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `expense` WHERE texpense='other' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>
	   		<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#form_modal<?php echo $fetch['id'];?>"><span class="glyphicon glyphicon-edit"></span> Edit</button> 
	   		 |<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_<?php echo $fetch['id']; ?>">Delete</button></td>				
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
				<h3 class="text-center">Date&nbsp;&nbsp;<?php echo $fetch['date'].'<br/><br/>Amount '.$fetch['amount'].'<br/><br/>Comment '.$fetch['comment']; ?></h3>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="expenditure.php?id=<?php echo $fetch['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>




<div class="modal fade" id="form_modal<?php echo $fetch['id'];?>" style="color: black;" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<form method="POST" action="editexpense.php" >
											<div class="modal-header">
												<h3 class="modal-title">Edit and Update</h3>
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
					<select class="form-control" name="texpense" >
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
												<button class="btn btn-warning" name="update"><span class="glyphicon glyphicon-save"></span> Update</button>
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