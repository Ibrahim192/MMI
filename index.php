<!DOCTYPE html>
<html>
<head>
<title>Login to MMI Exotel!</title>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />

<link rel="stylesheet" type="text/css" href="style.css" />
<style type="text/css">
#logintab {
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
margin: 25px 15px 0px 15px;
}
#loginbutton {
border: 1px solid rgb(119, 119, 119);
padding: 5px 12px;
border-radius: 5px;
background-color: rgb(221, 221, 221);
}
</style>
</head>

<body>
	<?php include "top_bar.php"; ?>
	
	<center>


		<div id="logintab">

			<div id="logintop">User Login</div>
			<form method="POST" action="categories.php">

				<!-- adding a line over here to display error message!!! -->
				<?php 
					if(isset($_GET["mes"]))
					echo $_GET["mes"];
				?>
					<input class="inputfield" type="text" name="phoneno" style="width:200px;padding:5px;" placeholder="Phone Number" required>
				
					<input class="inputfield" type="password" style="width:200px;padding:5px;" placeholder="Password" name="password" required>
				
					<input class="inputfield" type="submit" value="Log In!" id="loginbutton" /> <br/><br/>
				
			</form>

		</div>
	</center>
</body>
</html>
