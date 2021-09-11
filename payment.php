<html>
<title>Payment</title>
<style>
div.form{
	margin-top:5%;
	margin-left:28%;
	margin-right:25%;
	padding:50px;
	border:3px solid #0074D9;
	border-radius:25px;
	height:60%;
	width:28%;
}
button{
    margin-left:24%;
	margin-top:7%;
	text-align:center;
    color:white;
    background-color:darkblue;
	font-size:15;
    font-family:serif;
    border-radius:10px;
    height:10%;
    width:30%
}
lable
{    font-size: 17px;
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

</style>
<form action="" method="POST">
<div class="form">
<a style="margin-left:29%;font-size:26;color:darkblue">Payment options</a><br>
<input type="radio" name="option" value="debitcard" style="margin-top:15%"/><b>Debit card</b><br><br>
<table>
<tr>
<td><lable>Enter your 16 digit card</lable></td>
<td><input type="text" name="cardno" placeholder="xxxx xxxx xxxx xxxx"/></td>
</tr>

<tr>
<td><lable>Valid through</lable></td>
<td><input type="text" name="validity" placeholder="MM/YY"/></td>
</tr>

<tr>
<td><lable>Enter CVV</lable></td>
<td><input type="text" name="cvv" placeholder="xxx"/></td>
</tr>
</table>
<br>
<input type="radio" name="option" value="payfromwallet" /><b>Pay from your wallet</b>
<br>
<br>
<?php
session_start();
//print_r($_SESSION);
$totalfare = $_SESSION['fare'];
echo "<b>Fare:Rs.".$totalfare."</b>";
?>
<br>
<button type="submit" style="margin-left:35%" class="button">Pay</button> 
<br>
<?php

$server='localhost';
$username='root';
$password='';
$db='onlineticket';
$connect=mysqli_connect($server,$username,$password,$db);

if(isset($_POST['option']))
{
	if($_POST['option']=='payfromwallet')
	{
        $mobile=$_SESSION["mobilenumber"];
	    $sql="select * from signuptable where mobilenumber='".$mobile."'";
	    $result=mysqli_query($connect,$sql);
	     if(mysqli_num_rows($result)==1)
	    {
		    $sql1="select amount from signuptable where mobilenumber='".$mobile."'";
			$result1=mysqli_query($connect,$sql1);
			$totalfare = $_SESSION['fare'];
			while($row=mysqli_fetch_assoc($result1))
            {
		        $amount=$row['amount'];  
	        } 
		    $updateamount=$amount-$totalfare;
		    if($updateamount>0)
		    {			
		        $sql2="UPDATE `signuptable` SET `amount`='".$updateamount."' where mobilenumber='".$mobile."'";
		        $result2=mysqli_query($connect,$sql2);

		        $pnr = $_SESSION['pnr'];
		        $sql3="UPDATE `bookingtable` SET `paystatus`='1' where pnr='".$pnr."'";
                $result3=mysqli_query($connect,$sql3);

		        header("Location:ticket1.php");
		        exit();
		    }
		    else
		    {
			    echo '<script>alert("Insufficient balance")</script>';
			}
		}				
	}	
	else
	{   $sql4="UPDATE `bookingtable` SET `paystatus`='1' where pnr='".trim($pnr)."'";
        $result4=mysqli_query($connect,$sql4);
		header("Location:ticket1.php");
	}					
}
?>
</div>
</form>
</html>

