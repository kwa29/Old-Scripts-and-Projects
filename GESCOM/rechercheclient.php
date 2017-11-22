<html>
<head>
<title>Gestion Commerciale SOFIBRA</title>
<link rel="stylesheet" href="sofibra.css" type="text/css">
</head>
<body>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<?php
include("Admin/includes/fonctions.php");        //Connection à la SGBD

$nomdelabdd="commercial";        // le nom de la Base de donn&eacute;es 
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd,$bdd);                                // s&eacute;lection de la Base de donn&eacute;es
$requete = @mysql_db_query($nomdelabdd,"SELECT c.nomclient,c.adresseclient,v.nomville,p.nompays
					FROM client c,ville v,pays p
					WHERE c.idville=v.idville
					AND c.idpays=p.idpays										
					AND c.codeclient='$code'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
print "<center><b>Informations G&eacute;n&eacute;rales sur le Client $code</b></center><p>";
$contenu = mysql_numrows($requete); 
if ($contenu == 0)
{
print "<li><b>Le client est introuvable !!!</b>";
}
else
{
while($contenu = @mysql_fetch_array ($requete))
{ 
print "<li>Nom : <b>$contenu[nomclient]</b>";
print "<li>Adresse : <b>$contenu[adresseclient]</b>";
print "<li>Ville : <b>$contenu[nomville]</b>";
print "<li>Pays : <b>$contenu[nompays]</b>";
}
}
mysql_free_result($requete);  
@mysql_close();       // sp&eacute;cifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
?>
<p>
<center><input type="button" name="fermer" value="Fermer la fenetre" onClick="window.close()"></center>
</p>