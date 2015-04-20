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
  if (!$_auth->isAdmin()) header('Location: index.php');

  $_app = new App(db());

  $alert = null;

  if (
    isset($_POST['service-name']) &&
    isset($_POST['service-from']) &&
    isset($_POST['service-to']) &&
    isset($_POST['service-date']) &&
    isset($_POST['service-hour']) &&
    isset($_POST['service-minute']) &&
    isset($_POST['service-company']) &&
    isset($_POST['service-type']) &&
    isset($_POST['service-price']) &&
    isset($_POST['service-description'])
  ) {
    if (
      empty($_POST['service-name']) &&
      empty($_POST['service-date']) &&
      empty($_POST['service-hour']) &&
      empty($_POST['service-minute']) &&
      empty($_POST['service-company']) &&
      empty($_POST['service-type']) &&
      empty($_POST['service-price']) &&
      empty($_POST['service-description'])
    ) {
      $alert['type'] = 'error';
      $alert['message'] = 'Please complete all the fileds below.';
    } else {
      $date = new DateTime($_POST['service-date']." {$_POST['service-hour']}:{$_POST['service-minute']}:00");
      $service['name'] = $_POST['service-name'];
      $service['from'] = $_POST['service-from'];
      $service['to'] = $_POST['service-to'];
      $service['date'] = $date->format('Y-m-d h:m:s');
      $service['company_id'] = $_POST['service-company'];
      $service['type'] = $_POST['service-type'];
      $service['description'] = $_POST['service-description'];
      $service['price'] = $_POST['service-price'];

      if ($_app->addService($service)) {
        $alert['type'] = 'success';
        $alert['message'] = 'Successfully added the new service.';
      } else {
        $alert['type'] = 'error';
        $alert['message'] = 'Error ocurred.';
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
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
          <h2>Add service</h2>
          <form class="" action="addservice.php" method="post">
            <div class="form-group">
              <label for="">Name</label>
              <input type="text" name="service-name" class="form-control" value="" placeholder="Name">
            </div>

            <div class="form-group">
              <label for="">From</label>
              <input type="text" name="service-from" class="form-control" value="" placeholder="From">
            </div>

            <div class="form-group">
              <label for="">To</label>
              <input type="text" name="service-to" class="form-control" value="" placeholder="To">
            </div>

            <div class="form-group">
              <div class="form-inline">
                <div class="form-group">
                  <label for="">Date</label>
                  <input type="date" name="service-date" class="form-control" value="" placeholder="name">
                </div>

                <div class="form-group">
                  <label for="">Hour</label>
                  <input type="number" name="service-hour" class="form-control" value="0" placeholder="hour" min="0" max="23">
                </div>

                <div class="form-group">
                  <label for="">Minute</label>
                  <input type="number" name="service-minute" class="form-control" value="0" placeholder="Minute" min="0" max="59">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="">Company</label>
              <select class="" name="service-company">
                <?php $companies = $_app->getCompanies();
                  foreach ($companies as $key => $c) {
                    echo '<option value="'.$c['id'].'">'.$c['name'].'</option>';
                  }
                ?>
              </select>
            </div>

            <div class="form-group">
              <label for="">Type</label>
              <select class="" name="service-type">
                <?php $types = $_app->getServicesTypes();
                  foreach ($types as $key => $t) {
                    echo '<option value="'.$t['id'].'">'.$t['name'].'</option>';
                  }
                ?>
              </select>
            </div>

            <div class="form-group">
              <label for="">Price</label>
              <input type="text" name="service-price" class="form-control" value="0" placeholder="Price">
            </div>

            <div class="form-group">
              <label for="">Description</label>
              <textarea name="service-description" class="form-control" placeholder="Description"></textarea>
            </div>

            <button type="submit" name="add-service" class="btn btn-success btn-lg">Add service</button>
          </form>
        </div>
      </div>
    </div>

  </body>
</html>
