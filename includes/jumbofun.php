<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
include_once 'functions.php';
sec_session_start();
?>

<html>
	<?php

		function unique_id($l = 8) {
        	return substr(md5(uniqid(mt_rand(), true)), 0, $l);
    	}
    
    	$class_by=$_SESSION['user_id'];
		$class_id=(string)unique_id();
		$class_name=$_POST["class_name"];

		if ($insert_stmt = $mysqli->prepare("INSERT INTO class (class_id, class_name, class_by) VALUES (?, ?, ?)")) {
        	    $insert_stmt->bind_param('sss', $class_id, $class_name, $class_by);
            	// Execute the prepared query.
            	if (! $insert_stmt->execute()) {
                	header('Location: ../error.php?err=Failed to create class');
            	}
    	}
    	$_SESSION['class_id'] = $class_id;
    	$_SESSION['class_name'] = $class_name;
    	header('Location: ../class.php');

?>
