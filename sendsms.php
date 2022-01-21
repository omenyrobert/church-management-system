
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
<body>
	
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
<a href="database.php">back</a>
			<p onclick="window.print();" >print</p>

</div>
<form action="sms.php" method="POST" >
	<textarea type="text" name="message" class="form-control" placeholder="type your sms here" ></textarea>
			<div class="height10">
			</div>
			<div class="row">

				<table id="myTable" style="width: 100%;  color: black; background-color: white;" class="table table-bordered">

				 <thead>
                            <tr>
                                <th>Check</th>
                                <th>Photo</th>
                                <th>Full Name</th>
                                <th>Date of Birth</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Ministry</th>
                                <th>Bacground</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                          include_once('connection.php');
                                  
                                   $upload_dir = 'uploads/';

                             $query=$conn->query("SELECT * FROM `church` ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc()){
                          ?>
                          <tr style="color: black;" >
                            <td><input type="checkbox" name="contact[]" value="<?php echo $fetch['contact'] ?>"></td>
                            <td><img src="<?php echo $upload_dir.$fetch['image'] ?>" height="40"></td>
                            <td><?php echo $fetch['name'] ?></td>
                            <td><?php echo $fetch['dob'] ?></td>
                            <td><?php echo $fetch['gender'] ?></td>
                            <td><?php echo $fetch['address'] ?></td>
                            <td><?php echo $fetch['contact'] ?></td>
                            <td><?php echo $fetch['ministry'] ?></td>
                             <td><?php echo $fetch['background'] ?></td>
                          </tr>
                          <?php
                              }
                            
                          ?>
                        </tbody>
</table>
			</div>
		</div>
		<button type="submit" name="send" class="btn btn-primary" >Send</button>
	</form>
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