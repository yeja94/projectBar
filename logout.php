<?php
	session_start();
	$first_name = $_SESSION['first_name'];
	unset($_SESSION['first_name']);
	session_destroy();
?>
<html>
<head>
	<title>You are log out</title>
    <link rel="stylesheet" href="main.css">
</head>
<nav id="main">
	<ul class="horizontal">
		<li><a href="login.php">Log in</a></li>
		<li><a href="signup.php">Sign Up</a></li>
	</ul>
</nav>
<body>
	<section id="content">
	<header>
	<h1> Log Out Page</h1>
	</header>
	<center>
	<?php
		if (!empty($first_name)) {
			echo '<p>'.$first_name.' is logged out</p>';
			echo '<p> Sign up or Log Back in above!<p>';
		} else {
			echo '<p> You were not logged in!<p>';
			echo '<p> Click Sign up or Log Back in above!<p>';
		}
	?>
	
	</center>
	</section>
</body>
</html>

