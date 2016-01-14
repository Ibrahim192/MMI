<!DOCTYPE html>
<html>
<head>
<title>Login to MMI Exotel!</title>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />
<style type="text/css">

body {
font-family:sans-serif;
margin: 0px;
}

#logintab {
top: 400px;
font-size:1.2em;
border-radius:5px;
border: 2px solid black;
background-color:#E8E8E8;
width: 23%;
margin-top: 150px;
}

#logintop {
padding: 10px;
border-radius: 5px 5px 0px 0px;
border-bottom: 1px solid rgb(170, 170, 170);
background-color: rgb(205, 205, 205);
}

.inputfield {
margin: 20px 15px;
}

#loginbutton {
border: 1px solid rgb(119, 119, 119);
padding: 5px 12px;
border-radius: 5px;
background-color: rgb(221, 221, 221);
}

#Top
{
	// width: 120%;
	// margin: -10px;
	height: 100px;
	background-color: #000000;
	color: white;
}

#TopText
{
	padding-top:30px;
	font-size: 35px;
	text-align: center;
}

</style>
</head>
<body>
	<div id="Top">
		<div id="TopText"><strong>WELCOME TO MMI EXOTEL!</strong></div>
	</div>
	
	<center>
<!-- adding a line over here to display error message!!! -->
		<?php 
			if(isset($_GET["mes"]))
			echo $_GET["mes"];
		?>

		<div id="logintab">

			<form method="POST" action="categories.php">

				<div id="logintop">User Login</div>

				<div class="inputfield">
					<input type="text" name="phoneno" style="width:200px;padding:5px;" placeholder="Phone Number" required>
				</div>
			  
				<div class="inputfield">
					<input type="password" style="width:200px;padding:5px;" placeholder="Password" name="password" required>
				</div>
				
				<div class="inputfield">
					<input type="submit" value="Log In!" id="loginbutton" />
				</div>
			</form>

		</div>
	</center>
</body>
</html>															
