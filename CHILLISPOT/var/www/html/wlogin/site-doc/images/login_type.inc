<?php

echo "<form name=\"form_1\" method=\"GET\" action=\"" . LOGINPATH . "\">\n";
echo "<input type=\"hidden\" name=\"res\" value=\"notyet\" ";
echo "<input type=\"hidden\" name=\"challenge\" ";
echo "value=\"" . $_GET["challenge"] . "\">\n";
echo "<input type=\"hidden\" name=\"uamip\" value=" . $_GET["uamip"] . ">\n";
echo "<input type=\"hidden\" name=\"uamport\" ";
echo "value=" . $_GET["uamport"] . ">\n";
echo "<input type=\"hidden\" name=\"mac\" value=\"$mac\" ";
echo "<center>\n";

echo "\n<table align=center class=\"form_table\">\n\n";

echo "<tbody>\n";

echo "<tr>\n";
echo "<td class=\"form_text\" colspan=\"2\">
Bienvenue...<br />
Vous entrez dans l'espace Internet s&eacute;curis&eacute; du groupe Sofibra.<br />
Pour acc&eacute;der au r&eacute;seau vous devez choisir le type de connexion.<br /><br/>
</br>
Welcome....<br/>
You enter the protected space Internet the Sofibra group.<br/>
To reach the network you must choice the type of connexion.<br/>
</br>
Merci de choisir <br />
Thank you to choice</td>\n";

echo "</tr>\n";

echo "<tr>\n";
echo "<td class=\"form_label\" colspan=\"2\">
<select name=\"box\">
<option value=\"payant\">Forfait de 24 heures à 3 Euros  -°°°°-  24 hours fixed price to 3 Euros </option>
<option value=\"free\">Gratuit pendant 15 minutes  -°°°°-  Free during 15 minutes </option>
</select></td>\n";
echo "</tr>\n";

echo "<tr>\n";
echo "<td class=\"form_submit\" colspan=\"2\">";
echo "<input class=\"form_submit\" type=\"submit\" ";
echo "name=\"ok\" value=\"Ok\"></td>\n";
echo "</tr>\n";

echo "</tbody>\n";

echo "\n</table>\n\n";

echo "</center>\n";
echo "</form>\n";

?>
