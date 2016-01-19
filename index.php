<?php
	session_start();
	require_once("db_connection.php");
	require_once("functions.php");
	
	if (isset($_SESSION["phoneno"]))
		redirect("subscribed.php");
	
	if (isset($_POST["submit"]))
	{
		// submit button was clicked
		$phoneno = mysqli_real_escape_string($conn, strval($_POST['phoneno']));
		$password = $_POST["password"];
		$query = "SELECT * FROM users WHERE phoneno = $phoneno";
		$res = mysqli_query($conn, $query);
		$user_present = mysqli_fetch_row($res);
		if ($user_present)
		{
			// PhoneNo is present
			if (password_verify($password, $user_present[2]))
			{
				// PhoneNo and password matched
				$_SESSION["phoneno"] = $phoneno;
				$_SESSION["user"] = $user_present[3];
				redirect("subscribed.php");
			}
			else
			{
				// wrong password provided
				$_SESSION["phoneno"] = null;
				redirect("index.php?error_msg=Invalid%20Phone/password%20combination");
			}
		}
		else
		{
			// invalid PhoneNo
			$_SESSION["phoneno"] = null;
			redirect("index.php?error_msg=Invalid%20Phone/password%20combination");
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login to MMI Exotel!</title>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />

<link rel="stylesheet" type="text/css" href="style.css" />

</head>

<body>
	<?php include_once("top_bar.php"); ?>
	
	<center>

		<div class="logintab">

			<div class="logintop">User Login</div>
			<form method="POST" action="index.php">

				<!-- adding a line over here to display error message!!! -->
				<?php 
					if(isset($_GET["error_msg"]))
						echo $_GET["error_msg"];
				?>
					<input class="inputfield" type="text" name="phoneno" maxlength=10 placeholder="Phone Number" required>
				
					<input class="inputfield" type="password" placeholder="Password" name="password" required>
				
					<input class="loginbutton" type="submit" name="submit" value="Log In!" /> <br/><br/>
				
			</form>

		</div>
		<p class="bottom-text">Don't have an Account? Click <a href="signup.php">here</a> to Signup!</p>
	</center>
</body>
</html>