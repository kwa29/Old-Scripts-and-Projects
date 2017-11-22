<? include("Admin/sessions.php") ?>
<html>
<head>
<title>Gestion Commerciale SOFIBRA</title>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script src="fonction.js"></script>
</head>
<body>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<?php
// Initialisation des variables
if ( ! isset($formulaire)) $formulaire=NULL;

if ($formulaire=="ok")
{
?>
<div align='left' class='titre'><h3>Saisie des Annulations et Refus...</h3></div>
	<form name="form1" action="recherchealiment.php" methode="POST" onSubmit="return controle();">
	Taper un Nom de Client 
 	 <input type="text" name="nom" value="<?php echo "$nom";?>">
 	 ou le Code du Client 
 	 <input type="text" name="cod" value="<?php echo "$cod"; ?>">
 	 <input type="hidden" name="formulaire" value="ok">
 	 <input type="submit" name="rechercher" value="Rechercher">
 	 <input type="reset" name="effacer" value="Effacer">  
 	 </form>
<?
include("Admin/includes/fonctions.php");        //Connection à la SGBD

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de données
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
										AND codeclient LIKE '$cod%'
										ORDER BY nomclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu = mysql_numrows($requete); 
}
if ($contenu == 0)
{print ("<h3><center>Désolé, le client $nom $cod n'existe pas dans la Base de données</center></h3>");}
else
{
print "La recherche a donné $contenu résultats";
print "<br><br><table width='100%' border='1'>";
print "<tr bgcolor='#FFFF9B' class='news'>  
	<td width='5%'> 
      <div align='center'><b>Code</b></div>
    </td> 
	<td width='15%'> 
      <div align='center'><b>Nom du Client</b></div>
    </td>  
    <td width='20%'> 
      <div align='center'><b>Informations Client</b></div>
    </td>	
	<td width='25%'> 
      <div align='center'><b>Les 5 Derni&egrave;res Annulations</b></div>	  
    </td>	
	<td width='5%'> 
      <div align='center'><b>Nouvelle Annulation</b></div>
    </td>	
	<td width='25%'> 
      <div align='center'><b>Les 5 Derniers Refus</b></div>
    </td>	
	<td width='5%'> 
      <div align='center'><b>Nouveau Refus</b></div>
    </td>	
  </tr>";
// ########## Calcul du nombre de pages
$nbpages = ceil($contenu / $nb); // arrondi à l'entier supérieur
// ########## On determine debut du limit
$debut = ($page - 1) * $nb;
// ########## Requete sélection limitée
// Calcul du nombre d'enregistrements
$requete = @mysql_db_query($nomdelabdd,"SELECT codeclient,nomclient
										FROM client
										WHERE nomclient LIKE \"%$nom%\"
										AND codeclient LIKE '$cod%'
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
	print "<tr><td><center>$contenu[codeclient]</center></td>";
    print "<td class='news'><center>$contenu[nomclient]</center></td>";
    // Selection des informations associés au client
	$requete1 = @mysql_db_query($nomdelabdd,"SELECT c.adresseclient,c.telclient,v.nomville,p.nompays
											 FROM client c,ville v,pays p
											 WHERE c.idville=v.idville
											 AND c.idpays=p.idpays
											 AND c.codeclient='$contenu[codeclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$contenu1 = mysql_numrows($requete1); 
	print "<td class='anotation'>";
	// Cas ou le lien contact n'existe pas
	if ($contenu1 == NULL){echo "<li><font color='#CE3A05'><b>Aucune Information n'est associ&eacute; au Client</b></font>";}
	else
	{
	while($contenu1 = @mysql_fetch_array ($requete1))
		{	
		print "<li> $contenu1[adresseclient]<br>
			   <li> $contenu1[telclient]<br>
			   <li> $contenu1[nomville]<br>
			   <li> $contenu1[nompays]";
		}
	}
	print "</td>";
	$nomdelabdd2="statistique";        // le nom de la Base de données 
	@mysql_select_db($nomdelabdd2, $bdd);                                // sélection de la Base de données
	// Affichage du Host, du navigateur et de l'adresse l'ip
	$ip=$REMOTE_ADDR; // Récupère l'adresse IP 
	$iptemp=strrpos($ip,'.');   // Modification de l'ip pour traitement avec mysql
	$ip=substr_replace($ip,'',$iptemp);
	$req_sel_ip = @mysql_db_query($nomdelabdd2,"SELECT codehotel FROM hotel 
	 									 	    WHERE iphotel='$ip'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$val_sel_ip = @mysql_fetch_array ($req_sel_ip);
	// On teste pour savoir si c un hotel en connexion ou le siege
	if ($val_sel_ip['codehotel'] == NULL)
	{
	$requete2 = @mysql_db_query($nomdelabdd2,"SELECT a.*,m.*
											  FROM annulation a,motif m
											  WHERE a.idclient=\"$contenu[codeclient]\"
											  AND a.idmotif=m.idmotif
											  ORDER BY a.idannul DESC
											  LIMIT 0,5")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$contenu2 = mysql_numrows($requete2); 
	}
	else
		{
		$requete2 = @mysql_db_query($nomdelabdd2,"SELECT a.*,m.*,h.nomhotel
											  	  FROM annulation a,motif m,hotel h
											  	  WHERE idclient=\"$contenu[codeclient]\"
											 	  AND a.idhotel=\"$val_sel_ip[codehotel]\"	
											 	  AND a.idhotel=h.codehotel
												  AND a.idmotif=m.idmotif										  
											  	  ORDER BY a.idannul DESC
											  	  LIMIT 0,5")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
		$contenu2 = mysql_numrows($requete2); 	
		}
	print "<td>";
	if ($contenu2 == NULL){echo "<li><font color='#CE3A05'><b>Aucune Annulation</b></font>";}
	else
	{
	while($contenu2 = @mysql_fetch_array ($requete2))
		{	
		@$datej = transformfrench_date($contenu2[datejannul]);
		if ($contenu2[nomhotel] == NULL) {$contenu2[nomhotel]= 'Le siège';}
		print "<U><a href='#' class='menu' onClick=window.open('annulation.php?ok=modif&id=$contenu2[idannul]','produit','scrollbars=no,resizable=no,left=10,top=50,width=800,height=250')>$contenu2[nomhotel] le $datej</a></U> :<br>$contenu2[nommotif], $contenu2[prixannul] &euro;<br>";
		}
	}
	print "</td>";
	print "<td><center><a href='#' onClick=window.open('annulation.php?code=$contenu[codeclient]','produit','scrollbars=yes,resizable=no,left=10,top=50,width=800,height=250')><img src='images/annul.gif' border=0 align=absmiddle alt='Insertion nouvelle Annulation'></a></center></td>";		
	// On teste pour savoir si c un hotel en connexion ou le siege
	if ($val_sel_ip['codehotel'] == NULL)
	{
	$requete3 = @mysql_db_query($nomdelabdd2,"SELECT r.*,m.*
											  FROM refus r,motif m
											  WHERE idclient=\"$contenu[codeclient]\"
											  AND r.idmotif=m.idmotif
											  ORDER BY idrefus DESC
											  LIMIT 0,5")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$contenu3 = mysql_numrows($requete3); 
	}
	else
		{
		$requete3 = @mysql_db_query($nomdelabdd2,"SELECT r.*,m.*,h.nomhotel
											  	  FROM refus r,motif m,hotel h
											  	  WHERE idclient=\"$contenu[codeclient]\"
											  	  AND idetablis=\"$val_sel_ip[codehotel]\"
											  	  AND r.idetablis=h.codehotel
												  AND r.idmotif=m.idmotif
											  	  ORDER BY idrefus DESC
											  	  LIMIT 0,5")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
		$contenu3 = mysql_numrows($requete3); 	
		}
	print "<td>";
	if ($contenu3 == NULL){echo "<li><font color='#CE3A05'><b>Aucun Refus</b></font>";}
	else
	{
	while($contenu3 = @mysql_fetch_array ($requete3))
		{	
		$date_saisiref = transformfrench_date($contenu3[date_saisiref]);
		if ($contenu3[nomhotel] == NULL) {$contenu3[nomhotel]= 'Le siège';}
		print "<U><a href='#' class='menu' onClick=window.open('refus.php?ok=modif&id=$contenu3[idrefus]','produit','scrollbars=no,resizable=no,left=10,top=50,width=800,height=250')>$contenu3[nomhotel] le $date_saisiref</U></a> :<br>$contenu3[chambre_refus], $contenu3[nommotif], $contenu3[segmen_refus].<br>";
		}
	}	
	print "</td>";
	print "<td><center><a href='#' onClick=window.open('refus.php?code=$contenu[codeclient]','produit','scrollbars=yes,resizable=no,left=10,top=50,width=800,height=250')><img src='images/refus.gif' align=absmiddle border=0 alt='Insertion nouveau Refus'></a></center></td>";
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
/* pour libérer la mémoire */
mysql_free_result($requete); 
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
}
else
{
?>
<div align='left' class='titre'><h3>Saisie des Annulations et Refus...</h3></div>
<form name="form1" action="recherchealiment.php" methode="POST" onSubmit="return controle();">
  Taper un Nom de Client 
  <input type="text" name="nom">
  ou le Code du Client 
  <input type="text" name="cod">
  <input type="hidden" name="formulaire" value="ok">
  <input type="submit" name="rechercher" value="Rechercher">
  <input type="reset" name="effacer" value="Effacer">  
 </form>
<?php
}
?>
</body>
</html>