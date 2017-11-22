<?php

/*
 * This is the name of your hotspot.  It is what will be displayed in
 * the browser title and messages such as "Logged in to _My HotSpot_".
 */
define("HOTSPOT_NAME", "HotSpot Oc&eacute;aniaHotels");

/*
 * Set the UAM IP and UAM Port to point to the chillispot server.
 */
# define("UAMIP", "192.168.154.1"); # hotel MAA
# define("UAMIP", "192.168.155.1"); # hotel HOC
# define("UAMIP", "192.168.156.1"); # hotel AMB
define("UAMIP", "192.168.157.1"); # hotel OCB
# define("UAMIP", "192.168.158.1"); # hotel OBA
# define("UAMIP", "192.168.159.1"); # hotel JUD
# define("UAMIP", "192.168.160.1"); # hotel MLM
# define("UAMIP", "192.168.161.1"); # hotel MAM
# define("UAMIP", "192.168.162.1"); # hotel MAN
# define("UAMIP", "192.168.163.1"); # hotel OCN
# define("UAMIP", "192.168.164.1"); # hotel MAO
# define("UAMIP", "192.168.165.1"); # hotel MAQ
# define("UAMIP", "192.168.166.1"); # hotel OCQ
# define("UAMIP", "192.168.167.1"); # hotel OCR
# define("UAMIP", "192.168.168.1"); # hotel MAS
# define("UAMIP", "192.168.169.1"); # hotel MAV
# define("UAMIP", "192.168.170.1"); # hotel OCS
# define("UAMIP", "192.168.171.1"); # hotel ???
# define("UAMIP", "192.168.172.1"); # hotel ???
# define("UAMIP", "192.168.173.1"); # hotel ???

define("UAMPORT", "3990");

/*
 * Set the email for hotel.
 */

define("MAILFREE", "send@smsextrapro.com"); # fai produline mr sylvain boniver 003242241707
define("MAILPAYANT", "oceania.brest@oceaniahotels.com"); # reception OCB
#define("MAILPAYANT", "oceania.brest@oceaniahotels.com"); # reception OCB nouvelle @
#define("MAILPAYANT", "mascotte.aix@oceaniahotels.com"); # reception MAA nouvelle @
#define("MAILPAYANT", "continental.brest@oceaniahotels.com"); # reception HOC nouvelle @
#define("MAILPAYANT", "amirautebrest@oceaniahotels.com"); # reception AMB nouvelle @
#define("MAILPAYANT", "tulipinnjura.dijon@oceaniahotels.com"); # reception JUD nouvelle @
#define("MAILPAYANT", "mascotte.lemans@oceaniahotels.com"); # reception MLM nouvelle @
#define("MAILPAYANT", "mascotte.marseille@oceaniahotels.com"); # reception MAM nouvelle @
#define("MAILPAYANT", "mascotte.nantes@oceaniahotels.com"); # reception MAN nouvelle @
#define("MAILPAYANT", "oceania-.nantes@oceaniahotels.com"); # reception OCN nouvelle @
#define("MAILPAYANT", "mascotte.orleans@oceaniahotels.com"); # reception MAO nouvelle @
#define("MAILPAYANT", "mascotte.quimper@oceaniahotels.com"); # reception MAQ nouvelle @
#define("MAILPAYANT", "oceania.quimper@oceaniahotels.com"); # reception OCQ nouvelle @
#define("MAILPAYANT", "oceania.rennes@oceaniahotels.com"); # reception OCR nouvelle @
#define("MAILPAYANT", "mascotte.saintmalo@oceaniahotels.com"); # reception MAS nouvelle @
#define("MAILPAYANT", "oceania.saintmalo@oceaniahotels.com"); # reception OCS nouvelle @
#define("MAILPAYANT", "mascotte.vannes@oceaniahotels.com"); # reception MAV nouvelle @
#define("MAILPAYANT", "oceania.paris@oceaniahotels.com"); # reception Paris


/*
 * Leave this the way it is.  It's just for convenience.
 */
define("UAM_URL", "http://" . UAMIP . ":" . UAMPORT);

/*
 * Set this to the base url of your login website.
 *
 * for example: "https://wireless_login.mysite.com/"
 */
define("BASE_URL", "https://wifi.oceaniahotels.com/");

/*
 * Set this to the url where you find the login script (index.php).
 *
 * for example: 'BASE_URL' or 'BASE_URL . "hotspotlogin/"'
 */
define("LOGINPATH", BASE_URL);

/*
 * Set this to "true" to enable debugging output.
 */
define("DEBUG_MODE", "true");

/*
 * Shared secret used to encrypt challenge with. Prevents dictionary
 * attacks.  You should change this to your own shared secret.
 *
 * NOTE: This should match chilli.conf's 'uamsecret'.
 */
define("UAMSECRET", "motdepasseapache"); // You should change this CP

/*
 * Best to leave the following line alone if you want to use ordinary
 * user-password for radius authentication. Must be used together with
 * UAMSECRET (above).
 */
define("USERPASSWORD", true);

/*
 * For now, there's no better place to put a couple common utility
 * functions (since there's only one).
 */
function mypr($d) {
  echo "<pre>\n";
  print_r($d);
  echo "</pre>\n";
}

// Connection a la base de donnée Mysql
$nomhote="81.80.172.225";      // sofibraweb base sql
$identifiant="root";       // votre nom d'utilisateur
$motdepasse="1GB2bg3Mb";  // votre mot de passe

// Generation du mot de passe aleatoire
function genPass()
{
  $consonnes='bcdfgjklmnpqrstvxz';
  $voyelles='aeiouy';
  for ($i=0; $i < 7; $i++)
    {
    mt_srand((double) microtime() * 1000000);
    $consonne[$i] =
      substr($consonnes, mt_rand(0, strlen($consonnes)-1), 1);
    $voyelle[$i] =
      substr($voyelles, mt_rand(0, strlen($voyelles)-1), 1);
    }
  return $consonne[0] . $voyelle[4] .$consonne[3]
    . $consonne[1] . $voyelle[0] . $consonne[2];
}

// Conversion de secondes en h m s
function calcul_hours($temps)
{
  //combien d'heures ?
  $hours = floor($temps / 3600);

  //combien de minutes ?
  $min = floor(($temps - ($hours * 3600)) / 60);
  if ($min < 10)
    $min = "0".$min;

  //combien de secondes
  $sec = $temps - ($hours * 3600) - ($min * 60);
  if ($sec < 10)
    $sec = "0".$sec;

  return $hours."h ".$min."m ".$sec."s";
}

?>
