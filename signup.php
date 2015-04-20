<?php
  require 'config.php';
  require 'include/Auth.php';

  $_auth = new Auth(db());

  if ($_auth->checkSession()) header('Location: index.php');

  if (!empty($_POST['email']) && !empty($_POST['passwd']) && !empty($_POST['conf-passwd'])) {
    $response = $_auth->register($_POST['email'], $_POST['passwd'], $_POST['conf-passwd']);
    if ($response['error'] == 1) {
      echo 'Error registering new user';
    } else {
      echo 'Successfully registered';
    }
  }
?>

<html>
  <head>
    <title>Sign up</title>
    <script charset="utf-8" src="js/jquery-2.1.3.min.js"></script>
    <script charset="utf-8" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>

    <div class="container">
      <div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
          <div class="panel-heading">
            <div class="panel-title">Sign Up</div>
            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="signin.php">Sign In</a></div>
          </div>
          <div class="panel-body" >
            <form id="signupform" class="form-horizontal" role="form" method="POST" action="signup.php">

              <div id="signupalert" style="display:none" class="alert alert-danger">
                <p>Error:</p>
                <span></span>
              </div>



              <div class="form-group">
                <label for="email" class="col-md-3 control-label">Email</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="email" placeholder="Email Address">
                </div>
              </div>

              <div class="form-group">
                <label for="password" class="col-md-3 control-label">Password</label>
                <div class="col-md-9">
                  <input type="password" class="form-control" name="passwd" placeholder="Password">
                </div>
              </div>

              <div class="form-group">
                <label for="password" class="col-md-3 control-label">Confirm password</label>
                <div class="col-md-9">
                  <input type="password" class="form-control" name="conf-passwd" placeholder="Confirm password">
                </div>
              </div>

              <div class="form-group">
                <!-- Button -->
                <div class="col-md-offset-3 col-md-9">
                  <button id="btn-signup" type="submit" class="btn btn-info"><i class="glyphicon glyphicon-hand-right"></i> &nbsp Sign Up</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>
