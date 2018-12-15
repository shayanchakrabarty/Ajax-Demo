<?php
require("db.php");
/*
if($connection) {
	echo 'hu ha';
}*/

$search = $_POST['search'];

if(isset($search)) {
	$sql = "SELECT * FROM cars WHERE title like '$search%'";
	
	$search_query = mysqli_query($connection, $sql);
	
	if(!$search_query) {
		die('QUERY ERROR'. mysqli_error($connection));
	}
	
	if(mysqli_num_rows($search_query) <= 0) {
		echo "Sorry no cars found";
	} else {
	
	while($row = mysqli_fetch_object($search_query)) {
		$brands = $row->title;
	?>
	<ul class="list-unstyled">
		<li><?php echo $row->title; ?> in stock</li>
	</ul>
	<?php
	}
} 
}
?>