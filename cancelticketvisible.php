<?php
$con=mysqli_connect('localhost','root','','onlineticket');
if(isset($_POST['pnr']))
{ $pnr=$_POST['pnr'];
  $sql1="select * from bookingtable where pnr='".trim($pnr)."'";
  $result1=mysqli_query($con,$sql1);
   if(mysqli_num_rows($result1)>0)
   { 

      $sql2="select * from bookingtable where pnr='".trim($pnr)."' AND (status='1' OR status='0')";      
      $result2=mysqli_query($con,$sql2);
      if(mysqli_num_rows($result2)>0)
      {$sql3="update bookingtable set status='00' where pnr='".trim($pnr)."'";
       $result3=mysqli_query($con,$sql3);   
     
      $sql4="select * from bookingtable where pnr='".trim($pnr)."'";
      $result4=mysqli_query($con,$sql4);
      if(mysqli_num_rows($result4)>0)
      { while($row=mysqli_fetch_assoc($result4))
        { $class=$row['class'];
          $from=$row['trainfrom'];
          $to=$row['trainto'];
          $departuretime=$row['departuretime'];
          $arrivaltime=$row['arrivaltime'];
          $mobile=$row['contact'];
          break;
        } 
      }    

    $sql5="Select * from trainstable where trainfrom='".$from."' AND trainto='".$to."' 
           AND departuretime='".$departuretime."' AND arrivaltime='".$arrivaltime."' limit 1";
    $result5=mysqli_query($con,$sql5);
    if(mysqli_num_rows($result5)>0)
    { while($row=mysqli_fetch_assoc($result5))
      { $fare=$row['ticketfare'];      
      } 
    }  
  if(strtolower($class)=='seater')
  { $fare=$fare;    
  }
  if(strtolower($class)=='sleeper')
  { $fare=$fare+50;   
  }
  if(strtolower($class)=='ac 3tier')
  { $fare=$fare+100;    
  }
  if(strtolower($class)=='ac 2tier')
  { $fare=$fare+150;    
  } 
  if(strtolower($class)=='class1a')
  { $fare=$fare+200;    
  }  
  $totalfare=mysqli_num_rows($result4)*$fare;  
  $amount=(int)$totalfare*0.75;     

  $sql6="insert into rechargetable values('$mobile','Cancel','$amount','0')";          
  $result6=mysqli_query($con,$sql6);
  header("Location:cancelticketsuccess.html");
       exit();
      }
      else
      { echo '<script>alert("Already Ticket Cancelled")</script>';        
      }
   
   }
   else
   { echo '<script>alert("Invalid PNR number")</script>'; 
   } 
 }  
?> 
