<?php
   include("config.php");
   session_start();
   if (!$db) {
      die("Connection failed: " . mysqli_connect_error());
   }
  // Get user from session
  $login_user = $_SESSION['login_user'];
  //$login_user = "gy63575";
  // Get classid, groupid from session.
  //$classid = $_SESSION['classid'];
  //$groupid = $_SESSION['groupid'];
  
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

  //$sql = "select * from GROUPS where classNumber ='$classid'";
  //$chatsql = "select * from chat where classid ='" .$classid ."'";
 
  $chatsql = "SELECT * FROM GROUPCHATS WHERE groupName='$group' ORDER BY chatID ASC";
  //echo $sql;
  //$result = mysqli_query($db, $sql);
  $chatRows = mysqli_query($db, $chatsql);
?>
  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>IS Chat Program</title>
   
    <link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
    
    <script src="https://ajax.googleapis.com/ajax/libs/prototype/1.7.3.0/prototype.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/scriptaculous/1.9.0/scriptaculous.js"></script>
   
    <script src="groupchat.js"></script>
    <script>
    alert("loading");
  </script>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Group Chat</h1>
            <h3>&nbsp;User:<?php echo $login_user ?></h3>
        </header>
        <main>

          <hr/>
          <div class="chat">
            <div id="chatOutput">
            <?php
            // load the dropdown for group
			if($chatRows){
               while ($row2 = mysqli_fetch_array($chatRows)) {
                  echo '' .$row2['senderUserName'] . ': ' .$row2['chattext']. '</br>';
               }
			}			
            ?> 
            </div>
 
            <br/>
            <div>
			   <input id="chatInput" type="text" placeholder="Input Text here" maxlength="128" name="chattext"/>
		   	   <input type="button" name="submitchat" id="submitchat" value="send chat"/> 
            </div>
			<a href="groupSelect.php">Select another group </a>
          </div>
        </main>
    </div>
 </body>
</html>