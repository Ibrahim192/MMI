<html>
<head>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />
<title>Subscribe to a New Service!</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<style type="text/css">
#categories {
	clear: both;
	margin-top: 30px;
	border: 2px solid red;
	width: 96%;
	margin-left: 2%;
	height: 440px;
}
.category-block{
	border: 2px solid #2196F3;
	height: 100px;
	width: 30%;
	float: left;
	display: inline;
	margin: 1.5%;
	padding-top: 5%;
	text-align: center;
	font-size: 2.3em;
	font-weight: bold;
	color: #2196F3;
}
</style>
</head>

<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$db="Mmi";
$conn = mysqli_connect($servername, $username,$password,$db);
$phoneno=strval($_POST['phoneno']);
$pass=$_POST['password'];
$phoneno=mysqli_real_escape_string($conn,$phoneno);
$pass=mysqli_real_escape_string($conn,$pass);
$query="Select * from Users where PhoneNo='$phoneno' and Password='$pass'";
$res=mysqli_query($conn,$query);
$data=mysqli_fetch_row($res);
if(empty($data))
{
	header("location:index.php?mes=Invalid%20Login.%20Please%20Try%20Again!");
}
else
{
	session_start();
	$_SESSION["user"]=$phoneno;
?>
	<!-- including the top bar -->
	<?php include 'top_bar.php'; ?>
	<a href="feeds.php">Feeds</a>
	<div id="heading">
		Click on a Category to <strong>SUBSCRIBE</strong> from
	</div>
	<div>
		<div id="categories">
			<?php
			$query="Select * from Category";
			$res2 = mysqli_query($conn,$query);
			$count = mysqli_num_rows($res2);	
			for($i=0; $i<$count; $i++) {
			?>
				<div class="category-block">
					<?php
					$data = mysqli_fetch_row($res2);
					?>
					<a href="<?php echo 'choice.php?cat='.$data[0];?>"> <?php echo $data[0]." : ".$data[1];?> </a>
				</div>
			<?php }?>
		</div>
	</div>

<?php
}
mysqli_close($conn);
?>
</body>
</html>
