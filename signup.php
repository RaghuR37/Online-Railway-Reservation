<?php
$con=mysqli_connect("localhost","root","","onlineticket");
$Name=$_POST["name"];
$Mobile=$_POST["mobile"];
$Password=md5($_POST["password"]);
$Reenter=md5($_POST["reenter"]);
$Age=$_POST["age"];
$Address=$_POST["address"];
$Aadhar=$_POST["aadhar"];
$que="insert into signuptable values('$Name','$Mobile','$Password','$Age','$Address','$Aadhar',0)";
$f=0;
$sql="select * from signuptable where mobilenumber='".trim($Mobile)."'";	
$result=mysqli_query($con,$sql);
if($Password!=$Reenter)
{ echo '<script>alert("Password and reenter password does not match")</script>';	
  header("refresh:1;url=signup.html");
  $f=1;
}
if(mysqli_num_rows($result)!=0 && $f==0)
{  header("Location:alreadyaccount.html");  
   exit();
   $f=1;	
}	
if($f==0 && mysqli_num_rows($result)==0 )
{$c=mysqli_query($con,$que);
 header("Location:signupsuccess.html");
 exit();
}
?>