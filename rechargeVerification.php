<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body, html {
  height: 100%;
  margin: 0;
}

.bg 
{ background-image: url('http://localhost/onlineticket/train2.jpg');
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
		 <a href='http://localhost/onlineticket/passengerinfoadmin.php'>Passenger info</a> 		
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
</style>
</head>";
$con=mysqli_connect("localhost","root","","onlineticket");
if($con)
{ $bool=0;
$sql="select * from rechargetable where status=0";
$result=mysqli_query($con,$sql);
echo "<form method='post' action='rechargeUpdate.php'>";
if(mysqli_num_rows($result)>0)
{ echo "<table border=1 cellpadding=1 cellspacing=1><tr><th>MOBILE NUMBER</th><th>TRANSACTION ID</th><th>AMOUNT</th><th>VERIFIED</th></tr>";	
while($rs=mysqli_fetch_assoc($result))
{
$mobilenumber=$rs["mobilenumber"];
$transactionID=$rs["transactionID"];
$amount=$rs["amount"];
echo "<tr><td><input type='text' name='mobilenumber[]' value={$mobilenumber}></td><td>{$transactionID}</td><td><input type='text' name='amount[]' value={$amount}></td><td><select name='verified[]'><option value=0>NO</option><option value=1>YES</option></select></td></tr>";
$bool=1;
}
}
echo"<tr><td colspan=6>";
if($bool)
{
echo"<input style='background-color:black;color:#D2B48C' type='submit' value='OK'>";
}
echo"</td></tr></table></form>";
}
if($bool==0)
{
echo "<p style='margin-top:0%;font-size:35;font-family:serif;color:#A0522D;text-align:center'><br><br>NO RECORDS FOUND</p>";	

}
echo"</div>";
?>