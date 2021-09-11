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
	<link rel='stylesheet' type='text/css' href='style1.css'>
</head>
<body>
	<div class='header'>
	
		<a href='#'><img src='http://localhost/onlineticket/tlogo.png' height='50' width='50' /></a>
		<div class='header-one'>
	<a href='http://localhost/onlineticket/tadmin.html'>Login</a> 
</div>
</div> 
</body>";
$userID=$_POST["userID"];
$password=$_POST["password"];
if($userID='admin' && $password=='admin@123')
{
header("location:http://localhost/onlineticket/tadmin.php");
}
else
{
echo "<p style='text-align:center;margin-top:0%;font-size:25;font-family:serif;color:#A0522D'><br><br>USER ID / PASSWORD INCORRECT</p>";	
}
echo"</div>";
?>