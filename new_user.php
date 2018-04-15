<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	if(isset($_POST['submit'])){

		$error =array();
		$required_field = array('username','password');
		foreach ($required_field as $fieldname) {
	    	# code...
	    	if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
	    		$error[]=$fieldname;
	    	
	          }
	        }

		$username = trim(mysql_prep($_POST['username']));
		$password = trim(mysql_prep($_POST['password']));
		$hash_pass = sha1($password);

		if(empty($error)){
			$query = "INSERT INTO users (id,username,password)VALUES(null,'$username','$hash_pass')";
			confirm_query($query);

			if(mysql_query($query,$connection))
			{
				$message = "New user successfully created";
			}else{
				$message = "Failed to add new user".mysql_error();
			}
		}// end if empty error
		else{
				$message= "there were ".count($error)." errors in the form";


			}
		
	}else{//form hasn't been submitted
		$username="";
		$password="";
	}
?>
<?php include("includes/header.php"); ?>



			<table id="structure">
				<tr>
					<td id="navigation">
					 <ul class="subjects">
						&nbsp;
						<a href="staff.php"> Return to menu </a>
					</ul>

					</td>
					<td id="page">
					<h2>Creat New User </h2>
					<?php if(!empty($message)){echo $message;}?>
					<?php if(!empty($error))
						{
							echo "Please review the following fields : </br>";

                         			foreach ($error as $errors) {
                         				# code...
                         				echo "-". $errors ."</br>";
                         			}
						}
					?>
						<form action="new_user.php" method="post">
							<p>username:<input type="text" name="username"></p>
							<p>Password:<input type="text" name="password"></p>
							<input type="submit" name="submit" value="create user">

						</form>

					</td>
			</table>
	

<?php include("includes/footer.php"); ?>
