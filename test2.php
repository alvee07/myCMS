<?php
/****************************************************************************************************
R. V. Sampangi. 2017. Solution for Server Side Scripting Assignment 3. In INFX2670: Introduction to
Server Side Scripting, Faculty of Computer Science, Dalhousie University, NS, Canada.
 ****************************************************************************************************/

//$db_host = "db.cs.dal.ca";
//$db_username = "akash";
//$db_password = "B00723716";
//$db_name = "akash";

$db_host = "localhost";
$db_username = "root";
$db_password = "root";
$db_name = "cms";

$conn = new mysqli ($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die ("Error connecting to the DB.<br>" . $db->connect_error);
}
/* For debug purposes only. This is otherwise not required.*/
else {
    //echo "Connected!";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <title>Database Image</title>

</head>
<body>
<!-- Container -->
<div class="container myContainer">
    <div class="row">
        <?php $current_page = basename($_SERVER['PHP_SELF']); ?>

    </div>

</div>
<div class="container">
    <p>THis is the another page where you can add images</p>
    <?php

    $pass = "b";
    echo $pass."<br>";
    $new = password_hash($pass, 1);
    echo $new;

    if (password_verify($pass, $new)){
        echo "<br>match";
    }


    ?>

    <a href="test1.php">CLick here to add images</a>
</div>



</body>
</html>