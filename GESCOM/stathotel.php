<? include("Admin/sessions.php") ?>
<html>
<title>Gestion Commerciale SOFIBRA</title>
<base target="corps">
<link rel="stylesheet" href="sofibra.css" type="text/css">
<body>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<script src="fonction.js"></script>
<?php
if (@$formulaire=="ok")
{
?>  
<div align='left' class='titre'><h3>Statistiques par Hôtel...</h3></div>
  <form name="form1" action="stathotel.php" methode="POST" onSubmit="return controle();">
  Taper un Nom de Client 
  <input type="text" name="nom" value="<?php echo "$nom";?>">
  ou le Code du Client 
  <input type="text" name="cod" value="<?php echo "$cod"; ?>">
  pour l'année
  <select name="an">
  	<option value='2002' <? if ($an == 2002){echo "SELECTED";} ?>>2002</option>
	<option value='2003' <? if ($an == 2003){echo "SELECTED";} ?>>2003</option>
	<option value='2004' <? if ($an == 2004){echo "SELECTED";} ?>>2004</option>
	<option value='2005' <? if ($an == 2005){echo "SELECTED";} ?>>2005</option>
	<option value='2006' <? if ($an == 2006){echo "SELECTED";} ?>>2006</option>
	<option value='2007' <? if ($an == 2007){echo "SELECTED";} ?>>2007</option>
	<option value='2008' <? if ($an == 2008){echo "SELECTED";} ?>>2008</option>
	<option value='2009' <? if ($an == 2009){echo "SELECTED";} ?>>2009</option>
	<option value='2010' <? if ($an == 2010){echo "SELECTED";} ?>>2010</option>
  </select>
  <input type="hidden" name="formulaire" value="ok">
  <input type="submit" name="re" value="Rechercher">
</form>
<?php
include("Admin/includes/fonctions.php");        //Connection à la SGBD

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de données
$nomdelabdd="statistique";        // le nom de la Base de données 

// ########## Nbre d'affichages par pages, à adapter
$nb = 14;
// ########## Initialisation
if(empty($page)) $page = 1;
if(empty($contenu))            // Nombre total de résultats
{ 
@mysql_select_db($nomdelabdd, $bdd);                                // sélection de la Base de données
	// On recupere le $sofibra pour l'hotel et savoir kwa afficher
	// Cas ou l'utilisateur peut voir tous les hotels
	if ($sofibra_avec == 1)
	{
	$requete = @mysql_db_query($nomdelabdd,"SELECT codeclient,nomclient,codetablis
											FROM statistique 
											WHERE annee='$an'
											AND nomclient LIKE \"%$nom%\"
											AND codeclient LIKE '$cod%'
											GROUP BY codetablis,codeclient,nomclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$contenu = mysql_numrows($requete); 
	}
	// Cas ou l'utilisateur est limite a aucun hotel
	elseif ($sofibra_sans == 1)
	{
	// On affiche un tableau vide
	}	
	// Cas ou l'utilisateur est limité a x hotels	
	else
		{
		// Affichage de tous les hotels
	 	$tab = explode(",",$sofibra_sel);
	 	// Nombre dhotel pour un utilisateur
	 	$taille = sizeof($tab);	 	
		for ($boucle=0;$boucle < $taille;$boucle++)
				{
				$tableau[$boucle]="'$tab[$boucle]'";
				}
		$tableau = implode(",",$tableau);
		$requete = @mysql_db_query($nomdelabdd,"SELECT codeclient,nomclient,codetablis
												FROM statistique 
												WHERE annee='$an'
												AND nomclient LIKE \"%$nom%\"
												AND codeclient LIKE '$cod%'
												AND codetablis IN ($tableau)
												GROUP BY codetablis,codeclient,nomclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
		$contenu = mysql_numrows($requete); 
		}
}
if ($contenu == 0)
{print ("<h3><center>Actuellement, il n'existe aucune statistique pour le Client $nom.</center></h3>");}
else
{
print "La recherche a donné $contenu résultats.<br><br>";
print "<table width='100%' border='1'>";
print "<tr bgcolor='#FFFF9B' class='news'>  
	<td width='8%'> 
      <div align='center'><b>Hôtel</b></div>
    </td> 
	<td width='10%'> 
      <div align='center'><b>Nuit&eacute; Total</b></div>
    </td>  
	<td width='10%'> 
      <div align='center'><b>Nbre Client Total</b></div>
    </td> 
	<td width='10%'> 
      <div align='center'><b>CA Total</b></div>
    </td> 
    <td width='27%'> 
      <div align='center'><b>Nom du Client</b></div>
    </td>	
    <td width='10%'> 
      <div align='center'><b>Code du Client</b></div>
    </td>	 
	<td width='10%'> 
      <div align='center'><b>S&eacute;lection</b></div>
    </td>   
  </tr>";
// ########## Calcul du nombre de pages
$nbpages = ceil($contenu / $nb); // arrondi à l'entier supérieur
// ########## On determine debut du limit
$debut = ($page - 1) * $nb;
	// ########## Requete sélection limitée
	// On recupere le $sofibra pour l'hotel et savoir kwa afficher
	// Cas ou l'utilisateur peut voir tous les hotels
	if ($sofibra_avec == 1)
	{
	$requete = @mysql_db_query($nomdelabdd,"SELECT codeclient,siglehotel,nomclient,SUM(catotal) AS catotal,SUM(nbreclient) AS nbreclient,SUM(nuite) AS nuite,codetablis
											FROM statistique s,hotel h 
											WHERE s.codetablis=h.codehotel
											AND s.annee='$an'
											AND s.nomclient LIKE \"%$nom%\"
											AND s.codeclient LIKE '$cod%'	
											GROUP BY s.codetablis,s.codeclient,s.nomclient	
											ORDER BY s.codetablis,s.nomclient											
											LIMIT $debut,$nb")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
	// Cas ou l'utilisateur est limité a x hotels	
	else
		{
		$requete = @mysql_db_query($nomdelabdd,"SELECT codeclient,siglehotel,nomclient,SUM(catotal) AS catotal,SUM(nbreclient) AS nbreclient,SUM(nuite) AS nuite,codetablis
												FROM statistique s,hotel h 
												WHERE s.codetablis=h.codehotel
												AND s.annee='$an'
												AND s.nomclient LIKE \"%$nom%\"
												AND s.codeclient LIKE '$cod%'	
												AND codetablis IN ($tableau)
												GROUP BY s.codetablis,s.codeclient,s.nomclient	
												ORDER BY s.codetablis,s.nomclient											
												LIMIT $debut,$nb")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
		}

if ($contenu > $nb)                  // Calcul du nombre de champ sur l'ecran pour la calculette javascript
{
$nbreligne=$nb;
}
else
{
$nbreligne=$contenu-$debut;
}
print "<form name='form2' action='#' method='POST'>"; // Formulaire pour la calculette
@$nbre==0;
while($contenu = @mysql_fetch_array ($requete))
{ 
@$nuite = $nuite+$contenu[nuite];
@$nbreclient = $nbreclient+$contenu['nbreclient'];
@$catotal = $catotal+$contenu['catotal'];
$contenu['catotal'] = str_replace(".",",",$contenu['catotal']);

print "<tr><td><a class='menu' href='statclient.php?ok=4&an=$an&stat=".addslashes(urlencode(serialize($contenu)))."'>$contenu[siglehotel]</a></td>";
print "<td><div align=right><b>$contenu[nuite]</b></div></td>";
print "<td><div align=right><b>$contenu[nbreclient]</b></div></td>";
print "<td><div align=right><b>$contenu[catotal] &euro;</b></div></td>";
print "<td><center>$contenu[nomclient]</center></td>";
print "<td><center>$contenu[codeclient]&nbsp;&nbsp;
	   <a href='#' onClick='Ouvrir(\"rechercheclient.php?code=$contenu[codeclient]\")'>
	   <img src='images/affiche.gif' align='absmiddle' border=0 alt='Informations sur le Client'></a></center></td>";
@print "<td><center><input type='checkbox' name='boite$nbre' OnClick='calculette($nbreligne);' value='$contenu[catotal]'></center></td>"; 
@$nbre++;
} 

$catotal = str_replace(".",",",$catotal);
print "</tr>";
print "<tr><td><center><i>TOTAL</i></center></td>";
print "<td><div align=right><b>$nuite</b></div></td>";
print "<td><div align=right><b>$nbreclient</b></div></td>";
print "<td><div align=right><b>$catotal &euro;</b></div></td>";
print "<td><center><i>TOTAL de la S&eacute;lection</i></center></td>";
print "<td></td>";
print "<td><center><input type='text' name='Total' size='12' READONLY></center></td></tr>";
print "</table>"; // On termine l'affichage du tableau 
print "</form>";
}
if(@$nbpages > 1){// ########## On affiche Précédente si nbpages > 
if(@$page > 1)
{
$pageavant = $page -1;
$avant = "<a class='menu' href=\"$PHP_SELF?page=$pageavant&nom=$nom&cod=$cod&an=$an&formulaire=ok\">Précédent </a>";
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
     echo "<a class='menu' href=\"$PHP_SELF?page=$i&nom=$nom&cod=$cod&an=$an&formulaire=ok\"> $i </a>";
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
$apres = "<a class='menu' href=\"$PHP_SELF?page=$pageapres&nom=$nom&cod=$cod&an=$an&formulaire=ok\"> Suivant</a>";
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
<div align='left' class='titre'><h3>Statistiques par Hôtel...</h3></div>
  <form name="form1" action="stathotel.php" methode="POST" onSubmit="return controle();">
  Taper un Nom de Client 
  <input type="text" name="nom">
  ou le Code du Client 
  <input type="text" name="cod">
  pour l'année
  <select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006'>2006</option>
	<option value='2007'>2007</option>
	<option value='2008' SELECTED>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
  </select>
  <input type="hidden" name="formulaire" value="ok">
  <input type="submit" name="re" value="Rechercher">
</form>
<?php
}
?>
</body>
</html>
