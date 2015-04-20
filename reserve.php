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
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Reserve</title>
    <script charset="utf-8" src="js/jquery-2.1.3.min.js"></script>
    <script charset="utf-8" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <?php require 'templates/navbar.php'; ?>
    <?php
      $_app = new App(db());
      $service = $_app->getService($_GET['service']);
    ?>

<!--    <div class="jumbotron">
      <h2><?= $service['service_name'] ?></h2>
      <p><?= $service['company_name'] ?></p>
      <form id="" class="form-horizontal" role="form" method="POST" action="reserve.php">

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-1 control-label">Hour</label>
          <div class="col-sm-3">
            <input type="number" class="form-control" placeholder="Username" aria-describedby="basic-addon1" min="0" max="23" value="0">
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-1 control-label">Minute</label>
          <div class="col-sm-3">
            <input type="number" class="form-control" placeholder="Username" aria-describedby="basic-addon1" min="0" max="59" value="0">
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-1 control-label">Date</label>
          <div class="col-sm-3">
            <input type="date" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-1 control-label">Email</label>
          <div class="col-sm-3">
            <input id="" type="text" class="form-control" name="email" value="" placeholder="">
          </div>
        </div>

        <div class="">
          <button type="button" name="button" class="btn btn-block btn-success btn-lg">Reserve</button>
        </div>

      </form>
    </div>-->
  </body>
</html>
