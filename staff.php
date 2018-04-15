<?php session_start();?>
<?php include("includes/header.php"); ?>
<?php
	if(!isset($_SESSION['user_id'])){
		header("location:login.php");
		exit();
	}
?>


			<table id="structure">
				<tr>
					<td id="navigation">
						&nbsp;
					</td>
					<td id="page">
						<h2>Staff Menu</h2>
						<p>Welcome to the staff area, <?php echo $_SESSION['username'];?>.</p>
						<ul>
							<li><a href="content.php">Manage Website Content</a></li>
							<li><a href="new_user.php">Add Staff User</a></li>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</td>
				</tr>
			</table>
	

<?php include("includes/footer.php"); ?>
