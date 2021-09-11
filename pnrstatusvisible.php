<html>
<style>
h1{
	text-align:center;
    color:white;
	padding:3px;
    background-color:darkblue;
}
h2{
	color:white;
	padding:3px;
	background-color:#0074D9;
}
th{
	border:1px solid #0074D9;
}
td{
	padding:5px;
    width:18%;
    height:3%;
}
 body
  { background-image:url(backgroundlogin.jpg);   
    padding: 10px;
    background-repeat: no-repeat;
    background-size: 1300px 900px;
    background-position:center;  
  }
</style>

<?php
$server='localhost';
$username='root';
$password='';
$db='onlineticket';
$connect=mysqli_connect($server,$username,$password,$db);
if(isset($_POST['pnr']))
{  $trainno="";
   $trainname="";
   $date="";
   $class="";
   $from="";
   $to="";
   $departuretime="";
   $arrivaltime="";
   $bookedby="";	
   $mobile="";
   $pnr=$_POST['pnr'];
   $sql="select * from bookingtable where pnr='".trim($pnr)."'";
   $result=mysqli_query($connect,$sql);
   if(mysqli_num_rows($result)>0)
   { echo "<h1>PNR Status</h1>";
     echo "<h2>Booking Ticket History</h2>";
     echo "<p>";
    $transactionid=rand(100000553505413,120000000000000);	
    while($row=mysqli_fetch_assoc($result))
    {	$trainno=$row['trainnumber'];
		$trainname=$row['trainname'];
	    $date=$row['date'];
		$class=$row['class'];
		$from=$row['trainfrom'];
		$to=$row['trainto'];
		$departuretime=$row['departuretime'];
		$arrivaltime=$row['arrivaltime'];
		$bookedby=$row['bookedby'];	
		$mobile=$row['contact'];
	}
	echo "<table><tr><td><b>Transaction ID</b></td><td><a>".$transactionid."</a></td>
	      <td><b>PNR No</b></td><td><a>".$pnr."</a></td></tr>
	      <tr><td><b>Train NO</b></td><td><a>".$trainno."</a></td>
		  <td><b>Train Name</b></td><td><a>".$trainname."</a></td></tr>
		  <tr><td><b>Date of Journey</b></td><td><a>".$date."</a></td>
		  <td><b>Class</b></td><td><a>".$class."</a></td></tr>
		  <tr><td><b>From</b></td><td><a>".$from."</a></td>
		  <td><b>To</b></td><td><a>".$to."</a></td></tr>
		  <tr><td><b>Departure Time</b></td><td><a>".$departuretime."</a></td>
		  <td><b>Arrival Time</b></td><td><a><a>".$arrivaltime."</a></td></tr>
		  <tr><td><b>Booked by</b></td><td><a>".$bookedby."</a></td>
		  <td><b>Mobile No</b></td><td><a>".$mobile."</a></td></tr>
		  </table>
		  <h2>Passenger Details</h2>";
    $sql1="select * from bookingtable where pnr='".trim($pnr)."'";        
    $result1=mysqli_query($connect,$sql1);
    echo "<table style=\"border-collapse:collapse\">
		  <tr><th><b>SI No</b></th><th><b>Name</b></th><th><b>Age</b></th>
		  <th><b>Gender</b></th><th><b>Seat No</b></th><th><b>Status</b></th></tr>";
	$sino=1;	  
	while($row=mysqli_fetch_assoc($result1))
    {   $name=$row['name'];
		$age=$row['age'];
		$gender=$row['gender'];
		$seatno=$row['seats'];
		$status=$row['status'];
		if(strcmp($status,"1")==0)
         { $status="Confirmed";
         }
        else if (strcmp($status,"0")==0)
        { $status="Waiting";
        }
        else if (strcmp($status,"00")==0)
         { $status="Cancelled";	
         }	    
    echo  "<tr>
	      <td style=\"border:1px solid #0074D9\"><a>".$sino."</a></td>
		  <td style=\"border:1px solid #0074D9\"><a>".$name."</a></td>
		  <td style=\"border:1px solid #0074D9\"><a>".$age."</a></td>
		  <td style=\"border:1px solid #0074D9\"><a>".$gender."</a></td>
		  <td style=\"border:1px solid #0074D9\"><a>".$seatno."</a></td>
		  <td style=\"border:1px solid #0074D9\"><a>".$status."</a></td></tr>";	
		  $sino++;
    }
	echo "<table>";
   }
   else
   { echo '<script>alert("Invalid PNR number")</script>'; 
   } 

}

?> 
</p> 
</html> 