<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bulletin Board</title>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <link rel="stylesheet" href="css/formPageStyle.css" />
</head>
<body>
  
<form autocomplete="off" action="submitNewMessage.php" class="form-container" method="post" style="width: 30%">
<div class="form-title"><h2>Add Message</h2></div>
<div class="form-title">Name</div>
<input required autofocus class="form-field" type="text" name="name" style="width: 80%" /><br />
<div class="form-title">Message (1000 characters max)</div>
<input required class="form-field" type="text" name="message" style="width: 80%"/><br />
<div class="form-title">Display until:</div>
<input required class="form-field" type="date" name="displayFor" /><br />
<div class="submit-container">
<input class="submit-button" type="submit" value="Submit" name="submit" />
</div>
</form>


<form autocomplete="off" action="deleteMessage.php" class="form-container" method="post" style="width: 30%">
<div class="form-title"><h2>Delete Message</h2></div>
<div class="form-title">msg_id:</div>
<input required class="form-field" type="text" name="msg_id" style="width: 150px"/><br />
<div class="submit-container">
<input class="submit-button" type="submit" value="Delete" name="submit" />
</div>
</form>

<br />
<br />

<div style="text-align: center; margin: 0 auto; width:80%"><p>Current Messages</p></div>
<table class="results-table" style="text-align: center; margin: 0 auto; width:80%">
        <thead>
            <tr>
                <td>msg_id</td>
                <td>creator</td>
		<td>date_created</td>
		<td>display_until</td>
		<td>message</td>
            </tr>
        </thead>
        <tbody>
            
<?php

header("Content-Type: text/html;charset=UTF-8");

$servername = "localhost";
$username = "bulletin";
$password = "password";
$dbname = "bulletin";

// Create connection to bulletin database
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Added this so Japanese characters would be extracted correctly
// they were coming out as question marks (??????) before adding this
$conn->set_charset("utf8");

// Grab just the messages from the message table and put them in "result"
$sql = "SELECT * FROM messages";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

  //write results to an array object so we can output them to json (for sending to javascript) later 
  while($row = $result->fetch_assoc()) {
    ?>
                <tr>
                    <td><?php echo $row['msg_id']?></td>
                    <td><?php echo $row['creator']?></td>
                    <td><?php echo $row['date_created']?></td>
                    <td><?php echo $row['display_until']?></td>
                    <td style="text-align: left"><?php echo $row['message']?></td>
                </tr> 
<?php
  }
}
$conn->close();
?>


            </tbody>
            </table>


<br>
<br>

<div style="text-align: center; margin: 0 auto; width:80%">
<a href="bulletinboard.php">View Bulletin Board Now</a>
</div>


</body>
</html>