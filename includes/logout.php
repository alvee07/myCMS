<?php
/****************************************************************************************************
Modified by <Alvee Hassan Akash>
 *****************************************************************************************************
R. V. Sampangi. 2017. Solution for Server Side Scripting Assignment 3. In INFX2670:
Introduction to Server Side Scripting, Faculty of Computer Science, Dalhousie University,
NS, Canada. Used with permission.
 ****************************************************************************************************/
?>


<?php

session_start();
session_destroy();
header("Location: ../../index.php");


?>