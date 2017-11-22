<?php

include(INC_DIR . "top_popup.inc");

echo "<p class=\"body_text\">You are now logged off.</p>\n";
echo "<p class=\"body_action\">";
echo "<a href=\"" . UAM_URL . "/prelogin\">Login</a>";
echo "</p>\n";

include(INC_DIR . "tail.inc");
?>
