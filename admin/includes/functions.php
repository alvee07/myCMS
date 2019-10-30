
<?php

/*
 * test_form_input()
 * - A function that takes form-submitted data ($data),
 *   and sanitizes it.
 * - Returns sanitized data ($data).
 */
function test_form_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


/*
 * create_paragraphs_from_DBtext()
 * - A function that takes text data from the database table
 *   and returns a string with several paragraphs, instead of
 *   new line characters or line-breaks.
 * - Returns sanitized data ($content).
 */
function create_paragraphs_from_DBtext($content) {

	$content = nl2br($content, false);

	$content = str_replace( '<br><br>', '</p><p>', $content );
	$content = str_replace( '<br>', '</p><p>', $content );

	return $content;
}

/*
 * read_post()
 * - A function that takes the post file handle ($post_file),
 *   the current page that the user is on ($current_page),
 *   and shows the post as specified in the assignment document.
 * - Does not return anything, however, it displays the post
 *   appropriately on the home and posts template pages.
 *
 * ~~NOTE~~ AS OF ASSIGNMENT 3, THIS FUNCTION IS NO LONGER USED
 *          TO DISPLAY POSTS.
 */
function read_post($post_file, $current_page) {
	$line_number = 0;

	while(!feof($post_file)) {
		$line = fgets($post_file);
		$line = trim($line);

		if ($line_number == 0) {
			echo "<h2 class='display-2'><a href='posts.php'>$line</a></h2>";
		}
		elseif ($line_number == 2) {
			echo "<p><a href='#'>$line</a></p>";
		}
		elseif ($line_number == 3) {
			if ($current_page == "index.php") {
				$date_time = explode(",", $line);
				echo "<p class='bottom-margin'>$date_time[0]</p>";
			}
			elseif ($current_page == "posts.php") {
				echo "<p>$line</p>";
				echo "<hr>";
			}
		}
		elseif ($line_number > 4) {
			if ($line != "") {
				echo "<p>$line</p>";
			}
		}

		$line_number++;
	}
}


/*
 * read_all_categories()
 * - A function that finds all categories saved in the
 *   table named "category".
 * - Displays all categories in the form of a table, 
 *   wherever the function is called.
 */
function read_all_categories() {
	global $conn;

	$sql = "SELECT * FROM category";
	$categories_query_result = $conn->query($sql);

	$category_display_table_header = <<<_END
			<table class="table table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th colspan="2">Category Title</th>
					</tr>
				</thead>
				<tbody>
_END;

	$category_display_table_footer = <<<_END
				</tbody>
			</table>
_END;

	echo $category_display_table_header;

	if ($categories_query_result->num_rows > 0) {
		while ($row = $categories_query_result->fetch_assoc()) {
			$cat_id = $row['cat_id'];
			$cat_title = $row['cat_title'];
			echo "<tr>";
			echo "<td>$cat_id</td>";
			echo "<td>$cat_title</td>";
			echo "<td class='text-right'><a class='btn btn-info' href='categories.php?update_category=$cat_id'>UPDATE</a>";
			echo "&nbsp;<a class='btn btn-danger' href='categories.php?delete_category=$cat_id'>DELETE</a></td>";
			echo "</tr>";
		}
	}
	else {
		echo "<tr>";
		echo "<td colspan='3'>No categories exist yet.</td>";
		echo "</tr>";
	}

	echo $category_display_table_footer;

}


/*
 * categories_into_dropdown_options()
 * - A function that finds all categories saved in the
 *   table named "category".
 * - Echos/prints each category in the form of an <option>,
 *   that can be included within the <select> HTML element
 *   to create drop-down selection options in a form.
 */
function categories_into_dropdown_options() {
	global $conn;

	$sql = "SELECT * FROM category";
	$categories_query_result = $conn->query($sql);

	if ($categories_query_result->num_rows > 0) {
		while ($row = $categories_query_result->fetch_assoc()) {
			$cat_id = $row['cat_id'];
			$cat_title = $row['cat_title'];

			echo "<option value='$cat_id'>$cat_title</option>";
		}
	}
	else {
		echo "No categories exist yet.";
	}
}


/*
 * insert_category($category_title)
 * - A function that inserts a specified category title
 *   into the table named "category".
 * - @input: $category_title: title of newly created category
 * - Does not return anything.
 */
function insert_category($category_title) {
	global $conn;

	$category_title = test_form_input($category_title);

	if (empty($category_title)) {
		echo "<p></em>Category title cannot be empty!</em></p>";
	}
	else {
		$sql = "INSERT INTO category(cat_title) VALUES('$category_title')";

		$result_create_category = $conn->query($sql);

		if (!$result_create_category) {
			die("<p><em>Sorry, could not create category!</em></p>" . $conn->error);
		}
	}
}


/*
 * delete_category($category_id)
 * - A function that deletes a specified category
 *   from the table named "category".
 * - @input: $category_id: ID of category to be deleted
 * - @return: TRUE, if operation was successful; FALSE, otherwise.
 */
function delete_category($category_id) {
	global $conn;

	$sql = "DELETE FROM category WHERE cat_id = $category_id";

	$result_delete_category = $conn->query($sql);

	if (!$result_delete_category) {
		echo "<p><em>Sorry, the category could not be deleted!</em></p>" . $conn->error;
		return FALSE;
	}
	else {
		return TRUE;
	}
}

function view_all_comments($fname,$role)
{
    $u_id = $_SESSION['u_id'];
    global $conn;

    if ($role==0) {
        $sql = "SELECT * FROM comments";
    }

    elseif($role==1){
        $sql = "SELECT * FROM comments WHERE comment_post_id IN (SELECT post_id FROM posts WHERE post_id=comment_post_id AND post_author='$fname')";
    }

    else{
        //header("location: profile.php");
        //echo "Something";
        $sql = "SELECT * FROM comments WHERE comment_author='$fname'";
    }


    $comments_query_result = $conn->query($sql);

    //if ($conn->query($sql)) {echo "query executes";}
    //$num = $comments_query_result->num_rows;

    //echo $num;


    $comments_display_table_header = <<<_END
        <div class="table-responsive">
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
            </div>
_END;

    echo $comments_display_table_header;

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

            if ($_SESSION[role]==0 or $_SESSION[role] ==1) {
                echo "<td class='text-right'><a class='btn btn-info' href='comments.php?comment_id=$comment_id'>Approve</a>";

                echo "<a class='btn btn-danger' href='comments.php?delete_comment=$comment_id'>DELETE</a></td>";
            }

            echo "</tr>";

        }
    } else {
        echo "<tr>";
        echo "<td colspan='3'>No Comments exist yet.</td>";
        echo "</tr>";
    }
    echo $comments_display_table_footer;
}

function view_all_posts($fname,$role)
{
    $u_id = $_SESSION['u_id'];
    global $conn;

    if ($role==0) {
        $sql = "SELECT * FROM posts";
    }

    elseif($role==1){
        $sql = "SELECT * FROM posts WHERE post_author='$fname'";
    }

    else{
        header("location: profile.php");
        //echo "Something";
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

            echo "<td><img class=\"img-responsive\" src=\"../images/$post_image\" alt=\"No Img\" style=\"width: 100px\"></td>";


            echo "<td class='text-right'><a class='btn btn-info' href='includes/edit_post.php?post_id=$post_id'>EDIT</a>";

            echo "<a class='btn btn-danger' href='view_posts.php?delete_post=$post_id'>DELETE</a></td>";
            echo "</tr>";

        }
    } else {
        echo "<tr>";
        echo "<td colspan='3'>No posts exist yet.</td>";
        echo "</tr>";
    }
    echo $posts_display_table_footer;
}


function recent_posts($role, $fname){
    global $conn;
    if ($role == 0){
        $sql = "SELECT *FROM posts WHERE post_date > DATE_SUB(NOW(), INTERVAL 24 HOUR )";
    }
    if ($role == 1){
        $sql = "SELECT *FROM posts WHERE post_author='$fname' AND post_date > DATE_SUB(NOW(), INTERVAL 24 HOUR )";
    }

    $select_post = $conn->query($sql);
    $post24= $select_post->num_rows;
    if ($post24>0){
        echo "<a href='includes/view_all_posts.php?post_num=$post24'>Your recent post num $post24</a>";
    }
    else
        echo "NO Recent Posts";
}

function recent_comments($role, $fname){
    global $conn;
    if ($role == 0){
        $sql = "SELECT *FROM comments WHERE comment_date > DATE_SUB(NOW(), INTERVAL 24 HOUR )";
    }
    if ($role == 1){
        $sql = "SELECT * FROM comments WHERE comment_date > DATE_SUB(NOW(), INTERVAL 24 HOUR ) AND comment_post_id IN (SELECT post_id FROM posts WHERE post_id=comment_post_id AND post_author='$fname')";
    }


    $select_comment = $conn->query($sql);
    $comment24= $select_comment->num_rows;
    if ($comment24>0){
        if ($role == 1) {
            echo "<a href='includes/comments24.php?comment_num=$comment24'>Your recent post num $comment24</a>";
        }
        else
            echo "<a href='comments.php'>Admin Your recent post num $comment24</a>";
    }
    else
        echo "NO Recent Comments";
}

function recent_users(){
    global $conn;

    $sql = "SELECT *FROM users WHERE user_date > DATE_SUB(NOW(), INTERVAL 24 HOUR )";

    $select_user = $conn->query($sql);
    $user24= $select_user->num_rows;
    if ($user24>0){
        echo "<a href='includes/view_all_users.php?user_num=$user24'>Your recent user num $user24</a>";
    }
    else
        echo "NO Recent Users";
}
?>