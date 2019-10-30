

<?php

//ini_set('display_errors', 1);
include "includes/header.php";
include "includes/left_sidebar.php";
include "includes/db.php";
include "includes/functions.php";

?>

<div id="right" class="col-sm-12 col-lg-10">

    <?php

    if ($_SESSION[role] == 2){
        echo "<h4>You are a subcriber, you can't do anything, just watch your comment !</h4><br>";
    }
    view_all_comments($_SESSION[fname], $_SESSION[role]);
    //echo $_SESSION[fname];
    ?>

</div>



<?php
//function for update status to "approved"
function update_comment_status($comment_id){
    global $conn;

    $sql = "UPDATE comments SET comment_status='approved' WHERE comment_id='$comment_id'";

    $result_update_comment = $conn->query($sql);

    if (!$result_update_comment){
        echo "<p><em>Sorry, the commnet could not be updated!</em></p>" . $conn->error;
        return FALSE;
    }
    else{
        return TRUE;
    }
}
//if get the comment id then update
if (isset($_GET['comment_id'])){
    $update_this_comment = $_GET['comment_id'];
    echo $update_this_comment;

    $update_comment_status = update_comment_status($update_this_comment);

    if ($update_this_comment) {
        /*
         * this functionality works same as delete post/delete comment
         * it will update the comment status to approved that's it
         */
        header("Location: comments.php");
    }
}

//function for delete the comment of that number
function delete_the_comment($comment_id) {
    global $conn;

    $sql = "DELETE FROM comments WHERE comment_id = $comment_id";

    $result_delete_comment = $conn->query($sql);

    if (!$result_delete_comment) {
        echo "<p><em>Sorry, the commnet could not be deleted!</em></p>" . $conn->error;
        return FALSE;
    }
    else {
        return TRUE;
    }
}
//if get the the comment id then delete the comment
if (isset($_GET['delete_comment'])) {
    $delete_this_comment = $_GET['delete_comment'];
    echo $delete_this_comment;
    $delete_comment_status = delete_the_comment($delete_this_comment);

    if ($delete_comment_status) {
        //Because this is a GET query and the page has already loaded, the removed category
        //might still be showing in the table.
        //To update the HTML table being displayed, you need to "refresh" or "reload" the page.
        //We do so using the header() function.
        /************************************************************************************
         * This is important because it reloads the page, and does not show
         * the ID of the deleted category in the address bar, after it has been deleted.
         ************************************************************************************/
        header("Location: comments.php");
    }
}

include "includes/footer.php";
?>