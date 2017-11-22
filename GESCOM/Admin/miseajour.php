<? include("sessions.php") ?>
<?php
switch ($type) {    

case 'nouveau': 

include("includes/fonctions.php");        // Encapsulation de fonction PHP

$bdd=mysql_connect( $nomhote, $identifiant , $motdepasse );  // Connection a la base MySQL
$nomdelabdd="authentique";        // le nom de la Base de données 
$requete = @mysql_db_query($nomdelabdd,"SELECT *
										FROM groupe
										ORDER BY idgroupe ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin

$bdd=mysql_connect( $nomhote, $identifiant , $motdepasse );  // Connection a la base MySQL
$nomdelabdd="statistique";        // le nom de la Base de données 
$requete1 = @mysql_db_query($nomdelabdd,"SELECT *
										 FROM hotel
										 WHERE codehotel <> ''
										 ORDER BY nomhotel ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
?>
<html>
<title>Nouvel Utilisateur</title>
<link rel="stylesheet" href="../sofibra.css" type="text/css">
<h3><center>Ajout d'un Nouveau Utilisateur</center></h3>
<form name="form1" action="miseajour.php" methode="POST">
  <center>
  <input type="submit" name="type" value="Ajouter">&nbsp;&nbsp;
  <input type="button" name="fermer" value="Fermer" onClick="window.close()">
  </center>
  <div id="calque1" style="position:absolute; left:50px; top:90px; height:197px; z-index:1"> 
  Nom
  <input type="text" name="nom" size="15" maxlength="30">&nbsp;&nbsp;
  Pr&eacute;nom
  <input type="text" name="prenom" size="15" maxlength="30">
  </div>
  <div id="calque2" style="position:absolute; left:44px; top:127px; height:197px; z-index:1"> 
  Login
  <input type="text" name="loginutil" size="15" maxlength="15">&nbsp;&nbsp;
  Mot de Passe
  <input type="text" name="passe" size="10" maxlength="10"><br><br>
  </div>   
  <div id="calque3" style="position:absolute; left:52px; top:164px; height:197px; z-index:1"> 
  	RCE <input type="text" name="sigle" size="3" maxlength="3">
	</div>
    <div id="calque4" style="position:absolute; left:173px; top:164px; height:197px; z-index:1"> 
  Tranches
  <input type="text" name="nummin" size="6" maxlength="6">&nbsp;--
  <input type="text" name="nummax" size="6" maxlength="6">
  </div>   
  <div id="calque4" style="position:absolute; left:37px; top:201px; height:197px; z-index:1"> 
  Groupe
  <select name="groupe">
	<? while ($val = mysql_fetch_array($requete)) { ?>
    <option value='<?php echo "$val[idgroupe]"; ?>'><? echo $val["nomgroupe"]; ?></option>
	<? } ?>
    </select>
   </div>
   <div id="calque5" style="position:absolute; left:75px; top:238px; height:197px; z-index:1"> 
   H&ocirc;tel(s) associ&eacute;(s) : <br>
     <? 
	 echo"<input type='checkbox' name='hotel_avec' value='1'>TOUS les H&ocirc;tels<br>";
	 echo"<input type='checkbox' name='hotel_sans' value='1'>AUCUN des H&ocirc;tels<br>";
	 // Affichage de tous les hotels avec possiblité de selection multiple	 
	 $i = 0; 	
	 while ($val1 = mysql_fetch_array($requete1)) 
	 {		 
	 echo"<input type='checkbox' name='hotel_sel[]' value='$val1[codehotel]'>$val1[nomhotel]<br>";
	 $i++;
	 } 
	 ?>    
	 <br><br>
	</div>		
 </form>
</html>
<?php     
break; 

// Ajout d'un nouvel utilisateur
case 'Ajouter':        

include("includes/fonctions.php");        // Encapsulation de fonction PHP

$bdd=mysql_connect( $nomhote, $identifiant , $motdepasse );  // Connection a la base MySQL
// Petit changement pour les hotels
$nb = sizeof($hotel_sel);
for ($h=0;$h<$nb;$h++)
			{	
			$hotel_sel_ho = $hotel_sel_ho . $hotel_sel[$h].",";
			}

$nomdelabdd="authentique";        // le nom de la Base de données 
$requete = @mysql_db_query($nomdelabdd,"INSERT INTO utilisateur(
										login,
										pwd,
										nom,
										prenom,
										siglerce,
										groupe,
										nummin,
										nummax,
										hotel_sans,
										hotel_avec,
										hotel_sel)
										VALUES (
										\"$loginutil\",
										\"$passe\",
										\"$nom\",
										\"$prenom\",
										\"$sigle\",
										\"$groupe\",
										\"$nummin\",
										\"$nummax\",
										\"$hotel_sans\",
										\"$hotel_avec\",
										\"$hotel_sel_ho\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Fenetre popup children avec fermeture + rechargement de la page mere
echo "<html><head>";
echo "<script language='JavaScript1.2'>
	  window.location; self.close();
	  opener.document.location.reload(); 
	  </script>";
echo "</head></html>";
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
break;       

case 'modif':        

include("includes/fonctions.php");        // Encapsulation de fonction PHP

$bdd=mysql_connect( $nomhote, $identifiant , $motdepasse );  // Connection a la base MySQL
$nomdelabdd="authentique";        // le nom de la Base de données 
$requete = @mysql_db_query($nomdelabdd,"SELECT *
										FROM utilisateur
										WHERE idutil=\"$code\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu = @mysql_fetch_array ($requete);
$requete1 = @mysql_db_query($nomdelabdd,"SELECT *
										 FROM groupe
										 ORDER BY nomgroupe ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");

$nomdelabdd="statistique";        // le nom de la Base de données 
$requete2 = @mysql_db_query($nomdelabdd,"SELECT *
										 FROM hotel
										 WHERE codehotel <> ''
										 AND iphotel <> '192.168.100'
										 ORDER BY nomhotel ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
?>
<html>
<title>Modification d'un Utilisateur</title>
<link rel="stylesheet" href="../sofibra.css" type="text/css">
<h3><center>Modification de <?php echo "$contenu[prenom] $contenu[nom]"; ?></center></h3>
<form name="form1" action="miseajour.php" methode="POST">
 <input type="hidden" name="code" value='<?php echo "$code"; ?>'> 
  <center>
  <input type="submit" name="type" value="Modifier">&nbsp;&nbsp;
  <input type="button" name="fermer" value="Fermer" onClick="window.close()">
  </center>
  <div id="calque1" style="position:absolute; left:50px; top:90px; height:197px; z-index:1"> 
  Nom
  <input type="text" name="nom" size="15" maxlength="30" value='<?php echo "$contenu[nom]"; ?>'>&nbsp;&nbsp;
  Pr&eacute;nom
  <input type="text" name="prenom" size="15" maxlength="30" value='<?php echo "$contenu[prenom]"; ?>'>
  </div>
  <div id="calque2" style="position:absolute; left:44px; top:127px; height:197px; z-index:1"> 
  Login
  <input type="text" name="loginutil" size="15" maxlength="15" value='<?php echo "$contenu[login]"; ?>'>&nbsp;&nbsp;
  Mot de Passe
  <input type="text" name="passe" size="10" maxlength="10" value='<?php echo "$contenu[pwd]"; ?>'><br><br>
  </div>   
  <div id="calque3" style="position:absolute; left:52px; top:164px; height:197px; z-index:1"> 
  	RCE <input type="text" name="sigle" size="3" maxlength="3" value='<?php echo "$contenu[siglerce]"; ?>'>
	</div>
    <div id="calque4" style="position:absolute; left:173px; top:164px; height:197px; z-index:1"> 
  Tranches
  <input type="text" name="nummin" size="6" maxlength="6" value='<?php echo "$contenu[nummin]"; ?>'>&nbsp;--
  <input type="text" name="nummax" size="6" maxlength="6" value='<?php echo "$contenu[nummax]"; ?>'>
  </div>   
  <div id="calque4" style="position:absolute; left:37px; top:201px; height:197px; z-index:1"> 
  Groupe
  <select name="groupe">
	<? while ($val = mysql_fetch_array($requete1)) 
		{ 
    if ($contenu["groupe"] == $val["idgroupe"]) 
	{ 
	echo "<option value=\"".$val["idgroupe"]."\" selected>".$val["nomgroupe"]."</option>\n"; 
	} 
	else 
	{ 
	echo "<option value=\"".$val["idgroupe"]."\">".$val["nomgroupe"]."</option>\n"; 
	} 
		}
	?>
    </select>
   </div>
   <div id="calque5" style="position:absolute; left:75px; top:238px; height:197px; z-index:1"> 
   H&ocirc;tel(s) &agrave; associ&eacute;(s) : <br>
    <input type='checkbox' name='hotel_avec' value='1'>TOUS les H&ocirc;tels<br>
    <input type='checkbox' name='hotel_sans' value='1'>AUCUN des H&ocirc;tels<br>
	<?
	while ($val = @mysql_fetch_array ($requete2))
		{
		echo "<input type='checkbox' name='hotel_sel[]' value='$val[codehotel]'>$val[nomhotel]<br>";
		}
     ?>   
	 <br><br> 
</div>   
 </form>
</html>
<?
break;

case 'Modifier':      
  
include("includes/fonctions.php");        // Encapsulation de fonction PHP

$bdd=mysql_connect( $nomhote, $identifiant , $motdepasse );  // Connection a la base MySQL
$nomdelabdd="authentique";        // le nom de la Base de données 

// Petit changement pour les hotels
$nb = sizeof($hotel_sel);
for ($h=0;$h<$nb;$h++)
			{	
			$hotel_sel_ho = $hotel_sel_ho . $hotel_sel[$h].",";
			}

if ($hotel_sans <> NULL || $hotel_avec <> NULL || $hotel_sel_ho <> NULL)
{
$requete = @mysql_db_query($nomdelabdd,"UPDATE utilisateur SET
										login=\"$loginutil\",
										pwd=\"$passe\",
										nom=\"$nom\",
										prenom=\"$prenom\",
										siglerce=\"$sigle\",
										groupe=\"$groupe\",
										nummin=\"$nummin\",
										nummax=\"$nummax\",
										hotel_sans=\"$hotel_sans\",
										hotel_avec=\"$hotel_avec\",
										hotel_sel=\"$hotel_sel_ho\"
										WHERE idutil=\"$code\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}
else
{
$requete = @mysql_db_query($nomdelabdd,"UPDATE utilisateur SET
										login=\"$loginutil\",
										pwd=\"$passe\",
										nom=\"$nom\",
										prenom=\"$prenom\",
										siglerce=\"$sigle\",
										groupe=\"$groupe\",
										nummin=\"$nummin\",
										nummax=\"$nummax\"
										WHERE idutil=\"$code\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}
// Fenetre popup children avec fermeture + rechargement de la page mere
echo "<html><head>";
echo "<script language='JavaScript1.2'>
	  window.location; self.close();
	  opener.document.location.reload(); 
	  </script>";
echo "</head></html>";
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin

break; 
   
case 'supp': 
       
include("includes/fonctions.php");        // Encapsulation de fonction PHP

$bdd=mysql_connect( $nomhote, $identifiant , $motdepasse );  // Connection a la base MySQL
$nomdelabdd="authentique";        // le nom de la Base de données 
$requete = @mysql_db_query($nomdelabdd,"SELECT *
										FROM utilisateur
										WHERE idutil=\"$code\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu = @mysql_fetch_array ($requete);
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
?>
<html>
<title>Suppression d'un Utilisateur</title>
<link rel="stylesheet" href="../sofibra.css" type="text/css">
<h3><center>Suppression de <?php echo "$contenu[nom] $contenu[prenom]"; ?></center></h3>
<form name="form1" action="miseajour.php" methode="POST">
  <input type="hidden" name="code" value='<?php echo "$code"; ?>'>
  &Ecirc;tes vous s&ucirc;r de vouloir supprimer <?php echo "$contenu[nom] $contenu[prenom]"; ?>? 
  <br><br>
  <div align="right"><input type="submit" name="type" value="Supprimer">
  <input type="button" name="fermer" value="Fermer" onClick="window.close()"></div>
  </div>
 </form>
</html>
<?
break;    

case 'Supprimer':
        
include("includes/fonctions.php");        // Encapsulation de fonction PHP

$bdd=mysql_connect( $nomhote, $identifiant , $motdepasse );  // Connection a la base MySQL
$nomdelabdd="authentique";        // le nom de la Base de données 
$requete = @mysql_db_query($nomdelabdd,"DELETE FROM utilisateur
										WHERE idutil=\"$code\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Fenetre popup children avec fermeture + rechargement de la page mere
echo "<html><head>";
echo "<script language='JavaScript1.2'>
	  window.location; self.close();
	  opener.document.location.reload(); 
	  </script>";
echo "</head></html>";
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
break;
}
?>