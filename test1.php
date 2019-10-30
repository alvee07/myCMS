<?php
/****************************************************************************************************
R. V. Sampangi. 2017. Solution for Server Side Scripting Assignment 3. In INFX2670: Introduction to
Server Side Scripting, Faculty of Computer Science, Dalhousie University, NS, Canada.
 ****************************************************************************************************/

//$db_host = "db.cs.dal.ca";
//$db_username = "akash";
//$db_password = "B00723716";
//$db_name = "akash";

$db_host = "localhost";
$db_username = "root";
$db_password = "root";
$db_name = "image";

$conn = new mysqli ($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die ("Error connecting to the DB.<br>" . $db->connect_error);
}
/* For debug purposes only. This is otherwise not required.*/
else {
    echo "Connected! localhost<br><br>";
}

if (isset($_POST['submit'])){


    $img_name = $_FILES['user_image']['name'];
    print_r($_FILES['user_image']);
    $img_temp = $_FILES['user_image']['tmp_name'];
    $img_data = addslashes(file_get_contents($img_temp));
    //$img_data = base64_encode($img_data);
    //echo $img_temp;

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $img_temp);

    switch ($mime) {
        case 'image/jpeg':
        case 'image/png':
            echo "<br>This is image<br>";

            $sql = "INSERT INTO image (name, data) VALUES ('$img_name' , '$img_data')";
            //echo "<br>$sql<br>";
            $result = $conn->query($sql);

            if ($result){
                echo "<br>Image uploaded";
            }
            else{
                echo "<br>Image not uploaded";
            }

            break;

        default:
            die("<br>Unknown file type. Your image cannot be uploaded.<br>");
    }



}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <title>Database Image</title>

</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a id="use" class="navbar-brand" href="javascript:void(0)"><?php echo "CMS".$_SESSION['who']; ?></a>

        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
            <ul class="nav navbar-nav navbar-right">

                <li><a href='<?php if($page==true){echo "../../index.php";} else {echo "../index.php";}?>'>View Your Site</a></li>


                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $_SESSION['fname']; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href='<?php if($page==true){echo "../dashboard.php";} else {echo "dashboard.php";}?>'>Dashboard</a></li>
                        <li><a href='<?php if($page==true){echo "../profile.php";} else {echo "profile.php";}?>'>Profile</a></li>
                        <li><a href='<?php if($page==true){echo "logout.php";} else {echo "includes/logout.php";}?>'>Logout</a></li>
                    </ul>
                </li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>








<!-- Container -->
<div class="container myContainer">
    <div class="row">
        <?php $current_page = basename($_SERVER['PHP_SELF']); ?>
        <form action="<?php echo $current_page; ?>" method="post" enctype="multipart/form-data">

            <div class="row col-lg-12">
                <div class="form-group">
                    <label for="user_image">User Image</label>
                    <input type="file" name="user_image" required>
                    <br>
                </div>
            </div>
            <?php //echo "Connected!"; ?>
            <div class="row col-lg-12">
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="Add image">
                </div>
            </div>
        </form>
    </div>

</div>
<div class="container">
    <br><br><br>
    <?php
    $sql = "SELECT * FROM image";
    //echo $sql;
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()){

        echo "<img height='300px' width='300px' src='data:image;base64,".base64_encode($row[data])."' alt='No Image file'/>";
    }
    ?>
</div>

</body>
</html>