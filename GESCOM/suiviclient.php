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
<?php
if (@$formulaire=="ok")
{
?>
<div align='left' class='titre'><h3>Suivi Commercial...</h3></div>
 <form name="form1" action="suiviclient.php" methode="POST" onSubmit="return controle();">
  Taper un Nom de Client 
  <input type="text" name="nom" value="<?php echo(@$nom);?>">
  ou son Code
  <input type="text" name="cod" value="<?php echo(@$cod); ?>">
  <input type="hidden" name="formulaire" value="ok">
  <input type="submit" name="rechercher" value="Rechercher">
</form>
 <center>
 <input type="button" value="Nouvelle Fiche Société" onClick=window.open('client.php?type=S','visu','left=5,top=10,width=800,height=520,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no')>
 <input type="button" value="Nouvelle Fiche Tourisme" onClick=window.open('client.php?type=T','visu','left=5,top=10,width=800,height=520,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no')>
 <input type="button" value="Nouvelle Fiche Particulier" onClick=window.open('client.php?type=P','visu','left=5,top=10,width=800,height=520,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no')>
</center>
 <p></p> 
<?
include("Admin/includes/fonctions.php");        //Connection a la base Statistique 

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="commercial";        // le nom de la Base de données 

// ########## Nbre d'affichages par pages, à adapter
$nb = 10;
// ########## Initialisation
if(empty($page)) $page = 1;
if(empty($contenu))            // Nombre total de résultats
{ 
@mysql_select_db($nomdelabdd, $bdd);                                // sélection de la Base de données
$requete = @mysql_db_query($nomdelabdd,"SELECT codeclient,nomclient
										FROM client 
										WHERE nomclient LIKE \"%$nom%\"
										AND codeclient LIKE \"$cod%\"
										ORDER BY nomclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu = mysql_numrows($requete); 
}
if ($contenu == 0)
{print ("<h3><center>Désolé, le client $nom $cod n'existe pas dans la Base de données</center></h3>");}
else
{
print "La recherche a donné $contenu résultats.<br><br>";
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
// ########## Calcul du nombre de pages
$nbpages = ceil($contenu / $nb); // arrondi à l'entier supérieur
// ########## On determine debut du limit
$debut = ($page - 1) * $nb;
// ########## Requete sélection limitée
// Calcul du nombre d'enregistrements
$requete = @mysql_db_query($nomdelabdd,"SELECT *
										FROM client 
										WHERE nomclient LIKE \"%$nom%\"
										AND codeclient LIKE \"$cod%\"
										ORDER BY nomclient
										LIMIT $debut,$nb")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
if ($contenu > $nb)                  // Calcul du nombre de champ sur l'ecran pour la calculette javascript
{
$nbreligne=$nb;
}
else
{
$nbreligne=$contenu-$debut;
}
while($contenu = @mysql_fetch_array ($requete))
	{ 
	$requetea = @mysql_db_query($nomdelabdd,"SELECT nomville
										     FROM ville 
											 WHERE idville='$contenu[idville]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$valeur = @mysql_fetch_array ($requetea);
	
	if (@$contenu[etat] == '1')
	{
	print "<tr><td><a href='#' onClick=window.open('suivitotal.php?codeclient=$contenu[codeclient]','visu','scrollbars=yes,resizable=yes')><img src='images/Icones/listing.ico' align=absmiddle width=20 height=20 border=0 alt='Visualisation de tous les contacts'></a>&nbsp;&nbsp;&nbsp;&nbsp;<b>$contenu[codeclient]</b></td>";
    print "<td><center><b>A</b></center></td>";
	print "<td>&nbsp;&nbsp;<a href='#' onClick=window.open('client.php?ok=Modif&code=$contenu[codeclient]&numero=$contenu[idclient]','visu','left=5,top=10,width=780,height=520,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no')><img src='images/Icones/eye.ico' align=absmiddle width=20 height=20 border=0 alt='Modification des Informations du Client'></a>&nbsp;&nbsp;&nbsp;&nbsp;<b>$contenu[nomclient]</b></td>";
    print "<td><center>$valeur[nomville]</center></td>";
	// Selection des contact associés au client
	$requete1 = @mysql_db_query($nomdelabdd,"SELECT c.nomcontact,c.prenomcontact,c.telcontact,v.nomville,l.idcontact,f.nomfonction
											 FROM contact c,ville v,liencontact l,fonction f
											 WHERE c.idville=v.idville
											 AND c.idcontact=l.idcontact
											 AND f.idfonction=c.idfonction
											 AND l.idclient='$contenu[codeclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$contenu1 = mysql_numrows($requete1); 
	print "<td>";
	// Cas ou le lien contact n'existe pas
	if ($contenu1 == NULL){echo "<li><font color='#CE3A05'><b>Aucun contact n'est associ&eacute; au Client</b></font>";}
	else
	{
	while($contenu1 = @mysql_fetch_array ($requete1))
		{	
		print "<li><a class='menu' href=\"suivicontact.php?ok=Modif&code=$contenu[codeclient]&codecontact=$contenu1[idcontact]\">$contenu1[nomcontact], $contenu1[prenomcontact]</a>, $contenu1[telcontact], $contenu1[nomville], $contenu1[nomfonction]";
		}
	}
	print "</td>";
	print "<td><input type='button' value='Nouveau Contact' onClick=window.open('suivicontact.php?code=$contenu[codeclient]','visu','left=15,top=50,width=730,height=350,scrollbars=no,resizable=no')></td>";		
	}
	else
		// Contact Inactif
		{
		print "<tr><td>$contenu[codeclient]</td>";
   		print "<td><center><b>I</b></center></td>";
		print "<td><center>$contenu[nomclient]</center></td>";
    	print "<td><center>$valeur[nomville]</center></td>";
		// Selection des contact associés au client
		$requete1 = @mysql_db_query($nomdelabdd,"SELECT c.nomcontact,c.prenomcontact,c.telcontact,v.nomville,l.idcontact,f.nomfonction
											 	 FROM contact c,ville v,liencontact l,fonction f
											 	 WHERE c.idville=v.idville
												 AND c.idcontact=l.idcontact
											 	 AND f.idfonction=c.idfonction
											 	 AND l.idclient='$contenu[codeclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
		$contenu1 = mysql_numrows($requete1); 
		print "<td>";
		// Cas ou le lien contact n'existe pas
		if ($contenu1 == NULL){echo "<li><font color='#CE3A05'><b>Aucun contact n'est associ&eacute; au Client</b></font>";}
		else
		{
		while($contenu1 = @mysql_fetch_array ($requete1))
			{	
			print "<li><b>$contenu1[nomcontact], $contenu1[prenomcontact]</b>, $contenu1[telcontact], $contenu1[nomville], $contenu1[nomfonction]";
			}
		}
		print "</td>";
		print "<td><center><font color='#CE3A05'><b>Contact Inactif</b></font></center></td>";	
		}
	}
print "</tr>";
print "</table>";
}
if(@$nbpages > 1){// ########## On affiche Précédente si nbpages > 
if($page > 1)
{
$pageavant = $page -1;
$avant = "<a class='menu' href=\"$PHP_SELF?page=$pageavant&nom=$nom&cod=$cod&formulaire=ok\">Précédent </a>";
echo "$avant";
}
else
{
echo "Précédent ";
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
/* pour libérer la mémoire */
mysql_free_result($requete);  
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
}
else
{
?>  
<div align='left' class='titre'><h3>Suivi Commercial...</h3></div>
  <form name="form1" action="suiviclient.php" methode="POST" onSubmit="return controle();">
  Taper un Nom de Client 
  <input type="text" name="nom" value="<?php echo "$nom";?>">
  ou son Code
  <input type="text" name="cod" value="<?php echo "$cod"; ?>">
  <input type="hidden" name="formulaire" value="ok">
  <input type="submit" name="rechercher" value="Rechercher">  
 </form>
 <center>
 <input type="button" value="Nouvelle Fiche Société" onClick=window.open('client.php?type=S','visu','left=5,top=10,width=800,height=520,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no')>
 <input type="button" value="Nouvelle Fiche Tourisme" onClick=window.open('client.php?type=T','visu','left=5,top=10,width=800,height=520,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no')>
 <input type="button" value="Nouvelle Fiche Particulier" onClick=window.open('client.php?type=P','visu','left=5,top=10,width=800,height=520,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no')>
 </center>
<?php
}
?>
</body>
</html>
<?
// Petit script pour le calcul des statistiques du site 
$nom_page="suiviclient.php";
require "Admin/stats/visiteur.php";  
?>
