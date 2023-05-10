<?php
//Creates new record as per request
    //Connect to database
    $servername = "localhost";		//example = localhost or 192.168.0.0
    $username = "id16918629_project";		//example = root
    $password = "WpV>&]2c{0<}1?\K";	
    $dbname = "id16918629_attendance";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
    }

    //Get current date and time
    date_default_timezone_set('Asia/Kolkata');
    $d = 20-05-21
    $t = date("H:i:s");
    $temp = "65";

	//$ldrvalue = $_POST['ldrvalue'];
        $id = $_POST['id'];
	    $sql = "INSERT INTO may (`id`, `temp`, `time`, `date`) VALUES ('".$id."','".$temp."', '".$t."', '".$d."')"; //nodemcu_ldr_table = Youre_table_name

		if ($conn->query($sql) === TRUE) {
		    echo "OK";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}


	$conn->close();
?>
<?php

    $servername = "localhost";		//example = localhost or 192.168.0.0
    $username = "id16918629_project";		//example = root
    $password = "WpV>&]2c{0<}1?\K";	
    $dbname = "id16918629_attendance";

    // Create connection
try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // prepare sql and bind parameters
  $stmt = $conn->prepare("INSERT INTO may (`id`, `temp`, `time`, `date`) VALUES (:id, :temp, :time, :date)");
  $stmt->bindParam(':id', $id);
  $stmt->bindParam(':temp', $temp);
  $stmt->bindParam(':time', $t);
  $stmt->bindParam(':date', $d);

    //Get current date and time
    date_default_timezone_set('Asia/Kolkata');
    $id = $_POST['id'];
    $temp = $_POST['temp'];
    $t = date("H:i:s");
    $d = "20-05-21";
		//$ldrvalue = $_POST['ldrvalue'];
    $stmt->execute();

	} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}

?>

