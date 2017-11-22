<?php

/*
 * For our javascript, we need 1 extra arg: redirurl.
 */
$js_args .= ",'" . $_GET["redirurl"] . "'";

include(INC_DIR . "top_popup.inc");

echo "<p class=\"body_text\">Logged in to " . HOTSPOT_NAME . "</p>\n";

echo "<p class=\"body_action\">";
echo "<a href=\"" . UAM_URL . "/logoff\">Logout</a></p>\n";

echo "<div id=\"d\"></div>\n";

include(INC_DIR . "tail.inc");
# Destruction de la session
session_destroy();
?>
