<?php
echo "<form name=\"form_1\" method=\"GET\" onSubmit=\"return controleclient();\" action=\"" . LOGINPATH . "\">\n";
echo "<input type=\"hidden\" name=\"res\" value=\"notyet\" ";
echo "<input type=\"hidden\" name=\"challenge\" ";
echo "value=\"" . $_GET["challenge"] . "\">\n";
echo "<input type=\"hidden\" name=\"uamip\" value=" . $_GET["uamip"] . ">\n";
echo "<input type=\"hidden\" name=\"uamport\" ";
echo "value=" . $_GET["uamport"] . ">\n";
echo "<input type=\"hidden\" name=\"box\" value=\"$box\" ";
echo "<input type=\"hidden\" name=\"mac\" value=\"$mac\" ";
echo "<center>\n";

echo "\n<table align=center class=\"form_table\">\n\n";
echo "<tbody>\n";

// Connection à la base MySQL
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );
$nomdelabdd="freeradius";
@mysql_select_db($nomdelabdd, $bdd);
$req_forfait = @mysql_db_query($nomdelabdd,"SELECT *
                                        FROM forfait
                                        WHERE idforfait=\"$box\"");
mysql_close();
$val = mysql_fetch_array($req_forfait);
echo "<input type=\"hidden\" name=\"type_forfait\" value=\"$val[type]\" ";

if ($val[type] == 'payant')
{
echo "<tr>\n";
echo "<td class=\"form_text\">Entrer votre num&eacute;ro de chambre</td>\n";
echo "<td class=\"form_text\">";
echo "<input class=\"form_input\" type=\"text\" name=\"sms\" size=\"10\"></td>\n";
echo "</tr>\n";
}
else
	{
	echo "<tr>\n";
	echo "<td class=\"form_text\">Entrer votre num&eacute;ro de portable</td>\n";
	echo "<td class=\"form_text\">";
	echo "<input class=\"form_input\" type=\"text\" name=\"sms\" size=\"10\"></td>\n";
	echo "</tr>\n";

	}
echo "<tr>\n";
echo "<td class=\"form_submit\" colspan=\"2\">";
echo "<input class=\"form_submit\" type=\"submit\" ";
echo "name=\"ok\" value=\"Valider\"></td>\n";
echo "</tr>\n";

echo "</tbody>\n";
echo "\n</table>\n\n";
echo "</center>\n";
echo "</form>\n";

?>
