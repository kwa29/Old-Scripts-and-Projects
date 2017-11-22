<? include("sessions.php") ?>
<?php
include("includes/fonctions.php");        // Encapsulation de fonction PHP
switch ($type) {   
 
case 'client':
?>
<html>
<link rel="stylesheet" href="../sofibra.css" type="text/css">
<h3><center>Transfert de Client</center></h3>
<div class="anotation" align="left"><i>Fonctionnalit&eacute; du module :</i> le script met &agrave; jour les tables Client, Liencontact et R&eacute;gion</div>
Entrer l'ancien Code et le nouveau Code
<form name="form1" action="transfert.php" methode="POST">
<center>
<input type="text" name="oldnum" size="7" maxlength="6">
<<<<<<<<&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>>>>>>>>
<input type="text" name="newnum" size="7" maxlength="6">
<input type="submit" name="type" value="MaJ Client">
</center>
</form>
</html>
<?
break;

case 'MaJ Client':

$bdd=mysql_connect( $nomhote, $identifiant , $motdepasse );  // Connection a la base MySQL
$nomdelabdd="commercial";        // le nom de la Base de donnИes 
// Mise a jour du code client
$requete = @mysql_db_query($nomdelabdd,"UPDATE client SET
										codeclient=\"$newnum\"
										WHERE codeclient=\"$oldnum\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Mise a jour du codeclient dans les liens contact
$requete1 = @mysql_db_query($nomdelabdd,"UPDATE liencontact SET
										 idclient=\"$newnum\"
										 WHERE idclient=\"$oldnum\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Mise a jour pour les regions
$requete3 = @mysql_db_query($nomdelabdd,"UPDATE region SET
										 idclient=\"$newnum\"
										 WHERE idclient=\"$oldnum\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");

echo "<html><head>";
echo "<link rel='stylesheet' href='../sofibra.css' type='text/css'>";
echo "Le Client <b>$oldnum</b> est devenu <b>$newnum</b><br><blockquote>Success...</blockquote>";
echo "</head></html>";
@mysql_close();       // spИcifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin

break;

case 'contact':
?>
<html>
<link rel="stylesheet" href="../sofibra.css" type="text/css">
<h3><center>Transfert de Contact</center></h3>
<div class="anotation" align="left"><i>Fonctionnalit&eacute; du module :</i> le script bascule tous les contacts des clients inscrits et met &agrave; jour les tables Liencontact, et R&eacute;gion et supprime dans la table Client</div>
Entrer le ou les ancien(s) Code <b>s&eacute;par&eacute;s par des points-virgules ";"</b> et le nouveau Code
<form name="form" action="transfert.php" methode="POST">
<center>
<input type="text" name="oldnum" size="50" maxlength="50">
<<<<<<<<&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>>>>>>>>
<input type="text" name="newnum" size="7" maxlength="6">
<input type="submit" name="type" value="MaJ Contact">
</center>
</form>
</html>
<?
break;

case 'MaJ Contact':

$bdd=mysql_connect( $nomhote, $identifiant , $motdepasse );  // Connection a la base MySQL
$nomdelabdd="commercial";        // le nom de la Base de donnИes 
$mots = split(";", $oldnum);
$nombre_mots = count($mots);
$liste=explode(";",$oldnum);

$i = 0;
while ($i <> $nombre_mots)
{
// Mise a jour du codeclient dans les liens contact
$requete1 = @mysql_db_query($nomdelabdd,"UPDATE liencontact SET
										 idclient=\"$newnum\"
										 WHERE idclient=\"$liste[$i]\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Mise a jour pour les regions
$requete3 = @mysql_db_query($nomdelabdd,"UPDATE region SET
										 idclient=\"$newnum\"
										 WHERE idclient=\"$liste[$i]\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Suppression du code client
$requete = @mysql_db_query($nomdelabdd,"DELETE FROM client
										WHERE codeclient=\"$liste[$i]\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$i++;
}
echo "<html><head>";
echo "<link rel='stylesheet' href='../sofibra.css' type='text/css'>";
echo "Le Contact <b>$oldnum</b> est mis &agrave; jour<br><blockquote>Success...</blockquote>";
echo "</head></html>";
@mysql_close();       // spИcifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
break;

case 'suppression':
?>
<html>
<link rel="stylesheet" href="../sofibra.css" type="text/css">
<h3><center>Suppression de Comptes Clients</center></h3>
<div class="anotation" align="left"><i>Fonctionnalit&eacute; du module :</i> le script supprimer tous les clients inscrits</div>
Entrer le ou les Code(s) <b>s&eacute;par&eacute;s par des points-virgules ";"</b>
<form name="form" action="transfert.php" methode="POST">
<center>
<input type="text" name="num" size="50" maxlength="50">
<input type="submit" name="type" value="Suppression">
</center>
</form>
</html>
<?
break;

case 'Suppression':

$bdd=mysql_connect( $nomhote, $identifiant , $motdepasse );  // Connection a la base MySQL
$nomdelabdd="commercial";        // le nom de la Base de donnИes 
$mots = split(";", $num);
$nombre_mots = count($mots);
$liste=explode(";",$num);

$i = 0;
while ($i <> $nombre_mots)
{
// Mise a jour du codeclient dans les liens contact
// Suppression du code client
$requete1 = @mysql_db_query($nomdelabdd,"DELETE FROM client
										WHERE codeclient=\"$liste[$i]\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete2 = @mysql_db_query($nomdelabdd,"DELETE FROM liencontact
										WHERE idclient=\"$liste[$i]\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$i++;
}
echo "<html><head>";
echo "<link rel='stylesheet' href='../sofibra.css' type='text/css'>";
echo "Le Client <b>$num</b> est supprim&eacute;<br><blockquote>Success...</blockquote>";
echo "</head></html>";
@mysql_close();       // spИcifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
break;

case 'suppression_contact':
?>
<html>
<link rel="stylesheet" href="../sofibra.css" type="text/css">
<h3><center>Suppression de Comptes Contacts</center></h3>
<div class="anotation" align="left"><i>Fonctionnalit&eacute; du module :</i> le script supprimer tous les contacts inscrits dans la table contact et liencontact</div>
Entrer le nom du contact
<form name="form" action="transfert.php" methode="POST">
<center>
<input type="text" name="nom" size="50" maxlength="50">
<input type="submit" name="type" value="Suppression Contact">
</center>
</form>
</html>
<?
break;

case 'Suppression Contact':

$bdd=mysql_connect( $nomhote, $identifiant , $motdepasse );  // Connection a la base MySQL
$nomdelabdd="commercial";        // le nom de la Base de donnИes 
$requete1 = @mysql_db_query($nomdelabdd,"SELECT * FROM contact
										WHERE nomcontact=\"$nom\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$i = 0;
while ($val = mysql_fetch_array($requete1))
{
$requete2 = @mysql_db_query($nomdelabdd,"DELETE FROM contact
										WHERE idcontact=\"$val[idcontact]\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete3 = @mysql_db_query($nomdelabdd,"DELETE FROM liencontact
										WHERE idcontact=\"$val[idcontact]\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$i++;
}
echo "<html><head>";
echo "<link rel='stylesheet' href='../sofibra.css' type='text/css'>";
echo "Les <b>$i</b> Contacts <b>$nom</b> sont supprim&eacute;s<br><blockquote>Success...</blockquote>";
echo "</head></html>";
@mysql_close();       // spИcifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
break;

}
?>