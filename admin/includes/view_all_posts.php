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
include "db.php";
global $conn;
$fname = $_SESSION[fname];
if ($_SESSION[role]==0 or $_SESSION[role] ==1) { ?>


    <div class="col-sm-8 col-lg-12">
        <h4>This is page is only to view the recent posts, wanna see the entire posts
            <a href="../view_posts.php"> click here</a><small>  It will take you to VIEW_POSTS.PHP</small></h4><br><br>
        <?php
        if (!isset($_GET['post_num'])) {
            /*
             * If someone tries to access posts.php without specifying a post ID,
             * they must not be allowed access to the page. So, we redirect them
             * to the home page.
             */
            header("Location: ../profile.php");
        }
        else {
            if ($_SESSION[role] == 0){
                $sql = "SELECT *FROM posts WHERE post_date > DATE_SUB(NOW(), INTERVAL 24 HOUR )";
            }
            else{
                $sql = "SELECT *FROM posts WHERE post_author='$fname' AND post_date > DATE_SUB(NOW(), INTERVAL 24 HOUR )";
            }

            $posts_query_result = $conn->query($sql);
            $posts_display_table_header = <<<_END
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Cat</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Date</th>
                    <!--<th>Content</th>-->
                    <th>Tags</th>
                    <th>Comments</th>
                    <th>Status</th>
                    <th>Img</th>
                </tr>
                </thead>
                <tbody>
_END;

            $posts_display_table_footer = <<<_END
                    </tbody>
                </table>
            </div>
_END;

            echo $posts_display_table_header;

            if ($posts_query_result->num_rows > 0) {
                while ($row = $posts_query_result->fetch_assoc()) {
                    $post_id = $row['post_id'];
                    $post_cat_id = $row['post_cat_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_tags = $row['post_tags'];
                    $post_comments = $row['post_comments'];
                    $post_status = $row['post_status'];

                    echo "<tr>";
                    echo "<td>$post_id</td>";
                    echo "<td>$post_cat_id</td>";
                    echo "<td>$post_title</td>";
                    echo "<td>$post_author</td>";
                    echo "<td>$post_date</td>";
                    //echo "<td>$post_content</td>";
                    echo "<td>$post_tags</td>";
                    echo "<td>$post_comments</td>";
                    echo "<td>$post_status</td>";
                    //echo $post_image;

                    echo "<td><img class=\"img-responsive\" src=\"../../images/$post_image\" alt=\"No Img\" style=\"width: 100px\"></td>";


                    echo "</tr>";

                }
            } else {
                echo "<tr>";
                echo "<td colspan='3'>No posts exist yet.</td>";
                echo "</tr>";
            }
            echo $posts_display_table_footer;
        }
        ?>

    </div>



    <?php
}
else
    header("location: ../profile.php");
include "footer.php";

?>

