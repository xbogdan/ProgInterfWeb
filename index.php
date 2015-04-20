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

  if (!empty($_POST['service_id']) && !empty($_POST['quantity'])) {
    $_app = new App(db());
    if (!$_app->reserveService($_POST['service_id'], $_SESSION['user']['uid'], $_POST['quantity'])) {
      $alert['type'] = 'error';
      $alert['message'] = 'Failed to add reservation.';
    } else {
      $alert['type'] = 'success';
      $alert['message'] = 'Successfully added reservation.';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
    <script charset="utf-8" src="js/jquery-2.1.3.min.js"></script>
    <script charset="utf-8" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <?php require 'templates/navbar.php'; ?>
    <?php showAlert($alert); ?>

    <table class="table table-condensed table-striped">
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
                <form class="form-inline" action="index.php" method="POST" style="margin-bottom: 0">
                  <input type="number" name="quantity" value="1" style="width: 40px; text-align: center; font-size: 12px; line-height: 1" min="1">
                  <input type="hidden" name="service_id" value="<?= $s['service_id'] ?>">
                  <button type="submit" class="btn btn-success btn-xs">Reserve</button></td>
                </form>
            </tr>
      <?php
        endforeach;
      ?>
    </table>
  </body>
</html>
