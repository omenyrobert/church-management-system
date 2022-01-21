<?php

session_start();
// Include database connection file
include_once('connection.php');

if (!isset($_SESSION['ID'])) {
	header("Location:index.php");
	exit();
}


$upload_dir = 'uploads/';

if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  $sql = "select * from church where id = ".$id;
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $image = $row['image'];
    unlink($upload_dir.$image);
    $sql = "delete from church where id=".$id;
    if(mysqli_query($conn, $sql)){
      header('location:database.php');
    }
  }
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
  <h3 style="color: black;">Add church Members</h3>
       <div class="col-md-10">
       <form action="adddatabase.php" style="color: black;" method="post" enctype="multipart/form-data">
     	<div class="row" >
                    <div class="form-group col-md-3">
                      <label for="name">Full Name</label>
                      <input type="text" class="form-control" name="name"  placeholder="Enter Full Name" value="">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="contact">Date Of Birth</label>
                      <input type="date" class="form-control" name="dob" placeholder="Enter date of birth">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="email">Gender</label>
                       <SELECT name="gender" class="form-control" >
                        <option value="Male" >Male</option>
                        <option value="Female" >Female</option>
                      </SELECT>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Address</label>
                      <input type="text" class="form-control" name="address" placeholder="Enter Address">
                    </div>
                    <div class="form-group col-md-3">
                      <label>Contact</label>
                     <input type="text" name="contact" class="form-control" placeholder="enter contact" >
                    </div>
                     <div class="form-group col-md-3">
                      <label>Ministry</label>
                      <SELECT name="ministry" class="form-control" >
                        <option value="Men" >Men</option>
                        <option value="Women" >Women</option>
                        <option value="Children" >Children</option>
                        <option value="Youth" >Youth</option>
                        <option value="Married" >Married</option>
                        <option value="Pastoral" >Pastoral</option>
                        <option value="Worship" >Worship</option>
                        <option value="Usher" >Usher</option>
                        <option value="Elders" >Elders</option>
                        <option value="Intercessor" >Intercessor</option>
                      </SELECT>
                    </div>
                    
                    
                    <div class="form-group col-md-3">
                      <label>Membership</label>
                      <SELECT name="membership" class="form-control" >
                        <option value="staff" >Staff</option>
                        <option value="leader" >Leader</option>
                        <option value="member" >Member</option>
                      </SELECT>
                    </div>

                    <div class="form-group col-md-3">
                      <label>Leader</label>
                      <SELECT name="leader" class="form-control" >
                        <option value="">none</option>
                        <option value="a.chairperson" >Chair person</option>
                        <option value="b.vice" >Vice Chair Person</option>
                        <option value="c.treasurer" >Treasurer</option>
                        <option value="d.cordinator" >Cordinator</option>
                        <option value="e.events" >Events</option>
                      </SELECT>
                    </div>


                      <div class="form-group col-md-3">
                      <label>Background</label>
                      <textarea type="text" name="background" class="form-control" placeholder="enter where the person came from">
                      </textarea>
                    </div>

                    <div class="form-group col-md-3">
                      <label>Choose Image</label>
                      <input type="file" class="form-control" name="image">
                    </div>      
                   
                                    
                    <div class="form-group col-md-3">
                      <br/>
                      <button type="submit" name="addd" class="btn btn-primary waves">Submit</button>
                    </div>
                </div>
                </form>
<br/>
<h5 style="color:black;">Members Waiting to be approved</h5>
<br/>
<table id="myTable" class="table table-bordered" style="width:100%; color: black; background-color: white; ">
                        <thead>
                            <tr>                                <th>Photo</th>
                                <th>Full Name</th>
                                <th>Date of Birth</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Ministry</th>
                                <th>Bacground</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                            $sql = "select * from church WHERE status='0'";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)){
                              while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <tr style="color: black;" >
                            <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['dob'] ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['contact'] ?></td>
                            <td><?php echo $row['ministry'] ?></td>
                             <td><?php echo $row['background'] ?></td>
                            <td class="text-center">
                            <button type="button" class="btn btn-default" style="background-color: black; color: white;" data-toggle="modal" data-target="#approve<?php echo $row['id']; ?>">Approve</button> 
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#reject<?php echo $row['id']; ?>">Reject</button> 
                            </td>
                          </tr>

                  
                          <div class="modal fade" style="color: black;" id="approve<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Approve</h4></center>
            </div>
            <div class="modal-body" style="padding: 50px;">	
            	<form method="post" action="approving.php" >
            		
            		<input type="hidden" name="id" value="<?php echo  $row['id'];?>" class="form-control" >                  
                     <input type="text" name="fullname" value="<?php echo  $row['name'];?>" class="form-control" readOnly><br/>

                     <label>Date of birth</label><br/>
                     <input type="date" name="dob" class="form-control" value="<?php echo  $row['dob'];?>" readOnly><br/>
					 <label>Gender</label><br/>
            		 <SELECT name="gender" class="form-control" value="<?php echo  $row['gender'];?>" readOnly>
                        <option value="Male" >Male</option>
                        <option value="Female" >Female</option>
                      </SELECT><br/>
                    <label>Address</label><br/>
            		<input type="type" name="address" value="<?php echo  $row['address'];?>" class="form-control" readOnly>
					<br/>
					<label>Contact</label><br/>
            		<input type="text" name="contact" value="<?php echo  $row['contact'];?>" class="form-control" readOnly>
					<br/>
                    <label>Ministry</label>
                      <SELECT name="ministry" value="<?php echo  $row['ministry'];?>" class="form-control" readOnly>
                        <option value="Men" >Men</option>
                        <option value="Women" >Women</option>
                        <option value="Children" >Children</option>
                        <option value="Youth" >Youth</option>
                        <option value="Married" >Married</option>
                        <option value="Pastoral" >Pastoral</option>
                        <option value="Worship" >Worship</option>
                        <option value="Usher" >Usher</option>
                        <option value="Elders" >Elders</option>
                        <option value="Intercessor" >Intercessor</option>
                      </SELECT>
<br/>
<label>Membership</label>
                      <SELECT name="membership" class="form-control" value="<?php echo  $row['membership'];?>" readOnly>
                      <option value="<?php echo  $row['membership'];?>"><?php echo  $row['membership'];?></option>
                        <option value="staff" >Staff</option>
                        <option value="leader" >Leader</option>
                        <option value="member" >Member</option>
                      </SELECT>
                    <br/>
                      <label>Leader</label>
                      <SELECT name="leader" class="form-control" value="<?php echo  $row['leader'];?>" readOnly>
                      <option value="<?php echo  $row['leader'];?>"><?php echo  $row['leader'];?></option>
                        <option value="">none</option>
                        <option value="a.chairperson" >Chair person</option>
                        <option value="b.vice" >Vice Chair Person</option>
                        <option value="c.treasurer" >Treasurer</option>
                        <option value="d.cordinator" >Cordinator</option>
                        <option value="e.events" >Events</option>
                      </SELECT>
                      <label>Background</label>
                      <textarea type="text" name="background" class="form-control" placeholder="enter where the person came from" readOnly>
                      <?php echo  $row['background'];?>
                      </textarea>
                   <br/>
                      <img src="<?php echo $upload_dir.$row['image'] ?>" height="200">
                                
				
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="approve" class="btn btn-primary">Approve</button>
            </div>
        </form>

        </div>
    </div>
</div>






<div class="modal fade" style="color: black;" id="reject<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Reject</h4></center>
            </div>
            <div class="modal-body" style="padding: 50px;">	
            	<form method="post" action="rejecting.php">
            		
            		<input type="hidden" name="id" value="<?php echo  $row['id'];?>" class="form-control" >                  
                     <input type="text" name="fullname" value="<?php echo  $row['name'];?>" class="form-control" readOnly><br/>

                     <label>Date of birth</label><br/>
                     <input type="date" name="dob" class="form-control" value="<?php echo  $row['dob'];?>" readOnly><br/>
					 <label>Gender</label><br/>
            		 <SELECT name="gender" class="form-control" value="<?php echo  $row['gender'];?>" readOnly>
                        <option value="Male" >Male</option>
                        <option value="Female" >Female</option>
                      </SELECT><br/>
                    <label>Address</label><br/>
            		<input type="type" name="address" value="<?php echo  $row['address'];?>" class="form-control" readOnly>
					<br/>
					<label>Contact</label><br/>
            		<input type="text" name="contact" value="<?php echo  $row['contact'];?>" class="form-control" readOnly>
					<br/>
                    <label>Ministry</label>
                      <SELECT name="ministry" value="<?php echo  $row['ministry'];?>" class="form-control" readOnly>
                        <option value="Men" >Men</option>
                        <option value="Women" >Women</option>
                        <option value="Children" >Children</option>
                        <option value="Youth" >Youth</option>
                        <option value="Married" >Married</option>
                        <option value="Pastoral" >Pastoral</option>
                        <option value="Worship" >Worship</option>
                        <option value="Usher" >Usher</option>
                        <option value="Elders" >Elders</option>
                        <option value="Intercessor" >Intercessor</option>
                      </SELECT>
<br/>
<label>Membership</label>
                      <SELECT name="membership" class="form-control" value="<?php echo  $row['membership'];?>" readOnly>
                      <option value="<?php echo  $row['membership'];?>"><?php echo  $row['membership'];?></option>
                        <option value="staff" >Staff</option>
                        <option value="leader" >Leader</option>
                        <option value="member" >Member</option>
                      </SELECT>
                    <br/>
                      <label>Leader</label>
                      <SELECT name="leader" class="form-control" value="<?php echo  $row['leader'];?>" readOnly>
                      <option value="<?php echo  $row['leader'];?>"><?php echo  $row['leader'];?></option>
                        <option value="">none</option>
                        <option value="a.chairperson" >Chair person</option>
                        <option value="b.vice" >Vice Chair Person</option>
                        <option value="c.treasurer" >Treasurer</option>
                        <option value="d.cordinator" >Cordinator</option>
                        <option value="e.events" >Events</option>
                      </SELECT>
                      <label>Background</label>
                      <textarea type="text" name="background" class="form-control" placeholder="enter where the person came from" readOnly>
                      <?php echo  $row['background'];?>
                      </textarea>
                   <br/>
                      <img src="<?php echo $upload_dir.$row['image'] ?>" height="200">
                      <br/><br/>
                                <h4>Reason</h4>
				<input type="text" name="reason" class="form-control">
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="approve" class="btn btn-primary">Reject</button>
            </div>
        </form>

        </div>
    </div>
</div>



                          <?php
                              }
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

</html>