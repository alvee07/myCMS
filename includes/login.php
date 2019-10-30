

<?php
//
//  FIRST OF ALL THIS LOGIN SYSTEM IS WORKING PERFECTLY WITH $_GET VARIABLES, NO SESSION IS USED TO LOGIN NOW
//  BUT DON'T ASK HOW IT WORKS. IT TOOK ME 2 DAYS TO LOGIN WITH PASSWORD VERIFY AND $_GET METHOD
//

$dateTimeObject = new DateTime("now", new DateTimeZone("America/Halifax"));
$dateTimeObject->setTimestamp(time()); //adjust the object to correct timestamp
$message_date = $dateTimeObject->format('d.m.Y,');
$message_time = $dateTimeObject->format('H:i:sa');


if (isset($_POST['login'])) {
    $loggedIn = FALSE;
    $loginError = FALSE;

    global $username;

    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    //$password = password_hash($password,1);


    if ($username != "" || $password != "") {

        include "db.php";
        $sql = "SELECT * FROM login WHERE username = '$username'";

        $select_login_result = $conn->query($sql);
        $row_in_login = $select_login_result->num_rows;
        echo "no of rows detected $row_in_login in login table<br>";

        if ($row_in_login > 0) {
            echo "<br>Password okay<br>";
            while ($row = mysqli_fetch_array($select_login_result)) {
                echo "<br>Password okay<br>";
                if (password_verify($password, $row['password'])) {
                    //if there are users then it will go on until it founds the correct password
                    echo "<br>Password okay<br>";
                    session_start();
                    $entry = true;
                    echo $row['login_id'] . "<- this is the id and this is the name -> " . $row['username'] . "<br>";
                    if ($entry) {
                        $row_login = $select_login_result->fetch_assoc();
                        echo "trying<br>";
                        
                        echo $row_login['login_id'] . "<- this is the id and this is the name -> " . $row_login['username'];
                        $verified_row = $row['login_id'];


                        $sql2 = "SELECT * FROM users WHERE user_id = '$verified_row'";
                        $select_user_result = $conn->query($sql2);
                        $row_in_user = $select_user_result->num_rows;
                        echo "<br>no of row detected " . $row_in_user . " in the user table<br>";

                        if ($select_user_result->num_rows == 1) {
                            $row_user = $select_user_result->fetch_assoc();
                            echo $row_user['user_firstname'] . $row_user['user_lastname'] . "<br>";
                            $_SESSION[fname] = $row_user['user_firstname'];
                            $_SESSION[lname] = $row_user['user_lastname'];
                            $_SESSION[username] = $username;
                            $_SESSION[role] = $row_user['user_role'];
                            $_SESSION[u_id] = $row_user['user_id'];

                            echo $_SESSION['username'] . "<br>";
                            echo $_SESSION['u_id'] . "<br>";

                            if ($row_user['user_role'] == 0) {
                                $who = " Admin";
                                $_SESSION[who] = $who;
                            } elseif ($row_user['user_role'] == 1) {
                                $who = " Member";
                                $_SESSION[who] = $who;
                            } elseif ($row_user['user_role'] == 2) {
                                $who = " Subscriber";
                                $_SESSION[who] = $who;
                            }


                            $loggedIn = TRUE;
                            $loginError = FALSE;
                            $_SESSION['loggedIn'] = true;
                            $_SESSION['loginError'] = false;
                            echo "Cookies and other start here";
                            $cms_time = $message_date . " at " . $message_time;

                            setcookie($username, $cms_time, time() + 86400 * 30, '/');
                            $_SESSION['$time'] = $_COOKIE['$cms_access'];

                            if (!isset($_COOKIE[$username])) {
                                echo "<br>Cookie named '" . $username . "' is not set!";
                                $_SESSION[time] = "This is your first time !";

                            } else {
                                echo "<br>Cookie '" . $username . "' is set!<br>";
                                echo "<br>Value is: " . $_COOKIE[$username];

                                $_SESSION[time] = "Your last access was ".$_COOKIE[$username];


                            }
                            //this is cookie updates here. yahoo.
                            setcookie($username, $cms_time, time() + 60 * 60 * 10, '/');
                            header("Location: ../index.php?status=done");
                            // to send the link to right path inside the dir.
                            // header("Location: index.php?status=done");
                        }
                    }


                }
                else{
                    echo "password not okay";
                    header("Location: ../index.php?status=error");
                }
            }
        }
        else {
            echo "Nothing Found";
            header("Location: ../index.php?status=error");
        }

    }


}
//header("Location: ../test2.php");
//header("Location: ../index.php");

// this hash password system idea is taken from :
//https://www.youtube.com/watch?v=eP6DIY78U74

//$2y$10$iq6YQXioaJa38ohNjuuwNO/UhIsdGLrTzWmaZRqQjA9xbpZr1uj1O