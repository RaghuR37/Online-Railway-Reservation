<html>
<title>Pay and Proceed</title>
<style>
h1{
	text-align:center;
    color:white;
	padding:3px;
    background-color:darkblue;
}
h2,h3
{
	margin-left: 5%;
	margin-top: 2%;
	
}
hr
{
	margin-top: 2%;
	
}
#table
{
	height: 50%;
}
table
{
  font-family:serif;
  font-size:18;
  border-collapse: collapse;
  width: 100%;
  
}
body
  { background-image:url(backgroundlogin.jpg);   
    padding: 10px;
  background-repeat: no-repeat;
  background-size: 1300px 900px;
 background-position:center;  
  }
td,th 
{
  border: 1px solid #ddd;
  padding: 8px;
}

tr:nth-child(even)
{
	background-color: lightblue;
}
tr:nth-child(odd)
{
	background-color: lightblue;
}
tr:hover 
{
	background-color:lightblue;
}
th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #0074D9;
  color: white;
}
button{
    margin-left:45%;
	margin-top:3%;
	text-align:center;
    color:white;
    background-color:darkblue;
	font-size:20;
    font-family:serif;
    height:15%;
    width:20%
}
</style>
<h1>Pay And Proceed</h1>
<p id="table">
<?php
session_start();
$server='localhost';
$username='root';
$password='';
$db='onlineticket';
$connect=mysqli_connect($server,$username,$password,$db);
$pnr=$_SESSION["pnr"];
//print_r($_SESSION);
$sql="select * from bookingtable where pnr='".$pnr."'";
$result=mysqli_query($connect,$sql);
if($result){
	echo "<table style=\"border-collapse:collapse\">
		  <tr>
		  <th><b>SI No</b></th>
		  <th><b>Name</b></th>
		  <th><b>Age</b></th>
		  <th><b>Gender</b></th>
		  <th><b>Seat No</b></th>
		  </tr>";
	$i=0;	  
	$sino=1;	  
	while($row=mysqli_fetch_assoc($result))
    {
		$name=$row['name'];
		$age=$row['age'];
		$gender=$row['gender'];
		$seatno=$row['seats'];
		echo "<tr>
	          <td style=\"border:1px solid #0074D9\"><a>".$sino."</a></td>
		      <td style=\"border:1px solid #0074D9\"><a>".$name."</a></td>
		      <td style=\"border:1px solid #0074D9\"><a>".$age."</a></td>
		      <td style=\"border:1px solid #0074D9\"><a>".$gender."</a></td>
		      <td style=\"border:1px solid #0074D9\"><a>".$seatno."</a></td>
		      </tr>";	
		$sino++;
		$i++;
	}
	echo "<table>";
	//echo $pnr."dgeu";
	$class="";
    $from="";
    $to="";
    $departuretime="";
    $arrivaltime="";    
	$sql1="select * from bookingtable where pnr='".$pnr."'";
    $result1=mysqli_query($connect,$sql1);
    if($result1){
	    while($row=mysqli_fetch_assoc($result1))
        {   $class=$row['class'];
		    $from=$row['trainfrom'];
		    $to=$row['trainto'];
		    $departuretime=$row['departuretime'];
		    $arrivaltime=$row['arrivaltime'];
	    } 
	}
	else
	{ echo "fail";
    }
    $fare=0;
	$sql2="Select * from trainstable where trainfrom='".$from."' AND trainto='".$to."' 
	AND departuretime='".$departuretime."' AND arrivaltime='".$arrivaltime."' limit 1";
    $result2=mysqli_query($connect,$sql2);
	if($result2)
	{  while($row=mysqli_fetch_assoc($result2))
        { $fare=$row['ticketfare'];		    
	    } 
	}
	else
	{ echo "fail";
    }
	
	if(strtolower($class)=='seater'){
        $fare=$fare;		
	}
    if(strtolower($class)=='sleeper'){
        $fare=$fare+50;		
	}
    if(strtolower($class)=='ac 3tier'){
        $fare=$fare+100;		
	}
    if(strtolower($class)=='ac 2tier'){
        $fare=$fare+150;		
	}	
	if(strtolower($class)=='class1a'){
        $fare=$fare+200;		
	}
	echo "<h3>Ticket Fare: ".$fare."</h3>";
	$totalfare=$i*$fare;
    echo "<h3>No of tickets: ".$i."</h3>
          <h2>Total Fare: ".$totalfare."</h2>";
    $_SESSION['fare'] = $totalfare;	
}	
?> 
</p>
<form action="payment.php" method="POST">
<button type="submit" class="button">Pay & Proceed</button>
</form>
<hr>
</html>    	