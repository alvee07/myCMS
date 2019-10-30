

<?php


if(isset($_POST['edit_post'])) {
    /*
     * Retrieve all the form values using the $_POST superglobal.
     */
    $post_id = test_form_input($_POST['post_id']);
    $post_title = test_form_input($_POST['post_title']);
    $post_category = test_form_input($_POST['post_category_id']);
    $post_author = test_form_input($_POST['post_author']);

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    $post_image_filesize = $_FILES['post_image']['size'];

    $post_status = test_form_input($_POST['post_status']);
    $post_tags = test_form_input($_POST['post_tags']);
    $post_content  = test_form_input($_POST['post_content']);

    echo $post_id."<br>";
    echo $post_title."<br>";
    echo $post_category."<br>";
    echo $post_author."<br>";
    echo $post_status."<br>";
    echo $post_tags."<br>";
    echo $post_content."<br>";
    echo $post_image."<br>";


    if($post_image != "") {
        /*
         * This section of the code manages image uploads. As discussed in class,
         * we check if the file is of a specified type, and within the allowed file-size.
         */
        $target_file = "../../images/" . $post_image;
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $post_image_temp);

        /*
         * A list of MIME types are available here:
         * http://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types
         */

        switch ($mime) {
            case 'image/jpeg':
            case 'image/png':
                if ($post_image_filesize < TWO_MEGA_BYTES) {
                    //Upload the image.
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

    if ($post_image == ""){

        $sql = "UPDATE posts SET post_cat_id='$post_category', post_title='$post_title', post_author='$post_author', post_date=now(), post_content='$post_content', post_tags='$post_tags', post_status='$post_status' WHERE post_id='$post_id'";
        echo $sql;

        $submit_post_result = $conn->query($sql);

        if (!$submit_post_result) {
            die ("<br>"."Error updating post without image.<br>" . $conn->error . "<br>");
        }
    }

    else{

        $sql = "UPDATE posts SET post_cat_id='$post_category', post_title='$post_title', post_author='$post_author', post_date=now(), post_image='$post_image', post_content='$post_content', post_tags='$post_tags', post_status='$post_status' WHERE post_id='$post_id'";
        echo $sql;

        $submit_post_result = $conn->query($sql);

        if (!$submit_post_result) {
            die ("<br>"."Error updating post with image.<br>" . $conn->error . "<br>");
        }
    }

    header("Location: ../view_posts.php");
}


?>