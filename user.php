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
	 	<meta property="og:title" content="Experiments - jumbotron" />
	 	<meta property="og:url" content="http://experiments.sourcenxt.in/jumbotron/" />
 		<meta property="og:site_name" content="Experiments_at_SourceNXT" />


    	<title>Classroom</title>

    	<!-- Bootstrap -->
    	<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="starter-template.css" rel="stylesheet">

		<script type="text/javascript" src="http://www.google.com/jsapi"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

	</head>
  	
  	<body>
        <?php if (login_check($mysqli) == true) : ?>
  		<div class="row well">      <!-- Class info -->
            <!-- <td width="30%">skjv;sdkv';sdkb'dgb</td> -->
                <center><div class="col-md-3"><a href='choice.php'><h3>Jumbotron</h3></a></div>
                <div class="col-md-6"><h3>Class Code: <?php echo $class_id = $_SESSION['class_id']; ?></h3><a href="includes/logout.php" style="align:right;">LogOut</a></div>
                <div class="col-md-3"><h4 class='text-muted pull-right'>Class Name : <?php echo $class_name = $_SESSION['class_name']; ?><br/>
                    Class by : <?php echo $class_byname = $_SESSION['class_byname']; ?></center></h4>
        </div>                  <!-- Class info close -->

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
            <center><p>Attendees Here</p></center>
<!--             <form role name="vote_submit" method="post" action="includes/voting.php">
                <input type="hidden" name="vote" value=1>
                <button class="btn btn-primary btn-block" type="submit" name="submit">Vote</button>
            </form> -->
        </div>
    </div>

    <?php else : ?>
        <p>
             <script> //if (window.confirm('You are not authorized to access this page. Please LogIn')) {
                //                 window.location.href='index.php';
                //         }
                window.alert("You are not authorized to access this page.\n\n\t\t\tPlease LogIn");
                window.location.href='index.php';
            </script>
        </p>
    <?php endif; ?>
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
            url: "includes/post.php",
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
            url: "includes/post.php",
            data: data,
            success: function(html){ // this happen after we get result
                $("#que").html(html);
            }

        });
}


</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../js/bootstrap.min.js"></script>
</body>
</html>