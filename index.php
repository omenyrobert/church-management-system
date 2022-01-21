<?php
     session_start();
   // if (isset($_SESSION['ID'])) {
   //   header("Location:dashboard.php");
   //  exit();
    //}
  // Include database connectivity
    
  include_once('connection.php');
  
  if (isset($_POST['submit'])) {

      $errorMsg = "";

      $username = $conn->real_escape_string($_POST['username']);
      $password = $conn->real_escape_string(md5($_POST['password']));
      
  if (!empty($username) || !empty($password)) {
        $query  = "SELECT * FROM admins WHERE username = '$username'";
        $result = $conn->query($query);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $_SESSION['ID'] = $row['id'];
            $_SESSION['ROLE'] = $row['role'];
            $_SESSION['username'] = $row['role'];
            $_SESSION['NAME'] = $row['name'];
          }
            if ($_SESSION['ROLE'] == 'admin'){
              header("Location:dashboard.php");
              die(); 
            }

           if ($_POST['username'] == 'database'){
              header("Location:database.php");
              die(); 
            }
            
           if ($_POST['username'] == 'finance'){
              header("Location:addincome.php");
              die(); 
            }
            
             if ($_POST['username'] == 'Schedules'){
              header("Location: schedules.php");
              die(); 
            }
            
             if ($_POST['username'] == 'furniture'){
              header("Location: furniture.php");
              die(); 
            }

             if ($_POST['username'] == 'kitchen'){
              header("Location: kitchen.php");
              die(); 
            }
            
            if ($_POST['username'] == 'office'){
              header("Location: office.php");
              die(); 
            }


           if ($_POST['username'] == 'income'){
              header("Location:income.php");
              die(); 
            }

            if ($_POST['username'] == 'music'){
              header("Location:music.php");
              die();            
                                         
        }else{
          $errorMsg = "No user found on this username";
        } 
    }else{
      $errorMsg = "Username and Password is required";
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Multi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>
<body style="background: url('church.jpg') no-repeat;
        background-size: 100%; color: white;

         background-position: center; background-color: white; height: 100vh; font-family: Poppins;
       ">


<div class="container">
  <div class="row" style="margin-top: 70px;">
    <div class="col-md-5">
    <?php if (isset($errorMsg)) { ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $errorMsg; ?>
          </div>
        <?php } ?>
    <div class="container" style=" background-color: #075286; border-radius: 15px; padding: 50px;
       " >
  <h1 style="font-size: 46px; font-weight: bold;">Login </h1>
  <br/>
        <form action="" method="POST">
          <div class="form-group">  
            <p>Username:</p> 
            <input type="text" style="border-bottom: 2px solid #fff; width: 250px;" class="form-control" name="username" placeholder="Enter Username" >
          </div>
          <div class="form-group">  
            <label for="password">Password:</label> 
            <input type="password" style="border-bottom: 2px solid #fff; width: 250px;" class="form-control" name="password" placeholder="Enter Password">
          </div>
          <div class="form-group">
            <br/>
            <input type="submit" style="background-color: black; border-radius: 50px; width: 250px;" name="submit" class="btn btn-dark" value="Login"> 
          </div>
        </form>
    </div>

    </div>
      <div class="col-md-7">
      <h1 style="font-size: 46px; font-weight: bold;" >Church Management system </h1>
 
      </div>
  </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</body>
</html>

