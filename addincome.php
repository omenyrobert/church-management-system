<?php
session_start();

	require_once'connection.php';

if (!isset($_SESSION['ID'])) {
  header("Location:index.php");
  exit();
}


	//offertory and giving
	if(ISSET($_POST['addgive'])){
		$date = $_POST['date'];
		$amount = $_POST['amount'];
		$tincome = $_POST['tincome'];
		$comment = $_POST['comment'];

$sql = "INSERT INTO give (date, amount, tincome, comment) VALUES ('$date','$amount', '$tincome','$comment')";
 
		$conn->query($sql);
		 header("location: income.php");
            exit;
	} else
	{
		echo "";
	}





//delete give 
 if(ISSET($_REQUEST['id'])){
		$id=$_REQUEST['id'];
 
		$conn->query("DELETE FROM `give` WHERE `id`='$id'") or die("Failed to delete a row!");
	
	}


	//delete other
	if(ISSET($_REQUEST['id'])){
		$id=$_REQUEST['id'];
 
		$conn->query("DELETE FROM `funds` WHERE `id`='$id'") or die("Failed to delete a row!");
	
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

   	  	<div  style="background-color: black; height: 300px;" class="container-fluid">
	 <div class="container" style="padding: 20px; ">
<img src="logo.png" width="50%" >
    <h3 style="margin-top: -50px;" >CHURCH MANAGEMENT SYSTEM</h3></div>
</center>
	<h2>CHURCH'S INCOMES</h2>
	<br/><br/><br/><br/>
</div>
	
	<br/><br/>
</div><br/><br/>
       <div class="container">
       	<a href="printincome.php"><h4 style="color: white;" >Go to print</h4></a>
       	<a href="ViewAll.php"><h4 style="color: white;" >ViewAll</h4></a>
          <a href="addexpenditure.php"><h4 style="color: white;" >Expenditure</h4></a>
          <br/>
          <br/>
          <div style="display: flex; justify-content: space-between;" class="container" >
<a href="tithe.php" style="color: white;" >Tithe</a>	
<a href="offertory.php" style="color: white;" >Offertory</a>
<a href="givem.php" style="color: white;" >Ministries</a>
<a href="purchase.php" style="color: white;" >Purchases</a>
<a href="project.php" style="color: white;" >To Projects</a>
<a href="gifts.php" style="color: white;" >Special Gifts</a>
<a href="funds.php" style="color: white;" >Transfer Funds</a>
<a href="hiring.php" style="color: white;" >Hiring</a>
<a href="donate.php" style="color: white;" >Donations</a>
<a href="fundraise.php" style="color: white;" >From Fundraise</a>
<a href="seed.php" style="color: white;" >Seed</a>
<a href="otherIncomes.php" style="color: white;" >Other Incomes</a>

</div>
<h3>Add Income</h3>
   <form method="POST" action="" enctype="multipart/form-data">
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
					<label>Type of Income</label>
					<select class="form-control" name="tincome" >
						<option value="tithe">tithe</option>
						<option value="offertory">offertory</option>
						<option value="Income_From_Project">Income_From_Project</option>
						<option value="Special_Gifts" >Special_Gifts</option>
						<option value="Tranfer_of_Funds" >Tranfer_of_Funds</option>
                        <option value="Hiring_Facility">Hiring_Facility</option> 
                        <option value="Giving_to_Ministry">Giving_to_Ministry</option>
                        <option value="Giving_in_Kind">Giving_in_Kind</option>
                        <option value="Gifts_donations">Gifts_donations</option>
                        <option value="Fundraise">Fundraise</option>
                        <option value="Seed" >Seed</option>
                        <option value="Other_incomes" >Other_incomes</option>
					</select> 
				</div>
				<div class="form-group col-md-3">
					<label>Comment</label>
					<input type="text" name="comment" required="required" class="form-control"/>
				</div>
				<center><button class="btn btn-primary" onclick="return mess();" name="addgive">Add Income</button></center>
			</div>
			</form>
			<script type="text/javascript">
    
    function mess(){
        alert ("Comment added sucessfully");
        return true;
    }
</script>
       </div>
   



       <div class="container">
  <h2>Incomes of the church</h2>
  <ul class="nav nav-pills" style="background-color: black;" >
    <li class="active"><a data-toggle="pill" href="#tithe" style="color: white;" >Tithe</a></li>
    <li><a data-toggle="pill" href="#offertory" style="color: white;" >Offertory</a></li>
    <li><a data-toggle="pill" href="#project" style="color: white;" >Income From Project</a></li>
    <li><a data-toggle="pill" href="#gifts" style="color: white;" >Special Gifts</a></li>
    <li><a data-toggle="pill" href="#transfer" style="color: white;" >Tranfer of Funds</a></li>
    <li><a data-toggle="pill" href="#hiring" style="color: white;" >Hiring Facility</a></li>
    <li><a data-toggle="pill" href="#ministry" style="color: white;" >Giving to Ministry</a></li>
     <li><a data-toggle="pill" href="#kind" style="color: white;" >Giving in Kind</a></li>
    <li><a data-toggle="pill" href="#GD" style="color: white;" >Gifts & donations</a></li>
    <li><a data-toggle="pill" href="#fundraise" style="color: white;" >Fundraise</a></li>
    <li><a data-toggle="pill" href="#seed" style="color: white;" >Seed</a></li>
    <li><a data-toggle="pill" href="#otherincome" style="color: white;" >Other incomes</a></li>
  </ul>
  
  <div class="tab-content">
    <div id="tithe" class="tab-pane fade in active">
      <h3>Tithe</h3>


      <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>comment</th>
						
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='tithe' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


$sql=$conn->query("SELECT SUM(amount) AS sum FROM `subb` WHERE tincome='tithe' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$outsub = ""." ".$fetch['sum'];
                         }


   $query=$conn->query("SELECT * FROM `give` WHERE tincome='tithe' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>				
	   	</tr>



     <?php
   }



?>
</tbody>
<tr><td><h3>The Total</h3> <h3><?php echo $output;?></h3></td> <td><h3>The Deducted</h3> <h3><?php echo $outsub;?></h3></td>  <td><h3>The Balance</h3> <h3><?php echo $output-$outsub;?></h3></td></tr>
</table>
    </div>



    <div id="offertory" class="tab-pane fade">
      <h3>Offertory</h3>
       
            <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>comment</th>
						
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='offertory' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `subb` WHERE tincome='offertory' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$outsub = ""." ".$fetch['sum'];
                         }



   $query=$conn->query("SELECT * FROM `give` WHERE tincome='offertory' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>			
	   	</tr>




     <?php
   }



?>
</tbody>
<tr><td><h3>The Total</h3> <h3><?php echo $output;?></h3></td> <td><h3>The Deducted</h3> <h3><?php echo $outsub;?></h3></td>  <td><h3>The Balance</h3> <h3><?php echo $output-$outsub;?></h3></td></tr>
</table>


    </div>
    <div id="project" class="tab-pane fade">
      <h3>Income From Projects</h3>
      

      <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>comment</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='Income_From_Project' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `subb` WHERE tincome='Income_From_Project' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$outsub = ""." ".$fetch['sum'];
                         }



   $query=$conn->query("SELECT * FROM `give` WHERE tincome='Income_From_Project' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>				
	   	</tr>



     <?php
   }



?>
</tbody>
<tr><td><h3>The Total</h3> <h3><?php echo $output;?></h3></td> <td><h3>The Deducted</h3> <h3><?php echo $outsub;?></h3></td>  <td><h3>The Balance</h3> <h3><?php echo $output-$outsub;?></h3></td></tr>
</table>



    </div>
    <div id="gifts" class="tab-pane fade">
      <h3>Special Gifts</h3>
     
       
             <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>comment</th>
					
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='Special_Gifts' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `subb` WHERE tincome='Special_Gifts' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$outsub = ""." ".$fetch['sum'];
                         }



   $query=$conn->query("SELECT * FROM `give` WHERE tincome='Special_Gifts' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>				
	   	</tr>






     <?php
   }



?>
</tbody>
<tr><td><h3>The Total</h3> <h3><?php echo $output;?></h3></td> <td><h3>The Deducted</h3> <h3><?php echo $outsub;?></h3></td>  <td><h3>The Balance</h3> <h3><?php echo $output-$outsub;?></h3></td></tr>
</table>




    </div>
     
     <div id="transfer" class="tab-pane fade">
      <h3>Tranfer of Funds</h3>
     
       
                   <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>comment</th>
						
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='Tranfer_of_Funds' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `subb` WHERE tincome='Tranfer_of_Funds' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$outsub = ""." ".$fetch['sum'];
                         }




   $query=$conn->query("SELECT * FROM `give` WHERE tincome='Tranfer_of_Funds' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>
	   					
</tr>

     <?php
   }



?>
</tbody>
<tr><td><h3>The Total</h3> <h3><?php echo $output;?></h3></td> <td><h3>The Deducted</h3> <h3><?php echo $outsub;?></h3></td>  <td><h3>The Balance</h3> <h3><?php echo $output-$outsub;?></h3></td></tr>
</table>




    </div>
     






     <div id="hiring" class="tab-pane fade">
      <h3>Hiring Facility</h3>
    

             <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>comment</th>
					
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='Hiring_Facility' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `subb` WHERE tincome='Hiring_Facility' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$outsub = ""." ".$fetch['sum'];
                         }




   $query=$conn->query("SELECT * FROM `give` WHERE tincome='Hiring_Facility' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>			
	   	</tr>





     <?php
   }



?>
</tbody>
<tr><td><h3>The Total</h3> <h3><?php echo $output;?></h3></td> <td><h3>The Deducted</h3> <h3><?php echo $outsub;?></h3></td>  <td><h3>The Balance</h3> <h3><?php echo $output-$outsub;?></h3></td></tr>
</table>
        


    </div>

        

     <div id="ministry" class="tab-pane fade">
      <h3>Giving to Ministry</h3>
     
       
                    <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>comment</th>
					
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='Giving_to_Ministry' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }


 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `subb` WHERE tincome='Giving_to_Ministry' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$outsub = ""." ".$fetch['sum'];
                         }



   $query=$conn->query("SELECT * FROM `give` WHERE tincome='Giving_to_Ministry' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>			
	   	</tr>






     <?php
   }



?>
</tbody>
<tr><td><h3>The Total</h3> <h3><?php echo $output;?></h3></td> <td><h3>The Deducted</h3> <h3><?php echo $outsub;?></h3></td>  <td><h3>The Balance</h3> <h3><?php echo $output-$outsub;?></h3></td></tr>
</table>




    </div>
      
      <div id="kind" class="tab-pane fade">
      <h3>Giving in Kind</h3>
      
      
                   <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>comment</th>
					
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='Giving_in_Kind' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `subb` WHERE tincome='Giving_in_Kind' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$outsub = ""." ".$fetch['sum'];
                         }



   $query=$conn->query("SELECT * FROM `give` WHERE tincome='Giving_in_Kind' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>			
	   	</tr>






     <?php
   }



?>
</tbody>
<tr><td><h3>The Total</h3> <h3><?php echo $output;?></h3></td> <td><h3>The Deducted</h3> <h3><?php echo $outsub;?></h3></td>  <td><h3>The Balance</h3> <h3><?php echo $output-$outsub;?></h3></td></tr>
</table>
  

    </div>

    <div id="GD" class="tab-pane fade">
      <h3>Gifts & donations</h3>
      
                    <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>comment</th>
					
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='Gifts_donations' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `subb` WHERE tincome='Gifts_donations' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$outsub = ""." ".$fetch['sum'];
                         }




   $query=$conn->query("SELECT * FROM `give` WHERE tincome='Gifts_donations' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>			
	   	</tr>




     <?php
   }



?>
</tbody>
<tr><td><h3>The Total</h3> <h3><?php echo $output;?></h3></td> <td><h3>The Deducted</h3> <h3><?php echo $outsub;?></h3></td>  <td><h3>The Balance</h3> <h3><?php echo $output-$outsub;?></h3></td></tr>
</table>


    </div>
       
       <div id="fundraise" class="tab-pane fade">
      <h3>Fundraise</h3>
     
                   <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>comment</th>
					
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='Fundraise' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `subb` WHERE tincome='Fundraise' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$outsub = ""." ".$fetch['sum'];
                         }



   $query=$conn->query("SELECT * FROM `give` WHERE tincome='Fundraise' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>
	   						
	   	</tr>





     <?php
   }



?>
</tbody>
<tr><td><h3>The Total</h3> <h3><?php echo $output;?></h3></td> <td><h3>The Deducted</h3> <h3><?php echo $outsub;?></h3></td>  <td><h3>The Balance</h3> <h3><?php echo $output-$outsub;?></h3></td></tr>
</table>


    </div>
     


     <div id="seed" class="tab-pane fade">
      <h3>Seed</h3>
      
        
            
                   <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>comment</th>
						
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='seed' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }



 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `subb` WHERE tincome='seed' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$outsub = ""." ".$fetch['sum'];
                         }



   $query=$conn->query("SELECT * FROM `give` WHERE tincome='seed' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>
	   						




     <?php
   }



?>
</tbody>
<tr><td><h3>The Total</h3> <h3><?php echo $output;?></h3></td> <td><h3>The Deducted</h3> <h3><?php echo $outsub;?></h3></td>  <td><h3>The Balance</h3> <h3><?php echo $output-$outsub;?></h3></td></tr>
</table>



    </div>



     <div id="otherincome" class="tab-pane fade">
      <h3>Other Inomes</h3>
     
            
                   <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>comment</th>
						
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `give` WHERE tincome='Other_incomes' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$output = ""." ".$fetch['sum'];
                         }

 $sql=$conn->query("SELECT SUM(amount) AS sum FROM `subb` WHERE tincome='Other_incomes' ") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$outsub = ""." ".$fetch['sum'];
                         }

   $query=$conn->query("SELECT * FROM `give` WHERE tincome='Other_incomes' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['date'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
	   		<td><?php echo $fetch['comment'];?></td>				
	   	</tr>






     <?php
   }



?>
</tbody>
<tr><td><h3>The Total</h3> <h3><?php echo $output;?></h3></td> <td><h3>The Deducted</h3> <h3><?php echo $outsub;?></h3></td>  <td><h3>The Balance</h3> <h3><?php echo $output-$outsub;?></h3></td></tr>
</table>


    </div>




  </div>
</div>



<div style="border: 5px white solid; padding: 10px; margin: 20px;" >
<h4>Get some money from </h4>
<form method="post" style="color: black;" >   
<input type="number" name="amount" placeholder="amount" />
					<select  name="tincome" >
						<option value="tithe">tithe</option>
						<option value="offertory">offertory</option>
						<option value="Income_From_Project">Income_From_Project</option>
						<option value="Special_Gifts" >Special_Gifts</option>
						<option value="Tranfer_of_Funds" >Tranfer_of_Funds</option>
                        <option value="Hiring_Facility">Hiring_Facility</option> 
                        <option value="Giving_to_Ministry">Giving_to_Ministry</option>
                        <option value="Giving_in_Kind">Giving_in_Kind</option>
                        <option value="Gifts_donations">Gifts_donations</option>
                        <option value="Fundraise">Fundraise</option>
                        <option value="Seed" >Seed</option>
                        <option value="Other_incomes" >Other_incomes</option>
					</select> 
				<input type="text" name="comment" placeholder="Comment" />
<input  type="submit" name="subgive" onclick="return mess();" value="Subtract">  
</form>  
	<script type="text/javascript">
    
    function mess(){
        alert ("Money deducted  sucessfully");
        return true;
    }
</script>
<?php  

	if(ISSET($_POST['subgive'])){
		$amount = $_POST['amount'];
		$tincome = $_POST['tincome'];
		$comment = $_POST['comment'];

$sql = "INSERT INTO subb (amount, tincome, comment) VALUES ('$amount', '$tincome','$comment')";
 
		$conn->query($sql);
		echo "<script>alert('Money deducted  sucessfully')</script>";
			echo "<script>window.location='income.php'</script>";
	} else
	{
		echo ""; 
	}
?>  
  <table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>Type Of Income</th>
						<th>Amount</th>
						<th>comment</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');



   $query=$conn->query("SELECT * FROM `subb`  ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['tincome'];?></td>
	   		<td><?php echo $fetch['amount'];?></td>
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









	


<script src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="datatable/jquery.dataTables.min.js"></script>
<script src="datatable/dataTable.bootstrap.min.js"></script>
<!-- generate datatable on our table -->

</body>

</html>