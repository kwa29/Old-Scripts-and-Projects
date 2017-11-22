<?php

if ( DEBUG_MODE === false ) {
  echo "</center>\n";
  echo "_GET:";
  mypr($_GET);
  echo "_POST:";
  mypr($_POST);
  echo "<center>\n";
}

echo "</body>\n";
echo "</html>\n";


?>