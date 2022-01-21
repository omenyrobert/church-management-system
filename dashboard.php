<?php

session_start();
// Include database connection file
include_once('connection.php');

if (!isset($_SESSION['ID'])) {
	header("Location:index.php");
	exit();
}


 $sql=$conn->query("SELECT COUNT(*) AS cou FROM `church`") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['cou'];
                         }



 $sql=$conn->query("SELECT COUNT(*) AS cou FROM `appointments`") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$outapp = ""." ".$fetch['cou'];
                         }

                          $sql=$conn->query("SELECT COUNT(*) AS cou FROM `visitors`") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$outvi = ""." ".$fetch['cou'];
                         }



                          $sql=$conn->query("SELECT COUNT(*) AS cou FROM `furniture` where con='good' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$outf = ""." ".$fetch['cou'];
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
<body  style=" background-color: white; color: white; ">
<div class="container-fluid">
<?php include_once'topnav.php';?>

<div class="row">      
<div class="col-md-2" >
<?php include_once'sidenav.php';?>	
</div>   

       <div class="col-md-10">
<div class="row" >
	<div class="col-md-3" style="background-color: #f2126c; height: 120px; width: 200px; text-align: center; margin: 5px; " >
    <br/>   
	<h4>Church Members</h4>
       <h3><?php echo $output; ?></h3>
		
	</div>
	<div class="col-md-3" style="background-color: #0a9914; height: 120px; text-align: center; width: 200px; margin: 5px;" >
		<br/>
		<h4>Appointments</h4>
       <h3><?php echo $outapp; ?></h3>
	</div>
	<div class="col-md-3" style="background-color: #066692; height: 120px; text-align: center; width: 200px; margin: 5px; " >
		<br/>
		<h4>Vistors</h4>
       <h3><?php echo $outvi; ?></h3>
	</div>
	<div class="col-md-3" style="background-color: gold; height: 120px; text-align: center; width: 200px; margin: 5px; " >
		<br/>
		<h4>Furniture</h4>
       <h3><?php echo $outf; ?></h3>
	</div>
</div>

<br/>
<br/>
  <ul class="nav nav-pills" >
    <li class="active"><a data-toggle="pill" href="#tithe" style="border: 1px solid #075286; border-radius: 50px; padding-left: 30px; padding-right: 30px;"  >Appointments</a></li>
    <li><a data-toggle="pill" href="#offertory" style="border: 1px solid #075286; border-radius: 50px; padding-left: 30px; padding-right: 30px;" >Meetings</a></li>
    <li><a data-toggle="pill" href="#project" style="border: 1px solid #075286; border-radius: 50px; padding-left: 30px; padding-right: 30px;"  >Plans</a></li>
     <li><a data-toggle="pill" href="#Visitors" style="border: 1px solid #075286; border-radius: 50px; padding-left: 30px; padding-right: 30px;"  >Visitors</a></li>
    <li><a data-toggle="pill" href="#Music" style="border: 1px solid #075286; border-radius: 50px; padding-left: 30px; padding-right: 30px;"  >Music Equip</a></li>
    <li><a data-toggle="pill" href="#hiring" style="border: 1px solid #075286; border-radius: 50px; padding-left: 30px; padding-right: 30px;"  >Furniture</a></li>
    <li><a data-toggle="pill" href="#ministry" style="border: 1px solid #075286; border-radius: 50px; padding-left: 30px; padding-right: 30px;"  >Office</a></li>
     <li><a data-toggle="pill" href="#kind" style="border: 1px solid #075286; border-radius: 50px; padding-left: 30px; padding-right: 30px;"  >Kitchen</a></li>
    <li><a data-toggle="pill" href="#GD" style="border: 1px solid #075286; border-radius: 50px; padding-left: 30px; padding-right: 30px;"  >Balance</a></li>
  </ul>
  
  <div class="tab-content">
    <div id="tithe" class="tab-pane fade in active">
      <h3>Appointments</h3>
         <table id="myTable" class="table table-bordered " style="color: black; #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Staff</th>
						<th>Person</th>
						<th>About</th>
						<th>Date</th>
						<th>Time</th>
						<th>Contact</th>
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
	   	</tr>

     <?php
   }



?>
</tbody>
</table>
    </div>



    <div id="offertory" class="tab-pane fade">
      <h3>Meeting</h3>
       
                   <table id="myTable" class="table table-bordered " style="color: black; #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Meeting</th>
						<th>Venue</th>
						<th>Date</th>
						<th>Time</th>
						<th>Comment</th>
					</tr>
				</thead>
<tbody>
       <?php
include_once('connection.php');


   $query=$conn->query("SELECT * FROM `meeting`  ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['about'];?></td>
	   		<td><?php echo $fetch['venue'];?></td>
	   		<td><?php echo $fetch['ddate'];?></td>
	   		<td><?php echo $fetch['ttime'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>				
	   	</tr>

     <?php
   }



?>
</tbody>
</table>


    </div>
    <div id="project" class="tab-pane fade">
      <h3>Plans</h3>
      

                      <table id="myTable" class="table table-bordered " style="color: black; #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Plans</th>
						<th>Period</th>
						<th>comment</th>
					</tr>
				</thead>
<tbody>
       <?php
include_once('connection.php');


   $query=$conn->query("SELECT * FROM `plan`  ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['plan'];?></td>
	   		<td><?php echo $fetch['period'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>				
	   	</tr>

     <?php
   }



?>
</tbody>
</table>


    </div>

         <div id="Visitors" class="tab-pane fade">
      <h3>Visitors</h3>
      

                      <table id="myTable" class="table table-bordered " style="color: black; #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Full Name</th>
						<th>Contact</th>
						<th>Address</th>
						<th>Church From</th>
					</tr>
				</thead>
<tbody>
       <?php
include_once('connection.php');


   $query=$conn->query("SELECT * FROM `visitors`  ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['name'];?></td>
	   		<td><?php echo $fetch['gender'];?></td>
	   		<td><?php echo $fetch['address'];?></td>
	   		<td><?php echo $fetch['churchfrom'];?></td>				
	   	</tr>

     <?php
   }



?>
</tbody>
</table>


    </div>

     
     <div id="Music" class="tab-pane fade">
      <h3>Music Equipment</h3>
     <p>Needed</p>
       
                   <table id="myTable" class="table table-bordered " style="color: black; #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>item</th>
						<th>detials</th>
						<th>qty</th>
                        <th>Conditions</th>
						<th>image</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');
 $upload_dir = 'uploads/';


   $query=$conn->query("SELECT * FROM `music` WHERE con='Needed' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['item'];?></td>
	   		<td><?php echo $fetch['det'];?></td>
	   		<td><?php echo $fetch['qty'];?></td>
            <td><?php echo $fetch['con'];?></td>
	   		<td><img src="uploads/<?php echo $fetch['image'];?>" width="100"  /> </td>				
	   	</tr>
     <?php
   }



?>
</tbody>
</table>


<p>Bad Condition</p>


                   <table id="myTable" class="table table-bordered " style="color: black; #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>item</th>
						<th>detials</th>
						<th>qty</th>
                        <th>Conditions</th>
						<th>image</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');
 $upload_dir = 'uploads/';


   $query=$conn->query("SELECT * FROM `music` WHERE con='Bad' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['item'];?></td>
	   		<td><?php echo $fetch['det'];?></td>
	   		<td><?php echo $fetch['qty'];?></td>
            <td><?php echo $fetch['con'];?></td>
	   		<td><img src="uploads/<?php echo $fetch['image'];?>" width="100"  /> </td>				
	   	</tr>
     <?php
   }



?>
</tbody>
</table>








<p>Good Condition</p>


                   <table id="myTable" class="table table-bordered " style="color: black; #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>item</th>
						<th>detials</th>
						<th>qty</th>
                        <th>Conditions</th>
						<th>image</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');
 $upload_dir = 'uploads/';


   $query=$conn->query("SELECT * FROM `music` WHERE con='Good' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['item'];?></td>
	   		<td><?php echo $fetch['det'];?></td>
	   		<td><?php echo $fetch['qty'];?></td>
            <td><?php echo $fetch['con'];?></td>
	   		<td><img src="uploads/<?php echo $fetch['image'];?>" width="100"  /> </td>				
	   	</tr>
     <?php
   }



?>
</tbody>
</table>





    </div>
     






     <div id="hiring" class="tab-pane fade">
      <h3>Furniture</h3>
     <p>Needed</p>
       
                   <table id="myTable" class="table table-bordered " style="color: black; #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>item</th>
						<th>detials</th>
						<th>qty</th>
                        <th>Conditions</th>
						<th>image</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');
 $upload_dir = 'uploads/';


   $query=$conn->query("SELECT * FROM `furniture` WHERE con='Needed' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['item'];?></td>
	   		<td><?php echo $fetch['det'];?></td>
	   		<td><?php echo $fetch['qty'];?></td>
            <td><?php echo $fetch['con'];?></td>
	   		<td><img src="uploads/<?php echo $fetch['image'];?>" width="100"  /> </td>				
	   	</tr>
     <?php
   }



?>
</tbody>
</table>


<p>Bad Condition</p>


                   <table id="myTable" class="table table-bordered " style="color: black; #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>item</th>
						<th>detials</th>
						<th>qty</th>
                        <th>Conditions</th>
						<th>image</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');
 $upload_dir = 'uploads/';


   $query=$conn->query("SELECT * FROM `furniture` WHERE con='Bad' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['item'];?></td>
	   		<td><?php echo $fetch['det'];?></td>
	   		<td><?php echo $fetch['qty'];?></td>
            <td><?php echo $fetch['con'];?></td>
	   		<td><img src="uploads/<?php echo $fetch['image'];?>" width="100"  /> </td>				
	   	</tr>
     <?php
   }



?>
</tbody>
</table>








<p>Good Condition</p>


                   <table id="myTable" class="table table-bordered " style="color: black; #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>item</th>
						<th>detials</th>
						<th>qty</th>
                        <th>Conditions</th>
						<th>image</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');
 $upload_dir = 'uploads/';


   $query=$conn->query("SELECT * FROM `furniture` WHERE con='Good' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['item'];?></td>
	   		<td><?php echo $fetch['det'];?></td>
	   		<td><?php echo $fetch['qty'];?></td>
            <td><?php echo $fetch['con'];?></td>
	   		<td><img src="uploads/<?php echo $fetch['image'];?>" width="100"  /> </td>				
	   	</tr>
     <?php
   }



?>
</tbody>
</table>


        


    </div>

        

     <div id="ministry" class="tab-pane fade">
      <h3>Office Assets</h3>
     
       
                     <p>Needed</p>
       
                   <table id="myTable" class="table table-bordered " style="color: black; #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>item</th>
						<th>detials</th>
						<th>qty</th>
                        <th>Conditions</th>
						<th>image</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');
 $upload_dir = 'uploads/';


   $query=$conn->query("SELECT * FROM `Office` WHERE con='Needed' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['item'];?></td>
	   		<td><?php echo $fetch['det'];?></td>
	   		<td><?php echo $fetch['qty'];?></td>
            <td><?php echo $fetch['con'];?></td>
	   		<td><img src="uploads/<?php echo $fetch['image'];?>" width="100"  /> </td>				
	   	</tr>
     <?php
   }



?>
</tbody>
</table>


<p>Bad Condition</p>


                   <table id="myTable" class="table table-bordered " style="color: black; #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>item</th>
						<th>detials</th>
						<th>qty</th>
                        <th>Conditions</th>
						<th>image</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');
 $upload_dir = 'uploads/';


   $query=$conn->query("SELECT * FROM `Office` WHERE con='Bad' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['item'];?></td>
	   		<td><?php echo $fetch['det'];?></td>
	   		<td><?php echo $fetch['qty'];?></td>
            <td><?php echo $fetch['con'];?></td>
	   		<td><img src="uploads/<?php echo $fetch['image'];?>" width="100"  /> </td>				
	   	</tr>
     <?php
   }



?>
</tbody>
</table>








<p>Good Condition</p>


                   <table id="myTable" class="table table-bordered " style="color: black; #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>item</th>
						<th>detials</th>
						<th>qty</th>
                        <th>Conditions</th>
						<th>image</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');
 $upload_dir = 'uploads/';


   $query=$conn->query("SELECT * FROM `Office` WHERE con='Good' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['item'];?></td>
	   		<td><?php echo $fetch['det'];?></td>
	   		<td><?php echo $fetch['qty'];?></td>
            <td><?php echo $fetch['con'];?></td>
	   		<td><img src="uploads/<?php echo $fetch['image'];?>" width="100"  /> </td>				
	   	</tr>
     <?php
   }



?>
</tbody>
</table>




    </div>
      
      <div id="kind" class="tab-pane fade">
      <h3>Kitchen Staff</h3>
       <p>Needed</p>
       
                   <table id="myTable" class="table table-bordered " style="color: black; #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>item</th>
						<th>detials</th>
						<th>qty</th>
                        <th>Conditions</th>
						<th>image</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');
 $upload_dir = 'uploads/';


   $query=$conn->query("SELECT * FROM `kitchen` WHERE con='Needed' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['item'];?></td>
	   		<td><?php echo $fetch['det'];?></td>
	   		<td><?php echo $fetch['qty'];?></td>
            <td><?php echo $fetch['con'];?></td>
	   		<td><img src="uploads/<?php echo $fetch['image'];?>" width="100"  /> </td>				
	   	</tr>
     <?php
   }



?>
</tbody>
</table>


<p>Bad Condition</p>


                   <table id="myTable" class="table table-bordered " style="color: black; #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>item</th>
						<th>detials</th>
						<th>qty</th>
                        <th>Conditions</th>
						<th>image</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');
 $upload_dir = 'uploads/';


   $query=$conn->query("SELECT * FROM `kitchen` WHERE con='Bad' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['item'];?></td>
	   		<td><?php echo $fetch['det'];?></td>
	   		<td><?php echo $fetch['qty'];?></td>
            <td><?php echo $fetch['con'];?></td>
	   		<td><img src="uploads/<?php echo $fetch['image'];?>" width="100"  /> </td>				
	   	</tr>
     <?php
   }



?>
</tbody>
</table>








<p>Good Condition</p>


                   <table id="myTable" class="table table-bordered " style="color: black; #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>item</th>
						<th>detials</th>
						<th>qty</th>
                        <th>Conditions</th>
						<th>image</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');
 $upload_dir = 'uploads/';


   $query=$conn->query("SELECT * FROM `kitchen` WHERE con='Good' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['item'];?></td>
	   		<td><?php echo $fetch['det'];?></td>
	   		<td><?php echo $fetch['qty'];?></td>
            <td><?php echo $fetch['con'];?></td>
	   		<td><img src="uploads/<?php echo $fetch['image'];?>" width="100"  /> </td>				
	   	</tr>
     <?php
   }



?>
</tbody>
</table>


  

    </div>

    <div id="GD" class="tab-pane fade">
      <h3>Balance</h3>
      
                 	<?php 

									 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `expense`") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$gtotal = ""." ".$fetch['sum'];
                         }

                         $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give`") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$htotal = ""." ".$fetch['sum'];
                         }

                          $balance=$htotal-$gtotal;

 ?>
                   <h3>
                  <?php 
                   echo $balance;
                  ?>
              </h3>


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