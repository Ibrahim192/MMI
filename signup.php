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
		$servername = "localhost";
		$username = "root";
		$password = "";
		$db="Mmi";
		$conn = mysqli_connect($servername, $username,$password, $db);
		$phoneno=strval($_POST['phoneno']);
		$phoneno=mysqli_real_escape_string($conn,$phoneno);
		$query="Select * from Users where PhoneNo='$phoneno'";
		$res=mysqli_query($conn,$query);
		$data=mysqli_fetch_row($res);
		
		if(!empty($data))
		{
			echo "<p id='heading'>An account already exists with the specified Phone Number.<br/>Please click <a href='index.php'>here</a> to login.</p>";
		}
		else
		{?>
			<center>
				<div class="logintab logintab-signup2">

					<div class="logintop">User Signup</div>
					<form method="POST" action="signup2.php">

							<input class="inputfield" name="phoneno" value=<?php echo "$phoneno"?> required>
							
							<input class="inputfield" type="text" name="nam" placeholder="Name" maxlength=60 required />
							
							<input class="inputfield" type="text" name="address" maxlength=235 placeholder="Address" required />
						
							<input class="inputfield" type="password" placeholder="Enter Password" maxlength=63 name="password" required>
							
							<input class="inputfield" type="password" placeholder="Confirm Password" maxlength=63 name="confirm_password" required>
						
							<input class="loginbutton" type="submit" value="Create Account!" /> <br/><br/>
						
					</form>
				</div>
			</center>		
		<?php
		}
	} ?>
	
</body>
</html>