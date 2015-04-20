<?php
  require 'config.php';
  require 'include/functions.php';
  require 'include/Auth.php';
  require 'include/App.php';


  $_auth = new Auth(db());
  if (!$_auth->checkSession()) {
    setRedirect();
    header('Location: signin.php');
  }

  $alert = null;
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Admin</title>
    <script charset="utf-8" src="js/jquery-2.1.3.min.js"></script>
    <script charset="utf-8" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/css/main.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <?php require 'templates/navbar.php'; ?>
    <?php showAlert($alert); ?>

    <h2>My account</h2>

    <div class="col-xs-12 col-md-4 col-lg-4">
      <form class="" action="index.html" method="post">
        <div class="form-group">
          <label for="">Name</label>
          <input type="text" name="user-name" class="form-control" value="" placeholder="Full name">
        </div>
        <div class="form-group">
          <label for="">Phone</label>
          <input type="text" name="user-phone" class="form-control" value="" placeholder="Phone number">
        </div>
        <div class="form-group">
          <label for="">Email</label>
          <input type="text" name="user-email" class="form-control" value="" placeholder="Email address">
        </div>
        <button type="submit" class="btn btn-default">Update</button>
      </form>
    </div>

  </body>
</html>
