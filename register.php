<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
	<link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>
	<div class="container">
		<h1>Registration Form</h1>
		<form action="register.php" method="post">
			<div class="form-group">
				<label for="firstname">First Name:</label>
				<input type="text" name="firstname" required>
			</div>

			<div class="form-group">
				<label for="lastname">Last Name:</label>
				<input type="text" name="lastname" required>
			</div>

			<div class="form-group">
				<label for="username">Username:</label>
				<input type="text" name="username" required>
			</div>

			<div class="form-group">
				<label for="password">Password:</label>
				<input type="password" name="password" required>
			</div>

			<div class="form-group">
				<label for="acct_type">Account Type:</label>
				<select name="acct_type" id="acct_type" required>
					<option value="">-- Select Account Type --</option>
					<option value="student">Student</option>
					<option value="teacher">Teacher</option>
				</select>
			</div>

			<div class="form-group" id="course_field" style="display: none;">
				<label for="course">Course:</label>
				<input type="text" name="course">
			</div>

			<div class="form-group" id="subject_field" style="display: none;">
				<label for="subject">Subject:</label>
				<select name="subject" id="subject">
					<option value="">-- Select Subject --</option>
					<!-- PHP code to retrieve subjects from database and populate the dropdown menu -->
				</select>
			</div>

			<div class="form-group">
				<input type="submit" name="submit" value="Register">
			</div>
		</form>

		<a href="index.php">Login</a>
	</div>

	<script>
		document.getElementById("acct_type").addEventListener("change", function() {
			if (this.value == "student") {
				document.getElementById("course_field").style.display = "block";
				document.getElementById("subject_field").style.display = "none";
			} else if (this.value == "teacher") {
				document.getElementById("course_field").style.display = "none";
				document.getElementById("subject_field").style.display = "block";
			} else {
				document.getElementById("course_field").style.display = "none";
				document.getElementById("subject_field").style.display = "none";
			}
		});
	</script>
</body>
</html>
