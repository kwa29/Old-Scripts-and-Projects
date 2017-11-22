<? include("Admin/sessions.php") ?>
<?
include("Admin/includes/fonctions.php");        //Connection a la base Statistique 

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="commercial";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);   								 // sélection de la Base de données

if (@$modifier == 'Enregistrer') 
{
// Partie Interet Ville
$requete2 = @mysql_db_query($nomdelabdd,"SELECT idregion,idclient
										 FROM region
										 WHERE idregion='$region'
										 AND idclient='$client'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu2 = @mysql_fetch_array ($requete2);
// Cas ou la fiche est existante dans UPDATE
if ($contenu2 <> NULL)
	{
$requete3 = @mysql_db_query($nomdelabdd,"UPDATE region SET
										 vanregion='$vannes',
										 brestregion='$brest',
										 dolregion='$dol',
										 rosregion='$roscoff',
										 quimregion='$quimper',
										 renregion='$rennes',
										 orleregion='$orleans',
										 stmalregion='$malo',
										 nantregion='$nantes',
										 lorregion='$lorient',
										 aixregion='$aix',
										 marsregion='$mars',
										 mansregion='$mans',
										 parisregion='$paris',
										 dijonregion='$dijon',
										 autreregion=\"$autre\"			
										 WHERE idregion='$region'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Fenetre popup children
echo "<html><head>";
echo "<script language='JavaScript1.2'>window.location; self.close();</script>";
echo "</head></html>";
	}
// Cas ou la fiche n'existe pas donc INSERT
	else
		{
$requete3 = @mysql_db_query($nomdelabdd,"INSERT INTO region (
										 idclient,
										 vanregion,
										 brestregion,
										 dolregion,
										 rosregion,
										 quimregion,
										 renregion,
										 orleregion,
										 stmalregion,
										 nantregion,
										 lorregion,
										 aixregion,
										 marsregion,
										 mansregion,
										 parisregion,
										 dijonregion,
										 autreregion)
										 VALUES (					
										 '$client',
										 '$vannes',
										 '$brest',
										 '$dol',
										 '$roscoff',
										 '$quimper',
										 '$rennes',
										 '$orleans',
										 '$malo',
										 '$nantes',
										 '$lorient',
										 '$aix',
										 '$mars',
										 '$mans',
										 '$paris',
										 '$dijon',
										 \"$autre\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Fenetre popup children
echo "<html><head>";
echo "<script language='JavaScript1.2'>window.location; self.close();</script>";
echo "</head></html>";
		}
		
// Partie Interet Hotel
$requete1 = @mysql_db_query($nomdelabdd,"SELECT idinteret,idcontact
										 FROM interet
										 WHERE idinteret='$interet'
										 AND idcontact='$contact'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu1 = @mysql_fetch_array ($requete1);
// Cas ou la fiche est existante dans UPDATE
if ($contenu1 <> NULL)
	{
$requete2 = @mysql_db_query($nomdelabdd,"UPDATE interet SET
										 uninteret='$un',
										 deuinteret='$deux',
										 troiinteret='$trois',
										 plusinteret='$plus',
										 individuinteret='$individuel',
										 indiapinteret='$appart',
										 indichalinteret='$chalet',
										 indimobinteret='$mobil',
										 poncinteret='$ponctuel',
										 serinteret='$serie',
										 adulinteret='$adulte',
										 etudinteret='$etudiant'							
										 WHERE idinteret='$interet'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Fenetre popup children
echo "<html><head>";
echo "<script language='JavaScript1.2'>window.location; self.close();</script>";
echo "</head></html>";
	}
// Cas ou la fiche n'existe pas donc INSERT
	else
		{
$requete2 = @mysql_db_query($nomdelabdd,"INSERT INTO interet (
										 idcontact,
										 uninteret,
										 deuinteret,
										 troiinteret,
										 plusinteret,
										 individuinteret,
										 indiapinteret,
										 indichalinteret,
										 indimobinteret,
										 poncinteret,
										 serinteret,
										 adulinteret,
										 etudinteret)
										 VALUES (					
										 '$contact',
										 '$un',
										 '$deux',
										 '$trois',
										 '$plus',
										 '$individuel',
										 '$appart',
										 '$chalet',
										 '$mobil',
										 '$ponctuel',
										 '$serie',
										 '$adulte',
										 '$etudiant')")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Fenetre popup children
echo "<html><head>";
echo "<script language='JavaScript1.2'>window.location; self.close();</script>";
echo "</head></html>";
		}
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
}
else
{
$requete = @mysql_db_query($nomdelabdd,"SELECT *								
										FROM interet 
										WHERE idcontact='$contact'")or die ("Erreur de requete: (ligne:". __LINE__." dans ".__FILE__.") mysql_error()");
$contenu = @mysql_fetch_array ($requete);
$requete1 = @mysql_db_query($nomdelabdd,"SELECT 
										 idregion,
										 vanregion,
										 brestregion,
										 dolregion,
										 rosregion,
										 quimregion,
										 renregion,
										 orleregion,
										 stmalregion,
										 nantregion,
										 lorregion,
										 aixregion,
										 marsregion,
										 mansregion,
										 parisregion,
										 dijonregion,
										 autreregion					
										 FROM region 
										 WHERE idclient='$client'")or die ("Erreur de requete: (ligne:". __LINE__." dans ".__FILE__.") mysql_error()");
$contenu1 = @mysql_fetch_array ($requete1);

@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
?>
<html>
<head>
<body>
<title>Gestion Commerciale SOFIBRA</title>
<link rel="stylesheet" href="sofibra.css" type="text/css">
</head>
<body>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<div align='left' class='titre'><h3>Int&eacute;r&ecirc;t H&ocirc;tel...</h3></div>
<form name="form1" action="suivinteret.php" methode="POST">
<input type="hidden" name="client" value='<?php echo "$client"; ?>'>
<input type="hidden" name="contact" value='<?php echo "$contact"; ?>'>
<input type="hidden" name="interet" value='<?php echo "$contenu[idinteret]"; ?>'>
<input type="hidden" name="region" value='<?php echo "$contenu1[idregion]"; ?>'>
<div id="calque1" style="position:absolute; left:70px; top:57px; height:197px; z-index:1"> 
<b>H&ocirc;tel</b>
</div>
<div id="calque2" style="position:absolute; left:200px; top:57px; height:197px; z-index:1"> 
<b>Individuel</b>
</div>
<div id="calque3" style="position:absolute; left:430px; top:57px; height:197px; z-index:1"> 
<b>Groupes</b>
</div>
<div id="calque4" style="position:absolute; left:33px; top:93px; height:197px; z-index:1"> 
<p> 
    <input type="checkbox" name="un" <? if(@$contenu[uninteret] == 1) echo "CHECKED"; ?> value="1">
    1</p>
  <p> 
    <input type="checkbox" name="deux" <? if(@$contenu[deuinteret] == 1) echo "CHECKED"; ?> value="1">
    2</p>
</div>
<div id="calque5" style="position:absolute; left:100px; top:93px; height:197px; z-index:1"> 
<p> 
    <input type="checkbox" name="trois" <? if(@$contenu[troiinteret] == 1) echo "CHECKED"; ?> value="1">
    3</p>
  <p> 
    <input type="checkbox" name="plus" <? if(@$contenu[plusinteret] == 1) echo "CHECKED"; ?> value="1">
    Plus</p>
</div>
<div id="calque6" style="position:absolute; left:180px; top:93px; height:197px; z-index:1"> 
  <p> 
    <input type="checkbox" name="individuel" <? if(@$contenu[individuinteret] == 1) echo "CHECKED"; ?> value="1">
    Individuel</p>
  <p> 
    <input type="checkbox" name="appart" <? if(@$contenu[indiapinteret] == 1) echo "CHECKED"; ?> value="1">
    Appartement</p>
  <p> 
    <input type="checkbox" name="chalet" <? if(@$contenu[indichalinteret] == 1) echo "CHECKED"; ?> value="1">
    Chalet</p>
  <p> 
    <input type="checkbox" name="mobil" <? if(@$contenu[indimobinteret] == 1) echo "CHECKED"; ?> value="1">
    MobileHome</p>
</div>
<div id="calque7" style="position:absolute; left:320px; top:93px; height:197px; z-index:1"> 
<p> 
    <input type="checkbox" name="ponctuel" <? if(@$contenu[poncinteret] == 1) echo "CHECKED"; ?> value="1">
    Groupes Ponctuels</p>
  <p> 
    <input type="checkbox" name="serie" <? if(@$contenu[serinteret] == 1) echo "CHECKED"; ?> value="1">
    Groupes en S&eacute;ries</p>
</div>
<div id="calque8" style="position:absolute; left:470px; top:93px; height:197px; z-index:1"> 
  <p> 
    <input type="checkbox" name="adulte" <? if(@$contenu[adulinteret] == 1) echo "CHECKED"; ?> value="1">
    Groupes d'Adultes</p>
  <p> 
    <input type="checkbox" name="etudiant" <? if(@$contenu[etudinteret] == 1) echo "CHECKED"; ?> value="1">
    Groupes d'Etudiants</p>
</div>
<div id="calque30" style="position:absolute; left:40px; top:240px; z-index:1"> 
<img src='images/line1.gif' align=absmiddle border=0 width=580>
</div>
<div id="calque9" style="position:absolute; left:300px; top:260px; height:197px; z-index:1"> 
<b>Ville</b>
</div>
<div id="calque10" style="position:absolute; left:33px; top:290px; height:197px; z-index:1"> 
<p> 
    <input type="checkbox" name="roscoff" <? if(@$contenu1[rosregion] == 1) echo "CHECKED"; ?> value="1">
    Roscoff</p>
  <p> 
    <input type="checkbox" name="orleans" <? if(@$contenu1[orleregion] == 1) echo "CHECKED"; ?> value="1">
    Orl&eacute;ans</p>
  <p> 
    <input type="checkbox" name="aix" <? if(@$contenu1[aixregion] == 1) echo "CHECKED"; ?> value="1">
    Aix en Provence</p>
</div>
<div id="calque11" style="position:absolute; left:180px; top:290px; height:197px; z-index:1"> 
<p> 
    <input type="checkbox" name="vannes" <? if(@$contenu1[vanregion] == 1) echo "CHECKED"; ?> value="1">
    Vannes</p>
  <p> 
    <input type="checkbox" name="quimper" <? if(@$contenu1[quimregion] == 1) echo "CHECKED"; ?> value="1">
    Quimper</p>
  <p> 
    <input type="checkbox" name="malo" <? if(@$contenu1[stmalregion] == 1) echo "CHECKED"; ?> value="1">
    St Malo</p>
</div>
<div id="calque12" style="position:absolute; left:280px; top:290px; height:197px; z-index:1"> 
<p> 
    <input type="checkbox" name="brest" <? if(@$contenu1[brestregion] == 1) echo "CHECKED"; ?> value="1">
    Brest</p>
  <p> 
    <input type="checkbox" name="rennes" <? if(@$contenu1[renregion] == 1) echo "CHECKED"; ?> value="1">
    Rennes</p>
  <p> 
    <input type="checkbox" name="nantes" <? if(@$contenu1[nantregion] == 1) echo "CHECKED"; ?> value="1">
    Nantes</p>
</div>
<div id="calque13" style="position:absolute; left:380px; top:290px; height:197px; z-index:1"> 
<p> 
    <input type="checkbox" name="dol" <? if(@$contenu1[dolregion] == 1) echo "CHECKED"; ?> value="1">
    Dol de Bretagne</p>
<p> <input type="checkbox" name="lorient" <? if(@$contenu1[lorregion] == 1) echo "CHECKED"; ?> value="1">
    Lorient</p>
<p> <input type="checkbox" name="mans" <? if(@$contenu1[mansregion] == 1) echo "CHECKED"; ?> value="1">
    Le Mans</p>
</div>
<div id="calque14" style="position:absolute; left:520px; top:290px; height:197px; z-index:1"> 
<p> 
    <input type="checkbox" name="mars" <? if(@$contenu1[marsregion] == 1) echo "CHECKED"; ?> value="1">
    Marseille</p>
<p> 
    <input type="checkbox" name="paris" <? if(@$contenu1[parisregion] == 1) echo "CHECKED"; ?> value="1">
    Paris</p>
<p> 
    <input type="checkbox" name="dijon" <? if(@$contenu1[dijonregion] == 1) echo "CHECKED"; ?> value="1">
    Dijon</p>
</div>
<div id="calque16" style="position:absolute; left:40px; top:405px; height:60px; z-index:1">
	Autres
	<input type="text" name="autre" size="40" maxlength="100" value="<?php echo "$contenu1[autreregion]"; ?>">
	
</div>
<div id="calque15" style="position:absolute; left:420px; top:405px; height:197px; z-index:1"> 
<input type="submit" name="modifier" value="Enregistrer">
<input type="button" name="fermer" value="Fermer" onClick="window.close()">
</div>
</form>
</body>
</html>
<?
}
?>