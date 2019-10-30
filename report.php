<?php //ini_set('display_errors', 1); ?><!--
	/****************************************************************************************************
	Modified by Alvee Hassan Akash
	*****************************************************************************************************
	R. V. Sampangi. 2017. Solution for Server Side Scripting Assignment 3. In INFX2670: Introduction to Server Side Scripting, Faculty of Computer Science, Dalhousie University, NS, Canada. Used with permission.
	****************************************************************************************************/

	This is the add post page:
	- Includes several other PHP scripts to implement the overall functionality.
	- Allows users to create a new post.
-->

<?php require "includes/functions.php"; ?>
<?php include "includes/header.php"; ?>

		<div class="col-md-8 col-sm-12 col-no-left-padding">
		<?php
			include 'includes/report_form.php';
		?>
		</div>
	
		<?php include "includes/sidebar.php"; ?>
		
<?php include "includes/footer.php"; ?>