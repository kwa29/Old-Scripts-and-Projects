<html>
<head>
<title>GESCOM&copy; Gestion Commerciale SOFIBRA</title>
<link rel="stylesheet" href="sofibra.css" type="text/css">
</head>
<body bgcolor="#FFE0A3">
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<table width="100%" height="70%" border="0" cellspacing="0" cellpadding="0" align="center" class="text">
  <tr>
    <td>
<?php
include("Admin/includes/fonctions.php");        //Connection à la SGBD

$annee  = date("Y"); 
$nomdelabdd="authentique";        // le nom de la Base de données 
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de données
@mysql_select_db($nomdelabdd, $bdd);                                // sélection de la Base de données
$nomdelabdd3="statistique";        // le nom de la Base de données 
@mysql_select_db($nomdelabdd3, $bdd);                                // sélection de la Base de données

if (@$envoyer=="ok") 
{
$req_hotel = @mysql_db_query($nomdelabdd3,"SELECT *
					FROM hotel
					WHERE codehotel <> ''
					ORDER BY nomhotel ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");

$req = @mysql_db_query($nomdelabdd,"SELECT *,g.nomgroupe 
				FROM utilisateur s,groupe g
	 			WHERE s.groupe=g.idgroupe
				AND s.login='$login'
	 			AND s.pwd='$pass'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu = mysql_numrows($req); 
if ($contenu != 0)
	{
	// Affichage du Host, du navigateur et de l'adresse l'ip
	$ip=$REMOTE_ADDR; 					 // Récupère l'adresse IP 
	$host = gethostbyaddr($ip); 		 // Récupère le host de l'IP 
	$navigateur = $HTTP_USER_AGENT; 	 // Recupere le type navigateur
	$demarrage = $REQUEST_URI; 			 // Recupere la page de demarrage
	$parcour = $HTTP_REFERER;			 // Recupere la page de parcours
	$iptemp = strrpos($ip,'.');   		 // Modification de l'ip pour traitement avec mysql
	$ip = substr_replace($ip,'',$iptemp);
	$data = mysql_fetch_array($req);
	// Numero de l'utilisateur pour tout le site
	$log = "$data[idutil]";
	// Groupe de l'utilisateur pour tout le site
	$saphira = "$data[groupe]";
	// Numero de l'hotel assigné a l'utilisateur pour tout le site
	$sofibra_sans = "$data[hotel_sans]"; // Aucun hotel
	$sofibra_avec = "$data[hotel_avec]"; // Tous les hotels
	$sofibra_sel = "$data[hotel_sel]"; // X hotels
	// On ouvre la session 
	session_start(); 	
	session_name("sessiongescom");
	// Variables ki va suivre dans tout le site
	session_register("log");
	session_register("saphira");
	session_register("sofibra_sans");
	session_register("sofibra_avec");
	session_register("sofibra_sel");
	
	$ip=addslashes($ip);
	$host=addslashes($host);
	$navigateur=addslashes($navigateur);
	$requetebis = @mysql_db_query($nomdelabdd,"INSERT INTO session(idutil,ip,domaine,navigateur,dateYMDheure)
											   VALUES ('$data[idutil]','$ip','$host','$navigateur',NOW())")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
?>
<CENTER>
<table width="373" height="236" border="0" class="text" cellpadding="0" cellspacing="0">
	 		<tr> 
				<td height="63"><img src="images/spacer.gif" width="115" height="73"></td>
				<td width="100%"><div style="left-margin:80px"><img src="images/Logo.gif"></div></td>
				</tr>
			<tr>
				<td colspan="2" align="center" valign="top" height="30"><img src="images/acces_secu.gif"></td>
			</tr>
		<tr>
   	 	<td colspan="2" align="center" valign="top">
			<form method="POST" action="index.php?envoyer=ok">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="text">
  				<tr>
   					<td align="right" height="25">Votre Login</td>
    				<td>&nbsp;&nbsp;<img src="images/menu_fleche.gif"></td>
    				<td><input type="text" name="login" value='<? echo "$login"; ?>'></td>
  				</tr>
  				<tr>
    				<td align="right" height="25">Votre Mot de Passe</td>
    				<td>&nbsp;&nbsp;<img src="images/menu_fleche.gif"></td>
    				<td><input type="password" name="pass" value='<? echo "$pass"; ?>'></td>
  				</tr>
  				<tr>
    				<td colspan="3" align="center" height="25"><input type="submit" value="Se Connecter"></td>
  				</tr>
			</table>
			</form>
		</td>
 	 	</tr>
</table>
<?
echo "Vous &ecirc;tes <b>$data[prenom] $data[nom]... ;-))</b>";
echo "<table border='0' class='text'>
	  <tr><td>Votre Fonction :</td><td><center><b>$data[nomgroupe]</b></center></td></tr>
	  <tr><td>Votre Sigle RCE :</td><td><center><b>$data[siglerce]</b></center></td></tr>
	  <tr><td>Votre Intervalle de code :</td><td><center><b>$data[nummin] - $data[nummax]</b></center></td></tr>
	  <tr><td>Votre Nom de machine :</td><td><center><b>$host</b></center></td></tr>
	  <tr><td>Votre ou vos Hôtel(s) :</td><td>";
	 if($sofibra_avec == 1){ echo "<center><b>TOUS les Hôtels</b></center>"; }
	 if($sofibra_sans == 1){ echo "<center><b>AUCUN des Hôtels</b></center>"; }	
	 // Affichage de tous les hotels
	 $tab = explode(",",$sofibra_sel);
	 // Nombre dhotel pour un utilisateur
	 $taille = sizeof($tab);
	
	 while ($val = mysql_fetch_array ($req_hotel))
		{
		for ($boucle=0;$boucle < $taille;$boucle++)
			{
			if ($val['codehotel'] == $tab[$boucle])
				{
		 		echo "<center><b>$val[codehotel] $val[nomhotel]</b></center><br>";
				}			
			}
		}
	echo "</td></tr></table>";
?>			
	<br>
	<input type='button' name='Entrer' value='Entrer sur le site' onClick='document.location="accueil.php"'>
	&nbsp;&nbsp;&nbsp;
	<input type='button' name='fermer' value='Fermer' onClick='window.close()'>
<br><br>Nous tenons &agrave; vous rappeler que l'utilisation de l'Application Gescom est uniquement r&eacute;serv&eacute; &agrave; un usage professionnel et non personnel. 
<br>En cons&eacute;quence une trace des pages que vous visitez est stock&eacute;e dans nos fichiers.<br>Nous sommes donc en mesure de savoir sur quels pages vous vous rendez, &agrave; quel moment et combien de temps vous y passez.
</center>
<?php 				
	}
else
	{	
?>
<CENTER>
		<table width="373" height="236" border="0" class="text" cellpadding="0" cellspacing="0">
	 		<tr> 
				<td height="63"><img src="images/spacer.gif" width="115" height="73"></td>
				<td width="100%"><div style="left-margin:80px"><img src="images/Logo.gif"></div></td>
				</tr>
			<tr>				
            <td colspan="2" align="center" valign="top" height="30"><img src="images/acces_refu.gif"></td>
			</tr>
		<tr>
   	 	<td colspan="2">
		<CENTER class="titre">Votre login ou votre mot de passe sont incorrect.</CENTER><br> 
		<CENTER>
                <A HREF="index.php" class="tableau">Cliquer ici</A>, pour corriger votre identification. 
              </CENTER><br> 
		</td>
 	 	</tr>
		</table>
</CENTER>
</td>
  </tr>
  <tr>
  	<td align="right" valign="bottom">
	<? echo "2002 - $annee"; ?><a class='menu' href="mailto:caroff@hotel-sofibra.com"> CAROFF Didier</a> et <a class='menu' href="mailto:guesnard@hotel-sofibra.com">GUESNARD Bruno</a>
	<br><br>
	<img src="images/02logo.gif">
	<img src="images/logo_guruz.jpg"></td>
	</tr>
</table>
</body>
</html>
<?
	exit();
	}
}
else
{
?>
<CENTER>
<table width="373" height="236" border="0" class="text" cellpadding="0" cellspacing="0">
	 		<tr> 
				<td height="63"><img src="images/spacer.gif" width="115" height="73"></td>
				<td width="100%"><div style="left-margin:80px"><img src="images/Logo.gif"></div></td>
				</tr>
			<tr>
				<td colspan="2" align="center" valign="top" height="30"><img src="images/acces_secu.gif"></td>
			</tr>
		<tr>
   	 	<td colspan="2" align="center" valign="top">
			<form method="POST" action="index.php?envoyer=ok">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="text">
  				<tr>
   					<td align="right" height="25">Votre Login</td>
    				<td>&nbsp;&nbsp;<img src="images/menu_fleche.gif"></td>
    				<td><input type="text" name="login"></td>
  				</tr>
  				<tr>
    				<td align="right" height="25">Votre Mot de Passe</td>
    				<td>&nbsp;&nbsp;<img src="images/menu_fleche.gif"></td>
    				<td><input type="password" name="pass"></td>
  				</tr>
  				<tr>
    				<td colspan="3" align="center" height="25"><input type="submit" value="Se Connecter"></td>
  				</tr>
			</table>
			</form>
			<a class='menu' href="" onClick="open('mot2pass.php','visu','left=330,top=170,width=350,height=200,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')">>> Changer votre Mot de Passe <<</a>
		</td>
 	 	</tr>
</table>

</CENTER>
<?
}
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de données
$nomdelabdd1="statistique";        // le nom de la Base de données 
@mysql_select_db($nomdelabdd1, $bdd);                                // sélection de la Base de données
$requete1 = @mysql_db_query($nomdelabdd1,"OPTIMIZE TABLE statistique")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete2 = @mysql_db_query($nomdelabdd1,"OPTIMIZE TABLE refus")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete3 = @mysql_db_query($nomdelabdd1,"OPTIMIZE TABLE annulation")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de données
$nomdelabdd2="commercial";        // le nom de la Base de données 
@mysql_select_db($nomdelabdd2, $bdd);                                // sélection de la Base de données
$requete1 = @mysql_db_query($nomdelabdd2,"OPTIMIZE TABLE client")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete2 = @mysql_db_query($nomdelabdd2,"OPTIMIZE TABLE contact")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete3 = @mysql_db_query($nomdelabdd2,"OPTIMIZE TABLE suivi")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
?>
</td>
  </tr>
  <tr>
  	<td align="right" valign="bottom">
	<? echo "2002 - $annee"; ?><a class='menu' href="mailto:caroff@hotel-sofibra.com"> CAROFF Didier</a> et <a class='menu' href="mailto:guesnard@hotel-sofibra.com">GUESNARD Bruno</a>
	<br><br>
	<img src="images/02logo.gif">
	<img src="images/logo_guruz.jpg"></td>
	</tr>
</table>
</body>
</html>
