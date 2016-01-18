<html>
<head>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />
<title>Your Subscribed Services!</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<style type="text/css">

</style>
<script type="text/javascript">
function redirect($catid)
{
	alert("going away");
    window.location="unsubs.php?catid=$catid";
}

</script>
</head>

<body>
	<!-- including the top bar -->
	<?php include 'top_bar.php'; ?>
	
	<ul class="top_nav">
		<li><a class="active" href="subscribed.php">Home</a></li>
		<li><a href="categories.php">Subscribe to New Service</a></li>
		<li><a href="feeds.php">Message Feeds</a></li>
		<li><a class="last-link" href="logout.php">Logout!</a></li>
	</ul>
	
	<div id="heading">
		Here are the services that you have Subscribed for
	</div>
	
	<div class="main-content">
		<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$conn = mysql_connect($servername, $username,$password);
		mysql_set_charset('utf8',$conn);
		mysql_select_db('Mmi');
		
		session_start();
		if(!$_SESSION["user"])
			header("location:index.php");
		$su=$_SESSION["user"];

		$res = mysql_query("Select * from subscribers where PhoneNo = '$su'");
		$count = mysql_num_rows($res);
		if (!$count)
			echo "<span id='main_message'><center>You haven't subscribed to any services yet. <br/> Click <a href='categories.php'>here</a> to subscribe</center></span>";
		else
		{
			$i=0;
			for($i=0; $i<$count; $i++)
			{
				$row = mysql_fetch_row($res);
				$company = mysql_query("Select Name from company where compid = '$row[1]'");
				$company_res = mysql_fetch_row($company);
				$category = mysql_query("Select Name from subcat where subcat_id = '$row[2]'");
				$category_result = mysql_fetch_row($category);
				$priority;
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
					<div class="subs-lim">Msg Sent/Total Msg : <?php echo $row[5]-$row[4]."/$row[5]" ?></div>
					<input type="button" value="Unsubscribe!" class="subs-unsubscribe" onclick="redirect($res[2])" />
				</div>
			<?php
			}
		} ?>
	</div>
</body>
</html>