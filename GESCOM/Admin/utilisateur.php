<? include("sessions.php") ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Administration SOFIBRA</title>
<base target="corps">
<link rel="stylesheet" href="../sofibra.css" type="text/css">
<body link="#CE3A05" alink="#CE3A05" vlink="#CE3A05">
<center><h3>Listing Complet des Utilisateurs GESCOM</h3></center>
<?php
include("includes/fonctions.php");        // Encapsulation de fonction PHP
// Initialisation des variables
if ( ! isset($nom)) $nom=NULL;
if ( ! isset($cod)) $cod=NULL;

$bdd=mysql_connect( $nomhote, $identifiant , $motdepasse );  // Connection a la base MySQL
$nomdelabdd="authentique";        // le nom de la Base de donnИes 

// ########## Nbre d'affichages par pages, Ю adapter
$nb = 10;
// ########## Initialisation
if(empty($page)) $page = 1;
if(empty($contenu))            // Nombre total de rИsultats
{ 
@mysql_select_db($nomdelabdd, $bdd);                                // sИlection de la Base de donnИes
$requete = @mysql_db_query($nomdelabdd,"SELECT *
										FROM utilisateur 
										ORDER BY nom ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu = mysql_numrows($requete); 
}
print "La recherche a donné $contenu résultats<p></p>";
print "<table width='80%' border='1'>";
print "<tr>  
	<td width='10%'> 
      <div align='center'><b>Nom</b></div>
    </td>  
    <td width='10%'> 
      <div align='center'><b>Prénom</b></div>
    </td>	
	<td width='10%'> 
      <div align='center'><b>Login</b></div>
    </td>  
	<td width='5%'> 
      <div align='center'><b>Mot de Passe</b></div>
    </td>  
	<td width='20%'> 
      <div align='center'><b>Groupe</b></div>	  
    </td>	
	<td width='15%'> 
      <div align='center'><b>Hôtel Associé</b></div>
    </td>  
	<td width='5%'> 
      <div align='center'><b>RCE</b></div>
    </td> 
	<td width='15%'> 
      <div align='center'><b>Intervalle</b></div>
    </td>   
	<td width='10%'> 
      <div align='center'><b>Action</b></div>
    </td>  
  </tr>";
// ########## Calcul du nombre de pages
$nbpages = ceil($contenu / $nb); // arrondi Ю l'entier supИrieur
// ########## On determine debut du limit
$debut = ($page - 1) * $nb;
// Calcul du nombre d'enregistrements
$requete = @mysql_db_query($nomdelabdd,"SELECT *,g.nomgroupe
										FROM utilisateur u,groupe g
										WHERE u.groupe=g.idgroupe
										ORDER BY nom ASC
										LIMIT $debut,$nb")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close();       // spИcifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin

if ($contenu > $nb)                  // Calcul du nombre de champ sur l'ecran pour la calculette javascript
{
$nbreligne=$nb;
}
else
{
$nbreligne=$contenu-$debut;
}

$bdd=mysql_connect( $nomhote, $identifiant , $motdepasse );  // Connection a la base MySQL
$nomdelabdd="statistique";        // le nom de la Base de donnИes 
while($contenu = @mysql_fetch_array ($requete))
	{ 
    print "<tr><td><center>$contenu[nom]</center></td>";
    print "<td><center>$contenu[prenom]</center></td>";	
	print "<td><center>$contenu[login]</center></td>";
	print "<td><center>$contenu[pwd]</center></td>";
	print "<td><center>$contenu[nomgroupe]</center></td>";
	print "<td>";
	if ($contenu['hotel_avec'] == 1){ echo "- TOUS les Hôtels<br>"; }
	if ($contenu['hotel_sans'] == 1){ echo "- AUCUN des Hôtels<br>"; }
	if (($contenu['hotel_avec'] || $contenu['hotel_sans']) == 0)
		{
			$tab = explode(",",$contenu['hotel_sel']);
			$boucle=0;

			while ($boucle < sizeof($tab)) 
				{
				$requete1 = mysql_db_query($nomdelabdd,"SELECT siglehotel
													 	 FROM hotel
													 	 WHERE codehotel='$tab[$boucle]'
													 	 AND codehotel <>''")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
				while($val = mysql_fetch_array ($requete1))
					{
					echo "- $val[siglehotel]<br>";	
					}				
				$boucle++;
				}
		}
		
	print "</td>";	
	print "<td><center>$contenu[siglerce]</center></td>";
	print "<td><center>$contenu[nummin] <<>> $contenu[nummax]</center></td>";
	print "<td><center>
	<input type='button' value='Modifier' onClick=window.open('miseajour.php?type=modif&code=$contenu[idutil]','visu','left=200,top=150,width=450,height=400,scrollbars=yes,resizable=no')>
	<input type='button' value='Supprimer' onClick=window.open('miseajour.php?type=supp&code=$contenu[idutil]','visu','left=200,top=150,width=400,height=130,scrollbars=no,resizable=no')>
	</center></td>";	
	}
print "</tr>";
print "</table>";

if(@$nbpages > 1){// ########## On affiche PrИcИdente si nbpages > 
if($page > 1)
{
$pageavant = $page -1;
$avant = "<a class='menu' href=\"$PHP_SELF?page=$pageavant&nom=$nom&cod=$cod&formulaire=ok\">Précédent </a>";
echo "$avant";
}
else
{
echo "Précédent";
}
echo "<<"; //Construction de la pagination
// ########## On affiche les liens pages (sans HREF sur la page en cours) si nbpages > 1
if($nbpages > 1)
{
for($i = 1;$i <= $nbpages;$i ++)
   {
   if($i != $page)
     {
     echo "<a class='menu' href=\"$PHP_SELF?page=$i&nom=$nom&cod=$cod&formulaire=ok\"> $i </a>";
     }
     else
        {
        echo " $i ";
        }
   }
}
echo ">>"; //Construction de la pagination
// ########## On affiche Suivante
if($page < $nbpages)
{
$pageapres = $page +1;
$apres = "<a class='menu' href=\"$PHP_SELF?page=$pageapres&nom=$nom&cod=$cod&formulaire=ok\"> Suivant</a>";
echo "$apres";
}
else
{
echo "Suivant";
} 
}
/* pour libИrer la mИmoire */
mysql_free_result($requete); 
@mysql_close();       // spИcifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin

?>
<p></p><center><input type='button' value='Nouveau Utilisateur' onClick=window.open('miseajour.php?type=nouveau&code=$contenu[idutil]','visu','left=200,top=150,width=450,height=400,scrollbars=yes,resizable=no')></center>
</body>
</html>
