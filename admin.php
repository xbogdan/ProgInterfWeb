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

  $alert = null;

  if (isset($_POST['action'])) {
    if (empty($_POST['service_id'])) {
      $alert['type'] = 'error';
      $alert['message'] = 'Invalid service id.';
    } else {
      $_app = new App(db());
      switch ((int)$_POST['action']) {
        case -1:
          if ($_app->deleteService($_POST['service_id'])) {
            $alert['type'] = 'success';
            $alert['message'] = 'Success.';
          } else {
            $alert['type'] = 'error';
            $alert['message'] = 'Error ocurred.';
          }
          break;

        case 1:
          # code...
          break;
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
        <div class="col-xs-12 col-sm-12 col-md-12 col-md-12">
          <h2>Admin Panel</h2>

          <a href="addservice.php" class="btn btn-success fright">Add new service</a>

          <table class="table table-condensed table-striped clear">
            <thead>
              <tr>
                <th>Name</th>
                <th>About</th>
                <th>Company</th>
                <th>Date</th>
                <th>Description</th>
                <th>Price</th>
                <th></th>
              </tr>
            </thead>
            <?php
              $_app = new App(db());
              $services = $_app->getServices();
              foreach ($services as $key => $s):?>
                  <tr>
                    <td><?= $s['service_name'] ?></td>
                    <td><?= $s['service_type_name'] ?></td>
                    <td><?= $s['company_name'] ?></td>
                    <td><?= $s['service_date'] ?></td>
                    <td><?= $s['service_description'] ?></td>
                    <td><?= $s['unit_price'].' '.$s['currency'] ?></td>
                    <td>
                      <form class="form-inline inline-block" action="admin.php" method="POST" style="margin-bottom: 0">
                        <input type="hidden" name="action" value="1">
                        <input type="hidden" name="service_id" value="<?= $s['service_id'] ?>">
                        <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                      </form>
                      <form class="form-inline inline-block" action="admin.php" method="POST" style="margin-bottom: 0">
                        <input type="hidden" name="action" value="-1">
                        <input type="hidden" name="service_id" value="<?= $s['service_id'] ?>">
                        <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                      </form>
                    </td>
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
