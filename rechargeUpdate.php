<html>
<head>
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
	<title>Recharge update</title>
	<link rel='stylesheet' type='text/css' href='style1.css'>
</head>
<body>

	<div class='header'>
		<a href='#'><img src='http://localhost/onlineticket/tlogo.png' height='50' width='50' /></a>
				<div class='header-one'>
		  <a href='http://localhost/onlineticket/rechargeVerification.php'>Verify Other Recharges</a>
		  <a href='http://localhost/onlineticket/passengerinfoadmin.php'>Passenger info</a>
        </div>
    </div>
</body>";
$con=mysqli_connect("localhost","root","","onlineticket");
if($con)
{
$mobilenumber=$_POST["mobilenumber"];
$amount=$_POST["amount"];
$verified=$_POST["verified"];
for($i=0;$i<count($mobilenumber);$i++)
{
$balance=0;	
$sql="select * from signuptable where mobilenumber={$mobilenumber[$i]}";
$result=mysqli_query($con,$sql);	
if(mysqli_num_rows($result)>0)	
{
while($rs=mysqli_fetch_assoc($result))
{
$balance=$rs["amount"];
$balance=(int)$balance+$amount[$i];
}
}	
if($verified[$i]==1){
$query="update signuptable set amount={$balance} where mobilenumber={$mobilenumber[$i]}";
mysqli_query($con,$query);
$query="update rechargetable set status={$verified[$i]} where mobilenumber={$mobilenumber[$i]}";
mysqli_query($con,$query);
}
}
echo "<p style='margin-top:0%;font-size:35;font-family:serif;color:#A0522D;text-align:center'><br><br>UPDATED</p>";
}
echo"</div>";
?>