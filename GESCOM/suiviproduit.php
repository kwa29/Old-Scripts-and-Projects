<? include("Admin/sessions.php") ?>
<?
include("Admin/includes/fonctions.php");        //Connection a la base Statistique 

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="commercial";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);   								 // sélection de la Base de données

if (@$modifier == 'Enregistrer') 
{
// Requete pour le Tourisme
$requete1 = @mysql_db_query($nomdelabdd,"SELECT c.idcontact,p.idcontact
										 FROM liencontact c,produtil p
										 WHERE p.idcontact=c.idcontact
										 AND p.idcontact='$code'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu1 = @mysql_fetch_array ($requete1);
// Requete pour la Societe
$requete3 = @mysql_db_query($nomdelabdd,"SELECT c.idcontact,p.idcontact
										 FROM liencontact c,prodsoc p
										 WHERE p.idcontact=c.idcontact
										 AND p.idcontact='$code'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu3 = @mysql_fetch_array ($requete3);

// Cas ou la fiche est existante dans UPDATE pour le Tourisme
if ($contenu1 <> NULL)
{
$requete2 = @mysql_db_query($nomdelabdd,"UPDATE produtil SET
										 noelprodutil='$noelprodutil',
										 sylprodutil='$sylprodutil',
										 cultprodutil='$cultprodutil',
										 sportprodutil='$sportprodutil',
										 weekprodutil='$weekprodutil',
										 reliprodutil='$reliprodutil',
										 promprodutil='$promprodutil',
										 golfprodutil='$golfprodutil',
										 balnprodutil='$balnprodutil',
										 incprodutil='$incprodutil',
										 stoprodutil='$stoprodutil',
										 santeprodutil='$santeprodutil',
										 cirprodutil='$cirprodutil',
										 sejprodutil='$sejprodutil',
										 scolprodutil='$scolprodutil',
										 linprodutil='$linprodutil',
										 tourprodutil='$tourprodutil',
										 vinprodutil='$vinprodutil',
										 autrprodutil=\"$autrprodutil\"										
										 WHERE idcontact='$code'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}
// Cas ou la fiche n'existe pas donc INSERT
else
{
$requete2 = @mysql_db_query($nomdelabdd,"INSERT INTO produtil (
										 idcontact,
										 noelprodutil,
										 sylprodutil,
										 cultprodutil,
										 sportprodutil,
										 weekprodutil,
										 reliprodutil,
										 promprodutil,
										 golfprodutil,
										 balnprodutil,
										 incprodutil,
										 stoprodutil,
										 santeprodutil,
										 cirprodutil,
										 sejprodutil,
										 scolprodutil,
										 linprodutil,
										 tourprodutil,
										 vinprodutil,
										 autrprodutil)
										 VALUES (
										 '$code',
										 '$noelprodutil',
										 '$sylprodutil',
										 '$cultprodutil',
										 '$sportprodutil',
										 '$weekprodutil',
										 '$reliprodutil',
										 '$promprodutil',
										 '$golfprodutil',
										 '$balnprodutil',
										 '$incprodutil',
										 '$stoprodutil',
										 '$santeprodutil',
										 '$cirprodutil',
										 '$sejprodutil',
										 '$scolprodutil',
										 '$linprodutil',
										 '$tourprodutil',
										 '$vinprodutil',
										 \"$autrprodutil\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}
// Cas ou la fiche est existante dans UPDATE pour le Societe
if ($contenu3 <> NULL)
{
$requete4 = @mysql_db_query($nomdelabdd,"UPDATE prodsoc SET
										 hebcourtsoc='$hebcourtsoc',
										 heblongsoc='$heblongsoc',
										 restosoc='$restosoc',
										 pdasoc='$pdasoc',
										 locsallesoc='$locsallesoc',
										 jetudsoc='$jetudsoc',
										 semisoc='$semisoc',
										 soiretapsoc='$soiretapsoc',
										 packsoc='$packsoc',
										 coktaisoc='$coktaisoc',
										 autresoc=\"$autresoc\"										
										 WHERE idcontact='$code'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Fenetre popup children
echo "<html><head>";
echo "<script language='JavaScript1.2'>window.location; self.close();</script>";
echo "</head></html>";
}
// Cas ou la fiche n'existe pas donc INSERT
else
{
$requete4 = @mysql_db_query($nomdelabdd,"INSERT INTO prodsoc (
										 idcontact,
										 hebcourtsoc,
										 heblongsoc,
										 restosoc,
										 pdasoc,
										 locsallesoc,
										 jetudsoc,
										 semisoc,
										 soiretapsoc,
										 packsoc,
										 coktaisoc,
										 autresoc)
										 VALUES (
										 '$code',
										 '$hebcourtsoc',
										 '$heblongsoc',
										 '$restosoc',
										 '$pdasoc',
										 '$locsallesoc',
										 '$jetudsoc',
										 '$semisoc',
										 '$soiretapsoc',
										 '$packsoc',
										 '$coktaisoc',
										 \"$autresoc\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Fenetre popup children
echo "<html><head>";
echo "<script language='JavaScript1.2'>window.location; self.close();</script>";
echo "</head></html>";
}
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
}
else
{
$requete = @mysql_db_query($nomdelabdd,"SELECT 
										noelprodutil,
										sylprodutil,
										cultprodutil,
										sportprodutil,
										weekprodutil,
										reliprodutil,
										promprodutil,
										golfprodutil,
										balnprodutil,
										incprodutil,
										stoprodutil,
										santeprodutil,
										cirprodutil,
										sejprodutil,
										scolprodutil,
										linprodutil,
										tourprodutil,
										vinprodutil,
										autrprodutil
										FROM produtil
										WHERE idcontact='$code'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu = @mysql_fetch_array ($requete);
$requete1 = @mysql_db_query($nomdelabdd,"SELECT 
										 hebcourtsoc,
										 heblongsoc,
										 restosoc,
										 pdasoc,
										 locsallesoc,
										 jetudsoc,
										 semisoc,
										 soiretapsoc,
										 packsoc,
										 coktaisoc,
										 autresoc
										 FROM prodsoc
										 WHERE idcontact='$code'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val = @mysql_fetch_array ($requete1);
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
?>
<html>
<head>
<title>Gestion Commerciale SOFIBRA</title>
</head>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<body>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<div align='left' class='titre'><h3>Produit Utilis&eacute;...</h3></div>
<form name="form1" action="suiviproduit.php" methode="POST">
<input type="hidden" name="code" value='<?php echo "$code"; ?>'>
<div id="calque1" style="position:absolute; left:33px; top:57px; width:113px; height:197px; z-index:1"> 
  <p> 
    <input type="checkbox" name="cirprodutil" <? if(@$contenu[cirprodutil] == 1) echo "CHECKED"; ?> value="1">
    Circuits</p>
  <p> 
    <input type="checkbox" name="sejprodutil" <? if(@$contenu[sejprodutil] == 1) echo "CHECKED"; ?> value="1">
    S&eacute;jours</p>
  <p> 
    <input type="checkbox" name="incprodutil" <? if(@$contenu[incprodutil] == 1) echo "CHECKED"; ?> value="1">
    Incentive</p>
  <p> 
    <input type="checkbox" name="stoprodutil" <? if(@$contenu[stoprodutil] == 1) echo "CHECKED"; ?> value="1">
    Stop Lunch</p>
  <p> 
    <input type="checkbox" name="promprodutil" <? if(@$contenu[promprodutil] == 1) echo "CHECKED"; ?> value="1">
    Promotion </p>
</div>
<div id="calque2" style="position:absolute; left:133px; top:57px; width:150px; height:197px; z-index:1"> 
  <p> 
    <input type="checkbox" name="golfprodutil" <? if(@$contenu[golfprodutil] == 1) echo "CHECKED"; ?> value="1">
    Forfait Golf </p>
  <p> 
    <input type="checkbox" name="weekprodutil" <? if(@$contenu[weekprodutil] == 1) echo "CHECKED"; ?> value="1">
    Forfait Week-End</p>
  <p> 
    <input type="checkbox" name="scolprodutil" <? if(@$contenu[scolprodutil] == 1) echo "CHECKED"; ?> value="1">
    Scolaire </p>
  <p> 
    <input type="checkbox" name="balnprodutil" <? if(@$contenu[balnprodutil] == 1) echo "CHECKED"; ?> value="1">
    Baln&eacute;aire </p>
  <p> 
    <input type="checkbox" name="santeprodutil" <? if(@$contenu[santeprodutil] == 1) echo "CHECKED"; ?> value="1">
    Sant&eacute; </p>
</div>
<div id="calque3" style="position:absolute; left:263px; top:57px; width:150px; height:197px; z-index:1"> 
<p> 
    <input type="checkbox" name="linprodutil" <? if(@$contenu[linprodutil] == 1) echo "CHECKED"; ?> value="1">
    Linguistique</p>
  <p> 
    <input type="checkbox" name="vinprodutil" <? if(@$contenu[vinprodutil] == 1) echo "CHECKED"; ?> value="1">
    Vin et Gastronomie </p>
  <p> 
    <input type="checkbox" name="sportprodutil" <? if(@$contenu[sportprodutil] == 1) echo "CHECKED"; ?> value="1">
    Sportifs </p>
  <p> 
    <input type="checkbox" name="reliprodutil" <? if(@$contenu[reliprodutil] == 1) echo "CHECKED"; ?> value="1">
    Religieux </p>
  <p> 
    <input type="checkbox" name="noelprodutil" <? if(@$contenu[noelprodutil] == 1) echo "CHECKED"; ?> value="1">
    No&euml;l </p>
</div>
<div id="calque4" style="position:absolute; left:408px; top:57px; z-index:1"> 
<p>
    <input type="checkbox" name="sylprodutil" <? if(@$contenu[sylprodutil] == 1) echo "CHECKED"; ?> value="1">
    St Sylvestre</p>
  <p> 
    <input type="checkbox" name="tourprodutil" <? if(@$contenu[tourprodutil] == 1) echo "CHECKED"; ?> value="1">
    Tourisme d'Affaire</p>
  <p> 
    <input type="checkbox" name="cultprodutil" <? if(@$contenu[cultprodutil] == 1) echo "CHECKED"; ?> value="1">
    Culturel</p>
</div>
<div id="calque5" style="position:absolute; left:372px; top:171px; z-index:1"> 
    Autres 
    <input type="text" name="autrprodutil" size="30" maxlength="100" value="<?php echo "$contenu[autrprodutil]"; ?>">
</div>
<div id="calque6" style="position:absolute; left:40px; top:240px; z-index:1"> 
<img src='images/line1.gif' align=absmiddle border=0 width=590>
</div>
<div id="calque7" style="position:absolute; left:33px; top:260px; z-index:1"> 
<p>
    <input type="checkbox" name="hebcourtsoc" <? if(@$val[hebcourtsoc] == 1) echo "CHECKED"; ?> value="1">
    H&eacute;bergement Court S&eacute;jour</p>
  <p> 
    <input type="checkbox" name="heblongsoc" <? if(@$val[heblongsoc] == 1) echo "CHECKED"; ?> value="1">
    H&eacute;bergement Long S&eacute;jour</p>
  <p> 
    <input type="checkbox" name="restosoc" <? if(@$val[restosoc] == 1) echo "CHECKED"; ?> value="1">
    Restauration</p>
  <p> 
    <input type="checkbox" name="pdasoc" <? if(@$val[pdasoc] == 1) echo "CHECKED"; ?> value="1">
    Petit D&eacute;jeuner d'Affaires</p>
</div>
<div id="calque8" style="position:absolute; left:263px; top:260px; z-index:1"> 
<p>
    <input type="checkbox" name="locsallesoc" <? if(@$val[locsallesoc] == 1) echo "CHECKED"; ?> value="1">
    Location de Salle</p>
  <p> 
    <input type="checkbox" name="jetudsoc" <? if(@$val[jetudsoc] == 1) echo "CHECKED"; ?> value="1">
    Journ&eacute;e d'Etude</p> 
  <p> 
    <input type="checkbox" name="semisoc" <? if(@$val[semisoc] == 1) echo "CHECKED"; ?> value="1">
    S&eacute;minaire</p>
  <p> 
    <input type="checkbox" name="soiretapsoc" <? if(@$val[soiretapsoc] == 1) echo "CHECKED"; ?> value="1">
    Soir&eacute;e Etape</p>
</div>
<div id="calque9" style="position:absolute; left:408px; top:260px; z-index:1"> 
<p>
    <input type="checkbox" name="packsoc" <? if(@$val[packsoc] == 1) echo "CHECKED"; ?> value="1">
    Package</p>
  <p> 
    <input type="checkbox" name="coktaisoc" <? if(@$val[coktaisoc] == 1) echo "CHECKED"; ?> value="1">
    Cocktail</p>
</div>
<div id="calque10" style="position:absolute; left:372px; top:335px; z-index:1"> 
Autres
    <input type="text" name="autresoc" size="30" maxlength="100" value="<?php echo "$val[autresoc]"; ?>">
</div>
<div id="calque11" style="position:absolute; left:450px; top:410px; height:197px; z-index:1"> 
<input type="submit" name="modifier" value="Enregistrer">
<input type="button" name="fermer" value="Fermer" onClick="window.close()">
</div>
</form>
</body>
</html>
<?
}
?>