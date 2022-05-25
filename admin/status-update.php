<?php
session_start();
include('include/config.php');

if (isset($_GET['status']) && isset($_GET['o_id'])) {
	$updateSqlQry="UPDATE `orders` SET `o_status` = '".$_GET['status']."' WHERE `o_id` = ".$_GET['o_id'].";";
	$query=mysqli_query($con,$updateSqlQry);
	if ($query) {
		echo "true";
	}else{
	echo "true";
	}
}
?>