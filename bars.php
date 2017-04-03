<!DOCTYPE html>

<html>
	<head>
		<title>MySQL Table Viewer</title>
		<link rel="stylesheet" href="main.css">
	</head>
<body>
<head>
</head>
<header>
	<a href="http://web.engr.oregonstate.edu/~yeja/web/cs340/project/main.html"><img id="logo" src="logo.jpg"/></a>	
</header>
<nav id="main">
	<ul class="horizontal">
		<li id="nav"><a href="#">Database</a>
			<ul id="navmenu">
				<li><a href="accounts.php">Accounts</a></li>
				<li><a href="bars.php">Bars</a></li>
				<li><a href="reviews.php">Reviews</a></li>
			</ul>
		</li>
		<li class="corners boxshadows"><a href="writeareview.php">Write a Reviews</a></li>		
	</ul>			
</nav>

<section id="content">
<div id="table">
<?php
// change the value of $dbuser and $dbpass to your username and password
	include 'connectvarsEECS.php'; 
	
	$conn = mysqli_connect('mysql.cs.orst.edu', 'cs340_yeja', '5271', 'cs340_yeja');
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	$table = $_POST['table'];
	$query = " SELECT * FROM Bars_view";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
	
	$fields_num = mysqli_num_fields($result);
	echo "<h2>Bars: {$table}</h2>";
	echo "<table><tr>";
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
	?>
</div>
</section>
</body>

</html>