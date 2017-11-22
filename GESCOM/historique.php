<? include("Admin/sessions.php") ?>
<?php
include("Admin/includes/fonctions.php");        //Connection Ю la SGBD

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection Ю la Base de donnИes
$nomdelabdd="commercial";       										// le nom de la Base de donnИes 
@mysql_select_db($nomdelabdd, $bdd);   								 // sИlection de la Base de donnИes

if (@$type == 'contenu')
{
$requete1 = mysql_db_query($nomdelabdd,"SELECT s.datesuivi,s.contenusuivi
										 FROM suivi s,liensuivi l,typsuivi t
										 WHERE s.idsuivi=l.idsuivi
										 AND s.idtypsuivi=t.idtypsuivi
										 AND l.idcontact='$code'
										 AND s.idsuivi='$id'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close();       // spИcifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
// Affichage dans popup du contenu du contact
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Gestion Commerciale SOFIBRA</title>
<link rel="stylesheet" href="sofibra.css" type="text/css">
</head>
<div align='left' class='titre'><h3>Contenu du Contact...</h3></div>
<?php
while($contenu1 = mysql_fetch_array ($requete1))
	{ 	
	// Transformation de la date
	$datejour = transformfrench_date(@$contenu1[datesuivi]);
	echo "Le $datejour : $contenu1[contenusuivi]";
	}
?>
<p></p>
<center><input type="button" name="fermer" value="Fermer" onClick="window.close()"></center>
</html>
<?php
}
// Affichage de l'historique complet du contact
else
{
$requete = @mysql_db_query($nomdelabdd,"SELECT *,t.nomtypsuivi
										FROM suivi s,liensuivi l,typsuivi t
										WHERE s.idsuivi=l.idsuivi
										AND s.idtypsuivi=t.idtypsuivi
										AND l.idcontact='$code'
										ORDER BY s.idsuivi DESC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close();       // spИcifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
// Pour connaitre l'utilisateur et inserer son sigle
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection Ю la Base de donnИes
$nomdelabdd2="authentique";        // le nom de la Base de donnИes 
@mysql_select_db($nomdelabdd2, $bdd);                                // sИlection de la Base de donnИes
$req = @mysql_db_query($nomdelabdd2,"SELECT * FROM utilisateur WHERE idutil='$log'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$valreq = mysql_fetch_array($req);
@mysql_close();       // spИcifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
?>
<html>
<head>
<title>Gestion Commerciale SOFIBRA</title>
<link rel="stylesheet" href="sofibra.css" type="text/css">
</head>
<body>
<div align='left' class='titre'><h3>Historique Complet du Contact...</h3></div>
<center>
<table width='90%' border='1'>
<tr bgcolor='#FFFF9B' class='news'>  
	<td width='10%'> 
      <div align='center'><b>Date RDV</b></div>
    </td> 
	<td width='10%'> 
      <div align='center'><b>Suivi Futur</b></div>
    </td>  
	<td width='10%'> 
      <div align='center'><b>RCE</b></div>
    </td> 
	<td width='15%'> 
      <div align='center'><b>Type de Suivi</b></div>
    </td>	
	<td width='45%'> 
      <div align='center'><b>Contenu</b></div>
    </td>	
</tr>
<?php
while($contenu = mysql_fetch_array ($requete))
	{ 
	$datej = transformfrench_date(@$contenu[datesuivi]);
	$datef = transformfrench_date(@$contenu[futursuivi]);	
	print "<tr><td>$datej</td>";
	print "<td><center>$datef</center></td>";
	print "<td><center>$contenu[idrce]</center></td>";
	print "<td><center>$contenu[nomtypsuivi]</center></td>";
	print "<td>$contenu[contenusuivi]</td></tr>";
	}
print "</tr></table>";
?>
<br>
<input type="button" name="fermer" value="Fermer" onClick="window.close()"></center>
</body>
</html>
<?
}
?>