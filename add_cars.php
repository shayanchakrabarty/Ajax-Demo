<?php
include("db.php");
$car_name = $_POST['car_name'];

if(isset($car_name)) {
	$sql = "INSERT INTO CARS (title) VALUES ('$car_name')";
	$result = mysqli_query($connection, $sql);
	
	if(!$result) {
		die('QUERY ERROR'. mysqli_error($connection));
	}
	
	header('Location: index.html');
}
?>