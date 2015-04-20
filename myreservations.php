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
    <title>My reservatiosn</title>
    <script charset="utf-8" src="js/jquery-2.1.3.min.js"></script>
    <script charset="utf-8" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <?php require 'templates/navbar.php'; ?>

    <div class="container">
      <h2>My reservations</h2>
      <br>
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <table class="table table-condensed table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>About</th>
                <th>Company</th>
                <th>Description</th>
                <th>Price</th>
                <th></th>
              </tr>
            </thead>
            <?php
              $_app = new App(db());
              $services = $_app->getReservations($_SESSION['user']['uid']);
              foreach ($services as $key => $s):?>
                  <tr>
                    <td><?= $s['service_name'] ?></td>
                    <td><?= $s['service_type_name'] ?></td>
                    <td><?= $s['company_name'] ?></td>
                    <td><?= $s['service_description'] ?></td>
                    <td><?= $s['unit_price'].' '.$s['currency'] ?></td>
                    <td>

                  </tr>
            <?php
              endforeach;
            ?>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
