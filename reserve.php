<?php
	session_start();
	if(isset($_POST['submit']))
	{  $con=new mysqli("localhost","root","","onlineticket");
		if ($con) 
		{   $q="SELECT bookid FROM bookingtable";
			$result=$con->query($q);
			
			$query="INSERT INTO bookingtable VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$stmt=$con->prepare($query);
			$stmt->bind_param("issssssssssssssssss",$bookid,$pnr,$name,$age,$gender,$bookedby,$contact,$address,$trainname,$trainno,$from,$to,$date,$departuretime,$arrivaltime,$class,$seatno,$status,$paystatus);
			
			$count=(int)$_SESSION["passenger-count"];
            $rows=array();

            print_r($_SESSION);

			if (mysqli_num_rows($result)>0) 
			{ while ($row=$result->fetch_assoc()) 
				{ if (!in_array($row["bookid"],$rows)) 
			        { array_push($rows,$row["bookid"]);
					}
				}
			}	
			$inserted=$_SESSION["inserted"];
            if($inserted!='1')
			{ $tempId=getBookId($rows);
			  $pnr=$tempId;
			  $_SESSION["pnr"]=$pnr;
			}		    			    
				$bookid=0;
				$bookedby=$_POST["name"];
				$contact=$_SESSION["mobilenumber"];
				$address=$_POST["address"];
				$trainname=$_SESSION["train-name"];
				$trainno=$_SESSION["train-no"];
				$from=$_SESSION["trainfrom"];
				$to=$_SESSION["trainto"];
				$date=$_SESSION["depart-date"];
				$departuretime=$_SESSION["departure"];
				$arrivaltime=$_SESSION["arrival"];
				$class=$_SESSION["coach"];
				$status=$_SESSION["status"];
		        $paystatus=0;		
         
			for ($i=1; $i<=$count ; $i++) 
		     {  $name=$_POST["passenger-name$i"];
				$age=$_POST["passenger-age$i"];
				$gender=$_POST["passenger-gender$i"];				
			      if ($_SESSION["seats"]>=$count) 
				   {  $seatno=(int)$_SESSION["seats"]-$i+1;
				   }
				  else
				  { $status="0";
				    $connect=mysqli_connect("localhost","root","","onlineticket");
					      $sql2="SELECT * FROM bookingtable WHERE NOT seats='Reallocate' AND 
					               trainnumber='".$_SESSION["train-no"]."' AND 
                                  trainname='".$_SESSION["train-name"]."' AND trainfrom='".$_SESSION["trainfrom"]."'
                                  AND trainto='".$_SESSION["trainto"]."' AND departuretime='".$_SESSION["departure"]."'
                                  AND arrivaltime='".$_SESSION["arrival"]."' AND class='".$_SESSION["coach"]."'  AND
                                  date='".$_SESSION["depart-date"]."' AND status='00'";                    
                                  $res2=mysqli_query($connect,$sql2);      
                                  $cancelled=0;                                                                    
                                  if(mysqli_num_rows($res2)>0)
                                  { $cancelled=mysqli_num_rows($res2);                                    
					                if($cancelled>=$len)
					   	            { while ($row=mysqli_fetch_assoc($res2))
					   	              { $no=$row['seats'];
					   	                $seatno="Seat no:".$no;
					   	                break;
					   	              }	
					   	       $sql3="update bookingtable set seats='Reallocate' WHERE seats='".trim($no)."' AND
                              trainnumber='".$_SESSION["train-no"]."' AND trainname='".$_SESSION["train-name"]."' 
                              AND trainfrom='".$_SESSION["trainfrom"]."' AND trainto='".$_SESSION["trainto"]."' AND
                              departuretime='".$_SESSION["departure"]."' AND arrivaltime='".$_SESSION["arrival"]."' AND 
                              class='".$_SESSION["coach"]."'  AND date='".$_SESSION["depart-date"]."' AND status='00'";                             
                              $res=mysqli_query($connect,$sql3);   
					   	      }
					   	   }
					   	   else
                           { $seatno="waiting...";
                           }
				  }	
				  $inserted=$_SESSION["inserted"];		   			   					
				  if($inserted!='1')
			      { $stmt->execute();			  			        
			      }
			  }				
			$_SESSION["inserted"]='1';
		}
		header("Location:payandproceed.php");
	}
	else
	{ echo "Failed <a href='./booking.html'>Retry</a>";
	}
	function getBookId($list)
	{  $id=rand(1000000000,9999999999);		
		if (in_array($id,$list))
		 { getBookId($list);
		 }
	   return $id;
	}
?>