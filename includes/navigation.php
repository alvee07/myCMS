
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false" onclick="openNav()">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">myCMS</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="max-height: 355px">
            <ul class="nav navbar-nav">
                <?php

                //  List of categories
                $active = basename($_SERVER['PHP_SELF']);
                $sql = "SELECT * FROM category";

                $select_categories_result = $conn->query($sql);

                if ($select_categories_result->num_rows > 0) {

                    while ($row = $select_categories_result->fetch_assoc()) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];

                        echo "<li><a href='category_posts.php?cat_id=$cat_id'>$cat_title</a></li>";
                    }
                }

                //Use $active in in-line scripts below to set a nav item as active
                ?>

            </ul>


            <ul class="nav navbar-nav navbar-right">
                <li id="mob-login" style="display: none;"><a href="#login">Login</a></li>
                <?php

                if(($_SESSION['loggedIn']) == true) {?>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo $_SESSION['fname']; ?>
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">

                            <li><a href='admin/profile.php'>Profile</a></li>
                            <li><a href='admin/includes/logout.php'>Logout</a></li>
                        </ul>
                    </li>
                <?php } ?>

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<!--

fixed the height of the nav bar and use it in the main_body margintop to go down when humburger clicks.
also needs some javascript and Css fixed.

-->


<script>
    function openNav() {
        document.getElementById("main_body").style.marginTop = "200px";
    }

    /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
    function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
    }

</script>
