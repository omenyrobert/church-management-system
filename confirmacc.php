<?php

  // Include database connection file

  include_once('connection.php');

  if (isset($_POST['forward'])) {
    
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string(md5($_POST['password']));
    $name     = $conn->real_escape_string($_POST['name']);
    $role     = $conn->real_escape_string($_POST['role']);

    $query  = "INSERT INTO admins (name,username,password,role) VALUES ('$name','$username','$password','$role')";
    $result = $conn->query($query);

    if ($result==true) {
      header("Location:index.php");
      die();
    }else{
      $errorMsg  = "You are not Registred..Please Try again";
    }   

  }

?>