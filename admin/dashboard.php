
<?php

//ini_set('display_errors', 1);
include "includes/header.php";
include "includes/left_sidebar.php";
include "includes/db.php";
include "includes/functions.php";
global $conn;

if ($_SESSION[role]==0 or $_SESSION[role] ==1) { ?>


    <div id="right" class="col-sm-12 col-lg-10">
        <div class="row">

            <div class="<?php if ($_SESSION[role] == 1) echo 'col-sm-6'; else echo 'col-sm-4'; ?>">
                <div class="panel panel-default">
                    <div class="panel-heading">Recent Posts</div>
                    <div class="panel-body">
                        <p><?php recent_posts($_SESSION[role], $_SESSION[fname]);?></p>

                    </div>
                </div>
            </div>

            <div class="<?php if ($_SESSION[role] == 1) echo 'col-sm-6'; else echo 'col-sm-4'; ?>">
                <div class="panel panel-default">
                    <div class="panel-heading">Recent Comments</div>
                    <div class="panel-body">
                        <p><?php recent_comments($_SESSION[role], $_SESSION[fname]); ?></p>
                    </div>
                </div>
            </div>
            <?php if ($_SESSION[role] == 0) { ?>
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Recent Users</div>
                        <div class="panel-body">
                            <p><?php recent_users(); ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>



    <?php
}
else
header("location: profile.php");
include "includes/footer.php";

?>

