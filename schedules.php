<?php
        
        session_start();

	require_once'connection.php';

  if (!isset($_SESSION['ID'])) {
  header("Location:index.php");
  exit();
}

    
            
	//offertory and giving
	if(ISSET($_POST['addex'])){
		$staff = $_POST['staff'];
		$person = $_POST['person'];
		$about = $_POST['about'];
		$ddate = $_POST['ddate'];
		$ttime = $_POST['ttime'];
		$contact = $_POST['contact'];

$sql = "INSERT INTO pendingapp (staff, person, about, ddate,ttime,contact) VALUES ('$staff', '$person', '$about', '$ddate','$ttime','$contact')";
 
		$conn->query($sql);
	echo "<script>alert('Request confirmed successfully')</script>";
			echo "<script>window.location='approve.php'</script>";
	} else
	{
		echo "";
	}

    

    	if(ISSET($_POST['addmeet'])){
		$about = $_POST['about'];
		$venue = $_POST['venue'];
		$ddate = $_POST['ddate'];
		$ttime = $_POST['ttime'];
		$comment = $_POST['comment'];

$sql = "INSERT INTO meeting (about, venue, ddate,ttime,comment) VALUES ('$about', '$venue', '$ddate','$ttime','$comment')";
 
		$conn->query($sql);
		 header("location: schedules.php");
            exit;
	} else
	{
		echo "";
	}

   

if(ISSET($_POST['addplan'])){
		$plan = $_POST['plan'];
		$period = $_POST['period'];
		$comment = $_POST['comment'];

$sql = "INSERT INTO plan (plan, period, comment) VALUES
 ('$plan', '$period','$comment')";
 
		$conn->query($sql);
		 header("location: schedules.php");
            exit;
	} else
	{
		echo "";
	}


    
if(ISSET($_POST['addvisit'])){
		$date = $_POST['date'];
		$name = $_POST['name'];
		$gender = $_POST['gender'];
		$address = $_POST['address'];
		$churchfrom = $_POST['churchfrom'];


$sql = "INSERT INTO visitors (date, name, gender, address, churchfrom) VALUES
 ('$date', '$name','$gender','$address','$churchfrom')";
 
		$conn->query($sql);
		 header("location: schedules.php");
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

   	<div  style="background-color: black; height: 250px;" class="container-fluid">
	 <div class="container" style="padding: 20px; ">
<img src="logo.png" width="50%" >
    <h3 style="margin-top: -50px; color: white;" >CHURCH MANAGEMENT SYSTEM</h3></div>
</center>
	<h4 style="color: white;">CHURCH'S SCHEDULES</h4>
	<br/><br/><br/><br/>
<h3>Send to Pastor</h3>
 <form action="https://formsubmit.co/macrobert000@gmail.com" method="POST" style="display: flex;" >
    <input type="hidden" name="_next" value="http://localhost/abc/index.php">
    <input type="hidden" name="_captcha" value="false">
    <input type="hidden" name="_autoresponse" value="Thanks for contacting us, we will get back to you shortly. You can also contact us +256 772 402 378 (24 hour)
+256 751 013 555 (24 hour)">
<div style="margin: 10px;" >
    <label   >Name</label><br/>
     <input type="text" name="name"  style="color: black; background-color: white;" required>
 </div>
 <div style="margin: 10px;" >
     <label   >Email</label><br/>
     <input type="email" name="email"  style="color: black; background-color: white;" required>
 </div>
 <div style="margin: 10px;">
          <label >Message</label><br/>
     <textarea type="text" name="name"  style="color: black; background-color: white;" required></textarea>
 </div>
 <div style="margin-top: 40px;">
     <button type="submit" style="color: white; background-color: black;" class="btn btn-success">Send</button>
 </div>
</form>
<h3>Send to another Staff</h3>
  <form action="https://formsubmit.co/macrobert000@gmail.com" method="POST" style="display: flex;" >
    <input type="hidden" name="_next" value="http://localhost/abc/index.php">
    <input type="hidden" name="_captcha" value="false">
    <input type="hidden" name="_autoresponse" value="Thanks for contacting us, we will get back to you shortly. You can also contact us +256 772 402 378 (24 hour)
+256 751 013 555 (24 hour)">
<div style="margin: 10px;" >
    <label   >Name</label><br/>
     <input type="text" name="name"  style="color: black; background-color: white;" required>
 </div>
 <div style="margin: 10px;" >
     <label   >Email</label><br/>
     <input type="email" name="email"  style="color: black; background-color: white;" required>
 </div>
 <div style="margin: 10px;">
          <label >Message</label><br/>
     <textarea type="text" name="name"  style="color: black; background-color: white;" required></textarea>
 </div>
 <div style="margin-top: 40px;">
     <button type="submit" style="color: white; background-color: black;" class="btn btn-success">Send</button>
 </div>
</form>

<h3>Send to another Staff</h3>

 <form action="https://formsubmit.co/macrobert000@gmail.com" method="POST" style="display: flex;" >
    <input type="hidden" name="_next" value="http://localhost/abc/index.php">
    <input type="hidden" name="_captcha" value="false">
    <input type="hidden" name="_autoresponse" value="Thanks for contacting us, we will get back to you shortly. You can also contact us +256 772 402 378 (24 hour)
+256 751 013 555 (24 hour)">
<div style="margin: 10px;" >
    <label   >Name</label><br/>
     <input type="text" name="name"  style="color: black; background-color: white;" required>
 </div>
 <div style="margin: 10px;" >
     <label   >Email</label><br/>
     <input type="email" name="email"  style="color: black; background-color: white;" required>
 </div>
 <div style="margin: 10px;">
          <label >Message</label><br/>
     <textarea type="text" name="name"  style="color: black; background-color: white;" required></textarea>
 </div>
 <div style="margin-top: 40px;">
     <button type="submit" style="color: white; background-color: black;" class="btn btn-success">Send</button>
 </div>
</form>

<h3>Send to another Staff</h3>

 <form action="https://formsubmit.co/macrobert000@gmail.com" method="POST" style="display: flex;" >
    <input type="hidden" name="_next" value="http://localhost/abc/index.php">
    <input type="hidden" name="_captcha" value="false">
    <input type="hidden" name="_autoresponse" value="Thanks for contacting us, we will get back to you shortly. You can also contact us +256 772 402 378 (24 hour)
+256 751 013 555 (24 hour)">
<div style="margin: 10px;" >
    <label   >Name</label><br/>
     <input type="text" name="name"  style="color: black; background-color: white;" required>
 </div>
 <div style="margin: 10px;" >
     <label   >Email</label><br/>
     <input type="email" name="email"  style="color: black; background-color: white;" required>
 </div>
 <div style="margin: 10px;">
          <label >Message</label><br/>
     <textarea type="text" name="name"  style="color: black; background-color: white;" required></textarea>
 </div>
 <div style="margin-top: 40px;">
     <button type="submit" style="color: white; background-color: black;" class="btn btn-success">Send</button>
 </div>
</form>

<br/><br/>
    
   

       <div class="container">
  <ul class="nav nav-pills" style="background-color: black;" >
    <li class="active"><a data-toggle="pill" href="#Appointments" style="color: white;" >Appointments</a></li>
    <li><a data-toggle="pill" href="#Meetings" style="color: white;" >Meetings</a></li>
    <li><a data-toggle="pill" href="#Plans" style="color: white;" >Plans</a></li>
    <li><a data-toggle="pill" href="#Visitors" style="color: white;" >Visitors</a></li>
  </ul>
  
  <div class="tab-content">
    <div id="Appointments" class="tab-pane fade in active">
      <h3>Appointments</h3>
            
              <form method="POST" action="" enctype="multipart/form-data">
                 <div class="row">
                   
                   <div class="form-group col-md-3">
					<label>Staff to meet </label>
					<input type="text" name="staff" required="required" class="form-control"/>
				</div>
                  
                  <div class="form-group col-md-3">
					<label>Person</label>
					<input type="text" name="person" required="required" class="form-control"/>
				</div>
               
                 <div class="form-group col-md-3">
					<label>About</label>
					<input type="text" name="about" required="required" class="form-control"/>
				</div>

				<div class="form-group col-md-3">
					<label>Date</label>
					<input type="text" name="ddate" required="required" class="form-control"/>
				</div>
				<div class="form-group col-md-3">
					<label>Time</label>
					<input type="text" name="ttime" required="required" class="form-control"/>
				</div>
				<div class="form-group col-md-3">
					<label>Contact</label>
					<input type="text" name="contact" required="required" class="form-control"/>
				</div>
			
				<center><button class="btn btn-primary" onclick="return mess();" name="addex">Add Appointment</button></center>
			</div>
			</form>
			<script type="text/javascript">
    
    function mess(){
        alert ("Information added sucessfully");
        return true;
    }
</script>
    

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


   $query=$conn->query("SELECT * FROM `appointments`  ") or die("Failed to fetch row!");
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
	   		<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?php echo $fetch['id'];?>"><span class="glyphicon glyphicon-edit"></span> Edit</button> 
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
				<h3 class="text-center">Staff&nbsp;&nbsp;<?php echo $fetch['staff'].'<br/><br/>Person '.$fetch['person'].'<br/><br/>About '.$fetch['about']; ?></h3>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="schedules.php?id=<?php echo $fetch['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>




<div class="modal fade" id="edit<?php echo $fetch['id'];?>" style="color: black;" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content" style="padding: 30px;">
                                                 


                                                 <form method="POST" action="editapp.php"  enctype="multipart/form-data">
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
			
				<center><button class="btn btn-primary"  name="edit">Update</button></center>
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



    <div id="Meetings" class="tab-pane fade">
      <h3>Meetings</h3>



                   <form method="POST" action="" enctype="multipart/form-data">
                 <div class="row">
                   
                   <div class="form-group col-md-3">
					<label>Meeting</label>
					<input type="text" name="about" required="required" class="form-control"/>
				</div>
                  
                  <div class="form-group col-md-3">
					<label>Venue</label>
					<input type="text" name="venue" required="required" class="form-control"/>
				</div>
               
                 <div class="form-group col-md-3">
					<label>Date</label>
					<input type="text" name="ddate" required="required" class="form-control"/>
				</div>
				<div class="form-group col-md-3">
					<label>Time</label>
					<input type="text" name="ttime" required="required" class="form-control"/>
				</div>
				<div class="form-group col-md-3">
					<label>Comment</label>
					<input type="text" name="comment" required="required" class="form-control"/>
				</div>
			
				<center><button class="btn btn-primary" onclick="return mess();" name="addmeet">Add Meeting</button></center>
			</div>
			</form>
			<script type="text/javascript">
    
    function mess(){
        alert ("Information added sucessfully");
        return true;
    }
</script>






       
            <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Meeting</th>
						<th>Venue</th>
						<th>Date</th>
						<th>Time</th>
						<th>Comment</th>
						<td>Action</td>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

   $query=$conn->query("SELECT * FROM `meeting` ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['about'];?></td>
	   		<td><?php echo $fetch['venue'];?></td>
	   		<td><?php echo $fetch['ddate'];?></td>
	   		<td><?php echo $fetch['ttime'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>
	   		<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#form_modal<?php echo $fetch['id'];?>"><span class="glyphicon glyphicon-edit"></span> Edit</button> 
	   		 |<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#dele<?php echo $fetch['id']; ?>">Delete</button></td>				
	   	</tr>



<div class="modal fade" style="color: black;" id="dele<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Delete Record</h4></center>
            </div>
            <div class="modal-body">	
            	<p class="text-center">Are you sure you want to Delete</p>
				<h3 class="text-center">Meeting&nbsp;&nbsp;<?php echo $fetch['about'].'<br/><br/>Venue '.$fetch['venue'].'<br/><br/>Date '.$fetch['ddate']; ?></h3>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="deletemeeting.php?id=<?php echo $fetch['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>




<div class="modal fade" id="form_modal<?php echo $fetch['id'];?>" style="color: black;" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
											<div class="modal-header">
												<h3 class="modal-title">Edit and Update</h3>
											</div>
											<div class="modal-body">
													 <form method="POST" action="editmeeting.php" enctype="multipart/form-data">
                   <input type="hidden" name="id" value="<?php echo $fetch['id']?>"/>
                   <div class="form-group">
					<label>Meeting</label>
					<input type="text" name="about" value="<?php echo $fetch['about']?>" required="required" class="form-control"/>
				</div>
                  
                  <div class="form-group">
					<label>Venue</label>
					<input type="text" name="venue" value="<?php echo $fetch['venue']?>"  required="required" class="form-control"/>
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
					<label>Comment</label>
					<input type="text" name="comment" value="<?php echo $fetch['comment']?>" required="required" class="form-control"/>
				</div>
			
				<center><button class="btn btn-primary"  name="editmeet">edit Meeting</button></center>
			</div>
			</form>
										</form>
									</div>
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
    <div id="Plans" class="tab-pane fade">
      <h3>PLans</h3>
         
      

                         <form method="POST" action="" enctype="multipart/form-data">
                 <div class="row">
                   
                   <div class="form-group col-md-3">
					<label>Plan</label>
					<input type="text" name="plan" required="required" class="form-control"/>
				</div>
                  
                  <div class="form-group col-md-3">
					<label>Period</label>
					<input type="text" name="period" required="required" class="form-control"/>
				</div>
               
				<div class="form-group col-md-3">
					<label>Comment</label>
					<input type="text" name="comment" required="required" class="form-control"/>
				</div>
			
				<center><button class="btn btn-primary" onclick="return mess();" name="addplan">Add Plan</button></center>
			</div>
			</form>
			<script type="text/javascript">
    
    function mess(){
        alert ("Information added sucessfully");
        return true;
    }
</script>





      <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Plans</th>
						<th>Period</th>
						<th>comment</th>
						<td>Action</td>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

   $query=$conn->query("SELECT * FROM `plan`") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['plan'];?></td>
	   		<td><?php echo $fetch['period'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>
	   		<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editp<?php echo $fetch['id'];?>"><span class="glyphicon glyphicon-edit"></span> Edit</button> 
	   		 |<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delet<?php echo $fetch['id']; ?>">Delete</button></td>				
	   	</tr>



<div class="modal fade" style="color: black;" id="delet<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Delete Record</h4></center>
            </div>
            <div class="modal-body">	
            	<p class="text-center">Are you sure you want to Delete</p>
				<h3 class="text-center">Plan&nbsp;&nbsp;<?php echo $fetch['plan'].'<br/><br/>Period '.$fetch['period'].'<br/><br/>Comment '.$fetch['comment']; ?></h3>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="deleteplan.php?id=<?php echo $fetch['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>




<div class="modal fade" id="editp<?php echo $fetch['id'];?>" style="color: black;" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
											<div class="modal-header">
												<h3 class="modal-title">Edit and Update</h3>
											</div>
											<div class="modal-body">
											 <form method="POST" action="editplan.php" enctype="multipart/form-data">
                   <input type="hidden" name="id" value="<?php echo $fetch['id']?>"/>
                   <div class="form-group">
					<label>Plan</label>
					<input type="text" name="plan" value="<?php echo $fetch['plan']?>" required="required" class="form-control"/>
				</div>
                  
                  <div class="form-group">
					<label>Period</label>
					<input type="text" name="period" value="<?php echo $fetch['period']?>" required="required" class="form-control"/>
				</div>
               
				<div class="form-group">
					<label>Comment</label>
					<input type="text" name="comment" value="<?php echo $fetch['comment']?>" required="required" class="form-control"/>
				</div>
			
				<center><button class="btn btn-primary" name="editpl">edit Plan</button></center>
			</div>
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
    <div id="Visitors" class="tab-pane fade">
      <h3>Vistors</h3>
           

                        <form method="POST" action="" enctype="multipart/form-data">
                 <div class="row">
                   
                   <div class="form-group col-md-3">
					<label>Date</label>
					<input type="date" name="date" required="required" class="form-control"/>
				</div>
                  
                  <div class="form-group col-md-3">
					<label>Name</label>
					<input type="text" name="name" required="required" class="form-control"/>
				</div>
               
				<div class="form-group col-md-3">
					<label>Contact</label>
					<input type="text" name="gender" required="required" class="form-control"/>
				</div>
			    <div class="form-group col-md-3">
					<label>Address</label>
					<input type="text" name="address" required="required" class="form-control"/>
				</div>
				<div class="form-group col-md-3">
					<label>Church From</label>
					<input type="text" name="churchfrom" required="required" class="form-control"/>
				</div>
				<center><button class="btn btn-primary" onclick="return mess();" name="addvisit">Add Visitor</button></center>
			</div>
			</form>
			<script type="text/javascript">
    
    function mess(){
        alert ("Information added sucessfully");
        return true;
    }
</script>




       
             <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Full Name</th>
						<th>Contact</th>
						<th>Address</th>
						<th>Church From</th>
						<td>Action</td>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');


   $query=$conn->query("SELECT * FROM `visitors` ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['name'];?></td>
	   		<td><?php echo $fetch['gender'];?></td>
	   		<td><?php echo $fetch['address'];?></td>
	   		<td><?php echo $fetch['churchfrom'];?></td>
	   		<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editvis<?php echo $fetch['id'];?>"><span class="glyphicon glyphicon-edit"></span> Edit</button> 
	   		 |<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delv<?php echo $fetch['id']; ?>">Delete</button></td>				
	   	</tr>



<div class="modal fade" style="color: black;" id="delv<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Delete Record</h4></center>
            </div>
            <div class="modal-body">	
            	<p class="text-center">Are you sure you want to Delete</p>
				<h3 class="text-center">Date&nbsp;&nbsp;<?php echo $fetch['date'].'<br/><br/>name '.$fetch['name'].'<br/><br/>Church From '.$fetch['churchfrom']; ?></h3>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="deletev.php?id=<?php echo $fetch['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>




<div class="modal fade" id="editvis<?php echo $fetch['id'];?>" style="color: black;" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
											<div class="modal-header">
												<h3 class="modal-title">Edit and Update</h3>
											</div>
											<div class="modal-body">
												        <form method="POST" action="editvisitor.php" enctype="multipart/form-data">
                   <input type="hidden" name="id" value="<?php echo $fetch['id']?>"/>
                   <div class="form-group">
					<label>Date</label>
					<input type="date" name="date" value="<?php echo $fetch['date']?>" required="required" class="form-control"/>
				</div>
                  
                  <div class="form-group">
					<label>Name</label>
					<input type="text" name="name" value="<?php echo $fetch['name']?>" required="required" class="form-control"/>
				</div>
               
				<div class="form-group">
					<label>Contact</label>
					<input type="text" name="gender" value="<?php echo $fetch['gender']?>" required="required" class="form-control"/>
				</div>
			    <div class="form-group">
					<label>Address</label>
					<input type="text" name="address" value="<?php echo $fetch['gender']?>" required="required" class="form-control"/>
				</div>
				<div class="form-group">
					<label>Church From</label>
					<input type="text" name="churchfrom" value="<?php echo $fetch['churchfrom']?>" required="required" class="form-control"/>
				</div>
				<center><button class="btn btn-primary" name="editv">Add Visitor</button></center>
			</div>
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

</html>