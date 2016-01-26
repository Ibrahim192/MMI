<?php
	session_start();
	require_once("db_connection.php");
	require_once("functions.php");
	//Forgot Password-- after submitting number
	if(isset($_POST["To"]))
	{
		$to=$_POST["To"];
		$query="Select 1 from Users where PhoneNo='$to'";
		$res=mysqli_query($conn,$query);
		//Phone Number
		if(empty(mysqli_fetch_row($res)))
			unset($_POST["To"]);
		else
		{
			$str='To='.$to.'&From=admin&otp=1';
		}
	}
	//Change Password
	else if(isset($_SESSION["phoneno"]))
	{
		$phoneno=$_SESSION["phoneno"];
		$str='To='.$phoneno.'&From=Admin&otp=1';
	}
?>
<!DOCTYPE html>
<html>
<head>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
//limit for otp submission
function timer()
{
 window.location.assign("index.php?err_msg=TIMEOUT");
}
function sendotp()
{
	var mes=<?php echo json_encode($str); ?>;
	var xhr=new XMLHttpRequest();
	setTimeout(timer,600000);
	xhr.onreadystatechange=function()
	{
		//Process response from server.. 
		if(xhr.readyState==4&&xhr.status==200)
		{
			var res=xhr.responseText;
			document.getElementById("demo").innerHTML=res;
			var  parser, xmlDoc;
			parser = new DOMParser();
			xmlDoc = parser.parseFromString(res,"text/xml");
			var ab=xmlDoc.getElementsByTagName("SMSMessage");
			var xyz=" ";
			Body=xmlDoc.getElementsByTagName("Body")[0].childNodes[0].nodeValue;
				To=xmlDoc.getElementsByTagName("To")[0].childNodes[0].nodeValue;
			//Form to take otp
			var xyz="<center><form action='verify.php' method=post>Enter OTP within 10 minutes :<input type=text name=otp><br><input type=hidden name=orig value="+Body+"><input type=hidden name=phoneno value="+To+"><input type=hidden name=changepass value=1><input type=submit value='submit'></form></center>";
				document.getElementById("demo").innerHTML=xyz;
		}
	};
  	xhr.open("GET","return.php?"+mes, true);
  	xhr.send();
	return false;
}
</script>
<title>Forgot Password!</title>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />

<link rel="stylesheet" type="text/css" href="style.css" />

</head>

<body>
	
	<?php include_once("top_bar.php");
	//after PhoneNo submitted (forgot password) or change password!!
		if((isset($_POST["To"]))||isset($phoneno))
		{?>
			<script>sendotp();</script>	
			<p id="demo"></p>
		<?php } 
		else{ ?>
			<!--Enter Number to obtain otp form-->
			<br><br><center>
			<b>Enter your Phone No:</b>
			<form method="post" id="gen">
				<input type="hidden" name="otp" value=1>
				<input type="text" name="To" required/><br><br>
				<div class="g-recaptcha" data-sitekey="6LcePAATAAAAAGPRWgx90814DTjgt5sXnNbV5WaW"></div>
				<input type=submit value="Submit"/><br/>
			</form>
			</center>
	<?php } ?>
</body>
</html>
