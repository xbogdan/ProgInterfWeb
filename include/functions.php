<?php
  function setRedirect() {
    $_SESSION['redirect'] = $_SERVER['REQUEST_URI'];
  }

  function showAlert($alert) {
    if ($alert == null) return 0;
    switch ($alert['type']) {
      case 'error':
        echo
          '<div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            '.$alert['message'].'
          </div>';
        break;

      case 'success':
        echo
          '<div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            '.$alert['message'].'
          </div>';
        break;

      case 'warning':
        echo
          '<div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            '.$alert['message'].'
          </div>';
        break;

      case 'info':
        echo
          '<div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            '.$alert['message'].'
          </div>';
        break;
    }
    return 1;
  }
