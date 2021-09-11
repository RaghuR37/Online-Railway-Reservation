<?php
session_start();
$con=mysqli_connect("localhost","root","","onlineticket");
$Mobile=$_POST["mobile"];
$Password=$_POST["password"];
$que="select * from signuptable";
$res=mysqli_query($con,$que);
while($rs=mysqli_fetch_assoc($res))
{
$name=$rs["name"];
$mob=$rs["mobilenumber"];
$pas=$rs["password"];
if($mob==$Mobile && $pas==md5($Password))
{	$_SESSION["mobilenumber"]=$mob;
	header("Location: http://localhost/OnlineTicket/Booking.php");
	break;
}
else
{ echo '<script>alert("Incorrect mobilenumber or password")</script>'; 
}
}
?>