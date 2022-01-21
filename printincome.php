
<?php

session_start();
// Include database connection file
include_once('connection.php');

if (!isset($_SESSION['ID'])) {
	header("Location:index.php");
	exit();
}

?>


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
	<h4 style="color: white;" >All incomes</h4>
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

             

              <form action="" method="GET" >
            	<div class="row">
            		<div class="col-md-4">
            			<input type="date" name="from_date" class="form-control" >
            		</div>

            		<div class="col-md-4">
            			<input type="date" name="to_date" class="form-control" >
            		</div>

            		<div class="col-md-4">
            			<button class="form-control btn-primary " type="submit" >Generate</button>
            		</div>
            		
            	</div>

            </form>




			<div class="height10">
			</div>
			<a href="income.php">back</a>
			<p onclick="window.print();" >print</p>
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

<tr><td><h3>Tithe</h3></td></tr>



						<?php
include_once('connection.php');


if(isset($_GET['from_date'])&&isset($_GET['to_date']))
{
	$from_date=$_GET['from_date'];
	$to_date=$_GET['to_date'];


 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='tithe' && date BETWEEN '$from_date' AND '$to_date' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `give` WHERE tincome='tithe' && date BETWEEN '$from_date' AND '$to_date' ") or die("Failed to fetch row!");
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
      <tr><td colspan="2" ><h4>The Total</h4></td>   <td><h4><?php echo $output;?></h4></td></tr>


     <?php
 }

?>




<tr><td><h3>Offertory</h3></td></tr>

<?php
include_once('connection.php');

if(isset($_GET['from_date'])&&isset($_GET['to_date']))
{
	$from_date=$_GET['from_date'];
	$to_date=$_GET['to_date'];

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='offertory' && date BETWEEN '$from_date' AND '$to_date' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `give` WHERE tincome='offertory' && date BETWEEN '$from_date' AND '$to_date' ") or die("Failed to fetch row!");
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
      <tr><td colspan="2" ><h4>The Total</h4></td>   <td><h4><?php echo $output;?></h4></td></tr>


     <?php
 }

?>


<tr>
	<td>
<h3>Gifts and Donations</h3>
</td>
</tr>

<?php
include_once('connection.php');


if(isset($_GET['from_date'])&&isset($_GET['to_date']))
{
	$from_date=$_GET['from_date'];
	$to_date=$_GET['to_date'];


 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='Gifts_donations' && date BETWEEN '$from_date' AND '$to_date' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `give` WHERE tincome='Gifts_donations' && date BETWEEN '$from_date' AND '$to_date' ") or die("Failed to fetch row!");
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
      <tr><td colspan="2" ><h4>The Total</h4></td>   <td><h4><?php echo $output;?></h4></td></tr>


     <?php


}

?>


<tr>
	<td>
<h3>Income from Church Projects</h3>
</td>
</tr>

<?php
include_once('connection.php');

if(isset($_GET['from_date'])&&isset($_GET['to_date']))
{
	$from_date=$_GET['from_date'];
	$to_date=$_GET['to_date'];


 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='Income_From_Project' && date BETWEEN '$from_date' AND '$to_date' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `give` WHERE tincome='Income_From_Project' && date BETWEEN '$from_date' AND '$to_date' ") or die("Failed to fetch row!");
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
      <tr><td colspan="2" ><h4>The Total</h4></td>   <td><h4><?php echo $output;?></h4></td></tr>


     <?php

}

?>


<tr>
	<td>
<h3>Hiring Facility</h3>
</td>
</tr>


<?php
include_once('connection.php');

if(isset($_GET['from_date'])&&isset($_GET['to_date']))
{
	$from_date=$_GET['from_date'];
	$to_date=$_GET['to_date'];



 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='Hiring_Facility' && date BETWEEN '$from_date' AND '$to_date' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `give` WHERE tincome='Hiring_Facility' && date BETWEEN '$from_date' AND '$to_date' ") or die("Failed to fetch row!");
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
      <tr><td colspan="2" ><h4>The Total</h4></td>   <td><h4><?php echo $output;?></h4></td></tr>


     <?php


}

?>


<tr>
	<td>
<h3>Special Givings</h3>
</td>
</tr>


<?php
include_once('connection.php');

if(isset($_GET['from_date'])&&isset($_GET['to_date']))
{
	$from_date=$_GET['from_date'];
	$to_date=$_GET['to_date'];


 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='Special_Gifts' && date BETWEEN '$from_date' AND '$to_date' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `give` WHERE tincome='Special_Gifts' && date BETWEEN '$from_date' AND '$to_date' ") or die("Failed to fetch row!");
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
      <tr><td colspan="2" ><h4>The Total</h4></td>   <td><h4><?php echo $output;?></h4></td></tr>


     <?php


}
?>

<tr>
	<td>
<h3>Transfer of Funds</h3>
</td>
</tr>


<?php
include_once('connection.php');


if(isset($_GET['from_date'])&&isset($_GET['to_date']))
{
	$from_date=$_GET['from_date'];
	$to_date=$_GET['to_date'];



 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='Tranfer_of_Funds' && date BETWEEN '$from_date' AND '$to_date' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `give` WHERE tincome='Tranfer_of_Funds' && date BETWEEN '$from_date' AND '$to_date' ") or die("Failed to fetch row!");
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
      <tr><td colspan="2" ><h4>The Total</h4></td>   <td><h4><?php echo $output;?></h4></td></tr>


     <?php


}
?>


<tr>
	<td>
<h3>Giving towards Ministry</h3>
</td>
</tr>

<?php
include_once('connection.php');


if(isset($_GET['from_date'])&&isset($_GET['to_date']))
{
	$from_date=$_GET['from_date'];
	$to_date=$_GET['to_date'];




 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='Giving_to_Ministry' && date BETWEEN '$from_date' AND '$to_date' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `give` WHERE tincome='Giving_to_Ministry' && date BETWEEN '$from_date' AND '$to_date' ") or die("Failed to fetch row!");
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
      <tr><td colspan="2" ><h4>The Total</h4></td>   <td><h4><?php echo $output;?></h4></td></tr>


     <?php

}
?>



<tr>
	<td>
<h3>Giving in Kind</h3>
</td>
</tr>


<?php
include_once('connection.php');

if(isset($_GET['from_date'])&&isset($_GET['to_date']))
{
	$from_date=$_GET['from_date'];
	$to_date=$_GET['to_date'];



 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='Giving_in_Kind' && date BETWEEN '$from_date' AND '$to_date' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `give` WHERE tincome='Giving_in_Kind' && date BETWEEN '$from_date' AND '$to_date' ") or die("Failed to fetch row!");
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
      <tr><td colspan="2" ><h4>The Total</h4></td>   <td><h4><?php echo $output;?></h4></td></tr>


     <?php

}

?>

<tr>
	<td>
<h3>Fundraise</h3>
</td>
</tr>



<?php
include_once('connection.php');


if(isset($_GET['from_date'])&&isset($_GET['to_date']))
{
	$from_date=$_GET['from_date'];
	$to_date=$_GET['to_date'];



 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='Fundraise' && date BETWEEN '$from_date' AND '$to_date' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `give` WHERE tincome='Fundraise' && date BETWEEN '$from_date' AND '$to_date' ") or die("Failed to fetch row!");
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
      <tr><td colspan="2" ><h4>The Total</h4></td>   <td><h4><?php echo $output;?></h4></td></tr>


     <?php

}
?>

<tr>
	<td>
<h3>Seed</h3>
</td>
</tr>

<?php
include_once('connection.php');

if(isset($_GET['from_date'])&&isset($_GET['to_date']))
{
	$from_date=$_GET['from_date'];
	$to_date=$_GET['to_date'];



 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='seed' && date BETWEEN '$from_date' AND '$to_date'") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `give` WHERE tincome='seed' && date BETWEEN '$from_date' AND '$to_date' ") or die("Failed to fetch row!");
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
      <tr><td colspan="2" ><h4>The Total</h4></td>   <td><h4><?php echo $output;?></h4></td></tr>


     <?php


}

?>



<tr>
	<td>
<h3>Other Incomes</h3>
</td>
</tr>


<?php
include_once('connection.php');

if(isset($_GET['from_date'])&&isset($_GET['to_date']))
{
	$from_date=$_GET['from_date'];
	$to_date=$_GET['to_date'];



 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='Other_incomes' && date BETWEEN '$from_date' AND '$to_date'  ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `give` WHERE tincome='Other_incomes' && date BETWEEN '$from_date' AND '$to_date' ") or die("Failed to fetch row!");
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
      <tr><td colspan="2" ><h4>The Total</h4></td>   <td><h4><?php echo $output;?></h4></td></tr>


     <?php

}
?>



<?php

include_once('connection.php');


if(isset($_GET['from_date'])&&isset($_GET['to_date']))
{
	$from_date=$_GET['from_date'];
	$to_date=$_GET['to_date'];

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE date BETWEEN '$from_date' AND '$to_date'") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$gtotal = ""." ".$fetch['sum'];
                         }

  ?>
      <tr><td colspan="2" ><h4>The Total</h4></td>   <td><h4><?php echo $output;?></h4></td></tr>


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