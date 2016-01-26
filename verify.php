<?php
session_start();
	require_once("db_connection.php");
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />
<title>Change Password!</title>

<link rel="stylesheet" type="text/css" href="style.css" />

</head>

<body>

	<?php include 'top_bar.php';
if(isset($_POST["orig"]))
$orig=$_POST["orig"];
if(isset($_POST["otp"]))
$user=$_POST["otp"];
$phone=$_POST["phoneno"];
if(isset($_POST["redirect"]))
{
$password = $_POST['pass1'];
	$confirm_password = $_POST['pass2'];
	
	if ($password != $confirm_password)
	{
		echo "<p id='heading'>Entered passwords don't match. Please try again.</p>";
	}
	else
	{
		$pass = password_hash($password, PASSWORD_BCRYPT);
		$query = "Update Users set Password='$pass' where PhoneNo='$phone'";
		$res = mysqli_query($conn, $query);
		if (empty($res))
		{
			echo "<p id='heading'>Some problem occurred while changing password.<br/> Please try again.</p>";
		}
		else
		{
			echo "<p id='heading'>Congratulations! You have changed your password.<br/>Please click <a href='index.php'>here</a> to login.</p>";
		}
	}
}
else
{
if(strcmp($orig,$user)==0)
{
if(!isset($_SESSION["phoneno"])&&!isset($_POST["changepass"]))
{?>
<center>
				<div class="logintab logintab-signup2">

					<div class="logintop">User Signup</div>
					<form method="POST" action="signup2.php">

							<input class="inputfield" type="hidden" name="phone" value="<?php echo "$phone"; ?>" required />
							
							<input class="inputfield" disabled value='<?php echo "$phone" ?>' />
							
							<input class="inputfield" type="text" name="name" placeholder="Name" maxlength=60 required />
							
							<input class="inputfield" type="text" name="address" maxlength=235 placeholder="Address" required />
							<select class="inputfield" name="Month" required>
								<option value="">Month</option>
			<?php $mon=array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');
			foreach($mon as $key=>$value)
							echo "	<option value='$key'>$value</option>"; ?>
								
							</select>
							<select class="inputfield" name="Day" required>
								<option value="">Day</option>
							<?php	for($i=1;$i<=31;$i++)
									echo "<option value=$i>$i</option>";?>
							</select>  
							<select class="inputfield" name="Year" required>
								<option value="">Year</option>
								<?php for($i=1859;$i<=2016;$i++) echo "<option value='$i'>$i</option>";?>
							</select>
							<input class="inputfield"type=email placeholder="Email" name="Mail" required></input>
							<input class="inputfield" type="password" placeholder="Enter Password" maxlength=63 name="password" required />
							
							<input class="inputfield" type="password" placeholder="Confirm Password" maxlength=63 name="confirm_password" required />
						
							<input class="loginbutton" type="submit" value="Create Account!" /> <br/><br/>
						
					</form>
				</div>
			</center>
<?php
} else
{
echo "<center><form action=verify.php method=post>";
echo"Enter Password : <input type=password name=pass1><br>Confirm Password : <input type=password name=pass2>";
echo "<input type=hidden name=redirect value=1>";
echo "<input type=hidden name=phoneno value='$phone'><br>";
echo "<input type=submit value='Change Password'></form></center>";
}}
else
echo "Invalid Otp!!";
}
?>
