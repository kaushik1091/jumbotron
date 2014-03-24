<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();

include_once 'includes/classlist.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Kaushik">
    <link rel="shortcut icon" href="images/experiments.ico">

    <title>Jumbotron - Choice</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
</head>

<body>

    <?php if (login_check($mysqli) == true) : ?>
       
    <a class="pull-right" href="includes/logout.php">LogOut&nbsp;&nbsp;</a>
    <!-- <br/><br/><br/><br/><br/> -->
     <center><h3> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Good to see you, <?php echo htmlentities($_SESSION['user_name']); ?>!</h3></center>
     <br/>
     <h4 class="text-muted"><center>Please choose an option</center></h4>
    <div class="well" style="max-width: 400px; margin: 0 auto 10px;">
        <a href="create.php" class="btn btn-primary btn-lg btn-block">
            Create Class
        </a>

        <br/>

        <a href="joinclass.php" class="btn btn-success btn-lg btn-block">
            Join Class
        </a>
    </div>
    <br/><br/>

    <div class="col-md-4 col-md-offset-1">
        <h4> <center>Classes By YOU</center> </h4>
        <?php myclasslist() ?>
    </div>

    <div class="col-md-4 col-md-offset-1">
        <h4><center>Attended Classes</center></h4>
        <?php attendedclass() ?>
    </div>

    <?php else : ?>
        <script>
            window.alert("You are not authorized to access this page.\n\n\t\t\tPlease LogIn");
            window.location.href='index.php';
        </script>
    <?php endif; ?>

        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/docs.js"></script>

</body>
</html>