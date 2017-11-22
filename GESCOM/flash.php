<? include("Admin/sessions.php") ?>
<html>
<head>
<title>Gestion Commerciale SOFIBRA</title>
<base target="corps">
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script src="fonction.js"></script>
</head>
<body>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<div align='left' class='titre'><h2>Flash d'activit&eacute;s...</h2></div>
<?
include("Admin/includes/fonctions.php");        //Connection a la base Statistique 
$an  = date("Y");                // dit au script que la variable "$an" correspond à "Year"
$mois = date ("m");				  // récupération du mois

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="statistique";        // le nom de la Base de données 

@mysql_select_db($nomdelabdd, $bdd);                                // sélection de la Base de données
$requete = @mysql_db_query($nomdelabdd,"SELECT *
										FROM flash 
										WHERE anneeflash=\"$an\"
										ORDER BY dateflash")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
print "<table width='100%' border='1'>";
print "<tr bgcolor='#FFFF9B' class='news'>  
	<td width='10%'> 
      <div align='center'><b>Code</b></div>
    </td> 
	<td width='5%'> 
      <div align='center'><b>Etat</b></div>
    </td> 
	<td width='25%'> 
      <div align='center'><b>Nom du Client</b></div>
    </td>  
	<td width=15%'> 
      <div align='center'><b>Ville</b></div>
    </td>  
    <td width='30%'> 
      <div align='center'><b>Informations Contact</b></div>
    </td>	
	<td width='15%'> 
      <div align='center'><b>Nouveau Contact</b></div>
    </td>	
  </tr>";
while($contenu = @mysql_fetch_array ($requete))
	{ 
	
	
	
	}
print "</tr>";
print "</table>";

mysql_free_result($requete);  
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
?>
</body>
</html>
<?
// Petit script pour le calcul des statistiques du site 
$nom_page="flash.php";
require "Admin/stats/visiteur.php";  
?>