<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_session();?>
<?php
	//this code for content area in your body

	if(isset($_POST['submit']))
	{
		$errors = array();
	    $required_fields = array('menu_name','position','visible','content');
	    foreach ($required_fields as $fieldname) {
	    	# code...
	    	if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname]) && $_POST[$fieldname]!=0){
	    		$errors[]=$fieldname;
	    	
	          }
	        }

	    if(empty($errors)){
	    	// update
	    	$id = mysql_prep($_GET['pg']);
	    	$sub_name = mysql_prep(trim($_POST['menu_name']));
			$position = mysql_prep(trim($_POST['position']));
			$visible  = mysql_prep(trim($_POST['visible']));
			$content  = mysql_prep(trim($_POST['content']));

	    	$query = "UPDATE pages SET 
	    			 menu_name = '$sub_name',
	    			 position  = '$position',
	    			 visible   = '$visible',
	    			 content   =  '$content'
	    			 WHERE id  = '$id' ";
			$result=mysql_query($query,$connection);
		if(mysql_affected_rows()==1){
				//success
				$message = "The page was Successful updated ";
		}else{
			//failed
				$message = "The page updated failed".mysql_error();

		}
	 }//end of empty errrors
		else{

			//Display error message

			echo "there were ".count($errrors)." errors in the form";
		}
	    
		
	}// end if(isset($_POST['submit']))

?>
<?php if(isset($_GET['subj'])){

		$sel_subject = get_subject_by_id($_GET['subj']);
		$sel_page=Null;

	}elseif(isset($_GET['pg'])){

		$sel_page = get_page_by_id($_GET['pg']);
		$sel_subject = Null;
	}else{
		$sel_page= NULL;
		$sel_subject= NULL;
	}
?>
<?php include("includes/header.php"); ?>



			<table id="structure">
				<tr>
					<td id="navigation">
					 <ul class="subjects">
						&nbsp;
						<?php
							// 3- Perform data base query from function.php
							
							// // 4- Read the data 
						 $subjects = find_by_sql("SELECT * FROM subject
						                          ORDER BY position ASC"); // get all subjects by function

							while($row = mysql_fetch_array($subjects))
							{
								echo "<li>
								<a href=\"edit_subject.php?subj=".urlencode($row['id'])."\">".$row['menu_name']."</a></li>";

								$pages = find_by_id($row['id']); // get pages belong to subject by function
								echo "<ul class=\"pages\">";
								while($row = mysql_fetch_array($pages))
								{
									echo "<li>
									<a href=\"content.php?pg=".urlencode($row['id'])."\">".$row['menu_name'].
									"</a></li>";	
								}

								echo "</ul>";
							}

						?>
					</ul>

					</td>
					<td id="page">
						&nbsp;
						<!-- Content of the add new Sbject -->
						<h2>Edit Page : <?php echo $sel_page['menu_name'];?></h2>

						<?php include("page_form.php");?>

						</br>
						<a href="content.php"> Cancel </a>&nbsp;
						<a href="delete_page.php?pg=
						<?php echo urlencode($sel_page['id']); ?>" onclick="return confirm('Are you sure')";> Delete Page </a>

					</td>
			</table>
	

<?php include("includes/footer.php"); ?>
