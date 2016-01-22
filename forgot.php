<?php
	session_start();
	require_once("db_connection.php");
	require_once("functions.php");
?>
<!DOCTYPE html>
<html>
<head>
<script src='https://www.google.com/recaptcha/api.js'></script>
<title>Forgot Password!</title>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />

<link rel="stylesheet" type="text/css" href="style.css" />

</head>

<body>
	<?php include_once("top_bar.php"); ?>
	<br><br>
	
	<center>
	<b>Enter your Phone No:</b>
	<form method="post" action="relogin.php">
		<input type="text" name="To" required/><br><br>
		<div class="g-recaptcha" data-sitekey="6LcePAATAAAAAGPRWgx90814DTjgt5sXnNbV5WaW"></div>
		<input type=submit value="Submit"/><br/>

	</form>
	</center>
</body>
</html>
	
