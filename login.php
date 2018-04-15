<?php session_start();?>
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
			$query = "SELECT id,username FROM users 
					  WHERE username = '$username' AND
					  password = '$hash_pass' LIMIT 1";
			$result= mysql_query($query,$connection);
			confirm_query($result);

			if($found_user=mysql_fetch_array($result))
			{
				$_SESSION['user_id'] = $found_user['id'];
				$_SESSION['username'] = $found_user['username'];
				header("location:staff.php");
				exit();		

			}else{
				$message = "Username/Password combination incorret".mysql_error();
			}
		}// end if empty error
		else{
				$message= "there were ".count($error)." errors in the form";


			}
		
	}else{//form hasn't been submitted

	if(isset($_GET['logout'])&&$_GET['logout']==1)
	{
		$message = "You are now logged out";
	}
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
						<a href="index.php"> Return to public site </a>
					</ul>

					</td>
					<td id="page">
					<h2>Staff Login </h2>
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
						<form action="login.php" method="post">
							<p>username:<input type="text" name="username"></p>
							<p>Password:<input type="text" name="password"></p>
							<input type="submit" name="submit" value="Login">

						</form>

					</td>
			</table>
	

<?php include("includes/footer.php"); ?>
