<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
include_once 'functions.php';
sec_session_start();
// include_once 'voting.php';

// echo $post_content=$_POST["post_content"];

try {
	if(isset($_POST['post_content'])) {
		$user_id = $_SESSION['user_id'];
		$class_id = $_SESSION['class_id'];
		$post_content = $_POST['post_content'];
        $anonymous=$_POST['anonymous'];

	
		if ($insert_stmt = $mysqli->prepare("INSERT INTO posts (post_content,post_inclass,post_by,anonymous) VALUES (?,?,?,?)")) {
        	    	$insert_stmt->bind_param('sssi', $post_content,$class_id,$user_id,$anonymous);
            		// Execute the prepared query.
       		if ($insert_stmt->execute()) {
		        populate_que();
                header('Location: ../class.php');
    		}
            else{
                header('Location: ../class.php');   
            }

	    }
	}

}

catch(Exception $e) {

    echo $e->getMessage();
}

if(isset($_POST['refresh'])) {
    populate_que();
}


function populate_que() {
    global $mysqli;
    $class_id = $_SESSION['class_id'];
    $sql = "select * from posts where post_inclass='".$class_id."' ORDER BY resolved, votes DESC, post_time DESC";
    echo '<ul class="media-list well">';
    $result=$mysqli->query($sql)
            or die('Query failed');
    if($result->num_rows){
        foreach ($result as $row) {
        echo '<li class="media well"><table><tr><td width="15%">';
        echo '<form role name="vote_submit" method="post" action="includes/voting.php">';
        echo '<input type="hidden" name="vote" value='.$row['post_id'].'>';
        echo '<button class="btn btn-primary pull-left" type="submit" name="submit"><span class="glyphicon glyphicon-chevron-up"> </span><br/>'.$row['votes'].'</button></form></td>';
        // echo '<a class="pull-left btn" type="submit" name="submit"> <span class="glyphicon glyphicon-chevron-up"> </span><br/>'.$row['votes'].'</a>';
        echo '<td width="20%"><div><a class="pull-left" href="#"> <img class="media-object img-circle" src="images/user.jpg" alt="User" width="80" height="80"> </a></div></td>';
        echo '<td><div class="media-body" name=post value='.$row['post_id'].'>';
        echo '<span class="post_content">'.$row['post_content'].'</span><br/>';
        if($row['anonymous']==1) echo '<h6 class="text-muted pull-right"> <span class="post_by"> Post By Anonymous </span> &nbsp;';
        else echo '<h6 class="text-muted pull-right"> <span class="post_by">Post By \''.$row['post_by'].'\'</span> &nbsp;';
        echo '<span class="post_time">on '.date("d.m.Y H:i", strtotime($row['post_time'])).'</span></h6>';
        
        echo '</div></td></tr></table></li>';
    }
    echo '</ul>';
    }
    else{
        echo 'No content found';
    }
    echo '</ul>';
    
}
?>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/docs.js"></script>
