<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
include_once 'functions.php';
sec_session_start();
?>

<html>
	<?php
    
		
		$class_id=$_POST["class_id"];
        $user_id=$_SESSION["user_id"];

    	$_SESSION['class_id'] = $class_id;

    	if ($stmt = $mysqli->prepare("SELECT class_id,class_name 
                                    FROM class
                                    WHERE class_id = ?")) {

                $stmt->bind_param('s', $class_id);
        
                // Execute the prepared query.
                $stmt->execute();
                $stmt->store_result();
         
                $stmt->bind_result($class_id,$class_name);
                $stmt->fetch();
    		if($stmt->num_rows == 1){

                if ($insert_stmt = $mysqli->prepare("INSERT INTO attendance (user_id,class_id,class_name) VALUES (?, ?, ?)")) {
                    $insert_stmt->bind_param('sss', $user_id, $class_id, $class_name);
                    // Execute the prepared query.
                    if (! $insert_stmt->execute()) {
                        header('Location: ../error.php?err=Failed to attend class');
                    }
                }
                else{
                    header('Location: ../error.php?err=Failed to prepare attendance');
                }
            	header('Location: ../class.php');
            }
    		else {
    			header('Location: ../joinclass.php?err= Err.... Sorry, This Class does NOT exist');
        	}
    	}
    	else{
    		header('Location: ../joinclass.php?err= Oops.... Cannot load class');
    	}

?>