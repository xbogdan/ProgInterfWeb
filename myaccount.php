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

  if (isset($_POST['user-name']) && isset($_POST['user-email']) && isset($_POST['user-phone'])) {
    if (empty($_POST['user-name']) || empty($_POST['user-email']) || empty($_POST['user-phone'])) {
      $alert['type'] = 'error';
      $alert['message'] = 'Please complete all fields below.';
    } else {
      $user = array();
      $user['name'] = $_POST['user-name'];
      $user['email'] = $_POST['user-email'];
      $user['phone'] = $_POST['user-phone'];
      if ($_auth->updateUser($user)) {
        $alert['type'] = 'success';
        $alert['message'] = 'Successfully updated your account informations.';
      } else {
        $alert['type'] = 'error';
        $alert['message'] = 'Error ocurred while updating your account informations.';
      }
    }
  }
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

    <div class="container">
      <h2>My account</h2>

      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
          <form class="" action="myaccount.php" method="POST">
            <div class="form-group">
              <label for="">Name</label>
              <input type="text" name="user-name" class="form-control" value="<?= $_auth->getSignedInUser()['name'] ?>" placeholder="Full name">
            </div>
            <div class="form-group">
              <label for="">Phone</label>
              <input type="text" name="user-phone" class="form-control" value="<?= $_auth->getSignedInUser()['phone'] ?>" placeholder="Phone number">
            </div>
            <div class="form-group">
              <label for="">Email</label>
              <input type="text" name="user-email" class="form-control" value="<?= $_auth->getSignedInUser()['email'] ?>" placeholder="Email address">
            </div>
            <button type="submit" class="btn btn-default">Update</button>
          </form>
        </div>
      </div>
    </div>

  </body>
</html>
