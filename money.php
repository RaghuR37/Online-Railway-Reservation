<html>
<style>
div.form{
	position:absolute;
	margin-top:3%;
	margin-left:28%;
	margin-right:25%;
	padding:50px;
	border:3px solid #0074D9;
	border-radius:25px;
	height:70%;
	width:30%;
}
label
{    font-size: 20px;
     font-family:Roman;
     color:darkblue;
}
  body
  { background-image:url(moneybackground.jpg);   
    padding: 10px;
  background-repeat: no-repeat;
  background-size: 1300px 900px;
 background-position:center;  
  }
button{
    margin-left:40%;
	margin-top:5%;
	text-align:center;
    color:white;
    background-color:#0074D9;font-size:15;
    font-family:serif;
    border-radius:10px;
    height:10%;
    width:25%
}
</style>
<form action="" method="POST">
<div class="form">
<a style="margin-left:20%;font-size:26;color:darkblue">Add money/Check Balance</a><br>
<br>
<img src="http://localhost/onlineticket/qr.png" style="margin-left:35%;height:30%;width:30%"><br>
<br>
<?php
 session_start();
 $mobile=$_SESSION["mobilenumber"];
 $server='localhost';
$username='root';
$password='';
$db='onlineticket';
 $con=mysqli_connect($server,$username,$password,$db);
 $sql1="select * from signuptable where mobilenumber='".trim($mobile)."'";
 $result1=mysqli_query($con,$sql1);
  $amount="";
  if(mysqli_num_rows($result1)==1)
  { while($row=mysqli_fetch_assoc($result1))
       { $amount=$row['amount'];
         break;
       } 
  }    
  echo "<label>Available Balance: ".($amount)."<label>";
?>

<table>
<tr>
<td><label>Mobile no</label></td>
<td><input type="text" name="mobile"  placeholder="Enter Mobile number"pattern="[1-9]{1}[0-9]{9}"required /></td>
</tr>
<br>
<tr>
<td><label>Enter Amount</label></td>
<td><input type="text" name="amount" placeholder="Enter Amount"required /></td>
</tr>
<br>
<tr>
<td><label>Password</label></td>
<td><input type="password" name="password"placeholder="Password"required /></td>
</tr>

<tr>
<td><label>Enter Transaction ID</label></td>
<td><input type="text" name="transid"placeholder="Enter Transaction ID" required /></td>
</tr>

</table>
<button type="submit" name="submit" >Recharge</button>
</form>
</html>
<?php
$server='localhost';
$username='root';
$password='';
$db='onlineticket';
$connect=mysqli_connect($server,$username,$password,$db);
if(isset($_POST['submit']))
{  $mobile=$_POST['mobile'];
	$amount=$_POST['amount'];
	$password=$_POST['password'];
	$transaction=$_POST['transid'];
	$sql="select * from signuptable where password='".trim(md5($password))."' and mobilenumber='".trim($mobile)."'";	
	$result=mysqli_query($connect,$sql);
	if(mysqli_num_rows($result)==1)
	{
		$sql1="insert into rechargetable values('$mobile','$transaction','$amount','0')";
		$result1=mysqli_query($connect,$sql1);
		header("Location:rechargesuccess.html");
		exit();
	}	
	else
	{
		echo "<br><br><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspIncorrect Mobile Number or password</b>";
		exit();
	}			
}
?>