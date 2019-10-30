

<?php

//ini_set('display_errors', 1);
include "includes/header.php";
include "includes/left_sidebar.php";
include "includes/db.php";



function users_details($role)
{
    $u_id = $_SESSION['u_id'];
    global $conn;

    $sql = "SELECT * FROM users WHERE user_id = $u_id";
    $users_query_result = $conn->query($sql);
    $users_display_table_header = <<<_END
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>First_name</th>
                    <th>Last_name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <!--<th>Role</th>-->
                    <th>Image</th>
                </tr>
                </thead>
                <tbody>
_END;

    $users_display_table_footer = <<<_END
                    </tbody>
                </table>
            </div>
_END;

    echo $users_display_table_header;

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
            echo "<tr>";
            echo "<td>$user_id</td>";
            echo "<td>$user_fname</td>";
            echo "<td>$user_lname</td>";
            echo "<td>$user_email</td>";
            echo "<td>$user_address</td>";
            echo "<td>$user_phone</td>";
            //echo "<td>$user_role</td>";
            //echo $user_image;
            echo "<td><img class=\"img-responsive\" src=\"upload/$user_image\" alt=\"No Img\" style=\"width: 100px\"></td>";


            echo "<td class='text-right'><a class='btn btn-info' href='includes/edit_profile.php?user_id=$user_id'>EDIT</a>";

            echo "&nbsp;<a class='btn btn-danger' href='profile.php?delete_user=$user_id'>DELETE</a></td>";
            echo "</tr>";

        }
    } else {
        echo "<tr>";
        echo "<td colspan='3'>No users exist yet.</td>";
        echo "</tr>";
    }
    echo $users_display_table_footer;
}

?>


<div id="right" class="col-sm-12 col-lg-10">

    <?php

        users_details($_SESSION['role']);
    ?>

</div>





<?php

function delete_the_user($user_id) {
    global $conn;

    $sql = "DELETE FROM users WHERE user_id = $user_id";

    $result_delete_user = $conn->query($sql);

    if (!$result_delete_user) {
        echo "<p><em>Sorry, the user could not be deleted!</em></p>" . $conn->error;
        return FALSE;
    }
    else {
        return TRUE;
    }
}


if (isset($_GET['delete_user'])) {
    $delete_this_user = $_GET['delete_user'];

    $delete_user_status = delete_the_user($delete_this_user);

    if ($delete_user_status) {
        //Because this is a GET query and the page has already loaded, the removed category
        //might still be showing in the table.
        //To update the HTML table being displayed, you need to "refresh" or "reload" the page.
        //We do so using the header() function.
        /************************************************************************************
         * This is important because it reloads the page, and does not show
         * the ID of the deleted category in the address bar, after it has been deleted.
         ************************************************************************************/
        header("Location: profile.php");
    }
}

include "includes/footer.php";
?>