<!DOCTYPE html>
<html>
<head>
<title>Login to MMI Exotel!</title>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />

<link rel="stylesheet" type="text/css" href="style.css" />

</head>

<body>
	<?php include "top_bar.php"; ?>
	
	<center>


		<div class="logintab">

			<div class="logintop">User Login</div>
			<form method="POST" action="categories.php">

				<!-- adding a line over here to display error message!!! -->
				<?php 
					if(isset($_GET["mes"]))
					echo $_GET["mes"];
				?>
					<input class="inputfield" type="text" name="phoneno" maxlength=10 placeholder="Phone Number" required>
				
					<input class="inputfield" type="password" placeholder="Password" name="password" required>
				
					<input class="loginbutton" type="submit" value="Log In!" /> <br/><br/>
				
			</form>

		</div>
		<p class="bottom-text">Don't have an Account? Click <a href="signup.php">here</a> to Signup!</p>
	</center>
</body>
</html>