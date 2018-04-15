<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_session();?>
<?php
	if (intval($_GET['subj']) == 0) {
			header("location:content.php");
			exit();

	}
	
	$id = mysql_prep($_GET['subj']);
	
	if ($subject = get_subject_by_id($id)) { // exists in the database
		
		$query = "DELETE FROM subject WHERE id = {$id} LIMIT 1";
		$result = mysql_query($query, $connection);
		if (mysql_affected_rows() == 1) {
			header("location:content.php");
			exit();

		} else {
			// Deletion Failed
			echo "<p>Subject deletion failed.</p>";
			echo "<p>" . mysql_error() . "</p>";
			echo "<a href=\"content.php\">Return to Main Page</a>";
		}
	} else {
		// subject didn't exist in database
			header("location:content.php");
			exit();
	}
?>

<?php mysql_close($connection); ?>