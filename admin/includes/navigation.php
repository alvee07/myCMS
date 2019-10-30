

<?php
$page;
$current_page = basename($_SERVER['PHP_SELF']);
$pages = array("add_user.php","comments24.php" ,"edit_post.php", "edit_profile.php", "edit_user.php", "view_all_posts.php", "view_all_users.php", "view_profile.php");
$numbers = count($pages);
for ($x=0; $x<$numbers;$x++) {
    //echo $pages[$x];
    if ($current_page == $pages[$x]) {
        $page = true;
        //echo $page . "....." . $current_page . ".....in the includes folder";
        break;
    } else {
        $page = false;
        //echo $page . "....." . $current_page . ".....in the admin folder";
    }
}
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
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
                <li><a href='<?php if($page==true){echo "logout.php";} else {echo "includes/logout.php";}?>'>Logout</a></li>
<!--  no more dropdown, as it is not working
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $_SESSION['fname']; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href='<?php if($page==true){echo "../dashboard.php";} else {echo "dashboard.php";}?>'>Dashboard</a></li>
                        <li><a href='<?php if($page==true){echo "../profile.php";} else {echo "profile.php";}?>'>Profile</a></li>
                        <li><a href='<?php if($page==true){echo "logout.php";} else {echo "includes/logout.php";}?>'>Logout</a></li>
                    </ul>
                </li>
-->
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<?php
/*
if ($_SESSION[role] == 0) {
    if (isset($_GET['enc'])) {
        if ($_GET['enc'] == 1) {
            echo "<li><a>Passwords Secured</a></li>";
        }
    }
    if (!isset($_GET['enc'])) {?>
        <li><a href='<?php if($page==true){echo "../secure_all_passwords.php";} else {echo "secure_all_passwords.php";}?>'>Secure All Passwords</a></li>
    <?php }
}*/
?>