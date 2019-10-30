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

if ($_SESSION[role] == 1) { ?>


    <div class="col-sm-8 col-lg-12">
        <h4>This is page is only to view the recent comments, wanna see the entire comments for this your post
        <a href="../comments.php"> click here</a> </h4><br><br>
        <?php
        if (!isset($_GET['comment_num'])) {
            /*
             * If someone tries to access posts.php without specifying a post ID,
             * they must not be allowed access to the page. So, we redirect them
             * to the home page.
             */
            header("Location: ../profile.php");
        }
        else {

            $sql = "SELECT * FROM comments WHERE comment_date > DATE_SUB(NOW(), INTERVAL 24 HOUR ) AND  comment_post_id IN (SELECT post_id FROM posts WHERE post_id=comment_post_id AND post_author='$fname')";

            //echo "here<br>";

            $comments_query_result = $conn->query($sql);

            //if ($conn->query($sql)) {echo "query executes";}
            //$num = $comments_query_result->num_rows;

            //echo $num;


            $comments_display_table_header = <<<_END
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Post Title</th>
                    <th>Author</th>
                    <th>Email</th>
                    <th>Content</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
_END;

            $comments_display_table_footer = <<<_END
                    </tbody>
                </table>
_END;

            echo $comments_display_table_header;

            //echo $comments_query_result->num_rows;

            if ($comments_query_result->num_rows > 0) {
                //echo "found";
                while ($row = $comments_query_result->fetch_assoc()) {
                    $comment_id = $row['comment_id'];
                    $comment_post_id = $row['comment_post_id'];
                    $comment_author = $row['comment_author'];
                    $comment_email = $row['comment_email'];
                    $comment_content = $row['comment_content'];
                    $comment_date = $row['comment_date'];
                    $comment_status = $row['comment_status'];

                    $sql2 = "SELECT post_title FROM posts WHERE post_id='$comment_post_id'";
                    $result2 = $conn->query($sql2);
                    $num2 = $result2->num_rows;
                    //echo $num2;

                    $row2 = $result2->fetch_assoc();
                    //echo $row2['post_title'];

                    $post_title_from_posts = $row2['post_title'];

                    echo "<tr>";
                    echo "<td>$comment_id</td>";
                    echo "<td>$post_title_from_posts</td>";
                    echo "<td>$comment_author</td>";
                    echo "<td>$comment_email</td>";
                    echo "<td>$comment_content</td>";
                    echo "<td>$comment_date</td>";
                    echo "<td>$comment_status</td>";

                    echo "</tr>";

                }
            } else {
                echo "<tr>";
                echo "<td colspan='3'>No Comments exist yet.</td>";
                echo "</tr>";
            }
            echo $comments_display_table_footer;

        }
        ?>

    </div>



    <?php
}
else
    header("location: ../profile.php");
include "footer.php";

?>

