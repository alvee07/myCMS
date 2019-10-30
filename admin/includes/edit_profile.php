<!--
	/****************************************************************************************************
	Modified by Alvee Hassan Akash
	*****************************************************************************************************
	R. V. Sampangi. 2017. Solution for Server Side Scripting Assignment 3. In INFX2670: Introduction to Server Side Scripting, Faculty of Computer Science, Dalhousie University, NS, Canada. Used with permission.
	****************************************************************************************************/
-->

<?php
session_start();
//ini_set('display_errors', 1);
include "header.php";
include "left_sidebar.php";
include "functions.php";
include "db.php";
include "update_user_edit.php";

$user_id = $_GET['user_id'];
$current_page = basename($_SERVER['PHP_SELF']);
global $conn;

$sql = "SELECT * FROM users WHERE user_id = $user_id";
$users_query_result = $conn->query($sql);

if ($users_query_result->num_rows > 0) {

    while ($row = $users_query_result->fetch_assoc()) {
        $user_id = $row['user_id'];
        $user_fname = $row['user_firstname'];
        $user_lname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_address = $row['user_address'];
        $user_phone = $row['user_phone'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];
    }
}
?>


    <div class="col-sm-8 col-lg-10">
        <?php //echo $user_id;
        ?>

        <form action="edit_profile.php" method="post" enctype="multipart/form-data">
            <div class="col-lg-12">
                <div class="row col-lg-12">
                    <div class="form-group">
                        <label for="user_id">User ID</label>
                        <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id; ?>">
                        <input type="text" class="form-control" name="user" value="<?php echo $user_id; ?>" disabled>
                    </div>
                </div>
                <div class="row col-lg-12">
                    <div class="form-group">
                        <label for="user_firstname">User Firstname</label>
                        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_fname; ?>"
                               required>
                    </div>
                </div>
                <div class="row col-lg-12">
                    <div class="form-group">
                        <label for="user_lastname">User Lastname</label>
                        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lname; ?>"
                               required>
                    </div>
                </div>
                <div class="row col-lg-12">
                    <div class="form-group">
                        <label for="user_email">User Email</label>
                        <input type="text" class="form-control" name="user_email" value="<?php echo $user_email; ?>"
                               required>
                    </div>
                </div>
                <div class="row col-lg-12">
                    <div class="form-group">
                        <label for="user_address">User Adress</label>
                        <input type="text" class="form-control" name="user_address" value="<?php echo $user_address; ?>"
                               required>
                    </div>
                </div>
                <div class="row col-lg-12">
                    <div class="form-group">
                        <label for="user_phone">User Phone</label>
                        <input type="text" class="form-control" name="user_phone" value="<?php echo $user_phone; ?>" required>
                    </div>
                </div>
                <?php
                if ($_SESSION[role] == 0){  //only admin can edit role, use "|| $_SESSION[role]==1" to give author this authority
                    echo "<div class=\"row col-lg-12\">
                    <div class=\"form-group\">
                        <label for=\"user_role\">User Role</label>
                        <input type=\"text\" class=\"form-control\" name=\"user_role\" value=\"$user_role\">
                    </div>
                </div>";
                }
                else
                {
                    echo "<input type=\"hidden\" class=\"form-control\" name=\"user_role\" value=\"$user_role\" required>";
                }
                ?>


                <div class="row col-lg-12">
                    <div class="form-group">
                        <label for="user_image">User Image</label>
                        <img class="img-responsive" src="../upload/<?php echo $user_image; ?>" alt="No Img"
                             style="width: 100px">
                        <br>
                        <input type="file" name="user_image">
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
                </div>
            </div>
        </form>

    </div>




<?php
    include "footer.php";
?>
