<?php

// This file used for basic function which you have 

function mysql_prep( $value ) {
		$magic_quotes_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0
		if( $new_enough_php ) { // PHP v4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work
			if( $magic_quotes_active ) { $value = stripslashes( $value ); }
			$value = mysql_real_escape_string( $value );
		} else { // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$magic_quotes_active ) { $value = addslashes( $value ); }
			// if magic quotes are active, then the slashes already exist
		}
		return $value;
	}
	
///////////////////////////////////////////////////////////////

function confirm_query($result_set){

 		if(!$result_set)
     {
        die("Database query Failed : ".mysql_error());
     }
	return $result_set;

 }
///////////////////////////////////////////////////////

function get_all_subjects() {
		global $connection;
		$query = "SELECT * 
				FROM subject 
				ORDER BY position ASC";
		$subject_set = mysql_query($query, $connection);
		confirm_query($subject_set);
		return $subject_set;
	}

	function get_pages_for_subject($subject_id) {
		global $connection;
		$query = "SELECT * 
				FROM pages WHERE subject_id =". $subject_id." AND visible = 1 ORDER BY position ASC";
		$page_set = mysql_query($query, $connection);
		confirm_query($page_set);
		return $page_set;
	}
////////////////////////////////////////////////////

function find_by_sql($sql=""){

	global $connection;
	 $subject_set = mysql_query($sql,$connection);
		return $subject_set;
	}
//////////////////////////////////////////////////

function find_by_id($id=0){

	global $connection;
	
	$result_set = mysql_query("SELECT * FROM pages 
		                       WHERE subject_id =" . $id ."
		                       ORDER BY position ASC",$connection);
	
	return confirm_query($result_set);
}
///////////////////////////////////////////////////


function get_subject_by_id($subject_id){

	global $connection;
	
	$result_set = mysql_query("SELECT * FROM subject 
		                       WHERE id =" . $subject_id ." 
		                       LIMIT 1",$connection);
	
	 confirm_query($result_set);
	 // REMEMBER:
	 // if no rows are retuned fetch_array will return fals
	 if($subject_content = mysql_fetch_array($result_set))
	 {
	 		 return $subject_content; 
	 }else{
	 	return NULL;
	 }
}

////////////////////////////////////////////////////////

function get_page_by_id($page_id){

	global $connection;
	
	$result_set = mysql_query("SELECT * FROM pages 
		                       WHERE id =". $page_id ." 
		                       LIMIT 1",$connection);
	
	 confirm_query($result_set);
	 // REMEMBER:
	 // if no rows are retuned fetch_array will return fals
	 if($page_content = mysql_fetch_array($result_set))
	 {
	 		 return $page_content; 
	 }else{
	 	return NULL;
	 }
}

?>