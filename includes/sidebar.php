
<?php

//
//  FIRST OF ALL THIS LOGIN SYSTEM IS WORKING PERFECTLY WITH $_GET VARIABLES, NO SESSION IS USED TO LOGIN NOW
//  BUT DON'T ASK HOW IT WORKS. IT TOOK ME 2 DAYS TO LOGIN WITH PASSWORD VERIFY AND $_GET METHOD
//
$try = $_GET['unauthAccess'];

$login_part_start =<<<start
            <div class="panel-heading">Login to your account</div>
				<div class="panel-body">
start;
$login_part_end = <<<start
				</div>
			</div>
start;

?>
<div class="col-md-4 col-sm-12" id="login">
    <div class="form-group">
        <form action="search_results.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search Tags . . . " name="words" required>
<br>
                    <label class="radio-inline">
                        <input type="radio" name="radio" value="tag" required> Tags
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="radio" value="category"> Categories
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="radio" value="author"> Authors
                    </label>

            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-secondary btn-block" name="search">
            </div>

        </form>
    </div>
<br>
    <?php /*
    if (isset($_POST['search'])){
        echo "Here is the radio value<br><br>";
        echo $_POST['radio'];

    }*/
    ?>



    <div class="panel panel-default">
        <?php
        global $loggedIn;
        global $loginError;
        $loggedIn = $_SESSION['loggedIn'];
        $loginError = $_SESSION['loginError'];


        if ($loggedIn && !$loginError) {

                echo "<div class=\"panel-body\">";
                echo "<p class='text-primary'>Welcome, " . $_SESSION[fname] . "</p>";
                echo $_SESSION[time];
                echo "<br>";
                //echo $_SESSION['fname']. $_SESSION['lname']. $_SESSION['username']. $_SESSION['role'];
                echo $login_part_end;
        }

        if (!$loggedIn){
            if ($_GET['status'] == "error") {//  THIS IS GET METHOD TO LOGIN ERROR NO SESSION VARIABLES ARE HERE
                echo $login_part_start;
                if ($try == true) echo "<p style='color: red'>Please don't try, you can not hack, use login interface</p>";
                include 'login_form.php';
                echo "<p class='text-danger'><br>Username or password is wrong.</p>";
            }

           elseif (!isset($_POST['login'])) {
                echo $login_part_start;
                if ($try == true) echo "<p style='color: red'>Please don't try, you can not hack, use login interface</p>";
                include 'login_form.php';
            }
        ?>
        <?php echo $login_part_end; }?>

        <!-- here is the report starts -->
        <?php
        $report_start = <<<ENDREPORT
			<div class="panel panel-default">
				<div class="panel-heading">Encounter any issues? Report them</div>
				<div class="panel-body">
ENDREPORT;
        $report_end = <<<ENDREPORT
				</div>
			</div>	
ENDREPORT;
        $current_page = basename($_SERVER['PHP_SELF']);

        if ($current_page != "report.php") {
            echo $report_start;
            include 'report_form.php';
            echo $report_end;
        }
        ?>
    </div>
</div>

