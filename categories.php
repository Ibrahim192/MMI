<?php
	session_start();
	require_once("db_connection.php");
	require_once("functions.php");
	if (isset($_SESSION["phoneno"]))
	{
		$phoneno = $_SESSION["phoneno"];
		$user = $_SESSION["user"];
	}
	else
	{
		redirect("index.php?error_msg=Plese%20Log%20In%20first.");
	}
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />
<title>Subscribe to a New Service!</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<style type="text/css">
.category-block{
	border: 2px solid #2196F3;
	width: 30%;
	float: left;
	display: inline;
	margin: 1.5%;
	padding: 5% 0%;
	text-align: center;
	font-size: 2.3em;
	font-weight: bold;
	color: #2196F3;
}
.height440
{
	height: 440px;
}
</style>
</head>

<body>
	<!-- including the top bar -->
	<?php include 'top_bar.php'; ?>
	
	<ul class="top_nav">
		<li><a href="subscribed.php">Home</a></li>
		<li><a class="active" href="categories.php">New Services</a></li>
		<li><a href="feeds.php">Message Feeds</a></li>
		<li><a class="last-link" href="logout.php">Logout!</a></li>
	</ul>
	
	<div id="heading">
		Click on a Category to <strong>SUBSCRIBE</strong> from
	</div>
	<div class="main-content height440">
		<?php
		$query="Select * from Category";
		$res = mysqli_query($conn, $query);
		($res ? $count = mysqli_num_rows($res): $count = 0);
		if ($count > 0) {
			for($i=0; $i < $count; $i++) {
			?>
				<div class="category-block">
					<?php
					$data = mysqli_fetch_row($res);
					?>
					
					<a href="<?php echo 'choice.php?parent_id='.$data[0];?>"> <?php echo $data[0]." : ".$data[1];?> </a>
				</div>
			<?php }?>
		<?php } else {
			echo "<p id='main_message'>No Categories present in the database</p>";
		} ?>
	</div>
</body>
</html>
