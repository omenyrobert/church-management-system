
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Account</title>
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
<body class="bod">
<div class="container-fluid">
	
</div><br/><br/>
<div class="row" style=" width: 100%;">

<div class="col-sm-9" style="display: flex;">
<p onclick="window.print();">print</p>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="music.php"><h4 style="color: white;">back</h4></a>&nbsp;&nbsp;&nbsp;&nbsp;
</div>
</div>



			<table id="myTable" class="table table-bordered " style="width: 100%;">
				<thead>
					<tr>
						<th>item</th>
						<th>detials</th>
						<th>qty</th>
						<th>image</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');




   $query=$conn->query("SELECT * FROM `music`") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['item'];?></td>
	   		<td><?php echo $fetch['det'];?></td>
	   		<td><?php echo $fetch['qty'];?></td>
	   		<td><img src="uploads/<?php echo $fetch['image'];?>" width="100"  /> </td>
			
	   	</tr>

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