<?php
   include("config.php");
   session_start();
   if (!$db) {
      die("Connection failed: " . mysqli_connect_error());
   }
  // Get user from session
  $login_user = $_SESSION['login_user'];
  
  $group = $_SESSION["currentGroup"];
  // If form is submited then
  // Get chat text from url
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $chatText=$_POST["chattext"];
 
    //escaping to avoid injections!
    $textEscaped = htmlentities(mysqli_real_escape_string($db, $chatText));

    //Insert into chat
    $insertQuery = "INSERT INTO GROUPCHATS (groupName, senderUserName, class_id, chattext) VALUES ('$group', '$login_user', 0, '$textEscaped')";
	$result = mysqli_query($db, $insertQuery);
    //echo "insert query:" . $insertQuery;
    if (!$result){
       echo ("Error:" .mysqli_error($db));
    }
  }
 
  $chatsql = "SELECT * FROM GROUPCHATS WHERE groupName='$group' ORDER BY chatID ASC";
 $chatRows = mysqli_query($db, $chatsql);

  if($chatRows){
        while ($row2 = mysqli_fetch_array($chatRows)) {
              echo '' .$row2['senderUserName'] . ': ' .$row2['chattext']. '</br>';
        }
  }		

?>