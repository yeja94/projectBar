<!DOCTYPE html>

<html>
	<head>
		<title>MySQL Table Viewer</title>
	</head>
<body>
<head>
	<h1>Student Course</h1>
</head>
<?php
// change the value of $dbuser and $dbpass to your username and password
	if(isset($_POST['search'])){
	
		include 'connectvarsEECS.php'; 
		$sid = $_POST['sid'];
		$conn = mysqli_connect('mysql.cs.orst.edu', 'cs340_yeja', '5271', 'cs340_yeja');
		if (!$conn) {
			die('Could not connect: ' . mysql_error());
		}
		$table = $_POST['table'];
		$query = "SELECT * FROM enrollment WHERE `sid` = $sid";

		$result = mysqli_query($conn, $query);
		if (!$result) {
			die("Query to show fields from table failed");
		}
		
		$fields_num = mysqli_num_fields($result);
		echo "<h1>Table: {$table}</h1>";
		echo "<table border='1'><tr>";
		// printing table headers
		for($i=0; $i<$fields_num; $i++) {	
			$field = mysqli_fetch_field($result);	
			echo "<td><b>{$field->name}</b></td>";
		}
		echo "</tr>\n";
		while($row = mysqli_fetch_row($result)) {	
			echo "<tr>";	
			// $row is array... foreach( .. ) puts every element
			// of $row to $cell variable	
			foreach($row as $cell)		
				echo "<td>$cell</td>";	
			echo "</tr>\n";
		}

		mysqli_free_result($result);
		mysqli_close($conn);
	}
	?>
	
<p>Enter a student ID to display his/her information</p>
<form method="post" action="/~yeja/web/cs340/homework3/showEnrolment.php">
	Search Student ID: <input type = "text" name = "sid" placeholder = "000000000" />
	<input type ="submit" value = "List" name ="search" /><br />
</form>

</body>
</html>