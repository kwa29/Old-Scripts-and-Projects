<?php

/*
 * We definitely shouldn't redirect to ourselves...otherwise, it
 * loops endlessly and you generate zillions of popups.
 *
 * So,in that case, we set $userurl to null.
 */
if ( ( ! empty($_GET["userurl"]) ) && 
     ( ! ereg(UAMIP, $_GET["userurl"]) ) ) {
  $userurl = $_GET["userurl"];
}
else {
  $userurl = false;
}

/*
 * For our javascript, we need 2 extra vars: the popup url, and the
 * userurl we cooked above.
 */
$js_args .= ",'" . LOGINPATH . "?res=popup2&uamip=" . $_GET["uamip"];
$js_args .= "&uamport=" . $_GET["uamport"];
$js_args .= "&timeleft=" . $_GET["timeleft"] . "',";
$js_args .= "'" . $userurl . "'";


include(INC_DIR . "top.inc");

echo "<p class=\"body_text\">Welcome</p>\n";

echo "<p class=\"body_action\">";
echo "<a href=\"" . UAM_URL . "/logoff\">Logout</a></p>\n";

echo "<div id=\"d\"></div>\n";

include(INC_DIR . "tail.inc");

?>
