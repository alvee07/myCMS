<?php


// $db_host = "db.cs.dal.ca";
// $db_username = "akash";
// $db_password = "B00723716";
// $db_name = "akash";


$db_host = "localhost";
$db_username = "root";
$db_password = "root";
$db_name = "cms";





$conn = new mysqli ($db_host, $db_username, $db_password, $db_name);

	if ($conn->connect_error) {
		die ("Error connecting to the DB.<br>" . connect_error);
	}
	/* For debug purposes only. This is otherwise not required.
	else {
		echo "Connected!";
	}
	*/
?>