<?php

header("Content-Type: text/html;charset=UTF-8");


// Get data submitted by user
if ( isset( $_POST['submit'] ) ) {
$msg_id = $_REQUEST['msg_id'];
}


$servername = "localhost";
$username = "bulletin";
$password = "password";
$dbname = "bulletin";

$mysqli = new mysqli($servername, $username, $password, $dbname);
$stmt = $mysqli -> prepare('DELETE FROM messages WHERE msg_id=?');

if (
	$stmt &&
	$stmt -> bind_param('i', $msg_id) &&
	$stmt -> execute() &&
	$stmt -> affected_rows === 1
) {
	echo 'Message succesfully deleted';
} else {
	echo 'Error - something went wrong with the SQL thing';
	echo $stmt -> error;
	echo $mysqli -> error;
}

header('Location: index.php');

?>