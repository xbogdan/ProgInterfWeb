<?php
  function setRedirect() {
    $_SESSION['redirect'] = $_SERVER['REQUEST_URI'];
  }

  function showAlert($alert) {
    if ($alert == null) return 0;
    switch ($alert['type']) {
      case 'error':
        echo
          '<div class="alert alert-danger alert-dismissible" role="alert">
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

  function send_sms($phone) {
    // Authorisation details.
  	$username = "givenup2u@yahoo.com";
  	$hash = "7ce8d35285d1270261c5d9b9ff5c384868e7125b";

  	// Configuration variables. Consult http://api.txtlocal.com/docs for more info.
  	$test = "0";

  	// Data for text message. This is the text message data.
  	$sender = "API Test"; // This is who the message appears to be from.
  	$numbers = $phone; // A single number or a comma-seperated list of numbers
  	$message = "Your account info has been updated.";
  	// 612 chars or less
  	// A single number or a comma-seperated list of numbers
  	$message = urlencode($message);
  	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
  	$ch = curl_init('http://api.txtlocal.com/send/?');
  	curl_setopt($ch, CURLOPT_POST, true);
  	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  	$result = curl_exec($ch); // This is the result from the API
  	curl_close($ch);
  }
