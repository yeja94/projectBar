<!DOCTYPE html>
<html>
<head>
	<title>Student Information Page</title>
</head>

<body>
<?php
  require_once('connectvarsEECS.php');
  // Connect to the database
  $dbc = mysqli_connect('mysql.cs.orst.edu', 'cs340_yeja', '5271', 'cs340_yeja');

  if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $sid = mysqli_real_escape_string($dbc, trim($_POST['sid']));
    $first_name = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
    $last_name = mysqli_real_escape_string($dbc, trim($_POST['last_name']));	
	$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
	$major = mysqli_real_escape_string($dbc, trim($_POST['major']));
	$birthdate = mysqli_real_escape_string($dbc, trim($_POST['birthdate']));
	/*
	$department =  mysqli_real_escape_string($dbc, trim($_POST['department']));	
	$course_number =  mysqli_real_escape_string($dbc, trim($_POST['course_number']));
	$term =  mysqli_real_escape_string($dbc, trim($_POST['term']));
	*/
	if (!empty($sid)){
      // Make sure someone isn't already registered using this student id.
      $query = "SELECT * FROM Student WHERE sid = '$sid'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {
        // The sid is unique, so insert the data into the database
        $query = "INSERT INTO Student(sid, first_name, last_name, email, major, birthdate)
		VALUES ('$sid', '$first_name', '$last_name', '$email', '$major', '$birthdate')";
        mysqli_query($dbc, $query);

        // Confirm success with the user
        echo "Your student information has been successfully created.";
        mysqli_close($dbc);
		echo '<br/ >';
		echo '<a href="enroll.php"><button>Enrol for Courses</button></a>';
        exit();
		
		}
	}
    else {
		echo "You must enter all of the sign-up data.";
	}
   }
   
  mysqli_close($dbc);
?>

<p>Please enter your student information to be submitted into the data .</p>
  <form method="post" action="/~yeja/web/cs340/homework3/sign_up.php">
    <fieldset>
		  <legend>Input Student ID to show his/her info</legend>
		  <br/>
		  <label for="sid">Student ID:</label>
		  <input type="text" id="sid" name="sid" /><br/>
		  <br/>
		  <label for="first_name">First name:</label>
		  <input type="text" id="first_name" name="first_name" /><br />
		  <br/>
		  <label for="last_name">Last name:</label>
		  <input type="text" id="last_name" name="last_name" /><br /> 
		  <br />
		  <label for="age">Major:</label>
		  <input type="text" id="major" name="major" /><br/>
		  <br />
		  <label for="email">Email:</label>
		  <input type="text" id="email" name="email" /><br />
		  <br />
		  <label for="birthdate">Birthdate:</label>
		  <input type="date" id="birthdate" name="birthdate" /><br />
		  <br />
		<input type="submit" value="Sign Up" name="submit" />
	 </fieldset>
  </form>
<p>After you successfully registered, you can enrol for classes</p>
  </body>
  </html>