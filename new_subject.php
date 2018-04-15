<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_session();?>

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
								<a href=\"content.php?subj=".urlencode($row['id'])."\">".$row['menu_name']."</a></li>";

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
						<h2>+ Add  Subject</h2>
						<form action="create_subject.php" method="post">
							<p>Subject name:
								<input type="text" name="menu_name" value="" required/>
							</p>
							<p>Position:
								<select name="position" required="">
									<?php
										$subject_all = get_all_subjects();
										$subject_count = mysql_num_rows($subject_all);
										// subject $i +1 because we adding new subject
										for($i=1;$i<=$subject_count+1;$i++)
										{
											echo "<option value=\"$i\">$i</option>";
										}
									?>
										
								</select>
							</p>
							<p>Visible:
								<input type="radio" value="0" name="visible" required>No
								<input type="radio" value="1" name="visible" required>Yes
							</p>
							<input type="submit" value="Add Subject" />
						</form>
						</br>
						<a href="content.php"> Cancel </a>
					</td>
			</table>
	

<?php include("includes/footer.php"); ?>
