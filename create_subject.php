<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_session();?>
<?php
      //Form Validation
	    $errors = array();
	    $required_fields = array('menu_name','position','visible');
	    foreach ($required_fields as $fieldname) {
	    	# code...
	    	if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname]))
	    		$errors[]=$fieldname;
	    }

		$sub_name = mysql_prep(trim($_POST['menu_name']));
		$position = mysql_prep(trim($_POST['position']));
		$visible  = mysql_prep(trim($_POST['visible']));

		$query = "INSERT INTO subject (menu_name,position,visible)
				   VALUES ('$sub_name','$position','$visible')";
		if(mysql_query($query,$connection)){
			//success
			header("location:content.php");
			exit;
		}else{

			//Display error message

			echo "<p> Subject Creation Failed </p>".mysql_error();
		}

	

?>
	

<?php include("includes/footer.php"); ?>
