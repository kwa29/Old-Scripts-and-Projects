<? include("Admin/sessions.php") ?>
<?
include("Admin/includes/fonctions.php");        //Connection a la base Statistique 

switch (@$ok) { 

case 'Modifier':

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="commercial";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);   								 // sélection de la Base de données
// Mise en forme des variables pour mise a jour
if ($civilite1 <> NULL)
{
$requete1 = @mysql_db_query($nomdelabdd,"SELECT siglecivil FROM civil
										 WHERE siglecivil='$civilite1'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu1 = mysql_numrows($requete1);			// Teste si les champs existe deja dans la base
	if ($contenu1 == NULL)
	{
	$requete = @mysql_db_query($nomdelabdd,"INSERT INTO civil (siglecivil)
  										    VALUES ('$civilite1')")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requetea = @mysql_db_query($nomdelabdd,"SELECT MAX(idcivil)AS idcivil FROM civil")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenua = @mysql_fetch_array ($requetea);
$civilite = $contenua[idcivil];
}

if ($fonction1 <> NULL)
{
$requete2 = @mysql_db_query($nomdelabdd,"SELECT nomfonction FROM fonction
										 WHERE nomfonction='$fonction1'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu2 = mysql_numrows($requete2);			// Teste si les champs existe deja dans la base
	if ($contenu2 == NULL)
	{
	$requete = @mysql_db_query($nomdelabdd,"INSERT INTO fonction (nomfonction)
	  									    VALUES ('$fonction1')")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requetea = @mysql_db_query($nomdelabdd,"SELECT MAX(idfonction)AS idfonction FROM fonction")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenua = @mysql_fetch_array ($requetea);
$fonction = $contenua[idfonction];
}

if ($service1 <> NULL)
{
$requete3 = @mysql_db_query($nomdelabdd,"SELECT nomservice FROM service
										 WHERE nomservice='$service1'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu3 = mysql_numrows($requete3);			// Teste si les champs existe deja dans la base
	if ($contenu3 == NULL)
	{
	$requete = @mysql_db_query($nomdelabdd,"INSERT INTO service (nomservice)
	  									    VALUES ('$service1')")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requetea = @mysql_db_query($nomdelabdd,"SELECT MAX(idservice)AS idservice FROM service")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenua = @mysql_fetch_array ($requetea);
$service = $contenua[idservice];
}

if ($metro1 <> NULL)
{
$requete5 = @mysql_db_query($nomdelabdd,"SELECT nommetro FROM metro
										 WHERE nommetro='$metro1'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu5 = mysql_numrows($requete5);			// Teste si les champs existe deja dans la base
	if ($contenu5 == NULL)
	{
	$requete = @mysql_db_query($nomdelabdd,"INSERT INTO metro (nommetro)
 	 									    VALUES ('$metro1')")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requetea = @mysql_db_query($nomdelabdd,"SELECT MAX(idmetro)AS idmetro FROM metro")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenua = @mysql_fetch_array ($requetea);
$metro = $contenua[idmetro];
}

$nom=addslashes($nom);
$prenom=addslashes($prenom);
$adresse=addslashes($adresse);
$mail=addslashes($mail);
$telephone=addslashes($telephone);
$fax=addslashes($fax);
$mail=addslashes($mail);
$origine=addslashes($origine);
// Mise a jour d'une fiche
// Pour information $didier me renvoie le idcontact en cours
$requete7 = @mysql_db_query($nomdelabdd,"UPDATE contact SET
					idfonction=\"$fonction\",
					idservice=\"$service\",
					idcivil=\"$civilite\",
					idmetro=\"$metro\",
					idville=\"$ville\",
					nomcontact=\"$nom\",
					prenomcontact=\"$prenom\",
					adressecontact=\"$adresse\",
					cpcontact=\"$cp\",
					telcontact=\"$telephone\",
					mailcontact=\"$mail\",
					portcontact=\"$portable\",
					faxcontact=\"$fax\",
					originecontact=\"$origine\"
					WHERE idcontact='$didier'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete8 = @mysql_query("UPDATE liencontact SET
			idclient=\"$code\",
			idcontact=$didier
			WHERE idcontact='$didier'",$bdd)or die ("Erreur de requete:".mysql_error());
/* Redirige le client*/
redirect_url("suivicontact.php?ok=Modif&code=$code&codecontact=$didier");

@mysql_close();
break;

// Fiche Contact en Modif
case 'Modif':

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="commercial";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);   								 // sélection de la Base de données
// Remplissage des champs du formulaire
$requete = @mysql_db_query($nomdelabdd,"SELECT *
										FROM contact
										WHERE idcontact='$codecontact'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu = mysql_fetch_array($requete);
$requete1 = @mysql_db_query($nomdelabdd,"SELECT * FROM civil ORDER BY siglecivil ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete2 = @mysql_db_query($nomdelabdd,"SELECT * FROM fonction ORDER BY nomfonction ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete3 = @mysql_db_query($nomdelabdd,"SELECT * FROM service ORDER BY nomservice ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete4 = @mysql_db_query($nomdelabdd,"SELECT * FROM ville ORDER BY nomville ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete5 = @mysql_db_query($nomdelabdd,"SELECT * FROM metro ORDER BY nommetro ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Remplissage du tableau de suivi
$requetes = @mysql_db_query($nomdelabdd,"SELECT *
										 FROM suivi s,liensuivi l,typsuivi t
										 WHERE s.idsuivi=l.idsuivi										 
										 AND l.idcontact='$codecontact'
										 AND s.idtypsuivi=t.idtypsuivi
										 ORDER BY s.idsuivi DESC
										 LIMIT 0,5")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Pour connaitre l'utilisateur et inserer son sigle
$nomdelabdd2="authentique";        // le nom de la Base de données 
@mysql_select_db($nomdelabdd2, $bdd);                                // sélection de la Base de données
$req = @mysql_db_query($nomdelabdd2,"SELECT * FROM utilisateur WHERE idutil='$log'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$valreq = mysql_fetch_array($req);
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
?>
<html>
<head>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script src="fonction.js"></script>
</head>
<body>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<div align='left' class='titre'><h3>Contact <?php echo "$contenu[nomcontact]"; ?> du client <?php echo "$code"; ?>...</h3></div>
<center>
<input type="button" value="Produit Utilis&eacute;" onClick="window.open('suiviproduit.php?code=<? echo "$contenu[idcontact]"; ?>','produit','left=10,top=10,width=660,height=450,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')">
<input type="button" value="Brochure" onClick="window.open('suivibrochure.php?ok&code=<? echo "$contenu[idcontact]"; ?>','produit','left=40,top=150,width=600,height=250,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no')">
<input type="button" value="Information Personnelle" onClick="window.open('suiviperso.php?code=<? echo "$contenu[idcontact]"; ?>','perso','left=30,top=150,width=700,height=250,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')">
<input type="button" value="Int&eacute;r&ecirc;t H&ocirc;tel" onClick="open('suivinteret.php?client=<? echo "$code"; ?>&contact=<? echo "$contenu[idcontact]"; ?>','interet','left=20,top=100,width=650,height=460,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')">
<input type="button" value="Productivit&eacute;" onClick="open('statclient.php?ok=2&code=<? echo "$code"; ?>','visu','left=5,top=10,width=780,height=520,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')">
</center>

<form name="menuform" action="suivicontact.php" methode="POST" onSubmit="return controlcontact();">
<input type="hidden" name="code" value="<?php echo "$code"; ?>">
<input type="hidden" name="didier" value="<?php echo "$codecontact"; ?>">

<div id="calque_civil" style="position:absolute; left:25px; top:100px; height:46px; z-index:1"> 
Civilit&eacute; 
<select name="civilite">
	<? while ($val1 = mysql_fetch_array($requete1)) { 
    if ($contenu['idcivil'] == $val1['idcivil']) 
	{ 
	echo "<option value=\"".$val1['idcivil']."\" selected>".$val1['siglecivil']."</option>\n"; 
	} 
	else 
	{ 
	echo "<option value=\"".$val1['idcivil']."\">".$val1['siglecivil']."</option>\n"; 
	} 
													}
	?>
</select>
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=civilite')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div>
<div id="calque_civil_h" style="position:absolute; left:25px; top:100px; height:46px; z-index:1; visibility:hidden">
Civilit&eacute; 
<input type="text" name="civilite1" size="15">
</div>

<div style="position:absolute; left:230px; top:100px; height:46px; z-index:1">
Nom 
<input type="text" name="nom" value="<?php echo "$contenu[nomcontact]"; ?>">
&nbsp;&nbsp;&nbsp;
Pr&eacute;nom 
<input type="text" name="prenom" value="<?php echo "$contenu[prenomcontact]"; ?>">  
</div>

<div id="calque_fonction" style="position:absolute; left:14px; top:136px; height:46px; z-index:1"> 
Fonction 
<select name="fonction">
	<? while ($val2 = mysql_fetch_array($requete2)) { 
    if ($contenu['idfonction'] == $val2['idfonction']) 
	{ 
	echo "<option value=\"".$val2['idfonction']."\" selected>".$val2['nomfonction']."</option>\n"; 
	} 
	else 
	{ 
	echo "<option value=\"".$val2['idfonction']."\">".$val2['nomfonction']."</option>\n"; 
	} 
													}
	?>
</select>
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=fonction')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div>

<div id="calque_fonction_h" style="position:absolute; left:14px; top:136px; height:46px; z-index:1; visibility:hidden">
Fonction
<input type="text" name="fonction1" size="15">
</div>

<div id="calque_service" style="position:absolute; left:407px; top:136px; height:46px; z-index:1"> 
Service 
<select name="service">
	<? while ($val3 = mysql_fetch_array($requete3)) { 
    if ($contenu["idservice"] == $val3["idservice"]) 
	{ 
	echo "<option value=\"".$val3['idservice']."\" selected>".$val3['nomservice']."</option>\n"; 
	} 
	else 
	{ 
	echo "<option value=\"".$val3['idservice']."\">".$val3['nomservice']."</option>\n"; 
	} 
													}
	?>
</select>
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=service')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div>
<div id="calque_service_h" style="position:absolute; left:407px; top:136px; height:46px; z-index:1; visibility:hidden">
Service
<input type="text" name="service1" size="15">
</div>

<div style="position:absolute; left:10px; top:172px; height:46px; z-index:1"> 
Adresse
</div>
<div style="position:absolute; left:75px; top:172px; height:46px; z-index:1"> 
<textarea name="adresse" rows="3"><?php echo "$contenu[adressecontact]"; ?></textarea>
</div>

<div style="position:absolute; left:383px; top:172px; height:46px; z-index:1"> 
<a class='menu' href='mailto:<?php echo "$contenu[mailcontact]"; ?>'>E-Mail</a>   
<input type="text" name="mail" size="30" maxlength="50" value="<?php echo "$contenu[mailcontact]"; ?>">
</div>

<div id="calque_metro" style="position:absolute; left:415px; top:208px; height:46px; z-index:1"> 
M&eacute;tro 
<select name="metro">
	<? while ($val5 = mysql_fetch_array($requete5)) { 
    if ($contenu['idmetro'] == $val5['idmetro']) 
	{ 
	echo "<option value=\"".$val5['idmetro']."\" selected>".$val5['nommetro']."</option>\n"; 
	} 
	else 
	{ 
	echo "<option value=\"".$val5['idmetro']."\">".$val5['nommetro']."</option>\n"; 
	} 
													}
	?>
</select>
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=metro')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div>
<div id="calque_metro_h" style="position:absolute; left:415px; top:208px; height:46px; z-index:1; visibility:hidden">
M&eacute;tro
<input type="text" name="metro1" size="15">
</div>

<div style="position:absolute; left:6px; top:244px; height:46px; z-index:1"> 
T&eacute;l&eacute;phone <input type="text" name="telephone" size="15" maxlength="15" value="<?php echo "$contenu[telcontact]"; ?>">
</div>

<div style="position:absolute; left:240px; top:244px; height:46px; z-index:1"> 
Fax <input type="text" name="fax" size="15" maxlength="15" value="<?php echo "$contenu[faxcontact]"; ?>">
</div>

<div style="position:absolute; left:405px; top:244px; height:46px; z-index:1"> 
Portable <input type="text" name="portable" size="13" maxlength="15" value="<?php echo "$contenu[portcontact]"; ?>">
</div>

<div style="position:absolute; left:6px; top:280px; height:46px; z-index:1">
Code Postal <input type="text" name="cp" size="10" maxlength="10"  value="<?php echo "$contenu[cpcontact]"; ?>">
</div>

<div id="calque_ville" style="position:absolute; left:370px; top:280px; height:46px; z-index:1">
Ville 
<select name="ville">
	<? while ($val4 = mysql_fetch_array($requete4)) { 
	$val4['nomville'] = $val4['nomville']." ".$val4['cpville'];
    if ($contenu['idville'] == $val4['idville']) 
	{ 
	echo "<option value=\"".$val4['idville']."\" selected>".$val4['nomville']."</option>\n"; 
	} 
	else 
	{ 
	echo "<option value=\"".$val4['idville']."\">".$val4['nomville']."</option>\n"; 
	} 
													}
	?>
</select> 
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=ville')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div>

<div style="position:absolute; left:80px; top:316px; height:46px; z-index:1"> 
Origine Contact <input type="text" name="origine" size="30" maxlength="30" value="<?php echo "$contenu[originecontact]"; ?>">
</div>

<div style="position:absolute; left:455px; top:316px; height:37px; z-index:4">
<input type='submit' name='ok' value='Modifier'>&nbsp;
<input type='reset' name='effacer' value='Effacer'>&nbsp;
</div>

</form>

<table width='80%' border='1' style="position:absolute; left:10px; top:382px; height:37px; z-index:4">
<tr bgcolor='#FFFF9B' class='news'>  
	<td width='10%'> 
      <div align='center'><b>Date du RDV</b></div>
    </td> 	
	<td width='10%'> 
      <div align='center'><b>Suivi Futur</b></div>
    </td>  
	<td width='10%'> 
      <div align='center'><b>RCE</b></div>
    </td> 
	<td width='10%'> 
      <div align='center'><b>Type de Suivi</b></div>
    </td>	
	<td width='10%'> 
      <div align='center'><b>Lieu</b></div>
    </td>	
	<td width='20%'> 
      <div align='center'><b>R&eacute;sum&eacute;</b></div>
    </td>	
	<td width='10%'> 
      <div align='center'><b>Contenu</b></div>
    </td>	
</tr>
<?php
while($contenus = @mysql_fetch_array ($requetes))
	{
	$datej = transformfrench_date(@$contenus[datesuivi]);
	$datef = transformfrench_date(@$contenus[futursuivi]);
	print "<tr><td><center><a class='menu' href='#' onClick=\"javascript:window.open('suivi.php?type=modif&rce=$valreq[siglerce]&id=$contenus[idsuivi]','produit','left=30,top=30,width=650,height=500,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,copyhistory=0,resizable=no'); return(false);\" >$datej</a></center></td>";
	print "<td><center>$datef</center></td>";
	print "<td><center>$contenus[idrce]</center></td>";
	print "<td><center>$contenus[nomtypsuivi]</center></td>";
	print "<td><center>$contenus[lieusuivi]</center></td>";
	print "<td>$contenus[resumesuivi]</td>";
	print "<td><center><a class='menu' href='#' onClick=window.open('historique.php?type=contenu&code=$codecontact&id=$contenus[idsuivi]','contenu','left=30,top=150,width=600,height=180,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no')><img src='images/Icones/contenu3.ico' border=0 align=absmiddle width=20 height=20 alt='Visualisation du contenu du Contact'></a></center></td>";
	}
print "</tr></table>";
?>
<br>
<div style="position:absolute; left:10px; top:352px; height:37px; z-index:4">
<center>
<input type="button" value="Historique Complet" onClick="open('historique.php?code=<? echo "$codecontact"; ?>','produit','left=20,top=50,width=750,height=400,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no')">
<input type="button" value="Nouveau Suivi" onClick="open('suivi.php?code=<? echo "$codecontact"; ?>&rce=<? echo "$valreq[siglerce]"; ?>','produit','left=30,top=30,width=650,height=500,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')">
</center> 
</div>
</body>
</html>
<?php
break;

case 'Valider':

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="commercial";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);   								 // sélection de la Base de données
// Mise en forme des variables pour insertion
if ($civilite1 <> NULL)
{
$requete1 = @mysql_db_query($nomdelabdd,"SELECT siglecivil FROM civil
										 WHERE siglecivil='$civilite1'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu1 = mysql_numrows($requete1);			// Teste si les champs existe deja dans la base
	if ($contenu1 == NULL)
	{
	$requete = @mysql_db_query($nomdelabdd,"INSERT INTO civil (siglecivil)
  										    VALUES ('$civilite1')")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requetea = @mysql_db_query($nomdelabdd,"SELECT MAX(idcivil)AS idcivil FROM civil")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenua = mysql_fetch_array ($requetea);
$civilite = $contenua[idcivil];
}

if ($fonction1 <> NULL)
{
$requete2 = @mysql_db_query($nomdelabdd,"SELECT nomfonction FROM fonction
										 WHERE nomfonction='$fonction1'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu2 = mysql_numrows($requete2);			// Teste si les champs existe deja dans la base
	if ($contenu2 == NULL)
	{
	$requete = @mysql_db_query($nomdelabdd,"INSERT INTO fonction (nomfonction)
	  									    VALUES ('$fonction1')")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requetea = @mysql_db_query($nomdelabdd,"SELECT MAX(idfonction)AS idfonction FROM fonction")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenua = mysql_fetch_array ($requetea);
$fonction = $contenua[idfonction];
}

if ($service1 <> NULL)
{
$requete3 = @mysql_db_query($nomdelabdd,"SELECT nomservice FROM service
										 WHERE nomservice='$service1'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu3 = mysql_numrows($requete3);			// Teste si les champs existe deja dans la base
	if ($contenu3 == NULL)
	{
	$requete = @mysql_db_query($nomdelabdd,"INSERT INTO service (nomservice)
	  									    VALUES ('$service1')")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requetea = @mysql_db_query($nomdelabdd,"SELECT MAX(idservice)AS idservice FROM service")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenua = @mysql_fetch_array ($requetea);
$service = $contenua[idservice];
}

if ($metro1 <> NULL)
{
$requete5 = @mysql_db_query($nomdelabdd,"SELECT nommetro FROM metro
										 WHERE nommetro='$metro1'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu5 = mysql_numrows($requete5);			// Teste si les champs existe deja dans la base
	if ($contenu5 == NULL)
	{
	$requete = @mysql_db_query($nomdelabdd,"INSERT INTO metro (nommetro)
 	 									    VALUES ('$metro1')")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
$requetea = @mysql_db_query($nomdelabdd,"SELECT MAX(idmetro)AS idmetro FROM metro")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenua = @mysql_fetch_array ($requetea);
$metro = $contenua[idmetro];
}
$nom=addslashes($nom);
$prenom=addslashes($prenom);
$adresse=addslashes($adresse);
$mail=addslashes($mail);
$telephone=addslashes($telephone);
$fax=addslashes($fax);
$mail=addslashes($mail);
$origine=addslashes($origine);
// Insertion d'une nouvelle fiche contact
$requete7 = @mysql_db_query($nomdelabdd,"INSERT INTO contact(
						idrce,
						idfonction,
						idservice,
						idcivil,
						idmetro,
						idville,
						nomcontact,
						prenomcontact,
						adressecontact,
						cpcontact,
						telcontact,
						mailcontact,
						portcontact,
						faxcontact,
						originecontact)
						VALUES (
						\"$rce\",
						\"$fonction\",
						\"$service\",
						\"$civilite\",
						\"$metro\",
						\"$ville\",
						\"$nom\",
						\"$prenom\",
						\"$adresse\",
						\"$cp\",
						\"$telephone\",
						\"$mail\",
						\"$portable\",
						\"$fax\",
						\"$origine\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete8 = @mysql_query("INSERT INTO liencontact 
			(idclient,idcontact)
			VALUES (\"$code\",LAST_INSERT_ID())",$bdd)or die ("Erreur de requete:".mysql_error());
// Fenetre popup children avec fermeture + rechargement de la page mere
echo "<html><head>";
echo "<script language='JavaScript1.2'>
	  window.location; self.close();
	  opener.document.location.reload(); 
	  </script>";
echo "</head></html>";
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
break;

// Nouvelle fiche Contact
default:

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="commercial";        // le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);                                // sélection de la Base de données

$requete1 = @mysql_db_query($nomdelabdd,"SELECT *
										 FROM civil
										 ORDER BY siglecivil ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete2 = @mysql_db_query($nomdelabdd,"SELECT *
										 FROM fonction 
										 ORDER BY nomfonction ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete3 = @mysql_db_query($nomdelabdd,"SELECT *
										 FROM service
										 ORDER BY nomservice ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete4 = @mysql_db_query($nomdelabdd,"SELECT *
										 FROM metro
										 ORDER BY nommetro ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete6 = @mysql_db_query($nomdelabdd,"SELECT * 
										 FROM ville 
										 ORDER BY nomville ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Automatisation du remplissage des champs adresse,cp et ville
$req_ajout = @mysql_db_query($nomdelabdd,"SELECT * 
					  FROM client
					  WHERE codeclient='$code'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val_ajout = mysql_fetch_array($req_ajout);

// Pour connaitre l'utilisateur et inserer son sigle
$nomdelabdd2="authentique";        // le nom de la Base de données 
@mysql_select_db($nomdelabdd2, $bdd);                                // sélection de la Base de données
$req = @mysql_db_query($nomdelabdd2,"SELECT * FROM utilisateur WHERE idutil='$log'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$valreq = mysql_fetch_array($req);
@mysql_close(); 
?>
<html>
<head>
<title>Gestion Commerciale SOFIBRA</title>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script src="fonction.js"></script>
</head>
<body>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<div align='left' class='titre'><h3>Nouveau contact du client <?php echo "$code"; ?>...</h3></div>

<form name="menuform" action="suivicontact.php" methode="POST" onSubmit="return controlcontact();">
<input type="hidden" name="code" value='<?php echo "$code"; ?>'>
<input type="hidden" name="rce" value='<?php echo "$valreq[siglerce]"; ?>'>

<div id="calque_civil" style="position:absolute; left:25px; top:57px; height:46px; z-index:1"> 
Civilit&eacute; 
<select name="civilite">
<? while ($val1 = mysql_fetch_array($requete1)) { ?>
<option value='<? echo $val1["idcivil"]; ?>'><? echo $val1["siglecivil"]; ?></option>	
<? } ?>
</select>
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=civilite')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div>
<div id="calque_civil_h" style="position:absolute; left:25px; top:57px; height:46px; z-index:1; visibility:hidden">
Civilit&eacute; 
<input type="text" name="civilite1" size="15">
</div>

<div style="position:absolute; left:230px; top:57px; height:46px; z-index:1">
Nom 
<input type="text" name="nom">
&nbsp;&nbsp;&nbsp;
Pr&eacute;nom 
<input type="text" name="prenom">  
</div>

<div id="calque_fonction" style="position:absolute; left:14px; top:93px; height:46px; z-index:1"> 
Fonction 
<select name="fonction">
<? while ($val2 = mysql_fetch_array($requete2)) { ?>
<option value='<? echo $val2["idfonction"]; ?>'><? echo $val2["nomfonction"]; ?></option>	
<? } ?>
</select>
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=fonction')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div>

<div id="calque_fonction_h" style="position:absolute; left:14px; top:93px; height:46px; z-index:1; visibility:hidden">
Fonction
<input type="text" name="fonction1" size="15">
</div>

<div id="calque_service" style="position:absolute; left:407px; top:93px; height:46px; z-index:1"> 
Service 
<select name="service">
<? while ($val3 = mysql_fetch_array($requete3)) { ?>
<option value='<? echo $val3["idservice"]; ?>'><? echo $val3["nomservice"]; ?></option>	
<? } ?>
</select>
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=service')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div>
<div id="calque_service_h" style="position:absolute; left:407px; top:93px; height:46px; z-index:1; visibility:hidden">
Service
<input type="text" name="service1" size="15">
</div>

<div style="position:absolute; left:10px; top:129px; height:46px; z-index:1"> 
Adresse
</div>
<div style="position:absolute; left:75px; top:129px; height:46px; z-index:1"> 
<textarea name="adresse" rows="3"><? echo $val_ajout["adresseclient"]; ?></textarea>
</div>

<div style="position:absolute; left:410px; top:129px; height:46px; z-index:1"> 
E-Mail <input type="text" name="mail" size="30" maxlength="50">
</div>

<div id="calque_metro" style="position:absolute; left:415px; top:165px; height:46px; z-index:1"> 
M&eacute;tro 
<select name="metro">
<? while ($val4 = mysql_fetch_array($requete4)) { ?>
<option value='<? echo $val4["idmetro"]; ?>'><? echo $val4["nommetro"]; ?></option>	
<? } ?>
</select>
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=metro')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div>
<div id="calque_metro_h" style="position:absolute; left:415px; top:165px; height:46px; z-index:1; visibility:hidden">
M&eacute;tro
<input type="text" name="metro1" size="15">
</div>

<div style="position:absolute; left:6px; top:201px; height:46px; z-index:1"> 
T&eacute;l&eacute;phone <input type="text" name="telephone" size="15" maxlength="15">
</div>

<div style="position:absolute; left:240px; top:201px; height:46px; z-index:1"> 
Fax <input type="text" name="fax" size="15" maxlength="15">
</div>

<div style="position:absolute; left:405px; top:201px; height:46px; z-index:1"> 
Portable <input type="text" name="portable" size="13" maxlength="15">
</div>

<div style="position:absolute; left:6px; top:237px; height:46px; z-index:1">
Code Postal <input type="text" name="cp" size="10" maxlength="10">
</div>

<div id="calque_ville" style="position:absolute; left:370px; top:237px; height:46px; z-index:1">
Ville
<select name="ville">
	<? while ($val6 = mysql_fetch_array($requete6)) { 
	$val6["nomville"] = $val6["nomville"]." ".$val6["cpville"];
    if ($val_ajout["idville"] == $val6["idville"]) 
	{ 
	echo "<option value=\"".$val6["idville"]."\" selected>".$val6["nomville"]."</option>\n"; 
	} 
	else 
	{ 
	echo "<option value=\"".$val6["idville"]."\">".$val6["nomville"]."</option>\n"; 
	} 
													}
	?>
</select> 
&nbsp;<a href='#' onClick="ouvrir('ajoutmysql.php?type=ville')"><img align='absmiddle' border='0' src='images/new2.gif' alt='Cliquer ici pour ajouter!!!'></a>
</div>

<div style="position:absolute; left:80px; top:273px; height:46px; z-index:1"> 
Origine Contact <input type="text" name="origine" size="30" maxlength="30">
</div>

<div style="position:absolute; left:455px; top:273px; height:37px; z-index:4">
<input type="submit" name="ok" value="Valider">
<input type="button" name="fermer" value="Fermer" onClick="window.close()">
</div>

</form>
</body>
</html>
<?
}
?>
