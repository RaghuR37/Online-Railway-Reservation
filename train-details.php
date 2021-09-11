<?php
session_start();
	if(isset($_POST['submit']))
	{   print_r($_SESSION);
		$departdate=$_SESSION["depart-date"];
		$_SESSION["passenger-count"]=$_POST["count"];
		$_SESSION["train-no"]=$_POST["trainno"];
		$_SESSION["train-name"]=$_POST["trainname"];
		$_SESSION["departure"]=$_POST["departuretime"];
		$_SESSION["arrival"]=$_POST["arrivaltime"];
		$_SESSION["trainfrom"]=$_POST["trainfrom"];
		$_SESSION["trainto"]=$_POST["trainto"];
		$_SESSION["coach"]=strtolower($_POST["class"]);
	$con=mysqli_connect("localhost","root","","onlineticket");
	if ($con) 
	{   $query="SELECT ".$_SESSION["coach"]." FROM trainstable WHERE trainno='".$_SESSION["train-no"]."' AND       trainname='".$_SESSION["train-name"]."' AND trainfrom='".$_SESSION["trainfrom"]."' AND trainto='".$_SESSION["trainto"]."' AND departuretime='".$_SESSION["departure"]."' AND arrivaltime='".$_SESSION["arrival"]."'";		
		$result=mysqli_query($con,$query);        
		$dec=10;
		$_SESSION["seats"]="0";
		if (mysqli_num_rows($result)>0) 
		{  while ($row=mysqli_fetch_assoc($result)) 
		   {    if ((int)$row["".$_SESSION["coach"].""]>(int)$_SESSION["passenger-count"]) 
				{  $dec=(int)$row["".$_SESSION["coach"].""]-(int)$_SESSION["passenger-count"];
				   $_SESSION["status"]="1";
				}
				else
				{   $dec=(int)$row["".$_SESSION["coach"].""];
					$_SESSION["status"]="0";
				}
				$_SESSION["seats"]=(int)$row["".$_SESSION["coach"].""];
				break;
			}
		}
		else
		{ $_SESSION["status"]="0";
		}				
	}
	else
	{
		echo "Failed <a href='./booking.php'>Retry</a>";
	}		
	header("Location:passengerInfo.php");
	}
	else
	{ echo "Failed <a href='./booking.php'>Retry</a>";
	}
?>