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
		//after having entered phoneno, verification!!
		$phone=$_POST['phoneno'];
		$str="From=Admin&otp=1&To=".$phone;
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
			<script>
				//timer for otp
				function timer()
				{
 					window.location.assign("index.php?err_msg=TIMEOUT");
				}
				//code to process response after otp has been sen
				var mes=<?php echo json_encode($str); ?>;
				var xhr=new XMLHttpRequest();
				setTimeout(timer,600000);
				xhr.onreadystatechange=function()
				{

					if(xhr.readyState==4&&xhr.status==200)
					{
																	
						var  parser, xmlDoc;
						var res=xhr.responseText;
						parser = new DOMParser();
						xmlDoc = parser.parseFromString(res,"text/xml");
						var ab=xmlDoc.getElementsByTagName("SMSMessage");
						var Body=xmlDoc.getElementsByTagName("Body")[0].childNodes[0].nodeValue; // For otp
						var To=xmlDoc.getElementsByTagName("To")[0].childNodes[0].nodeValue; // Sender
						var xyz="<center><form action='verify.php' method=post>Enter OTP within 10 minutes :<input type=text name=otp><br><input type=hidden name=orig value="+Body+"><input type=hidden name=phoneno value="+To+"><input type=submit value='submit'></form></center>";// code for form to enter otp 
						document.getElementById("demo").innerHTML=xyz;
		}

	};
  	xhr.open("GET","return.php?"+mes, true);
  	xhr.send();
			</script>
			<p id="demo"><!-- otp form code here!! passed to verify.php for verification--></p>		
		<?php
		}
	} ?>
	
</body>
</html>
