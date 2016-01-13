<html>
<head>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />
<title>insert page</title>
<style type="text/css">

body {
//background-color:#9CC3EC;
background-image: url('bg.jpg');
background-size: 1376px 768px;
font-family:sans-serif;
}


#footer {
clear:both;
text-size:1.2em;
padding-top:70px;
float:right;
position:fixed;
left:0px;
bottom:20px;
width:100%;
text-align:right;
color:white;
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
	height: 100px;
	width: 30%;
	float: left;
	display: inline;
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
	height: 480px;
	width: 95%;
 }
 
 #heading {
	 font-size: 24px;
	 margin-top: 40px;
	 text-align: center;
 }

</style>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$phoneno=strval($_POST['phoneno']);
$pass=$_POST['password'];
$conn = mysql_connect($servername, $username,$password);
mysql_select_db('Mmi');
$phoneno=mysql_real_escape_string($phoneno);
$pass=mysql_real_escape_string($pass);
$res=mysql_query("Select * from Users where PhoneNo='$phoneno' and Password='$pass'");
$data=mysql_fetch_row($res);
if(empty($data))
{
	header("location:index.php?mes=InvalidLogin");
}
else
{
	session_start();
	$_SESSION["user"]=$phoneno;
?>

	<div id="Top">
		<div id="TopText"><span style="font-size: 35px; padding-left:430px; padding-top:200px;"><strong>WELCOME TO Mmi EXOTEL!</strong></span></div>
	</div>
	<div id="heading">
		CLICK ON A CATEGORY TO Subscribe/Unsubscribe FROM
	</div>
	<div>
	<div id="categories">
	<?php 
	$res2 = mysql_query("Select * from Category");
	$count = mysql_num_rows($res2);	
	for($i=0; $i<$count; $i++) {
		?>
		<div>
			<?php
			$data = mysql_fetch_row($res2);
			//$_POST["cat"]=$data[0];
			echo $data[0];
		?>
		<a href="<?php echo 'choice.php?cat='.$data[0];?>"><?php echo $data[1];?></a>
			
		</div>
	<?php }?>
	</div>
	</div>

<?php
}

mysql_close($conn);
?>
</body>
</html>
