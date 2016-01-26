<?php
	session_start();
	require_once("db_connection.php");
	require_once("functions.php");
	//Company redirection Home page
	if(isset($_SESSION["cid"]))
	{
		$cid=$_SESSION["cid"];
	}
	//Login form submission case
	if(isset($_POST["submit"]))
	{
		$cid=$_POST["cid"];
		$pass=$_POST["password"];
		$cid=mysqli_real_escape_string($conn,$cid);
		$pass=mysqli_real_escape_string($conn,$pass);
		$query="Select 1 from Company where CompId='$cid' and Password='$pass'";
		$res=mysqli_query($conn,$query);
		$data=mysqli_fetch_row($res);
		if(empty($data))
			redirect("companies.php?error_msg=Invalid Password/CompId combo");
		else
		{
			$_SESSION["cid"]=$_POST["cid"];
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
	<?php include_once("top_bar.php");
		
	?>


	<?php
		//Display Add services/Send Message feature if logged in first time or redirected to home page
		if(isset($_POST["submit"])||isset($_SESSION["cid"]))
		{
			echo "<a href=logout.php id='comp' style='color:orange'>LogOut</a><center>";
			if(isset($_GET["success"]))
				echo $_GET['success'];
			//form display for sending message
			echo "</center><div style='float:left;padding:20px;padding-right:180px'><h1>Send Message</h1><form method=post action=notify.php>
				<input type='hidden' name = 'cid' value='$cid' /><br/><br/>
				<span class='label-text'>Sub Cat:</span> 	 
				<select name='catid' required >
				<option value=''>Select</option>";
				$query="select s.SubCat_id, s.Name from SubCat s, Cat_Comp c where '$cid' = c.CompId and c.scat_id = s.SubCat_id";
			$res = mysqli_query($conn,$query);
			$count = mysqli_num_rows($res);
			for($i=0; $i<$count; $i++)
			{
				$data = mysqli_fetch_row($res);
		?> 
				<option  name="<?php echo $data[0]?>" value = "<?php echo $data[0] ?>" > <?php echo $data[0]." : ".$data[1] ?> </option>
	<?php } ?>
	</select>
	<br/>
	<br/>
	<br/>
	<span class='label-text'>Please enter your message below: </span> <br/>
	<textarea style="margin-top:5px;" name="msg" rows=7 cols=45 maxlength=150 placeholder="Type your message here" required></textarea>
	<br/><br/><br/>
	<span class='label-text'>Select Priority:</span> &nbsp;&nbsp;&nbsp;&nbsp;<span class='label-text'>Low </span> <input type="radio" name="priority" value=0 required />
	&nbsp;&nbsp;&nbsp;&nbsp; <span class='label-text'>Medium </span> <input type="radio" name="priority" value=1 />
	&nbsp;&nbsp;&nbsp;&nbsp;<span class='label-text'>High</span> <input type="radio" name="priority" value=2 />
	<br/><br/><br/>
	<input class="submit-button" type="submit" value = "Send Message!" />
</form> </div>
	<?php 
		//Add services
		$query="Select Name, SubCat_id from SubCat where SubCat_id not in (select SCat_Id from Cat_Comp where CompId='$cid')";
		$res=mysqli_query($conn,$query);
		$count=mysqli_num_rows($res);
		echo "<div style='float:left;padding:50px;'><h1>Add Services</h1><form action=newserve.php>";
		for($i=0;$i<$count;$i++)
		{
			$data=mysqli_fetch_row($res);
			echo "<input type=checkbox name=serve[] value='$data[1]'>".$data[0]."<br>";
		}
			echo "<input type=submit value='Add Services'></form></div>";
		} else{ ?><!-- first time logged in!! -->
	<center>

		<div class="logintab">

			<div class="logintop">Company Login</div>
			<form method="POST" action="companies.php">

				<!-- adding a line over here to display error message!!! -->
				<?php 
					if(isset($_GET["error_msg"]))
						echo $_GET["error_msg"];
				?>
					<input class="inputfield" type="text" name="cid" maxlength=10 placeholder="Company ID" required>
				
					<input class="inputfield" type="password" placeholder="Password" name="password" required>
				
					<input class="loginbutton" type="submit" name="submit" value="Log In!" /> <br/><br/>
				
			</form>

		</div>
		
	</center><?php } 
			
			?>
</body>
</html>
