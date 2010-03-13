<?php
include '../../www-safe/https_redirect.php';
include "includes/config.php";
include "includes/php-dbi.php";
include "includes/functions.php";
include "includes/$user_inc";
include "includes/connect.php";

// Change this to true to show "no such user" or "invalid password" on
// login failures.
$showLoginFailureReason = true;

load_global_settings ();

if ( ! empty ( $last_login ) ) {
  $login = "";
}

if ( empty ( $webcalendar_login ) ) {
  $webcalendar_login = "";
}

if ( $remember_last_login == "Y" && empty ( $login ) ) {
  $last_login = $login = $webcalendar_login;
}


// see if a return path was set
if ( ! empty ( $return_path ) ) {
  $return_path = clean_whitespace ( $return_path );
  $url = $return_path;
} else {
  $url = "index.php";
}

$login = getPostValue ( 'login' );
$password = getPostValue ( 'password' );

if ( ! empty ( $settings['session'] ) && $settings['session'] = 'php' ) {
  session_start ();
}

// calculate path for cookie
if ( empty ( $PHP_SELF ) ) {
  $PHP_SELF = $_SERVER["PHP_SELF"];
}
$cookie_path = str_replace ( "login.php", "", $PHP_SELF );
//echo "Cookie path: $cookie_path\n$cookie_path1";

if ( $use_http_auth ) {
  // There is no login page when using HTTP authorization
  do_redirect ( "index.php" );
} else {
  if ( ! empty ( $login ) && ! empty ( $password ) ) {
    if ( get_magic_quotes_gpc() ) {
      $password = stripslashes ( $password );
      $login = stripslashes ( $login );
    }
    $login = trim ( $login );
    if ( $login != addslashes ( $login ) ) {
      die_miserable_death ( "Illegal characters in login " .
        "<tt>" . htmlentities ( $login ) . "</tt>" );
    }
    if ( user_valid_login ( $login, $password ) ) {
      user_load_variables ( $login, "" );
      // set login to expire in 365 days
      srand((double) microtime() * 1000000);
      $salt = chr( rand(ord('A'), ord('z'))) . chr( rand(ord('A'), ord('z')));
      $encoded_login = encode_string ( $login . "|" . crypt($password, $salt) );

      if ( ! empty ( $settings['session'] ) && $settings['session'] = 'php' ) {
        $_SESSION['webcalendar_session'] = $encoded_login;
      } else {
        if ( ! empty ( $remember ) && $remember == "yes" ) {
          SetCookie ( "webcalendar_session", $encoded_login,
            time() + ( 24 * 3600 * 365 ), $cookie_path );
        } else {
          SetCookie ( "webcalendar_session", $encoded_login, 0, $cookie_path );
        }
      }
load_user_preferences ();
      // The cookie "webcalendar_login" is provided as a convenience to
      // other apps that may wish to find out what the last calendar
      // login was, so they can use week_ssi.php as a server-side include.
      // As such, it's not a security risk to have it un-encoded since it
      // is not used to allow logins within this app.  It is used to
      // load user preferences on the login page (before anyone has
      // logged in) if $remember_last_login is set to "Y" (in admin.php).
      if ( ! empty ( $remember ) && $remember == "yes" ) {
        SetCookie ( "webcalendar_login", $login,
          time() + ( 24 * 3600 * 365 ), $cookie_path );
      } else {
        SetCookie ( "webcalendar_login", $login, 0, $cookie_path );
      }
      do_redirect ( $url );
    } else {
      // Invalid login
      if ( empty ( $error ) || ! $showLoginFailureReason ) {
        $error = "Invalid login";
      }
    }
  } else {
    // No login info... just present empty login page
    //$error = "Start";
  }
  // delete current user
  SetCookie ( "webcalendar_session", "", 0, $cookie_path );
  // In older versions the cookie path had no trailing slash and NS 4.78
  // thinks "path/" and "path" are different, so the line above does not
  // delete the "old" cookie. This prohibits the login. So we delete the
  // cookie with the trailing slash removed
  if (substr($cookie_path, -1) == '/') {
    SetCookie ( "webcalendar_session", "", 0, substr($cookie_path, 0, -1)  );
  }
}
$charset = "iso-8859-1";
echo "<?xml version=\"1.0\" encoding=\"$charset\"?>" . "\n";
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />
<title><?php echo $application_name;?></title>
<script type="text/javascript">
// error check login/password
function valid_form ( form ) {
  if ( form.login.value.length == 0 || form.password.value.length == 0 ) {
    alert ( "You must enter a login and password." );
    return false;
  }
  return true;
}
function myOnLoad() {
  <?php if ( ! empty ( $plugins_enabled ) && ( $plugins_enabled ) ){ ?>
   if (self != top)  {
     window.open("login.php","_top","");
     return;
   }
  <?php } ?>
  document.login_form.login.focus();
  <?php
    if ( ! empty ( $login ) ) echo "document.login_form.login.select();";
    if ( ! empty ( $error ) ) {
      echo "  alert ( \"$error\" );\n";
    }
  ?>
}
</script>
<?php 
 include "includes/styles.php";

?>
</head>
<body onload="myOnLoad();">

<h2><?php 
// If Application Name is not set to Title then use the Admin defined Application Name
if ( ! empty ( $application_name ) &&  $application_name =="Title") {
  echo $application_name;
} else {
  echo htmlspecialchars ( $application_name );
}  
?></h2>

<?php
if ( ! empty ( $error ) ) {
  print "<span style=\"color:#FF0000; font-weight:bold;\">" . 
    "Error" . ": $error</span><br />\n";
} else {
  print "<br />\n";
}
?>
<form name="login_form" id="login" action="login.php" method="post" 
  onsubmit="return valid_form(this)">
<?php
if ( ! empty ( $return_path ) ) {
  echo "<input type=\"hidden\" name=\"return_path\" value=\"" .
    htmlentities ( $return_path ) . "\" />\n";
}
?>

<table cellpadding="10" align="center">
<tr><td rowspan="2">
 <img src="login.gif" alt="Login" /></td><td align="right">
 <label for="user">Username:</label></td><td>
 <input name="login" id="user" size="15" maxlength="25" 
   value="<?php if ( ! empty ( $last_login ) ) echo $last_login;?>" 
   tabindex="1" />
</td></tr>
<tr><td style="text-align:right;">
 <label for="password">Password:</label></td><td>
 <input name="password" id="password" type="password" size="15" 
   maxlength="30" tabindex="2" />
</td></tr>
<tr><td colspan="3" style="font-size: 10px;">
 <input type="checkbox" name="remember" id="remember" tabindex="3" 
   value="yes" <?php if ( ! empty ( $remember ) && $remember == "yes" ) {
     echo "checked=\"checked\""; }?> /><label for="remember">&nbsp;
   Save login via cookies so I don't have to login next time</label>
</td></tr>
<tr><td colspan="4" style="text-align:center;">
 <input type="submit" value="Login" tabindex="4" />
</td></tr>
</table>
</form>

<?php if ( ! empty ( $public_access ) && $public_access == "Y" ) { ?>
 <br /><br />
 <a class="nav" href="index.php">
   Access public calendar</a><br />
<?php } ?>

<br /><br /><br />
<span class="cookies">cookies-note</span><br />
<hr />
<br /><br />
<a href="<?php echo $PROGRAM_URL ?>" id="programname"><?php echo $PROGRAM_NAME?></a>

</body>
</html>
