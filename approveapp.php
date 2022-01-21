<?php
 	require_once'connection.php';

    
            
	//offertory and giving
	if(ISSET($_POST['edit'])){
		$staff = $_POST['staff'];
		$person = $_POST['person'];
		$about = $_POST['about'];
		$ddate = $_POST['ddate'];
		$ttime = $_POST['ttime'];
		$contact = $_POST['contact'];

$sql = "INSERT INTO appointments (staff, person, about, ddate,ttime,contact) VALUES ('$staff', '$person', '$about', '$ddate','$ttime','$contact')";
 
		$conn->query($sql);
		 header("location: approve.php");
            exit;
	} else
	{
		echo "";
	}