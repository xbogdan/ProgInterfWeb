<?php
  require 'config.php';
  require 'include/functions.php';
  require 'include/App.php';

  $_app = new App(db());
  $visits = $_app->getVisits();
?>
<!DOCTYPE html>
<html>
  <head>
    <title></title>
  </head>
  <body>
    <?php foreach ($visits as $key => $value) {
      
    } ?>
  </body>
</html>
