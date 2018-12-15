<?php
include("db.php");
	/**displaying data by id***/
	
	if(isset($_POST['id'])) 
	{
			$id = mysqli_real_escape_string($connection, $_POST['id']);
			$query = "SELECT * FROM cars WHERE id='$id'";
			$query_car_info = mysqli_query($connection, $query);
			
			if(!$query_car_info) {
        die("Query Failed" . mysqli_error($connection));
      }
			
			if(mysqli_num_rows($query_car_info) > 0) {
				while($row = mysqli_fetch_array($query_car_info)) {
					  echo '<p id="feedback" class="bg-success"></p>';
            echo "<input rel='". $row['id']."' type='text' class='form-control title-input' value='".$row['title']."'>";
            echo "<input type='button'  updaterel='". $row['id']."' class='btn btn-success update' value='Update'>";
            echo "<input type='button' delrel='". $row['id']."' class='btn btn-danger delete' value='Delete'>";
            echo "<input type='button' class='btn btn-close' value='Close'>";
				}
			} 
			// Free result set
			mysqli_free_result($query_car_info);
			
			//close the connection
			mysqli_close($connection);
	}
	
	/****************************************************************/
	
	/***************update*********************/
	if(isset($_POST['updateid'])) 
	{
		$id = mysqli_real_escape_string($connection, $_POST['updateid']);
		$inputdata = mysqli_real_escape_string($connection, $_POST['inputdata']);
		if(!empty($inputdata)) {
			$query = "UPDATE cars SET title='$inputdata' WHERE id='$id'";
			$query_car_info = mysqli_query($connection, $query);
				
			if(!$query_car_info) {
				die("Query Failed" . mysqli_error($connection));
			}
			if(isset($query_car_info)) {
				echo "CARS UPDATED SUCCESSFULLY";
			}
		}	
			//close the connection
			mysqli_close($connection);
	}
	
	/***************end*********************/
	
	
	/************delete******************/
	if(isset($_POST['delid'])) 
	{
		$id = mysqli_real_escape_string($connection, $_POST['delid']);
		$query = "DELETE FROM cars WHERE id='$id'";
		$query_car_info = mysqli_query($connection, $query);
			
		if(!$query_car_info) {
			die("Query Failed" . mysqli_error($connection));
		}
		if(isset($query_car_info)) {
			echo "CARS DELETED SUCCESSFULLY";
		}
			
			//close the connection
			mysqli_close($connection);
	}
	
	/************delete******************/

?>

<script>
	$(function() {
		$(".update").on("click", function() {
			
			var id = $(this).attr('updaterel');
			var inputdata = $(".title-input").val();
			
			if(inputdata == "") {
				return false;
			} else {
				$.post("process.php", {updateid: id, inputdata: inputdata}, function(data) {
					/* $("#action-container").hide(); */
					$("#action-container").html(data);
				});
			}
			
		});
	});
</script>

<script>
	$(function() {
		$(".delete").on("click", function() {
			
			var id = $(this).attr('delrel');
			
			if(confirm("Are You Sure?")) {
				$.post("process.php", {delid: id}, function(data) {
					/* $("#action-container").hide(); */
					$("#action-container").html(data);
				});
			}
		});
	});
</script>

<script>
	$(function() {
		$(document).on("click", ".btn-close", () => {
			$("#action-container").hide();
		});
		
	});
</script>