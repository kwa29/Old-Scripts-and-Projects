<? include("Admin/sessions.php") ?>
<html>
<head>
<title>Gestion Commerciale SOFIBRA</title>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script src="fonction.js"></script>
</head>
<body>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<div align='left' class='titre'><h3>Recherche des @ pour le Mailing...</h3></div>
<?
include("Admin/includes/fonctions.php");        //Connection à la SGBD
// Connection a la base de donnée Mysql SOFIBRAWEB
$nomhote="www.hotel-sofibra.com";      // nom de l'hôte
$identifiant="root";      										 // votre nom d'utilisateur
$motdepasse="2#tB(5K"; 					// votre mot de passe 
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de données
$nomdelabdd="Site_web";        // le nom de la Base de données 
// Initialisation des variables
if ( ! isset($ok)) $ok=NULL;

@mysql_select_db($nomdelabdd, $bdd);                                // sélection de la Base de données
if ($ok == 'supp')
{
$req_del= @mysql_db_query($nomdelabdd,"DELETE
										FROM adresse
										WHERE idadresse='$id'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
echo "E-mail supprim&eacute;<br>";
}

$requete = @mysql_db_query($nomdelabdd,"SELECT *
										FROM adresse
										ORDER BY 	date_courante DESC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu = mysql_numrows($requete); 

print "La recherche a donné $contenu résultats";
print "<br><br><table width='90%' border='1'>";
print "<tr bgcolor='#FFFF9B' class='news'>  
	<td> 
      <div align='center'><b>Date d'inscription</b></div>
    </td> 
	<td> 
      <div align='center'><b>E-mail</b></div>
    </td>
    <td> 
      <div align='center'><b>Suppression</b></div>
    </td>
  </tr>";

while($contenu = @mysql_fetch_array ($requete))
	{
	$contenu['date_courante'] = mysql_mktime($contenu['date_courante']); 
	$date_courante = date('d/m/Y @ H:i',$contenu['date_courante']); 
	
	 print "<tr class='news'><td><center>$date_courante</center></td>";
    print "<td class='news'><center>$contenu[email]</center></td>";
    print "<td><center><a class='menu' href='recherchemailing.php?ok=supp&id=$contenu[idadresse]'>Cliquer ici</a></center></td></tr>";
   }

$requete = @mysql_db_query($nomdelabdd,"SELECT *
										FROM adresse
										ORDER BY 	date_courante DESC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
while($contenu = @mysql_fetch_array ($requete))
	{
    print "$contenu[email]<br>";
   }
echo "<br>";
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
?>
</body>
</html>
