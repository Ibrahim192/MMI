<!DOCTYPE html>
<html>
<head>
<title>Subscribe!</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<style type="text/css">
#categories {
	clear: both;
	margin-top: 30px;
	border: 2px solid red;
	width: 96%;
	margin-left: 2%;
	height: 900px;
}
.subcategory-block{
	border: 2px solid #2196F3;
	width: 95%;
	float: left;
	margin: 2%;
	position: relative;
	padding-top: 6%;
	padding-bottom: 1%;
	text-align: center;
	font-size: 2.3em;
	font-weight: bold;
	color: #2196F3;
}
#extra-stuff {
	font-size: 0.6em;
	color: black;
	font-weight: bold;
	display: inline;
}
</style>
</head>

<body>
	<?php include 'top_bar.php' ?>
	
	<ul class="top_nav">
		<li><a href="subscribed.php">Home</a></li>
		<li><a href="categories.php">New Services</a></li>
		<li><a href="feeds.php">Message Feeds</a></li>
		<li><a class="last-link" href="logout.php">Logout!</a></li>
	</ul>
	
	<div>
	<br/>
	<div id="categories">
	<?php 
	session_start();
	if(!($u= $_SESSION["user"]))
		header("location:index.php?Please%20Login");
	$cat = $_GET['cat'];
	//echo $cat;
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db="Mmi";
	$conn = mysqli_connect($servername, $username,$password,$db);
	$query="Select * from SubCat where ParCatId='$cat'";
	$res=mysqli_query($conn,$query);
	$count = mysqli_num_rows($res);
	for($i=0; $i<$count; $i++)
	{
		?>
		<div class="subcategory-block">
			<?php 
			$data = mysqli_fetch_row($res);
			echo strtoupper($data[2]);
			$query="select Name, C.CompId from Cat_Comp CC, Company C where C.CompId=CC.CompId and SCat_Id='$data[1]'";
			$res2=mysqli_query($conn,$query);
			$cnt2=mysqli_num_rows($res2);
			?>
			<form action="submit.php" method="get">
				<input type="hidden" name="scat" value="<?php echo $data[1]; ?>">
				<?php
				for($j=0;$j<$cnt2;$j++)
				{
					$rowd=mysqli_fetch_row($res2);
					echo "<input type=checkbox name=Company[] value=$rowd[1] />&nbsp;".$rowd[0]."       ";
				?>
				<span id="extra-stuff">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Low <input type="radio" name="<?php echo $rowd[1]."priority" ?>" value=0 required />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Medium <input type="radio" name="<?php echo $rowd[1]."priority" ?>" value=1 />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;High <input type="radio" name="<?php echo $rowd[1]."priority" ?>" value=2 /> 

				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Enter Limit: <input style="width:50px" type="number" min=0 name="<?php echo $rowd[1]."limit"?>" required />
				<br/>
				</span>
				<?php
				}
				?>
				<input type=submit value="Subscribe!"/><br/>
			</form>
		
		</div>
	<?php
	}  ?>
	</div>
	</div>
</body>
</html>
