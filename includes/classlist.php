<?php
    include_once 'db_connect.php';

    // $user_id=$_SESSION['user_id'];

    function myclasslist(){
    	global $mysqli;
    	$user_id=$_SESSION['user_id'];
    	$sql="SELECT class_name, class_id FROM class where class_by='".$user_id."'";
    	echo '<ul>';
    	$result=$mysqli->query($sql)
        	    or die('Query failed');
    	if($result->num_rows){
        	foreach ($result as $row) {
	        	echo '<table class="table"><tr><td width="100%">';
        		echo '<span>'.$row['class_name'].'</span></td>';
        		echo '<td width="30%"><span>'.$row['class_id'].'</span></td></tr>';
        		// echo "Test";
        	}
        echo '</table></ul>';
    	}
    	else{
    		echo "No Classes Found";
    	}
    	// echo $user_id;
    }

    function attendedclass(){
    	global $mysqli;
    	$user_id=$_SESSION['user_id'];
    	$sql="SELECT DISTINCT class_name, class_id FROM attendance where user_id='".$user_id."'";
    	echo '<ul>';
    	$result=$mysqli->query($sql)
        	    or die('Query failed');
    	if($result->num_rows){
        	foreach ($result as $row) {
	        	echo '<table class="table"><tr><td width="100%">';
        		echo '<span>'.$row['class_name'].'</span></td>';
        		echo '<td width="30%"><span>'.$row['class_id'].'</span></td></tr>';
        		// echo "Test";
        	}
        echo '</table></ul>';
    	}
    	else{
    		echo "<center> You don't seem to have attended any classes </center>";
    	}    	
    }
?>