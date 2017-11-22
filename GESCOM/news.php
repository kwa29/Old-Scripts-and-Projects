<? include("Admin/sessions.php") ?>
<html>
<head>
<base target="corps">
<link rel="stylesheet" href="../sofibra.css" type="text/css">
<body>
<?php 
include("Admin/includes/fonctions.php");   

switch ($ok)
{

case 'Modifier':

$bdd=mysql_connect( $nomhote, $identifiant , $motdepasse );  // Connection a la base MySQL
$nomdelabdd="authentique";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);   								 // sélection de la Base de données

$req_insert = @mysql_db_query($nomdelabdd,"UPDATE news SET
										   titre=\"$titre\",
										   texte=\"$msg\"
										   WHERE idnews=$id")or die ("Erreur de requete: (ligne:". __LINE__." dans ".__FILE__.") mysql_error()");
mysql_close();

echo "<center>F&eacute;licitations !!!<br>";
echo "Votre message est modifi&eacute;.<br><br>
<a class='menu' href='corps.php'>Revenir &agrave; l'accueil</a><center>";
break;

case 'Envoyer':

$bdd=mysql_connect( $nomhote, $identifiant , $motdepasse );  // Connection a la base MySQL
$nomdelabdd="authentique";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);   								 // sélection de la Base de données

$req_insert = @mysql_db_query($nomdelabdd,"INSERT INTO news(
										   titre,
										   texte)
										   VALUES (										  
										   \"$titre\",
										   \"$msg\")")or die ("Erreur de requete: (ligne:". __LINE__." dans ".__FILE__.") mysql_error()");
mysql_close();

echo "<center>F&eacute;licitations !!!<br>";
echo "Votre message est enregistr&eacute;.<br><br>
<a class='menu' href='corps.php'>Revenir &agrave; l'accueil</a><center>";
break;

case 'Modif':

$bdd=mysql_connect( $nomhote, $identifiant , $motdepasse );  // Connection a la base MySQL
$nomdelabdd="authentique";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);   								 // sélection de la Base de données

$req_sel = @mysql_db_query($nomdelabdd,"SELECT * 
										FROM news
										WHERE idnews=\"$id\"")or die ("Erreur de requete: (ligne:". __LINE__." dans ".__FILE__.") mysql_error()");
$val = mysql_fetch_array($req_sel);
mysql_close();
?>
<center><h3>Insertion d'une Nouvelle News</h3>
<form name="form1" method="post" action="news.php">
<input name="id" type="hidden" value='<? echo "$id"; ?>'>
  <p>
    Titre du message 
   <input name="titre" size="55" maxsize="100" value='<? echo "$val[titre]"; ?>'>
  </p>
  <p>.:: Votre Message ::.</p>
  <p> 
    <textarea name="msg" rows="15" cols="100"><? echo "$val[texte]"; ?></textarea>
  </p>
  <p align="right">
    <input type="reset" value="Mise &agrave; Zero">
    <input type="submit" name="ok" value="Modifier">
  </p>
</form>
</center>
</BODY>
</HTML>
<?
break;

default:

$bdd=mysql_connect( $nomhote, $identifiant , $motdepasse );  // Connection a la base MySQL
$nomdelabdd="authentique";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);   								 // sélection de la Base de données

$req_sel = @mysql_db_query($nomdelabdd,"SELECT * 
										FROM news
										ORDER BY date_verif DESC")or die ("Erreur de requete: (ligne:". __LINE__." dans ".__FILE__.") mysql_error()");
mysql_close();
?>
<center><h3>Insertion d'une Nouvelle News</h3>
<form name="form1" method="post" action="news.php">
  <p>
    Titre du message 
   <input name="titre" size="55" maxsize="100">
  </p>
  <p>.:: Votre Message ::.</p>
  <p> 
    <textarea name="msg" rows="15" cols="100">Noter ici votre message...</textarea>
  </p>
  <p align="right">
    <input type="reset" value="Mise &agrave; Zero">
    <input type="submit" name="ok" value="Envoyer">
  </p>
</form>
</center>
<?
while ($val = mysql_fetch_array($req_sel))
		{
		$val[date_verif] = mysql_mktime($val[date_verif]); 
		$date = date('d/m/Y @ H:i',$val[date_verif]); 
		echo "<b>Le $date</b> :: <a href='news.php?ok=Modif&id=$val[idnews]' class='menu'>$val[titre]</a> :: $val[texte]<br>";
		}
?>
</BODY>
</HTML>
<?
break;
}
?>