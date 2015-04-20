<?php
  require 'config.php';
  require 'include/Auth.php';

  $_auth = new Auth(db());
  if ($_auth->checkSession()) {
    $_auth->logout();
  }

  header('Location: signin.php');
