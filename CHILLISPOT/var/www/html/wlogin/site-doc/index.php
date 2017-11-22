<?php

/*
 * This is wlogin, a php front end to chillispot.
 *
 * last change 2004-11-15
 * 
 * Re-implementation of hotspotlogin03.php by Cedric which was forked
 * from original chillispot.org's hotspotlogin.cgi by Kanne
 */

define("INC_DIR", "../site-lib/");

require_once(INC_DIR . "config.inc");

/*
 * possible Cases:
 *
 *  attempt to login                          login=Login
 *  1: Login successful                       res=success
 *  2: Login failed                           res=failed
 *  3: Logged out                             res=logoff
 *  4: Tried to login while already logged in res=already
 *  5: Not logged in yet                      res=notyet
 * 11: Popup                                  res=popup1
 * 12: Popup                                  res=popup2
 * 13: Popup                                  res=popup3
 *  0: It was not a form request              res=""
 *
 * Read query parameters which we care about
 *
 * $_GET['res'];
 * $_GET['challenge'];
 * $_GET['uamip'];
 * $_GET['uamport'];
 * $_GET['reply'];
 * $_GET['userurl'];
 * $_GET['timeleft'];
 * $_GET['redirurl'];
 *
 * Read form parameters which we care about
 *
 * $_GET['username'];
 * $_GET['password'];
 * $_GET['chal'];
 * $_GET['login'];
 * $_GET['logout'];
 * $_GET['prelogin'];
 * $_GET['res'];
 * $_GET['uamip'];
 * $_GET['uamport'];
 * $_GET['userurl'];
 * $_GET['timeleft'];
 * $_GET['redirurl'];
 * $_GET['store_cookie'];
 */

# Redirection de la page success
$_GET['redirurl'] = 'http://www.hotel-sofibra.com';

if ($box == "payant")
{
$_GET['timeleft'] = 86400 - $temps_util;
}
else
	{
	$_GET['timeleft'] = 900 - $temps_util;
	}

if ( $_GET["login"] == "Login" ) {
  $context = "login";
}
else {
  $context = $_GET["res"];
}

/*
 * We need to put some standard arguments in a string for the onLoad
 * javascript function that we run on every page load.  These are:
 * context, timeleft, and next_url.
 *
 * Other arguments may be appended to these in the context specific
 * include file before the top.inc header is spit out.  In that case,
 * we'll need to remember to attach a comma before the extra args.
 */
$js_args  = "'" . $context . "','" . $_GET["timeleft"] . "',";
$js_args .= "'" . LOGINPATH . "?res=popup3&uamip=" . $_GET["uamip"];
#$js_args .= "&box=" . $_GET["box"];
$js_args .= "&uamport=" . $_GET["uamport"] . "'";


/*
 * If we want to store the cookie, compose and set it...
 */
if ( $_GET["save_login"] == "on" ) {
  $str = $_GET["uid"] . "|" . $_GET["pwd"];

  // expires in 10 years...
  $expire = time() + 315360000;

  setcookie("login", $str, $expire, "/", $_SERVER["HTTP_HOST"], true);
}

if ( isset($_COOKIE["login"]) ) {
  $arr = explode("|", $_COOKIE["login"]);

  $username = $arr[0];
  $password = $arr[1];
}
else {
  $username = "";
  $password = "";
}

if ( is_file(INC_DIR . $context . ".inc") ) {
  include(INC_DIR . $context . ".inc");
}
else {
  include(INC_DIR . "error.inc");
}


?>
