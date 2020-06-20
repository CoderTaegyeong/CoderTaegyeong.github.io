<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* New aliases. */
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

/* Composer autoload.php file includes all installed libraries. */
require 'C:\xampp\composer\vendor\autoload.php';

/* If you installed league/oauth2-google in a different directory, include its autoloader.php file as well. */
// require 'C:\xampp\league-oauth2\vendor\autoload.php';

/* Set the script time zone to UTC. */
date_default_timezone_set('Etc/UTC');

/* Information from the XOAUTH2 configuration. */
$google_email = 'example@gmail.com';
$oauth2_clientId = '';
$oauth2_clientSecret = '';
$oauth2_refreshToken = '';

$mail = new PHPMailer(TRUE);

try {

   $mail->AddReplyTo($_POST["senderaddr"], $_POST["sendername"]); // Custom sender address does not work. This is a substitute that displays sender's email address.
   $mail->setFrom($_POST["senderaddr"], $_POST["sendername"]); // This displays the same email address as my Gmail address I put in.
   $mail->addAddress($google_email, 'Admin');
   $mail->Subject = $_POST["emailtitle"];
   $mail->Body = $_POST["emailbody"];
   $mail->isSMTP();
   $mail->Port = 587;
   $mail->SMTPAuth = TRUE;
   $mail->SMTPSecure = 'tls';

   /* Google's SMTP */
   $mail->Host = 'smtp.gmail.com';

   /* Set AuthType to XOAUTH2. */
   $mail->AuthType = 'XOAUTH2';

   /* Create a new OAuth2 provider instance. */
   $provider = new Google(
      [
         'clientId' => $oauth2_clientId,
         'clientSecret' => $oauth2_clientSecret,
      ]
   );

   /* Pass the OAuth provider instance to PHPMailer. */
   $mail->setOAuth(
      new OAuth(
         [
            'provider' => $provider,
            'clientId' => $oauth2_clientId,
            'clientSecret' => $oauth2_clientSecret,
            'refreshToken' => $oauth2_refreshToken,
            'userName' => $google_email,
         ]
      )
   );

   /* Finally send the mail. */
   $mail->send();
   /* Warning: Remove or comment the line below in prod else you'll leak info */
   echo "Your message has been sent to my email. Thank you. I'll get back to you soon! :)";
}
catch (Exception $e)
{
   echo $e->errorMessage();
}
catch (\Exception $e)
{
   echo $e->getMessage();
}
