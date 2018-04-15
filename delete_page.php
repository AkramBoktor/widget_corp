<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	if (intval($_GET['pg']) == 0) {
			header("location:content.php");
			exit();

	}
	
	$id = mysql_prep($_GET['pg']);
	
	if ($page = get_page_by_id($id)) { // exists in the database
		
		$query = "DELETE FROM pages WHERE id =".$id." LIMIT 1";
		$result = mysql_query($query, $connection);
		if (mysql_affected_rows() == 1) {
			header("location:content.php");
			exit();

		} else {
			// Deletion Failed
			echo "<p>Page deletion failed.</p>";
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