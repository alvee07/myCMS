<!--
/****************************************************************************************************
Modified by <Alvee Hassan Akash>
 *****************************************************************************************************
R. V. Sampangi. 2017. Solution for Server Side Scripting Assignment 3. In INFX2670:
Introduction to Server Side Scripting, Faculty of Computer Science, Dalhousie University,
NS, Canada. Used with permission.
 ****************************************************************************************************/

	This script displays the actual report form.
	Created a separate file for this form to facilitate re-use.
-->
<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<p>Did you experience any issues on this website? Please submit your detailed message here.</p>

<?php
	if (isset($_GET['issue_reported'])) {
		echo "<p class='text-primary'><br>Thank you for reporting the issue. Your message has been submitted.<br></p>";
	}
?>

<form action="<?php echo $current_page; ?>" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="preferredname">Preferred Name</label>
		<input type="text" class="form-control" name="preferredname" required>
	</div>
	<div class="form-group">
		<label for="email">Email Address</label>
		<input type="email" class="form-control" name="email" required>
	</div>
	<div class="form-group">
		<label for="issues">Type of Issue</label>
		<select class="form-control" name="issues" required>
			<option value='0'>- - - Select The Issue - - -</option>
			<option value='1'>Link Not Working</option>
			<option value='2'>Page Not Found</option>
			<option value='3'>Incorrect Script</option>
		</select>
	</div>
	<div class="form-group">
		<label for="message">Detailed Message</label>
		<textarea class="form-control" name="message" rows=9 required></textarea>
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="reportIssues" value="Submit Your Message">
		<input type="reset" class="btn btn-warning" name="clear" value="Clear">
	</div>
</form>