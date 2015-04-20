<?php
  require 'config.php';
  require 'include/Auth.php';

  $_auth = new Auth(db());

  if ($_auth->checkSession()) header('Location: index.php');

  if (!empty($_POST['email']) && !empty($_POST['passwd'])) {
    $remember = 0;
    if (!empty($_POST['remember'])) $remember = $_POST['remember'];
    $response = $_auth->login($_POST['email'], $_POST['passwd'], $remember);
    if ($response['error'] == 1) {
      echo 'Error login new user';
    } else {
      if (!empty($_SESSION['redirect'])) {
        header('Location: '.$_SESSION['redirect']);
      } else {
        header('Location: index.php');
      }
      echo 'Successfully login';
    }
  }
?>


<html>
  <head>
    <title>Sign in</title>
    <script charset="utf-8" src="js/jquery-2.1.3.min.js"></script>
    <script charset="utf-8" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>

    <div class="container">
      <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info" >
          <div class="panel-heading">
            <div class="panel-title">Sign In</div>
            <!-- <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div> -->
          </div>

          <div style="padding-top:30px" class="panel-body" >

            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

            <form id="loginform" class="form-horizontal" role="form" method="POST" action="signin.php">

              <div style="margin-bottom: 25px" class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="login-username" type="text" class="form-control" name="email" value="" placeholder="username or email">
              </div>

              <div style="margin-bottom: 25px" class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input id="login-password" type="password" class="form-control" name="passwd" placeholder="password">
              </div>



              <div class="input-group">
                <div class="checkbox">
                  <label>
                    <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                  </label>
                </div>
              </div>


              <div style="margin-top:10px" class="form-group">
                <!-- Button -->

                <div class="col-sm-12 controls">
                  <button id="btn-signup" type="submit" class="btn btn-success"><i class="glyphicon glyphicon-hand-right"></i> &nbsp Sign In</button>
                </div>
              </div>


              <div class="form-group">
                <div class="col-md-12 control">
                  <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                    Don't have an account!
                    <a href="signup.php">
                      Sign Up Here
                    </a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>
