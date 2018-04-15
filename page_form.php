<form action="edit_page.php?pg=<?php echo $sel_page['id']; ?>" method="post">
                         <?php if(!empty($message)){ echo $message;} // Message ?> 
                        
                         <?php
                         		//print the errors
                         		if(!empty($errors)){
                         			echo "Please review the following fields : </br>";

                         			foreach ($errrors as $error) {
                         				# code...
                         				echo "_". $error ."_";
                         			}
                         		}
                         ?>
							<p>Page name:
								<input type="text" name="menu_name" 
								value="<?php echo $sel_page['menu_name']?>" required/>
							</p>
							<p>Position:
								<select name="position" required>
									<?php

										$page_all = get_pages_for_subject($sel_page['subject_id']);
										$page_count = mysql_num_rows($page_all);
										// subject $i +1 because we adding new subject
										for($i=1;$i<=$page_count;$i++)
										{
											echo "<option value=\"$i\"";
											if($sel_page['position']==$i){echo "selected";}
											echo ">$i</option>";
										}
									?>
										
								</select>
							</p>
							<p>Visible:
								<input type="radio" value="0" name="visible"
								 <?php 
									if($sel_page['visible']==0){
										echo "checked";
									}
								?> required/>No
								
								<input type="radio" value="1" name="visible"
								 <?php 
									if($sel_page['visible']==1){
										echo "checked";
									}
								?> required/> Yes
							</p>

							<p>Content:</p>	
							<textarea name="content" rows="10" cols="30">
								<?php echo $sel_page['content']; ?>
							</textarea>
							</br>

							<input type="submit" name ="submit" value="update Page" />
						</form>