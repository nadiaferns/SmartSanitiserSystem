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
		<link href="css/styles.css" rel="stylesheet">
		<script src="js/bootstrap.min.js"></script>
		<style>
		.image{	
			/* overflow:hidden; */
			transition:transform.5s ease;
			height:400px
		}
		.image:hover{
			
			transform:scale(1.5);
		}
		body{
			background:#4EE2EC;
		}
		hr{
			margin:auto;
			margin-bottom:5px;
		}
		h2{
			font-family:italic;
			font-size:3rem;
		}
		h3{
			font-size:1.5rem;
			margin: auto;
		}
		
		html {
			font-family: Arial;
			display: inline-block;
			margin: 0px auto;
			text-align: center;
		}
		
		</style>
		
		<title>Home : Smart Hand Sanitizer</title>
	</head>
	
	<body>
		<h2>Smart Hand Sanitizer</h2>
		<hr width="500px;" color="black" size="10">
		<ul class="topnav">
			<li><a class="active" href="home.php">Home</a></li>
			<li><a href="user data.php">User Data</a></li>
			<li><a href="registration.php">Registration</a></li>
			<li><a href="read tag.php">Read Tag ID</a></li>
			<li><a href="May.html">User Temp</a></li>
		</ul>
		<br>
		<h3>Welcome to our Attendance system</h3>
		<img class="image" src="images/img1.jpg" alt="sanitizer-img">

	</body>
</html>