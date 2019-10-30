
<?php
//ini_set('display_errors', 1);
session_start();
include "header.php";
include "left_sidebar.php";
require "functions.php";
include "db.php";
require "update_user_edit.php";
?>
<?php
if ($_SESSION[role]==0) {
    ?>
    <div id="right" class="col-sm-12 col-lg-10">

        <form action="add_user.php" method="post" enctype="multipart/form-data">
            <div class="col-lg-12">
                <div class="row col-lg-12">
                    <div class="form-group">
                        <label for="user_id">User ID</label>
                        <input type="text" class="form-control" name="user_id" value="Do not worry, it will auto update" disabled>
                    </div>
                </div>
                <div class="row col-lg-12">
                    <div class="form-group">
                        <label for="user_firstname">User Firstname</label>
                        <input type="text" class="form-control" name="user_firstname" required>
                    </div>
                </div>
                <div class="row col-lg-12">
                    <div class="form-group">
                        <label for="user_lastname">User Lastname</label>
                        <input type="text" class="form-control" name="user_lastname" required>
                    </div>
                </div>
                <div class="row col-lg-12">
                    <div class="form-group">
                        <label for="user_email">User Email</label>
                        <input type="text" class="form-control" name="user_email" required>
                    </div>
                </div>
                <div class="row col-lg-12">
                    <div class="form-group">
                        <label for="user_address">User Adress</label>
                        <input type="text" class="form-control" name="user_address" required>
                    </div>
                </div>
                <div class="row col-lg-12">
                    <div class="form-group">
                        <label for="user_phone">User Phone</label>
                        <input type="text" class="form-control" name="user_phone" required>
                    </div>
                </div>
                <div class="row col-lg-12">
                    <div class="form-group">
                        <label for="user_role">User Role</label>
                        <input type="text" class="form-control" name="user_role" required>
                    </div>
                </div>
                <div class="row col-lg-12">
                    <div class="form-group">
                        <label for="user_image">User Image</label>
                        <input type="file" name="user_image">
                    </div>
                </div>
                <div class="row col-lg-12">
                    <div class="form-group">
                        <label for="user_role">Login</label>
                        <input type="text" class="form-control" name="login" required>
                    </div>
                </div>
                <div class="row col-lg-12">
                    <div class="form-group">
                        <label for="user_role">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="add_user" value="Add User">
                </div>
            </div>
        </form>


    </div>
    <?php
}
else
    header("location: ../profile.php");
?>

<?php

if (isset($_POST['add_user'])){
    //echo $_POST['user_firstname']."<br>";

    $fname = test_form_input($_POST['user_firstname']);
    $lname = test_form_input($_POST['user_lastname']);
    $email = test_form_input($_POST['user_email']);
    $address = test_form_input($_POST['user_address']);
    $phone = test_form_input($_POST['user_phone']);
    $role = test_form_input($_POST['user_role']);

    $img = $_FILES['user_image']['name'];
    $img_temp = $_FILES['user_image']['tmp_name'];
    $img_filesize = $_FILES['user_image']['size'];
    //echo $img."<br>";
    //echo $img_temp."<br>";
    //echo $img_filesize."<br>";

    if($img != "") {
        /*
         * This section of the code manages image uploads. As discussed in class,
         * we check if the file is of a specified type, and within the allowed file-size.
         */
        $target_file = "../upload/" . $img;
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $img_temp);

        /*
         * A list of MIME types are available here:
         * http://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types
         */

        //echo $target_file . "<br>";

        switch ($mime) {
            case 'image/jpeg':
            case 'image/png':
                if ($img_filesize < TWO_MEGA_BYTES) {
                    //Upload the image.
                    //echo "here uploaded<br>";
                    move_uploaded_file($img_temp, "$target_file");
                }
                break;

            default:
                die("<br>Unknown file type. Your image cannot be uploaded.<br>");
        }
    }
    else {
        //Otherwise, the user has not set any post image.
        $img_image = "";
    }

    $login = test_form_input($_POST['login']);
    $password = test_form_input($_POST['password']);
    $password = password_hash($password, 1);

    $sql = "INSERT INTO users (user_firstname, user_lastname, user_email, user_address, user_phone, user_role, user_image, user_date) ";
    $sql .= "VALUES ('$fname', '$lname', '$email' , '$address' , '$phone' , '$role' , '$img', now())";


    if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully";
        $user_id = $conn->insert_id;
        //echo "last user id " . $user_id . "<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql2 = "INSERT INTO login (login_id, user_id, username, password) VALUES ($user_id , $user_id , '$login' , '$password')";

    //echo $sql2;

    if ($conn->query($sql2) === TRUE) {
        //echo "New record created successfully";
        header("Location: ../profile.php");
    } else {
        echo "<br>Error: " . $sql2 . "<br>" . $conn->error;
    }

}

include "footer.php";

?>


