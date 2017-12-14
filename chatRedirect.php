<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		
		$groupName = $_POST["selectGroup"];
		session_start();
		$_SESSION["currentGroup"] = $groupName; 
	
	?>
    <meta http-equiv="refresh" content="0;URL=groupchat.php" />
</head>
<body>
</body>
</html>