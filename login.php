<!--Using the provided template from class-->
<?php
	session_start();
	include 'connect.php';
	
	if ((isset($_POST['first_name'])) && (isset($_POST['password'])) ){
		$first_name = $_POST['first_name'];
		$password = $_POST['password'];
	
		$dbc = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		if (!$dbc) {
			die('<p class="error">Could not connect: </p>');
		}
	
		$query = "SELECT * FROM registration WHERE first_name='$first_name' and password='$password'";
		$result = mysqli_query($dbc, $query);
	
		if (mysqli_num_rows($result) == 1) {
	
			// The log-in is OK so set the user ID and first name session vars (and cookies), and redirect to the home page
			  $row = mysqli_fetch_array($result);
			  $_SESSION['first_name'] = $row['first_name'];
			  
			  $_SESSION['password'] = $row['password'];
			
			}
		else {
          // The first name/last name/password are incorrect so set an error message:
			echo '<p class="error">Sorry, you must enter a valid first name and password to log in.</p>';
		}
		mysqli_free_result($result);
		mysqli_close($dbc);
	}  

?>
<!DOCTYPE html>
<head>
	<title>Log in Page</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>

<header>
	<img id="logo" src="logo.jpg" alt="Logo" title="HooHoo">
</header>

<section id="content">
<center>
<p id="intro">
As an user, you are able to look into the database of specific bars. For the purpose of this project, you are able to view
every user's account information through a database. Also if you decided to write a review, the information you write will 
be stored into our database, which it will let others user to see and analyse.
</p>
<?php
	if (isset($_SESSION['first_name'])) {
		echo " <h3> You are logged in as: </h3><p> First Name: ".$_SESSION['first_name']; 
		echo "<center>";
		echo "<p> <a href='logout.php'>Log out </a><br />";
		echo "<p> <a href='main.html'>Website </a><br />";
	}
	else {
		if (isset($first_name)) {
			//testing:
			// user tried but can't log in
			echo "<h3> Could not log you in. Please try again.</h3>";
		} else {
			// user has not tried
			echo " <h3> Log in to become a member </h3> ";
		}
		// Log in form
		
		echo " <form method='post' action='login.php' > ";
		echo " First name <input type='text' name='first_name'> <br /> ";
		echo "<br />";
		echo " Last name <input type='text' name='last_name'> <br /> ";
		echo "<br />";
		echo " Password <input type='password' name='password' /> <br />";
		echo "<br />";
		echo " Age <input type='number' name='age'> <br /> ";
		echo "<br />";
		echo '<input id= "button" type="submit" value="Log In" name="submit" />';
		echo '<button type="button"><a href="signup.php">Sign Up</a></button>';
		echo "</form>";
	}	
?>
</center>
</section>
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
			
		

