
<?php

session_start();
// Include database connection file
include_once('connection.php');

if (!isset($_SESSION['ID'])) {
  header("Location:index.php");
  exit();
}

?>

<?php

  // Include database connection file

  include_once('connection.php');

  if (isset($_POST['submit'])) {
    
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string(md5($_POST['password']));
    $name     = $conn->real_escape_string($_POST['name']);
    $role     = $conn->real_escape_string($_POST['role']);

    $query  = "INSERT INTO pendingadmins (name,username,password,role) VALUES ('$name','$username','$password','$role')";
    $result = $conn->query($query);

    if ($result==true) {
      header("Location:index.php");
      die();
    }else{
      $errorMsg  = "You are not Registred..Please Try again";
    }   

  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Create Accounts</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <style type="text/css">
        .bod{
  background-color: #101b3c;
  color: white;
}
  </style>
</head>
<body class="bod">

<div  style="background-color: black; height: 250px;">
   <div class="container" style="padding: 20px; ">
<img src="logo.png" width="50%" >
    <h3 style="margin-top: -50px; color: white;" >CHURCH MANAGEMENT SYSTEM</h3></div>
</center>
  <h4 style="color: white;" >Create accounts</h4>
  <br/><br/><br/><br/>

<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
      <div class="col-md-6">      
        <?php if (isset($errorMsg)) { ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $errorMsg; ?>
          </div>
        <?php } ?>
        <h2>Create Accounts</h2>
        <form action="" method="POST">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" placeholder="Enter Name" required="">
          </div>
          <div class="form-group">  
            <label for="username">Username:</label>
             <select class="form-control" name="username" required="">
              <option value="">Select Username</option>
              <option value="admin">Admin</option>
              <option value="finance">finance</option>
              <option value="music">Music</option>
              <option value="furniture">Furniture</option>
              <option value="office">Office</option>
              <option value="kitchen">Kitchen</option>
              <option value="database">Database</option>
              <option value="Schedules">Schedules</option>
            </select>
          </div>
          <div class="form-group">  
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Enter Password" required="">
          </div>
          <div class="form-group">  
            <label for="role">Role:</label>
            <select class="form-control" name="role" required="">
              <option value="">Select Role</option>
              <option value="admin">Admin</option>
              <option value="finance">finance</option>
              <option value="music">Music</option>
              <option value="furniture">Furniture</option>
              <option value="office">Office</option>
              <option value="kitchen">Kitchen</option>
              <option value="database">Database</option>
              <option value="Schedules">Schedules</option>
            </select>
          </div>
          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary">
          </div>
        </form>
         <?php if($_SESSION['ROLE'] == 'admin'){ ?>
        <a href="accounts.php"> <h3>Manage Accounts</h3></a>
         <?php } ?>
         <br/>
         <br/>
      </div>


  </div>
</div>
</body>
</html>



