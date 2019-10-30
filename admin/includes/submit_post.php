<!--
	/****************************************************************************************************
	Modified by Alvee Hassan Akash
	*****************************************************************************************************
	R. V. Sampangi. 2017. Solution for Server Side Scripting Assignment 3. In INFX2670: Introduction to Server Side Scripting, Faculty of Computer Science, Dalhousie University, NS, Canada. Used with permission.
	****************************************************************************************************/
-->

<?php
	/****************************************************************************************************
	R. V. Sampangi. 2017. Solution for Server Side Scripting Assignment 3. In INFX2670: Introduction to 
	Server Side Scripting, Faculty of Computer Science, Dalhousie University, NS, Canada.

	This script records the form data submitted by the user to create a new post, and submits this
	record to the DB table, i.e. it creates a new post in the DB table! 
	****************************************************************************************************/

	if(isset($_POST['create_post'])) {
		/*
		 * Retrieve all the form values using the $_POST superglobal.
		 */
		$post_author = test_form_input($_POST['post_author']);
		$post_title = test_form_input($_POST['post_title']);
		$post_category_id = test_form_input($_POST['post_category_id']);
		$post_status = test_form_input($_POST['post_status']);

		$post_image = $_FILES['post_image']['name'];
		$post_image_temp = $_FILES['post_image']['tmp_name'];
		$post_image_filesize = $_FILES['post_image']['size'];

		//echo $post_image;
		//echo $post_image_temp;
		//echo $post_image_filesize;

		$post_content = test_form_input($_POST['post_content']);
		$post_tags = test_form_input($_POST['post_tags']);
		$post_comments = 0;

		if($post_image != "") {
			/*
			 * This section of the code manages image uploads. As discussed in class,
			 * we check if the file is of a specified type, and within the allowed file-size.
			 */
			$target_file = "../images/" . $post_image;
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mime = finfo_file($finfo, $post_image_temp);

			/*
			 * A list of MIME types are available here:
			 * http://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types
			 */

			//echo $target_file . "<br>";

			switch ($mime) {
				case 'image/jpeg':
				case 'image/png':
					if ($post_image_filesize < TWO_MEGA_BYTES) {
						//Upload the image.
                        //echo "here<br>";
						move_uploaded_file($post_image_temp, "$target_file");
					}
					break;
				
				default:
					die("<br>Unknown file type. Your image cannot be uploaded.<br>");
			}
		} 
		else { 
			//Otherwise, the user has not set any post image.
			$post_image = "";
		} 

		$sql = "INSERT INTO posts(post_cat_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comments, post_status) ";
		$sql .= "VALUES('$post_category_id','$post_title','$post_author',now(),'$post_image','$post_content','$post_tags','$post_comments','$post_status')";


		$submit_post_result = $conn->query($sql);

		if (!$submit_post_result) {
			die ("Error creating post.<br>" . $conn->error . "<br>");
		}
	}


?>