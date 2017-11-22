<? include("sessions.php") ?>
<head>
<title>Administration SOFIBRA</title>
<base target="corps">
<link rel="stylesheet" href="../sofibra.css" type="text/css">
</head>
<?php
include("includes/fonctions.php");        // Encapsulation de fonction PHP

switch($type)
{

case 'erreur':
echo "<h3><center>Nettoyage des Erreurs Apache</center></h3>";
$rep = "/Apache2/logs/";      			  // Repertoire des fichier error
$fichier = "error.log";									 // Fichier d'erreur
$erreur = fopen("$rep$fichier","w");		
if (!$erreur) die("Impossible d'ouvrir le fichier error.log : Actualisation stoppée");		
fputs ($erreur,"");  
fclose($erreur);
echo "<center><b>Bravo, le nettoyage de $fichier s'est effectu&eacute; avec succ&egrave;s !!!</b></center>";  
break;

case 'acces':
echo "<h3><center>Nettoyage des Accès Apache</center></h3>";
$rep = "/Apache2/logs/";      			  // Repertoire des fichier error
$fichier = "access.log";									 // Fichier d'erreur
$erreur = fopen("$rep$fichier","w");		
if (!$erreur) die("Impossible d'ouvrir le fichier access.log : Actualisation stoppée");		
fputs ($erreur,"");  
fclose($erreur);
echo "<center><b>Bravo, le nettoyage de $fichier s'est effectu&eacute; avec succ&egrave;s !!!</b></center>";  
break;

case 'erreurmy':
echo "<h3><center>Nettoyage des Erreurs MySQL</center></h3>";
$rep = "/Apache2/logs/";      			  // Repertoire des fichier error
$fichier = "mysql_error.log";									 // Fichier d'erreur
$erreur = fopen("$rep$fichier","w");		
if (!$erreur) die("Impossible d'ouvrir le fichier error.log : Actualisation stoppée");		
fputs ($erreur,"");  
fclose($erreur);
echo "<center><b>Bravo, le nettoyage de $fichier s'est effectu&eacute; avec succ&egrave;s !!!</b></center>";  
break;

case 'accesmy':
echo "<h3><center>Nettoyage des Accès MySQL</center></h3>";
$rep = "/Apache2/logs/";      			  // Repertoire des fichier error
$fichier = "mysql_acces.log";									 // Fichier d'erreur
$erreur = fopen("$rep$fichier","w");		
if (!$erreur) die("Impossible d'ouvrir le fichier acces.log : Actualisation stoppée");		
fputs ($erreur,"");  
fclose($erreur);
echo "<center><b>Bravo, le nettoyage de $fichier s'est effectu&eacute; avec succ&egrave;s !!!</b></center>";  
break;

case 'session':
$bdd=mysql_connect( $nomhote, $identifiant , $motdepasse );  // Connection a la base MySQL
$nomdelabdd="authentique";        // le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);                                // sélection de la Base de données

$req = @mysql_db_query($nomdelabdd,"DELETE FROM session")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
echo "<center><b>Bravo, le nettoyage de la Base Session s'est effectu&eacute; avec succ&egrave;s !!!</b></center>";
break;

case 'stat':
echo "<h3><center>Nettoyage du fichier statistique.log</center></h3>";
$rep = "/Apache2/logs/";      			  // Repertoire des fichier error
$fichier = "statistique.log";				// Fichier d'erreur
$erreur=unlink("$rep$fichier");             // Suppression du fichier 
echo "<center><b>Bravo, le nettoyage de $fichier s'est effectu&eacute; avec succ&egrave;s !!!</b></center>";
break;

case 'gescom':
echo "<h3><center>Nettoyage GESCOM</center></h3>";

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de données
$nomdelabdd="commercial";        // le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);                                // sélection de la Base de données

$req_1 = @mysql_db_query($nomdelabdd,"SELECT *
				FROM client
				WHERE nomclient=''")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$compteur1 = mysql_numrows($req_1); 
print "<br>Suppression de $compteur1 Clients<br>";
while($contenu = @mysql_fetch_array ($req_1))
	{ 
	$del_11 = @mysql_db_query($nomdelabdd,"DELETE
				FROM client
				WHERE idclient='$contenu[idclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$del_12 = @mysql_db_query($nomdelabdd,"DELETE
				FROM liencontact
				WHERE idclient='$contenu[codeclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	}

$req_2 = @mysql_db_query($nomdelabdd,"SELECT *
				FROM contact
				WHERE nomcontact=''")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$compteur2 = mysql_numrows($req_2); 
print "<br>Suppression de $compteur2 Contacts<br>";
while($contenu = @mysql_fetch_array ($req_2))
	{ 
	$del_21 = @mysql_db_query($nomdelabdd,"DELETE
				FROM contact
				WHERE idcontact='$contenu[idcontact]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	$del_22 = @mysql_db_query($nomdelabdd,"DELETE
				FROM liencontact
				WHERE idcontact='$contenu[idcontact]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}

$req_3 = @mysql_db_query($nomdelabdd,"SELECT *
				FROM suivi
				WHERE contenusuivi=''")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$compteur3 = mysql_numrows($req_3); 
print "<br>Suppression de $compteur3 Suivis<br>";
while($contenu = @mysql_fetch_array ($req_3))
	{ 
	$del_31 = @mysql_db_query($nomdelabdd,"DELETE
				FROM suivi
				WHERE idsuivi='$contenu[idsuivi]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	$del_32 = @mysql_db_query($nomdelabdd,"DELETE
				FROM liensuivi
				WHERE idsuivi='$contenu[idsuivi]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}

@mysql_close();
echo "<br><br><center><b>Bravo, le nettoyage s'est effectu&eacute; avec succ&egrave;s !!!</b></center>";
break;

}
?>
</html>
