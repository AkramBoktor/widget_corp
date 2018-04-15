<?php

//four step to destroy the session

	session_start();
	session_unset(); // unset all the values
	
	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(),'',time()-42000,'/');
	}
	
	session_destroy();
	header("location:login.php?logout=1"); /* ف صفحه لوجين هستخدمها ف طباعه مسج*/
	exit();

?>