<?php

	session_start();

	function confirm_session(){

		if(!isset($_SESSION['user_id'])){
			header("location:login.php");
			exit();
		}
	}

?>