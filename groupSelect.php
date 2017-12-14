<?php

  include("config.php");
  session_start();
  if (!$db) {
     die("Connection failed: " . mysqli_connect_error());
  }
  // Get user from session
  $login_user = $_SESSION['login_user'];
  
  $getGroups = "SELECT groupName FROM ASSIGNEDGROUP WHERE userName='$login_user'";
  $result = mysqli_query($db, $getGroups);
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>IS Chat Program</title>
   
    <link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
</head>
<body>
   <div class="container">
   
      <header class="header">
         <h1>Group Chat</h1>
         <h3>&nbsp;User:<?php echo $login_user ?></h3>
      </header>
      <form id="groupSelect" method="POST" action="chatRedirect.php">
         <select name="selectGroup">
         <?php
            //load the dropdown for group

            while ($row = mysqli_fetch_assoc($result)) {
               $group = $row['groupName'];
               echo "<option value=\"$group\"> $group </option>";
            }     
         ?>
         </select>
	     <input type="submit" name="submit" id="submit" value="Select Group"/>
      </form>
   </div>
</body>
</html>