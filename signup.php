<!--Using the provided template from class-->
<!DOCTYPE html>
<html>
<head>
	<title>sign up page</title>
    <link rel="stylesheet" href="main.css">
	<script type = "text/javascript"  src = "validateSignUp.js" > </script>	
</head>

<body>
<nav id="tools">
	<ul class="horizontal">	
		<li><a href="signup.php">Sign Up</a></li>
		<li><a href="login.php">Log In</a></li>
	</ul>
</nav>
<section id="content">
<h3>Sign Up</h3>
<center>
<?php

  require_once('connect.php');
  // Connect to the database
  $dbc = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $first_name = mysqli_real_escape_string($dbc, trim($_POST['first_name']));	
	$last_name = mysqli_real_escape_string($dbc, trim($_POST['last_name']));	
	$age = mysqli_real_escape_string($dbc, trim($_POST['age']));	
	$password = mysqli_real_escape_string($dbc, trim($_POST['password']));


    if (!empty($first_name) && !empty($password)) {
      // Make sure someone isn't already registered using this password
      $query = "SELECT * FROM registration WHERE password = '$password'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {
        // The password is unique, so insert the data into the database
        $query = "INSERT INTO registration (first_name, last_name, age, password) VALUES ('$first_name', '$last_name', '$age', '$password')";
        mysqli_query($dbc, $query);

        // Confirm success with the user
        echo '<p>Your new account has been successfully created. You\'re now ready to log in.</p>';
		echo '<p>Back to <a href="login.php">Log in page</a></p>';
        mysqli_close($dbc);
        exit();
		
      }
      else {
		//testing: 
        //An account already exists for this password, so display an error message
        echo '<p class="error">An account already exists for this password. Please use a different address.</p>';
        $password = "";
      }
    }
    else {
      echo '<p class="error">You must enter all of the sign-up data.</p>';
    }
  }

  mysqli_close($dbc);
?>

  <p>Please enter your username and desired password to sign up for an account.</p>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
		  <legend>Registration Info</legend>
		  <br /> 
		  <label for="first_name">First name:</label>
		  <input type="text" id="first_name" name="first_name" /><br />
		  <br />
		  <label for="last_name">Last name:</label>
		  <input type="text" id="last_name" name="last_name" /><br /> 
		  <br />
		  <label for="age">Age:</label>
		  <input type="number" id="age" name="age" /><br /> 
		  <br />
		  <label for="password">Password:</label>
		  <input type="password" id="password" name="password" /><br />
		  <br />
		  <input type="submit" value="Sign Up" name="submit" />
	 </fieldset>
  </form>
 
  </section>
</center>
<footer>
<nav id="legal">
	<ul class="horizontal"> 
		<li>Updated May 30, 2016 </li>
		<li><a href="http://web.engr.oregonstate.edu/~yeja/web/cs340/project/about.html">About</a></li>
		<li><a href="http://web.engr.oregonstate.edu/~yeja/web/cs340/project/management.html">Management</a></li>
		<li><a href="#">Contact Me</a></li>
		<li>&copy;2016 Jason Ye</li>
	</ul>
</nav>
</footer>
</body> 
</html>
