<!DOCTYPE html>
<html style="background-color:black">
<head>
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/animations.css">
<link href="//fonts.googleapis.com/css?family=Roboto:400,100,400italic,700italic,700" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/style.css">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>
<body style="background-color:black">

<script>
  // count was getting increased to 2 for the first
  // message... not sure why, but initialized to -1 as workaround
  var count = -1;
</script>

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

// Clear out any messages whos display_until is in the past
$conn->query("DELETE FROM messages WHERE DATE(display_until) < CURDATE()");

// Grab just the messages from the message table and put them in "result"
$sql = "SELECT message FROM messages";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  
  //write results to an array object so we can output them to json (for sending to javascript) later 
  $result_array = Array();
  while($row = $result->fetch_assoc()) {
    $result_array[] = $row["message"];
  }
 
  //Copy results to json array
  $json_array = json_encode($result_array);
} else {
    echo "0 results";
}
$conn->close();
?>

<div id="msgDiv" class="animated fadeInRightOutLeft" style="animation-duration: 20s">
<p id="centerMessage" class="site__title mega animated fadeInRight delay-2s" style="animation-duration: 10s; display: block;"></p>
</div>


<script>

// Remove the message element from page, and replace it with
// a new one containing the message from the next row of
// the messages table. The element is removed from the page
// in order to restart the CSS animation.
function replaceMsgDiv(){
  var elm = document.getElementById("msgDiv");
  var newone = elm.cloneNode(true);
  elm.parentNode.replaceChild(newone, elm);
  var arrayObjects = <?php echo $json_array; ?>;
  count++;  
  if (count >= arrayObjects.length) {
    count = 0;
    console.log("count was greater than number of results. refreshing page");
    location.reload(true);
  }
  document.getElementById("centerMessage").innerHTML = arrayObjects[count];
  console.log("count increased to: " + count);
}

// Define, in milliseconds, how often the message element should be replaced
// and then start running
setInterval(replaceMsgDiv,18000);
replaceMsgDiv();

</script>

</body>
</html>