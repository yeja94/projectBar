<!--
  require_once('connect.php');
  // Connect to the database
  $dbc = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $bar_id = mysqli_real_escape_string($dbc, trim($_POST['bar_id']));	
	$name = mysqli_real_escape_string($dbc, trim($_POST['name']));	
	$rate = mysqli_real_escape_string($dbc, trim($_POST['rate']));	
	$description = mysqli_real_escape_string($dbc, trim($_POST['description']));
	
    if (!empty($bar_id)) {
      // Make sure user is entering the right bar id
      $query = "SELECT * FROM bar_review WHERE  bar_id = '$bar_id'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {
        // The bar id is unique, so insert the data into the database
		$query = "INSERT INTO bar_review (bar_id, name, rate, description) VALUES ('$bar_id', '$name', '$rate', '$description')";
		//$query = "UPDATE `Bars` SET `description`= '$description' WHERE `bar_id`= '$bar_id'";
        mysqli_query($dbc, $query);
		
        // Confirm success with the user
        echo '<p>Thank you, Your reviews has been successfully submitted.</p>';
	
        mysqli_close($dbc);
        exit();
		
      }
      else {
		//testing: 
        //An account already exists for this password, so display an error message
        echo '<p class="error">The bar_id does not exist . Please try again.</p>';
        $bar_id = "";
      }
    }
    else {
      echo '<p class="error">You must enter all of the data.</p>';
    }
  }

  mysqli_close($dbc);
?>
-->

<?php
	if(isset($_POST['submit']))
	{
		//$bar_id = $_POST['bar_id'];	
		$name = $_POST['name'];
		$rate = $_POST['rate'];		
		$description = $_POST['description'];	
		
		if($name && $rate && $description){
			$conn = mysql_connect('mysql.cs.orst.edu', 'cs340_yeja', '5271', 'cs340_yeja') or die ("Could not connect");
			mysql_select_db("cs340_yeja") or die("Could not connect to the database");
			//testing: check if that bar name exist
			$exists = mysql_query("SELECT * FROM bar_review WHERE name = '$name'") or die ("The query could not be found");
			if(mysql_num_rows($exists) != 0){
				//update the grade in the database
				mysql_query("UPDATE bar_review SET name = '$name', rate = '$rate', description = '$description'
							WHERE name = '$name'") or die ("Update could be not applied");
				echo '<p class="error">Update Successfully';
			}else echo '<p class="error">That Bar does not exist! Try again</p>';
		}else echo '<p class="error">Please enter the valid and all information</p>';
	}
?>

<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Jason Ye | Project | CS340 </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="icon" size="196x196" href="http://people.oregonstate.edu/~yeja/ye/apple-touch-icon-precomposed.png">
		
    <link rel="stylesheet" href="http://web.engr.oregonstate.edu/~yeja/web/cs340/project/main.css">
</head>
	
<body>
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
	</ul>			
</nav>

<section id="content">
<h3>Been there? Leave a review!</h3>
<center>
<p>Please enter the valid bar ID including your review:</p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
		  <legend>Your review</legend>
		  <br /> 
		  <label for="name">Bar Name:</label>
		  <input type="text" id="name" name="name" /><br /> 
		  <br />
		  <label for="description">Description:</label>
		  <textarea type="text" id="description" name="description" placeholder="write your review here"></textarea><br /> 
		  <br />
		  <label for="rate">What is your rating?</label>
			<select type="number" id="number", name="rate">
				<option value = "1">1</option>
				<option value = "2">2</option>
				<option value = "3">3</option>
				<option value = "4">4</option>
				<option value = "5">5</option>
			</select>
		  <br />
		  <center><input type="submit" value="Submit" name="submit" /></center>
	 </fieldset>
  </form>
  <p>Don't see your bar in the database? <br />
  Upload the bar <a href ="insertBar.php">here</a> and its address <a href="insertBarAddress.php">here</a></p>
  
</center>

</section>

</body>
</html>
