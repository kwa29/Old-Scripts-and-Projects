<?php

echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n";
echo "<html>\n";

echo "<head>\n";
echo "<title>" . HOTSPOT_NAME . " Login</title>\n";
echo "<meta http-equiv=\"Cache-control\" content=\"no-cache\">\n";
echo "<meta http-equiv=\"Pragma\" content=\"no-cache\">\n";
echo "<link href=\"" . BASE_URL . "style/styles.css\" rel=\"stylesheet\" ";
echo "type=\"text/css\">\n";
echo "<script language=\"javascript\" type=\"text/javascript\" ";
echo "src=\"" . BASE_URL . "scripts/javascript.js\"></script>\n";
echo "</head>\n\n";

echo "<body onLoad=\"handler(" . $js_args . ")\" ";
echo "onBlur = \"javascript:doOnBlur('" . $context . "')\">\n";

if(!isset($noIMG)) {
	echo "<p class=\"body_img\">";
	echo "<img src=\"" . BASE_URL . "images/wireless_logo.png\"></p>\n";
	}

?>
