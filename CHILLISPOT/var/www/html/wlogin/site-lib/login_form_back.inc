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

if ($box == 'payant')
{
echo "<b>Forfait de 24 heures à 3 Euros  -°°°°-  24 hours fixed price to 3 Euros...<br /></b>";
// Selection si client connu ou pas connu
$req_sel = @mysql_db_query($nomdelabdd,"SELECT *,SUM(AcctSessionTime) AS temps_util FROM radacct
                                        WHERE CallingStationId=\"$mac\"
					AND UserName=\"$sms\"
					AND FramedIPAddress=\"$REMOTE_ADDR\"
					GROUP BY UserName");
$compteur = mysql_numrows($req_sel);
// Client inconnu
if ($compteur == 0)
{
$req_sel_2 = @mysql_db_query($nomdelabdd,"SELECT * FROM radcheck
                                        WHERE UserName=\"$sms\"");
$compteur_2 = mysql_numrows($req_sel_2);
if ($compteur_2 == 0)
{
// Génération du mot de passe aléatoire
$newKey = genPass();
$req_auth = @mysql_db_query($nomdelabdd,"INSERT INTO radcheck (UserName,Attribute,op,Value,adresse_ip,forfait)
					VALUES (\"$sms\",\"User-Password\",\"==\",\"$newKey\",\"$REMOTE_ADDR\",\"$box\")");
// Envoi mail pour le SMS
include("envoie_mail_payant.inc");
// Affichage message
echo "Demander &agrave; la reception votre mot de passe";
}
}
else
	// Client connu
	{
	// Test du temps restant
	$data = mysql_fetch_array($req_sel);
	// Si temps restant
	if ($data[temps_util] < 86400)	
		{
		$temps_util = $data[temps_util];
		$t_restant = 86400 - $data[temps_util];
		session_register("temps_util");
		echo "Il vous reste <b>$t_restant</b> secondes...";
		}
		else
		// Si temps fini
		{
		// Génération du mot de passe aléatoire
		$newKey = genPass();
		$req_auth = @mysql_db_query($nomdelabdd,"INSERT INTO radcheck (UserName,Attribute,op,Value,adresse_ip,forfait)
                                        VALUES (\"$sms\",\"User-Password\",\"==\",\"$newKey\",\"$REMOTE_ADDR\",\"$box\")");
		// Envoi mail pour le SMS
		include("envoie_mail_payant.inc");
		// Affichage message
		echo "Demander &agrave; la reception votre mot de passe";
		}
	}
}
else
        {
        echo "<b>Gratuit pendant 15 minutes  -°°°°-  Free during 15 minutes...<br /></b>";
	// Selection si client connu ou pas connu
	$now = date("Y-m-d H:i:s");
	
	$req_sel = @mysql_db_query($nomdelabdd,"SELECT *,SUM(AcctSessionTime) AS temps_util FROM radacct
                                        WHERE CallingStationId=\"$mac\"
                                        AND UserName=\"$sms\"
					AND AcctStartTime < \"$now\"
                                        GROUP BY UserName");
	$compteur = mysql_numrows($req_sel);
	// Client inconnu
	if ($compteur == 0)
        {
	$req_sel_2 = @mysql_db_query($nomdelabdd,"SELECT * FROM radcheck
                                        WHERE UserName=\"$sms\"");
	$compteur_2 = mysql_numrows($req_sel_2);
	if ($compteur_2 == 0)
	{
        // Génération du mot de passe aléatoire
        $newKey = genPass();
        $req_auth = @mysql_db_query($nomdelabdd,"INSERT INTO radcheck (UserName,Attribute,op,Value,adresse_ip,forfait)
                                         VALUES (\"$sms\",\"User-Password\",\"==\",\"$newKey\",\"$REMOTE_ADDR\",\"$box\")");
	echo "Votre mot de passe est envoyé sur votre portable";
	include("envoie_mail_free.inc");
	}
	}
	else
	// Client connu
	{
	 // Test du temps restant
         $data = mysql_fetch_array($req_sel);
	 if ($data[temps_util] < 900)
         {
	 $temps_util = $data[temps_util];
	 $t_restant = 900 - $data[temps_util];
	 session_register("temps_util");
	 echo "Il vous reste <b>$t_restant</b> secondes...";
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
echo "name=\"pwd\" size=\"20\" maxlength=\"255\" value=\"" . $password . "\">";
echo "</td>\n";
echo "</tr>\n";

if ( ENABLE_LOGIN_COOKIE ) {
  echo "<tr>\n";
  echo "<td><p>&nbsp;</p></td>\n";
  echo "<td>";
  echo "<input class=\"form_input\" type=\"checkbox\" ";
  echo "name=\"save_login\">";
  echo "<span class=\"form_label\">&nbsp;&nbsp;Remember Login?</span></td>\n";
  echo "</tr>\n";
}

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
