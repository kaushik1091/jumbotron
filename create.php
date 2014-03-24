<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
// include_once 'includes/jumbofun.php';
 
sec_session_start();
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

<body style="background-color:grey;">

	<?php if (login_check($mysqli) == true) : ?>
    
    <center>
        <br/><br/><br/><br/><br/>
        <p>
            <form role="form" action="includes/jumbofun.php" method="post" name="create_class">
                <div class="well" style="max-width: 400px; margin: 0 auto 10px;">
            
                <h3><span class="text-muted">Name the Class<br/></h3></span>
            
                <!-- <input type="text" name="class_name" placeholder="        Class Name  "> -->
                <div class="form-group">
                  <input type="text" placeholder="Class Name" name="class_name" class="form-control">
                  <!-- <input type='hidden' name='class_by' value=<?php $_SESSION['user_id'];?>/>
                  <input type='hidden' name='class_id' value=<?php $user ?> /> -->
                </div>
            
                <!-- <button class="btn btn-primary btn-lg btn-block" type="submit" onclick= "create_class('" .htmlentities($_SESSION['user_name'], ENT_QUOTES). "' , this.form.class_name);">Proceed to Class</button> -->
                <button class="btn btn-primary btn-lg btn-block" type="submit">Create Class</button>

            </form>
        </div>
        </p>
    </center>

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