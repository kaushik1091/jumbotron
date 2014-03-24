<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
include_once '/includes/db_connect.php';
include_once '/includes/functions.php';

sec_session_start();
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Kaushik">
        <link rel="shortcut icon" href="../images/experiments.ico">

        <meta property="og:image" content="http://experiments.sourcenxt.in/images/experiments.ico" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Experiments - Hangman" />
        <meta property="og:url" content="http://experiments.sourcenxt.in/hangman/" />
        <meta property="og:site_name" content="Experiments_at_SourceNXT" />


        <title>Jumbotron</title>

        <!-- Bootstrap -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="starter-template.css" rel="stylesheet">

        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

    </head>
    
    <body>

        <?php if (login_check($mysqli) == true) : ?>

        <?php
    
            $user_id = $_SESSION['user_id'];
            // echo $class_name=$_SESSION["class_name"];
            $class_id = $_SESSION['class_id'];

            if ($stmt = $mysqli->prepare("SELECT class_name, class_by 
                                    FROM class
                                    WHERE class_id = ?")) {

                $stmt->bind_param('s', $class_id);
        
                // Execute the prepared query.
                $stmt->execute();
                $stmt->store_result();
         
                $stmt->bind_result($class_name,$class_by);
                $stmt->fetch();
                // echo $class_name;
                // echo $class_by;
                
                $_SESSION['class_name']=$class_name;
                $_SESSION['class_by']=$class_by;

                //setting session variable for the name of class author/instructor
                if ($stmt = $mysqli->prepare("SELECT user_name 
                                        FROM users
                                        WHERE user_id = ?")) {
                    $stmt->bind_param('s', $class_by);
        
                    // Execute the prepared query.
                    $stmt->execute();
                    $stmt->store_result();
             
                    $stmt->bind_result($class_byname);
                    $stmt->fetch();
                    // echo $class_name;
                    // echo $class_by;
                    $_SESSION['class_byname']=$class_byname;

                }
                else{
                    $_SESSION['class_byname']='Name NOT found';
                }


                //checking if the user is admin for the page
                if($class_by==$user_id){?>

                
<!-- Class info -->
                    <div class="col-md-3"><a href='choice.php'><h3>Jumbotron</h3></a></div>
                    <div class="col-md-6"><center><h3>Class Code: <?php echo $class_id = $_SESSION['class_id']; ?></h3></div>
                    <div class="col-md-3"><h4 class='text-muted pull-right'>Class Name : <?php echo $class_name = $_SESSION['class_name']; ?><br/>
                            Class by : <?php echo $class_byname = $_SESSION['class_byname']; ?></h4>
                    </div>
                <div class="page-header"><center><a href="includes/logout.php" style="align:right;">LogOut</a></center></div>

<!-- Class info close -->

        <div id="que" class="col-xs-12 col-sm-6 col-md-7">

        </div>

        <div class="row col-md-offset-1">
        <div class="col-xs-6 col-md-4">
            <form role="form" name="post_que" method='post' action='includes/post.php'>
                <textarea placeholder="Post Your Question Here" name="post_content" class="form-control" rows="3"></textarea>
                <div><center> Anonymity &nbsp; &nbsp;
                    <input type="radio" name="anonymous" id="optionsRadios1" value="1"> ON &nbsp; &nbsp;
                    <input type="radio" name="anonymous" id="optionsRadios2" value="0" checked> OFF             </center>
                </div>

                <button class="btn btn-primary btn-block" type="submit" name="submit">Post Question</button>
            </form>
        </div>

        <div id="" class="col-xs-6 col-md-4">
            <center><h3>Attendees Here</h3></center>
        </div>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">

$(function() {
    
    //populating que the first time
    refresh_que();
    // recurring refresh every 15 seconds
    setInterval("refresh_que()", 15000);

    $("#submit").click(function() {
        // getting the values that user typed
        // var name    = $("#name").val();
        var post_content = $("#post_content").val();
        // forming the queryString
        var data = 'post_content='+ post_content;
        alert("test");

        // ajax call
        $.ajax({
            type: "POST",
            url: "includes/adminpost.php",
            data: data,
            success: function(html){ // this happen after we get result
                $("#que").slideToggle(500, function(){
                    $(this).html(html).slideToggle(500);
                    $("#post_content").val("");
                });
          }
          
        });    
        return false;
    });
});

function refresh_que() {
    var data = 'refresh=1';
    
    $.ajax({
            type: "POST",
            url: "includes/adminpost.php",
            data: data,
            success: function(html){ // this happen after we get result
                $("#que").html(html);
            }

        });
}


</script>

                <?php } else{

                    header('Location: user.php');

                }
            }       
            
            else{ ?>
            
                <p> Sorry, This Class does NOT exist </p>
            
            <?php }
            ?>

            <?php else : ?>
                <script>
                    window.alert("You are not authorized to access this page.\n\n\t\t\tPlease LogIn");
                    window.location.href='index.php';
                </script>
            <?php endif; ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../js/bootstrap.min.js"></script>
    </body>
</html>