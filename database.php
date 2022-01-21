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
    #tabs{
      border: 1px solid #075286;
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
  <h4 style="color: black;">Add church Members</h4>
       <div class="col-md-10">
       <form action="adddata.php" style="color: black;" method="post" enctype="multipart/form-data">
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
                      <button type="submit" name="addd" class="btn btn-primary waves">Submit</button>
                    </div>
                </div>
                </form>
<br/>
<br/>

<ul class="nav nav-pills" >
<li class="active"><a data-toggle="pill" href="#all" id="tabs"  >All</a></li>
    <li><a data-toggle="pill" href="#men" id="tabs"  >Men</a></li>
    <li><a data-toggle="pill" href="#women" id="tabs" >Women</a></li>
    <li><a data-toggle="pill" href="#youth" id="tabs"  >Youth</a></li>
     <li><a data-toggle="pill" href="#children" id="tabs"  >Children</a></li>
    <li><a data-toggle="pill" href="#married" id="tabs"  >Married</a></li>
    <li><a data-toggle="pill" href="#elders" id="tabs"  >Elders</a></li>
    <li><a data-toggle="pill" href="#ushers" id="tabs"  >Ushers</a></li>
     <li><a data-toggle="pill" href="#worship" id="tabs"  >Worship</a></li>
    <li><a data-toggle="pill" href="#intercessors" id="tabs"  >intercessors</a></li>
    <li><a data-toggle="pill" href="#pastoral" id="tabs"  >Pastoral</a></li>
    <li><a data-toggle="pill" href="#leader" id="tabs"  >Leaders</a></li>
    <li><a data-toggle="pill" href="#staff" id="tabs"  >Staff</a></li>
  </ul>

<br/>

<div class="tab-content">
    <div id="tithe" class="tab-pane fade in active">
      <h4 style="color: black;">All Members</h4>

      <a style="color: black;" href="printall.php">Print</a>

      <table id="myTable" class="table table-bordered" style="width:100%; color: black; background-color: white; ">
                        <thead>
                            <tr><th>Photo</th>
                                <th>Full Name</th>
                                <th>Leadership</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Ministry</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                            $sql = "select * from church WHERE status='1'";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)){
                              while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <tr style="color: black;" >
                            <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['leader'] ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['contact'] ?></td>
                            <td><?php echo $row['ministry'] ?></td>
                             
                            <td class="text-center">
                              <a href="editchurch.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i class="fa fa-user-edit"></i>Edit</a>
                              <a href="database.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i>Del</a>
                            </td>
                          </tr>
                          <?php
                              }
                            }
                          ?>
                        </tbody>
                      </table>




    </div>



    <div id="men" class="tab-pane fade">
      <h4 style="color: black;">Men</h4>
       <a style="color: black;" href="printmen.php">Print</a>
      <table id="myTable1" class="table table-bordered" style="width:100%; color: black; background-color: white; ">
                        <thead>
                            <tr><th>Photo</th>
                                <th>Full Name</th>
                                <th>Leadership</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Ministry</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $sql = "select * from church WHERE status='1' AND ministry='Men' AND membership='leader' ORDER BY leader";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)){
                              while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <tr style="color: black; font-weight: bold;" >
                            <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['leader'] ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['contact'] ?></td>
                            <td><?php echo $row['ministry'] ?></td>
                             
                             <td class="text-center">
                              <a href="editchurch.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i class="fa fa-user-edit"></i>Edit</a>
                              <a href="database.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i>Del</a>
                            </td>
                          </tr>
                          <?php
                              }
                            }
                          ?>
                          <?php
                            $sql = "select * from church WHERE status='1' AND ministry='Men'";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)){
                              while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <tr style="color: black;" >
                            <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['leader'] ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['contact'] ?></td>
                            <td><?php echo $row['ministry'] ?></td>
                             
                            <td class="text-center">
                              <a href="editchurch.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i class="fa fa-user-edit"></i>Edit</a>
                              <a href="database.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i>Del</a>
                            </td>
                          </tr>
                          <?php
                              }
                            }
                          ?>
                        </tbody>
                      </table>


    </div>
    <div id="women" class="tab-pane fade">
    <a style="color: black;" href="printwomen.php">Print</a>
      <h4 style="color: black;">Women</h4>
      
      <table id="myTable2" class="table table-bordered" style="width:100%; color: black; background-color: white; ">
                        <thead>
                            <tr><th>Photo</th>
                                <th>Full Name</th>
                                <th>Leadership</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Ministry</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                            $sql = "select * from church WHERE status='1' AND ministry='Women' AND membership='leader' ORDER BY leader";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)){
                              while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <tr style="color: black; font-weight: bold;" >
                            <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['leader'] ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['contact'] ?></td>
                            <td><?php echo $row['ministry'] ?></td>
                             
                             <td class="text-center">
                              <a href="editchurch.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i class="fa fa-user-edit"></i>Edit</a>
                              <a href="database.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i>Del</a>
                            </td>
                          </tr>
                          <?php
                              }
                            }
                          ?>



                          <?php
                            $sql = "select * from church WHERE status='1' AND ministry='Women'";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)){
                              while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <tr style="color: black;" >
                            <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['leader'] ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['contact'] ?></td>
                            <td><?php echo $row['ministry'] ?></td>
                             
                            <td class="text-center">
                              <a href="editchurch.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i class="fa fa-user-edit"></i>Edit</a>
                              <a href="database.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i>Del</a>
                            </td>
                          </tr>
                          <?php
                              }
                            }
                          ?>
                        </tbody>
                      </table>


    </div>

    

    <div id="youth" class="tab-pane fade">
         <h4 style="color: black;">Youth</h4>
         <a style="color: black;" href="printyouth.php">Print</a>
         <br/>
      <table id="myTable3" class="table table-bordered" style="width:100%; color: black; background-color: white; ">
                        <thead>
                            <tr><th>Photo</th>
                                <th>Full Name</th>
                                <th>Leadership</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Ministry</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                            $sql = "select * from church WHERE status='1' AND ministry='Youth' AND membership='leader' ORDER BY leader";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)){
                              while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <tr style="color: black; font-weight: bold;" >
                            <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['leader'] ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['contact'] ?></td>
                            <td><?php echo $row['ministry'] ?></td>
                             
                             <td class="text-center">
                              <a href="editchurch.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i class="fa fa-user-edit"></i>Edit</a>
                              <a href="database.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i>Del</a>
                            </td>
                          </tr>
                          <?php
                              }
                            }
                          ?>


                          <?php
                            $sql = "select * from church WHERE status='1' AND ministry='Youth'";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)){
                              while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <tr style="color: black;" >
                            <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['leader'] ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['contact'] ?></td>
                            <td><?php echo $row['ministry'] ?></td>
                             
                            <td class="text-center">
                              <a href="editchurch.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i class="fa fa-user-edit"></i>Edit</a>
                              <a href="database.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i>Del</a>
                            </td>
                          </tr>
                          <?php
                              }
                            }
                          ?>
                        </tbody>
                      </table>




    </div>





         <div id="children" class="tab-pane fade">
         <h4 style="color: black;">Children</h4>
         <a style="color: black;" href="printchildren.php">Print</a>
         <br/>
      <table id="myTable4" class="table table-bordered" style="width:100%; color: black; background-color: white; ">
                        <thead>
                            <tr><th>Photo</th>
                                <th>Full Name</th>
                                <th>Leadership</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Ministry</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                    
                        <?php
                            $sql = "select * from church WHERE status='1' AND ministry='Children' AND membership='leader' ORDER BY leader";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)){
                              while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <tr style="color: black; font-weight: bold;" >
                            <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['leader'] ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['contact'] ?></td>
                            <td><?php echo $row['ministry'] ?></td>
                             
                             <td class="text-center">
                              <a href="editchurch.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i class="fa fa-user-edit"></i>Edit</a>
                              <a href="database.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i>Del</a>
                            </td>
                          </tr>
                          <?php
                              }
                            }
                          ?>



                          <?php
                            $sql = "select * from church WHERE status='1' AND ministry='Children'";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)){
                              while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <tr style="color: black;" >
                            <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['leader'] ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['contact'] ?></td>
                            <td><?php echo $row['ministry'] ?></td>
                             
                            <td class="text-center">
                              <a href="editchurch.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i class="fa fa-user-edit"></i>Edit</a>
                              <a href="database.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i>Del</a>
                            </td>
                          </tr>
                          <?php
                              }
                            }
                          ?>
                        </tbody>
                      </table>




    </div>

     
     <div id="married" class="tab-pane fade">
       
     
              <h4 style="color: black;">Married</h4>
              <a style="color: black;" href="printmarried.php">Print</a>
              <br/>
      <table id="myTable5" class="table table-bordered" style="width:100%; color: black; background-color: white; ">
                        <thead>
                            <tr><th>Photo</th>
                                <th>Full Name</th>
                                <th>Leadership</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Ministry</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>


                        <?php
                            $sql = "select * from church WHERE status='1' AND ministry='Married' AND membership='leader' ORDER BY leader";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)){
                              while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <tr style="color: black; font-weight: bold;" >
                            <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['leader'] ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['contact'] ?></td>
                            <td><?php echo $row['ministry'] ?></td>
                             
                             <td class="text-center">
                              <a href="editchurch.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i class="fa fa-user-edit"></i>Edit</a>
                              <a href="database.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i>Del</a>
                            </td>
                          </tr>
                          <?php
                              }
                            }
                          ?>



                          <?php
                            $sql = "select * from church WHERE status='1' AND ministry='Married'";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)){
                              while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <tr style="color: black;" >
                            <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['leader'] ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['contact'] ?></td>
                            <td><?php echo $row['ministry'] ?></td>
                             
                            <td class="text-center">
                              <a href="editchurch.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i class="fa fa-user-edit"></i>Edit</a>
                              <a href="database.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i>Del</a>
                            </td>
                          </tr>
                          <?php
                              }
                            }
                          ?>
                        </tbody>
                      </table>

                          </div>

                 
                          <div id="elders" class="tab-pane fade">
       
     
       <h4 style="color: black;">Elders</h4>
       <a style="color: black;" href="printelders.php">Print</a>
       <br/><br/>
<table id="myTable6" class="table table-bordered" style="width:100%; color: black; background-color: white; ">
                 <thead>
                     <tr><th>Photo</th>
                         <th>Full Name</th>
                         <th>Gender</th>
                         <th>Address</th>
                         <th>Contact</th>
                         <th>Ministry</th>
                         <th>Actions</th>
                     </tr>
                 </thead>
                 <tbody>

                     <?php
                     $sql = "select * from church WHERE status='1' AND ministry='Elders'";
                     $result = mysqli_query($conn, $sql);
                     if(mysqli_num_rows($result)){
                       while($row = mysqli_fetch_assoc($result)){
                   ?>
                   <tr style="color: black;" >
                     <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
                     <td><?php echo $row['name'] ?></td>
                     <td><?php echo $row['gender'] ?></td>
                     <td><?php echo $row['address'] ?></td>
                     <td><?php echo $row['contact'] ?></td>
                     <td><?php echo $row['ministry'] ?></td>
                      
                     <td class="text-center">
                       <a href="editchurch.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i class="fa fa-user-edit"></i>Edit</a>
                       <a href="database.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i>Del</a>
                     </td>
                   </tr>
                   <?php
                       }
                     }
                   ?>
                 </tbody>
               </table>

                   </div>






     <div id="ushers" class="tab-pane fade">
       
     
              <h4 style="color: black;">Ushers</h4>
              <a style="color: black;" href="printushers.php">Print</a>
              <br/><br/>
      
      <table id="myTable7" class="table table-bordered" style="width:100%; color: black; background-color: white; ">
                        <thead>
                            <tr><th>Photo</th>
                                <th>Full Name</th>
                                <th>Leadership</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Ministry</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                            $sql = "select * from church WHERE status='1' AND ministry='Usher' AND membership='leader' ORDER BY leader";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)){
                              while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <tr style="color: black; font-weight: bold;" >
                            <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['leader'] ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['contact'] ?></td>
                            <td><?php echo $row['ministry'] ?></td>
                             
                             <td class="text-center">
                              <a href="editchurch.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i class="fa fa-user-edit"></i>Edit</a>
                              <a href="database.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i>Del</a>
                            </td>
                          </tr>
                          <?php
                              }
                            }
                          ?>

                          <?php
                            $sql = "select * from church WHERE status='1' AND ministry='Usher'";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)){
                              while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <tr style="color: black;" >
                            <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['leader'] ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['contact'] ?></td>
                            <td><?php echo $row['ministry'] ?></td>
                             
                            <td class="text-center">
                              <a href="editchurch.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i class="fa fa-user-edit"></i>Edit</a>
                              <a href="database.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i>Del</a>
                            </td>
                          </tr>
                          <?php
                              }
                            }
                          ?>
                        </tbody>
                      </table>
                          </div>
                          <div id="worship" class="tab-pane fade">
       
     
       <h4 style="color: black;">Worship</h4>
       <a style="color: black;" href="printworship.php">Print</a>
              <br/><br/>
<table id="myTable8" class="table table-bordered" style="width:100%; color: black; background-color: white; ">
                 <thead>
                     <tr><th>Photo</th>
                         <th>Full Name</th>
                         <th>Leadership</th>
                         <th>Gender</th>
                         <th>Address</th>
                         <th>Contact</th>
                         <th>Ministry</th>
                         <th>Actions</th>
                     </tr>
                 </thead>
                 <tbody>
                 <?php
                            $sql = "select * from church WHERE status='1' AND ministry='Worship' AND membership='leader' ORDER BY leader";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)){
                              while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <tr style="color: black; font-weight: bold;" >
                            <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['leader'] ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['contact'] ?></td>
                            <td><?php echo $row['ministry'] ?></td>
                             
                             <td class="text-center">
                              <a href="editchurch.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i class="fa fa-user-edit"></i>Edit</a>
                              <a href="database.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i>Del</a>
                            </td>
                          </tr>
                          <?php
                              }
                            }
                          ?>

                   <?php
                     $sql = "select * from church WHERE status='1' AND ministry='Worship'";
                     $result = mysqli_query($conn, $sql);
                     if(mysqli_num_rows($result)){
                       while($row = mysqli_fetch_assoc($result)){
                   ?>
                   <tr style="color: black;" >
                     <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
                     <td><?php echo $row['name'] ?></td>
                     <td><?php echo $row['leader'] ?></td>
                     <td><?php echo $row['gender'] ?></td>
                     <td><?php echo $row['address'] ?></td>
                     <td><?php echo $row['contact'] ?></td>
                     <td><?php echo $row['ministry'] ?></td>
                      
                     <td class="text-center">
                       <a href="editchurch.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i class="fa fa-user-edit"></i>Edit</a>
                       <a href="database.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i>Del</a>
                     </td>
                   </tr>
                   <?php
                       }
                     }
                   ?>
                 </tbody>
               </table>

                   </div>
                   <div id="intercessors" class="tab-pane fade">
       
     
       <h4 style="color: black;">Intercessors</h4>
       <a style="color: black;" href="printintercessors.php">Print</a>
              <br/><br/>

<table id="myTable9" class="table table-bordered" style="width:100%; color: black; background-color: white; ">
                 <thead>
                     <tr><th>Photo</th>
                         <th>Full Name</th>
                         <th>Leadership</th>
                         <th>Gender</th>
                         <th>Address</th>
                         <th>Contact</th>
                         <th>Ministry</th>
                         <th>Actions</th>
                     </tr>
                 </thead>
                 <tbody>
                   <?php
                     $sql = "select * from church WHERE status='1' AND ministry='Intercessor'";
                     $result = mysqli_query($conn, $sql);
                     if(mysqli_num_rows($result)){
                       while($row = mysqli_fetch_assoc($result)){
                   ?>
                   <tr style="color: black;" >
                     <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
                     <td><?php echo $row['name'] ?></td>
                     <td><?php echo $row['leader'] ?></td>
                     <td><?php echo $row['gender'] ?></td>
                     <td><?php echo $row['address'] ?></td>
                     <td><?php echo $row['contact'] ?></td>
                     <td><?php echo $row['ministry'] ?></td>
                      
                     <td class="text-center">
                       <a href="editchurch.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i class="fa fa-user-edit"></i>Edit</a>
                       <a href="database.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i>Del</a>
                     </td>
                   </tr>
                   <?php
                       }
                     }
                   ?>
                 </tbody>
               </table>

                   </div>
        

     <div id="pastoral" class="tab-pane fade">
       
     
              <h4 style="color: black;">Pastoral</h4>
              <a style="color: black;" href="printpastoral.php">Print</a>
              <br/><br/>
      <table id="myTable10" class="table table-bordered" style="width:100%; color: black; background-color: white; ">
                        <thead>
                            <tr><th>Photo</th>
                                <th>Full Name</th>
                                <th>Leadership</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Ministry</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                            $sql = "select * from church WHERE status='1' AND ministry='Pastoral'";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)){
                              while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <tr style="color: black;" >
                            <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['leader'] ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['contact'] ?></td>
                            <td><?php echo $row['ministry'] ?></td>
                             
                            <td class="text-center">
                              <a href="editchurch.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i class="fa fa-user-edit"></i>Edit</a>
                              <a href="database.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i>Del</a>
                            </td>
                          </tr>
                          <?php
                              }
                            }
                          ?>
                        </tbody>
                      </table>
                          </div>
                    
                
      <div id="leader" class="tab-pane fade">
        
      
               <h4 style="color: black;">Leaders</h4>
               <a style="color: black;" href="printleaders.php">Print</a>
              <br/><br/>
      <table id="myTable13" class="table table-bordered" style="width:100%; color: black; background-color: white; ">
                        <thead>
                            <tr><th>Photo</th>
                                <th>Full Name</th>
                                <th>Leadership</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Ministry</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                            $sql = "select * from church WHERE status='1' AND membership='leader'";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)){
                              while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <tr style="color: black;" >
                            <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['leader'] ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['contact'] ?></td>
                            <td><?php echo $row['ministry'] ?></td>
                             
                            <td class="text-center">
                              <a href="editchurch.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i class="fa fa-user-edit"></i>Edit</a>
                              <a href="database.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i>Del</a>
                            </td>
                          </tr>
                          <?php
                              }
                            }
                          ?>
                        </tbody>
                      </table>
                    

    </div>

    <div id="staff" class="tab-pane fade">
      

             <h4 style="color: black;">Staff</h4>
             <a style="color: black;" href="printstaff.php">Print</a>
              <br/><br/>
      <table id="myTable14" class="table table-bordered" style="width:100%; color: black; background-color: white; ">
                        <thead>
                            <tr><th>Photo</th>
                                <th>Full Name</th>
                                <th>Leadership</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Ministry</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                            $sql = "select * from church WHERE status='1' AND membership='staff'";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)){
                              while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <tr style="color: black;" >
                            <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['leader'] ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['contact'] ?></td>
                            <td><?php echo $row['ministry'] ?></td>
                             
                            <td class="text-center">
                              <a href="editchurch.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i class="fa fa-user-edit"></i>Edit</a>
                              <a href="database.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i>Del</a>
                            </td>
                          </tr>
                          <?php
                              }
                            }
                          ?>
                        </tbody>
                      </table>


    </div>
       
      
     

    </div>





   <br/>
   <br/>
   <h4 style="color: black;">Rejected Registration</h4>
   <br/>
                      <table id="myTable15" class="table table-bordered" style="width:100%; color: black; background-color: white; ">
                        <thead>
                            <tr>                                <th>Photo</th>
                                <th>Full Name</th>
                                <th>Leadership</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Ministry</th>
                                <th>Reason</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                            $sql = "select * from church WHERE status='2'";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)){
                              while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <tr style="color: black;" >
                            <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['leader'] ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['contact'] ?></td>
                            <td><?php echo $row['ministry'] ?></td>
                             
                             <td><?php echo $row['reason'] ?></td>
                            <td class="text-center">
                            <button type="button" class="btn btn-default" style="background-color: black; color: white;" data-toggle="modal" data-target="#stock<?php echo $row['id']; ?>">Resend</button> 
                              <a href="database.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i>Del</a>
                            </td>
                          </tr>


                          <div class="modal fade" style="color: black;" id="stock<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Resend</h4></center>
            </div>
            <div class="modal-body" style="padding: 50px;">	
            	<form method="post" enctype="multipart/form-data" action="resend.php">            		
            		<input type="hidden" name="id" value="<?php echo  $row['id'];?>" class="form-control" >                  
                     <input type="text" name="name" value="<?php echo  $row['name'];?>" class="form-control" ><br/>

                     <label>Date of birth</label><br/>
                     <input type="date" name="dob" class="form-control" value="<?php echo  $row['dob'];?>" ><br/>
					 <label>Gender</label><br/>
            		 <SELECT name="gender" class="form-control" >
                 <option value="<?php echo  $row['gender'];?>"><?php echo  $row['gender'];?></option>
                        <option value="Male" >Male</option>
                        <option value="Female" >Female</option>
                      </SELECT><br/>
                    <label>Address</label><br/>
            		<input type="type" name="address" value="<?php echo  $row['address'];?>" class="form-control" >
					<br/>
					<label>Contact</label><br/>
            		<input type="text" name="contact" value="<?php echo  $row['contact'];?>" class="form-control" >
					<br/>
                    <label>Ministry</label>
                      <SELECT name="ministry" class="form-control" >
                      <option value="<?php echo  $row['ministry'];?>"><?php echo  $row['ministry'];?></option>
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
                      <SELECT name="membership" class="form-control" value="<?php echo  $row['membership'];?>" >
                      <option value="<?php echo  $row['membership'];?>"><?php echo  $row['membership'];?></option>
                        <option value="staff" >Staff</option>
                        <option value="leader" >Leader</option>
                        <option value="member" >Member</option>
                      </SELECT>
                    <br/>
                      <label>Leader</label>
                      <SELECT name="leader" class="form-control" value="<?php echo  $row['leader'];?>" >
                      <option value="<?php echo  $row['leader'];?>"><?php echo  $row['leader'];?></option>
                        <option value="">none</option>
                        <option value="a.chairperson" >Chair person</option>
                        <option value="b.vice" >Vice Chair Person</option>
                        <option value="c.treasurer" >Treasurer</option>
                        <option value="d.cordinator" >Cordinator</option>
                        <option value="e.events" >Events</option>
                      </SELECT>
                    <br/>
                      <label>Background</label>
                      <textarea type="text" name="background" class="form-control" placeholder="enter where the person came from" >
                      <?php echo  $row['background'];?>
                      </textarea>
                   <br/>
                      <img src="<?php echo $upload_dir.$row['image'] ?>" height="200">
                      <input type="file" class="form-control" name="image" required="required"> 
                         
				
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="resend" class="btn btn-primary">Resend</button>
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

$(document).ready(function(){
	//inialize datatable
    $('#myTable1').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});

$(document).ready(function(){
	//inialize datatable
    $('#myTable2').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});


$(document).ready(function(){
	//inialize datatable
    $('#myTable3').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});



$(document).ready(function(){
	//inialize datatable
    $('#myTable4').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});


$(document).ready(function(){
	//inialize datatable
    $('#myTable5').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});


$(document).ready(function(){
	//inialize datatable
    $('#myTable6').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});


$(document).ready(function(){
	//inialize datatable
    $('#myTable7').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});


$(document).ready(function(){
	//inialize datatable
    $('#myTable8').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});


$(document).ready(function(){
	//inialize datatable
    $('#myTable9').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});

$(document).ready(function(){
	//inialize datatable
    $('#myTable10').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});

$(document).ready(function(){
	//inialize datatable
    $('#myTable11').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});


$(document).ready(function(){
	//inialize datatable
    $('#myTable12').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});


$(document).ready(function(){
	//inialize datatable
    $('#myTable13').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});


$(document).ready(function(){
	//inialize datatable
    $('#myTable14').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});

$(document).ready(function(){
	//inialize datatable
    $('#myTable15').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});


</script>
</body>

</html>