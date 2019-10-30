<?php //ini_set('display_errors', 1); ?>

<?php
require "includes/functions.php";
include "includes/header.php";
include "includes/db.php";
global $conn;
?>


<div class="col-md-8 col-sm-12 col-no-left-padding">

    <?php
			$current_page = basename($_SERVER['PHP_SELF']);

    if (isset($_POST['search'])) {
        $search = test_form_input($_POST['words']);
        $radio = test_form_input($_POST['radio']);

        //echo "here goes search results $search<br>";

        if ($radio == tag){
            $sql = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' AND post_status = 'published'";
        }
        elseif ($radio == author){
            $sql = "SELECT * FROM posts WHERE post_author LIKE '%$search%' AND post_status = 'published'";
        }
        if ($radio == category){
            $sql = "SELECT * FROM posts WHERE post_status = 'published' AND post_cat_id IN (SELECT  cat_id FROM category WHERE cat_id=post_cat_id AND cat_title LIKE '%$search%')";
        }


        $retrieve_post_result = $conn->query($sql);

        if ($retrieve_post_result->num_rows > 0) {
            while ($row = $retrieve_post_result->fetch_assoc()) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = explode(" ", $row['post_date']);
                $post_image = $row['post_image'];
                $post_content = create_paragraphs_from_DBtext($row['post_content']);
                $post_status = $row['post_status'];

                ?>


                <h2>
                    <a href="posts.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="#"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date[0]; ?></p>
                <hr>
                <?php
                //Show the post image only if one has been set.
                if ($post_image != "") {
                    ?>
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                    <?php
                }
                ?>

                <hr>
                <p><?php echo $post_content; ?></p>

                <hr>


                <?php
            }    //Closing the posts while loop here.
        }
    }
            else {
                echo "<p>No posts to show!</p>";
            }
		?>
</div>
<div class="col-md-4 col-sm-12">
    <div class="form-group">
        <form action="search_results.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search Tags . . . " name="words" required>

                <label class="radio-inline">
                    <input type="radio" name="radio" value="tag" required> Tags
                </label>
                <label class="radio-inline">
                    <input type="radio" name="radio" value="category"> Categories
                </label>
                <label class="radio-inline">
                    <input type="radio" name="radio" value="author"> Authors
                </label>

            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-secondary btn-block" name="search">
            </div>

        </form>
    </div>
</div>

<?php include "includes/footer.php"; ?>
