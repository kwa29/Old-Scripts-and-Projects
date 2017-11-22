<? include("Admin/sessions.php") ?>
<?php
include("Admin/includes/fonctions.php");        //Connection a la base Statistique 
// Initialisation des variables
if ( ! isset($ok)) $ok=NULL;

switch ($ok) {    

// Modification de fiche dans Mysql
case 'Enregistrer':

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="commercial";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);                             	   // sélection de la Base de données

// Cas ou les new ont ete utilise
if (@$denomination1 <> NULL)
{
$requetea = @mysql_db_query($nomdelabdd,"SELECT * FROM denom
										 WHERE nomdenom=\"$denomination1\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenua = mysql_numrows($requetea);			// Teste si les champs existe deja dans la base
if ($contenua == NULL)
	{
	$requete = @mysql_db_query($nomdelabdd,"INSERT INTO denom (nomdenom)
  										    VALUES (\"$denomination1\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requete = @mysql_db_query($nomdelabdd,"SELECT MAX(iddenom)AS iddenom FROM denom")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val = mysql_fetch_array($requete);
$denomination = $val[iddenom];
}

if (@$type1 <> NULL)	
{	
$requeteb = @mysql_db_query($nomdelabdd,"SELECT * FROM type
										 WHERE nomtype=\"$type1\"
										 AND indiceclient=\"$typeclient\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenub = mysql_numrows($requeteb);			// Teste si les champs existe deja dans la base
if ($contenub == NULL)
	{
	$requete = @mysql_db_query($nomdelabdd,"INSERT INTO type (nomtype,indiceclient)
  										    VALUES (\"$type1\",\"$typeclient\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requete1 = @mysql_db_query($nomdelabdd,"SELECT MAX(idtype)AS idtype FROM type 
										 WHERE indiceclient=\"$typeclient\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val1 = mysql_fetch_array($requete1);
$type = $val1[idtype];
}

if (@$pays1 <> NULL)
{
$requetec = @mysql_db_query($nomdelabdd,"SELECT * FROM pays
										 WHERE nompays=\"$pays1\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenuc = mysql_numrows($requetec);			// Teste si les champs existe deja dans la base
if ($contenuc == NULL)
	{
	$requete = @mysql_db_query($nomdelabdd,"INSERT INTO pays (nompays)
 	 									    VALUES (\"$pays1\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requete2 = @mysql_db_query($nomdelabdd,"SELECT MAX(idpays)AS idpays FROM pays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val2 = mysql_fetch_array($requete2);
$pays = $val2[idpays];
}

if (@$ville1 <> NULL)
{
$requeted = @mysql_db_query($nomdelabdd,"SELECT * FROM ville
										 WHERE nomville=\"$ville1\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenud = mysql_numrows($requeted);			// Teste si les champs existe deja dans la base
if ($contenud == NULL)
	{
	$requete = @mysql_db_query($nomdelabdd,"INSERT INTO ville (nomville)
 	 									    VALUES (\"$ville1\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requete3 = @mysql_db_query($nomdelabdd,"SELECT MAX(idville)AS idville FROM ville")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val3 = mysql_fetch_array($requete3);
$ville = $val3[idville];
}

if (@$typcontrat1 <> NULL)
{
$requetee = @mysql_db_query($nomdelabdd,"SELECT * FROM contrat
										 WHERE siglecontrat=\"$contrat1\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenue = mysql_numrows($requetee);			// Teste si les champs existe deja dans la base
if ($contenue == NULL)
	{
	$requete = @mysql_db_query($nomdelabdd,"INSERT INTO contrat (siglecontrat)
 	 									    VALUES (\"$contrat1\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requete4 = @mysql_db_query($nomdelabdd,"SELECT MAX(idcontrat)AS idcontrat FROM contrat")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val4 = mysql_fetch_array($requete4);
$contrat = $val4[idcontrat];
}

if (@$secteur1 <> NULL)
{
$requetef = @mysql_db_query($nomdelabdd,"SELECT * FROM secteur
										 WHERE nomsecteur=\"$secteur1\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenuf = mysql_numrows($requetef);			// Teste si les champs existe deja dans la base
if ($contenuf == NULL)
	{
	$requete = @mysql_db_query($nomdelabdd,"INSERT INTO secteur (nomsecteur)
 	 									    VALUES (\"$secteur1\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requete5 = @mysql_db_query($nomdelabdd,"SELECT MAX(idsecteur)AS idsecteur FROM secteur")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val5 = mysql_fetch_array($requete5);
$secteur = $val5[idsecteur];
}

if (@$implantation1 <> NULL)
{
$requeteg = @mysql_db_query($nomdelabdd,"SELECT * FROM implant
										 WHERE nomimplant=\"$implantation1\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenug = mysql_numrows($requeteg);			// Teste si les champs existe deja dans la base
if ($contenug == NULL)
	{
	$requete = @mysql_db_query($nomdelabdd,"INSERT INTO implant (nomimplant)
	  									    VALUES (\"$implantation1\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requete6 = @mysql_db_query($nomdelabdd,"SELECT MAX(idimplant)AS idimplant FROM implant")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val6 = mysql_fetch_array($requete6);
$implantation = $val6[idimplant];
}

if (@$reseau1 <> NULL)
{
$requeteh = @mysql_db_query($nomdelabdd,"SELECT * FROM reseau
										 WHERE nomreseau=\"$reseau1\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenuh = mysql_numrows($requeteh);			// Teste si les champs existe deja dans la base
if ($contenuh == NULL)
	{
	$requete = @mysql_db_query($nomdelabdd,"INSERT INTO reseau (nomreseau)
  										    VALUES (\"$reseau1\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requete7 = @mysql_db_query($nomdelabdd,"SELECT MAX(idreseau)AS idreseau FROM reseau")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val7 = mysql_fetch_array($requete7);
$reseau = $val7[idreseau];
}

// Conversion des champs pour insertion dans la base
if ($taille == '< à 50'){$taille = 1;}
if ($taille == 'de 50 à 100'){$taille = 2;}
if ($taille == 'de 100 à 200'){$taille = 3;}
if ($taille == '> à 200'){$taille = 4;}
if ($taille == 'Inconnu'){$taille = 5;}
$date = transformmysql_date($date);
@$nom=addslashes($nom);	
@$adresse=addslashes($adresse);
@$mail=addslashes($mail);
@$site=addslashes($site);
@$fax=addslashes($fax);
@$nationalite=addslashes($nationalite);
@$appartenance=addslashes($appartenance);
@$remark=addslashes($remark);							

$requete = @mysql_db_query($nomdelabdd,"UPDATE client SET
										idsecteur=\"$secteur\",
										idcontrat=\"$contrat\",
										idimplant=\"$implantation\",
										iddenom=\"$denomination\",
										idtype=\"$type\",
										idreseau=\"$reseau\",
										idpays=\"$pays\",
										idville=\"$ville\",
										nomclient=\"$nom\",
										adresseclient=\"$adresse\",
										telclient=\"$telephone\",
										mailclient=\"$mail\",
										siteclient=\"$site\",
										faxclient=\"$fax\",
										cedexclient=\"$cedex\",
										cpclient=\"$cp\",
										dateclient=\"$date\",
										tailleclient=\"$taille\",
										nationclient=\"$nationalite\",
										contratclient=\"$newcontrat\",
										origineclient=\"$appartenance\",
										remarkclient=\"$remark\"
										WHERE idclient='$numero'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
// Fenetre popup children avec fermeture + rechargement de la page mere
echo "<html><head>";
echo "<script language='JavaScript1.2'>
	  window.location; self.close();
	  opener.document.location.reload(); 
	  </script>";
echo "</head></html>";

break;

// Fiche en modification
case 'Modif':

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
// Pour connaitre l'utilisateur et inserer son sigle
$nomdelabdd2="authentique";        // le nom de la Base de données 
@mysql_select_db($nomdelabdd2, $bdd);                                // sélection de la Base de données
$req = @mysql_db_query($nomdelabdd2,"SELECT siglerce,groupe FROM utilisateur WHERE idutil='$log'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$valreq = mysql_fetch_array($req);
// Pour le remplissage des listes deroulantes
$nomdelabdd="commercial";        // le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);                                // sélection de la Base de données
$requete = @mysql_db_query($nomdelabdd,"SELECT *
										FROM client 
										WHERE codeclient='$code'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu = mysql_fetch_array($requete);
$requete1 = @mysql_db_query($nomdelabdd,"SELECT * FROM denom ORDER BY nomdenom ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete2 = @mysql_db_query($nomdelabdd,"SELECT * FROM type 
										 WHERE indiceclient='$contenu[indiceclient]' 
										 ORDER BY nomtype ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete3 = @mysql_db_query($nomdelabdd,"SELECT * FROM pays ORDER BY nompays ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete4 = @mysql_db_query($nomdelabdd,"SELECT * FROM ville ORDER BY nomville ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete5 = @mysql_db_query($nomdelabdd,"SELECT * FROM contrat ORDER BY siglecontrat ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete6 = @mysql_db_query($nomdelabdd,"SELECT * FROM secteur ORDER BY nomsecteur ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete7 = @mysql_db_query($nomdelabdd,"SELECT * FROM implant ORDER BY nomimplant ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete8 = @mysql_db_query($nomdelabdd,"SELECT * FROM reseau ORDER BY nomreseau ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
?>
<html>
<head>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script src="fonction.js"></script>
</head>
<title>GESCOM &copy;</title>
<body>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<div align='left' class='titre' style="position:absolute; left:10px; top:0px;">
<h3>Client sofibra <?php echo($code);?>...</h3>
</div>

<form name="form1" action="client.php" method="POST">
<input type='hidden' name='numero' value=<?php echo "$numero"; ?>>
<input type='hidden' name='typeclient' value=<?php echo "$contenu[indiceclient]"; ?>>
<div style="position:absolute; left:10px; top:57px; height:46px; z-index:1"> 
Code du Client 
<?php echo "<b>$code</b>"; ?>&nbsp;&nbsp; 
Nom du Client 
<input type="text" name="nom" size="40" value="<?php echo "$contenu[nomclient]"; ?>">    
</div>

<div id="calque_type" style="position:absolute; left:495px; top:57px; z-index:1"> 
Type
<select name="type">
<? while ($val2 = mysql_fetch_array($requete2)) { 
    if ($contenu["idtype"] == $val2["idtype"]) 
	{ 
	echo "<option value=\"".$val2["idtype"]."\" selected>".$val2["nomtype"]."</option>\n"; 
	} 
	else 
	{ 
	echo "<option value=\"".$val2["idtype"]."\">".$val2["nomtype"]."</option>\n"; 
	} 
													}
	?>
</select>
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=type')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div>
<div id="calque_type_h" style="position:absolute; left:495px; top:57px; height:46px; z-index:1; visibility:hidden"> 
Type
<input type="text" name="type1" size="20">
</div>

<div id="calque_denom" style="position:absolute; left:15px; top:93px; height:46px; z-index:1">
D&eacute;nomination  
<select name="denomination">
<? while ($val1 = mysql_fetch_array($requete1)) { 
    if ($contenu["iddenom"] == $val1["iddenom"]) 
	{ 
	echo "<option value=\"".$val1["iddenom"]."\" selected>".$val1["nomdenom"]."</option>\n"; 
	} 
	else 
	{ 
	echo "<option value=\"".$val1["iddenom"]."\">".$val1["nomdenom"]."</option>\n"; 
	} 
													}
	?>
</select>
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=denomination')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div>
<div id="calque_denom_h" style="position:absolute; left:15px; top:93px; height:46px; z-index:1; visibility:hidden">
D&eacute;nomination  
<input type="text" name="denomination1" size="15">
</div>

<div style="position:absolute; left:285px; top:93px; height:37px; z-index:4">
Nouveau Contrat <input type="checkbox" name="newcontrat" value="1" <? if(@$contenu[contratclient] == 1) echo "CHECKED"; ?>>
</div>

<div id="calque_typecon" style="position:absolute; left:542px; top:93px; height:37px; z-index:4">
Type de Contrat 
<select name="contrat">
<? while ($val5 = mysql_fetch_array($requete5)) { 
    if ($contenu["idcontrat"] == $val5["idcontrat"]) 
	{ 
	echo "<option value=\"".$val5["idcontrat"]."\" selected>".$val5["siglecontrat"]."</option>\n"; 
	} 
	else 
	{ 
	echo "<option value=\"".$val5["idcontrat"]."\">".$val5["siglecontrat"]."</option>\n"; 
	} 
													}
	?>
</select> 
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=contrat')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div> 
<div id="calque_typecon_h" style="position:absolute; left:542px; top:93px; height:37px; z-index:4; visibility:hidden">
Type de Contrat 
<input type="text" name="contrat1" size="3">
</div>

<div style="position:absolute; left:43px; top:129px; height:24px; z-index:11">Adresse 
</div>

<div style="position:absolute; left:94px; top:129px; height:84px; z-index:3"> 
<textarea name="adresse" rows="3"><?php echo "$contenu[adresseclient]"; ?></textarea>
</div>

<div style="position:absolute; left:320px; top:129px; height:34px; z-index:14">T&eacute;l&eacute;phone 
<input type="text" name="telephone" size="20" value="<?php echo "$contenu[telclient]"; ?>">
</div>

<div style="position:absolute; left:358px; top:165px; height:36px; z-index:12">Fax 
<input type="text" name="fax" value="<?php echo "$contenu[faxclient]"; ?>">
</div>

<div style="position:absolute; left:28px; top:200px; height:37px; z-index:4">
Code Postal <input type="text" name="cp" size="10" maxlength="10" value="<?php echo "$contenu[cpclient]"; ?>">
</div>

<div style="position:absolute; left:205px; top:200px; height:37px; z-index:4">
Cedex <input type="text" name="cedex" size="10" maxlength="10" value="<?php echo "$contenu[cedexclient]"; ?>">
</div>  

<div id="calque_ville" style="position:absolute; left:355px; top:200px;  height:37px; z-index:4">
Ville 
<select name="ville">
<? while ($val4 = mysql_fetch_array($requete4)) { 
    if ($contenu["idville"] == $val4["idville"]) 
	{ 
	echo "<option value=\"".$val4["idville"]."\" selected>".$val4["nomville"]."</option>\n"; 
	} 
	else 
	{ 
	echo "<option value=\"".$val4["idville"]."\">".$val4["nomville"]."</option>\n"; 
	} 
													}
	?>
</select> 
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=ville')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div>
<div id="calque_ville_h" style="position:absolute; left:355px; top:200px;  height:37px; z-index:4; visibility:hidden">
Ville
<input type="text" name="ville1" size="35">
</div>

<div style="position:absolute; left:27px; top:235px; height:29px; z-index:15">
<a class='menu' href='http://<?php echo "$contenu[siteclient]"; ?>' target="_blank">Site Internet</a>  
<input type="text" name="site" size="36" value="<?php echo "$contenu[siteclient]"; ?>">
</div>

<div style="position:absolute; left:343px; top:235px; height:34px; z-index:14">
<a class='menu' href='mailto:<?php echo "$contenu[mailclient]"; ?>'>E-Mail</a>  
<input type="text" name="mail" size="36" value="<?php echo "$contenu[mailclient]"; ?>">
</div>

<div style="position:absolute; left:35px; top:270px; height:37px; z-index:4">
Nationalit&eacute; <input type="text" name="nationalite" size="10" maxlength="10" value="<?php echo "$contenu[nationclient]"; ?>">
</div>

<div id="calque_pays" style="position:absolute; left:353px; top:270px; height:37px; z-index:4">
Pays 
<select name="pays">
<? while ($val3 = mysql_fetch_array($requete3)) { 
    if ($contenu["idpays"] == $val3["idpays"]) 
	{ 
	echo "<option value=\"".$val3["idpays"]."\" selected>".$val3["nompays"]."</option>\n"; 
	} 
	else 
	{ 
	echo "<option value=\"".$val3["idpays"]."\">".$val3["nompays"]."</option>\n"; 
	} 
													}
	?>
</select>
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=pays')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div>  
<div id="calque_pays_h" style="position:absolute; left:353px; top:270px; height:37px; z-index:4; visibility:hidden">
Pays
<input type="text" name="pays1" size="20">
</div>

<div style="position:absolute; left:120px; top:305px; height:37px; z-index:4">
Taille de l'Entreprise 
  <input type="radio" name="taille" <? if(@$contenu[tailleclient] == 1) echo "CHECKED"; ?> value="1">
  &lt; &agrave; 50 
  <input type="radio" name="taille" <? if(@$contenu[tailleclient] == 2) echo "CHECKED"; ?> value="2">
  de 50 &agrave; 100 
  <input type="radio" name="taille" <? if(@$contenu[tailleclient] == 3) echo "CHECKED"; ?> value="3">
  de 100 &agrave; 200 
  <input type="radio" name="taille" <? if(@$contenu[tailleclient] == 4) echo "CHECKED"; ?> value="4">
  &gt; &agrave; 200 
  <input type="radio" name="taille" <? if(@$contenu[tailleclient] == 5) echo "CHECKED"; ?> value="5">
  Inconnu 
</div>

<div id="calque_secteur" style="position:absolute; left:10px; top:340px; height:37px; z-index:4">
Secteur Economique
<select name="secteur">
<? while ($val6 = mysql_fetch_array($requete6)) { 
    if ($contenu["idsecteur"] == $val6["idsecteur"]) 
	{ 
	echo "<option value=\"".$val6["idsecteur"]."\" selected>".$val6["nomsecteur"]."</option>\n"; 
	} 
	else 
	{ 
	echo "<option value=\"".$val6["idsecteur"]."\">".$val6["nomsecteur"]."</option>\n"; 
	} 
													}
	?>
</select>  
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=secteur')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div>  
<div id="calque_secteur_h" style="position:absolute; left:10px; top:340px; height:37px; z-index:4; visibility:hidden">
Secteur Economique
<input type="text" name="secteur1" size="25">
</div>

<div id="calque_implant" style="position:absolute; left:380px; top:340px; height:37px; z-index:4">
Forme d'Implantation 
<select name="implantation">
<? while ($val7 = mysql_fetch_array($requete7)) { 
    if ($contenu["idimplant"] == $val7["idimplant"]) 
	{ 
	echo "<option value=\"".$val7["idimplant"]."\" selected>".$val7["nomimplant"]."</option>\n"; 
	} 
	else 
	{ 
	echo "<option value=\"".$val7["idimplant"]."\">".$val7["nomimplant"]."</option>\n"; 
	} 
													}
	?>
</select>
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=implantation')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div>
<div id="calque_implant_h" style="position:absolute; left:380px; top:340px; height:37px; z-index:4; visibility:hidden">
Forme d'Implantation 
<input type="text" name="implantation1" size="25">
</div>

<div id="calque_reseau" style="position:absolute; left:10px; top:376px; height:37px; z-index:4">
R&eacute;seau d'Appartenance 
<select name="reseau">
<? while ($val8 = mysql_fetch_array($requete8)) { 
    if ($contenu["idreseau"] == $val8["idreseau"]) 
	{ 
	echo "<option value=\"".$val8["idreseau"]."\" selected>".$val8["nomreseau"]."</option>\n"; 
	} 
	else 
	{ 
	echo "<option value=\"".$val8["idreseau"]."\">".$val8["nomreseau"]."</option>\n"; 
	} 
													}
	?>
</select>
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=reseau')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div>
<div id="calque_reseau_h" style="position:absolute; left:10px; top:376px; height:37px; z-index:4; visibility:hidden">
R&eacute;seau d'Appartenance 
<input type="text" name="reseau1" size="20">
</div>

<div style="position:absolute; left:350px; top:376px; height:37px; z-index:4">
ou Groupe d'Appartenance <input type="text" name="appartenance" value="<?php echo "$contenu[origineclient]"; ?>">
</div>

<div style="position:absolute; left:20px; top:415px; height:37px; z-index:4">
Remarques
</div>
<div style="position:absolute; left:96px; top:415px; height:37px; z-index:4">
<textarea name="remark" rows="5" cols="40"><?php echo "$contenu[remarkclient]"; ?></textarea>
</div>

<div style="position:absolute; left:340px; top:415px; height:37px; z-index:4">
Client depuis le (JJ/MM/AA)
<?
$date = transformfrench_date(@$contenu[dateclient]);
$date = split("/",$date); 
$date[2] = substr($date[2],2);
?>
<input type='text' name='date' size='8' maxlength='8' value="<?php if ($date[2] == NULL){echo " ";} else {echo "$date[0]/$date[1]/$date[2]";} ?>">
</div>

<div style="position:absolute; left:385px; top:455px;height:37px; z-index:4">
<?php
echo "<input type='submit' name='ok' value='Enregistrer'>&nbsp;";
echo "<input type='reset' name='effacer' value='Effacer'>&nbsp;";
echo "<input type='button' name='active' value='D&eacute;sactiver' onClick=window.open('client.php?ok=Active&numeroduclient=$contenu[codeclient]','visu','left=5,top=10,width=200,height=200,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')>&nbsp;";
echo "<input type='button' name='fermer' value='Fermer' onClick='window.close()'>";
?>
</div>

</form>
</body>
</html>
<?php
break;

case 'Active':

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="commercial";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);                             	   // sélection de la Base de données
$requp = @mysql_db_query($nomdelabdd,"UPDATE client SET
									  etat='0'
									  WHERE codeclient='$numeroduclient'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
// Fenetre popup children avec fermeture + rechargement de la page mere
echo "<html><head>";
echo "<script language='JavaScript1.2'>
	  window.location; self.close();
	  </script>";
echo "</head></html>";


break;

// Insertion d'une nouvelle fiche client
case 'Valider': 

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="commercial";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);                             	   // sélection de la Base de données

// Cas ou les new ont ete utilise
if (@$denomination1 <> NULL)
{
$requetea = @mysql_db_query($nomdelabdd,"SELECT * FROM denom
										 WHERE nomdenom=\"$denomination1\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenua = mysql_numrows($requetea);			// Teste si les champs existe deja dans la base
if ($contenua == NULL)
	{
	$requete = @mysql_db_query($nomdelabdd,"INSERT INTO denom (nomdenom)
  										    VALUES (\"$denomination1\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requete = @mysql_db_query($nomdelabdd,"SELECT MAX(iddenom)AS iddenom FROM denom")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val = mysql_fetch_array($requete);
$denomination = $val[iddenom];
}

if (@$type1 <> NULL)	
{	
$requeteb = @mysql_db_query($nomdelabdd,"SELECT * FROM type
										 WHERE nomtype=\"$type1\"
										 AND indiceclient=\"$typeclient\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenub = mysql_numrows($requeteb);			// Teste si les champs existe deja dans la base
if ($contenub == NULL)
	{
	$requete = @mysql_db_query($nomdelabdd,"INSERT INTO type (nomtype,indiceclient)
  										    VALUES (\"$type1\",\"$typeclient\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requete1 = @mysql_db_query($nomdelabdd,"SELECT MAX(idtype)AS idtype FROM type 
										 WHERE indiceclient=\"$typeclient\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val1 = mysql_fetch_array($requete1);
$type = $val1[idtype];
}

if (@$pays1 <> NULL)
{
$requetec = @mysql_db_query($nomdelabdd,"SELECT * FROM pays
										 WHERE nompays=\"$pays1\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenuc = mysql_numrows($requetec);			// Teste si les champs existe deja dans la base
if ($contenuc == NULL)
	{
	$requete = @mysql_db_query($nomdelabdd,"INSERT INTO pays (nompays)
 	 									    VALUES (\"$pays1\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requete2 = @mysql_db_query($nomdelabdd,"SELECT MAX(idpays)AS idpays FROM pays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val2 = mysql_fetch_array($requete2);
$pays = $val2[idpays];
}

if (@$ville1 <> NULL)
{
$requeted = @mysql_db_query($nomdelabdd,"SELECT * FROM ville
										 WHERE nomville=\"$ville1\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenud = mysql_numrows($requeted);			// Teste si les champs existe deja dans la base
if ($contenud == NULL)
	{
	$requete = @mysql_db_query($nomdelabdd,"INSERT INTO ville (nomville)
 	 									    VALUES (\"$ville1\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requete3 = @mysql_db_query($nomdelabdd,"SELECT MAX(idville)AS idville FROM ville")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val3 = mysql_fetch_array($requete3);
$ville = $val3[idville];
}

if (@$typcontrat1 <> NULL)
{
$requetee = @mysql_db_query($nomdelabdd,"SELECT * FROM contrat
										 WHERE siglecontrat=\"$contrat1\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenue = mysql_numrows($requetee);			// Teste si les champs existe deja dans la base
if ($contenue == NULL)
	{
	$requete = @mysql_db_query($nomdelabdd,"INSERT INTO contrat (siglecontrat)
 	 									    VALUES (\"$contrat1\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requete4 = @mysql_db_query($nomdelabdd,"SELECT MAX(idcontrat)AS idcontrat FROM contrat")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val4 = mysql_fetch_array($requete4);
$contrat = $val4[idcontrat];
}

if (@$secteur1 <> NULL)
{
$requetef = @mysql_db_query($nomdelabdd,"SELECT * FROM secteur
										 WHERE nomsecteur=\"$secteur1\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenuf = mysql_numrows($requetef);			// Teste si les champs existe deja dans la base
if ($contenuf == NULL)
	{
	$requete = @mysql_db_query($nomdelabdd,"INSERT INTO secteur (nomsecteur)
 	 									    VALUES (\"$secteur1\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requete5 = @mysql_db_query($nomdelabdd,"SELECT MAX(idsecteur)AS idsecteur FROM secteur")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val5 = mysql_fetch_array($requete5);
$secteur = $val5[idsecteur];
}

if (@$implantation1 <> NULL)
{
$requeteg = @mysql_db_query($nomdelabdd,"SELECT * FROM implant
										 WHERE nomimplant=\"$implantation1\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenug = mysql_numrows($requeteg);			// Teste si les champs existe deja dans la base
if ($contenug == NULL)
	{
	$requete = @mysql_db_query($nomdelabdd,"INSERT INTO implant (nomimplant)
	  									    VALUES (\"$implantation1\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requete6 = @mysql_db_query($nomdelabdd,"SELECT MAX(idimplant)AS idimplant FROM implant")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val6 = mysql_fetch_array($requete6);
$implantation = $val6[idimplant];
}

if (@$reseau1 <> NULL)
{
$requeteh = @mysql_db_query($nomdelabdd,"SELECT * FROM reseau
										 WHERE nomreseau=\"$reseau1\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenuh = mysql_numrows($requeteh);			// Teste si les champs existe deja dans la base
if ($contenuh == NULL)
	{
	$requete = @mysql_db_query($nomdelabdd,"INSERT INTO reseau (nomreseau)
  										    VALUES (\"$reseau1\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requete7 = @mysql_db_query($nomdelabdd,"SELECT MAX(idreseau)AS idreseau FROM reseau")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val7 = mysql_fetch_array($requete7);
$reseau = $val7[idreseau];
}
// Conversion des champs pour insertion dans la base
if ($taille == '< à 50'){$taille = 1;}
if ($taille == 'de 50 à 100'){$taille = 2;}
if ($taille == 'de 100 à 200'){$taille = 3;}
if ($taille == '> à 200'){$taille = 4;}
if ($taille == 'Inconnu'){$taille = 5;}
@$nom=addslashes($nom);	
@$adresse=addslashes($adresse);
@$mail=addslashes($mail);
@$site=addslashes($site);
@$fax=addslashes($fax);
@$nationalite=addslashes($nationalite);
@$appartenance=addslashes($appartenance);
@$remark=addslashes($remark);							
@$date=transformmysql_date($date);

// Utilisation d'une requete pour connaitre l'existence d'une fiche dans la base
$requetea = @mysql_db_query($nomdelabdd,"SELECT * FROM client
										 WHERE codeclient=\"$code\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$compte = mysql_numrows($requetea); 
if ($compte == NULL)
{
$requete = @mysql_db_query($nomdelabdd,"INSERT INTO client (
										idclient,
										etat,
										idrce,
										idsecteur,
										idcontrat,
										idimplant,
										iddenom,
										idtype,
										idreseau,
										idpays,
										idville,
										codeclient,
										indiceclient,
										nomclient,
										adresseclient,
										telclient,
										mailclient,
										siteclient,
										faxclient,
										cedexclient,
										cpclient,
										dateclient,
										tailleclient,
										nationclient,
										contratclient,
										origineclient,
										remarkclient)
										VALUES (
										null,
										'1',
										'$rce',
										\"$secteur\",
										\"$contrat\",
										\"$implantation\",
										\"$denomination\",
										\"$type\",
										\"$reseau\",
										\"$pays\",
										\"$ville\",
										\"$code\",										  
										\"$typeclient\",										 
										\"$nom\",										  
										\"$adresse\",
										\"$telephone\",
										\"$mail\",
										\"$site\",
										\"$fax\",
										\"$cedex\",
										\"$cp\",
										\"$date\",
										\"$taille\",
										\"$nationalite\",
										\"$newcontrat\",
										\"$appartenance\",
										\"$remark\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
// Fenetre popup children avec fermeture + rechargement de la page mere
echo "<html><head>";
echo "<script language='JavaScript1.2'>
	  window.location; self.close();
	  opener.document.location.reload(); 
	  </script>";
echo "</head></html>";
}
// Cas ou la fiche est deja existante
	else
		{
		$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
		$nomdelabdd="authentique";       										// le nom de la Base de données 
		@mysql_select_db($nomdelabdd, $bdd);                             	   // sélection de la Base de données

		$requetea = @mysql_db_query($nomdelabdd,"SELECT * FROM utilisateur WHERE idutil='$log'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
		$contenua = @mysql_fetch_array ($requetea);
		@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin

		echo "<title>Fiche Existante dans la base de Données</title>
		<link rel='stylesheet' href='sofibra.css' type='text/css'>";
		echo "<br><br><br><br><center><font color='#CE3A05'><h1><b>La fiche est déjà existante sous le même code...</b><br>Dommage <b>$contenua[prenom]</b>...</h1></font>
		<br><br>
		<input type='button' name='fermer' value='Fermer' onClick='window.close()'></center>";
		}

break;

default:

// Nouveau formulaire d'un nouveau Client
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="authentique";        // le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);                                // sélection de la Base de données
$requete9 = @mysql_db_query($nomdelabdd,"SELECT * FROM utilisateur 
										 WHERE idutil=\"$log\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@$bruno = mysql_fetch_array($requete9);
@mysql_close();
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="commercial";        // le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);                                // sélection de la Base de données
$requete = @mysql_db_query($nomdelabdd,"SELECT * FROM denom ORDER BY nomdenom ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete1 = @mysql_db_query($nomdelabdd,"SELECT * FROM type 
										 WHERE indiceclient=\"$type\" 
										 ORDER BY nomtype ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete2 = @mysql_db_query($nomdelabdd,"SELECT * FROM pays ORDER BY nompays ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete3 = @mysql_db_query($nomdelabdd,"SELECT * FROM ville ORDER BY nomville ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete4 = @mysql_db_query($nomdelabdd,"SELECT * FROM contrat ORDER BY siglecontrat ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete5 = @mysql_db_query($nomdelabdd,"SELECT * FROM secteur ORDER BY nomsecteur ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete6 = @mysql_db_query($nomdelabdd,"SELECT * FROM implant ORDER BY nomimplant ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete7 = @mysql_db_query($nomdelabdd,"SELECT * FROM reseau ORDER BY nomreseau ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Recherche du dernier codeclient disponible pour le user en TOURISME
if ($type=='T')
{
$requete8 = @mysql_db_query($nomdelabdd,"SELECT MAX(codeclient)AS codeclient
										 FROM client
										 WHERE codeclient >= '$bruno[nummin]'
										 AND codeclient <= '$bruno[nummax]'
										 AND codeclient LIKE '95%'
										 OR codeclient LIKE '96%'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val8 = mysql_fetch_array($requete8); 
}
// Recherche du dernier codeclient disponible pour le user en SOCIETE ou PARTICULIER
if ($type=='S' || $type=='P')
{
$requete8 = @mysql_db_query($nomdelabdd,"SELECT MAX(codeclient)AS codeclient
										 FROM client
										 WHERE codeclient >= '$bruno[nummin]'
										 AND codeclient <= '$bruno[nummax]'
										 AND codeclient NOT LIKE '95%'
										 AND codeclient NOT LIKE '96%'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val8 = mysql_fetch_array($requete8);
}

@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin

// Cas ou le user n'est pas connu/na jamais cree de fiche
if ($val8['codeclient'] == NULL)
{
// Si le code n'existe pas on prend le premier donc le $bruno[nummin] devient 1er code
$val8['codeclient'] = $bruno['nummin'];
}
// Transformation de texte pour affichage
if ($type=='S'){$typeclient="Société";}
if ($type=='T'){$typeclient="Tourisme";}
if ($type=='P'){$typeclient="Particulier";}
// Augmentation du code +1
$val8['codeclient'] = $val8['codeclient'] + 1;

?>
<html>
<head>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script src="fonction.js"></script>
</head>
<title>GESCOM &copy;</title>
<body>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<div align='left' class='titre'><h3>Nouveau Client Sofibra de type <?php echo "$typeclient"; ?>...</h3></div>

<form name="form1" action="client.php" method="POST" onSubmit="return controlclient();">
<?php
echo "<input type='hidden' name='typeclient' value=\"$typeclient\">";
echo "<input type='hidden' name='rce' value=\"$bruno[siglerce]\">";
?> 
<div style="position:absolute; left:10px; top:57px; height:46px; z-index:1"> 
Code du Client 
<input type='text' name='code' size='6' maxlength='6' <? echo "value=$val8[codeclient]"; ?>>&nbsp; 
Nom du Client 
<input type="text" name="nom" size="40">    
</div>

<div id="calque_type" style="position:absolute; left:495px; top:57px; z-index:1"> 
Type
<select name="type">
<? while ($val1 = mysql_fetch_array($requete1)) { ?>
<option value='<? echo $val1["idtype"]; ?>'><? echo $val1["nomtype"]; ?></option>
<? } ?>
</select>
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=type')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div>
<div id="calque_type_h" style="position:absolute; left:495px; top:57px; height:46px; z-index:1; visibility:hidden"> 
Type
<input type="text" name="type1" size="20">
</div>

<div id="calque_denom" style="position:absolute; left:15px; top:93px; height:46px; z-index:1">
D&eacute;nomination  
<select name="denomination">
<? while ($val = mysql_fetch_array($requete)) { ?>
<option value='<? echo $val["iddenom"]; ?>'><? echo $val["nomdenom"]; ?></option>
<? } ?>
</select>
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=denomination')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div>
<div id="calque_denom_h" style="position:absolute; left:15px; top:93px; height:46px; z-index:1; visibility:hidden">
D&eacute;nomination  
<input type="text" name="denomination1" size="15">
</div>

<div style="position:absolute; left:285px; top:93px; height:37px; z-index:4">
Nouveau Contrat <input type="checkbox" name="newcontrat" value="1">
</div>

<div id="calque_typecon" style="position:absolute; left:542px; top:93px; height:37px; z-index:4">
Type de Contrat 
<select name="contrat">
<? while ($val4 = mysql_fetch_array($requete4)) { ?>
<option value='<? echo $val4["idcontrat"]; ?>'><? echo $val4["siglecontrat"]; ?></option>
<? } ?>
</select> 
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=contrat')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div> 
<div id="calque_typecon_h" style="position:absolute; left:542px; top:93px; height:37px; z-index:4; visibility:hidden">
Type de Contrat 
<input type="text" name="contrat1" size="3">
</div>

<div style="position:absolute; left:43px; top:129px; height:24px; z-index:11">Adresse 
</div>

<div style="position:absolute; left:94px; top:129px; height:84px; z-index:3"> 
<textarea name="adresse" rows="3"></textarea>
</div>

<div style="position:absolute; left:320px; top:129px; height:34px; z-index:14">T&eacute;l&eacute;phone 
<input type="text" name="telephone" size="20">
</div>

<div style="position:absolute; left:358px; top:165px; height:36px; z-index:12">Fax 
<input type="text" name="fax">
</div>

<div style="position:absolute; left:28px; top:200px; height:37px; z-index:4">
Code Postal <input type="text" name="cp" size="10" maxlength="10">
</div>

<div style="position:absolute; left:205px; top:200px; height:37px; z-index:4">
Cedex <input type="text" name="cedex" size="10" maxlength="10">
</div>  

<div id="calque_ville" style="position:absolute; left:355px; top:200px;  height:37px; z-index:4">
Ville 
<select name="ville">
<? while ($val3 = mysql_fetch_array($requete3)) { ?>
<option value='<? echo $val3["idville"]; ?>'><? echo $val3["nomville"]; ?></option>
<? } ?>
</select> 
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=ville')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div>
<div id="calque_ville_h" style="position:absolute; left:355px; top:200px;  height:37px; z-index:4; visibility:hidden">
Ville
<input type="text" name="ville1" size="35">
</div>

<div style="position:absolute; left:27px; top:235px; height:29px; z-index:15">Site 
Internet 
<input type="text" name="site" size="25">
</div>

<div style="position:absolute; left:343px; top:235px; height:34px; z-index:14">E-Mail  
<input type="text" name="mail" size="25">
</div>

<div style="position:absolute; left:35px; top:270px; height:37px; z-index:4">
Nationalit&eacute; <input type="text" name="nationalite" size="10" maxlength="10">
</div>

<div id="calque_pays" style="position:absolute; left:353px; top:270px; height:37px; z-index:4">
Pays 
<select name="pays">
<? while ($val2 = mysql_fetch_array($requete2)) { ?>
<option value='<? echo $val2["idpays"]; ?>'><? echo $val2["nompays"]; ?></option>
<? } ?>
</select>
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=pays')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div>  
<div id="calque_pays_h" style="position:absolute; left:353px; top:270px; height:37px; z-index:4; visibility:hidden">
Pays
<input type="text" name="pays1" size="20">
</div>

<div style="position:absolute; left:120px; top:305px; height:37px; z-index:4">
Taille de l'Entreprise 
  <input type="radio" name="taille" value="1">
  &lt; &agrave; 50 
  <input type="radio" name="taille" value="2">
  de 50 &agrave; 100 
  <input type="radio" name="taille" value="3">
  de 100 &agrave; 200 
  <input type="radio" name="taille" value="4">
  &gt; &agrave; 200 
  <input type="radio" name="taille" value="5" CHECKED>
  Inconnu 
</div>

<div id="calque_secteur" style="position:absolute; left:10px; top:340px; height:37px; z-index:4">
Secteur Economique
<select name="secteur">
<? while ($val5 = mysql_fetch_array($requete5)) { ?>
<option value='<? echo $val5["idsecteur"]; ?>'><? echo $val5["nomsecteur"]; ?></option>
<? } ?>
</select>  
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=secteur')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div>  
<div id="calque_secteur_h" style="position:absolute; left:10px; top:340px; height:37px; z-index:4; visibility:hidden">
Secteur Economique
<input type="text" name="secteur1" size="25">
</div>

<div id="calque_implant" style="position:absolute; left:380px; top:340px; height:37px; z-index:4">
Forme d'Implantation 
<select name="implantation">
<? while ($val6 = mysql_fetch_array($requete6)) { ?>
<option value='<? echo $val6["idimplant"]; ?>'><? echo $val6["nomimplant"]; ?></option>
<? } ?>
</select>
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=implantation')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div>
<div id="calque_implant_h" style="position:absolute; left:380px; top:340px; height:37px; z-index:4; visibility:hidden">
Forme d'Implantation 
<input type="text" name="implantation1" size="25">
</div>

<div id="calque_reseau" style="position:absolute; left:10px; top:376px; height:37px; z-index:4">
R&eacute;seau d'Appartenance 
<select name="reseau">
<? while ($val7 = mysql_fetch_array($requete7)) { ?>
<option value='<? echo $val7["idreseau"]; ?>'><? echo $val7["nomreseau"]; ?></option>
<? } ?>
</select>
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=reseau')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div>
<div id="calque_reseau_h" style="position:absolute; left:10px; top:376px; height:37px; z-index:4; visibility:hidden">
R&eacute;seau d'Appartenance 
<input type="text" name="reseau1" size="20">
</div>

<div style="position:absolute; left:350px; top:376px; height:37px; z-index:4">
ou Groupe d'Appartenance <input type="text" name="appartenance">
</div>

<div style="position:absolute; left:20px; top:415px; height:37px; z-index:4">
Remarques
</div>
<div style="position:absolute; left:96px; top:415px; height:37px; z-index:4">
<textarea name="remark" rows="5" cols="40"></textarea>
</div>

<div style="position:absolute; left:340px; top:415px; height:37px; z-index:4">
Client depuis le (JJ/MM/AA)
<?php
$lejour = date("d");          // dit au script que la variable "$lejour" correspond à "day"
$lemois = date("m");         // dit au script que la variable "$lemois" correspond à "month"
$annee  = date("y");        // dit au script que la variable "$annee" correspond à "Year"
@$date_origine = $lejour.'/'.$lemois.'/'.$annee;
echo "<input type='text' name='date' size='8' maxlength='8' value=\"$date_origine\">";
?>
</div>

<div style="position:absolute; left:385px; top:455px;height:37px; z-index:4">
<input type="submit" name="ok" value="Valider">&nbsp;
<input type="reset" name="effacer" value="Effacer">&nbsp;
<input type="button" name="fermer" value="Fermer" onClick="window.close()">
</div>

</form>
</body>
</html>
<?
}
?>
