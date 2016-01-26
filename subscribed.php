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
	if (isset($_POST["submit"]))
	{
		$compid = $_POST["compid"];
		$catid = $_POST["catid"];
		$compname = $_POST["compname"];
		$catname = $_POST["catname"];
		$unsubs_query = "DELETE FROM Subscribers WHERE PhoneNo=$phoneno AND CompId=$compid AND CatId=$catid";
		$unsubs_result = mysqli_query($conn, $unsubs_query);
		if (!$unsubs_result)
			echo "<p id='heading'>There was some problem while unsubscribing.<br/>Please try again.</p>";
		else
			$_SESSION["unsubs_msg"] = "You have successfully been <b>UNSUBSCRIBED</b> from <b>".strtoupper($compname)."</b> for <b>".strtoupper($catname)."<br/>";
	}
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />
<title>Your Subscribed Services!</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<style type="text/css">

</style>
</head>

<body>
	<!-- including the top bar -->
	<?php include 'top_bar.php'; ?>
	
	<ul class="top_nav">
		<li><a class="active" href="subscribed.php">Home</a></li>
		<li><a href="categories.php">New Services</a></li>
		<li><a href="feeds.php">Message Feeds</a></li>
		<li><a href="accounts.php">Accounts</a></li>
		<li><a class="last-link" href="logout.php">Logout!</a></li>
	</ul>
	
	<div id="heading">
		Here are the services that you have Subscribed for
	</div>
	
	<?php
		if (isset($_SESSION["unsubs_msg"]))
		{
			echo "<p class='big-text'>".$_SESSION["unsubs_msg"]." </p>";
			$_SESSION["unsubs_msg"] = null;
		}
	?>
	
	<div class="main-content">
		<?php
		$query = "Select * from Subscribers where PhoneNo = $phoneno";
		$res = mysqli_query($conn, $query);
		($res ? $count = mysqli_num_rows($res): $count = 0);
		if (!$count)
			echo "<span id='main_message'><center>You haven't subscribed to any services yet. <br/> Click <a href='categories.php'>here</a> to subscribe</center></span>";
		else
		{
			$i=0;
			for($i=0; $i < $count; $i++)
			{
				$row = mysqli_fetch_row($res);
				$query="Select Name from Company where CompId = '$row[1]'";
				$company = mysqli_query($conn, $query);
				$company_res = mysqli_fetch_row($company);
				$query = "Select Name from SubCat where SubCat_id = '$row[2]'";
				$category = mysqli_query($conn, $query);
				$category_result = mysqli_fetch_row($category);
				$priority = "";
				switch($row[3])
				{
					case 0:
						$priority = 'Low';
						break;
					case 1:
						$priority = 'Medium';
						break;
					case 2:
						$priority = 'High';
						break;
				}
				?>
		<div class="subscribe">
				
					<div class="subs-company"><?php echo "$company_res[0]" ?></div>
					<div class="subs-priority"><?php echo "$priority" ?></div>
					<div class="subs-category"><?php echo "$category_result[0]" ?></div>
					<div class="subs-lim"><?php echo $row[5]-$row[4]."/$row[5]&nbsp; Msg Sent" ?></div>
					<form method="POST" action="subscribed.php">
						<input type="hidden" name="compid" value="<?php echo $row[1]; ?>" />
						<input type="hidden" name="catid" value="<?php echo $row[2]; ?>" />
						<input type="hidden" name="compname" value="<?php echo $company_res[0]; ?>" />
						<input type="hidden" name="catname" value="<?php echo $category_result[0]; ?>" />
						<input type="submit" name="submit" value="Unsubscribe!" class="subs-unsubscribe" />
					</form>
				</div>
			<?php
			}
		} ?>
	</div>
</body>
</html>
