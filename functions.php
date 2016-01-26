<?php
require_once("db_connection.php");
function redirect($link)
{
	header("Location: ".$link);
	exit;
}

?>