<?php
	if(isset($_SESSION["completed"])){
		if($_SESSION["completed"]=="done")
		{ //header("Location:login.php");
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Passenger Info</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style type="text/css">
	.error{
		color: red;
	}
	#btn{
		text-align: center;
	}
	input[type='submit']{
		width: 30%;
	}
</style>
<body>
	<div class="container">		
		<div class="jumbotron">
			<h1>Passenger Info</h1>
			<form method="POST" action="reserve.php">
				<div class="form-group">
					<label for="name">Booked By</label>
					<input class="form-control" type="text" name="name" placeholder="Name" id="name" required>
				</div>
				<div class="form-group">
					<label for="mobilenumber">Mobile Number</label>
										<div class="input-group">
      

      <div class="input-group-btn">
        <button class="btn btn-default" disabled>+91</i></button>
      </div>
    <?php
     session_start();
     $mobilenumber=$_SESSION['mobilenumber'];      
     echo "<input class='form-control' type='tel' name='mobilenumber' id='mobilenumber' value='".$mobilenumber."' disabled>" ;
     ?>
                </div>
				</div>
				<div class="form-group">
					<label for="address">Address</label>
					<textarea rows="3" class="form-control" name="address" id="address" required></textarea>
				</div>
				<div class="jumbotron">
				<?php
		$con=mysqli_connect("localhost","root","","onlineticket");

	    $query="SELECT * FROM trainstable WHERE trainno='".$_SESSION["train-no"]."' AND 
	    trainname='".$_SESSION["train-name"]."' AND trainfrom='".$_SESSION["trainfrom"]."' AND 
	    trainto='".$_SESSION["trainto"]."' AND departuretime='".$_SESSION["departure"]."' AND
	    arrivaltime='".$_SESSION["arrival"]."'";
        $result=mysqli_query($con,$query);
       
        $que="SELECT * FROM bookingtable WHERE trainnumber='".$_SESSION["train-no"]."' AND 
         trainname='".$_SESSION["train-name"]."' AND trainfrom='".$_SESSION["trainfrom"]."'
          AND trainto='".$_SESSION["trainto"]."' AND departuretime='".$_SESSION["departure"]."'
           AND arrivaltime='".$_SESSION["arrival"]."'
           AND class='".$_SESSION["coach"]."'  AND paystatus='1' AND date='".$_SESSION["depart-date"]."' AND (status='1' OR status='00')";
          $res=mysqli_query($con,$que);          
          
          $total=0;
          $bookedseats=0;
          if (mysqli_num_rows($result)>0) 
          {  while ($row=mysqli_fetch_assoc($result)) 
             { $total=$row[$_SESSION["coach"]];             	
               break;
             }  	
          }         
          $bookedseats=mysqli_num_rows($res);
          $len=(int)$_SESSION["passenger-count"];          
          $length=$len;
          $_SESSION['seats']=($total-$bookedseats);                   
					for($i=1;$i<=$len;$i++)
					{  if($_SESSION['seats']>=$len)
				       { $seatno="Seat no:".((int)$_SESSION['seats']-$i+1);						
    				   }
					   else
					   { $seatno="waiting...";                                                           					   	  
					   }					   
						echo "
						<div class='form-group'>
							<br><br><div>
							<label>Passenger $i</label>
						</div>
							<div class='form-group col-xs-3'>
								<input class='form-control' type='text' name='passenger-name$i' placeholder='name' required>
							</div>
							<div class='form-group col-xs-3'>
								<input class='form-control' type='number' name='passenger-age$i' min='1' max='200' placeholder='age' required>
							</div>
							<div class='form-group col-xs-3'>
								<select class='form-control' type='text' name='passenger-gender$i' required>
									<option>Male</option>
									<option>Female</option>
									<option>Transgender</option>
								</select>
							</div>
							<div class='form-group col-xs-3'>
								<input class='form-control' value='$seatno' disabled>
							</div>

						</div>";
					}       
				?>
				</div>
				<div id="btn" >
					<input class="btn btn-success" type="submit" name="submit" value="Proceed">
				</div>
				<div class="helper-text">
					<span class="error" id="error"></span>
				</div>
			</form>
			
		</div>
	</div>
	
</body>
<script type="text/javascript">
	function go() {
		//alert("came");
		var l=document.getElementById('location');
		var d=document.getElementById('destination');
		var date=document.getElementById('depart-date');
		var c=document.getElementById('class');
		if (isEmpty(l.value)||isEmpty(d.value)||isEmpty(date.value)||isEmpty(c.value)) {
			document.getElementById('error').innerHTML="All details required!";
			return false;
		}
		else{
			document.getElementById('error').innerHTML="";
			return true;
		}
	}
	function isEmpty(a){
		//a=a.replace(' ','');
		return a===''||a===null||a===undefined;
	}

</script>
</html>