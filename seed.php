
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	
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
	<div  style="background-color: black; height: 250px;">
	 <div class="container" style="padding: 20px; ">
<img src="logo.png" width="50%" >
    <h3 style="margin-top: -50px; color: white;" >CHURCH MANAGEMENT SYSTEM</h3></div>
</center>
	<h4 style="color: white;" >seed</h4>
	<br/><br/><br/><br/>
	<br/><br/>
</div><br/><br/>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="row">
			<?php
				if(isset($_SESSION['error'])){
					echo
					"
					<div class='alert alert-danger text-center'>
						<button class='close'>&times;</button>
						".$_SESSION['error']."
					</div>
					";
					unset($_SESSION['error']);
				}
				if(isset($_SESSION['success'])){
					echo
					"
					<div class='alert alert-success text-center'>
						<button class='close'>&times;</button>
						".$_SESSION['success']."
					</div>
					";
					unset($_SESSION['success']);
				}
			?>
			</div>




<div style="margin-bottom: 50px; margin-top: -30px;">
<a href="income.php">back</a>
			<p onclick="window.print();" >print</p>

</div>
			<div class="height10">
			</div>
			<div class="row">

				<table id="myTable" style="width: 100%;  color: black; background-color: white;" class="table table-bordered">

					<thead>
						<th>Date</th>
						<th>Type Of Income</th>
						<th>Amount</th>
						<th>Comment</th>
					</tr>
					</thead>
					<tbody>
						<?php
include_once('connection.php');

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='Seed' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `give` WHERE tincome='Seed' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['tincome'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
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



<script src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="datatable/jquery.dataTables.min.js"></script>
<script src="datatable/dataTable.bootstrap.min.js"></script>
<!-- generate datatable on our table -->
<script>
$(document).ready(function(){
	//inialize datatable
    $('#myTable').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});
</script>
</body>
<<style>
.PP{
	text-align: center;
}
</style>
</html>