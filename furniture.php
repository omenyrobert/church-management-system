<?php
	      session_start();

  require_once'connection.php';

  if (!isset($_SESSION['ID'])) {
  header("Location:index.php");
  exit();
}

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

  	$insert_data = "INSERT INTO furniture (item,det,qty,con,image) VALUES ('$item','$det','$qty','$con','$image')";
  	$run_data = mysqli_query($conn,$insert_data);

  	if($run_data){
  			echo "<script>alert('information saved successfully')</script>";
          	echo "<script>window.location='furniture.php'</script>";
  	}else{
 			echo "<script>alert('information not saved successfully')</script>";
	 echo "<script>window.location='furniture.php'</script>";
}
}







	//delete other

	

?>






<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Account</title>
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
<div  style="background-color: black; height: 250px;">
   <div class="container" style="padding: 20px; ">
<img src="logo.png" width="50%" >
    <h3 style="margin-top: -50px; color: white;" >CHURCH MANAGEMENT SYSTEM</h3></div>
</center>
  <h4 style="color: white;" >Furniture</h4>
  <br/><br/><br/><br/>
</div><br/><br/>
<div class="row" style=" width: 100%;">

<div class="col-sm-9" style="display: flex;">
</div>
</div>

 <form class="form-horizontal span6" action="" method="POST" enctype="multipart/form-data"    >
 <div class="row">
         <div class="col-lg-12">
            <h1 class="page-header">Add Item</h1>
          </div>
          <!-- /.col-lg-12 -->
       </div> 

              <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" >Item</label>

                      <div class="col-md-8">
                            <input class="form-control input-sm" id="item" name="item"  type="text" value="">
                      </div>
                    </div>
                  </div>  

              

                 <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "PRODESC">Details:</label>

                      <div class="col-md-8"> 
                      <textarea class="form-control input-sm" id="det" name="det" cols="1" rows="3" ></textarea>
                      </div>
                    </div>
                  </div>

          
                   <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "PROQTY">Quantity:</label>

                      <div class="col-md-8">
                         <input class="form-control input-sm" id="qty" name="qty" placeholder=
                            "Quantity" type="number" value="">
                      </div>
                       
                    </div>
                  </div>

                  
                    <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "PROQTY">Condition:</label>

                      <div class="col-md-8">
                       <select name="con" class="form-control" >
                         <option>Good</option>
                         <option>Bad</option>
                         <option>Needed</option>
                       </select>
                      </div>
                       
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4" align = "right"for=
                      "image">Upload Image:</label>

                      <div class="col-md-8">
                      <input type="file" class="cck" name="image"  accept="image/*">
                      </div>
                    </div>
                  </div>
            
             <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "idno"></label>

                      <div class="col-md-8">
                        <button class="btn  btn-primary btn-sm" name="btnsave" type="submit" ><span class="fa fa-save fw-fa"></span> Save</button>
                      </div>
                    </div>
                  </div>

               
        <div class="form-group">
                <div class="rows">
                  <div class="col-md-6">
                    <label class="col-md-6 control-label" for=
                    "otherperson"></label>

                    <div class="col-md-6">
                   
                    </div>
                  </div>

                  <div class="col-md-6" align="right">
                   

                   </div>
                  
              </div>
              </div>
          
        </form>

			<table id="myTable" class="table table-bordered " style="background-color: #3a425a; width: 100%;">
				<thead>
					<tr>
						<th>item</th>
						<th>detials</th>
						<th>qty</th>
            <th>Condition</th>
						<th>image</th>
						<td>Action</td>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');




   $query=$conn->query("SELECT * FROM `furniture`") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc())
   {
      ?>
        <tr>
	   		<td><?php echo  $fetch['item'];?></td>
	   		<td><?php echo $fetch['det'];?></td>
	   		<td><?php echo $fetch['qty'];?></td>
        <td><?php echo $fetch['con'];?></td>
	   		<td><img src="uploads/<?php echo $fetch['image']; ?>" width="100" /></td>
	   		<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#form_modal<?php echo $fetch['id'];?>"><span class="glyphicon glyphicon-edit"></span> Edit</button> 
	   		 |<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_<?php echo $fetch['id']; ?>">Delete</button></td>				
	   	</tr>



<div class="modal fade" style="color: black;" id="delete_<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Delete Record</h4></center>
            </div>
            <div class="modal-body">	
            	<p class="text-center">Are you sure you want to Delete</p>
				<h3 class="text-center">Item&nbsp;&nbsp;<?php echo $fetch['item'].'<br/><br/>Quantity '.$fetch['qty'].'<br/><br/>details '.$fetch['det']; ?></h3>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="deletefrn.php?id=<?php echo $fetch['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>




<div class="modal fade" id="form_modal<?php echo $fetch['id'];?>" style="color: black;" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<form method="POST" action="editfurn.php?id=$id" >
											<div class="modal-header">
												<h3 class="modal-title">Edit and Update</h3>
											</div>
											<div class="modal-body">
												<div class="col-md-2"></div>
												<div class="col-md-8">
													<div class="form-group">
														<label>Item</label>
														<input type="hidden" name="id" value="<?php echo $fetch['id']?>"/>
														<input type="text" class="form-control" name="item" value="<?php echo $fetch['item'];?>" required="required"/>
													</div>
													<div class="form-group">
														<label>Details</label>
														<input type="text" class="form-control" name="det" value="<?php echo $fetch['det']?>" required="required"/>
													</div>
                                                    
                          <div class="form-group">
														<label>Quantity</label>
														<input type="text" class="form-control" name="qty" value="<?php echo $fetch['qty']?>" required="required"/>
													</div>
                                 
                      <div class="form-group">
                      <label class="col-md-4 control-label" for=
                      "PROQTY">Condition:</label>

                       <select name="con" value="<?php echo $fetch['con']?>" class="form-control" >
                         <option>Good</option>
                         <option>Bad</option>
                         <option>Needed</option>
                       </select>
                  </div>                     
                                                      

												</div>	
											</div>
											<div style="clear:both;"></div>
											<div class="modal-footer">
												<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-trash"></span> Close</button>
												<button class="btn btn-warning" name="update"><span class="glyphicon glyphicon-save"></span> Update</button>
											</div>
										</form>
									</div>
								</div>
							</div>





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