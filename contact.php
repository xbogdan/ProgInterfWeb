<?php
  require 'config.php';
  require 'include/functions.php';
  require 'include/Auth.php';
  require 'include/App.php';
  require 'include/config.mailer.php';
  require 'include/PHPMailer/PHPMailerAutoload.php';

  $alert = null;

  if (!empty($_POST['email-name']) && !empty($_POST['email-name']) && !empty($_POST['email-name'])) {
    //Create a new PHPMailer instance
    $mail = new PHPMailer();

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages

    $mail->SMTPDebug = 0;

    //Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';

    //Set the hostname of the mail server
    $mail->Host = EMAIL_HOST;

    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = EMAIL_PORT; //995 and 465 port tried but not working

    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = EMAIL_SECURE;

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = EMAIL_ID;

    //Password to use for SMTP authentication
    $mail->Password = EMAIL_PASSWORD;

    //Set who the message is to be sent from
    $mail->setFrom($_POST['email-email'], $_POST['email-name']);


    //Set who the message is to be sent to
    $mail->addAddress('bogdan.boamfa.test@gmail.com', 'Boss de boss');

    //Set the subject line
    $mail->Subject = 'Webise message from '.$_POST['email-name'];

    $mail->Body = $_POST['email-email']." \n\n ".$_POST['email-message'];

    // $mail->msgHTML(file_get_contents('phpmailer/examples/contents.html'), dirname(__FILE__));

    $mail->AltBody = 'This is a plain-text message body';

    // $mail->addAttachment('phpmailer/examples/images/phpmailer_mini.png');

    //send the message, check for errors
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        $alert['type'] = 'error';
        $alert['message'] = 'Error sending email. Try again later.';
    } else {
        $alert['type'] = 'success';
        $alert['message'] = 'Your message has been sent.';
    }
  }
?>

<html>
  <head>
    <title>Contact</title>
    <script charset="utf-8" src="js/jquery-2.1.3.min.js"></script>
    <script charset="utf-8" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>

    <?php require 'templates/navbar.php'; ?>

    <div class="container">
      <?php showAlert($alert); ?>
    	<div class="row">
          <div class="col-md-6 col-md-offset-3">
            <div class="well well-sm">
              <form class="form-horizontal" action="" method="post">
              <fieldset>
                <legend class="text-center">Contact us</legend>

                <!-- Name input-->
                <div class="form-group">
                  <label class="col-md-3 control-label" for="name">Name</label>
                  <div class="col-md-9">
                    <input id="name" name="email-name" type="text" placeholder="Your name" class="form-control">
                  </div>
                </div>

                <!-- Email input-->
                <div class="form-group">
                  <label class="col-md-3 control-label" for="email">Your E-mail</label>
                  <div class="col-md-9">
                    <input id="email" name="email-email" type="text" placeholder="Your email" class="form-control">
                  </div>
                </div>

                <!-- Message body -->
                <div class="form-group">
                  <label class="col-md-3 control-label" for="message">Your message</label>
                  <div class="col-md-9">
                    <textarea class="form-control" id="message" name="email-message" placeholder="Please enter your message here..." rows="5"></textarea>
                  </div>
                </div>

                <!-- Form actions -->
                <div class="form-group">
                  <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary btn-lg">Send</button>
                  </div>
                </div>
              </fieldset>
              </form>
            </div>
          </div>
    	</div>
    </div>
  </body>
</html>
