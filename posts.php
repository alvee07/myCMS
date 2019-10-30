<?php //ini_set('display_errors', 1); ?><!--
	/****************************************************************************************************
	Modified by Alvee Hassan Akash
	*****************************************************************************************************
	R. V. Sampangi. 2017. Solution for Server Side Scripting Assignment 3. In INFX2670: Introduction to Server Side Scripting, Faculty of Computer Science, Dalhousie University, NS, Canada. Used with permission.
	****************************************************************************************************/

	This is the add post page:
	- Includes several other PHP scripts to implement the overall functionality.
	- Allows users to create a new post.
-->
<?php require "includes/functions.php"; ?>
<?php include "includes/header.php"; ?>

		<div class="col-md-8 col-sm-12 col-no-left-padding">
		
			<?php
				if (!isset($_GET['p_id'])) {
					/*
					 * If someone tries to access posts.php without specifying a post ID,
					 * they must not be allowed access to the page. So, we redirect them
					 * to the home page.
					 */
					header("Location: index.php");
				}
				else {
					/*
					 * If everything seems alright, retrieve the post ID and display the
					 * post here.
					 */
					$post_id = $_GET['p_id'];

					$sql = "SELECT * FROM posts WHERE post_id = $post_id";
					$retrieve_post_result = $conn->query($sql);

					if ($retrieve_post_result->num_rows > 0) {
						while ($row = $retrieve_post_result->fetch_assoc()) {
							$post_title = $row['post_title'];
							$post_author = $row['post_author'];
							$post_date = $row['post_date'];
							$post_image = $row['post_image'];
							$post_content = create_paragraphs_from_DBtext($row['post_content']);
				?>


				<h2>
					<a href="#"><?php echo $post_title; ?></a>
				</h2>
				<p class="lead">
					by <a href="#"><?php echo $post_author; ?></a>
				</p>
				<p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
				<hr>
				<img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
				<hr>
				<p><?php echo $post_content; ?></p>

				<hr>



				<?php
						}	//Closing the posts while loop here.
					}
					else {
						echo "<p>No posts to show!</p>";
					}
				}
			?>

			<?php include "includes/get_show_comments.php"; ?>
	
		</div>

		<?php include "includes/sidebar.php"; ?>
		
<?php include "includes/footer.php"; ?>