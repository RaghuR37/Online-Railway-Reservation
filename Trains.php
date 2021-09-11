<!DOCTYPE html>
<html>
<head>
	<title>Trains</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style type="text/css">
	#overlay {
		position: fixed;
  		display: none;
  		width: 100%; 
  		height: 100%;
  		top: 0;
  		left: 0;
  		right: 0;
  		bottom: 0;
  		background-color: rgba(0,0,0,0.5); 
  		z-index: 2; 
  		cursor: pointer;
	}
	#field{

		padding: 100px 400px 300px 400px;
	}
	#form{
		padding-top: 30px;
		padding-left: 30px;
		padding-bottom: 30px;
		background-color: white;
		border: 1px solid white;
		border-radius: 5%;
	}
	.inputs{
		border:0;
		outline: 0;
	}
	#count,#class{
		width: 30%;
	}
	#close-div{
		width: 90%;
	}
	#close{
		color: red;
		float: right;
	}
	#close:hover{
		color: green;
	}
	.not-found{
		text-align: center;
	}
</style>
<body>
	<div class="container">
		
	
	<div class="jumbotron">
		<h1>Trains</h1>
		</div>		
		<table class="table table-striped">
			
			<?php
session_start();

	
	if (isset($_SESSION['depart-date'])) 
	{ $con=mysqli_connect("localhost","root","","onlineticket");
	if ($con) {
		$date=$_SESSION['depart-date'];
		$from=$_SESSION['from'];
		$to=$_SESSION['to'];
		$query="SELECT * FROM trainstable";
		$f=0;
		$result=mysqli_query($con,$query);
		if (mysqli_num_rows($result)>0) {			
			while ($row=mysqli_fetch_assoc($result)) {
				if ($from==$row["trainfrom"] and $to==$row["trainto"]) {					
					if ($row["day"]=="ALL" or isEqual(day($date),$row["day"])) {
						if ($f==0) {
							$f=1;
							echo "
								<tr>
									<th>Train no</th>
									<th>Train name</th>
									<th>Departure Time</th>
									<th>Arrival Time</th>
									<th>From</th>
									<th>Destination</th>
									<th></th>
								</tr>
							";
						}
						
						echo "<tr>
								<td> ".$row['trainno'] ."</td>
								<td> ".$row['trainname'] ."</td>
								<td> ".$row['departuretime']." </td>
								<td> ".$row['arrivaltime'] ."</td>
								<td> ".$row['trainfrom'] ."</td>
								<td> ".$row['trainto'] ."</td>
								<td><button onclick='popup(\"".$row['trainno']."\"
											,\"".$row['trainname']."\"
											,\"".$row['departuretime']."\"
											,\"".$row['arrivaltime']."\"
											,\"".$row['trainfrom']."\"
											,\"".$row['trainto']."\")' class='btn btn-success'>Go</button></td>
							</tr>";

					}
				}
				
				
			}
		}
		if($f==0){
			echo "<div class='alert alert-success alert-dismissible'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <h1 class='not-found'>No Trains Available</h1>
  </div>
  <div class='not-found'>
  <span style='font-size:100px;text-align:center;'>&#128540;</span></div>
  ";
		}
		//echo day($date);
		//echo isEqual(day($date),$row["day"]);
	}
}
else{ echo "Failed <a href='./booking.php'>Retry</a>";}

	function day($value){
		$date=explode("-",$value);
		$time=mktime(0,0,0,$date[2],$date[1],$date[0]);
		return date("l",$time);
	}
	function isEqual($day,$get){
		$days=explode(",",(string)$get);
		//print_r($days);
		//echo in_array(strtoupper(substr($day,0,3)), $days);
		$convert=strtoupper(substr($day,0,3));
		//return $convert;
		if (in_array($convert, $days)) {
			return true;
		}
		else{
			return false;
		}

	}

		?>
		</table>
	</div>
	<div id="overlay">
		<div id="field">
			
		
		<form id="form" method="POST" action="train-details.php">
			<div id="close-div">
				<span id="close" onclick="off()"><i class="fa fa-close"></i></span>
			</div>
			<h1>Passenger Count</h1>
			<b>Train no:</b><input type="text" class="inputs" name="trainno" id="trainno" readonly required><br>
			<b>Train Name:</b><input type="text" class="inputs" name="trainname" id="trainname" readonly required><br>
			<b>Depart At:</b><input type="text" class="inputs" name="departuretime" id="departuretime" readonly required>
			<br>
			<b>Arrive At:</b><input type="text" class="inputs" name="arrivaltime" id="arrivaltime" readonly required><br>
			<b>From:</b><input type="text" class="inputs" name="trainfrom" id="trainfrom" readonly required><br>
			<b>To:</b><input type="text" class="inputs" name="trainto" id="trainto" readonly required><br>
			<div>
					<label for="depart-date">Passenger Count</label>
					<input class="form-control" type="number" name="count" id="count" min="1" max="8" required>
				</div>
				<div>
					<label for="class">Coach</label>
					<select class="form-control" name="class" id="class" required>
						<option>Class1A</option>
						<option>AC2Tier</option>
						<option>AC3Tier</option>
						<option>Sleeper</option>
						<option>Seater</option>
					</select>
				</div><br>
				<div class="form-group">
					<input class="btn btn-success" type="submit" name="submit" value="Proceed">
				</div>
		</form>

		</div>
	</div>

</body>
<script type="text/javascript">
	function on() {
  		document.getElementById("overlay").style.display = "block";
	}

	function off() {
  		document.getElementById("overlay").style.display = "none";
	}
	function popup(no,name,come,go,from,to){
		document.getElementById('trainno').value=no;
		document.getElementById('trainname').value=name;
		document.getElementById('departuretime').value=come;
		document.getElementById('arrivaltime').value=go;
		document.getElementById('trainfrom').value=from;
		document.getElementById('trainto').value=to;
		on();
		//console.log(no);
		//alert(no+"\n"+name+"\n"+come+"\n"+go+"\n"+from+"\n"+to+"\n");

	}
</script>
</html>