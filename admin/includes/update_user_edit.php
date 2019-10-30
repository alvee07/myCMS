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

	if(isset($_POST['edit_user'])) {
		/*
		 * Retrieve all the form values using the $_POST superglobal.
		 */
		$user_id = test_form_input($_POST['user_id']);
		$user_firstname = test_form_input($_POST['user_firstname']);
		$user_lastname = test_form_input($_POST['user_lastname']);
		$user_email = test_form_input($_POST['user_email']);

		$user_image = $_FILES['user_image']['name'];
		$user_image_temp = $_FILES['user_image']['tmp_name'];
		$user_image_filesize = $_FILES['user_image']['size'];

		$user_address = test_form_input($_POST['user_address']);
		$user_phone = test_form_input($_POST['user_phone']);
        $user_role  = test_form_input($_POST['user_role']);


		if($user_image != "") {
			/*
			 * This section of the code manages image uploads. As discussed in class,
			 * we check if the file is of a specified type, and within the allowed file-size.
			 */
			$target_file = "../upload/" . $user_image;
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mime = finfo_file($finfo, $user_image_temp);

			/*
			 * A list of MIME types are available here:
			 * http://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types
			 */

			switch ($mime) {
				case 'image/jpeg':
				case 'image/png':
					if ($user_image_filesize < TWO_MEGA_BYTES) {
						//Upload the image.
						move_uploaded_file($user_image_temp, "$target_file");
					}
					break;
				
				default:
					die("<br>Unknown file type. Your image cannot be uploaded.<br>");
			}
		}
		else { 
			//Otherwise, the user has not set any post image.
			$user_image = "";
		}

		if ($user_image == ""){
            $sql = "UPDATE users SET user_firstname = '$user_firstname', user_lastname = '$user_lastname', user_email = '$user_email',user_address =
              '$user_address', user_phone = '$user_phone', user_role = '$user_role' WHERE user_id = '$user_id'";
            //echo $sql;
//
            $submit_user_result = $conn->query($sql);

            if (!$submit_user_result) {
                die ("Error updating user.<br>" . $conn->error . "<br>");
            }
        }

        else{
            $sql = "UPDATE users SET user_firstname = '$user_firstname', user_lastname = '$user_lastname', user_email = '$user_email',user_address =
              '$user_address', user_phone = '$user_phone', user_role = '$user_role', user_image = '$user_image' WHERE user_id = '$user_id'";
            //echo $sql;
//
            $submit_user_result = $conn->query($sql);

            if (!$submit_user_result) {
                die ("Error updating user.<br>" . $conn->error . "<br>");
            }
        }

        header("Location: ../profile.php");
	}


?>