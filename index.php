<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
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
						 $subjects = find_by_sql("SELECT * FROM subject WHERE visible = 1 
						                          ORDER BY position ASC"); // get all subjects by function

							while($row = mysql_fetch_array($subjects))
							{
								echo "<li>
								<a href=\"index.php?subj=".urlencode($row['id'])."\">".$row['menu_name']."</a></li>";
								if($row['id']==$sel_subject['id'])
								{
									$pages = find_by_sql("SELECT * FROM pages 
		                                                WHERE subject_id =".$row['id']." And visible = 1
		                                                ORDER BY position ASC"); // get pages belong to subject by function
									echo "<ul class=\"pages\">";
									while($row = mysql_fetch_array($pages))
									{
										echo "<li>
										<a href=\"index.php?pg=".urlencode($row['id'])."\">".$row['menu_name'].
										"</a></li>";	
									}

								
									echo "</ul>";
								}
							}

						?>
					</ul></br>

					<a href="new_subject.php"> + Add new Subject </a>
					</td>
					<td id="page">
						<?php
							if(!is_null($sel_subject))
							{
							 	echo "<h2>".htmlentities($sel_subject['menu_name'])."</h2>";
							 }elseif(!is_null($sel_page))
							 {
								 echo "<h2>".htmlentities($sel_page['menu_name'])."</h2>";?>
								 <div class="page_content">
								 	<?php 

								 		echo strip_tags($sel_page['content'],"<b><br><p></a>")."</br></br>";

								 	?>

								 </div>
							 <?php
							}else{
							 	//Both of then is null
							 	echo "<h2>Welcome to Widget Corp</h2>";
							 }
						?>
						

			</table>
	

<?php include("includes/footer.php"); ?>
