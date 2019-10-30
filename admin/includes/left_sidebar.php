


<?php
$page;
$current_page = basename($_SERVER['PHP_SELF']);
$pages = array("add_user.php", "edit_post.php", "edit_profile.php", "edit_user.php", "view_all_posts.php", "view_all_users.php", "view_profile.php");
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
<div class="col-sm-12 col-lg-2" id="try">
    <div class="container">
        <div class="sidenav">

            <?php if ($_SESSION[role] == 0 || $_SESSION[role] == 1) {
                ?><a href='<?php if ($page == true) {
                    echo "../dashboard.php";
                } else echo "dashboard.php"; ?>'>Dashboard</a>
                <?php
            }
            ?>
            <a data-toggle="collapse" data-target="#post" href="#">Posts <span class="caret"></span></a>
            <div id="post" class="collapse out">
                <a href='<?php if($page==true){echo "../view_posts.php";} else echo "view_posts.php";?>'>View All Post</a>
                <a href='<?php if($page==true){echo "../add_post.php";} else echo "add_post.php";?>'>Add New Post</a>
            </div>

            <a href="<?php if($page==true){echo "../categories.php";} else echo "categories.php";?>">Categories</a>
            <a href="<?php if($page==true){echo "../comments.php";} else echo "comments.php";?>">Comments</a>

            <a data-toggle="collapse" data-target="#user" href="#">Users <span class="caret"></span></a>
            <div id="user" class="collapse out">
                <a href='<?php if($page==true){echo "../view_users.php";} else echo "view_users.php";?>'>View All Users</a>
                <a href='<?php if($page==true){echo "add_user.php";} else echo "includes/add_user.php";?>'>Add New User</a>
            </div>
            <a href='<?php if($page==true){echo "../profile.php";} else echo "profile.php";?>'>Profile</a>
        </div>
    </div>
</div>