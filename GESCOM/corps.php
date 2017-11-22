<? include("Admin/sessions.php") ?>
<html lang="fr">
<head>
<base target="corps">
<link rel="stylesheet" href="sofibra.css" type="text/css">
</head>
<body>

 <table border="0" width="640" cellspacing="0" cellpadding="0" height="423">
  <tr>
    <td>	
<?php
include("Admin/includes/fonctions.php");        //Connection Ю la SGBD
// Initialisation des variables
if ( ! isset($Year)) $Year=NULL;

$NomDuJour = array ("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");                                                    // crИation d'un tableau virtuel contenant les noms des jours
$NomDuMois = array ("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");   // crИation d'un tableau virtuel contenant les noms des mois
$nomdelabdd="authentique";        // le nom de la Base de donnИes 
$lejour = date("d");          // dit au script que la variable "$lejour" correspond Ю "day"
$lemois = date("m");         // dit au script que la variable "$lemois" correspond Ю "month"
$annee  = date("Y");        // dit au script que la variable "$annee" correspond Ю "Year"
$icone="calendrier.gif";                               // par dИfaut, l'icТne utilisИe est le calendrier-logo de Holy Days !
$altimg="Fête du Jour : Origine et Histoire...";      // par dИfaut, la lИgende de l'icТne

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection Ю la Base de donnИes
@mysql_select_db($nomdelabdd, $bdd);                                // sИlection de la Base de donnИes

$requete = @mysql_db_query($nomdelabdd,"select fetedujour from holydays where lejour=$lejour AND lemois=$lemois");    // recherche de la fЙte enregistrИe pour le jour et le mois en cours
$resultat = @mysql_result($requete,0,fetedujour);

$requetea = @mysql_db_query($nomdelabdd,"SELECT * FROM utilisateur WHERE idutil='$log'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenua = @mysql_fetch_array ($requetea);

$requeteb = @mysql_db_query($nomdelabdd,"SELECT * 
										 FROM news 
										 ORDER BY idnews DESC 
										 LIMIT 0,5")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");

@mysql_close();          // spИcifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin

if($requete){         // si la connection Ю la base MySQL rИussit, le script affiche les donnИes entre les accolades

print("<div align='center' class='titre'><h3>Bienvenue $contenua[prenom] $contenua[nom].</h3></div>");
print("<div class='text' align='center'>Nous sommes le ");        // ouvre la balise "font" qui dИfinit le style, la couleur et la taille de la police utilisИe, ainsi que les polices de sustitutions, pour afficher ce qui suit
print($NomDuJour[ date("w") ]);                                                     // affiche le nom du jour

if($lejour==01){ print(" 1er "); }                  // s'il s'agit du premier jour du mois on affiche "1er"
else if($lejour<10){ print(" $lejour[1] "); }      // sinon, s'il s'agit des 9 premiers jours du mois, on affiche le deuxiХme chiffre seulement (pas le zИro)
else { print(date (" d ")); }                     // sinon la date s'affiche normalement (2 chiffres)

print($NomDuMois[ date($lemois - 1) ]);           // affiche le nom du mois
print(date (" Y"));                              // affiche l'annee en 4 chiffres
print(" et l'on souhaite la $resultat");              // affiche la fete du jour

if(file_exists("Admin/includes/religion.php")){include("Admin/includes/religion.php");}   
if(file_exists("Admin/includes/saison.php")){include("Admin/includes/saison.php");}    
if(file_exists("Admin/includes/occasion.php")){include("Admin/includes/occasion.php");}  

print(" <a href=\"#\" onClick=\"window.open('http://holydays.free.fr/holydays.htm','holydays','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=380,height=139')\"><img src='images/$icone' width='16' height='16' align='absmiddle' border='0' alt=\"$altimg\"></a><br>");       // affichage de l'icТne cliquable                                                                                 
print("</div><br>");            // ferme la balise "div" (alignement)
}

// Relance pour les commerciaux uniquements
if ($contenua[groupe] == '4')
{
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection Ю la Base de donnИes
$nomdelabdd="commercial";        // le nom de la Base de donnИes 
@mysql_select_db($nomdelabdd, $bdd);                                // sИlection de la Base de donnИes$lejourplussem = $lejour + 7 ;

$req_comm = @mysql_db_query($nomdelabdd,"SELECT COUNT(idsuivi) AS nombre FROM suivi 
WHERE futursuivi BETWEEN $annee-$lemois-$lejour AND $annee-$lemois-$lejourplussem
AND idrce=$contenua[rce]");
$val_comm = @mysql_fetch_array ($req_comm);
if ($val_comm[nombre] <> NULL)
	{
	echo "<blink><font color='#CE3A05'><b>***ATTENTION*** Vous avez $val_comm[nombre] Relances &agrave; faire pour cette semaine</b></font></blink>";
	}
@mysql_close();
}


$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection Ю la Base de donnИes
$nomdelabdd="authentique";        // le nom de la Base de donnИes 
@mysql_select_db($nomdelabdd, $bdd);                                // sИlection de la Base de donnИes
$req_auth = @mysql_db_query($nomdelabdd,"SELECT COUNT(idutil) AS idutil FROM utilisateur");
@mysql_close();          // specifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection Ю la Base de donnИes
$nomdelabdd="statistique";        // le nom de la Base de donnИes 
@mysql_select_db($nomdelabdd, $bdd);                                // sИlection de la Base de donnИes
$req_stat = @mysql_db_query($nomdelabdd,"SELECT COUNT(idstat) AS idstat FROM statistique");
@mysql_close();          // spИcifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection Ю la Base de donnИes
$nomdelabdd="commercial";        // le nom de la Base de donnИes 
@mysql_select_db($nomdelabdd, $bdd);                                // sИlection de la Base de donnИes
$req_comm = @mysql_db_query($nomdelabdd,"SELECT COUNT(idclient) AS idclient FROM client");
$req_comm1 = @mysql_db_query($nomdelabdd,"SELECT COUNT(idclient) AS idclient 
										  FROM client
										  WHERE idrce=\"$contenua[siglerce]\"");
$req_comm2 = @mysql_db_query($nomdelabdd,"SELECT COUNT(idcontact) AS idcontact
										  FROM contact
										  WHERE idrce=\"$contenua[siglerce]\"");
$req_comm3 = @mysql_db_query($nomdelabdd,"SELECT COUNT(idsuivi) AS idsuivi
										  FROM suivi
										  WHERE idrce=\"$contenua[siglerce]\"");

@mysql_close();          // spИcifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin

$val_auth = @mysql_fetch_array ($req_auth);
$val_stat = @mysql_fetch_array ($req_stat);
$val_comm = @mysql_fetch_array ($req_comm);
$val_comm1 = @mysql_fetch_array ($req_comm1);
$val_comm2 = @mysql_fetch_array ($req_comm2);
$val_comm3 = @mysql_fetch_array ($req_comm3);

echo "<div class='anotation'><SCRIPT language='Javascript' src='nbconnectes.php?action=show'></SCRIPT></div>";
echo "<div align='left' class='text'><h3>Informations diverses...<br></h3>";
echo "<center>";
echo "<table width='80%' border='0' CELLPADDING=0 CELLSPACING=0 class='text'> 
						<tr> 
							<td bgcolor='#FFFF9B' class='news'><div style='margin-left:5px' align='center'>[ Actuellement sur Gescom ]</div></td> 
							<td bgcolor='#FFFF9B' class='news'><div style='margin-left:5px' align='center'>[ Actuellement sur votre Compte ]</div></td>
						</tr> 
						<tr> 
							<td><div align='center' class='anotation'>
							<b>$val_auth[idutil]</b> utilisateurs,
							<br>
							<b>$val_stat[idstat]</b> fiches Statistique,
							<br>
							<b>$val_comm[idclient]</b> fiches Commerciale.</div></td>
							<td><div align='center' class='anotation'>
							<b>$val_comm1[idclient]</b> fiches Client,
							<br>
							<b>$val_comm2[idcontact]</b> fiches Contact,
							<br>
							<b>$val_comm3[idsuivi]</b> fiches de Suivi.</div></td>
						</tr> 
		  </table>";
echo "</center>";

echo "<div align='left' class='text'><h3>Les derni&egrave;res news...<br></h3>";
echo "<center>";
while($contenu = @mysql_fetch_array ($requeteb)) 
	{  
	// Remplacement des retours a la ligne \n par des <br> 
	$texte = $contenu['texte']; 
	$texte = nl2br($texte);	 
	$contenu['date_verif'] = mysql_mktime($contenu['date_verif']); 
	$date = date('d/m/Y @ H:i',$contenu['date_verif']); 
	
	echo "<table width='80%' border='0' CELLPADDING=0 CELLSPACING=0 class='text'> 
						<tr> 
							<td bgcolor='#FFFF9B' class='news'><div style='margin-left:5px'>[ $contenu[titre] ]</div></td> 
							<td bgcolor='#FFFF9B'><div align='right' style='margin-right:5px' class='date'>le $date</div></td> 
						</tr> 
						<tr> 
							<td colspan='2'><div style='margin-left:5px;margin-right:5px;margin-top:5px;margin-bottom:5px'>$texte<br><br> 
								</div></td> 
						</tr> 
		  </table>";
	}
?>
<A class='menu' HREF="mailto:caroff@hotel-sofibra.com">Copyright <? echo "$annee"; ?> Groupe Hotelier SOFIBRA &copy;</A> <b>Version 2.9</b>
	  </td>
  </tr>
  </center>
</table>
</body>
</html>