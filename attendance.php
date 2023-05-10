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
		html {
			font-family: Arial;
			display: inline-block;
			margin: 0px auto;
			text-align: center;
		}
		body{
			background: #4ee2ec;
		}
		@media screen and (max-width: 600px) {
			ul.topnav li.right, 
			ul.topnav li {float: none;}
		}
		hr{
			margin:auto;
			margin-bottom:5px;
		}
		h2{
			font-family:italic;
			font-size:3rem;
		}
		
		.table {
			margin: auto;
			width: 90%; 
		}
		th{
            background-color: rgb(21, 10, 126);
		}
		table{
			color:white;
			background-color: rgb(4, 132, 252);
		}
		
		</style>
		
		<title>User Data : Smart Hand Sanitizer</title>
	</head>
	
	<body>
		<h2>Smart Hand Sanitizer</h2>
		<hr width="500px;" color="black" size="10">
		<ul class="topnav">
			<li><a href="home.php">Home</a></li>
			<li><a href="user data.php">User Data</a></li>
			<li><a href="registration.php">Registration</a></li>
			<li><a href="read tag.php">Read Tag ID</a></li>
			<li><a class="active" href="May.html.php">User Temp</a></li>
		</ul>
		<br>
		<?php 
		$d = $_GET["date"];
		$m = $_GET["month"];
	    ?>
		<div class="container">
            <div class="row">
                <h3>Student Attendance and Temp Table</h3>
				<h4>Date:<?php echo "$d $m"; ?></h4>
            </div>
            <div class="row">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
					  <th>Name</th>
					  <th>Roll No</th>
					  <th>Time</th>
					  <th>Temp</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
				   if($m=="May"){
					   $dt="5";
				   }
				   else{
					   $dt="6";
				   }
				   $date = $_GET['date']."-{$dt}-21";
				   echo $date;
                   $sql = "SELECT s.id, s.name, s.roll_no, m.time, m.temp FROM student s, may m where s.id = m.id AND m.date='".$date."' ORDER BY id ASC;";
				   echo $sql;  
				   $rows = $pdo->query($sql);
                   foreach ($rows as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['id'] . '</td>';
							echo '<td>'. $row['name'] . '</td>';
							echo '<td>'. $row['roll_no'] . '</td>';
                            echo '<td>'. $row['time'] . '</td>';
							echo '<td>'. $row['temp'] . '</td>';
							echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
				</table>
			</div>
		</div> <!-- /container -->
	</body>
</html>