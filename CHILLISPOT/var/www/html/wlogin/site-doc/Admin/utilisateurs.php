<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Administration SOFIBRA</title>
<base target="corps">
<link rel="stylesheet" href="../style/styles.css" type="text/css">
<body>
<center><h3>Listing Complet des Utilisateurs WifiOceaniaHotels</h3></center>
<?php
include("fonctions.php");
$ip = $REMOTE_ADDR;
$ip = explode(".",$ip);
$ip = "$ip[0].$ip[1].$ip[2]";

$bdd=mysql_connect( $nomhote, $identifiant , $motdepasse );  // Connection a la base MySQL
$nomdelabdd="freeradius";        // le nom de la Base de donnИes 

// ########## Nbre d'affichages par pages, Ю adapter
$nb = 10;
// ########## Initialisation
if(empty($page)) $page = 1;
if(empty($contenu))            // Nombre total de rИsultats
{ 
@mysql_select_db($nomdelabdd, $bdd);                                // sИlection de la Base de donnИes
// Connection par le siège
if ($ip == "192.168.100")
{
$requete = @mysql_db_query($nomdelabdd,"SELECT *
					FROM radcheck
					GROUP BY UserName 
					ORDER BY UserName ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}
// Connection par l'hotel
if ($ip <> "192.168.100")


{
$req_bis = @mysql_db_query($nomdelabdd,"SELECT *
                                        FROM hotel
                                        WHERE adresse_prive=\"$ip\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$data_bis = @mysql_fetch_array ($req_bis);
$requete = @mysql_db_query($nomdelabdd,"SELECT r.*
                                        FROM radcheck r,radacct a
					WHERE a.FramedIPAddress LIKE '$data_bis[adresse_int]%'
                                        GROUP BY r.UserName
                                        ORDER BY r.UserName ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}


$contenu = mysql_numrows($requete); 
}

print "La recherche a donn&eacute; $contenu r&eacute;sultats<p></p>";
print "<table align='center' border='0' cellspacing='0' cellpadding='0' width='600'>
  <tr>
    <td><img src='../images/hg.gif' width='7' height='7' /></td>
    <td><img src='../images/h.gif' width='600' height='7' /></td>
    <td><img src='../images/hd.gif' width='7' height='7' /></td>
  </tr>
  <tr>
    <td background='../images/g.gif'>&nbsp;</td>
    <td>";
print "<table>";
print "<tr>  
	<td width='20%' class='news'> 
      <div align='center'><b>Login</b></div>
    </td>
	<td width='10%' class='news'> 
      <div><b>Mot de Passe</b></div>
    </td>  
	<td width='20%' class='news'> 
      <div align='center'><b>D&eacute;but de connexion</b></div>	  
    </td>	
	<td width='20%' class='news'> 
      <div align='center'><b>Fin de connexion</b></div>
    </td>  
	<td width='10%' class='news'> 
     <div align='center'><b>Temps de connexion</b></div>
    </td>
	<td width='10%' class='news'>
     <div align='center'><b>Forfait</b></div>
    </td>
	<td width='10%' class='news'>
     <div align='center'><b>Adresse IP</b></div>
    </td>
  </tr>";

// ########## Calcul du nombre de pages
$nbpages = ceil($contenu / $nb); // arrondi l'entier supИrieur
// ########## On determine debut du limit
$debut = ($page - 1) * $nb;
// Calcul du nombre d'enregistrements
// Connection par le siège
if ($ip == "192.168.100")
{
$requete = @mysql_db_query($nomdelabdd,"SELECT *
					FROM radcheck
					GROUP BY UserName
					ORDER BY UserName ASC
					LIMIT $debut,$nb")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}
// Connection hotel
if ($ip <> "192.168.100")

{
$requete = @mysql_db_query($nomdelabdd,"SELECT r.*
                                        FROM radcheck r,radacct a
                                        WHERE a.FramedIPAddress LIKE '$data_bis[adresse_int]%'
                                        GROUP BY r.UserName
                                        ORDER BY r.UserName ASC
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

while($contenu = @mysql_fetch_array ($requete))
	{
	$req_sel = @mysql_db_query($nomdelabdd,"SELECT *,SUM(AcctSessionTime) AS temps_utilise,MAX(AcctStopTime) AS temps_max
                                        FROM radacct
					WHERE UserName=\"$contenu[UserName]\"
                                        GROUP BY UserName")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$data = @mysql_fetch_array ($req_sel);
	print "<tr><td class='anotation'>$contenu[UserName]</td>";
	print "<td class='anotation'><center>$contenu[Value]</center></td>";	
	print "<td class='anotation'><center>$data[AcctStartTime]</center></td>";
	print "<td class='anotation'><center>$data[temps_max]</center></td>";
	print "<td class='anotation'><center>$data[temps_utilise]</center></td>";
	print "<td class='anotation'><center>$contenu[forfait]</center></td>";
	print "<td class='anotation'><center>$data[FramedIPAddress]</center></td>";

	print "<td><center>
	<input type='button' value='Supprimer' onClick=window.open('ajout.php?ok=Supp&id=$contenu[id]','visu','left=200,top=150,width=400,height=130,scrollbars=no,resizable=no')>
	</center></td>";	
	}
@mysql_close();

print "</tr>";
print "</table>";
print "</td>
    <td background='../images/d.gif'>&nbsp;</td>
  </tr>
  <tr>
    <td><img src='../images/bg.gif' width='7' height='7' /></td>
    <td><img src='../images/b.gif' width='600' height='7' /></td>
    <td><img src='../images/bd.gif' width='7' height='7' /></td>
  </tr>
</table>";
if(@$nbpages > 1){// ########## On affiche PrИcИdente si nbpages > 

if($page > 1)
{
$pageavant = $page -1;
$avant = "<a class='menu' href=\"$PHP_SELF?page=$pageavant&formulaire=ok\">Pr&eacute;c&eacute;dent </a>";
echo "$avant";
}
else
{
echo "Pr&eacute;c&eacute;dent";
}
echo "<<"; //Construction de la pagination

// ########## On affiche les liens pages (sans HREF sur la page en cours) si nbpages > 1
if($nbpages > 1)
{
for($i = 1;$i <= $nbpages;$i ++)
   {
   if($i != $page)
     {
     echo "<a class='menu' href=\"$PHP_SELF?page=$i&formulaire=ok\"> $i </a>";
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
$apres = "<a class='menu' href=\"$PHP_SELF?page=$pageapres&formulaire=ok\"> Suivant</a>";
echo "$apres";
}
else
{
echo "Suivant";
} 

}
?>
<p></p><center><input type='button' value='Nouveau Utilisateur' onClick=window.open('ajout.php','visu','left=200,top=150,width=450,height=400,scrollbars=yes,resizable=no')></center>
</body>
</html>
