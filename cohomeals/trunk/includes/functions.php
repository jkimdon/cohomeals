<?php
/**
 * All of WebCalendar's functions
 *
 * @author Craig Knudsen <cknudsen@cknudsen.com>
 * @copyright Craig Knudsen, <cknudsen@cknudsen.com>, http://www.k5n.us/cknudsen
 * @license http://www.gnu.org/licenses/gpl.html GNU GPL
 * @package WebCalendar
 */

if ( empty ( $PHP_SELF ) && ! empty ( $_SERVER ) &&
  ! empty ( $_SERVER['PHP_SELF'] ) ) {
  $PHP_SELF = $_SERVER['PHP_SELF'];
}
if ( ! empty ( $PHP_SELF ) && preg_match ( "/\/includes\//", $PHP_SELF ) ) {
    die ( "You can't access this file directly!" );
}

/**#@+
 * Used for activity log
 * @global string
 */
$LOG_CREATE = "C";
$LOG_UPDATE = "U";
$LOG_DELETE = "D";
/**#@-*/

/**
 * Number of seconds in a day
 *
 * @global int $ONE_DAY
 */
$ONE_DAY = 86400;

/**
 * Array containing the number of days in each month in a non-leap year
 *
 * @global array $days_per_month
 */
$days_per_month = array ( 0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );

/**
 * Array containing the number of days in each month in a leap year
 *
 * @global array $ldays_per_month
 */
$ldays_per_month = array ( 0, 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );

/**
 * Array of global variables which are not allowed to by set via HTTP GET/POST
 *
 * This is a security precaution to prevent users from overriding any global
 * variables
 *
 * @global array $noSet
 */
$noSet = array (
  "is_meal_coordinator" => 1,
  "db_type" => 1,
  "db_host" => 1,
  "db_login" => 1,
  "db_password" => 1,
  "db_persistent" => 1,
  "PROGRAM_NAME" => 1,
  "PROGRAM_URL" => 1,
  "readonly" => 1,
  "use_http_auth" => 1,
  "user_inc" => 1,
  "includedir" => 1,
  "pub_acc_enabled" => 1,
  "user_can_update_password" => 1,
  "admin_can_add_user" => 1,
  "admin_can_delete_user" => 1,
  "noSet" => 1,
);


// This code is a temporary hack to make the application work when
// register_globals is set to Off in php.ini (the default setting in
// PHP 4.2.0 and after).
if ( empty ( $HTTP_COOKIE_VARS ) ) $HTTP_COOKIE_VARS = $_COOKIE;
if ( ! empty ( $HTTP_COOKIE_VARS ) ) {
  while (list($key, $val) = @each($HTTP_COOKIE_VARS)) {
    if ( empty ( $noSet[$key] ) && substr($key,0,12) == "webcalendar_" ) {
      $GLOBALS[$key] = $val;
    }
    //echo "COOKIE var '$key' = '$val' <br />\n";
  }
  reset ( $HTTP_COOKIE_VARS );
}

// Don't allow a user to put "login=XXX" in the URL if they are not
// coming from the login.php page.
if ( empty ( $PHP_SELF ) && ! empty ( $_SERVER['PHP_SELF'] ) )
  $PHP_SELF = $_SERVER['PHP_SELF']; // backward compatibility
if ( empty ( $PHP_SELF ) )
  $PHP_SELF = ''; // this happens when running send_reminders.php from CL
if ( ! strstr ( $PHP_SELF, "login.php" ) && ! empty ( $GLOBALS["login"] ) ) {
  $GLOBALS["login"] = "";
}

if ( empty ( $c ) ) {
  $c = dbi_connect ( $db_host, $db_login, $db_password, $db_database );
}

$GLOBALS['login'] = mysql_safe( $GLOBALS['login'], true );

// Define an array to use to jumble up the key: $offsets
// We define a unique key to scramble the cookie we generate.
// We use the admin install password that the user set to make
// the salt unique for each WebCalendar install.
if ( ! empty ( $settings ) && ! empty ( $settings['install_password'] ) ) {
  $salt = $settings['install_password'];
} else {
  $salt = md5 ( $db_login );
}
$salt_len = strlen ( $salt );

if ( ! empty ( $db_password ) ) {
  $salt2 = md5 ( $db_password );
} else {
  $salt2 = md5 ( "oogabooga" );
}
$salt2_len = strlen ( $salt2 );

$offsets = array ();
for ( $i = 0; $i < $salt_len || $i < $salt2_len; $i++ ) {
  $offsets[$i] = 0;
  if ( $i < $salt_len )
    $offsets[$i] += ord ( substr ( $salt, $i, 1 ) );
  if ( $i < $salt2_len )
    $offsets[$i] += ord ( substr ( $salt2, $i, 1 ) );
  $offsets[$i] %= 128;
}
/* debugging code...
for ( $i = 0; $i < count ( $offsets ); $i++ ) {
  echo "offset $i: $offsets[$i] <br />\n";
}
*/

/*
 * Functions start here.  All non-function code should be above this
 *
 * Note to developers:
 *  Documentation is generated from the function comments below.
 *  When adding/updating functions, please follow the following conventions
 *  seen below.  Your cooperation in this matter is appreciated :-)
 *
 *  If you want your documentation to link to the db documentation,
 *  just make sure you mention the db table name followed by "table"
 *  on the same line.  Here's an example:
 *    Retrieve preferences from the webcal_user_pref table.
 *
 */

/**
 * Gets the value resulting from an HTTP POST method.
 * 
 * <b>Note:</b> The return value will be affected by the value of
 * <var>magic_quotes_gpc</var> in the php.ini file.
 * 
 * @param string $name Name used in the HTML form
 *
 * @return string The value used in the HTML form
 *
 * @see getGetValue
 */
function getPostValue ( $name ) {
  global $HTTP_POST_VARS;

  if ( isset ( $_POST ) && is_array ( $_POST ) && ! empty ( $_POST[$name] ) ) {
	  $HTTP_POST_VARS[$name] = $_POST[$name];
    return $_POST[$name];
   } else if ( ! isset ( $HTTP_POST_VARS ) ) {
    return null;
  } else if ( ! isset ( $HTTP_POST_VARS[$name] ) ) {
    return null;
	}
  return ( $HTTP_POST_VARS[$name] );
}

/**
 * Gets the value resulting from an HTTP GET method.
 *
 * <b>Note:</b> The return value will be affected by the value of
 * <var>magic_quotes_gpc</var> in the php.ini file.
 *
 * If you need to enforce a specific input format (such as numeric input), then
 * use the {@link getValue()} function.
 *
 * @param string $name Name used in the HTML form or found in the URL
 *
 * @return string The value used in the HTML form (or URL)
 *
 * @see getPostValue
 */
function getGetValue ( $name ) {
  global $HTTP_GET_VARS;

  if ( isset ( $_GET ) && is_array ( $_GET ) && ! empty ( $_GET[$name] ) ) {
	  $HTTP_GET_VARS[$name] = $_GET[$name];
    return $_GET[$name];
  } else if ( ! isset ( $HTTP_GET_VARS ) )  {
    return null;
   } else if ( ! isset ( $HTTP_GET_VARS[$name] ) ) {
    return null;
	}
  return ( $HTTP_GET_VARS[$name] );
}

/**
 * Gets the value resulting from either HTTP GET method or HTTP POST method.
 *
 * <b>Note:</b> The return value will be affected by the value of
 * <var>magic_quotes_gpc</var> in the php.ini file.
 *
 * <b>Note:</b> If you need to get an integer value, yuou can use the
 * getIntValue function.
 *
 * @param string $name   Name used in the HTML form or found in the URL
 * @param string $format A regular expression format that the input must match.
 *                       If the input does not match, an empty string is
 *                       returned and a warning is sent to the browser.  If The
 *                       <var>$fatal</var> parameter is true, then execution
 *                       will also stop when the input does not match the
 *                       format.
 * @param bool   $fatal  Is it considered a fatal error requiring execution to
 *                       stop if the value retrieved does not match the format
 *                       regular expression?
 *
 * @return string The value used in the HTML form (or URL)
 *
 * @uses getGetValue
 * @uses getPostValue
 */
function getValue ( $name, $format="", $fatal=false ) {
  $val = getPostValue ( $name );
  if ( ! isset ( $val ) )
    $val = getGetValue ( $name );
  // for older PHP versions...
  if ( ! isset ( $val  ) && get_magic_quotes_gpc () == 1 &&
    ! empty ( $GLOBALS[$name] ) )
    $val = $GLOBALS[$name];
  if ( ! isset ( $val  ) )
    return "";
  if ( ! empty ( $format ) && ! preg_match ( "/^" . $format . "$/", $val ) ) {
    // does not match
    if ( $fatal ) {
      die_miserable_death ( "Fatal Error: Invalid data format for $name" );
    }
    // ignore value
    return "";
  }
  return $val;
}

/**
 * Gets an integer value resulting from an HTTP GET or HTTP POST method.
 *
 * <b>Note:</b> The return value will be affected by the value of
 * <var>magic_quotes_gpc</var> in the php.ini file.
 *
 * @param string $name  Name used in the HTML form or found in the URL
 * @param bool   $fatal Is it considered a fatal error requiring execution to
 *                      stop if the value retrieved does not match the format
 *                      regular expression?
 *
 * @return string The value used in the HTML form (or URL)
 *
 * @uses getValue
 */
function getIntValue ( $name, $fatal=false ) {
  $val = getValue ( $name, "-?[0-9]+", $fatal );
  return $val;
}


/** 
 * protect from mysql injection attacks
 **/
function mysql_safe( $data, $string=true ) {
  if ( get_magic_quotes_gpc() )
    $data = stripslashes($data);
  if ( $string == true ) {
    //   $data = htmlentities($data,ENT_QUOTES);
    $data = mysql_real_escape_string($data);
  } else {
    $data = intval( $data );
  }
  return $data; 
}

/**
 * Loads default system settings (which can be updated via admin.php).
 *
 * System settings are stored in the webcal_config table.
 *
 * <b>Note:</b> If the setting for <var>server_url</var> is not set, the value
 * will be calculated and stored in the database.
 *
 * @global string User's login name
 * @global bool   Readonly
 * @global string HTTP hostname
 * @global int    Server's port number
 * @global string Request string
 * @global array  Server variables
 */
function load_global_settings () {
  global $login, $readonly, $HTTP_HOST, $SERVER_PORT, $REQUEST_URI, $_SERVER;

  // Note: when running from the command line (send_reminders.php),
  // these variables are (obviously) not set.
  // TODO: This type of checking should be moved to a central locationm
  // like init.php.
  if ( isset ( $_SERVER ) && is_array ( $_SERVER ) ) {
    if ( empty ( $HTTP_HOST ) && isset ( $_SERVER["HTTP_POST"] ) )
      $HTTP_HOST = $_SERVER["HTTP_HOST"];
    if ( empty ( $SERVER_PORT ) && isset ( $_SERVER["SERVER_PORT"] ) )
      $SERVER_PORT = $_SERVER["SERVER_PORT"];
    if ( empty ( $REQUEST_URI ) && isset ( $_SERVER["REQUEST_URI"] ) )
      $REQUEST_URI = $_SERVER["REQUEST_URI"];
  }

  $res = dbi_query ( "SELECT cal_setting, cal_value FROM webcal_config" );
  if ( $res ) {
    while ( $row = dbi_fetch_row ( $res ) ) {
      $setting = $row[0];
      $value = $row[1];
      //echo "Setting '$setting' to '$value' <br />\n";
      $GLOBALS[$setting] = $value;
    }
    dbi_free_result ( $res );
  }

  // If app name not set.... default to "Title".  
  // Note: We usually use $application_name instead of "Title"
  if ( empty ( $GLOBALS["application_name"] ) )
    $GLOBALS["application_name"] = "Title";

  // If $server_url not set, then calculate one for them, then store it
  // in the database.
  if ( empty ( $GLOBALS["server_url"] ) ) {
    if ( ! empty ( $HTTP_HOST ) && ! empty ( $REQUEST_URI ) ) {
      $ptr = strrpos ( $REQUEST_URI, "/" );
      if ( $ptr > 0 ) {
        $uri = substr ( $REQUEST_URI, 0, $ptr + 1 );
        $server_url = "http://" . $HTTP_HOST;
        if ( ! empty ( $SERVER_PORT ) && $SERVER_PORT != 80 )
          $server_url .= ":" . $SERVER_PORT;
        $server_url .= $uri;

        dbi_query ( "INSERT INTO webcal_config ( cal_setting, cal_value ) ".
          "VALUES ( 'server_url', '$server_url' )" );
        $GLOBALS["server_url"] = $server_url;
      }
    }
  }

  // If no font settings, then set some
  if ( empty ( $GLOBALS["FONTS"] ) ) {
    $GLOBALS["FONTS"] = "Arial, Helvetica, sans-serif";
  }
}

/**
 * Gets the list of active plugins.
 *
 * Should be called after {@link load_global_settings()} and {@link load_user_preferences()}.
 *
 * @internal cek: ignored since I am not sure this will ever be used...
 *
 * @return array Active plugins
 *
 * @ignore
 */
function get_plugin_list ( $include_disabled=false ) {
  // first get list of available plugins
  $sql = "SELECT cal_setting FROM webcal_config " .
    "WHERE cal_setting LIKE '%.plugin_status'";
  if ( ! $include_disabled )
    $sql .= " AND cal_value = 'Y'";
  $sql .= " ORDER BY cal_setting";
  $res = dbi_query ( $sql );
  $plugins = array ();
  if ( $res ) {
    while ( $row = dbi_fetch_row ( $res ) ) {
      $e = explode ( ".", $row[0] );
      if ( $e[0] != "" ) {
        $plugins[] = $e[0];
      }
    }
    dbi_free_result ( $res );
  } else {
    echo "Database error: " . dbi_error (); exit;
  }
  if ( count ( $plugins ) == 0 ) {
    $plugins[] = "webcalendar";
  }
  return $plugins;
}

/**
 * Get plugins available to the current user.
 *
 * Do this by getting a list of all plugins that are not disabled by the
 * administrator and make sure this user has not disabled any of them.
 * 
 * It's done this was so that when an admin adds a new plugin, it shows up on
 * each users system automatically (until they disable it).
 *
 * @return array Plugins available to current user
 *
 * @ignore
 */
function get_user_plugin_list () {
  $ret = array ();
  $all_plugins = get_plugin_list ();
  for ( $i = 0; $i < count ( $all_plugins ); $i++ ) {
    if ( $GLOBALS[$all_plugins[$i] . ".disabled"] != "N" )
      $ret[] = $all_plugins[$i];
  }
  return $ret;
}

/**
 * Identify user's browser.
 *
 * Returned value will be one of:
 * - "Mozilla/5" = Mozilla (open source Mozilla 5.0)
 * - "Mozilla/[3,4]" = Netscape (3.X, 4.X)
 * - "MSIE 4" = MSIE (4.X)
 *
 * @return string String identifying browser
 *
 * @ignore
 */
function get_web_browser () {
  if ( ereg ( "MSIE [0-9]", getenv ( "HTTP_USER_AGENT" ) ) )
    return "MSIE";
  if ( ereg ( "Mozilla/[234]", getenv ( "HTTP_USER_AGENT" ) ) )
    return "Netscape";
  if ( ereg ( "Mozilla/[5678]", getenv ( "HTTP_USER_AGENT" ) ) )
    return "Mozilla";
  return "Unknown";
}


/**
 * Logs a debug message.
 *
 * Generally, we do not leave calls to this function in the code.  It is used
 * for debugging only.
 *
 * @param string $msg Text to be logged
 */
function do_debug ( $msg ) {
  // log to /tmp/webcal-debug.log
  //error_log ( date ( "Y-m-d H:i:s" ) .  "> $msg\n",
  //  3, "/tmp/webcal-debug.log" );
  //error_log ( date ( "Y-m-d H:i:s" ) .  "> $msg\n",
  //  2, "sockieman:2000" );
}



/** Sends a redirect to the specified page.
 *
 * The database connection is closed and execution terminates in this function.
 *
 * <b>Note:</b> MS IIS/PWS has a bug in which it does not allow us to send a
 * cookie and a redirect in the same HTTP header.  When we detect that the web
 * server is IIS, we accomplish the redirect using meta-refresh.  See the
 * following for more info on the IIS bug:
 *
 * {@link http://www.faqts.com/knowledge_base/view.phtml/aid/9316/fid/4}
 *
 * @param string $url The page to redirect to.  In theory, this should be an
 *                    absolute URL, but all browsers accept relative URLs (like
 *                    "month.php").
 *
 * @global string   Type of webserver
 * @global array    Server variables
 * @global resource Database connection
 */
function do_redirect ( $url ) {
  global $SERVER_SOFTWARE, $_SERVER, $c;

  // Replace any '&amp;' with '&' since we don't want that in the HTTP
  // header.
  $url = str_replace ( '&amp;', '&', $url );

  if ( empty ( $SERVER_SOFTWARE ) )
    $SERVER_SOFTWARE = $_SERVER["SERVER_SOFTWARE"];
  //echo "SERVER_SOFTWARE = $SERVER_SOFTWARE <br />\n"; exit;
  if ( ( substr ( $SERVER_SOFTWARE, 0, 5 ) == "Micro" ) ||
    ( substr ( $SERVER_SOFTWARE, 0, 3 ) == "WN/" ) ) {
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n<!DOCTYPE html
    PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
    \"DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">
<head>\n<title>Redirect</title>\n" .
      "<meta http-equiv=\"refresh\" content=\"0; url=$url\" />\n</head>\n<body>\n" .
      "Redirecting to.. <a href=\"" . $url . "\">here</a>.</body>\n</html>";
  } else {
    Header ( "Location: $url" );
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n<!DOCTYPE html
    PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
    \"DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">
<head>\n<title>Redirect</title>\n</head>\n<body>\n" .
      "Redirecting to ... <a href=\"" . $url . "\">here</a>.</body>\n</html>";
  }
  dbi_close ( $c );
  exit;
}

/**
 * Sends an HTTP login request to the browser and stops execution.
 */
function send_http_login () {
  global $application_name;

  Header ( "WWW-Authenticate: Basic realm=\"Title\"");
  Header ( "HTTP/1.0 401 Unauthorized" );
  echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n<!DOCTYPE html
    PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
    \"DTD/xhtml1-transitional.dtd\">
    <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">
    <head>\n<title>Unauthorized</title>\n</head>\n<body>\n" .
    "<h2>Title</h2>\n" .
    "You are not authorized" .
    "\n</body>\n</html>";
  exit;
}

/**
 * Generates a cookie that saves the last calendar view.
 *
 * Cookie is based on the current <var>$REQUEST_URI</var>.
 *
 * We save this cookie so we can return to this same page after a user
 * edits/deletes/etc an event.
 *
 * @global string Request string
 */
function remember_this_view () {
  global $REQUEST_URI;
  if ( empty ( $REQUEST_URI ) )
    $REQUEST_URI = $_SERVER["REQUEST_URI"];

  // do not use anything with friendly in the URI
  if ( strstr ( $REQUEST_URI, "friendly=" ) )
    return;

  SetCookie ( "webcalendar_last_view", $REQUEST_URI );
}

/**
 * Gets the last page stored using {@link remember_this_view()}.
 *
 * @return string The URL of the last view or an empty string if it cannot be
 *                determined.
 *
 * @global array Cookies
 */
function get_last_view () {
  global $HTTP_COOKIE_VARS;
  $val = '';

  if ( isset ( $_COOKIE["webcalendar_last_view"] ) ) {
	  $HTTP_COOKIE_VARS["webcalendar_last_view"] = $_COOKIE["webcalendar_last_view"];
    $val = $_COOKIE["webcalendar_last_view"];
  } else if ( isset ( $HTTP_COOKIE_VARS["webcalendar_last_view"] ) ) {
    $val = $HTTP_COOKIE_VARS["webcalendar_last_view"];
	}
  $val =   str_replace ( "&", "&amp;", $val );
  return $val;
}

/**
 * Sends HTTP headers that tell the browser not to cache this page.
 *
 * Different browser use different mechanisms for this, so a series of HTTP
 * header directives are sent.
 *
 * <b>Note:</b> This function needs to be called before any HTML output is sent
 * to the browser.
 */
function send_no_cache_header () {
  header ( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
  header ( "Last-Modified: " . gmdate ( "D, d M Y H:i:s" ) . " GMT" );
  header ( "Cache-Control: no-store, no-cache, must-revalidate" );
  header ( "Cache-Control: post-check=0, pre-check=0", false );
  header ( "Pragma: no-cache" );
}

/**
 * Loads the current user's preferences as global variables from the webcal_user_pref table.
 *
 * <b>Notes:</b>
 * - If <var>$allow_color_customization</var> is set to 'N', then we ignore any
 *   color preferences.
 * - Other default values will also be set if the user has not saved a
 *   preference and no global value has been set by the administrator in the
 *   system settings.
 */
function load_user_preferences () {
  global $login, $prefarray,
    $allow_color_customization;
  $colors = array (
    "BGCOLOR" => 1,
    "H2COLOR" => 1,
    "THBG" => 1,
    "THFG" => 1,
    "CELLBG" => 1,
    "TODAYCELLBG" => 1,
    "WEEKENDBG" => 1,
    "POPUP_BG" => 1,
    "POPUP_FG" => 1,
  );

  $prefarray = array ();

  // Note: default values are set in config.php
  $res = dbi_query (
    "SELECT cal_setting, cal_value FROM webcal_user_pref " .
    "WHERE cal_login = '$login'" );
  if ( $res ) {
    while ( $row = dbi_fetch_row ( $res ) ) {
      $setting = $row[0];
      $value = $row[1];
      if ( $allow_color_customization == 'N' ) {
        if ( isset ( $colors[$setting] ) )
          continue;
      }
      $sys_setting = "sys_" . $setting;
      // save system defaults
      if ( ! empty ( $GLOBALS[$setting] ) )
        $GLOBALS["sys_" . $setting] = $GLOBALS[$setting];
      $GLOBALS[$setting] = $value;
      $prefarray[$setting] = $value;
    }
    dbi_free_result ( $res );
  }

  if ( empty ( $GLOBALS["DATE_FORMAT_MY"] ) )
    $GLOBALS["DATE_FORMAT_MY"] = "__month__ __yyyy__";
  if ( empty ( $GLOBALS["DATE_FORMAT_MD"] ) )
    $GLOBALS["DATE_FORMAT_MD"] = "__month__ __dd__";
}

/**
 * Gets the list of external users for an event from the webcal_entry_ext_user table in an HTML format.
 *
 * @param int $event_id   Event ID
 * @param int $use_mailto When set to 1, email address will contain an href
 *                        link with a mailto URL.
 *
 * @return string The list of external users for an event formatte in HTML.
 */
function event_get_external_users ( $event_id, $use_mailto=0 ) {
  global $error;
  $ret = "";

  $event_id = mysql_safe( $event_id, false );
  $res = dbi_query ( "SELECT cal_fullname, cal_email " .
    "FROM webcal_entry_ext_user " .
    "WHERE cal_id = $event_id " .
    "ORDER by cal_fullname" );
  if ( $res ) {
    while ( $row = dbi_fetch_row ( $res ) ) {
      if ( strlen ( $ret ) )
        $ret .= "\n";
      // Remove [\d] if duplicate name
      $trow = trim( preg_replace( '/\[[\d]]/' , "", $row[0] ) );
      $ret .= $trow;
      if ( strlen ( $row[1] ) ) {
        if ( $use_mailto ) {
          $ret .= " <a href=\"mailto:$row[1]\">&lt;" .
            htmlentities ( $row[1] ) . "&gt;</a>";
        } else {
          $ret .= " &lt;". htmlentities ( $row[1] ) . "&gt;";
        }
      }
    }
    dbi_free_result ( $res );
  } else {
    echo "Database error: " . dbi_error ();
    echo "<br />\nSQL:<br />\n$sql";
    exit;
  }
  return $ret;
}

/**
 * Adds something to the activity log for an event.
 *
 * The information will be saved to the webcal_entry_log table.
 *
 * @param int    $event_id Event ID
 * @param string $user     Username of user doing this
 * @param string $type     Type of activity we are logging:
 *   - $LOG_CREATE
 *   - $LOG_UPDATE
 *   - $LOG_DELETE
 * @param string $text     Text comment to add with activity log entry
 */
function activity_log ( $event_id, $user, $type, $text="" ) {
  $next_id = 1;

  if ( empty ( $type ) ) {
    echo "Error: type not set for activity log!";
    // but don't exit since we may be in mid-transaction
    return;
  }

  $res = dbi_query ( "SELECT MAX(cal_log_id) FROM webcal_entry_log" );
  if ( $res ) {
    if ( $row = dbi_fetch_row ( $res ) ) {
      $next_id = $row[0] + 1;
    }
    dbi_free_result ( $res );
  }


  $event_id = mysql_safe( $event_id, false );
  $user = mysql_safe( $user, true );
  $type = mysql_safe( $type, true );
  $text = mysql_safe( $text, true );
  $sql_text = empty ( $text ) ? "NULL" : "'$text'";

  $sql = "INSERT INTO webcal_entry_log ( " .
    "cal_log_id, cal_entry_id, cal_login, cal_type, " .
    "cal_text ) VALUES ( $next_id, $event_id, " .
    "'$user', '$type', $sql_text )";
  if ( ! dbi_query ( $sql ) ) {
    echo "Database error: " . dbi_error ();
    echo "<br />\nSQL:<br />\n$sql";
    exit;
  }
}


/**
 * Gets a preference setting for the specified user.
 *
 * If no value is found in the database, then the system default setting will
 * be returned.
 *
 * @param string $user    User login we are getting preference for
 * @param string $setting Name of the setting
 *
 * @return string The value found in the webcal_user_pref table for the
 *                specified setting or the sytem default if no user settings
 *                was found.
 */
function get_pref_setting ( $user, $setting ) {
  $ret = '';
  // set default
  if ( ! isset ( $GLOBALS["sys_" .$setting] ) ) {
    // this could happen if the current user has not saved any pref. yet
    if ( ! empty ( $GLOBALS[$setting] ) )
      $ret = $GLOBALS[$setting];
  } else {
    $ret = $GLOBALS["sys_" .$setting];
  }

  $user = mysql_safe( $user, true );
  $setting = mysql_safe( $setting, true );
  $sql = "SELECT cal_value FROM webcal_user_pref " .
    "WHERE cal_login = '" . $user . "' AND " .
    "cal_setting = '" . $setting . "'";
  //echo "SQL: $sql <br />\n";
  $res = dbi_query ( $sql );
  if ( $res ) {
    if ( $row = dbi_fetch_row ( $res ) )
      $ret = $row[0];
    dbi_free_result ( $res );
  }
  return $ret;
}



/**
 * Generates the HTML used in an event popup for the site_extras fields of an event.
 *
 * @param int $id Event ID
 *
 * @return string The HTML to be used within the event popup for any site_extra
 *                fields found for the specified event
 */
function site_extras_for_popup ( $id ) {
  global $site_extras_in_popup, $site_extras;
  // These are needed in case the site_extras.php file was already
  // included.
  global $EXTRA_TEXT, $EXTRA_MULTILINETEXT, $EXTRA_URL, $EXTRA_DATE,
    $EXTRA_EMAIL, $EXTRA_USER, $EXTRA_REMINDER, $EXTRA_SELECTLIST;
  global $EXTRA_REMINDER_WITH_DATE, $EXTRA_REMINDER_WITH_OFFSET,
    $EXTRA_REMINDER_DEFAULT_YES;

  $ret = '';

  if ( $site_extras_in_popup != 'Y' )
    return '';

  include_once 'includes/site_extras.php';

  $extras = get_site_extra_fields ( $id );
  for ( $i = 0; $i < count ( $site_extras ); $i++ ) {
    $extra_name = $site_extras[$i][0];
    $extra_type = $site_extras[$i][2];
    $extra_arg1 = $site_extras[$i][3];
    $extra_arg2 = $site_extras[$i][4];
    if ( ! empty ( $extras[$extra_name]['cal_name'] ) ) {
      $ret .= "<dt>" . $site_extras[$i][1] . ":</dt>\n<dd>";
      if ( $extra_type == $EXTRA_DATE ) {
        if ( $extras[$extra_name]['cal_date'] > 0 )
          $ret .= date_to_str ( $extras[$extra_name]['cal_date'] );
      } else if ( $extra_type == $EXTRA_TEXT ||
        $extra_type == $EXTRA_MULTILINETEXT ) {
        $ret .= nl2br ( $extras[$extra_name]['cal_data'] );
      } else if ( $extra_type == $EXTRA_REMINDER ) {
        if ( $extras[$extra_name]['cal_remind'] <= 0 )
          $ret .= "No";
        else {
          $ret .= "Yes";
          if ( ( $extra_arg2 & $EXTRA_REMINDER_WITH_DATE ) > 0 ) {
            $ret .= "&nbsp;&nbsp;-&nbsp;&nbsp;";
            $ret .= date_to_str ( $extras[$extra_name]['cal_date'] );
          } else if ( ( $extra_arg2 & $EXTRA_REMINDER_WITH_OFFSET ) > 0 ) {
            $ret .= "&nbsp;&nbsp;-&nbsp;&nbsp;";
            $minutes = $extras[$extra_name]['cal_data'];
            $d = (int) ( $minutes / ( 24 * 60 ) );
            $minutes -= ( $d * 24 * 60 );
            $h = (int) ( $minutes / 60 );
            $minutes -= ( $h * 60 );
            if ( $d > 0 )
              $ret .= $d . "&nbsp;" . "days" . "&nbsp;";
            if ( $h > 0 )
              $ret .= $h . "&nbsp;" . "hours" . "&nbsp;";
            if ( $minutes > 0 )
              $ret .= $minutes . "&nbsp;" . "minutes";
            $ret .= "&nbsp;" . "before event";
          }
        }
      } else {
        $ret .= $extras[$extra_name]['cal_data'];
      }
      $ret .= "</dd>\n";
    }
  }
  return $ret;
}

/**
 * Builds the HTML for the event popup.
 *
 * @param string $popupid     CSS id to use for event popup
 * @param string $menu        Meal menu
 *
 * @return string The HTML for the event popup
 */
function build_event_popup ( $popupid, $menu ) {
  global $login;
  $ret = "<dl id=\"$popupid\" class=\"popup\">\n";

  $ret .= "<dt>Menu:</dt>\n<dd>";
  if ( ! empty ( $GLOBALS['allow_html_description'] ) &&
    $GLOBALS['allow_html_description'] == 'Y' ) {
    $str = str_replace ( "&", "&amp;", $menu );
    $str = str_replace ( "&amp;amp;", "&amp;", $str );
    // If there is no html found, then go ahead and replace
    // the line breaks ("\n") with the html break.
    if ( strstr ( $str, "<" ) && strstr ( $str, ">" ) ) {
      // found some html...
      $ret .= $str;
    } else {
      // no html, replace line breaks
      $ret .= nl2br ( $str );
    }
  } else {
    // html not allowed in notes, escape everything
    $ret .= nl2br ( htmlspecialchars ( $menu ) );
  }
  $ret .= "</dd>\n";
  $ret .= "</dl>\n";
  return $ret;
}

/**
 * Prints out a date selection box for use in a form.
 *
 * @param string $prefix Prefix to use in front of form element names
 * @param int    $date   Currently selected date (in YYYYMMDD format)
 *
 * @uses date_selection_html
 */
function print_date_selection ( $prefix, $date, $formname ) {
  print date_selection_html ( $prefix, $date, 20, $formname );
}

/**
 * Prints out a date selection box for use in a form.
 *
 * @param string $prefix Prefix to use in front of form element names
 * @param int    $date   Currently selected date (in YYYYMMDD format)
 *
 * @uses date_selection_html
 */
function print_birthdate_selection ( $date, $formname ) {
  print date_selection_html ( 'birth', $date, 200,$formname );
}


/**
 * Generate HTML for a date selection for use in a form.
 *
 * @param string $prefix Prefix to use in front of form element names
 * @param int    $date   Currently selected date (in YYYYMMDD format)
 *
 * @return string HTML for the selection box
 */
function date_selection_html ( $prefix, $date, $num_years, $formname ) {
  $ret = "";
  if ( strlen ( $date ) != 8 )
    $date = date ( "Ymd" );
  $thisyear = $year = substr ( $date, 0, 4 );
  $thismonth = $month = substr ( $date, 4, 2 );
  $thisday = $day = substr ( $date, 6, 2 );
  if ( $thisyear - date ( "Y" ) >= ( $num_years - 1 ) )
    $num_years = $thisyear - date ( "Y" ) + 2;
  $ret .= "<select name=\"" . $prefix . "day\">\n";
  for ( $i = 1; $i <= 31; $i++ )
    $ret .= "<option value=\"$i\"" .
      ( $i == $thisday ? " selected=\"selected\"" : "" ) . ">$i</option>\n";
  $ret .= "</select>\n<select name=\"" . $prefix . "month\">\n";
  for ( $i = 1; $i <= 12; $i++ ) {
    $m = month_short_name ( $i - 1 );
    $ret .= "<option value=\"$i\"" .
      ( $i == $thismonth ? " selected=\"selected\"" : "" ) . ">$m</option>\n";
  }
  $ret .= "</select>\n<select name=\"" . $prefix . "year\">\n";
  for ( $i = -$num_years/2; $i < $num_years/2; $i++ ) {
    $y = $thisyear + $i;
    $ret .= "<option value=\"$y\"" .
      ( $y == $thisyear ? " selected=\"selected\"" : "" ) . ">$y</option>\n";
  }
  $ret .= "</select>\n";
  if ( strcmp( $prefix, 'birth' ) ) {
    $ret .= " or <input type=\"button\" onclick=\"selectDate( '" .
      $prefix . "day','" . $prefix . "month','" . $prefix . 
      "year',$date, event, '$formname')\" value=\"Select date from calendar\" />\n";
  }

  return $ret;
}

/**
 * Prints out a minicalendar for a month.
 *
 * @param int    $thismonth     Number of the month to print
 * @param int    $thisyear      Number of the year
 * @param bool   $showyear      Show the year in the calendar's title?
 * @param string $minical_id    id attribute for the minical table
 * @param string $month_link    URL and query string for month link that should
 *                              come before the date specification (e.g.
 *                              month.php?  or  view_l.php?id=7&amp;)
 */
function display_small_month ( $thismonth, $thisyear, $showyear,
  $minical_id='', $month_link='month.php?' ) {
  global $WEEK_START, $user, $login;
  global $today;

  //start the minical table for each month
  echo "\n<table class=\"minical\"";
  if ( $minical_id != '' ) {
    echo " id=\"$minical_id\"";
  }
  echo ">\n";

  $monthstart = mktime(2,0,0,$thismonth,1,$thisyear);
  $monthend = mktime(2,0,0,$thismonth + 1,0,$thisyear);

  //print the month name
  echo "<caption><a href=\"month.php?year=$thisyear&amp;month=$thismonth\">";
  echo month_name ( $thismonth - 1 ) . ( $showyear ? " $thisyear" : "" );
  echo "</a></caption>\n";
  echo "<thead>\n<tr>\n";


  //determine if the week starts on sunday or monday
  if ( $WEEK_START == "1" ) {
    $wkstart = get_monday_before ( $thisyear, $thismonth, 1 );
  } else {
    $wkstart = get_sunday_before ( $thisyear, $thismonth, 1 );
  }
  //print the headers to display the day of the week (sun, mon, tues, etc.)

  //if the week doesn't start on monday, print the day
  if ( $WEEK_START == 0 ) echo "<th>" .
    weekday_short_name ( 0 ) . "</th>\n";
  //cycle through each day of the week until gone
  for ( $i = 1; $i < 7; $i++ ) {
    echo "<th>" .  weekday_short_name ( $i ) .  "</th>\n";
  }
  //if the week DOES start on monday, print sunday
  if ( $WEEK_START == 1 )
    echo "<th>" .  weekday_short_name ( 0 ) .  "</th>\n";
  //end the header row
  echo "</tr>\n</thead>\n<tbody>\n";
  for ($i = $wkstart; date("Ymd",$i) <= date ("Ymd",$monthend);
    $i += (24 * 3600 * 7) ) {
    echo "<tr>\n";
    for ($j = 0; $j < 7; $j++) {
      $date = $i + ($j * 24 * 3600);
      $dateYmd = date ( "Ymd", $date );
      $hasEvents = false;
      $suit = "empty";
      $meal_id = 0;
      $ev = get_entries ( $dateYmd );
      for ( $k = 0; $k < count ( $ev ) && $hasEvents == false ; $k++ ) {
        $viewid = $ev[$k]['cal_id'];
        if ( is_cancelled( $viewid ) == true )
          continue;
	$hasEvents = true;
	$suit = $ev[$k]['cal_suit'];
	$meal_id = $ev[$k]['cal_id'];
      } 
      if ( $dateYmd >= date ("Ymd",$monthstart) &&
        $dateYmd <= date ("Ymd",$monthend) ) {
        $wday = date ( 'w', $date );
	echo "<td";
        if ( date ( "Ymd", $date  ) == date ( "Ymd", $today ) ){
          echo " id=\"today\"";
        }
        echo ">";
	$suit .= "_15x15.png";
	if ( $hasEvents ) {
	  echo "<a href=\"view_entry.php?id=$meal_id\">";
	} else 
	  echo "<a/>";
	echo date ( "j", $date ) . "<br/>" .
	  "<img width=\"15\" border=\"0\" src=\"images/$suit\" /></a></td>\n";
      } else {
	echo "<td class=\"empty\">&nbsp;</td>\n";
      }
    }                 // end for $j
    echo "</tr>\n";
  }                         // end for $i
  echo "</tbody>\n</table>\n";
}

/**
 * Prints the HTML for one day's events in the month view.
 *
 * @param int    $id          Event ID
 * @param int    $date        Date of event in YYYYMMDD format
 * @param int    $time        Time (in HHMMSS format)
 * @param string $suit        Event name
 * @param string $notes       Notes
 *
 * @staticvar int Used to ensure all event popups have a unique id
 *
 * @uses build_event_popup
 */
function print_entry ( $id, $date, $time, $suit, $menu, $price, $deadline ) {
  global $eventinfo, $PHP_SELF;
  global $login;
  static $key = 0;


  $popupid = "eventinfo-$id-$key";
  $key++;

  $meal_indicator = create_meal_indicator( $id, $date, $time, $suit, $price, $popupid, $login );
  $crew_display = create_crew_display( $id );

  echo "<table class=\"event_info\">";
  echo "<tr><td>";
  echo $meal_indicator;
  echo "</td></tr>";


  echo "<tr><td>";
  echo $crew_display;
  echo "</td></tr></table>";  
  

  for ( $i=0; $i<count($deadline); $i++ )
    echo "<br/>Deadline for " . 
      date_to_str( $deadline[$i], "__month__ __dd__", false, true, "" );

  $eventinfo .= build_event_popup ( $popupid, $menu );
}


function create_meal_indicator( $id, $date, $time, $suit, $price, $popupid, $login ) {

  $id = mysql_safe( $id, false );
  $login = mysql_safe( $login, true );
  $sql = "SELECT cal_login FROM webcal_meal_participant " .
    "WHERE cal_id = $id AND cal_login = '$login' " .
    "AND ( cal_type = 'M' OR cal_type = 'T' )";
  $class = "entry";
  $eating = false;
  if ( $res = dbi_query ( $sql ) ) {
    if ( dbi_fetch_row ( $res ) ) {
      $class = "participating_entry";
      $eating = true;
    }
    dbi_free_result( $res );
  }
  $sql = "SELECT cal_login FROM webcal_meal_participant " .
    "WHERE cal_id = $id AND cal_login = '$login' " .
    "AND ( cal_type = 'H' OR cal_type = 'C' )";
  $working = false;
  if ( $res = dbi_query ( $sql ) ) {
    if ( dbi_fetch_row ( $res ) ) {
      $class = "participating_entry";
      $working = true;
    }
    dbi_free_result( $res );
  }

  $meal_display = "";


  $suit_img = $suit;
  $suit_img .= "_20x20.png";
  $meal_display .= "<img width=\"20\" border=\"0\"" . 
    "src=\"images/$suit_img\" alt=\"View this entry\" />";


  $meal_display .= "<a class=\"$class\" href=\"view_entry.php?id=$id&amp;date=$date";
  $meal_display .= "\" onmouseover=\"window.status='" . 
    "'; show(event, '$popupid'); return true;\" onmouseout=\"window.status=''; hide('$popupid'); return true;\">";

  $timestr = "";
  $timestr = display_time ( $time );
  $time_short = preg_replace ("/(:00)/", '', $timestr);
  $meal_display .= "&nbsp;" . $time_short; 
  $meal_display .= "&nbsp; (" . price_to_str( $price ) . ")";
  $meal_display .= "</a>\n";

  if ( $class == "participating_entry" ) {
    $meal_display .= " (";
    if ( $eating == true )
      $meal_display .= "E";
    if ( $working == true )
      $meal_display .= "W";
    $meal_display .= ")";
  }
  
  return $meal_display;
}

function create_crew_display( $id ) {

  $crew_display = "";
  $crew_display .= "<table class=\"main_show_crew\">";

  $head_chef = has_head_chef( $id );
  if ( $head_chef == "" ) $chef = "<font color=\"#DD0000\">STILL NEEDED</font>";
  else {
    user_load_variables( $head_chef, "chef" );
    $chef = $GLOBALS[cheffirstname];
  }
  $crew_display .= "<tr><td>Head:</td><td>" . $chef . "</td></tr>";
  $label = "Crew:";

  $crew = load_crew( $id, false );
  for ( $i=0; $i<count( $crew['name'] ); $i++ ) {
    $crew_display .= "<tr><td>" . $label . "</td>";
    $crew_display .= "<td>" . $crew['name'][$i] . " (" . $crew['job'][$i] . ")</td></tr>";
    $label = "";
  }

  $crew_display .= "</table>";

  return $crew_display;
}


function load_crew( $id, $use_longnames=true ) {

  $crew = array();

  $id = mysql_safe( $id, false );
  $sql = "SELECT cal_login, cal_notes " . 
    "FROM webcal_meal_participant " . 
    "WHERE cal_id = $id AND cal_type = 'C'";
  $i = 0;
  if ( $res = dbi_query( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {
      $crew_user = $row[0];
      $crew_job = $row[1];
      $crew['username'][$i] = $crew_user;

      if ( ereg( "^none", $crew_user ) ) {
	$crew['name'][$i] = "<font color=\"#DD0000\">STILL NEEDED</font>";
	$name_length = 12;
      } else {
	user_load_variables( $crew_user, "temp" );
	$crew['name'][$i] = $GLOBALS['tempfirstname'];
	if ( $use_longnames == true )
	  $crew['name'][$i] .= " " . $GLOBALS['templastname'];
	$name_length = strlen( $crew[$i]['name'] );
      }

      $job_length = strlen( $crew_job );
      if ( $use_longnames == false ) {
	$available_length = 25 - $name_length;
      } else $available_length = $job_length;
      
      if ( $job_length > $available_length ) {
	$crew['job'][$i] = substr_replace( $crew_job, "...", $available_length, $job_length );
      } else {
	$crew['job'][$i] = $crew_job;
      }

      $i++;
    }
    dbi_free_result( $res );
  }

  // keep the different jobs together
  if ( count( $crew['job'] ) > 0 ) 
    array_multisort( $crew['job'], $crew['name'], $crew['username'] );

  return $crew;
}


/** 
 * Gets any site-specific fields for an entry that are stored in the database in the webcal_site_extras table.
 *
 * @param int $eventid Event ID
 *
 * @return array Array with the keys as follows:
 *    - <var>cal_name</var>
 *    - <var>cal_type</var>
 *    - <var>cal_date</var>
 *    - <var>cal_remind</var>
 *    - <var>cal_data</var>
 */
function get_site_extra_fields ( $eventid ) {
  $eventid = mysql_safe( $eventid, false );
  $sql = "SELECT cal_name, cal_type, cal_date, cal_remind, cal_data " .
    "FROM webcal_site_extras " .
    "WHERE cal_id = $eventid";
  $res = dbi_query ( $sql );
  $extras = array ();
  if ( $res ) {
    while ( $row = dbi_fetch_row ( $res ) ) {
      // save by cal_name (e.g. "URL")
      $extras[$row[0]] = array (
        "cal_name" => $row[0],
        "cal_type" => $row[1],
        "cal_date" => $row[2],
        "cal_remind" => $row[3],
        "cal_data" => $row[4]
      );
    }
    dbi_free_result ( $res );
  }
  return $extras;
}

/**
 * Reads all the events for a user for the specified range of dates.
 *
 * This is only called once per page request to improve performance.  All the
 * events get loaded into the array <var>$events</var> sorted by time of day
 * (not date).
 *
 * @param string $startdate Start date range, inclusive (in YYYYMMDD format)
 * @param string $enddate   End date range, inclusive (in YYYYMMDD format)
 *
 * @return array Array of events
 *
 * @uses query_events
 */
function read_events ( $startdate, $enddate ) {
  global $login;

  $sy = substr ( $startdate, 0, 4 );
  $sm = substr ( $startdate, 4, 2 );
  $sd = substr ( $startdate, 6, 2 );
  $ey = substr ( $enddate, 0, 4 );
  $em = substr ( $enddate, 4, 2 );
  $ed = substr ( $enddate, 6, 2 );
  if ( $startdate == $enddate ) {
    $date_filter = "webcal_meal.cal_date = $startdate";
  } else {
    $date_filter = " webcal_meal.cal_date >= $startdate " .
      "AND webcal_meal.cal_date <= $enddate";
  }
  return query_events ( $date_filter );
}

/**
 * Gets all the events for a specific date.
 *
 * Events are retreived from the array of pre-loaded events (which was loaded
 * all at once to improve performance).
 *
 * The returned events will be sorted by time of day.
 *
 * @param string $date           Date to get events for in YYYYMMDD format
 *
 * @return array Array of events
 */
function get_entries ( $date ) {
  global $events;
  $n = 0;
  $ret = array ();

  for ( $i = 0; $i < count ( $events ); $i++ ) {
    // In case of data corruption (or some other bug...)
    if ( empty ( $events[$i] ) || empty ( $events[$i]['cal_id'] ) )
      continue;
    if ( $events[$i]['cal_date'] == $date )
      $ret[$n++] = $events[$i];

  }
  return $ret;
}

/**
 * Reads events 
 *
 * @param string $date_filter   SQL phrase starting with AND, to be appended to
 *                              the WHERE clause.  May be empty string.
 *
 * @return array Array of events sorted by time of day
 */
function query_events ( $date_filter ) {
  global $login;
  global $public_access_default_visible;
  $result = array ();

  $sql = "SELECT webcal_meal.cal_suit, webcal_meal.cal_notes, "
    . "webcal_meal.cal_date, webcal_meal.cal_time, "
    . "webcal_meal.cal_id, webcal_meal.cal_menu, webcal_meal.cal_base_price ";
  $sql .= "FROM webcal_meal WHERE ";

  $sql .= $date_filter;

  // now order the results by time and by entry id.
  $sql .= " ORDER BY webcal_meal.cal_time, webcal_meal.cal_id";

  //echo "<strong>SQL:</strong> $sql<br />\n";
  
  $res = dbi_query ( $sql );
  if ( $res ) {
    $i = 0;
    $checkdup_id = -1;
    $first_i_this_id = -1;

    while ( $row = dbi_fetch_row ( $res ) ) {

      $item = array (
        "cal_suit" => $row[0],
        "cal_notes" => $row[1],
        "cal_date" => $row[2],
        "cal_time" => $row[3],
        "cal_id"   => $row[4],
        "cal_menu" => $row[5],
	"cal_base_price" => $row[6],
  "cal_exceptions" => array()
        );

      if ( $item['cal_id'] != $checkdup_id ) {
        $checkdup_id = $item['cal_id'];
        $first_i_this_id = $i;
      }

      if ($i == $first_i_this_id) {
	// This item either is the first one with its ID, or allows dups.
	// Add it to the end of the array.
	$result [$i++] = $item;
      }
    }
    dbi_free_result ( $res );
  }

  return $result;
}




/**
 * Converts a date to a timestamp.
 * 
 * @param string $d Date in YYYYMMDD format
 *
 * @return int Timestamp representing 3:00 (or 4:00 if during Daylight Saving
 *             Time) in the morning on that day
 */
function date_to_epoch ( $d ) {
  if ( $d == 0 )
    return 0;
  $T = mktime ( 3, 0, 0, substr ( $d, 4, 2 ), substr ( $d, 6, 2 ), substr ( $d, 0, 4 ) );
  $lt = localtime($T);
  if ($lt[8]) {
    return mktime ( 4, 0, 0, substr ( $d, 4, 2 ), substr ( $d, 6, 2 ), substr ( $d, 0, 4 ) );
  } else {
    return $T;
  }
}

/**
 * Checks if a date is an exception for an event.
 *
 * @param string $date   Date in YYYYMMDD format
 * @param array  $exdays Array of dates in YYYYMMDD format
 *
 * @ignore
 */
function is_exception ( $date, $ex_days ) {
  $size = count ( $ex_days );
  $count = 0;
  $date = date ( "Ymd", $date );
  //echo "Exception $date check.. count is $size <br />\n";
  while ( $count < $size ) {
    //echo "Exception date: $ex_days[$count] <br />\n";
    if ( $date == $ex_days[$count++] )
      return true;
  }
  return false;
}

/**
 * Gets the Sunday of the week that the specified date is in.
 *
 * If the date specified is a Sunday, then that date is returned.
 *
 * @param int $year  Year
 * @param int $month Month (1-12)
 * @param int $day   Day of the month
 *
 * @return int The date (in UNIX timestamp format)
 *
 * @see get_monday_before
 */
function get_sunday_before ( $year, $month, $day ) {
  $weekday = date ( "w", mktime ( 3, 0, 0, $month, $day, $year ) );
  $newdate = mktime ( 3, 0, 0, $month, $day - $weekday, $year );
  return $newdate;
}

/** 
 * Gets the Monday of the week that the specified date is in.
 *
 * If the date specified is a Monday, then that date is returned.
 *
 * @param int $year  Year
 * @param int $month Month (1-12)
 * @param int $day   Day of the month
 *
 * @return int The date (in UNIX timestamp format)
 *
 * @see get_sunday_before
 */
function get_monday_before ( $year, $month, $day ) {
  $weekday = date ( "w", mktime ( 3, 0, 0, $month, $day, $year ) );
  if ( $weekday == 0 )
    return mktime ( 3, 0, 0, $month, $day - 6, $year );
  if ( $weekday == 1 )
    return mktime ( 3, 0, 0, $month, $day, $year );
  return mktime ( 3, 0, 0, $month, $day - ( $weekday - 1 ), $year );
}


function get_first_wednesday ( $year, $month ) {
  $day = 0;
  $weekday = 0;
  while ( $weekday != 3 ) {
    $day++;
    $weekday = date ( "w", mktime( 3, 0, 0, $month, $day, $year ) );
  }
  
  return mktime ( 3, 0, 0, $month, $day, $year );
}


function add_days( $orig_date, $add_number ) {
  return $orig_date + 3600*24*$add_number;
}

/**
 * Prints all the calendar entries for the specified date.
 *
 * @param string $date Date in YYYYMMDD format
 */
function print_date_entries ( $date ) {
  global $is_meal_coordinator, $login;
  $cnt = 0;

  $year = substr ( $date, 0, 4 );
  $month = substr ( $date, 4, 2 );
  $day = substr ( $date, 6, 2 );
  $dateu = mktime ( 3, 0, 0, $month, $day, $year );
  $can_add = $is_meal_coordinator;
  echo "<div>$day</div>";
  
  // get all events for this date and store in $ev
  $ev = get_entries ( $date );


  //// check if this is the deadline for any meals
  $deadline = array();
  $ct = 0;
  $sql = "SELECT cal_date, cal_signup_deadline " .
    "FROM webcal_meal " .
    "WHERE cal_cancelled = 0 AND cal_date >= $date";
  if ( $res = dbi_query( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {
      $event_date = $row[0];
      $d = $row[1];
      $deadline_day = get_day( $event_date, -1*$d );
      if ( $date == $deadline_day ) {
	$deadline[$ct++] = $event_date;
      }
    }
    dbi_free_result( $res );
  }



  for ( $i = 0; $i < count ( $ev ); $i++ ) {
    $viewid = $ev[$i]['cal_id'];

    if ( is_cancelled( $viewid ) == true ) continue;

    $suit = $ev[$i]['cal_suit'];

    print_entry ( $viewid,
		  $date, $ev[$i]['cal_time'],
		  $suit, $ev[$i]['cal_menu'], $ev[$i]['cal_base_price'], $deadline );
    $cnt++;
  }
  if ( $cnt == 0 ) { // no events but still print deadlines
    echo "&nbsp;<br/><br/>"; 
    for ( $i=0; $i<count($deadline); $i++ )
      echo "<br/>Deadline for " . 
	date_to_str( $deadline[$i], "__month__ __dd__", false, true, "" );
  }

}


/**
 * Converts a time format HHMMSS (like 130000 for 1PM) into number of minutes past midnight.
 *
 * @param string $time Input time in HHMMSS format
 *
 * @return int The number of minutes since midnight
 */
function time_to_minutes ( $time ) {
  $h = (int) ( $time / 10000 );
  $m = (int) ( $time / 100 ) % 100;
  $num = $h * 60 + $m;
  return $num;
}

/**
 * Calculates which row/slot this time represents.
 *
 * This is used in week view where hours of the time are separeted
 * into different cells in a table.
 *
 * <b>Note:</b> the global variable <var>$TIME_SLOTS</var> is used to determine
 * how many time slots there are and how many minutes each is.  This variable
 * is defined user preferences (or defaulted to admin system settings).
 *
 * @param string $time       Input time in HHMMSS format
 * @param bool   $round_down Should we change 1100 to 1059?
 *                           (This will make sure a 10AM-100AM appointment just
 *                           shows up in the 10AM slow and not in the 11AM slot
 *                           also.)
 *
 * @return int The time slot index
 */
function calc_time_slot ( $time, $round_down = false ) {
  global $TIME_SLOTS, $TZ_OFFSET;

  $interval = ( 24 * 60 ) / $TIME_SLOTS;
  $mins_since_midnight = time_to_minutes ( $time );
  $ret = (int) ( $mins_since_midnight / $interval );
  if ( $round_down ) {
    if ( $ret * $interval == $mins_since_midnight )
      $ret--;
  }
  //echo "$mins_since_midnight / $interval = $ret <br />\n";
  if ( $ret > $TIME_SLOTS )
    $ret = $TIME_SLOTS;

  //echo "<br />\ncalc_time_slot($time) = $ret <br />\nTIME_SLOTS = $TIME_SLOTS<br />\n";
  return $ret;
}




/**
 * Looks for URLs in the given text, and makes them into links.
 *
 * @param string $text Input text
 *
 * @return string The text altered to have HTML links for any web links
 *                (http or https)
 */
function activate_urls ( $text ) {
  $str = eregi_replace ( "(http://[^[:space:]$]+)",
    "<a href=\"\\1\">\\1</a>", $text );
  $str = eregi_replace ( "(https://[^[:space:]$]+)",
    "<a href=\"\\1\">\\1</a>", $str );
  return $str;
}

/**
 * Displays a time in either 12 or 24 hour format.
 *
 * The global variable $TZ_OFFSET is used to adjust the time.  Note that this
 * is somewhat of a kludge for timezone support.  If an event is set for 11PM
 * server time and the user is 2 hours ahead, it will show up as 1AM, but the
 * date will not be adjusted to the next day.
 *
 * @param string $time          Input time in HHMMSS format
 * @param bool   $ignore_offset If true, then do not use the timezone offset
 *
 * @return string The time in the user's timezone and preferred format
 *
 * @global int The user's timezone offset from the server
 */
function display_time ( $time, $ignore_offset=0 ) {
  global $TZ_OFFSET;
  $hour = (int) ( $time / 10000 );
  if ( ! $ignore_offset )
    $hour += $TZ_OFFSET;
  $min = abs( ( $time / 100 ) % 100 );
  //Prevent goofy times like 8:00 9:30 9:00 10:30 10:00 
  if ( $time < 0 && $min > 0 ) $hour = $hour - 1;
  while ( $hour < 0 )
    $hour += 24;
  while ( $hour > 23 )
    $hour -= 24;
  if ( $GLOBALS["TIME_FORMAT"] == "12" ) {
    $ampm = ( $hour >= 12 ) ? "pm" : "am";
    $hour %= 12;
    if ( $hour == 0 )
      $hour = 12;
    $ret = sprintf ( "%d:%02d%s", $hour, $min, $ampm );
  } else {
    $ret = sprintf ( "%d:%02d", $hour, $min );
  }
  return $ret;
}

/**
 * Returns the full name of the specified month.
 *
 * Use {@link month_short_name()} to get the abbreviated name of the month.
 *
 * @param int $m Number of the month (0-11)
 *
 * @return string The full name of the specified month
 *
 * @see month_short_name
 */
function month_name ( $m ) {
  switch ( $m ) {
    case 0: return "January";
    case 1: return "February";
    case 2: return "March";
    case 3: return "April";
    case 4: return "May_"; // needs to be different than "May"
    case 5: return "June";
    case 6: return "July";
    case 7: return "August";
    case 8: return "September";
    case 9: return "October";
    case 10: return "November";
    case 11: return "December";
  }
  return "unknown-month($m)";
}

/**
 * Returns the abbreviated name of the specified month (such as "Jan").
 *
 * Use {@link month_name()} to get the full name of the month.
 *
 * @param int $m Number of the month (0-11)
 *
 * @return string The abbreviated name of the specified month (example: "Jan")
 *
 * @see month_name
 */
function month_short_name ( $m ) {
  switch ( $m ) {
    case 0: return "Jan";
    case 1: return "Feb";
    case 2: return "Mar";
    case 3: return "Apr";
    case 4: return "May";
    case 5: return "Jun";
    case 6: return "Jul";
    case 7: return "Aug";
    case 8: return "Sep";
    case 9: return "Oct";
    case 10: return "Nov";
    case 11: return "Dec";
  }
  return "unknown-month($m)";
}

/**
 * Returns the full weekday name.
 *
 * Use {@link weekday_short_name()} to get the abbreviated weekday name.
 *
 * @param int $w Number of the day in the week (0=Sunday,...,6=Saturday)
 *
 * @return string The full weekday name ("Sunday")
 *
 * @see weekday_short_name
 */
function weekday_name ( $w ) {
  switch ( $w ) {
    case 0: return "Sunday";
    case 1: return "Monday";
    case 2: return "Tuesday";
    case 3: return "Wednesday";
    case 4: return "Thursday";
    case 5: return "Friday";
    case 6: return "Saturday";
  }
  return "unknown-weekday($w)";
}

/**
 * Returns the abbreviated weekday name.
 *
 * Use {@link weekday_name()} to get the full weekday name.
 *
 * @param int $w Number of the day in the week (0=Sunday,...,6=Saturday)
 *
 * @return string The abbreviated weekday name ("Sun")
 */
function weekday_short_name ( $w ) {
  switch ( $w ) {
    case 0: return "Sun";
    case 1: return "Mon";
    case 2: return "Tue";
    case 3: return "Wed";
    case 4: return "Thu";
    case 5: return "Fri";
    case 6: return "Sat";
  }
  return "unknown-weekday($w)";
}

/**
 * Converts a date in YYYYMMDD format into "Friday, December 31, 1999",
 * "Friday, 12-31-1999" or whatever format the user prefers.
 *
 * @param string $indate       Date in YYYYMMDD format
 * @param string $format       Format to use for date (default is "__month__
 *                             __dd__, __yyyy__")
 * @param bool   $show_weekday Should the day of week also be included?
 * @param bool   $short_months Should the abbreviated month names be used
 *                             instead of the full month names?
 * @param int    $server_time ???
 *
 * @return string Date in the specified format
 *
 * @global string Preferred date format
 * @global int    User's timezone offset from the server
 */
function date_to_str ( $indate, $format="", $show_weekday=true, $short_months=false, $server_time="" ) {
  global $DATE_FORMAT, $TZ_OFFSET;

  if ( strlen ( $indate ) == 0 ) {
    $indate = date ( "Ymd" );
  }

  $newdate = $indate;
  if ( $server_time != "" && $server_time >= 0 ) {
    $y = substr ( $indate, 0, 4 );
    $m = substr ( $indate, 4, 2 );
    $d = substr ( $indate, 6, 2 );
    if ( $server_time + $TZ_OFFSET * 10000 > 240000 ) {
       $newdate = date ( "Ymd", mktime ( 3, 0, 0, $m, $d + 1, $y ) );
    } else if ( $server_time + $TZ_OFFSET * 10000 < 0 ) {
       $newdate = date ( "Ymd", mktime ( 3, 0, 0, $m, $d - 1, $y ) );
    }
  }

  // if they have not set a preference yet...
  if ( $DATE_FORMAT == "" )
    $DATE_FORMAT = "__month__ __dd__, __yyyy__";

  if ( empty ( $format ) )
    $format = $DATE_FORMAT;

  $y = (int) ( $newdate / 10000 );
  $m = (int) ( $newdate / 100 ) % 100;
  $d = $newdate % 100;
  $date = mktime ( 3, 0, 0, $m, $d, $y );
  $wday = strftime ( "%w", $date );

  if ( $short_months ) {
    $weekday = weekday_short_name ( $wday );
    $month = month_short_name ( $m - 1 );
  } else {
    $weekday = weekday_name ( $wday );
    $month = month_name ( $m - 1 );
  }
  $yyyy = $y;
  $yy = sprintf ( "%02d", $y %= 100 );

  $ret = $format;
  $ret = str_replace ( "__yyyy__", $yyyy, $ret );
  $ret = str_replace ( "__yy__", $yy, $ret );
  $ret = str_replace ( "__month__", $month, $ret );
  $ret = str_replace ( "__mon__", $month, $ret );
  $ret = str_replace ( "__dd__", $d, $ret );
  $ret = str_replace ( "__mm__", $m, $ret );

  if ( $show_weekday )
    return "$weekday, $ret";
  else
    return $ret;
}


/**
 * Converts a hexadecimal digit to an integer.
 *
 * @param string $val Hexadecimal digit
 *
 * @return int Equivalent integer in base-10
 *
 * @ignore
 */
function hextoint ( $val ) {
  if ( empty ( $val ) )
    return 0;
  switch ( strtoupper ( $val ) ) {
    case "0": return 0;
    case "1": return 1;
    case "2": return 2;
    case "3": return 3;
    case "4": return 4;
    case "5": return 5;
    case "6": return 6;
    case "7": return 7;
    case "8": return 8;
    case "9": return 9;
    case "A": return 10;
    case "B": return 11;
    case "C": return 12;
    case "D": return 13;
    case "E": return 14;
    case "F": return 15;
  }
  return 0;
}

/**
 * Extracts a user's name from a session id.
 *
 * This prevents users from begin able to edit their cookies.txt file and set
 * the username in plain text.
 *
 * @param string $instr A hex-encoded string. "Hello" would be "678ea786a5".
 * 
 * @return string The decoded string
 *
 * @global array Array of offsets
 *
 * @see encode_string
 */
function decode_string ( $instr ) {
  global $offsets;
  //echo "<br />\nDECODE<br />\n";
  $orig = "";
  for ( $i = 0; $i < strlen ( $instr ); $i += 2 ) {
    //echo "<br />\n";
    $ch1 = substr ( $instr, $i, 1 );
    $ch2 = substr ( $instr, $i + 1, 1 );
    $val = hextoint ( $ch1 ) * 16 + hextoint ( $ch2 );
    //echo "decoding \"" . $ch1 . $ch2 . "\" = $val<br />\n";
    $j = ( $i / 2 ) % count ( $offsets );
    //echo "Using offsets $j = " . $offsets[$j] . "<br />\n";
    $newval = $val - $offsets[$j] + 256;
    $newval %= 256;
    //echo " neval \"$newval\"<br />\n";
    $dec_ch = chr ( $newval );
    //echo " which is \"$dec_ch\"<br />\n";
    $orig .= $dec_ch;
  }
  //echo "Decode string: '$orig' <br/>\n";
  return $orig;
}

/**
 * Takes an input string and encode it into a slightly encoded hexval that we
 * can use as a session cookie.
 *
 * @param string $instr Text to encode
 *
 * @return string The encoded text
 *
 * @global array Array of offsets
 *
 * @see decode_string
 */
function encode_string ( $instr ) {
  global $offsets;
  //echo "<br />\nENCODE<br />\n";
  $ret = "";
  for ( $i = 0; $i < strlen ( $instr ); $i++ ) {
    //echo "<br />\n";
    $ch1 = substr ( $instr, $i, 1 );
    $val = ord ( $ch1 );
    //echo "val = $val for \"$ch1\"<br />\n";
    $j = $i % count ( $offsets );
    //echo "Using offsets $j = $offsets[$j]<br />\n";
    $newval = $val + $offsets[$j];
    $newval %= 256;
    //echo "newval = $newval for \"$ch1\"<br />\n";
    $ret .= bin2hex ( chr ( $newval ) );
  }
  return $ret;
}

/**
 * An implementatin of array_splice() for PHP3.
 *
 * @param array $input       Array to be spliced into
 * @param int   $offset      Where to begin the splice
 * @param int   $length      How long the splice should be
 * @param array $replacement What to splice in
 *
 * @ignore
 */
function my_array_splice(&$input,$offset,$length,$replacement) {
  if ( floor(phpversion()) < 4 ) {
    // if offset is negative, then it starts at the end of array
    if ( $offset < 0 )
      $offset = count($input) + $offset;

    for ($i=0;$i<$offset;$i++) {
      $new_array[] = $input[$i];
    }

    // if we have a replacement, insert it
    for ($i=0;$i<count($replacement);$i++) {
      $new_array[] = $replacement[$i];
    }

    // now tack on the rest of the original array
    for ($i=$offset+$length;$i<count($input);$i++) {
      $new_array[] = $input[$i];
    }

    $input = $new_array;
  } else {
    array_splice($input,$offset,$length,$replacement);
  }
}



/**
 * Converts HTML entities in 8bit.
 *
 * <b>Note:</b> Only supported for PHP4 (not PHP3).
 *
 * @param string $html HTML text
 *
 * @return string The converted text
 */
function html_to_8bits ( $html ) {
  if ( floor(phpversion()) < 4 ) {
    return $html;
  } else {
    return strtr ( $html, array_flip (
      get_html_translation_table (HTML_ENTITIES) ) );
  }
}


/**
 * Fakes an email for testing purposes.
 *
 * @param string $mailto Email address to send mail to
 * @param string $subj   Subject of email
 * @param string $text   Email body
 * @param string $hdrs   Other email headers
 *
 * @ignore
 */
function fake_mail ( $mailto, $subj, $text, $hdrs ) { 
  echo "To: $mailto <br />\n" .
    "Subject: $subj <br />\n" .
    nl2br ( $hdrs ) . "<br />\n" .
    nl2br ( $text );
}


/**
 * Determines what the day is after the <var>$TZ_OFFSET</var> and sets it globally.
 *
 * The following global variables will be set:
 * - <var>$thisyear</var>
 * - <var>$thismonth</var>
 * - <var>$thisday</var>
 * - <var>$thisdate</var>
 * - <var>$today</var>
 *
 * @param string $date The date in YYYYMMDD format
 */
function set_today($date) {
  global $thisyear, $thisday, $thismonth, $thisdate, $today;
  global $TZ_OFFSET, $month, $day, $year, $thisday;

  // Adjust for TimeZone
  $today = time() + ($TZ_OFFSET * 60 * 60);

  if ( ! empty ( $date ) && ! empty ( $date ) ) {
    $thisyear = substr ( $date, 0, 4 );
    $thismonth = substr ( $date, 4, 2 );
    $thisday = substr ( $date, 6, 2 );
  } else {
    if ( empty ( $month ) || $month == 0 )
      $thismonth = date("m", $today);
    else
      $thismonth = $month;
    if ( empty ( $year ) || $year == 0 )
      $thisyear = date("Y", $today);
    else
      $thisyear = $year;
    if ( empty ( $day ) || $day == 0 )
      $thisday = date("d", $today);
    else
      $thisday = $day;
  }
  $thisdate = sprintf ( "%04d%02d%02d", $thisyear, $thismonth, $thisday );
}


/**
 * Is this a leap year?
 *
 * @internal JGH Borrowed isLeapYear from PEAR Date_Calc Class
 *
 * @param int $year Year
 *
 * @return bool True for a leap year, else false
 *
 * @ignore
 */
function isLeapYear($year='') {
  if (empty($year)) $year = strftime("%Y",time());
  if (strlen($year) != 4) return false;
  if (preg_match('/\D/',$year)) return false;
  return (($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0);
}

/**
 * Replaces unsafe characters with HTML encoded equivalents.
 *
 * @param string $value Input text
 *
 * @return string The cleaned text
 */
function clean_html($value){
  $value = htmlspecialchars($value, ENT_QUOTES);
  $value = strtr($value, array(
    '('   => '&#40;',
    ')'   => '&#41;'
  ));
  return $value;
}

/**
 * Removes non-word characters from the specified text.
 *
 * @param string $data Input text
 *
 * @return string The converted text
 */
function clean_word($data) { 
  return preg_replace("/\W/", '', $data);
}

/**
 * Removes non-digits from the specified text.
 *
 * @param string $data Input text
 *
 * @return string The converted text
 */
function clean_int($data) { 
  return preg_replace("/\D/", '', $data);
}

/**
 * Removes whitespace from the specified text.
 *
 * @param string $data Input text
 * 
 * @return string The converted text
 */
function clean_whitespace($data) { 
  return preg_replace("/\s/", '', $data);
}


/**
 * Creates the CSS for using gradient.php, if the appropriate GD functions are
 * available.
 *
 * A one-pixel wide image will be used for the background image.
 *
 * <b>Note:</b> The gd library module needs to be available to use gradient
 * images.  If it is not available, a single background color will be used
 * instead.
 *
 * @param string $color   Base color
 * @param int    $height  Height of gradient image
 * @param int    $percent How many percent lighter the top color should be
 *                        than the base color at the bottom of the image
 *
 * @return string The style sheet text to use
 */
function background_css ( $color, $height = '', $percent = '' ) {
  $ret = '';

  if ( ( function_exists ( 'imagepng' ) || function_exists ( 'imagegif' ) )
    && ( empty ( $GLOBALS['enable_gradients'] ) ||
    $GLOBALS['enable_gradients'] == 'Y' ) ) {
    $ret = "background: $color url(\"gradient.php?base=" . substr ( $color, 1 );

    if ( $height != '' ) {
      $ret .= "&height=$height";
    }

    if ( $percent != '' ) {
      $ret .= "&percent=$percent";
    }

    $ret .= "\") repeat-x;\n";
  } else {
    $ret = "background-color: $color;\n";
  }

  return $ret;
}




function time_to_hour_minute( $time, &$hour, &$minute ) {
  $hour = floor($time / 10000);
  $minute = ( $time / 100 ) % 100;
}



function price_to_dollars_cents( $price, &$dollars, &$cents ) {
  $dollars = (int)($price / 100);
  $cents = $price - ($dollars * 100);
}



function has_head_chef( $id ) {
  $head_chef = "";

  $sql = "SELECT cal_login FROM webcal_meal_participant " .
    "WHERE cal_id = $id AND cal_type = 'H'";
  $res = dbi_query( $sql );
  if ( $row = dbi_fetch_row( $res ) ) {
    $head_chef = $row[0];
  }

  return $head_chef;
}

function is_participating ( $id, $user, $type ) {
  $ret = false;

  $id = mysql_safe( $id, false );
  $user = mysql_safe( $user, true );
  $type = mysql_safe( $type, true );
  if ( $type == "B" ) {
    $sql = "SELECT cal_login FROM webcal_subscriptions " .
      "WHERE cal_login = '$user' AND cal_suit = 'club' " .
      "AND cal_club_id = $id";
  } else {
    $sql = "SELECT cal_login FROM webcal_meal_participant " .
      "WHERE cal_id = $id AND cal_login = '$user' AND cal_type = '$type'";
  }
  if ( $res = dbi_query( $sql ) ) {
    if ( dbi_fetch_row( $res ) ) {
      $ret = true;
    }
  }
  dbi_free_result( $res );

  if ( $type == "M" ) $type = "T";
  else if ( $type == "T" ) $type = "M";
  if ( ($type == "M") || ($type == "T") ) {
    $sql = "SELECT cal_login FROM webcal_meal_participant " .
      "WHERE cal_id = $id AND cal_login = '$user' AND cal_type = '$type'";
    if ( $res = dbi_query( $sql ) ) {
      if ( dbi_fetch_row( $res ) ) {
	$ret = true;
      }
    }
    dbi_free_result( $res );
  }

  return $ret;
}


function is_cancelled ( $id ) {
  $ret = false;

  $sql = "SELECT cal_cancelled FROM webcal_meal " .
    "WHERE cal_id = $id";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      if ( $row[0] == 1 ) $ret = true;
    }
    dbi_free_result( $res );
  }

  return $ret;
}


function paperwork_done( $id ) {
  $ret = false;
  $amount = 0;
  $sql = "SELECT cal_amount FROM webcal_food_expenditures " .
    "WHERE cal_meal_id = $id";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      $ret = true;
    }
  }

  return $ret;
}


///////////
// status = "all" for all diners
//        = "pre" for presignup only
//        = "walkin" for walkins only
function demographics( $id, $status="all" ) {

  $adults = 0;
  $children = 0;
  $free = 0;
  
  // users
  $names = user_get_users();
  foreach ( $names as $name ) {
    $username = $name['cal_login'];

    $dining_status = is_dining( $id, $username );
    if ( ($dining_status == "M") || ($dining_status == "T") ) {

      $walkin = is_walkin( $id, $username );
      $counts = 0;
      if ( ($walkin == true) && ( ($status == "all") || ($status == "walkin") ) ) $counts = 1;
      else if ( ($walkin == false) && ( ($status == "all") || ($status == "pre") ) ) $counts = 1;

      if ( $counts == 1 ) {
	$age = get_fee_category( $id, $username );
	if ( $age == "K" ) { 
	  $children++;
	}
	else if ( $age == "F" ) $free++;
	else {  // $age == "A"
	  $adults++;
	}
      }
    }

  }

  // guests
  $sql = "SELECT cal_fullname, cal_fee " .
    "FROM webcal_meal_guest " .
    "WHERE cal_meal_id = $id " . 
    "AND (cal_type = 'M' OR cal_type = 'T')";
  if ( $res = dbi_query( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {
      $guest_name = $row[0];

      $walkin = is_walkin_guest( $id, $guest_name );
      $counts = 0;
      if ( ($walkin == true) && ( ($status == "all") || ($status == "walkin") ) ) $counts = 1;
      else if ( ($walkin == false) && ( ($status == "all") || ($status == "pre") ) ) $counts = 1;

      if ( $counts == 1 ) {
	$age = $row[1];
	if ( $age == "K" ) {
	  $children++;
	}
	else if ( $age == "F" ) $free++;
	else { // $age == "A"
	  $adults++;
	}
      }
    }
    dbi_free_result( $res );
  }

  $ret = sprintf( "%d people: %d adults, %d older children, %d younger children", 
		  $adults + $children + $free, $adults, $children, $free );
  return $ret;
}



///////////
//
function get_adult_equivalent( $id ) {

  $equiv = 0;
  
  // users
  $names = user_get_users();
  foreach ( $names as $name ) {
    $username = $name['cal_login'];

    $dining_status = is_dining( $id, $username );
    if ( ($dining_status == "M") || ($dining_status == "T") ) {

      $age = get_fee_category( $id, $username );
      if ( $age == "K" ) { 
	$equiv += 0.5;
      }
      else if ( $age == "A" ) {
	$equiv++;
      }
    }

  }

  // guests
  $sql = "SELECT cal_fullname, cal_fee " .
    "FROM webcal_meal_guest " .
    "WHERE cal_meal_id = $id " . 
    "AND (cal_type = 'M' OR cal_type = 'T')";
  if ( $res = dbi_query( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {
      $guest_name = $row[0];

      $age = $row[1];
      if ( $age == "K" ) {
	$equiv += 0.5;
      }
      else if ( $age == "A" ) {
	$equiv++;
      }
    }
    dbi_free_result( $res );
  }

  return $equiv;
}



/********************************
 * signs people up or removes them from head chef duties
 *********************************/
function edit_head_chef_participation ( $id, $action, $user="" ) {
  global $login, $is_meal_coordinator;

  if ( ($user == "") )
    $user = $login;

  $can_edit = false;

  // admin, meal coordinator, and buddies can add others
  if ( $user == $login )
    $can_edit = true;
  else if ( $is_meal_coordinator )
    $can_edit = true;
  else if ( is_signer( $user ) == true ) 
    $can_edit = true;

  if ( $can_edit == false ) {
    echo "Not authorized";
    return;
  }

  // make sure input is reasonable
  if ( ($action != 'D') && ($action != 'A') )
    return false;

  $modified = false;
  
  if ( $action == 'A' ) {
    if ( !is_chef( $id, $user ) ) {
      $modified = true;
      $sql = "INSERT INTO webcal_meal_participant " . 
	"( cal_id, cal_login, cal_type ) " . 
	"VALUES ( $id, '$user', 'H' )";
      if ( ! dbi_query ( $sql ) ) 
	$error = "Database error: " . dbi_error ();
      add_subscribed_diners( $id );
    }
  }

  else if ( $action == 'D') { // delete
    if ( is_chef( $id, $user ) ) {
      $modified = true;
      $sql = "DELETE FROM webcal_meal_participant " .
	"WHERE cal_id = $id AND cal_login = '$user' AND cal_type = 'H'";
      if ( !dbi_query( $sql ) ) 
	$error = "Database error: " . dbi_error ();
    }
  }

  return $modified;
}


/********************************
 * signs people up or removes them from dining
 *********************************/
function edit_participation ( $id, $action, $type='M', $user="", $walkin=0 ) {
  global $login, $is_meal_coordinator;


  if ( ($user == "") )
    $user = $login;

  $can_edit = false;

  // admin, meal coordinator, chefs, and buddies can add others
  if ( $user == $login )
    $can_edit = true;
  else if ( $is_meal_coordinator )
    $can_edit = true;
  else if ( is_signer( $user ) == true ) 
    $can_edit = true;
  else if ( is_chef( $id, $login ) ) 
    $can_edit = true;

  if ( $can_edit == false ) {
    echo "Not authorized";
    return;
  }


  // make sure input is reasonable
  if ( ($action != 'D') && ($action != 'A') && 
       ($action != 'C') )
    return false;
  if ( ($type != 'M') && ($type != 'T') )
    return false;

  $modified = false;
  

  if ( $action == 'A' ) {
    if ( !is_dining( $id, $user ) && (is_cancelled( $id ) == false) ) {
      $modified = true;
      $sql = "INSERT INTO webcal_meal_participant " . 
	"( cal_id, cal_login, cal_type, cal_walkin ) " . 
	"VALUES ( $id, '$user', '$type', $walkin )";
      if ( ! dbi_query ( $sql ) ) 
	$error = "Database error: " . dbi_error ();
      else {
	auto_financial_event( $id, 'A', $type, $user );
	if ( is_blocked( $id, $user ) ) {
	  $sql2 = "DELETE FROM webcal_meal_participant " . 
	    "WHERE cal_login = '$user' AND cal_id = $id AND cal_type = 'B'";
	  dbi_query( $sql2 );
	}
      }
    }
  }

  else if ( $action == 'D') { // delete
    if ( is_dining( $id, $user ) ) {
      $modified = true;
      $sql = "DELETE FROM webcal_meal_participant " .
	"WHERE cal_id = $id AND cal_login = '$user' AND cal_type = '$type'";
      if ( !dbi_query( $sql ) ) 
	$error = "Database error: " . dbi_error ();
      else {
	auto_financial_event( $id, 'D', $type, $user );
      }
    }
  }

  else { // change between take-home and dine-in
    if ( is_dining( $id, $user ) ) {
      $modified = true;
      if ( $type == 'M' ) $new_type = 'T';
      else $new_type = 'M';
      $sql = "UPDATE webcal_meal_participant " .
	"SET cal_type = '$new_type' " .
	"WHERE cal_id = $id AND cal_login = '$user' " .
	"AND ( cal_type = 'M' OR cal_type = 'T' )";
      dbi_query( $sql );
    }
  }

  return $modified;
}


function edit_crew_participation( $id, $action, $user, $job, $olduser = "" ) {
  global $login, $is_meal_coordinator;

  if ( ($user == "") )
    $user = $login;

  $can_edit = false;

  // admin, meal coordinator, and buddies can add others
  if ( $user == $login )
    $can_edit = true;
  else if ( $is_meal_coordinator )
    $can_edit = true;
  else if ( is_signer( $user ) == true ) 
    $can_edit = true;

  if ( $can_edit == false ) {
    echo "Not authorized";
    return;
  }

  $modified = false;
  if ( $action == 'D' ) {
    /// find last "none" login placeholder in participant table
    $i=1;
    $found = false;
    while ( $found == false ) {
      $none = "none" . $i;
      $sql = "SELECT cal_login FROM webcal_meal_participant " .
	"WHERE cal_id = $id AND cal_login = '$none' AND cal_type = 'C'";
      if ( $res = dbi_query( $sql ) ) {
	if ( !dbi_fetch_row( $res ) )
	  $found = true;
	else $i++;
	dbi_free_result( $res );
      }
    }
    $none = "none" . $i;

    $sql = "UPDATE webcal_meal_participant " .
      "SET cal_login = '$none' " .
      "WHERE cal_id = $id AND cal_type = 'C' " .
      "AND cal_login = '$user'";
    if ( dbi_query( $sql ) ) $modified = true;
  } else if ( $action == 'A' ) {
    $sql = "UPDATE webcal_meal_participant " .
      "SET cal_login = '$user' " .
      "WHERE cal_id = $id AND cal_type = 'C'";
    if ( $job != "" ) 
      $sql .= " AND cal_notes = '$job'";
    if ( $olduser != "" ) 
      $sql .= " AND cal_login = '$olduser'";
    if ( dbi_query( $sql ) ) {
      $modified = true;
    }
  }

  return $modified;
}


/********************************************
 * adds the subscribed but unblocked diners. Called when head chef is added 
 ********************************************/
function add_subscribed_diners( $id ) {

  $all = user_get_users();
  for ( $i = 0; $i<count( $all ); $i++ ) {
    $cur_login = mysql_safe( $all[$i]['cal_login'], true );
    if ( is_subscriber( $id, $cur_login ) && !is_blocked( $id, $cur_login ) ) {
      edit_participation( $id, 'A', 'M', $cur_login, 0 );
    }
  }

}


function edit_club_subscription( $club_id, $user, $action ) {

  $club_id = mysql_safe( $club_id, false );
  $user = mysql_safe( $user, true );
  $action = mysql_safe( $action, true );

  if ( is_signer( $user ) ) {

    //// un/subscribe
    if ( $action == 'A' ) {
      $sql = "INSERT INTO webcal_subscriptions ( cal_login, cal_suit, cal_club_id ) " .
	"VALUES ( '$user', 'club', '$club_id' )"; 
      if ( ! dbi_query ( $sql ) ) {
	$error = "Database error: " . dbi_error ();
      }
    } else {
      $sql = "DELETE FROM webcal_subscriptions " .
	"WHERE cal_login = '$user' AND cal_suit = 'club' " . 
	"AND cal_club_id = '$club_id'";
      if ( ! dbi_query ( $sql ) ) {
	$error = "Database error: " . dbi_error ();
      }
    }
    
    
    
    /// add or remove diner from meals
    $sql = "SELECT cal_id FROM webcal_meal WHERE cal_club_id = '$club_id'";
    $res = dbi_query ( $sql );
    if ( $res ) {
      while ( $row = dbi_fetch_row ( $res ) ) {
	$cal_id = $row[0];
	if ( $action == 'A' ) {
	  $mod = edit_participation ( $cal_id, 'A', 'M', $user, 0 );
	}
	else {
	  $mod = edit_participation ( $cal_id, 'D', 'M', $user );
	  $mod = edit_participation ( $cal_id, 'D', 'T', $user );
	}
      }
      dbi_free_result( $res );
    }
  }    
}


/********************************************
 * buddy functions
 ***********************************************/

function get_signers() {
  global $login;

  $ret = array ();
  $count = 0;

  $sql = "SELECT cal_signer FROM webcal_buddy " .
    "WHERE cal_signee = '$login'";
  if ( $res = dbi_query ( $sql ) ) {
    while ( $row = dbi_fetch_row ( $res ) ) {
      $sql2 = "SELECT cal_lastname, cal_firstname " . 
	"FROM webcal_user WHERE cal_login = '$row[0]'";
      if ( $res2 = dbi_query ( $sql2 ) ) {
	$row2 = dbi_fetch_row ( $res2 );
	if ( $row2 ) {
	  $ret[$count++] = array ( "cal_login" => $row[0],
				   "cal_fullname" => "$row2[1] $row2[0]" );
	}
      }
      dbi_free_result ( $res2 );
    }
  }
  dbi_free_result ( $res );

  return $ret;
}



function get_nonsigners() {
  global $login;

  $ret = array ();
  $count = 0;

  $all = user_get_users();

  for ( $i = 0; $i < count( $all ); $i++ ) {
    $cur_login = mysql_safe( $all[$i]['cal_login'], true );
    $sql = "SELECT cal_signer " .
      "FROM webcal_buddy " .
      "WHERE cal_signer = '$cur_login' AND cal_signee = '$login'";
    if ( $res = dbi_query( $sql ) ) {
      if ( !dbi_fetch_row( $res ) && ($cur_login != $login) ) {
	$ret[$count++] = array ( "cal_login" => $cur_login,
				 "cal_fullname" => $all[$i]['cal_fullname'] );
      }
    }
    dbi_free_result ( $res );
  }

  return $ret;
}


function get_signees ( $login, $include_self="false" ) {
  global $is_meal_coordinator;

  $ret = array ();
  $count = 0;

  if ( $is_meal_coordinator ) {
    $sql = "SELECT cal_login FROM webcal_user";
  } else {
    $sql = "SELECT cal_signee FROM webcal_buddy " .
      "WHERE cal_signer = '$login'";
  }
  if ( $res = dbi_query ( $sql ) ) {
    while ( $row = dbi_fetch_row ( $res ) ) {
      user_load_variables( $row[0], "temp" );
      $ret[$count++] = array ( "cal_login" => $row[0],
       "cal_fullname" => $GLOBALS['tempfullname'] );
    }
  }
  dbi_free_result ( $res );

  if ( ($include_self == true) && (!$is_meal_coordinator) ) {
    user_load_variables( $login, "temp" );
    $ret[$count] = array ( "cal_login" => $login,
			   "cal_fullname" => $GLOBALS["tempfullname"] );
  }
  
  return $ret;
}


function is_signer( $signee ) {
  global $is_meal_coordinator, $login;

  $ret = false;

  if ( $signee == $login ) {
    $ret = true; 
  }

  if ( $is_meal_coordinator ) {
    $ret = true;
  }

  $signee = mysql_safe( $signee, true );
  $sql = "SELECT cal_signer FROM webcal_buddy " .
    "WHERE cal_signee = '$signee'";
  if ( $res = dbi_query( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {
      if ( $row[0] == $login ) {
	$ret = true; 
      }
    }
  }

  return $ret;
}


function display_workeat_log( $startdate, $enddate ) {
  global $login, $is_meal_coordinator, $is_beancounter;

    $can_view = false;
  if ( $is_meal_coordinator || $is_beancounter )
    $can_view = true;
  else if ( $billing_group == $cur_group ) 
    $can_view = true;


  if ( $can_view ) {


    /////////// collect work/eat events
    $sql = "SELECT cal_type, cal_id " .
      "FROM webcal_meal_participant " .
      "WHERE cal_login = '$login'";
    
    $work = 0;
    $eat = 0;
    $count = 0;
    $balance_work = 0;
    $balance_eat = 0;
    if ( $res = dbi_query( $sql ) ) {
      while ( $row = dbi_fetch_row( $res ) ) {
	$type = $row[0];
	$id = $row[1];
	$sql2 = "SELECT cal_date " .
	  "FROM webcal_meal " .
	  "WHERE cal_id = $id";
	if ( $res2 = dbi_query( $sql2 ) ) {	
	  if ( $row2 = dbi_fetch_row( $res2 ) ) {
	    if ( $row2[0] < $startdate ) {
	      if ( ($type == 'M') || ($type == 'T') ) $balance_eat++;
	      else if ( ($type == 'H') || ($type == 'C') ) $balance_work++;
	    }
	  }
	  dbi_free_result( $res2 );
	}
	$count++;
	if ( ($type == 'M') || ($type == 'T') ) $eat++;
	else if ( ($type == 'H') || ($type == 'C') ) $work++;
      }
      dbi_free_result( $res );
    }



    /////////// display log for desired time period
    echo "<h3>Work/eat log</h3>";
    echo "<p><table>";
    echo "<tr class=\"d0\">";
    echo "<td> Date </td>" .
      "<td> Role </td>" .
      "<td> Meal </td>" .
      "<td> Balance (work/eat)</td></tr>";
    $row_num = 1;


    $sql = "SELECT cal_id, cal_date, cal_suit " .
      "FROM webcal_meal " .
      "WHERE cal_date <= $enddate " .
      "AND cal_date >= $startdate";
    if ( $res = dbi_query( $sql ) ) {
      while ( $row = dbi_fetch_row( $res ) ) {

	$meal_id = $row[0];
	$date = $row[1];
	$suit = $row[2];
	$sql2 = "SELECT cal_type " .
	  "FROM webcal_meal_participant " .
	  "WHERE cal_login = '$login' " .
	  "AND cal_id = $meal_id";
	if ( $res2 = dbi_query( $sql2 ) ) {
	  while ( $row2 = dbi_fetch_row( $res2 ) ) {
	    $type = $row2[0];

	    echo "<tr class= \"d$row_num\">";
	    $row_num = ( $row_num == 1 ) ? 0:1;
	    // Date
	    echo "<td>" . date_to_str( $date, "", false, true, "" ) . "</td>";
	    // Role
	    if ( ($type == 'M') || ($type == 'T') ) $print = "Eat";
	    else if ( ($type == 'H') || ($type == 'C') ) $print = "Work";
	    echo "<td>$print</td>";
	    // Meal
	    echo "<td><a href=\"view_entry.php?id=" . $meal_id .
	      "\">" . $suit . " meal</a></td>";
	    // work/eat Balance
	    if ( ($type == 'M') || ($type == 'T') ) $balance_eat++;
	    else if ( ($type == 'H') || ($type == 'C') ) $balance_work++;
	    
	    if ( ($balance_eat == 0) || ($balance_work == 0) ) 
	      echo "<td> $balance_work : $balance_eat </td>";
	    else
	      echo "<td>" . $balance_work/$balance_eat . "</td>";
	    echo "</tr>";
	  }
	  dbi_free_result( $res2 );
	}
      }
      dbi_free_result( $res );
    }
    
    echo "</table>";


    //// display summary
    echo "<p><h3>Total summary</h3> (all dates, not just those above):</p><p>";
    echo "Meals worked = $work<br/>" .
      "Meals eaten = $eat<br/>";
    if ( ($eat == 0) || ($work == 0) ) 
      echo "Ratio work/eat = $work : $eat <br/>";
    else 
      echo "Ratio work/eat = " . $work/$eat . "<br/>";
    echo "</p>";




  }
}


function is_chef( $id, $user='' ) {
  global $login;

  if ( $user == "" ) $user = $login;
  
  $ret = false;

  $sql = "SELECT cal_login " .
    "FROM webcal_meal_participant " . 
    "WHERE cal_id = $id " .
    "AND cal_login = '$user' " .
    "AND (cal_type = 'H' OR cal_type = 'C')";
  if ( $res = dbi_query( $sql ) ) {
    if ( dbi_fetch_row( $res ) ) {
      $ret = true;
    }
    dbi_free_result( $res );
  }
  
  return $ret;
}



function is_dining( $id, $username ) {
  
  $ret = '';

  $sql = "SELECT cal_type " .
    "FROM webcal_meal_participant " . 
    "WHERE cal_id = $id " .
    "AND cal_login = '$username' " .
    "AND (cal_type = 'M' OR cal_type = 'T')";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      $ret = $row[0];
    }
    dbi_free_result( $res );
  }
  
  return $ret;
}


// user blocked self from being automatically subscribed to a single meal
function is_blocked( $id, $username ) {
  
  $ret = false;

  $sql = "SELECT cal_type " .
    "FROM webcal_meal_participant " . 
    "WHERE cal_id = $id " .
    "AND cal_login = '$username' " .
    "AND cal_type = 'B'";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      $ret = true;
    }
    dbi_free_result( $res );
  }
  
  return $ret;
}


function is_walkin( $id, $username ) {
  $ret = false;

  $sql = "SELECT cal_walkin " . 
    "FROM webcal_meal_participant " .
    "WHERE cal_id = $id " .
    "AND cal_login = '$username'";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      if ( $row[0] == 1 ) 
	$ret = true;
    }
    dbi_free_result( $res );
  }

  return $ret;
}


function is_walkin_guest( $id, $guest_fullname ) {
  $ret = false;

  $guest_fullname = mysql_safe( $guest_fullname );
  $sql = "SELECT cal_walkin " . 
    "FROM webcal_meal_guest " .
    "WHERE cal_meal_id = $id " .
    "AND cal_fullname = '$guest_fullname'";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      if ( $row[0] == 1 ) 
	$ret = true;
    }
    dbi_free_result( $res );
  }

  return $ret;
}


function is_subscriber( $id, $user ) {

  $subscriber = false;
  $sql = "SELECT cal_suit FROM webcal_meal WHERE cal_id=$id";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      $suit = $row[0];
      if ( ($suit == 'heart') || ($suit == 'diamond') ) {
	$sql2 = "SELECT cal_date FROM webcal_meal WHERE cal_id=$id";
	if ( $res2 = dbi_query( $sql2 ) ) {
	  if ( $row2 = dbi_fetch_row( $res2 ) ) {
	    $event_date = $row2[0];
	    $weekday = date( "w", date_to_epoch( $event_date ) );

	    $sql3 = "SELECT cal_login " .
	      "FROM webcal_subscriptions " .
	      "WHERE cal_login = '$user' " . 
	      "AND cal_suit = '$suit' " .
	      "AND cal_day = $weekday " . 
	      "AND cal_start <= $event_date " .
	      "AND (cal_end > $event_date OR cal_ongoing = 1)";
	    if ( $res3 = dbi_query( $sql3 ) ) {
	      if ( dbi_fetch_row( $res3 ) ) {
		$subscriber = true;
	      }
	      dbi_free_result( $res3 );
	    }
	  }
	  dbi_free_result( $res2 );
	}
      }
    }
    dbi_free_result( $res );
  }

  return $subscriber;
}



function get_day( $ref_date, $num_days ) {
  $sy = substr ( $ref_date, 0, 4 );
  $sm = substr ( $ref_date, 4, 2 );
  $sd = substr ( $ref_date, 6, 2 );
  $newdate = date( "Ymd", mktime( 3,0,0, $sm, $sd+$num_days, $sy ) );

  return $newdate;
}


function change_standard_meal_form( $referring_page, $temp_change, 
				    $change_which_day='', $change_which_week='' ) {

  $crew = array();
  if ( $change_which_week != '' ) {
    $sql = "SELECT cal_time, cal_suit, cal_base_price, cal_menu, cal_head_chef, cal_regular_crew " .
      "FROM webcal_standard_meals " . 
      "WHERE cal_day_of_week = $change_which_day AND cal_which_week = $change_which_week " .
      "AND cal_temp_change = 0";
    $res = dbi_query( $sql );
    if ( $res ) {
      if ( $row = dbi_fetch_row( $res ) ) {
	$time = $row[0];
	time_to_hour_minute( $time, $hour, $minute );
	if ( $hour > 12 ) {
	  $ampm = 'pm';
	  $hour -= 12;
	} else {
	  $ampm = 'am';
	}
	$suit = $row[1];
	$base_price = $row[2];
	price_to_dollars_cents( $base_price, $base_dollars, $base_cents );
	$menu = $row[3];
	$head_chef = $row[4];
	$jobs_and_crew = explode( "&", $row[5] );
	$j=0;
	for ( $i=0; $i<count($jobs_and_crew); $i++ ) {
	  $job[$j] = $jobs_and_crew[$i++];
	  $crew[$j] = $jobs_and_crew[$i];
	  $j++;
	}
      }
    }

  } else {
    $hour = '';
    $minute = '';
    $ampm = 'pm';
    $suit = '';
    $base_dollars = '';
    $base_cents = '';
    $menu = '';
    $head_chef = 'none';
    for ( $i=0; $i<7; $i++ ) {
      $job[$i] = '';
      $crew[$i] = 'none';
    }
  }

?>


<form action="<?php echo $referring_page;?>" method="get" name="choosingChange">

<input type="hidden" name="month" value="<?php echo $temp_change;?>" />

<table><tr>
<td>&nbsp;&nbsp;&nbsp;</td><td>Day of the week: </td><td> <select name="dayofweek">
    <option value="0" <?php if ($change_which_day == 0) echo "selected=\"selected\"";?>>Sunday</option>
    <option value="1" <?php if ($change_which_day == 1) echo "selected=\"selected\"";?>>Monday</option>
    <option value="2" <?php if ($change_which_day == 2) echo "selected=\"selected\"";?>>Tuesday</option>
    <option value="3" <?php if ($change_which_day == 3) echo "selected=\"selected\"";?>>Wednesday</option>
    <option value="4" <?php if ($change_which_day == 4) echo "selected=\"selected\"";?>>Thursday</option>
    <option value="5" <?php if ($change_which_day == 5) echo "selected=\"selected\"";?>>Friday</option>
    <option value="6" <?php if ($change_which_day == 6) echo "selected=\"selected\"";?>>Saturday</option>
</select></td></tr>
<tr><td></td><td>Which week: </td><td><select name="whichweek">
    <option value="1" <?php if ($change_which_week == 1) echo "selected=\"selected\"";?>>First</option>
    <option value="2" <?php if ($change_which_week == 2) echo "selected=\"selected\"";?>>Second</option>
    <option value="3" <?php if ($change_which_week == 3) echo "selected=\"selected\"";?>>Third</option>
    <option value="4" <?php if ($change_which_week == 4) echo "selected=\"selected\"";?>>Fourth</option>
    <option value="5" <?php if ($change_which_week == 5) echo "selected=\"selected\"";?>>Fifth</option>
</select>
&nbsp;
<input type="submit" value="Fill in values below to edit" />
</td></tr>
</table>
</form>

<form action="change_standard_meals_handler.php" method="post" name="changingStandardMeal">

<input type="hidden" name="temp_change" value="<?php echo $temp_change;?>" />
<input type="hidden" name="dayofweek" value="<?php echo $change_which_day;?>" />
<input type="hidden" name="whichweek" value="<?php echo $change_which_week;?>" />

<table>
<tr><td></td><td>Suit: </td>
   <td><select name="suit">
   <option value="heart" <?php if ($suit == "heart") echo "selected=\"selected\"";?>>Heart</option>
   <option value="diamond" <?php if ($suit == "diamond") echo "selected=\"selected\"";?>>Diamond</option>
   <option value="wild" <?php if ($suit == "wild") echo "selected=\"selected\"";?>>Wild</option>
</select></td></tr>
<tr><td></td><td>Time: </td>
    <td><input type="text" name="hour" size="2" maxlength="2" <?php if ($hour != '') echo "value=\"$hour\"";?> />:<input type="text" name="minute" size="2" maxlength="2" <?php if ($minute != '') echo "value=\"$minute\"";?> />
     <label><input type="radio" name="ampm" value="am" <?php if ($ampm == "am") echo "checked=\"checked\"";?>/>am</label>
     <label><input type="radio" name="ampm" value="pm" <?php if ($ampm != "am") echo "checked=\"checked\"";?>/>pm</label>
</td></tr>
<tr><td></td><td>Base (adult) price: </td>
  <td>$<input type="text" name="base_dollars" size="2" maxlength="2" <?php if ($base_dollars != '') echo "value=\"$base_dollars\"";?>/>.<input type="text" name="base_cents" size="2" maxlength="2" <?php if ($base_cents != '') echo "value=\"$base_cents\"";?>/></td></tr>
<tr><td></td><td>Head chef: </td>
  <td><select name="head_chef">
      <option value="none" <?php if ($head_chef == "none") echo "selected=\"selected\"";?>>Select head chef</option>
      <?php $names = user_get_users();
        foreach ( $names as $name ) {
	  $username = $name['cal_login'];
	  $fullname = $name['cal_fullname'];
	  echo "<option value=\"$username\"";
	  if ($head_chef == "$username") echo "selected=\"selected\"";
	  echo ">$fullname</option>\n";
	} ?>
</select></td></tr>
<tr><td></td><td>Regular/requested crew: </td>
  <td><table class="bordered_table">
    <tr><td>Crew job description</td><td>Person</td></tr>
    <?php
      for ( $i=0; $i<7; $i++ ) {
	echo "<tr><td><input type=\"text\" name=\"job$i\" size=\"45\" ";
	if ( $job[$i] != '' ) echo "value=\"" . $job[$i] . "\" ";
	echo "maxlength=\"80\"/></td>";
	echo "<td><select name=\"crew$i\">";
	echo "<option value=\"none\" ";
	if ( ($crew[$i] == '') || ($crew[$i] == 'none') ) echo "selected=\"selected\"";
	echo ">Select crew member</option>";
	foreach ( $names as $name ) {
	  $username = $name['cal_login'];
	  $fullname = $name['cal_fullname'];
	  echo "<option value=\"$username\"";
	  if ( $crew[$i] == "$username" ) echo "selected=\"selected\"";
	  echo ">$fullname</option>\n";
	} 
	echo "</select></td></tr>\n";
      }?>
    </table>
</td></tr>
<tr><td></td><td>Regular menu: </td>
    <td><textarea name="menu" rows="5" cols="40" <?php if ($menu != '') echo "value=\"$menu\"";?>></textarea></td>
</tr>

</table>

<input type="submit" value="Save meal" />
</form>

<?php
}


?>
