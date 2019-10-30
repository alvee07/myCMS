

<?php
//ini_set('display_errors', 1);
include "includes/header.php";
include "includes/left_sidebar.php";
include "includes/db.php";
include "includes/functions.php";

?>

<div id="right" class="col-sm-12 col-lg-10">
    <?php
    view_all_posts($_SESSION[fname], $_SESSION[role]);
    //echo $_SESSION[fname];
    ?>

</div>



<?php

function delete_the_post($post_id) {
    global $conn;

    $sql = "DELETE FROM posts WHERE post_id = $post_id";

    $result_delete_post = $conn->query($sql);

    if (!$result_delete_post) {
        echo "<p><em>Sorry, the post could not be deleted!</em></p>" . $conn->error;
        return FALSE;
    }
    else {
        return TRUE;
    }
}

if (isset($_GET['delete_post'])) {
    $delete_this_post = $_GET['delete_post'];
echo $delete_this_post;
    $delete_post_status = delete_the_post($delete_this_post);

    if ($delete_post_status) {
        //Because this is a GET query and the page has already loaded, the removed category
        //might still be showing in the table.
        //To update the HTML table being displayed, you need to "refresh" or "reload" the page.
        //We do so using the header() function.
        /************************************************************************************
         * This is important because it reloads the page, and does not show
         * the ID of the deleted category in the address bar, after it has been deleted.
         ************************************************************************************/
        header("Location: view_posts.php");
    }
}

    include "includes/footer.php";
?>

