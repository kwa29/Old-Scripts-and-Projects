<? include("Admin/sessions.php") ?>
<?php
include("Admin/includes/fonctions.php");        //Connection Ю la SGBD

switch ($type) 
{
// Cas ou requete est total pour les preformatИes
case 'pre':

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection Ю la Base de donnИes
$nomdelabdd="commercial";       										// le nom de la Base de donnИes 
@mysql_select_db($nomdelabdd, $bdd);   								 // sИlection de la Base de donnИes

$requete = @mysql_db_query($nomdelabdd,"SELECT * FROM pays ORDER BY nompays ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete5 = @mysql_db_query($nomdelabdd,"SELECT * FROM type
										 WHERE indiceclient='T'
										 ORDER BY nomtype ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete7 = @mysql_db_query($nomdelabdd,"SELECT * FROM pays ORDER BY nompays ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete8 = @mysql_db_query($nomdelabdd,"SELECT * FROM pays ORDER BY nompays ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close();

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection Ю la Base de donnИes
$nomdelabdd="authentique";       										// le nom de la Base de donnИes 
@mysql_select_db($nomdelabdd, $bdd);   								 // sИlection de la Base de donnИes

// Test de securite pour savoir ki afficher dans les listes deroulantes
if ($saphira >= 4)
	{
	$requete1 = @mysql_db_query($nomdelabdd,"SELECT * FROM utilisateur 
										 	 WHERE idutil=\"$log\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$requete2 = @mysql_db_query($nomdelabdd,"SELECT * FROM utilisateur 
										 	 WHERE idutil=\"$log\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$requete3 = @mysql_db_query($nomdelabdd,"SELECT * FROM utilisateur 
										 	 WHERE idutil=\"$log\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
	else
	{
	$requete1 = @mysql_db_query($nomdelabdd,"SELECT * FROM utilisateur 
										 	 WHERE groupe BETWEEN '3' AND '6'
										 	 ORDER BY nom ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$requete2 = @mysql_db_query($nomdelabdd,"SELECT * FROM utilisateur 
										 	 WHERE groupe BETWEEN '3' AND '6'
										 	 ORDER BY nom ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$requete3 = @mysql_db_query($nomdelabdd,"SELECT * FROM utilisateur 
										 	 WHERE groupe BETWEEN '3' AND '6'
										 	 ORDER BY nom ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requete4 = @mysql_db_query($nomdelabdd,"SELECT * FROM utilisateur 
										 WHERE groupe BETWEEN '3' AND '6'
										 ORDER BY nom ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close(); 

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection Ю la Base de donnИes
$nomdelabdd="statistique";       										// le nom de la Base de donnИes 
@mysql_select_db($nomdelabdd, $bdd);   								 // sИlection de la Base de donnИes

$requete6 = @mysql_db_query($nomdelabdd,"SELECT * 
										 FROM hotel 
										 WHERE nummin <> 0
										 ORDER BY nomhotel ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close();
$annee  = date("Y")-1;
?>
<html>
<head>
<title>Gestion Commerciale SOFIBRA</title>
<base target="corps">
<script src="fonction.js"></script>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script type="text/javascript">
function Choix(formulaire)
{
i = formulaire.option.selectedIndex; 

switch (i) 
	{
	case 1 : 	
	window.document.getElementById("calque1").style.visibility = 'visible';
	window.document.getElementById("calque2").style.visibility = 'hidden';
			  
	break;
	case 2 : 
	window.document.getElementById("calque2").style.visibility = 'visible';
	window.document.getElementById("calque1").style.visibility = 'hidden';
	
	break;
	case 3 : 
	window.document.getElementById("calque2").style.visibility = 'visible';
	window.document.getElementById("calque1").style.visibility = 'hidden';
	
	break;
	case 4 : 
	window.document.getElementById("calque2").style.visibility = 'visible';
	window.document.getElementById("calque1").style.visibility = 'hidden';
	
	break;
	}
} 
</script> 
</head>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>

<table border="0" width="90%">
<tr>
<td>
<div align='left' class='titre'><h3>Requ&ecirc;tes sur le Suivi Commercial...</h3></div>
</td>
<td></td>
</tr>

<tr>
<td>
<form action="resultat.php" methode="POST" onSubmit="return controlreq15();">
<input type="hidden" name="requete" value="15">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation du Rapport hebdomadaire pour 
<select name="rce">
    <? while ($val1 = mysql_fetch_array($requete1)) { ?>
    <option value='<? echo $val1["siglerce"]; ?>'><? echo $val1["prenom"]." ".$val1["nom"]; ?></option>	
	<? } ?>
</select>
du (JJ/MM/AA) <input type="text" name="dateap" size="8" maxlength="8">
&nbsp;au <input type="text" name="datedp" size="8" maxlength="8">
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST" onSubmit="return controlreq17();">
<input type="hidden" name="requete" value="12">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation des Relances pour 
<select name="rce">
    <? while ($val2 = mysql_fetch_array($requete2)) { ?>
    <option value='<? echo $val2["siglerce"]; ?>'><? echo $val2["prenom"]." ".$val2["nom"]; ?></option>	
	<? } ?>
</select>
du (JJ/MM/AA) <input type="text" name="dateap" size="8" maxlength="8">
&nbsp;au <input type="text" name="datedp" size="8" maxlength="8">
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form name="form2" action="resultat.php" methode="POST" onSubmit="return controlreq16();">
<input type="hidden" name="requete" value="16">
<img src="images/menu_fleche_2.gif" align="absmiddle">Mailing : Visualisation
<select name="type_client">
    <option value="C" SELECTED>de tous les clients</option>
    <option value="P">de tous les prospects</option>
</select>
<select name="option" onChange='Choix(this.form)'>
    <option selected>--- Choisissez une rubrique ---</option>
    <option value="cp">dont le Code Postal</option>	
	<option value="ville">dont la Ville</option>	
	<option value="pays">dont le Pays</option>	
	<option value="secteur">dont le Secteur Economique</option>	
</select>
pour
<select name="rce">
	 if ($saphira <= 2) { echo "<option value='tous'>Tous</option>"; }
    <? while ($val3 = mysql_fetch_array($requete3)) { ?>
    <option value='<? echo $val3["siglerce"]; ?>'><? echo $val3["prenom"]." ".$val3["nom"]; ?></option>	
	<? } ?>
</select>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
<tr>
<td>
<div id="calque1" style="position:absolute; visibility:hidden">
commence par&nbsp;
<input type="text" size="10" maxlength="10" name="opt">
</div>
<div id="calque2" style="visibility:hidden">
contient&nbsp;
<input type="text" size="15" maxlength="15" name="opd">
</div>
<br>
<div class="anotation" align="left">( <i>ATTENTION</i>, pour cette requête le temps de r&eacute;ponse peut être long... )</div>

</td>
<td>
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="29">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation de toutes les adresses e-mails 
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
pour les clients et les contacts
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="23">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation des Clients interess&eacute;s par 
<select name="option">
<option value="uninteret" SELECTED>H&#244;tel *</option>
<option value="deuinteret">H&#244;tel **</option>
<option value="troiinteret">H&#244;tel ***</option>
<option value="plusinteret">H&#244;tel ++++</option>
<option value="individuinteret">Individuel</option>
<option value="indiapinteret">Appartement</option>
<option value="indichalinteret">Chalet</option>
<option value="indimobinteret">MobileHome</option>
<option value="poncinteret">Groupe ponctuel</option>
<option value="serinteret">Groupe en s&eacute;ries</option>
<option value="adulinteret">Groupe d'adultes</option>
<option value="etudinteret">Groupe d'etudiants</option>
<option value="rosregion">Roscoff</option>
<option value="vanregion">Vannes</option>
<option value="brestregion">Brest</option>
<option value="dolregion">Dol de Bretagne</option>
<option value="marsregion">Marseille</option>
<option value="orleregion">Orl&eacute;ans</option>
<option value="quimregion">Quimper</option>
<option value="renregion">Rennes</option>
<option value="lorregion">Lorient</option>
<option value="parisregion">Paris</option>
<option value="aixregion">Aix en provence</option>
<option value="stmalregion">St Malo</option>
<option value="nantregion">Nantes</option>
<option value="mansregion">Le Mans</option>
<option value="dijonregion">Dijon</option>
</select>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<?php
	// Affichage des requetes suivi commercial uniquement pour les groupes 1,2 et 3
	if (($saphira == 1)||($saphira == 2)||($saphira == 3))
	{
?>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="8">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation des nouveaux Clients 
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
pour l'ann&eacute;e
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006' SELECTED>2006</option>
	<option value='2007'>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
</select>
<br>
<div class="anotation" align="left">( <i>ATTENTION</i>, pour cette requête le temps de r&eacute;ponse peut être long... )</div>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="11">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation de la liste des Soci&eacute;t&eacute;s et Contacts pr&eacute;sents sur le salon
<input type="text" name="salon">
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="2">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation de tous les Clients pour 
<select name="rce">
    <? while ($val4 = mysql_fetch_array($requete4)) { ?>
    <option value='<? echo $val4["siglerce"]; ?>'><? echo $val4["prenom"]." ".$val4["nom"]; ?></option>	
	<? } ?>
</select>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="3">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation tous les Clients dont le pays contient
<input type="text" name="option1" size="8" maxlength="8">
 et dont le code commence par
<input type="text" name="option2" size="3" maxlength="3">
<br>
<div class="anotation" align="left">( <i>ATTENTION</i>, pour cette requête le temps de r&eacute;ponse peut être long... )</div>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="4">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation tous les Clients dont le type est
<select name="option1">
    <? while ($val5 = mysql_fetch_array($requete5)) { ?>
    <option value='<? echo $val5["idtype"]; ?>' SELECTED><? echo $val5["nomtype"]; ?></option>	
	<? } ?>
</select>
 et dont le pays contient
<input type="text" name="option2" size="8" maxlength="8">
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>
<?php
	// Fin de if pour la securite des 4 dernieres requetes suivi commercial 
	} 
?>
<tr>
<td>
<br>
<div align='left' class='titre'><h3>Requ&ecirc;tes sur les Statistiques...</h3></div>
</td>
<td>
</td>
</tr>

<?php
if ( $saphira < 5 )
	{
?>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="13">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation des Clients
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
dont le Code Postal commence par  
<input type="text" name="cp" size="3" maxlength="3">
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="26">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation des Prospects 
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
dont le Code Postal commence par  
<input type="text" name="cp" size="3" maxlength="3">
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="1">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation du CA et du nbre de Nuit&eacute;es pour l'ann&eacute;e
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006'>2006</option>
	<option value='2007' SELECTED>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
  </select> par Mois et par H&ocirc;tel pour
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
<br>
<div class="anotation" align="left">( <i>ATTENTION</i>, pour cette requête le temps de r&eacute;ponse peut être long... )</div>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="5">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation du CA et du nbre de Nuit&eacute;es pour l'ann&eacute;e
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006'>2006</option>
	<option value='2007' SELECTED>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
  </select> au
<select name="pays">
    <? while ($val = mysql_fetch_array($requete)) { ?>
    <option value='<? echo $val["idpays"]; ?>' SELECTED><? echo $val["nompays"]; ?></option>	
	<? } ?>
</select>
pour 
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="7">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation des destinations pr&eacute;f&eacute;r&eacute;es des Clients pour l'ann&eacute;e
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006'>2006</option>
	<option value='2007' SELECTED>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
  </select>,
 par H&ocirc;tel et en CA pour
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
<br>
<div class="anotation" align="left">( <i>ATTENTION</i>, pour cette requête le temps de r&eacute;ponse peut être long... )</div>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="10">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation des Clients 
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
qui consomment tous les ans depuis l'ann&eacute;e 2003
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="14">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation du TOP 50 des Clients 
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
ayant r&eacute;alis&eacute;s le plus gros CA pour l'ann&eacute;e
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006'>2006</option>
	<option value='2007' SELECTED>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
  </select>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<?php
// Fin du if pour $saphira < 5
	}
if ( $saphira < 4)
		{
?>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="6">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation du CA Total de<br> tous les Clients 
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
 par Pays et pour H&ocirc;tel 
<select name="hotel">
    <? while ($val = mysql_fetch_array($requete6)) { ?>
    <option value='<? echo $val["codehotel"]; ?>' SELECTED><? echo $val["nomhotel"]; ?></option>	
	<? } ?>
</select>
pour l'ann&eacute;e
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006'>2006</option>
	<option value='2007' SELECTED>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
  </select>
<br>
<div class="anotation" align="left">( <i>ATTENTION</i>, pour cette requête le temps de r&eacute;ponse peut être long... )</div>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<?
// Fin du if		}
?>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="9">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation par Client
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>, nbres de Nuit&eacute; et CA Total pour le mois de 
<select name="option">
    <option value='1' SELECTED>Janvier</option>	
	<option value='2'>F&eacute;vrier</option>	
	<option value='3'>Mars</option>	
	<option value='4'>Avril</option>	
	<option value='5'>Mai</option>	
	<option value='6'>Juin</option>	
	<option value='7'>Juillet</option>	
	<option value='8'>Ao&ucirc;t</option>	
	<option value='9'>Septembre</option>	
	<option value='10'>Octobre</option>	
	<option value='11'>Novembre</option>	
	<option value='12'>D&eacute;cembre</option>	
</select>
de l'ann&eacute;e
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006'>2006</option>
	<option value='2007' SELECTED>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
</select>
<br>
<div class="anotation" align="left">( <i>ATTENTION</i>, pour cette requête le temps de r&eacute;ponse peut être long... )</div>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="20">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation par Client
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>, nbres de Nuit&eacute; et CA Total cumul&eacute; au mois de 
<select name="option">
    <option value='1' SELECTED>Janvier</option>	
	<option value='2'>F&eacute;vrier</option>	
	<option value='3'>Mars</option>	
	<option value='4'>Avril</option>	
	<option value='5'>Mai</option>	
	<option value='6'>Juin</option>	
	<option value='7'>Juillet</option>	
	<option value='8'>Ao&ucirc;t</option>	
	<option value='9'>Septembre</option>	
	<option value='10'>Octobre</option>	
	<option value='11'>Novembre</option>	
	<option value='12'>D&eacute;cembre</option>	
</select>
de l'ann&eacute;e
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006'>2006</option>
	<option value='2007' SELECTED>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
</select>
<br>
<div class="anotation" align="left">( <i>ATTENTION</i>, pour cette requête le temps de r&eacute;ponse peut être long... )</div>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<?php
if ( $saphira < 4)
		{
?>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="18">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation des Clients 
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
qui ont consomm&eacute; en
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006'>2006</option>
	<option value='2007' SELECTED>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
  </select>
<br>
<div class="anotation" align="left">( <i>ATTENTION</i>, pour cette requête le temps de r&eacute;ponse peut être long... )</div>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="19">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation du TOP 50 des Clients
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
 pour le mois de 
<select name="mois">
<option SELECTED value="1">Janvier</option>
<option value="2">F&eacute;vrier</option>
<option value="3">Mars</option>
<option value="4">Avril</option>
<option value="5">Mai</option>
<option value="6">Juin</option>
<option value="7">Juillet</option>
<option value="8">Aout</option>
<option value="9">Septembre</option>
<option value="10">Octobre</option>
<option value="11">Novembre</option>
<option value="12">D&eacute;cembre</option>
</select>
et pour l'ann&eacute;e
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006'>2006</option>
	<option value='2007' SELECTED>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
  </select>
<br>
<div class="anotation" align="left">( <i>ATTENTION</i>, pour cette requête le temps de r&eacute;ponse peut être long... )</div>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<?
		}
?><tr>
<td>
<div align='left' class='titre'><h3>Requ&ecirc;tes sur les Annulations et Refus...</h3></div>
</td>
<td>
</td>
</tr>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="27">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation des annulations pour Client
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
par mois et pour l'ann&eacute;e 
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006'>2006</option>
	<option value='2007' SELECTED>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
  </select>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="28">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation des refus pour Client
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
par mois et pour l'ann&eacute;e 
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006'>2006</option>
	<option value='2007' SELECTED>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
  </select>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="24">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation des annulations pour Client
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
 par Pays
<select name="pays">
    <option value='tous' SELECTED>Tous</option>
	<? while ($val = mysql_fetch_array($requete7)) { ?>
    <option value='<? echo $val["idpays"]; ?>' ><? echo $val["nompays"]; ?></option>	
	<? } ?>
  </select>
par mois et pour l'ann&eacute;e 
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006'>2006</option>
	<option value='2007' SELECTED>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
  </select>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="25">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation des refus pour Client
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
 par Pays
<select name="pays">
    <option value='tous' SELECTED>Tous</option>
	<? while ($val = mysql_fetch_array($requete8)) { ?>
    <option value='<? echo $val["idpays"]; ?>' ><? echo $val["nompays"]; ?></option>	
	<? } ?>
  </select>
par mois et pour l'ann&eacute;e 
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006'>2006</option>
	<option value='2007' SELECTED>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
  </select>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

</table>
</body>
</html>
<?php

break;

// Cas ou requete est sur le suivi
case 'suivi':

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection Ю la Base de donnИes
$nomdelabdd="commercial";       										// le nom de la Base de donnИes 
@mysql_select_db($nomdelabdd, $bdd);   								 // sИlection de la Base de donnИes

$requete = @mysql_db_query($nomdelabdd,"SELECT * FROM pays ORDER BY nompays ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete5 = @mysql_db_query($nomdelabdd,"SELECT * FROM type
										 WHERE indiceclient='T'
										 ORDER BY nomtype ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close();

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection Ю la Base de donnИes
$nomdelabdd="authentique";       										// le nom de la Base de donnИes 
@mysql_select_db($nomdelabdd, $bdd);   								 // sИlection de la Base de donnИes

// Test de securite pour savoir ki afficher dans les listes deroulantes
if ($saphira >= 4)
	{
	$requete1 = @mysql_db_query($nomdelabdd,"SELECT * FROM utilisateur 
										 	 WHERE idutil=\"$log\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$requete2 = @mysql_db_query($nomdelabdd,"SELECT * FROM utilisateur 
										 	 WHERE idutil=\"$log\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$requete3 = @mysql_db_query($nomdelabdd,"SELECT * FROM utilisateur 
										 	 WHERE idutil=\"$log\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
	else
	{
	$requete1 = @mysql_db_query($nomdelabdd,"SELECT * FROM utilisateur 
										 	 WHERE groupe BETWEEN '3' AND '6'
										 	 ORDER BY nom ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$requete2 = @mysql_db_query($nomdelabdd,"SELECT * FROM utilisateur 
										 	 WHERE groupe BETWEEN '3' AND '6'
										 	 ORDER BY nom ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$requete3 = @mysql_db_query($nomdelabdd,"SELECT * FROM utilisateur 
										 	 WHERE groupe BETWEEN '3' AND '6'
										 	 ORDER BY nom ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requete4 = @mysql_db_query($nomdelabdd,"SELECT * FROM utilisateur 
										 WHERE groupe BETWEEN '3' AND '6'
										 ORDER BY nom ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close(); 

$annee  = date("Y")-1;
?>
<html>
<head>
<title>Gestion Commerciale SOFIBRA</title>
<base target="corps">
<script src="fonction.js"></script>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script type="text/javascript">
function Choix(formulaire)
{
i = formulaire.option.selectedIndex; 

switch (i) 
	{
	case 1 : 	
	window.document.getElementById("calque1").style.visibility = 'visible';
	window.document.getElementById("calque2").style.visibility = 'hidden';
			  
	break;
	case 2 : 
	window.document.getElementById("calque2").style.visibility = 'visible';
	window.document.getElementById("calque1").style.visibility = 'hidden';
	
	break;
	case 3 : 
	window.document.getElementById("calque2").style.visibility = 'visible';
	window.document.getElementById("calque1").style.visibility = 'hidden';
	
	break;
	case 4 : 
	window.document.getElementById("calque2").style.visibility = 'visible';
	window.document.getElementById("calque1").style.visibility = 'hidden';
	
	break;
	}
} 
</script> 
</head>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>

<table border="0" width="90%">
<tr>
<td>
<div align='left' class='titre'><h3>Requ&ecirc;tes sur le Suivi Commercial...</h3></div>
</td>
<td></td>
</tr>

<tr>
<td>
<form action="resultat.php" methode="POST" onSubmit="return controlreq15();">
<input type="hidden" name="requete" value="15">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation du Rapport hebdomadaire pour 
<select name="rce">
    <? while ($val1 = mysql_fetch_array($requete1)) { ?>
    <option value='<? echo $val1["siglerce"]; ?>'><? echo $val1["prenom"]." ".$val1["nom"]; ?></option>	
	<? } ?>
</select>
du (JJ/MM/AA) <input type="text" name="dateap" size="8" maxlength="8">
&nbsp;au <input type="text" name="datedp" size="8" maxlength="8">
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST" onSubmit="return controlreq17();">
<input type="hidden" name="requete" value="12">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation des Relances pour 
<select name="rce">
    <? while ($val2 = mysql_fetch_array($requete2)) { ?>
    <option value='<? echo $val2["siglerce"]; ?>'><? echo $val2["prenom"]." ".$val2["nom"]; ?></option>	
	<? } ?>
</select>
du (JJ/MM/AA) <input type="text" name="dateap" size="8" maxlength="8">
&nbsp;au <input type="text" name="datedp" size="8" maxlength="8">
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form name="form2" action="resultat.php" methode="POST" onSubmit="return controlreq16();">
<input type="hidden" name="requete" value="16">
<img src="images/menu_fleche_2.gif" align="absmiddle">Mailing : Visualisation 
<select name="type_client">
    <option value="C" SELECTED>de tous les clients</option>
    <option value="P">de tous les prospects</option>
</select>

<select name="option" onChange='Choix(this.form)'>
    <option selected>--- Choisissez une rubrique ---</option>
    <option value="cp">dont le Code Postal</option>	
	<option value="ville">dont la Ville</option>	
	<option value="pays">dont le Pays</option>	
	<option value="secteur">dont le Secteur Economique</option>	
</select>
pour
<select name="rce">
    if ($saphira <= 2) { echo "<option value='tous'>Tous</option>"; }
    <? while ($val3 = mysql_fetch_array($requete3)) { ?>
    <option value='<? echo $val3["siglerce"]; ?>'><? echo $val3["prenom"]." ".$val3["nom"]; ?></option>	
	<? } ?>
</select>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
<tr>
<td>
<div id="calque1" style="position:absolute; visibility:hidden">
commence par&nbsp;
<input type="text" size="10" maxlength="10" name="opt">
</div>
<div id="calque2" style="visibility:hidden">
contient&nbsp;
<input type="text" size="15" maxlength="15" name="opd">
</div>
<br>
<div class="anotation" align="left">( <i>ATTENTION</i>, pour cette requête le temps de r&eacute;ponse peut être long... )</div>
</td>
<td>
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="29">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation de toutes les adresses e-mails 
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
pour les clients et les contacts
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="23">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation des Clients interess&eacute;s par 
<select name="option">
<option value="uninteret" SELECTED>H&#244;tel *</option>
<option value="deuinteret">H&#244;tel **</option>
<option value="troiinteret">H&#244;tel ***</option>
<option value="plusinteret">H&#244;tel ++++</option>
<option value="individuinteret">Individuel</option>
<option value="indiapinteret">Appartement</option>
<option value="indichalinteret">Chalet</option>
<option value="indimobinteret">MobileHome</option>
<option value="poncinteret">Groupe ponctuel</option>
<option value="serinteret">Groupe en s&eacute;ries</option>
<option value="adulinteret">Groupe d'adultes</option>
<option value="etudinteret">Groupe d'etudiants</option>
<option value="rosregion">Roscoff</option>
<option value="vanregion">Vannes</option>
<option value="brestregion">Brest</option>
<option value="dolregion">Dol de Bretagne</option>
<option value="marsregion">Marseille</option>
<option value="orleregion">Orl&eacute;ans</option>
<option value="quimregion">Quimper</option>
<option value="renregion">Rennes</option>
<option value="lorregion">Lorient</option>
<option value="parisregion">Paris</option>
<option value="aixregion">Aix en provence</option>
<option value="stmalregion">St Malo</option>
<option value="nantregion">Nantes</option>
<option value="mansregion">Le Mans</option>
<option value="dijonregion">Dijon</option>
</select>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<?php
	// Affichage des requetes suivi commercial uniquement pour les groupes 1,2 et 3
	if (($saphira == 1)||($saphira == 2)||($saphira == 3))
	{
?>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="8">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation des nouveaux Clients 
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
pour l'ann&eacute;e
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006'>2006</option>
	<option value='2007' SELECTED>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
  </select>
<br>
<div class="anotation" align="left">( <i>ATTENTION</i>, pour cette requête le temps de r&eacute;ponse peut être long... )</div>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="11">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation de la liste des Soci&eacute;t&eacute;s et Contacts pr&eacute;sents sur le salon
<input type="text" name="salon">
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="2">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation de tous les Clients pour 
<select name="rce">
    <? while ($val4 = mysql_fetch_array($requete4)) { ?>
    <option value='<? echo $val4["siglerce"]; ?>'><? echo $val4["prenom"]." ".$val4["nom"]; ?></option>	
	<? } ?>
</select>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="3">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation tous les Clients dont le pays contient
<input type="text" name="option1" size="8" maxlength="8">
 et dont le code commence par
<input type="text" name="option2" size="3" maxlength="3">
<br>
<div class="anotation" align="left">( <i>ATTENTION</i>, pour cette requête le temps de r&eacute;ponse peut être long... )</div>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="4">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation tous les Clients dont le type est
<select name="option1">
    <? while ($val5 = mysql_fetch_array($requete5)) { ?>
    <option value='<? echo $val5["idtype"]; ?>' SELECTED><? echo $val5["nomtype"]; ?></option>	
	<? } ?>
</select>
 et dont le pays contient
<input type="text" name="option2" size="8" maxlength="8">
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>
<?php
	// Fin de if pour la securite des 4 dernieres requetes suivi commercial 
	} 
break;

// Cas ou requete est sur les statistiques
case 'stat':

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection Ю la Base de donnИes
$nomdelabdd="commercial";       										// le nom de la Base de donnИes 
@mysql_select_db($nomdelabdd, $bdd);   								 // sИlection de la Base de donnИes

$requete = @mysql_db_query($nomdelabdd,"SELECT * FROM pays ORDER BY nompays ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete5 = @mysql_db_query($nomdelabdd,"SELECT * FROM type
										 WHERE indiceclient='T'
										 ORDER BY nomtype ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close();

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection Ю la Base de donnИes
$nomdelabdd="statistique";       										// le nom de la Base de donnИes 
@mysql_select_db($nomdelabdd, $bdd);   								 // sИlection de la Base de donnИes

$requete6 = @mysql_db_query($nomdelabdd,"SELECT * 
										 FROM hotel 
										 WHERE nummin <> 0
										 ORDER BY nomhotel ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");

@mysql_close();
$annee  = date("Y")-1;
?>
<html>
<head>
<title>Gestion Commerciale SOFIBRA</title>
<base target="corps">
<script src="fonction.js"></script>
<link rel="stylesheet" href="sofibra.css" type="text/css">
</head>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>

<table border="0" width="90%">
<tr>
<td>
<div align='left' class='titre'><h3>Requ&ecirc;tes sur les Statistiques...</h3></div>
</td>
<td>
</td>
</tr>

<?php
if ( $saphira < 5 )
	{
?>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="13">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation des Clients
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
dont le Code Postal commence par  
<input type="text" name="cp" size="3" maxlength="3">
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="26">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation des Prospects 
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
dont le Code Postal commence par  
<input type="text" name="cp" size="3" maxlength="3">
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="1">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation du CA et du nbre de Nuit&eacute;es pour l'ann&eacute;e
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006'>2006</option>
	<option value='2007' SELECTED>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
  </select> par Mois et par H&ocirc;tel pour
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
<br>
<div class="anotation" align="left">( <i>ATTENTION</i>, pour cette requête le temps de r&eacute;ponse peut être long... )</div>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="5">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation du CA et du nbre de Nuit&eacute;es pour l'ann&eacute;e
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006'>2006</option>
	<option value='2007' SELECTED>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
  </select> au
<select name="pays">
    <? while ($val = mysql_fetch_array($requete)) { ?>
    <option value='<? echo $val["idpays"]; ?>' SELECTED><? echo $val["nompays"]; ?></option>	
	<? } ?>
</select>
pour 
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="7">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation des destinations pr&eacute;f&eacute;r&eacute;es des Clients pour l'ann&eacute;e
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006'>2006</option>
	<option value='2007' SELECTED>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
  </select>,
 par H&ocirc;tel et en CA pour
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
<br>
<div class="anotation" align="left">( <i>ATTENTION</i>, pour cette requête le temps de r&eacute;ponse peut être long... )</div>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="10">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation des Clients 
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
qui consomment tous les ans depuis l'ann&eacute;e 2003
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="14">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation du TOP 50 des Clients 
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
ayant r&eacute;alis&eacute;s le plus gros CA pour l'ann&eacute;e
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006'>2006</option>
	<option value='2007' SELECTED>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
  </select>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<?php
// Fin du if pour $saphira < 5
	}
if ( $saphira < 4)
		{
?>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="6">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation du CA Total de<br> tous les Clients 
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
 par Pays et pour H&ocirc;tel 
<select name="hotel">
    <? while ($val = mysql_fetch_array($requete6)) { ?>
    <option value='<? echo $val["codehotel"]; ?>' SELECTED><? echo $val["nomhotel"]; ?></option>	
	<? } ?>
</select>
pour l'ann&eacute;e
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006'>2006</option>
	<option value='2007' SELECTED>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
  </select>
<br>
<div class="anotation" align="left">( <i>ATTENTION</i>, pour cette requête le temps de r&eacute;ponse peut être long... )</div>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<?
// Fin du if		}
?>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="9">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation par Client
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>, nbres de Nuit&eacute; et CA Total pour le mois de 
<select name="option">
    <option value='1' SELECTED>Janvier</option>	
	<option value='2'>F&eacute;vrier</option>	
	<option value='3'>Mars</option>	
	<option value='4'>Avril</option>	
	<option value='5'>Mai</option>	
	<option value='6'>Juin</option>	
	<option value='7'>Juillet</option>	
	<option value='8'>Ao&ucirc;t</option>	
	<option value='9'>Septembre</option>	
	<option value='10'>Octobre</option>	
	<option value='11'>Novembre</option>	
	<option value='12'>D&eacute;cembre</option>	
</select>
de l'ann&eacute;e
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006'>2006</option>
	<option value='2007' SELECTED>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
</select>
<br>
<div class="anotation" align="left">( <i>ATTENTION</i>, pour cette requête le temps de r&eacute;ponse peut être long... )</div>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="20">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation par Client
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>, nbres de Nuit&eacute; et CA Total cumul&eacute; au mois de 
<select name="option">
    <option value='1' SELECTED>Janvier</option>	
	<option value='2'>F&eacute;vrier</option>	
	<option value='3'>Mars</option>	
	<option value='4'>Avril</option>	
	<option value='5'>Mai</option>	
	<option value='6'>Juin</option>	
	<option value='7'>Juillet</option>	
	<option value='8'>Ao&ucirc;t</option>	
	<option value='9'>Septembre</option>	
	<option value='10'>Octobre</option>	
	<option value='11'>Novembre</option>	
	<option value='12'>D&eacute;cembre</option>	
</select>
de l'ann&eacute;e
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006'>2006</option>
	<option value='2007' SELECTED>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
</select>
<br>
<div class="anotation" align="left">( <i>ATTENTION</i>, pour cette requête le temps de r&eacute;ponse peut être long... )</div>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<?php
if ( $saphira < 4)
		{
?>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="18">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation des Clients 
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
qui ont consomm&eacute; en
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006'>2006</option>
	<option value='2007' SELECTED>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
  </select>
<br>
<div class="anotation" align="left">( <i>ATTENTION</i>, pour cette requête le temps de r&eacute;ponse peut être long... )</div>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="19">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation du TOP 50 des Clients
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
 pour le mois de 
<select name="mois">
<option SELECTED value="1">Janvier</option>
<option value="2">F&eacute;vrier</option>
<option value="3">Mars</option>
<option value="4">Avril</option>
<option value="5">Mai</option>
<option value="6">Juin</option>
<option value="7">Juillet</option>
<option value="8">Aout</option>
<option value="9">Septembre</option>
<option value="10">Octobre</option>
<option value="11">Novembre</option>
<option value="12">D&eacute;cembre</option>
</select>
et pour l'ann&eacute;e
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006'>2006</option>
	<option value='2007' SELECTED>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
  </select>
<br>
<div class="anotation" align="left">( <i>ATTENTION</i>, pour cette requête le temps de r&eacute;ponse peut être long... )</div>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<?
		}
?>
</table>
</body>
</html>
<?
break;

// Cas ou requete est sur le flash
case 'flash':
?>
<html>
<head>
<title>Gestion Commerciale SOFIBRA</title>
<base target="corps">
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script src="fonction.js"></script>
</head>
<body>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<div align='left' class='titre'><h3>Requ&ecirc;tes sur le Flash...</h3></div>
</html>
<?
break;

// Cas ou requete est sur les annulation et refus
case 'refus':

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection Ю la Base de donnИes
$nomdelabdd="commercial";       										// le nom de la Base de donnИes 
@mysql_select_db($nomdelabdd, $bdd);   								 // sИlection de la Base de donnИes
$requete = @mysql_db_query($nomdelabdd,"SELECT * FROM pays ORDER BY nompays ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete1 = @mysql_db_query($nomdelabdd,"SELECT * FROM pays ORDER BY nompays ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close();
?>
<html>
<head>
<title>Gestion Commerciale SOFIBRA</title>
<base target="corps">
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script src="fonction.js"></script>
</head>
<body>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<table border="0" width="90%">
<tr>
<td>
<div align='left' class='titre'><h3>Requ&ecirc;tes sur les Annulations et Refus...</h3></div>
</td>
<td>
</td>
</tr>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="27">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation des annulations pour Client
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
par mois et pour l'ann&eacute;e 
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006' SELECTED>2006</option>
	<option value='2007'>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
  </select>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="28">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation des refus pour Client
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
par mois et pour l'ann&eacute;e 
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006' SELECTED>2006</option>
	<option value='2007'>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
  </select>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="24">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation des annulations pour Client
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
 par Pays
<select name="pays">
    <option value='tous' SELECTED>Tous</option>
	<? while ($val = mysql_fetch_array($requete)) { ?>
    <option value='<? echo $val["idpays"]; ?>' ><? echo $val["nompays"]; ?></option>	
	<? } ?>
  </select>
par mois et pour l'ann&eacute;e 
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006' SELECTED>2006</option>
	<option value='2007'>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
  </select>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

<tr>
<td>
<form action="resultat.php" methode="POST">
<input type="hidden" name="requete" value="25">
<img src="images/menu_fleche_2.gif" align="absmiddle">Visualisation des refus pour Client
<select name="indice">
<option value="T" SELECTED>Tourisme</option>
<option value="S">Soci&eacute;t&eacute;</option>
</select>
 par Pays
<select name="pays">
    <option value='tous' SELECTED>Tous</option>
	<? while ($val = mysql_fetch_array($requete1)) { ?>
    <option value='<? echo $val["idpays"]; ?>' ><? echo $val["nompays"]; ?></option>	
	<? } ?>
  </select>
par mois et pour l'ann&eacute;e 
<select name="an">
    <option value='2002'>2002</option>
	<option value='2003'>2003</option>
	<option value='2004'>2004</option>
	<option value='2005'>2005</option>
	<option value='2006' SELECTED>2006</option>
	<option value='2007'>2007</option>
	<option value='2008'>2008</option>
	<option value='2009'>2009</option>
	<option value='2010'>2010</option>
  </select>
</td>
<td align="center">
<input type="submit" name="go" value="Goooo">
</td>
</tr>
</form>

</table>
</html>
<?
break;

// Cas ou requete est total pour les parametrables
case 'para':
?>
<html>
<head>
<title>Gestion Commerciale SOFIBRA</title>
<base target="corps">
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script src="fonction.js"></script>
</head>
<body>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<div align='left' class='titre'><h3>Requ&ecirc;tes Param&eacute;trables Suivi Commercial...</h3></div>
<div align='left' class='titre'><h3>Requ&ecirc;tes Param&eacute;trables Statistiques...</h3></div>
<div align='left' class='titre'><h3>Requ&ecirc;tes Param&eacute;trables Flash...</h3></div>
</html>
<?
break;
}
?>
