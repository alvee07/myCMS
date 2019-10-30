
<?php require "includes/functions.php"; ?>
<?php include "includes/header.php"; ?>

		<div class="col-md-8 col-sm-12" id="main_body">
		<?php
			$current_page = basename($_SERVER['PHP_SELF']);

			$sql = "SELECT * FROM posts WHERE post_status = 'published'";	//Posts are displayed only if they are published
			$retrieve_post_result = $conn->query($sql);

			if ($retrieve_post_result->num_rows > 0) {
				while ($row = $retrieve_post_result->fetch_assoc()) {
					$post_id = $row['post_id'];
					$post_title = $row['post_title'];
					$post_author = $row['post_author'];
					$post_date = explode(" ",$row['post_date']);
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
					<img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="" style="">
			<?php
				}
			?>

			<hr>
			<p style="text-align: justify;"><?php echo $post_content; ?></p>

			<hr>



		<?php
				}	//Closing the posts while loop here.
			}
			else {
				echo "<p>No posts to show!</p>";
			}
		?>
		</div>
	
		<?php include "includes/sidebar.php"; ?>
		
<?php include "includes/footer.php"; ?>