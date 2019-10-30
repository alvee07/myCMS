<!--

	This script displays the actual login form.
	Created a separate file for this form to facilitate re-use.
-->
<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<form action="includes/login.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" required>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-xs-6 col-md-6">
                <input type="submit" class="btn btn-primary" name="login" value="Login">
            </div>
            <div class="col-xs-6 col-md-6 text-right">
                <a href="register.php">Need an account? Register here</a>
            </div>
        </div>
    </div>
</form>
<a href="#">Forgot password</a>




