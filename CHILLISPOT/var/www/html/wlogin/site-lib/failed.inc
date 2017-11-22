<?php

include(INC_DIR . "top.inc");

echo "<p class=\"body_text\">Sorry, login failed.  Please try again.</p>\n";
$expiredMSG = 'There is no more time left on that account';
if(($_GET['reply']) == 'Your maximum never usage time has been reached') {
	echo "<p class=\"body_text\">";
	echo ($expiredMSG);
	echo "</p>\n"; 
	}

include(INC_DIR . "login_form.inc");

include(INC_DIR . "tail.inc");

?>
