<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) {
    // $logged = 'in';
  header('Location: choice.php');
} else {
    $logged = 'out';
}
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

    <title>Experiments - Jumbotron</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="cover.css" rel="stylesheet">

    <script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
</head>

<body>

<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
  FB.init({
    appId      : '721066251259729',
    status     : true, // check login status
    cookie     : true, // enable cookies to allow the server to access the session
    xfbml      : true  // parse XFBML
  });

  // Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
  // for any authentication related change, such as login, logout or session refresh. This means that
  // whenever someone who was previously logged out tries to log in again, the correct case below 
  // will be handled. 
  FB.Event.subscribe('auth.authResponseChange', function(response) {
    // Here we specify what we do with the response anytime this event occurs. 
    if (response.status === 'connected') {
      // The response object is returned with a status field that lets the app know the current
      // login status of the person. In this case, we're handling the situation where they 
      // have logged in to the app.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // In this case, the person is logged into Facebook, but not into the app, so we call
      // FB.login() to prompt them to do so. 
      // In real-life usage, you wouldn't want to immediately prompt someone to login 
      // like this, for two reasons:
      // (1) JavaScript created popup windows are blocked by most browsers unless they 
      // result from direct interaction from people using the app (such as a mouse click)
      // (2) it is a bad experience to be continually prompted to login upon page load.
      FB.login();
    } else {
      // In this case, the person is not logged into Facebook, so we call the login() 
      // function to prompt them to do so. Note that at this stage there is no indication
      // of whether they are logged into the app. If they aren't then they'll see the Login
      // dialog right after they log in to Facebook. 
      // The same caveats as above apply to the FB.login() call here.
      FB.login();
    }
  });
  };

  // Load the SDK asynchronously
  (function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
  }(document));

  // Here we run a very simple test of the Graph API after login is successful. 
  // This testAPI() function is only called in those cases. 
  function testAPI() {
    alert('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      alert('Good to see you, ' + response.name + '.');
    });
  }
</script>

<!--
  Below we include the Login Button social plugin. This button uses the JavaScript SDK to
  present a graphical Login button that triggers the FB.login() function when clicked. -->

<!--<fb:login-button show-faces="true" width="200" max-rows="1"></fb:login-button>-->



    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">


          <div class="masthead clearfix">
            <div class="inner">
              <a href="#home" onclick="show('home')"><h3 class="masthead-brand">Classroom Jumbotron</h3></a>
              <ul class="nav masthead-nav">
                <li><a href="http://experiments.sourcenxt.in/#projects" onclick="show('projects')"> &lt &lt Back to Projects</a></li>
                
              </ul>
            </div>
          </div>

          <div class="innercover" id="home">
            <h1 class="cover-heading">Classroom</h1>
            <p class='lead'>

              <span class="text-muted">Enter Classroom Jumbotron</span>
              <form role="form" action="includes/process_login.php" method="post" name="login_form">
                <div class="form-group">
                  <input type="email" placeholder="Email" name="user_id" class="form-control">
                </div>
                <div class="form-group">
                  <input type="password" placeholder="Password" name="password" class="form-control">
                </div>
                <!-- <button type="submit" class="btn btn-success" onclick="formhash(this.form, this.form.password);">Sign in</button> -->
                <div class="btn-group">
                  <div class="btn-group">
                    <!-- <button type="button" class="btn btn-info" onclick="register.php">Register</button> -->
                    <a href="register.php" class="btn btn-info">Register</a>
                  </div>
                  <div class="btn-group">
                    <button type="submit" class="btn btn-success" onclick="formhash(this.form, this.form.password);">Sign In</button>
                  </div>
                </div>

              </form>

            </p>
            -----------------------------------------------or---------------------------------------------
          </p>
            
            <fb:login-button size='large' autologoutlink='true'  perms='email,user_birthday,status_update,publish_stream' disabled="disabled">Facebook Login</fb:login-button>
            

            </p>
          
          </div>
      
      
          <div class="mastfoot">
            <div class="inner">
              <p>Experiments at <a href="http://sourcenxt.in/" target="snxt">SourceNXT</a>, by <a href="https://www.facebook.com/kaushik1091">Kaushik</a>.</p>
            </div>
          </div>

        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/docs.js"></script>

</body>
</html>