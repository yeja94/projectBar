<!DOCTYPE html>
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

<?php
  require_once('connect.php');
  // Connect to the database
  $dbc = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
	$bar_id = mysqli_real_escape_string($dbc, trim($_POST['bar_id']));	
	$name = mysqli_real_escape_string($dbc, trim($_POST['name']));	
	$theme = mysqli_real_escape_string($dbc, trim($_POST['theme']));
	$price = mysqli_real_escape_string($dbc, trim($_POST['price']));	

    if (!empty($bar_id) && !empty($name)) {
      // Make sure someone isn't already registered using this password
      $query = "SELECT * FROM Bars WHERE bar_id = '$bar_id'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {
        // The password is unique, so insert the data into the database
        $query = "INSERT INTO Bars (bar_id, name, theme, price) VALUES ('$bar_id', '$name', '$theme', '$price')";
		//$query = "INSERT INTO bar_address (name, street, city, zip) VALUES ('$name', '$street', '$city', '$zip')";
        mysqli_query($dbc, $query);

        // Confirm success with the user
        echo '<p>Your new information has been successfully created.</p>';
		echo '<p>Back to <a href="writeareview.php">writing your review</a></p>';
        mysqli_close($dbc);
        exit();
		
      }
      else {
		//testing: 
        //An account already exists for this password, so display an error message
        echo '<p class="error">A Bar already exists for this bar ID. Please use a different address.</p>';
        $bar_id = "";
      }
    }
    else {
      echo '<p class="error">You must enter all of the data.</p>';
    }
  }

  mysqli_close($dbc);
?>
<center>
<p>Please enter all the information below:</p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
		  <legend>Bar information:</legend>
		  <br /> 
		  <label for="bar_id">Bar ID:</label>
		  <input type="number" id="bar_id" name="bar_id" /><br />
		  <br />
		  <label for="name">Bar Name:</label>
		  <input type="text" id="name" name="name" /><br /> 
		  <br />
		  <label for="theme">Theme:</label>
		  <input type="text" id="theme" name="theme" /><br /> 
		  <br />
<!--		  
		  <label for="street">Street</label>
		  <input type="text" id="street" name="street" /><br />
		  <br />
		  <label for="city">City:</label>
		  <input type="text" id="city" name="city" /><br />
		  <br />
		  <label for="zip">Zip Code:</label>
		  <input type="number" id="zip" name="zip" /><br />
		  <br />
-->
		  <label for="price">Price</label>
			<select type="text" id="text", name="price">
				<option value = "Low">Low</option>
				<option value = "Average">Average</option>
				<option value = "High">High</option>
			</select>
		  <br />
		  <center>
		  <input type="submit" value="Submit" name="submit" />
		  <p>Upload the bar address <a href="insertBarAddress.php">here!</a></p>
		  </center>
	 </fieldset>
  </form>
  </center>
  </body>
  </html>