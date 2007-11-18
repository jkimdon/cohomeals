<?php
# Redirect user to an encrypted login page if encryption was not
# used for this request.

if ( ! isset( $_SERVER['HTTPS'] ) || $_SERVER['HTTPS'] != 'on' )
{
  header('Location: ' . 'https://' . $_SERVER['SERVER_NAME'] .
         $_SERVER['REQUEST_URI']);
  exit;
}
?>
