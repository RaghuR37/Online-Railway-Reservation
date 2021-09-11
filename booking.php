<?php    
	if(isset($_SESSION["completed"])){
		if($_SESSION["completed"]=="done"){
			header("Location:success.php");
		}
	}	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Booking</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
	.error{
		color: red;
	}
	input[type='submit'],a{
		width: 100%;
	}
</style>
<body>
	<datalist id="from-list">
		<option>CHENNAI CTL</option>
		<option>COIMBATORE JN</option>
		<option>MADURAI JN</option>
		<option>SALEM JN</option>
	</datalist>
	<datalist id="to-list">
		<option>CHENNAI CTL</option>
		<option>COIMBATORE JN</option>
		<option>MADURAI JN</option>
		<option>SALEM JN</option>
	</datalist>
	<div class="container">
		
		<div class="jumbotron">
			<h1>Booking</h1>
			<form method="POST" action="booking-details.php" autocomplete="off" onsubmit="return go()" >
				<div class="form-group">
					<label for="location">From</label>
					<input class="form-control" type="text" list="from-list" name="location" id="location" required>
				</div>
				<div class="form-group">
					<label for="destination">To</label>
					<input class="form-control" type="text" list="to-list" name="destination" id="destination" required>
				</div>
				<div class="form-group">
					<label for="depart-date">Date</label>
					<input class="form-control" type="date" name="depart-date" id="depart-date" required>
				</div>
				<div class="form-group">
					<label for="class">Coach</label>
					<select class="form-control" name="class" id="class" required>
						<option>General</option>
						<option>Class1A</option>
						<option>AC2Tier</option>
						<option>AC3Tier</option>
						<option>Sleeper</option>
						<option>Seater</option>
					</select>
				</div>
				<div class="form-group">
					<input class="btn btn-success" type="submit" name="submit" value="Find Train">
				</div>
				<div class="helper-text">
					<span class="error" id="error"></span>
				</div>
			</form>
			
		</div>
		<div class="jumbotron">
			<div class="form-group">
				<a class="btn btn-primary" href="http://localhost/OnlineTicket/pnrstatus.php">PNR Staus</a>
			</div>
			<div class="form-group">
				<a class="btn btn-primary" href="http://localhost/OnlineTicket/money.php">Add Money / Check balance</a>
			</div>
			<div class="form-group">
				<a class="btn btn-primary" href="http://localhost/OnlineTicket/cancelticket.php">Cancel Ticket</a>
			</div>
		</div>
	</div>
	
</body>
<script type="text/javascript">
	function go() {
		//alert("came");
		var l=document.getElementById('location');
		var d=document.getElementById('destination');
		var date=document.getElementById('depart-date');
		var now=new Date();
		var pick=new Date(date.value);
		var c=document.getElementById('class');
		if (l.value===d.value) {
			//d.style.border="1px solid red";
			alert("location and destination must be different");
			
			return false;
		}
		else if (now>pick) {
			//date.style.border="1px solid red";
			alert("Time Travel Banned Pick Future");

			return false;
		}
		else{
			
			return true;
		}
	}

	function isEmpty(a){
		//a=a.replace(' ','');
		return a===''||a===null||a===undefined;
	}

</script>
</html>