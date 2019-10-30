
<?php
//ini_set('display_errors', 1);
session_start();
include "includes/header.php";
require "includes/functions.php";
include "includes/db.php";
//echo $current_page;

if (isset($_POST['reg_user'])){
    //echo $_POST['user_firstname']."<br>";

    $fname = test_form_input($_POST['user_firstname']);
    $lname = test_form_input($_POST['user_lastname']);
    $email = test_form_input($_POST['user_email']);
    $role = test_form_input($_POST['user_role']);
    $login = test_form_input($_POST['login']);
    $pass1 = test_form_input($_POST['password1']);
    $pass2 = test_form_input($_POST['password2']);

    $img = $_FILES['user_image']['name'];
    $img_temp = $_FILES['user_image']['tmp_name'];
    $img_filesize = $_FILES['user_image']['size'];

    //echo $img."<br>";
    //echo $img_temp."<br>";
    //echo $img_filesize."<br>";
//
    //echo $fname."<br>";
    //echo $lname."<br>";
    //echo $email."<br>";
    //echo $role."<br>";
    //echo $login."<br>";
    //echo $pass1."<br>";
    //echo $pass2."<br>";

    if (strcmp($pass1, $pass2) == 0){

        if (check_pass($pass1)){
            echo "Password matched with specs";
            //echo password_hash($pass1, 1);

            if($img != "") {
                /*
                 * This section of the code manages image uploads. As discussed in class,
                 * we check if the file is of a specified type, and within the allowed file-size.
                 */
                $target_file = "admin/upload/" . $img;
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
            $password = test_form_input($_POST['password1']);
            $password = password_hash($password, 1);
            //echo "<br><br>hashed password is here<br><br>".$password."<br><br>";

            $sql = "INSERT INTO users (user_firstname, user_lastname, user_email, user_role, user_image, user_date) ";
            $sql .= "VALUES ('$fname', '$lname', '$email' , '$role' , '$img' , now())";


            if ($conn->query($sql) === TRUE) {
                //echo "New record created successfully";
                $user_id = $conn->insert_id;
                //echo "last user id " . $user_id . "<br>";
            } else {
                echo "Error 1: " . $sql . "<br>" . $conn->error;
            }

            $sql2 = "INSERT INTO login (login_id, user_id, username, password) VALUES ($user_id , $user_id , '$login' , '$password')";

            //echo $sql2;

            if ($conn->query($sql2) === TRUE) {
                //echo "New record created successfully";
                header("Location: index.php");
            } else {
                echo "<br>Error 2: " . $sql2 . "<br>" . $conn->error;
            }


        }
        else
            echo "<h4 style='color: red'>password spec is not matched</h4><br>";
    }
    else
        echo "<br><h4 style='color: red'>Please...try again password didn't match</h4><br>";


}

?>

    <div class="col-sm-8 col-lg-8">

        <form action="<?php echo $current_page; ?>" method="post" enctype="multipart/form-data">
            <div class="col-lg-12">
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
                        <label for="user_role">User Role</label>
                        <select class="form-control" name="user_role" required>
                            <?php
                            //Creates Author or Subcriber "options" dynamically, in a dropdown list
                            role_into_dropdown_options();
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row col-lg-12">
                    <div class="form-group">
                        <label for="user_login">Login</label>
                        <input type="text" class="form-control" name="login" required>
                    </div>
                </div>
                <div class="row col-lg-12">
                    <div class="form-group">
                        <label for="user_pass1">Password</label>
                        <input type="password" class="form-control" name="password1" required>
                    </div>
                </div>
                <div class="row col-lg-12">
                    <div class="form-group">
                        <label for="user_pass2">Re-Password</label>
                        <input type="password" class="form-control" name="password2" required>
                    </div>
                </div>

                <div class="row col-lg-12">
                    <div class="form-group">
                        <label for="user_image">User Image</label>
                        <input type="file" name="user_image" required>
                        <br>
                    </div>
                </div>

                <div class="row col-lg-12">
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="reg_user" value="Register User">
                    </div>
                </div>
            </div>
        </form>


    </div>


<?php




include "includes/footer.php";







?>


<!--

"How To Validate Complex Passwords Using Regular Expressions For PHP And PCRE Code Example - Runnable".
Code.runnable.com. N.p., 2017. Web. 15 Apr. 2017.

-->