<?php

include_once 'db_connect.php';
include_once 'psl-config.php';
include_once 'functions.php';
sec_session_start();

try {
    if(isset($_POST['resolved_postid'])) {
        $post_id=$_POST['resolved_postid'];
        $resolved=$_POST['resolved'];

        function resolve($post_id,$resolved){
            global $mysqli;

            // if ($stmt = $mysqli->prepare("SELECT resolved FROM posts WHERE post_id = ?")) {
            //         $stmt->bind_param('ii', $post_id,$resolved);
            //     // Execute the prepared query.
            //     $stmt->execute();
            //     $stmt->store_result();

            //     // get variables from result.
            //     $stmt->bind_result($count);
            //     $stmt->fetch();
            //     // echo $count;

            // if ($count==0){
                // $votes=1;
                if ($insert_stmt = $mysqli->prepare("UPDATE posts SET resolved=? WHERE post_id=?")) {
                          $insert_stmt->bind_param('ii', $resolved, $post_id);
                          // Execute the prepared query.
                    if ($insert_stmt->execute()) {
                    }
                }
        }
        resolve($post_id,$resolved);
        header('Location: ../class.php');
       }
    }
catch(Exception $e) {
    echo $e->getMessage();
}
?>