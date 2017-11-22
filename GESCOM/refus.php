<? include("Admin/sessions.php") ?>
<?php
include("Admin/includes/fonctions.php");        //Connection à la SGBD
// Initialisation des variables
if ( ! isset($ok)) $ok=NULL;

switch ($ok)
{
case 'Modifier':

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="statistique";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);   								 // sélection de la Base de données

@$dateap = transformmysql_date($dateap);
@$datedp = transformmysql_date($datedp);
$requete1 = @mysql_db_query($nomdelabdd,"UPDATE refus SET
										 date_aref=\"$dateap\",
										 date_dref=\"$datedp\",
										 chambre_refus=\"$quantite\",
										 segmen_refus=\"$segmentation\",										 
										 idprix=\"$type\",
										 idmotif=\"$motif\"
										 WHERE idrefus=$id")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Fenetre popup children avec fermeture + rechargement de la page mere
echo "<html><head>";
echo "<script language='JavaScript1.2'>
	  window.location; self.close();
	  opener.document.location.reload(); 
	  </script>";
echo "</head></html>";
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin

break;

case 'modif' :

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="statistique";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);   								 // sélection de la Base de données

$requete = @mysql_db_query($nomdelabdd,"SELECT idprix,nomprix
										FROM prix")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$req_sel = @mysql_db_query($nomdelabdd,"SELECT *
										FROM refus
										WHERE idrefus=$id")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val_sel = @mysql_fetch_array ($req_sel);
$requete2 = @mysql_db_query($nomdelabdd,"SELECT idmotif,nommotif										 
										 FROM motif
										 WHERE siglemotif='R'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close(); 
// Transformation du format de la date pour affichage
$val_sel[date_saisiref] = transforme_date($val_sel[date_saisiref]);
$val_sel[date_aref] = transforme_date($val_sel[date_aref]);
$val_sel[date_dref] = transforme_date($val_sel[date_dref]);
?> 
<html>
<head>
<title>Modification d'un Refus d'un Client SOFIBRA</title>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script src="fonction.js"></script>
</head>
<body>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<div align='left' class='titre'><h3>Refus du Client <?php echo "$val_sel[idclient]"; ?>...</h3></div>
<form name="form1" method="POST" action="refus.php" onSubmit="return validation();">
<?php echo "<input type='hidden' name='id' size='10' maxlength='10' value='$id'>"; ?>
<table cellspacing="15" cellpadding="0">
<tr>
<td>
<div align="right">
Date de saisie
<?php echo "<b>$val_sel[date_saisiref]</b>"; ?>
</div>
</td>
<td>
<div align="right">
Date d'arriv&eacute;e pr&eacute;vue 
<?php 
echo "<input type='text' name='dateap' size='8' maxlength='8' value='$val_sel[date_aref]'>";
echo "&nbsp;&nbsp;<a href='#' onClick=window.open('calendrierarrivee.php','calendrier','left=70,top=250,width=220,height=190,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')><img src='images/calendrier.gif' align='absmiddle' border='0' alt='Cliquer ici pour afficher le calendrier!!!'></a>";
?>
</div>
</td>
<td>
Date de d&eacute;part pr&eacute;vue 
<?php 
echo "<input type='text' name='datedp' size='8' maxlength='8' value='$val_sel[date_dref]'>";
echo "&nbsp;&nbsp;<a href='#' onClick=window.open('calendrierdepart.php','calendrier','left=70,top=250,width=220,height=190,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')><img src='images/calendrier.gif' align='absmiddle' border='0' alt='Cliquer ici pour afficher le calendrier!!!'></a>";
?>
</td>
</tr>
<tr>
<td>
<div align="right">
Nbre de Ch. <input type="text" name="quantite" value='<? echo "$val_sel[chambre_refus]"; ?>'>
</div>
</td>
<td>
Segmentation 
  <input type="text" name="segmentation" value='<? echo "$val_sel[segmen_refus]"; ?>'>
</td>
<td>
<div align="right">
Motifs
<select name="motif">
	<? while ($val = mysql_fetch_array($requete2)) { 
    if ($val_sel["idmotif"] == $val["idmotif"]) 
	{ 
	echo "<option value=\"".$val["idmotif"]."\" selected>".$val["nommotif"]."</option>\n"; 
	} 
	else 
	{ 
	echo "<option value=\"".$val["idmotif"]."\">".$val["nommotif"]."</option>\n"; 
	} 
													}
	?>
	</select>
</div>
</td>
</tr>
<tr>
<td>
<div align="right">
Type de prestation 
    <select name="type">
	<? while ($val = mysql_fetch_array($requete)) { 
    if ($val_sel["idprix"] == $val["idprix"]) 
	{ 
	echo "<option value=\"".$val["idprix"]."\" selected>".$val["nomprix"]."</option>\n"; 
	} 
	else 
	{ 
	echo "<option value=\"".$val["idprix"]."\">".$val["nomprix"]."</option>\n"; 
	} 
													}
	?>
	</select>
</div>
</td>
<td>
<tr>
<td><div align="right">
<input type="submit" name="ok" value="Modifier">
<input type="button" name="fermer" value="Fermer" onClick="window.close()">
</div>
</td>
</tr> 
</td>
</tr>
</table>
</form>
</body>
</html>
<?php
break;

case 'Valider': 

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="statistique";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);   								 // sélection de la Base de données

// Transformation du format de la date pour MySQL
@$datej = transformmysql_date($datej);
@$dateap = transformmysql_date($dateap);
@$datedp = transformmysql_date($datedp);
$annee  = date("y"); 
$lemois = date("m");         // dit au script que la variable "$lemois" correspond à "month"

$requete1 = @mysql_db_query($nomdelabdd,"INSERT INTO refus (idclient,idetablis,idprix,idmotif,date_saisiref,date_aref,date_dref,annee_ref,chambre_refus,segmen_refus,mois)
										 VALUES (
										 \"$code\",
										 \"$hotel\",
										 \"$type\",
										 \"$motif\",
										 \"$datej\",
										 \"$dateap\",
										 \"$datedp\",
										 \"$annee\",
										 \"$quantite\",
										 \"$segmentation\",
										 \"$lemois\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Fenetre popup children avec fermeture + rechargement de la page mere
echo "<html><head>";
echo "<script language='JavaScript1.2'>
	  window.location; self.close();
	  opener.document.location.reload(); 
	  </script>";
echo "</head></html>";
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin

break;

default:

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="statistique";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);   								 // sélection de la Base de données

$requete = @mysql_db_query($nomdelabdd,"SELECT idprix,nomprix
										FROM prix")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Affichage du Host, du navigateur et de l'adresse l'ip
$ip=$REMOTE_ADDR; // Récupère l'adresse IP 
$iptemp=strrpos($ip,'.');   // Modification de l'ip pour traitement avec mysql
$ip=substr_replace($ip,'',$iptemp);
$requete1 = @mysql_db_query($nomdelabdd,"SELECT codehotel FROM hotel 
	 									 WHERE iphotel='$ip'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu1 = @mysql_fetch_array ($requete1);
// Affichage de la date pour obliger les gens a bien la rentrer
$lejour = date("d");          // dit au script que la variable "$lejour" correspond à "day"
$lemois = date("m");         // dit au script que la variable "$lemois" correspond à "month"
$annee  = date("y");        // dit au script que la variable "$annee" correspond à "Year"

$encours = "$lejour/$lemois/$annee";
@$datechoisi='';
$requete2 = @mysql_db_query($nomdelabdd,"SELECT idmotif,nommotif										 
										 FROM motif
										 WHERE siglemotif='R'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
?> 
<html>
<head>
<title>Refus d'un Client SOFIBRA</title>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script src="fonction.js"></script>
</head>
<body>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<div align='left' class='titre'><h3>Refus du Client <?php echo "$code"; ?>...</h3></div>
<form name="form1" method="POST" action="refus.php" onSubmit="return validation();">
<input type="hidden" name="hotel" value="<?php if ($contenu1[codehotel] == NULL){ echo "0"; } else { echo "$contenu1[codehotel]"; } ?>">
<input type="hidden" name="code" value='<?php echo "$code"; ?>'>
<table cellspacing="15" cellpadding="0">
<tr>
<td>
<div align="right">
Date de saisie 
<?php 
echo "<input type='hidden' name='datej' size='8' maxlength='8' value='$encours'>"; 
echo "<b>$encours</b>";
?>
</div>
</td>
<td>
<div align="right">
Date d'arriv&eacute;e pr&eacute;vue 
<?php 
echo "<input type='text' name='dateap' size='8' maxlength='8' value='$datechoisi'>";
echo "&nbsp;&nbsp;<a href='#' onClick=window.open('calendrierarrivee.php','calendrier','left=70,top=250,width=220,height=190,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')><img src='images/calendrier.gif' align='absmiddle' border='0' alt='Cliquer ici pour afficher le calendrier!!!'></a>";
?>
</div>
</td>
<td>
Date de d&eacute;part pr&eacute;vue 
<?php 
echo "<input type='text' name='datedp' size='8' maxlength='8' value='$datechoisi'>";
echo "&nbsp;&nbsp;<a href='#' onClick=window.open('calendrierdepart.php','calendrier','left=70,top=250,width=220,height=190,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')><img src='images/calendrier.gif' align='absmiddle' border='0' alt='Cliquer ici pour afficher le calendrier!!!'></a>";
?>
</td>
</tr>
<tr>
<td>
<div align="right">
Nbre de Ch. <input type="text" name="quantite">
</div>
</td>
<td>
Segmentation 
  <input type="text" name="segmentation">
</td>
<td>
<div align="right">
Motifs
<select name="motif">
	<? while ($val = mysql_fetch_array($requete2)) { ?>
    <option value='<? echo $val["idmotif"]; ?>'><? echo $val["nommotif"]; ?></option>	
	<? } ?>
	</select>
</div>
</td>
</tr>
<tr>
<td>
<div align="right">
Type de prestation 
    <select name="type">
	<? while ($val = mysql_fetch_array($requete)) { ?>
    <option value='<? echo $val["idprix"]; ?>'><? echo $val["nomprix"]; ?></option>	
	<? } ?>
	</select>
</div>
</td>
<td>
<tr>
<td><div align="right">
<input type="submit" name="ok" value="Valider">
<input type="button" name="fermer" value="Fermer" onClick="window.close()">
</div>
</td>
</tr> 
</td>
</tr>
</table>
</form>
</body>
</html>
<?php
break;
}
?>