<?php

include_once 'db_connect.php';
include_once 'psl-config.php';
include_once 'functions.php';
sec_session_start();

try {
    if(isset($_POST['vote'])) {
        $post_id=$_POST['vote'];
        $voter_id=$_SESSION['user_id'];

        function vote($post_id,$voter_id){
            $count=0;
            global $mysqli;

            if ($stmt = $mysqli->prepare("SELECT COUNT(*) FROM vote_record WHERE post_id = ? and voter_id = ?")) {
                    $stmt->bind_param('is', $post_id,$voter_id);
                // Execute the prepared query.
                $stmt->execute();
                $stmt->store_result();

                // get variables from result.
                $stmt->bind_result($count);
                $stmt->fetch();
                // echo $count;

            if ($count==0){
                $votes=1;
                if ($insert_stmt = $mysqli->prepare("INSERT INTO vote_record (post_id,voter_id) VALUES (?,?)")) {
                          $insert_stmt->bind_param('is', $post_id,$voter_id);
                          // Execute the prepared query.
                    if ($insert_stmt->execute()) {

                        if ($stmt = $mysqli->prepare("SELECT COUNT(*) FROM vote_record WHERE post_id = ?")) {
                                    $stmt->bind_param('i', $post_id);
                                // Execute the prepared query.
                            $stmt->execute();
                            $stmt->store_result();
         
                            // get variables from result.
                            $stmt->bind_result($count);
                            $stmt->fetch();
                            echo $count;

                                if ($update_stmt = $mysqli->prepare("UPDATE posts SET votes=? WHERE post_id=?")) {
                                            $update_stmt->bind_param('is',$count,$post_id);
                                    // Execute the prepared query.
                                    if ($update_stmt->execute()) {
                                    // populate_que();
                            }
                        }
                    }
                  }
               }
           }
        }
    }
        vote($post_id,$voter_id);
        header('Location: ../class.php');
    }
}
catch(Exception $e) {
    echo $e->getMessage();
}
?>