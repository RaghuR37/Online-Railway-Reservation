<?php
session_start();
if (isset($_POST["submit"])) {
	$_SESSION["from"]=$_POST['location'];
	$_SESSION["to"]=$_POST['destination'];
	$_SESSION["depart-date"]=$_POST['depart-date'];
	$_SESSION["inserted"]='0';	
	header("Location:Trains.php");
}
else{
	echo "Failed <a href='./booking.php'>Retry</a>";
}
?>