<?php
	session_start();
	require_once("db_connection.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>Signup to MMI Exotel!</title>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />

<link rel="stylesheet" type="text/css" href="style.css" />

</head>

<body>
	<?php include "top_bar.php"; ?>
	<?php
	if (!isset($_POST['phoneno']))
	{ ?>
	<center>
		<div class="logintab">

			<div class="logintop">User Signup</div>
			<form method="POST" action="signup.php">
					<p class='normal-text'> Please Enter your Phone Number: </p>
					<input class="inputfield" type="text" name="phoneno" maxlength=10  placeholder="Phone Number" required>
				
					<input class="loginbutton" type="submit" value="Next" /> <br/><br/>	
			</form>
		</div>
		<p class="bottom-text">Already have an Account? Click <a href="index.php">here</a> to Login!</p>
	</center>
	<?php
	}
	else
	{
		$phoneno = mysqli_real_escape_string($conn, strval($_POST['phoneno']));
		$query = "Select * from Users where PhoneNo = $phoneno";
		$res = mysqli_query($conn, $query);
		($res ? $count = mysqli_num_rows($res): $count = 0);
		if($count == 1)
		{
			echo "<p id='heading'>An account already exists with the specified Phone Number.<br/>Please click <a href='index.php'>here</a> to login.</p>";
		}
		else
		{?>
			<center>
				<div class="logintab logintab-signup2">

					<div class="logintop">User Signup</div>
					<form method="POST" action="signup2.php">

							<input class="inputfield" type="hidden" name="phoneno" value="<?php echo "$phoneno"; ?>" required />
							
							<input class="inputfield" disabled value='<?php echo "$phoneno" ?>' />
							
							<input class="inputfield" type="text" name="name" placeholder="Name" maxlength=60 required />
							
							<input class="inputfield" type="text" name="address" maxlength=235 placeholder="Address" required />
						
							<input class="inputfield" type="password" placeholder="Enter Password" maxlength=63 name="password" required />
							
							<input class="inputfield" type="password" placeholder="Confirm Password" maxlength=63 name="confirm_password" required />
						
							<input class="loginbutton" type="submit" value="Create Account!" /> <br/><br/>
						
					</form>
				</div>
			</center>		
		<?php
		}
	} ?>
	
</body>
</html>