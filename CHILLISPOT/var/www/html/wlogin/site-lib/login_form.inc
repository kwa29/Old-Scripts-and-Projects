<?php

echo "<form name=\"form_1\" method=\"GET\" action=\"" . LOGINPATH . "\">\n";
echo "<input type=\"hidden\" name=\"chal\" ";
echo "value=\"" . $_GET["challenge"] . "\">\n";
echo "<input type=\"hidden\" name=\"uamip\" value=" . $_GET["uamip"] . ">\n";
echo "<input type=\"hidden\" name=\"uamport\" ";
echo "value=" . $_GET["uamport"] . ">\n";
// Session pour le type de forfait
if ($box <> NULL)
{
session_start();
session_name("wifioceania");
// Variables ki va suivre dans tout le site
session_register("box");
session_register("type_forfait");
}

echo "<center>\n";
echo "\n<table class=\"form_table\">\n\n";
echo "<tbody>\n";

// Connection à la base MySQL
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );
$nomdelabdd="freeradius";
@mysql_select_db($nomdelabdd, $bdd);

if ($sms <> NULL) {
echo "Vous avez choisit le ";
// Selection du forfait si client connu
$req_forfait = @mysql_db_query($nomdelabdd,"SELECT r.*,f.*
					FROM radcheck r,forfait f
                                        WHERE r.UserName=\"$sms\"
					AND r.forfait=f.idforfait");
$forfait = mysql_fetch_array($req_forfait);
$compt_forfait = mysql_numrows($req_forfait);

// Client inconnu/en forfait
if (($compt_forfait == 0) && ($type_forfait == 'payant'))
{
echo "<b>Forfait de 24 heures à 3 Euros  -°°°°-  24 hours fixed price to 3 Euros...<br /></b>";
// Génération du mot de passe aléatoire
$newKey = genPass();
$req_auth = @mysql_db_query($nomdelabdd,"INSERT INTO radcheck (UserName,Attribute,op,Value,forfait)
                                        VALUES (\"$sms\",\"User-Password\",\"==\",\"$newKey\",\"$box\")");
// Envoi mail pour le SMS
include("envoie_mail_payant.inc");
// Affichage message
echo "Demander &agrave; la reception votre mot de passe";
}

// Client inconnu/en free
if (($compt_forfait == 0) && ($type_forfait == 'free'))
{
echo "<b>Gratuit pendant 15 minutes  -°°°°-  Free during 15 minutes...<br /></b>";
// Génération du mot de passe aléatoire
$newKey = genPass();
$req_auth = @mysql_db_query($nomdelabdd,"INSERT INTO radcheck (UserName,Attribute,op,Value,forfait)
                                    VALUES (\"$sms\",\"User-Password\",\"==\",\"$newKey\",\"$box\")");
// Envoi mail
include("envoie_mail_free.inc");
// Affichage message
echo "Votre mot de passe est envoyé sur votre portable";
}

// Client connu/en forfait
if (($compt_forfait <> 0) && ($forfait[type] == 'payant'))
{
$box = $forfait[forfait];
echo "<b>Forfait de 24 heures à 3 Euros  -°°°°-  24 hours fixed price to 3 Euros...<br /></b>";
$req_sel = @mysql_db_query($nomdelabdd,"SELECT *,SUM(AcctSessionTime) AS temps_util FROM radacct
                                        WHERE CallingStationId=\"$mac\"
                                        AND UserName=\"$sms\"
                                        GROUP BY UserName");
// Test du temps restant
$data = mysql_fetch_array($req_sel);
	// Si temps restant
	if ($data[temps_util] < $forfait[temps])
	{
	$temps_forfait = $forfait[temps];
	$temps_util = $data[temps_util];
	$t_restant = $temps_forfait - $temps_util;
	//$t_restant = $forfait[temps] - $data[temps_util];
	$t_restant = calcul_hours($t_restant);
	session_register("temps_util");
	session_register("temps_forfait");
	echo "Il vous reste <b>$t_restant</b>...";
	}
	else
	// Si temps fini
	{
	// Suppression du compte
         $req_update = @mysql_db_query($nomdelabdd,"DELETE FROM radcheck
                                                WHERE UserName=\"$sms\"");
         echo "Il ne vous reste plus de temps disponible. Redemander un forfait 24H ou 15min...";
	}
}

// Client connu/en free
if (($compt_forfait <> 0) && ($forfait[type] == 'free'))
{
$box = $forfait[forfait];
echo "<b>Gratuit pendant 15 minutes  -°°°°-  Free during 15 minutes...<br /></b>";
$now = date("Y-m-d H:i:s");
$req_sel = @mysql_db_query($nomdelabdd,"SELECT *,SUM(AcctSessionTime) AS temps_util FROM radacct
                                        WHERE CallingStationId=\"$mac\"
                                        AND UserName=\"$sms\"
                                        AND AcctStartTime < \"$now\"
                                        GROUP BY UserName");
// Test du temps restant
$data = mysql_fetch_array($req_sel);
         if ($data[temps_util] < $forfait[temps])
         {
	 $temps_forfait = $forfait[temps];
         $temps_util = $data[temps_util];
	 $t_restant = $temps_forfait - $temps_util;
         //$t_restant = $forfait[temps] - $data[temps_util];
	 $t_restant = calcul_hours($t_restant);
         session_register("temps_util");
	 session_register("temps_forfait");
         echo "Il vous reste <b>$t_restant</b>...";
         }
         else
         {
         // Suppression du compte
         $req_update = @mysql_db_query($nomdelabdd,"DELETE FROM radcheck
                                                WHERE UserName=\"$sms\"");
         echo "Il ne vous reste plus de temps disponible. Reconnectez vous demain...";
         }
}
	}
mysql_close();

echo "<tr>\n";
echo "<td class=\"form_label\">Login:</td>\n";
echo "<td>";
echo "<input class=\"form_input\" type=\"text\" ";
echo "name=\"uid\" size=\"20\" maxlength=\"255\" value=\"" . $sms . "\">";
echo "</td>\n";
echo "</tr>\n";

echo "<tr>\n";
echo "<td class=\"form_label\">Password:</td>\n";
echo "<td>";
echo "<input class=\"form_input\" type=\"password\" ";
echo "name=\"pwd\" size=\"20\" maxlength=\"255\">";
echo "</td>\n";
echo "</tr>\n";

echo "<tr>\n";
echo "<td class=\"form_submit\" colspan=\"2\">";
echo "<input class=\"form_submit\" type=\"submit\" ";
echo "name=\"login\" value=\"Login\"></td>\n";
echo "</tr>\n";

echo "</tbody>\n";

echo "\n</table>\n\n";

echo "</center>\n";
echo "</form>\n";
?>
