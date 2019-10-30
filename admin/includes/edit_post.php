<!--
	/****************************************************************************************************
	Modified by Alvee Hassan Akash
	*****************************************************************************************************
	R. V. Sampangi. 2017. Solution for Server Side Scripting Assignment 3. In INFX2670: Introduction to Server Side Scripting, Faculty of Computer Science, Dalhousie University, NS, Canada. Used with permission.
	****************************************************************************************************/
-->

<?php

//ini_set('display_errors', 1);
include "header.php";
include "left_sidebar.php";
include "db.php";
include "functions.php";
include "update_post_edit.php";

$post_id = $_GET['post_id'];

$current_page = basename($_SERVER['PHP_SELF']);
global $conn;

$sql = "SELECT * FROM posts WHERE post_id = $post_id";
$posts_query_result = $conn->query($sql);

if ($posts_query_result->num_rows > 0) {

    while ($row = $posts_query_result->fetch_assoc()) {
        $post_id = $row['post_id'];
        $post_cat_id = $row['post_cat_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_contents = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comments = $row['post_comments'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];

    }
}

?>

<div class="col-md-8 col-sm-12 col-no-left-padding">
    <?php //echo $current_page;?>

    <form action="<?php echo $current_page; ?>" method="post" enctype="multipart/form-data">
        <div class="col-lg-12">
            <div class="row col-lg-12">
                <div class="form-group">
                    <label for="post_id">Post ID</label>
                    <input type="hidden" class="form-control" name="post_id" value="<?php echo $post_id; ?>">
                    <input type="text" class="form-control" name="post" value="Do not worry, it will auto update" disabled>
                </div>
            </div>

            <div class="row col-lg-12">
                <div class="form-group">
                    <label for="title">Post Title</label>
                    <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>" required>
                </div>
            </div>

            <div class="row col-lg-12">
                <div class="form-group">
                    <label for="post_category_id">Post Category</label>
                    <select class="form-control" name="post_category_id" required>
                        <?php
                        //Creates category "options" dynamically, in a dropdown list
                        categories_into_dropdown_options();
                        ?>
                    </select>
                </div>
            </div>

            <div class="row col-lg-12">
                <div class="form-group">
                    <label for="author">Post Author</label>
                    <input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>" required>
                </div>
            </div>

            <div class="row col-lg-12">
                <div class="form-group">
                    <label for="status">Post Status</label>
                    <select class="form-control" name="post_status" value="<?php echo $post_status; ?>" required>
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>
                </div>
            </div>

            <div class="row col-lg-12">
                <div class="form-group">
                    <label for="post_tags">Post Tags</label>
                    <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>" required>
                </div>
            </div>

            <div class="row col-lg-12">
                <div class="form-group">
                    <label for="post_content">Post Content</label>
                    <textarea class="form-control" name="post_content" id="post_content" cols="30" rows="10" required><?php echo $post_contents; ?> </textarea>
                </div>
            </div>

            <div class="row col-lg-12">
                <div class="form-group">
                    <label for="post_image">Post Image</label>
                    <img class="img-responsive" src="../../images/<?php echo $post_image; ?>" alt="No Img"  style="width: 100px">
                    <br>
                    <input type="file" name="post_image">
                </div>
            </div>

            <div class="row col-lg-12">
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="edit_post" value="Edit Post">
                </div>
            </div>
        </div>
    </form>

</div>
<?php

include "footer.php";

?>

