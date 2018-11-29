<?php

header("Content-Type: text/html;charset=UTF-8");


// Get data submitted by user
if ( isset( $_POST['submit'] ) ) {

$nameReceived = $_REQUEST['name'];
$messageReceived = $_REQUEST['message'];
$displayForReceived = $_REQUEST['displayFor'];
$date = date('Y-m-d');
}


$servername = "localhost";
$username = "bulletin";
$password = "password";
$dbname = "bulletin";

$mysqli = new mysqli($servername, $username, $password, $dbname);
$mysqli->set_charset("utf8");
$stmt = $mysqli -> prepare('INSERT INTO messages (creator, date_created, display_until, message) VALUES (?, ?, ?, ?)');

if (
	$stmt &&
	$stmt -> bind_param('ssss', $nameReceived, $date, $displayForReceived, $messageReceived) &&
	$stmt -> execute() &&
	$stmt -> affected_rows === 1
) {
	echo 'Message succesfully added';
} else {
	echo 'Error - something went wrong with the SQL thing';
	echo $stmt -> error;
	echo $mysqli -> error;
}

header('Location: index.php');

?>