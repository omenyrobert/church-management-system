<?php

include_once('connection.php');

  
  if(isset($_POST['sermon'])){
  $serm = $_POST['serm'];

  //image upload
    $insert_data = "INSERT INTO report (report) VALUES ('$serm')";
    $run_data = mysqli_query($conn,$insert_data);

    if($run_data){
        echo "<script>alert('information saved successfully')</script>";
            echo "<script>window.location='report.php'</script>";
    }else{
      echo "<script>alert('information not saved successfully')</script>";
   echo "<script>window.location='report.php'</script>";
}
}





?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>my manager</title>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="datatable/dataTable.bootstrap.min.css">
        <script src="js/custom.js"></script>

                <script type="text/javascript">
            new WOW().init();
        </script>

    </head>
    <body id="top">

        <!-- start preloader -->
        <!-- end preloader -->

        <!-- start header -->
        <!-- end header -->

        <!-- start navigation -->
                       
        <!-- end navigation -->

        <!-- start home -->
        <!-- end home -->

<div class="container-fluid" style="background-color: white; color: black;">
    <div  style="background-color: black; height: 300px;" class="container-fluid">
   <div class="container" style="padding: 20px; ">
<img src="logo.png" width="50%" >
    <h3 style="margin-top: -50px; color: white;" >CHURCH MANAGEMENT SYSTEM</h3></div>
</center>
  <h4 style="color: white;">CHURCH'S GENERAL REPORTS</h4>
  <br/><br/><br/><br/>
  <a href="dashboard.php">back</a>
</div>
         <div class="container">
        
                     <form class="container" action=""  method="post" enctype="multipart/form-data">
                        <h1>Add Sermon</h1>
                    <div class="form-group">
                      <label for="image">Sermon</label>
                      <textarea type="text" name="serm" class="form-control" style="width: 100%; height: 500px;" ></textarea>
                    </div>                      
                    <div class="form-group">
                      <button type="submit" name="sermon" class="btn btn-primary waves">Submit</button>
                    </div>
                </form>
                         


                </div>
                 <?php
                            $sql = "select * from report";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)){
                              while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <div class="row" >
                            <div class="col-md-12">
                            <textarea readonly="readonly" style="width: 100%; font-size: 20px; height: 500px; border: none; background-color: white;" ><?php echo $row['report'] ?></textarea>
                            <td class="text-center">
                              <a href="deletereport.php?id=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i>Del</a>
                            </td>
                          </div>
                          <?php
                              }
                            }
                          ?>
                        </div>
                        
                      </div>
            </div>
        </div>
      </div>


                    </div>


        
    </div>
    
</div>
        <!-- start contact -->
        <!-- end copyright -->

    </body>
</html>