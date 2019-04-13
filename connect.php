<?php
//Connection
$db=@mysqli_connect('localhost','root','');
if (!$db){
    die("Connection Failed");
	exit();
}

$select_db = mysqli_select_db($db, 'fullstacker');
if (!$select_db){
    die("Database Selection Failed");
	exit();
}
?>