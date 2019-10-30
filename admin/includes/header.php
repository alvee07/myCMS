<?php //ini_set('display_errors', 1); ?>


<?php

$current_page = basename($_SERVER['PHP_SELF']);
$pages = array("add_user.php","comments24.php" ,"edit_post.php", "edit_profile.php", "edit_user.php", "view_all_posts.php", "view_all_users.php", "view_profile.php");
$numbers = count($pages);
for ($x=0; $x<$numbers;$x++) {
    //echo $pages[$x];

    if ($current_page == $pages[$x]) {
        $page = true;
        $name_page = "Include Folder";
        //echo $page . "....." . $current_page . ".....in the includes folder";
        break;
    } else {
        $page = false;
        $name_page = "Admin Panel";
        //echo $page . "....." . $current_page . ".....in the admin folder";
    }
}
?>



<?php require_once "db.php"; ?>
<?php require_once "constants.php"; ?>
<?php
session_start();
$loggedIn = $_SESSION['loggedIn'];
$loginError = $_SESSION['loginError'];
if ($loggedIn && !$loginError) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php if($page==true){echo "../../css/bootstrap.css";} else {echo "../css/bootstrap.css";}?>">
        <link rel="stylesheet" href="<?php if($page==true){echo "../../css/bootstrap.min.css";} else {echo "../css/bootstrap.min.css";}?>">
        <link rel="stylesheet" href="<?php if($page==true){echo "../../css/mystyles.css";} else {echo "../css/mystyles.css";}?>">
        <title><?php echo $name_page; ?></title>
    </head>
<body>
    <!-- Container -->
    <div class="container">
        <div class="row">
            <?php
            $current_page = basename($_SERVER['PHP_SELF']);
            //echo $current_page;
            ?>

            <?php require_once "navigation.php"; ?>

        </div>
    </div>
    <div class="container myContainer" id="main">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
    <?php
}
else {header("Location: ../index.php?unauthAccess=true"); session_destroy();}

?>