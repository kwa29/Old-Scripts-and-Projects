<?php

/*
 * This is the name of your hotspot.  It is what will be displayed in
 * the browser title and messages such as "Logged in to _My HotSpot_".
 */
define("HOTSPOT_NAME", "OceaniaHotels HotSpot");

/*
 * Set the UAM IP and UAM Port to point to the chillispot server.
 */

define("UAMIP", "192.168.182.1");
define("UAMPORT", "3990");
define("MAILFREE", "dlambert@hotel-sofibra.com");
define("MAILPAYANT", "dlambert@hotel-sofibra.com");

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
 * Set to true to enable login cookie to store username and password.
 */
define("ENABLE_LOGIN_COOKIE", true);

/*
 * Set this to "true" to enable debugging output.
 */
define("DEBUG_MODE", false);

/*
 * Shared secret used to encrypt challenge with. Prevents dictionary
 * attacks.  You should change this to your own shared secret.
 *
 * NOTE: This should match chilli.conf's 'uamsecret'.
 */
define("UAMSECRET", "motdepasseapache");

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
$nomhote="192.168.100.106";      // nom de l'hôte
$identifiant="root";       // votre nom d'utilisateur
$motdepasse="1GB2bg3Mb";  // votre mot de passe 

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

?>
