<? include("sessions.php") ?>
<html>
<head>
<base target="corps">
<link rel="stylesheet" href="../sofibra.css" type="text/css">
<body>
<?php
include("includes/fonctions.php");        //Connection a la base Statistique 

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="commercial";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);   								 // sélection de la Base de données

$requete1 = @mysql_db_query($nomdelabdd,"SELECT c.*
					 FROM client c")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");

$i = 0;
$j = 0;
$k = 0;

while($val1 = @mysql_fetch_array ($requete1))
	{ 
	$requete4 = @mysql_db_query($nomdelabdd,"SELECT c.*,v.*
					 FROM client c,ville v
					 WHERE c.idville=v.idville
					 AND v.idville=\"$val1[idville]\"
					 ORDER BY nomville ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$val4 = @mysql_fetch_array ($requete4);
	// CAS EN ECHEC
	$contenu = mysql_numrows($requete4);
	$requete3 = @mysql_db_query($nomdelabdd,"SELECT *
				FROM codpostal
				WHERE nomville=\"$val4[nomville]\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$val3 = @mysql_fetch_array ($requete3);
	
	if ($contenu == 0)
	{
	echo "OldVille $val1[nomville], OldCP $val1[cpclient] NOT OK Ville $val3[nomville], CP $val3[cpville]<br>";
	if ($val1[cpclient] <> '')
		{
		// Il ya uniquement le CP...
		$req_update = @mysql_db_query($nomdelabdd,"UPDATE client SET
			idville=\"$val3[idville]\",
			cpclient=\"$val1[cpclient]\"
			WHERE idclient='$val1[idclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
		$k++;
		}
	if ( ($val4[nomville]=='') && ($val4[cpclient]=='' ))
		{
		// Ville et CP vide... on met BREST par defaut
		$req_update = @mysql_db_query($nomdelabdd,"UPDATE client SET
			idville='12011',
			cpclient='29200'
			WHERE idclient='$val1[idclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	
		$k++;
		}
	$j++;
	$k = $k + $k;
	}
	else
		{
		if ( ($val4[nomville]==$val3[nomville]) && ($val4[cpclient]==$val3[cpville]) )
			{
		// Ville ou le nom et le CP corrrespondent...
		// On met a jour sans pb
		$req_update = @mysql_db_query($nomdelabdd,"UPDATE client SET
			idville=\"$val3[idville]\"
			WHERE idclient='$val1[idclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
		echo "OldVille $val4[nomville], OldCP $val4[cpclient] OK Ville $val3[nomville], CP $val3[cpville]<br>";
			}
		if ($val4[nomville]==$val3[nomville])
			{
			// Ville ou le nom uniquement corrrespondent...
		$req_update = @mysql_db_query($nomdelabdd,"UPDATE client SET
			idville=\"$val3[idville]\",
			cpclient=\"$val3[cpville]\"
			WHERE idclient='$val1[idclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
		echo "OldVille $val4[nomville], OldCP $val4[cpclient] OK Ville $val3[nomville], CP $val3[cpville]<br>";
			}
		$i++;
		}
	}
@mysql_close();

echo "<br><br><h3>$i Modifications. $j/$k Erreurs Clients</h3>";

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="commercial";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);   								 // sélection de la Base de données

$requete1 = @mysql_db_query($nomdelabdd,"SELECT c.*
					 FROM contact c")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");

$i = 0;
$j = 0;
$k = 0;

while($val1 = @mysql_fetch_array ($requete1))
	{ 
	$requete4 = @mysql_db_query($nomdelabdd,"SELECT c.*,v.*
					 FROM contact c,ville v
					 WHERE c.idville=v.idville
					 AND v.idville=\"$val1[idville]\"
					 ORDER BY nomville ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$val4 = @mysql_fetch_array ($requete4);
	// CAS EN ECHEC
	$contenu = mysql_numrows($requete4);
	$requete3 = @mysql_db_query($nomdelabdd,"SELECT *
				FROM codpostal
				WHERE nomville=\"$val4[nomville]\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$val3 = @mysql_fetch_array ($requete3);
	
	if ($contenu == 0)
	{
	echo "OldVille $val1[nomville], OldCP $val1[cpcontact] NOT OK Ville $val3[nomville], CP $val3[cpville]<br>";
	if ($val1[cpcontact] <> '')
		{
		// Il ya uniquement le CP...
		$req_update = @mysql_db_query($nomdelabdd,"UPDATE contact SET
			idville=\"$val3[idville]\",
			cpcontact=\"$val1[cpcontact]\"
			WHERE idcontact='$val1[idcontact]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
		$k++;
		}
	if ( ($val4[nomville]=='') && ($val4[cpcontact]=='' ))
		{
		// Ville et CP vide... on met BREST par defaut
		$req_update = @mysql_db_query($nomdelabdd,"UPDATE contact SET
			idville='12011',
			cpcontact='29200'
			WHERE idcontact='$val1[idcontact]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	
		$k++;
		}
	$j++;
	$k = $k + $k;
	}
	else
		{
		if ( ($val4[nomville]==$val3[nomville]) && ($val4[cpcontact]==$val3[cpville]) )
			{
		// Ville ou le nom et le CP corrrespondent...
		// On met a jour sans pb
		$req_update = @mysql_db_query($nomdelabdd,"UPDATE contact SET
			idville=\"$val3[idville]\"
			WHERE idcontact='$val1[idcontact]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
		echo "OldVille $val4[nomville], OldCP $val4[cpcontact] OK Ville $val3[nomville], CP $val3[cpville]<br>";
			}
		if ($val4[nomville]==$val3[nomville])
			{
			// Ville ou le nom uniquement corrrespondent...
		$req_update = @mysql_db_query($nomdelabdd,"UPDATE contact SET
			idville=\"$val3[idville]\",
			cpcontact=\"$val3[cpville]\"
			WHERE idcontact='$val1[idcontact]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
		echo "OldVille $val4[nomville], OldCP $val4[cpcontact] OK Ville $val3[nomville], CP $val3[cpville]<br>";
			}
		$i++;
		}
	}
@mysql_close();

echo "<br><br><h3>$i Modifications. $j/$k Erreurs Contacts</h3>";


?>
</body>
</html>
