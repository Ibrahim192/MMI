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
	foreach($_GET['Company'] as $selected){
		$scat=$_GET['scat'];
		$query = "Select Name from Company where CompId = '$selected'";
		$res1 = mysqli_query($conn, $query);
		$data1 = mysqli_fetch_row($res1);
		$query = "Select Name from SubCat where SubCat_id='$scat'";
		$res2 = mysqli_query($conn, $query);
		$data2 = mysqli_fetch_row($res2);

		echo "Successfully subscribed to <strong>".$data1[0]."</strong> for <strong>".$data2[0]."</strong>!! :)";
		$pri = $_GET[$selected."priority"];
		$lim = $_GET[$selected."limit"];
		$query="Insert into Subscribers values ($phoneno, '$selected', '$scat', '$pri', '$lim', '$lim') ";
		$res = mysqli_query($conn, $query);
	}
?>
