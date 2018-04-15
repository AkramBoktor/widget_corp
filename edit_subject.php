<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_session();?>
<?php 
	
	if(isset($_POST['submit']))
	{
		$errors = array();
	    $required_fields = array('menu_name','position','visible');
	    foreach ($required_fields as $fieldname) {
	    	# code...
	    	if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname]) && $_POST[$fieldname]!=0){
	    		$errors[]=$fieldname;
	    	
	          }
	        }

	    if(empty($errors)){
	    	// update
	    	$id = mysql_prep($_GET['subj']);
	    	$sub_name = mysql_prep(trim($_POST['menu_name']));
			$position = mysql_prep(trim($_POST['position']));
			$visible  = mysql_prep(trim($_POST['visible']));

	    	$query = "UPDATE subject SET 
	    			 menu_name = '$sub_name',
	    			 position  = '$position',
	    			 visible   = '$visible'
	    			 WHERE id  = '$id' ";
			$result=mysql_query($query,$connection);
		if(mysql_affected_rows()==1){
				//success
				$message = "The subject was Successful updated ";
		}else{
			//failed
				$message = "The subject updated failed".mysql_error();

		}
	 }//end of empty errrors
		else{

			//Display error message

			 $message = "there were ".count($errors)." errors in the form";
		}
	    
		
	}// end if(isset($_POST['submit']))
?>
<?php
	//this code for content area in your body

	if(isset($_GET['subj'])){

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
						<h2>Edit Subject : <?php echo $sel_subject['menu_name'];?></h2>
						<form action="edit_subject.php?subj=<?php echo $sel_subject['id']; ?>" method="post">
                         <?php if(!empty($message)){ echo $message;} // Message ?> 
                        
                         <?php
                         		//print the errors
                         		if(!empty($errors)){
                         			echo "Please review the following fields : </br>";

                         			foreach ($errors as $error) {
                         				# code...
                         				echo "_". $error ."_";
                         			}
                         		}
                         ?>
							<p>Subject name:
								<input type="text" name="menu_name" 
								value="<?php echo $sel_subject['menu_name']?>" required/>
							</p>
							<p>Position:
								<select name="position" required>
									<?php
										$subject_all = get_all_subjects();
										$subject_count = mysql_num_rows($subject_all);
										// subject $i +1 because we adding new subject
										for($i=1;$i<=$subject_count+1;$i++)
										{
											echo "<option value=\"$i\"";
											if($sel_subject['position']==$i){echo "selected";}
											echo ">$i</option>";
										}
									?>
										
								</select>
							</p>
							<p>Visible:
								<input type="radio" value="0" name="visible"
								 <?php 
									if($sel_subject['visible']==0){
										echo "checked";
									}
								?> required/>No
								
								<input type="radio" value="1" name="visible"
								 <?php 
									if($sel_subject['visible']==1){
										echo "checked";
									}
								?> required/> Yes
							</p>
							<input type="submit" name ="submit" value="Edit Subject" />
						</form>
						</br>
						<a href="content.php"> Cancel </a>&nbsp;
						<a href="delete_subject.php?subj=
						<?php echo urlencode($sel_subject['id']); ?>" onclick="return confirm('Are you sure')";> Delete subject </a>
						   
						<!-- Get pages According to subject -->

		<div style="margin-top: 2em; border-top: 1px solid #000000;">
				<h3>Pages in this subject:</h3>
				<ul>
<?php 
	$page_for_subject = get_pages_for_subject($sel_subject['id']);
	while($pages_subject=mysql_fetch_array($page_for_subject))
	{
		echo "<li><a href=\"content.php?pg=".$pages_subject['id']."\">".$pages_subject['menu_name'].
		"</a></li>";
	}
?>
				</ul>
				<br />
				+ <a href="new_page.php?subj=<?php echo $sel_subject['id']; ?>">Add a new page to this subject</a>
			</div>
					

					</td>
			</table>

<?php include("includes/footer.php"); ?>
