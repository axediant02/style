<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<style>
		.container {
			width: 300px;
			margin: 0 auto;
			padding: 20px;
			border: 1px solid #ccc;
			border-radius: 5px;
		}

		.container h2 {
			text-align: center;
		}

		.container form {
			display: flex;
			flex-direction: column;
		}

		.container label {
			margin-bottom: 10px;
		}

		.container input[type="text"],
		.container input[type="password"],
		.container input[type="submit"] {
			padding: 5px;
			margin-bottom: 10px;
		}

		.container input[type="submit"] {
			background-color: #4CAF50;
			color: white;
			cursor: pointer;
		}

		.container a {
			display: block;
			text-align: center;
			margin-top: 10px;
		}
	</style>
</head>
<body>
	<div class="container">
		<?php
		session_start();

		// connect to database im_project
		include 'dbconnect.php';

		// check if the form is submitted
		if(isset($_POST['submit'])) {
			// get the form inputs
			$username = mysqli_real_escape_string($conn, $_POST['username']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);

			// query the users table to check if the username and password match
			$check_user = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$result = mysqli_query($conn, $check_user);

			if(mysqli_num_rows($result) == 1) {
				// user exists, set session variables and redirect to appropriate page
				$user = mysqli_fetch_assoc($result);
				$_SESSION['user_id'] = $user['uid'];
				$_SESSION['username'] = $user['username'];
				$_SESSION['acct_type'] = $user['acct_type'];

				if($user['acct_type'] == 'student') {
					header('Location: student.php');
					exit;
				} elseif($user['acct_type'] == 'teacher') {
					header('Location: teacher.php');
					exit;
				}
			} else {
				// user does not exist or password is incorrect, display error message
				echo 'Invalid username or password. Please try again.';
			}
		}


		// close the database connection
		mysqli_close($conn);
		?>

		<?php
			// check if a session is active
			if (isset($_SESSION['acct_type'])) {
				// redirect the user to the appropriate page based on their role
				if ($_SESSION['acct_type'] == 'student') {
					header('Location: student.php');
					exit();
				} else if ($_SESSION['acct_type'] == 'teacher') {
					header('Location: teacher.php');
					exit();
				}
			}
			// if no session is active, continue with the current page
		?>

		<h2>Login</h2>
		<form method="post" action="">
			<label>Username:</label>
			<input type="text" name="username"><br><br>

			<label>Password:</label>
			<input type="password" name="password"><br><br>

			<input type="submit" name="submit" value="Login">
		</form>

		<a href="register.php">Sign Up</a>
		<!-- <a href="logout.php">logout</a> -->
	</div>
</body>
</html>
