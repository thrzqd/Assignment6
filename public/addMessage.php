<?php
include 'config.php';

$message = mysql_real_escape_string($_GET['message']);
$username = mysql_real_escape_string($_GET['username']);

	
	//We need to change this to match the tables
	$result = mysql_query("INSERT INTO chat (message, username) VALUES ('$message', '$username')") or die(mysql_error());
	
	if($result){
		$text = '1';
	}
	
	else{
		$text = '2';

		}

?>