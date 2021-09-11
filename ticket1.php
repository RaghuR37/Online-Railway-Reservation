<html>
<title>Ticket</title>
<style>
body { 
  background-repeat: no-repeat, repeat;
  background-image: url("railway.png");
  background-position: center;  
}
h2{
    text-align:center;
}
table
{
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;  
}
td,th 
{
  border: 1px solid black;
  padding: 5px;
}
th 
{
  font-weight: bold;	
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
}
button{
    margin-left:45%;
	margin-top:6%;
	text-align:center;
    color:white;
    background-color:#0074D9;
	font-size:15;
    font-family:serif;
    border-radius:10px;
    height:15%;
    width:15%
}	
</style>
<body>
<p>
<img src="http://localhost/onlineticket/railwayslogo.jpg" style="float:left;margin-left:4%;height:30%;width:12%">
<img src="http://localhost/onlineticket/irctc.png" style="float:right;margin-right:6%;height:15%;width:7%">
<h2 style="margin-top:3%">IRCTCs e-Ticketing Service</h2>
<h2>Electronic Reservation Form(Personal User)</h2>
</p>

<?php
session_start();

$server='localhost';
$username='root';
$password='';
$db='onlineticket';
$connect=mysqli_connect($server,$username,$password,$db);
   $pnr=$_SESSION["pnr"];
   //$pnr='3789468048';
   $sql="select * from bookingtable where pnr='".$pnr."'";
   $result=mysqli_query($connect,$sql);
   if($result)
   { $transactionid=rand(100000553505413,120000000000000);	   
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
	echo "<table style=\"margin-top:8%\"><tr><td><b>Transaction ID</b></td><td><a>".$transactionid."</a></td>
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
		  <td><b>Passenger Mobile No</b></td><td><a>".$mobile."</a></td></tr>
		  </table>
		  <h3>Fare Details</h3>
		  <div id=\"myDIV\"></div>";
	$totalfare = $_SESSION['fare'];	
    //$totalfare ='900';
	$fare=$totalfare-25;
    echo "<table>
		  <tr><th><b>SI No</b></th><th><b>Description</b></th><th><b>Amount(in rupees)</b></th>
		  <th><b>Amount(in words)</b></th></tr>
		  <tr>
	      <td><a>1</a></td>
		  <td><a>Ticket fare</a></td>
		  <td><a>Rs.".$fare.".0</a></td>
		  <td><a>".numberTowords("$fare")."</a></td></tr>
		  <tr>
	      <td><a>1</a></td>
		  <td><a>IRCTC service charge</a></td>
		  <td><a>Rs.25.0</a></td>
		  <td><a>".numberTowords("25")."</a></td></tr>
		  <tr>
	      <td><a>1</a></td>
		  <td><a>Total fare</a></td>
		  <td><a>Rs.".$totalfare.".0</a></td>
		  <td><a>".numberTowords("$totalfare")."</a></td></tr>
		  </table>
		  <h3>Passenger Details</h3>";	
    $sql1="select * from bookingtable where pnr='".$pnr."'";
    $result1=mysqli_query($connect,$sql1);
    echo "<table>
		  <tr><th><b>SI No</b></th><th><b>Name</b></th><th><b>Age</b></th>
		  <th><b>Gender</b></th><th><b>Seat No</b></th><th><b>Status</b></th></tr>";
	$sino=1;	  
	while($row=mysqli_fetch_assoc($result1))
    {
		$name=$row['name'];
		$age=$row['age'];
		$gender=$row['gender'];
		$seatno=$row['seats'];
		$status=$row['status'];
		if($status==0)
	    {
		   $status='WAITING';
	    }
	    else
	    {
		   $status='CONFIRMED';
	    }	    	
    echo  "<tr>
	      <td><a>".$sino."</a></td>
		  <td><a>".$name."</a></td>
		  <td><a>".$age."</a></td>
		  <td><a>".$gender."</a></td>
		  <td><a>".$seatno."</a></td>
		  <td><a>".$status."</a></td></tr>";	
		  $sino++;
    }
	echo "<table>";
    }
    else
    {
	    echo"failure";
    }
function numberTowords($num)
{	
$ones = array(
0 =>"ZERO",
1 => "ONE",
2 => "TWO",
3 => "THREE",
4 => "FOUR",
5 => "FIVE",
6 => "SIX",
7 => "SEVEN",
8 => "EIGHT",
9 => "NINE",
10 => "TEN",
11 => "ELEVEN",
12 => "TWELVE",
13 => "THIRTEEN",
14 => "FOURTEEN",
15 => "FIFTEEN",
16 => "SIXTEEN",
17 => "SEVENTEEN",
18 => "EIGHTEEN",
19 => "NINETEEN",
"014" => "FOURTEEN"
);
$tens = array( 
0 => "ZERO",
1 => "TEN",
2 => "TWENTY",
3 => "THIRTY", 
4 => "FORTY", 
5 => "FIFTY", 
6 => "SIXTY", 
7 => "SEVENTY", 
8 => "EIGHTY", 
9 => "NINETY" 
); 
$hundreds = array( 
"HUNDRED", 
"THOUSAND", 
"MILLION", 
"BILLION", 
"TRILLION", 
"QUARDRILLION" 
); /*limit t quadrillion */
$num = number_format($num,2,".",","); 
$num_arr = explode(".",$num); 
$wholenum = $num_arr[0]; 
$decnum = $num_arr[1]; 
$whole_arr = array_reverse(explode(",",$wholenum)); 
krsort($whole_arr,1); 
$rettxt=""; 
foreach($whole_arr as $key => $i){	
while(substr($i,0,1)=="0")
		$i=substr($i,1,5);
if($i < 20)
{ $rettxt .= $ones[$i]; 
}
elseif($i < 100)
{ if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
  if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
}
else
{ if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
  if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
  if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 
} 
if($key > 0){ 
$rettxt .= " ".$hundreds[$key]." "; 
}
} 
if($decnum > 0){
$rettxt .= " and ";
if($decnum < 20){
$rettxt .= $ones[$decnum];
}elseif($decnum < 100){
$rettxt .= $tens[substr($decnum,0,1)];
$rettxt .= " ".$ones[substr($decnum,1,1)];
}
}
return $rettxt;
}   
?> 
</body>
<table border="0">
<tr><td><button onclick="window.print()">Print</button></td>
<td><a style="margin-left:45%;
	margin-top:6%;
    color:white;
    background-color:#0074D9;
    border: solid black;
	font-size:15;
    font-family:serif;
    border-radius:5px;
    text-decoration:none;
    height:25%;
    width:45%"  href="http://localhost/OnlineTicket/ticketsuccess.html">EXIT</a></td></tr>
</table>
</html>
