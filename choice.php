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
		$pri = $_POST["pri"];
		$lim =$_POST["lim"];
		$compid = $_POST["compid"];
		$catid = $_POST["catid"];
		$compname = $_POST["compname"];
		$catname = $_POST["catname"];
		if ($_POST["submit"] == "Subscribe!")
		{
			$_SESSION["subs_msg"] = "You have been successfully subscribed to <b> ".$compname." </b> for <b>".$catname."</b>";
			$subs_query = "Insert into Subscribers values ($phoneno, '$compid', '$catid', '$pri', '$lim', '$lim')";
			$subs_res = mysqli_query($conn, $subs_query);
		}	
		else if ($_POST["submit"] == "Update!")
		{
			$_SESSION["subs_msg"] = "Your subscription to <b> ".$compname." </b> for <b>".$catname."</b> has been updated";
			$update_query = "Update Subscribers Set Priority='$pri', lim='$lim', currlim='$lim' where PhoneNo='$phoneno' and CompId='$compid' and CatId='$catid'";
			$update_res = mysqli_query($conn, $update_query);
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Subscribe!</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
	<?php include 'top_bar.php' ?>
	
	<ul class="top_nav">
		<li><a href="subscribed.php">Home</a></li>
		<li><a href="categories.php">New Services</a></li>
		<li><a href="feeds.php">Message Feeds</a></li>
		<li><a href="accounts.php">Accounts</a></li>
		<li><a class="last-link" href="logout.php">Logout!</a></li>
	</ul>
	
	<?php if (isset($_SESSION['subs_msg'])) { ?>
		<p class="big-text"><?php echo $_SESSION["subs_msg"] ?></p>
	<?php
		$_SESSION["subs_msg"] = null;
	
	} ?>

	<div id="categories">
	<?php 
	if (isset($_GET['parent_id']))
		$parent_id = $_GET['parent_id'];
	else
		$parent_id = $_POST['parent_id'];
	//To fetch SubCategories of Main Caterory
	$query = "Select * from SubCat where ParCatId = '$parent_id'";
	$res = mysqli_query($conn, $query);
	($res ? $count = mysqli_num_rows($res): $count = 0);
	//Fetch SubCategories one after other if present
	for($i=0; $i < $count; $i++)
	{
		?>
		<div class="subcategory-block">
			<?php 
			$data = mysqli_fetch_row($res);
			echo strtoupper($data[2]);//To display SubCategory Name
			$query = "Select Name, C.CompId from Cat_Comp CC, Company C where C.CompId = CC.CompId and SCat_Id = '$data[1]'";
			$res2 = mysqli_query($conn, $query);
			$cnt2 = mysqli_num_rows($res2);
			//List out companies providing services for a subcategory
			for($j=0; $j < $cnt2; $j++)
			{
			?>
			<form action="choice.php" method="post" >
				<?php
					$rowd = mysqli_fetch_row($res2);
					//Fetch only subscribed company's messages
					$query = "Select * from Subscribers where PhoneNo='$phoneno' and CompId='$rowd[1]' and CatId='$data[1]'";
					$res3 = mysqli_query($conn, $query);
					$cnt3 = mysqli_num_rows($res3);
					echo $rowd[0]."       ";
				?>
				<span id="extra-stuff">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Low <input type="radio" name="pri" value=0 required />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Medium <input type="radio" name="pri" value=1 checked="checked" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				High <input type="radio" name="pri" value=2 />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

				Enter Limit: <input style="width:50px" type="number" min=0 name="lim" value=5 required />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</span>
				<!--sending data for subscription-->
				<input type="hidden" name="compid" value="<?php echo $rowd[1] ?>" />
				<input type="hidden" name="compname" value="<?php echo $rowd[0] ?>" />
				<input type="hidden" name="catid" value="<?php echo $data[1] ?>" />
				<input type="hidden" name="catname" value="<?php echo $data[2] ?>" />
				<input type="hidden" name="parent_id" value="<?php echo $parent_id ?>" />
				<?php
					if($cnt3>0)
					{
				?>
				<input class="submit-button" type="submit" name="submit" value="Update!" /><br/>
				<?php
				}
				else
				{
					?>
				<input class="submit-button" type="submit" name="submit" value="Subscribe!"/><br/>
				<?php
				} ?>
			</form>
			<?php
			}		
			?>
		</div>
	<?php
	}  ?>
	</div>
</body>
</html>
