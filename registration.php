<?php
	$Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
	file_put_contents('UIDContainer.php',$Write);
?>

<!DOCTYPE html>
<html lang="en">
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
		<script src="js/bootstrap.min.js"></script>
		<script src="jquery.min.js"></script>
		<script>
			$(document).ready(function(){
				 $("#getUID").load("UIDContainer.php");
				setInterval(function() {
					$("#getUID").load("UIDContainer.php");
				}, 500);
			});
		</script>
		
		<style>
		.form-actions{
			background-color: #D462FF!important;
		}
		
			hr{
			margin:auto;
			margin-bottom:5px;
		}
		.table {
			margin: auto;
			width: 90%; 
		}
		tr{
			background-color:"#2002a8" ;
			color:"lightblue";
		}
		thead {
			color: #FFFFFF;
		}

.center:before{
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background: linear-gradient(330deg, #D462FF 55%, #4EE2EC 45%);
    z-index: -1;
}
h2{
			font-family:italic;
			font-size:3rem;
		}

		html {
			font-family: Arial;
			display: inline-block;
			margin: 0px auto;
		}
		
		textarea {
			resize: none;
		}

		</style>
		
		<title>Registration : Smart Hand Sanitizer</title>
	</head>
	
	<body>


		<h2 align="center">Smart Hand Sanitizer</h2>
		<hr width="500px;" color="black" size="10">

		<ul class="topnav">
			<li><a href="home.php">Home</a></li>
			<li><a href="user data.php">User Data</a></li>
			<li><a class="active" href="registration.php">Registration</a></li>
			<li><a href="read tag.php">Read Tag ID</a></li>
			<li><a href="May.html">User Temp</a></li>
		</ul>

		<div class="container"><div>
</div>
			<br>
			<div class="center" style="margin: 0 auto; width:495px;border-radius:15px; border-style: solid; border-color: 3px solid gold;">
				<div class="row">
					<h3 align="center">Registration Form</h3>
				</div>
				<br>

				<form class="form-horizontal" action="insertDB.php" method="post" >
					<div class="control-group">
						<label class="control-label">ID</label>
						<div class="controls">
							<textarea name="id" id="getUID" placeholder="Please Tag your Card / Key Chain to display ID" rows="1" cols="1" required></textarea>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">RollNo</label>
						<div class="controls">
							<input id="div_refresh" name="RollNo" type="text"  placeholder="" required>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Name</label>
						<div class="controls">
							<input id="div_refresh" name="name" type="text"  placeholder="" required>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Gender</label>
						<div class="controls">
							<select name="gender">
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Email Address</label>
						<div class="controls">
							<input name="email" type="text" placeholder="" required>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Mobile Number</label>
						<div class="controls">
							<input name="mobile" type="text"  placeholder="" required>
						</div>
					</div>
					<div align="center">
						<button type="submit" class="btn btn-success">Save</button>
                    </div>
				</form>
				
			</div>               
		</div> <!-- /container -->	
	</body>
</html>