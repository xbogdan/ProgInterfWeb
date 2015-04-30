<?php
require 'config.php';
require 'include/functions.php';
require 'include/App.php';
require 'include/Auth.php';

$_auth = new Auth(db());
$_app = new App(db());
$visits = $_app->getVisits();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Visits</title>
  <script charset="utf-8" src="js/jquery-2.1.3.min.js"></script>
  <script charset="utf-8" src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
  <link rel="stylesheet" href="/css/bootstrap-theme.min.css" media="screen" title="no title" charset="utf-8">
  <link rel="stylesheet" href="/css/main.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
  <?php require 'templates/navbar.php'; ?>
  <div class="container">
    <h2>Visits</h2>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <table class="table">
          <thead>
            <tr>
              <th>Day</th>
              <th>Number of visits</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($visits as $key => $value) { ?>
              <tr>
                <td>
                  <?= $value['day'] ?>
                </td>
                <td>
                  <?= $value['count'] ?>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</body>
</html>
