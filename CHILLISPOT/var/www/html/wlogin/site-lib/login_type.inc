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
// Connection à la base MySQL
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );
$nomdelabdd="freeradius";
@mysql_select_db($nomdelabdd, $bdd);
// Transformation de lip
$pieces = explode(".", $SERVER_ADDR);
$adresse_serveur = $pieces[0].'.'.$pieces[1].'.'.$pieces[2];

$req_forfait = @mysql_db_query($nomdelabdd,"SELECT f.*
                                        FROM forfait f,hotel h
                                        WHERE f.idhotel=h.idhotel
					AND h.adresse_int=\"$adresse_serveur\"");
mysql_close();

echo "<td class=\"form_label\" colspan=\"2\">";
echo "<select name=\"box\">";
while ($val = mysql_fetch_array($req_forfait)) {
echo "<option value=$val[idforfait]>$val[libelle]</option>";
}

echo "</select></td>\n";
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
