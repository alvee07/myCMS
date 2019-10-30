<!--
	/****************************************************************************************************
	Modified by Alvee Hassan Akash
	*****************************************************************************************************
	R. V. Sampangi. 2017. Solution for Server Side Scripting Assignment 3. In INFX2670: Introduction to Server Side Scripting, Faculty of Computer Science, Dalhousie University, NS, Canada. Used with permission.
	****************************************************************************************************/
-->

<?php

//ini_set('display_errors', 1);
include "includes/header.php";
include "includes/left_sidebar.php";
include "includes/db.php";
global $conn;
?>

<?php
    $sql = "SELECT * FROM login";
    $result = $conn->query($sql);
    $num = $result->num_rows;

    if ($num>0){
        while ($row = $result->fetch_assoc()){
            echo $row['username']." u<-->p ".$row['password']."<br>";
            $after = password_hash($row['password'], 1);
            $id = $row['login_id'];
            $sql2 = "UPDATE login SET password='$after' WHERE login_id='$id'";
            echo $sql2."<br>";

            $result2 = $conn->query($sql2);

            if($result2){
                echo "<br><br>query done";
                header("location: profile.php?enc=1");
            }

        }
    }
?>

<?php
include "includes/footer.php";
?>