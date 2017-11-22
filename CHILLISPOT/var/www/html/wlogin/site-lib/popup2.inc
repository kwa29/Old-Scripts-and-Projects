<?php

/*
 * For our javascript, we need 1 extra arg: redirurl.
 */
$js_args .= ",'" . $_GET["redirurl"] . "'";

$noIMG = 1;  // sets the variable so that we can get rid of the image in top.inc
include(INC_DIR . "top.inc");

echo "<p class=\"body_text\">Logged in to " . HOTSPOT_NAME . "</p>\n";
echo "<p class=\"body_text\">To log out, close this window</p>\n";
echo "<p class=\"body_text\">or click the button below.</p>\n";

echo "<p class=\"body_action\">";

// echo "<td width=100>";
//        echo("<form action=\"" . UAM_URL . "/logoff\" method=\"post\">");
//        printf('<input type="submit" name="sortname" class="topButton" value="Logout">');
//    echo "</td></form>";

echo "<a href=\"" . UAM_URL . "/logoff\"><img src=\"" . BASE_URL . "images/logout.gif\"></a></p>\n";
echo '<script language="Javascript">
<!--



function onul() {
	window.open(';
		echo "\"" . UAM_URL . "/logoff\"";
	echo ');
	}

//-->
</script>
<body onunload="onul()">';
echo "<div id=\"d\"></div>\n";
include(INC_DIR . "tail.inc");
?>
