<?php

include(INC_DIR . "top_popup.inc");

echo "<p class=\"body_text\">Logged out from " . HOTSPOT_NAME . "</p>\n";

echo "<p class=\"body_action\">";
echo "<a href=\"" . UAM_URL . "/prelogin\">Login</a></p>\n";

include(INC_DIR . "tail.inc");

?>
