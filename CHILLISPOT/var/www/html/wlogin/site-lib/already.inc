<?php

include(INC_DIR . "top.inc");

echo "<p class=\"body_text\">Already logged in to " . HOTSPOT_NAME . "</p>\n";

echo "<p class=\"body_action\">";
echo "<a href=\"" . UAM_URL . "/logoff\">Logout</a></p>\n";

include(INC_DIR . "tail.inc");

?>