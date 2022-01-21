<?php
  $conn = mysqli_connect("localhost","root","","churchsys");
  if(! $conn ) {
      die('Could not connect: ' . mysqli_error());
   }
?>