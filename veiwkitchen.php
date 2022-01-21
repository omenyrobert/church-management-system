<?php
	require_once'connection.php';

if(isset($_POST['btnsave'])){
	$item = $_POST['item'];
	$det = $_POST['det'];
	$qty = $_POST['qty'];
  $con = $_POST['con'];

	//image upload

	$msg = "";
	$image = $_FILES['image']['name'];
	$target = "uploads/".basename($image);

	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}

  	$insert_data = "INSERT INTO kitchen (item,det,qty,con,image) VALUES ('$item','$det','$qty','$con','$image')";
  	$run_data = mysqli_query($conn,$insert_data);

  	if($run_data){
  			echo "<script>alert('information saved successfully')</script>";
          	echo "<script>window.location='kitchen.php'</script>";
  	}else{
 			echo "<script>alert('information not saved successfully')</script>";
	 echo "<script>window.location='kitchen.php'</script>";
}
}





	//delete other
	if(ISSET($_REQUEST['id'])){
		$id=$_REQUEST['id'];
 
		$conn->query("DELETE FROM `kitchen` WHERE `id`='$id'") or die("Failed to delete a row!");
	
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

<div class="row" style=" width: 100%;">

<div class="col-sm-9" style="display: flex;">
<a href="dashboard.php"><h4 style="color: white;">Dashboard</h4></a>&nbsp;&nbsp;&nbsp;&nbsp;
</div>
</div>


			<table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>item</th>
						<th>detials</th>
						<th>qty</th>
            <th>Condition</th>
						<th>image</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');




   $query=$conn->query("SELECT * FROM `kitchen`") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['item'];?></td>
	   		<td><?php echo $fetch['det'];?></td>
	   		<td><?php echo $fetch['qty'];?></td>
        <td><?php echo $fetch['con'];?></td>
	   		<td><img src="uploads/<?php echo $fetch['image']; ?>" width="100"  /></td>			
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