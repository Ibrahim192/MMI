<!DOCTYPE html>
<html>
<head>
<title>Welcome!</title>
<style type="text/css">

body {
	font-family:sans-serif;
}

#Top
{
	width: 120%;
	height: 100px;
	margin: -10px;
	background-color: #000000;
	color: white;
}

#TopText
{
	padding-top:30px;
}

div div div{
	border: 2px solid pink;
	width: 95%;
	float: left;
	margin-left: 30px;
	margin-top: 30px;
	position: relative;
	padding-top: 6%;
	text-align: center;
	font-size: 35px;
	font-weight: bold;
	color: blue;
}

 #categories {
	clear: both;
	margin-top: 30px;
	border: 2px solid red;
	width: 95%;
}

#extra-stuff {
	font-size: 20px;
	color: black;
	font-weight: bold;
	display: inline;
}

</style>
</head>

<body>
	<div id="Top">
		<div id="TopText"><span style="font-size: 35px; padding-left:430px; padding-top:200px;"><strong>WELCOME TO MMI EXOTEL!</strong></span></div>
	</div>
	
	<div>
	<br>
	<a href="logout.php">LogOut</a>
	<div id="categories">
	<?php 
	session_start();
	if(!($u= $_SESSION["user"]))
		header("location:index.php");
	$cat = $_GET['cat'];
	//echo $cat;
	$servername = "localhost";
	$username = "root";
	$password = "";
	$conn = mysql_connect($servername, $username,$password);
	mysql_set_charset('utf8',$conn);
	mysql_select_db('Mmi');
	$res=mysql_query("Select * from SubCat where ParCatId='$cat'");
	
	$count = mysql_num_rows($res);
	for($i=0; $i<$count; $i++)
	{
		?>
		<div>
			<?php 
			$data = mysql_fetch_row($res);
			echo strtoupper($data[2]);
			$res2=mysql_query("select Name,C.CompId from Cat_Comp CC,Company C where C.CompId=CC.CompId and SCat_Id='$data[1]'");
			$cnt2=mysql_num_rows($res2);
			$act = "submit.php?";
			?>
			<form action=submit.php method="get">
			<input type="hidden" name="scat" value="<?php echo $data[1]; ?>">
			<?php
			for($j=0;$j<$cnt2;$j++)
			{
				$rowd=mysql_fetch_row($res2);
				echo "<input type=checkbox name=Company[] value=".$rowd[1].">&nbsp;".$rowd[0]."       ";
			?>
			<span id="extra-stuff">&nbsp;&nbsp;&nbsp;&nbsp;low <input type="radio" name="<?php echo $rowd[1]."priority" ?>" value=0 />
			&nbsp;&nbsp;&nbsp;&nbsp;medium <input type="radio" name="<?php echo $rowd[1]."priority" ?>" value=1 />
			&nbsp;&nbsp;&nbsp;&nbsp;high <input type="radio" name="<?php echo $rowd[1]."priority" ?>" value=2 /> 

			&nbsp;&nbsp;&nbsp;&nbsp;Enter limit: <input style="width:50px" type="number" name="<?php echo $rowd[1]."limit"?>" />
			<br/>
			</span><br/>
			<?php
			}
			?>
			<input type=submit value="Subscribe!"/>
			</form>
		
		</div>
	<?php
	}  ?>
	</div>
	</div>
</body>
</html>															
