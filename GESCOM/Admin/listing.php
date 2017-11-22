<? include("sessions.php") ?>
<html>
<head>
<title>Administration SOFIBRA</title>
<base target="corps">
<link rel="stylesheet" href="../sofibra.css" type="text/css">
</head>
<?php
include("includes/fonctions.php"); 

switch(@$type)
{
case 'erreur':
?>
<h3><center>Listing des Erreurs Apache</center></h3>
<?php
$rep = "/Apache2/logs/";      			  // Repertoire des fichier error
$fichier = "error.log";									 // Fichier d'erreur
$fd = fopen("$rep$fichier","r");                 

if (!$fd) die("Impossible d'ouvrir le fichier $fichier:Ouverture stoppé"); // si fopen retourne faux c'est que le fichier ne peut être ouvert en écriture 
	while (! feof($fd))
			{
			echo "<li>".fgets($fd, 4096)."<br>";
			}
fclose($fd);
break;

case 'acces':
?>
<h3><center>Listing des Accès Apache</center></h3>
<?php
$rep = "/Apache2/logs/";      			  // Repertoire des fichier error
$fichier = "access.log";									 // Fichier d'erreur
$fd = fopen("$rep$fichier","r");                 

if (!$fd) die("Impossible d'ouvrir le fichier $fichier:Ouverture stoppé"); // si fopen retourne faux c'est que le fichier ne peut être ouvert en écriture 
	while (! feof($fd))
			{
			echo "<li>".fgets($fd, 4096)."<br>";
			}
fclose($fd);
break;

case 'erreurmy':
?>
<h3><center>Listing des Erreurs MySQL</center></h3>
<?php
$rep = "/Apache2/logs/";      			  // Repertoire des fichier error
$fichier = "mysql_error.log";									 // Fichier d'erreur
$fd = fopen("$rep$fichier","r");                 

if (!$fd) die("Impossible d'ouvrir le fichier $fichier:Ouverture stoppé"); // si fopen retourne faux c'est que le fichier ne peut être ouvert en écriture 
	while (! feof($fd))
			{
			echo "<li>".fgets($fd, 4096)."<br>";
			}
fclose($fd);
break;

case 'accesmy':
?>
<h3><center>Listing des Accès MySQL</center></h3>
<?php
$rep = "/Apache2/logs/";      			  // Repertoire des fichier error
$fichier = "mysql_access.log";									 // Fichier d'erreur
$fd = fopen("$rep$fichier","r");                 

if (!$fd) die("Impossible d'ouvrir le fichier $fichier:Ouverture stoppé"); // si fopen retourne faux c'est que le fichier ne peut être ouvert en écriture 
	while (! feof($fd))
			{
			echo "<li>".fgets($fd, 4096)."<br>";
			}
fclose($fd);
break;

case 'session':
?>
<h3><center>Listing des Utilisateurs pour ce Jour</center></h3>
<center>
<table width="80%" border="1">
  <tr> 
  	<td width="20%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Date et Heure</b></div>
    </td>
  	<td width="10%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Nom</b></div>
    </td>
    <td width="10%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Prénom</b></div>
    </td>
    <td width="40%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Informations Utilisateur</b></div>
    </td>
  </tr>
<?php
$bdd=mysql_connect( $nomhote, $identifiant , $motdepasse );  // Connection a la base MySQL
$nomdelabdd="authentique";        // le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);                                // sélection de la Base de données
$req = @mysql_db_query($nomdelabdd,"SELECT *
									FROM session 
									WHERE TO_DAYS(NOW()) - TO_DAYS(dateYMDheure) < 1
									ORDER BY idsession DESC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
while($contenu = mysql_fetch_array($req)) 
          {	 
		  $date=date("d/m/Y", strtotime($contenu[dateYMDheure]));
 	      $heure=date("H:i:s", strtotime($contenu[dateYMDheure]));
		  $req1 = @mysql_db_query($nomdelabdd,"SELECT * FROM utilisateur
		  									   WHERE idutil='$contenu[idutil]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
		  $val = mysql_fetch_array($req1);
		  print "<tr><td><div align=left>Le $date @ $heure</div></td>";
		  print "<td><div align=center><b>$val[nom]</b></div></td>";
		  print "<td><div align=center><b>$val[prenom]</b></div></td>";
		  print "<td><center>$contenu[ip]<br>$contenu[domaine]<br>$contenu[navigateur]</center></td></tr>";  
		  }
echo "</table></center>";
?>
<h3><center>Listing des Utilisateurs pour ce Mois</center></h3>
<center>
<table width="80%" border="1">
  <tr> 
  	<td width="20%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Date et Heure</b></div>
    </td>
  	<td width="10%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Nom</b></div>
    </td>
    <td width="10%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Prénom</b></div>
    </td>
    <td width="40%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Informations Utilisateur</b></div>
    </td>
  </tr>
<?php
$req = @mysql_db_query($nomdelabdd,"SELECT *
									FROM session 
									WHERE TO_DAYS(NOW()) - TO_DAYS(dateYMDheure) <= 30
									GROUP BY idutil
									ORDER BY idsession DESC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
while($contenu = mysql_fetch_array($req)) 
          {	 
		  $date=date("d/m/Y", strtotime($contenu[dateYMDheure]));
 	      $heure=date("H:i:s", strtotime($contenu[dateYMDheure]));
		  $req1 = @mysql_db_query($nomdelabdd,"SELECT * FROM utilisateur
		  									   WHERE idutil='$contenu[idutil]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
		  $val = mysql_fetch_array($req1);
		  print "<tr><td><div align=left>Le $date @ $heure</div></td>";
		  print "<td><div align=center><b>$val[nom]</b></div></td>";
		  print "<td><div align=center><b>$val[prenom]</b></div></td>";
		  print "<td><center>$contenu[ip]<br>$contenu[domaine]<br>$contenu[navigateur]</center></td></tr>";  
		  }
echo "</table></center>";
?>
<h3><center>Listing des Utilisateurs pour cette Année</center></h3>
<center>
<table width="80%" border="1">
  <tr> 
  	<td width="20%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Date et Heure</b></div>
    </td>
  	<td width="10%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Nom</b></div>
    </td>
    <td width="10%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Prénom</b></div>
    </td>
    <td width="40%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Informations Utilisateur</b></div>
    </td>
  </tr>
<?php
$annee  = date("Y");        // dit au script que la variable "$annee" correspond à "Year"
$req = @mysql_db_query($nomdelabdd,"SELECT *
									FROM session 
									WHERE YEAR(dateYMDheure) = \"$annee\"
									GROUP BY idutil
									ORDER BY idsession DESC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
while($contenu = mysql_fetch_array($req)) 
          {	 
		  $date=date("d/m/Y", strtotime($contenu[dateYMDheure]));
 	      $heure=date("H:i:s", strtotime($contenu[dateYMDheure]));
		  $req1 = @mysql_db_query($nomdelabdd,"SELECT * FROM utilisateur
		  									   WHERE idutil='$contenu[idutil]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
		  $val = mysql_fetch_array($req1);
		  print "<tr><td><div align=left>Le $date @ $heure</div></td>";
		  print "<td><div align=center><b>$val[nom]</b></div></td>";
		  print "<td><div align=center><b>$val[prenom]</b></div></td>";
		  print "<td><center>$contenu[ip]<br>$contenu[domaine]<br>$contenu[navigateur]</center></td></tr>";  
		  }
echo "</table></center>";
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
break;

case 'stat':
?>
<h3><center>Listing du Statistique.log</center></h3>
<?php
$rep = "/var/www/html/gescom/Admin/Temporaire/";      			  // Repertoire des fichier error
$fichier = "statistique.log";									 // Fichier d'erreur
$fd = fopen("$rep$fichier","r");                 

if (!$fd) die("Impossible d'ouvrir le fichier $fichier:Ouverture stoppé"); // si fopen retourne faux c'est que le fichier ne peut être ouvert en écriture 
	while (! feof($fd))
		{
		echo "<li>".fgets($fd, 4096)."<br>";
		}
fclose($fd);
break;

case 'hotel':
?>
<h3><center>Listing des Codes Client par Hôtel</center></h3>
		<center>
  		<form name="form1" action="listing.php" methode="POST">
  		<input type="hidden" name="type" value="hotel">
		Taper un Nom de Client 
  		<input type="text" name="nom" value="<?php echo "$nom";?>">
  		<input type="hidden" name="formulaire" value="ok">
  		<input type="submit" name="rechercher" value="Rechercher">  
 		</form>
		</center>
<?php
if ($formulaire == 'ok')
	{
	$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de données
	$nomdelabdd="statistique";       										// le nom de la Base de données 
	@mysql_select_db($nomdelabdd,$bdd);   			

	$req_sel_hot = @mysql_query("SELECT *
						 	 	 FROM hotel
							 	 WHERE codehotel <> ''
							 	 ORDER BY nomhotel ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
	while ($val = mysql_fetch_array($req_sel_hot))
		{
		echo "<img src='../images/line1.gif' align=absmiddle border=0 width=580>";
		echo "<div class='menu'>Pour $val[nomhotel] $val[codehotel]</div>";
		
		$req_sel = @mysql_query("SELECT codeclient,nomclient
						 	 	 FROM statistique
							 	 WHERE nomclient LIKE \"$nom%\"
								 AND codetablis=\"$val[codehotel]\"
								 GROUP BY codeclient
							 	 ORDER BY nomclient ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
		while ($valeur = mysql_fetch_array($req_sel))
			{
			echo "<li><b>$valeur[codeclient] -> $valeur[nomclient]</b><br>";
			}		
		}
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
	}
break;
}
?>
</html>