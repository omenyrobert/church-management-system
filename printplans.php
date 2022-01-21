
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>System</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="datatable/dataTable.bootstrap.min.css">
	<style>
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
<body class="container">
<div class="container-fluid">

   	<div  style="background-color: black; height: 250px;" class="container-fluid">
	 <div class="container" style="padding: 20px; ">
<img src="logo.png" width="50%" >
<h4 style="color: white;">CHURCH'S SCHEDULES</h4>
   </div>
</center>
	
	<br/><br/>
<p onclick="window.print();" >Print</p>
<a href="dashboard.php">Back</a>
	<br/><br/>
    

      <table id="myTable" class="table table-bordered " style=" width: 100%;">
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
	   	</tr>




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