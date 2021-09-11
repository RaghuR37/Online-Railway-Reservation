<html>
<head>
<title>passengerinfoadmin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body, html {
  height: 100%;
  margin: 0;
}

.bg {
  
  background-image: url('http://localhost/onlineticket/train2.jpg');

 
  height: 100%; 

  
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
</head>
</html>

<?php
echo"<div class='bg'>";
echo"<head>
	
	<link rel='stylesheet' type='text/css' href='style1.css'>
</head>
<body>

	<div class='header'>
		<a href='#'><img src='http://localhost/onlineticket/tlogo.png' height='50' width='50' /></a>
		<div class='header-one'>
		  <a href='http://localhost/onlineticket/rechargeVerification.php'>Verify Recharges</a>
		  
        </div>
    </div>
	<style>

</style>
</body>";
echo"<head>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #D2B48C}
tr:nth-child(odd){background-color:#F5DEB3}
th {
  background-color:black;
  color: #D2B48C;
}
div.avatar{
margin-left:46%;
margin-top:2%;
}
div.username{
margin-top:-5%;
font-size:125;
font-family:serif;

}
div.password{
margin-top:0%;
font-size:25;
font-family:serif;
}

button{
text-align:center;
color:white;
background-color:#A0522D;
margin-left:76%;
margin-top:-4%;
font-size:15;
font-family:serif;
border-radius:10px;
height:4%;
width:7%;
}
</style>
</head>";
echo"




<form method='post' action='passengerinfoadmin.php'>

<div class='username'>
     <input type='text' placeholder='train number' name='trainnumber'  style='width:30%;height:5%;margin-left:12%;border-radius:4px;background-color:#D2B48C' required>
	 <input type='date' placeholder='date' name='date'  style='width:30%;height:5%;border-radius:4px;background-color:#D2B48C' required>
     
  </div>  
  <div class='login'>
	 <button type='submit' name='search'>Search</button>
  </div>
 

</form>";
$con=mysqli_connect("localhost","root","","onlineticket");
if(isset($_POST["search"])){
$trainnumber=$_POST["trainnumber"];
$date=$_POST["date"];
$sql="select * from bookingtable where trainnumber={$trainnumber} and date='{$date}'";
$result=mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0)
{
echo "<table border=1 cellpadding=1 cellspacing=1><tr><th>TRAIN NAME</th><th>PASSENGER NAME</th><th>PASSENGER AGE</th><th>PASSENGER GENDER</th><th>FROM</th><th>TO</th><th>CLASS</th><th>SEATS</th><th>STATUS</th></tr>";
while($rs=mysqli_fetch_assoc($result))
{
$trainname=$rs["trainname"];	
$name=$rs["name"];
$age=$rs["age"];
$gender=$rs["gender"];
$trainfrom=$rs["trainfrom"];
$trainto=$rs["trainto"];
$class=$rs["class"];
$seats=$rs["seats"];
$status=$rs["status"];
if(strcmp($status,"1")==0)
{ $status="Confirmed";
}
else if (strcmp($status,"0")==0)
{ $status="Waiting";
}
else if (strcmp($status,"00")==0)
{ $status="Cancelled";	
}	
echo "<tr><td>{$trainname}</td><td>{$name}</td><td>{$age}</td><td>{$gender}</td><td>{$trainfrom}</td><td>{$trainto}</td><td>{$class}</td><td>{$seats}</td><td>{$status}</td></tr>";
}
echo"</table>";
}
else{
echo "<p style='margin-top:0%;font-size:40;font-family:serif;color:#A0522D;text-align:center'><br><br>NO RECORDS FOUND</p>";	
}
}
echo"</div>";
?>	
