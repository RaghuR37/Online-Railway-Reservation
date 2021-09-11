<html>
<title>PNR status</title>
<style>
div.form
{ margin-top:5%;
	margin-left:28%;
	margin-right:25%;
	padding:50px;
	border:3px solid #0074D9;
	border-radius:25px;
	height:27%;
	width:28%;
}
button
{ margin-left:40%;
	margin-top:7%;
	text-align:center;
  color:white;
  background-color:darkblue;font-size:15;
  font-family:serif;
  border-radius:10px;
  height:18%;
  width:25%
}
 input[type=text] 
 {  width: 45%;   
    margin: 8px 0;  
    padding: 12px 20px;   
    display: inline-block;   
    border: 2px solid blue;   
    box-sizing: border-box;   
 }
label
{    font-size: 25px;
     font-family:Roman;
     color:darkblue;
}
body
  { background-image:url(backgroundlogin.jpg);   
    padding: 10px;
  background-repeat: no-repeat;
  background-size: 1300px 900px;
 background-position:center;  
  }

</style>
<form action="pnrstatusvisible.php" method="POST">
<div class="form">
<a style="margin-left:23%;font-size:30;color:darkblue">PNR status</a><br>
<label style="margin-left:20% margin-top:20%">Enter PNR :</label>
<input type="text" placeholder="Enter PNR number"name="pnr" style="margin-left:5%;margin-top:10%"required /><br><br>
<button type="submit" class="button">Search</button>
</div>
</form>
</html>