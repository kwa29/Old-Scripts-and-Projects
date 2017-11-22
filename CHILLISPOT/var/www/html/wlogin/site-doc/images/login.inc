<?php

$hex_chal  = pack("H32", $_GET["chal"]);

if ( defined("UAMSECRET") ) {
  $newchal  = pack ("H*", md5($hex_chal . UAMSECRET));
}
else {
  $newchal  = $hex_chal;
}

$response = md5("\0" . $_GET["pwd"] . $newchal);
$newpwd = pack("a32", $_GET["pwd"]);
$password = implode ("", unpack("H32", ($newpwd ^ $newchal)));

if ( ( defined("UAMSECRET") ) && ( defined("USERPASSWORD") ) ) {
  $query = "?username=" . $_GET["uid"] . "&password=" . $password;
}
else {
  $query = "?username=" . $_GET["uid"] . "&password=" . $password;
}

header("Location: " . UAM_URL . "/logon" . $query);

include(INC_DIR . "top.inc");

echo "<p class=\"body_text\">Logging in...</p>\n";

include(INC_DIR . "tail.inc");

?>
