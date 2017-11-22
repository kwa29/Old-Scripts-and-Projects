<? include("Admin/sessions.php") ?>
<?php
include("Admin/includes/fonctions.php");        //Connection a la base Statistique 

switch (@$ok) { 

case 'Enregistrer':

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="commercial";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);   								 // sélection de la Base de données
$date=addslashes($date);
$nombroche=addslashes($nombroche);
$nombrebroche=addslashes($nombrebroche);
$requete = @mysql_db_query($nomdelabdd,"UPDATE brochure SET
										editionbrochure='$edition',
										datebrochure=\"$date\",
										nombrochure=\"$nombroche\",
										exempbrochure='$nombrebroche'										 				
										WHERE idbrochure='$brochure'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Fenetre popup children
echo "<html><head>";
echo "<script language='JavaScript1.2'>
		window.location; self.close();
		opener.document.location.reload(); 
	  </script>";
echo "</head></html>";
@mysql_close(); 

break;

case 'Modif':

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="commercial";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);   								 // sélection de la Base de données
$requete = @mysql_db_query($nomdelabdd,"SELECT *
										FROM brochure
										WHERE idcontact='$code'
										AND idbrochure='$brochure'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu = @mysql_fetch_array ($requete);
@mysql_close(); 
?>
<html>
<head>
<title>Gestion Commerciale SOFIBRA</title>
<link rel="stylesheet" href="sofibra.css" type="text/css">
</head>
<body>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<div align='left' class='titre'><h3>Brochure...</h3></div>
<form name="form1" action="suivibrochure.php" methode="POST">
<input type="hidden" name="brochure" value='<?php echo "$brochure"; ?>'>
<div id="calque1" style="position:absolute; left:33px; top:57px; height:197px; z-index:1"> 
 <p>Edition d'une Brochure 
    <select name="edition">
	<?
    if ($contenu["editionbrochure"] == 1) 
	{ 
	echo "<option value='1' SELECTED>OUI</option>\n"; 
	echo "<option value='0'>NON</option>\n"; 
	} 
	else 
	{ 
	echo "<option value='1'>OUI</option>\n"; 
	echo "<option value='0' SELECTED>NON</option>\n"; 
	}											
	?>
	</select>
</div>
<div id="calque189" style="position:absolute; left:345px; top:57px; height:197px; z-index:1"> 
   Date d'Edition
    <input type="text" name="date" size="10" maxlength="10" value='<?php echo "$contenu[datebrochure]"; ?>'>
</div>
<div id="calque2" style="position:absolute; left:50px; top:93px; height:197px; z-index:1"> 
  <p>Nom de la Brochure 
    <input type="text" name="nombroche" value='<?php echo "$contenu[nombrochure]"; ?>'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Nombre d'exemplaire 
    <input type="text" name="nombrebroche" size="8" maxlength="8" value='<?php echo "$contenu[exempbrochure]"; ?>'>
  </p>
</div>
<div id="calque3" style="position:absolute; left:345px; top:130px; height:197px; z-index:1"> 
<input type="submit" name="ok" value="Enregistrer">
<input type="button" name="fermer" value="Fermer" onClick="window.close()">
</div>
</form>
</body>
</html>
<?
break;

case 'Valider':

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="commercial";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);   								 // sélection de la Base de données
$date=addslashes($date);
$nombroche=addslashes($nombroche);
$nombrebroche=addslashes($nombrebroche);
$requete = @mysql_db_query($nomdelabdd,"INSERT INTO brochure (
									    idcontact,
										editionbrochure,
										datebrochure,
										nombrochure,
										exempbrochure)
										VALUES (
										'$code',
										'$edition',
										\"$date\",
										\"$nombroche\",
										\"$nombrebroche\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Fenetre popup children
echo "<html><head>";
echo "<script language='JavaScript1.2'>
		window.location; self.close();
		opener.document.location.reload(); 
	  </script>";
echo "</head></html>";
@mysql_close(); 

break;

default:

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="commercial";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);   								 // sélection de la Base de données

$requete = @mysql_db_query($nomdelabdd,"SELECT idbrochure,datebrochure,nombrochure,exempbrochure,editionbrochure
										FROM brochure
										WHERE idcontact='$code'
										ORDER BY idbrochure DESC
										LIMIT 0,10")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete1 = @mysql_db_query($nomdelabdd,"SELECT c.idcontact,b.idcontact,b.idbrochure
										 FROM liencontact c,brochure b
										 WHERE b.idcontact=c.idcontact
										 AND b.idcontact='$code'
										 AND b.idbrochure='$brochure'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu1 = @mysql_fetch_array ($requete1);
@mysql_close();  
?>
<html>
<head>
<title>Gestion Commerciale SOFIBRA</title>
<link rel="stylesheet" href="sofibra.css" type="text/css">
</head>
<body>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<div align='left' class='titre'><h3>Brochure...</h3></div>
<form name="form1" action="suivibrochure.php" methode="POST">
<input type="hidden" name="code" value='<?php echo "$code"; ?>'>
<div id="calque1" style="position:absolute; left:33px; top:57px; height:197px; z-index:1"> 
 <p>Edition d'une Brochure 
    <select name="edition">
   	  <option value="1" SELECTED>OUI</option>
      <option value="0">NON</option>
    </select>
</div>
<div id="calque189" style="position:absolute; left:345px; top:57px; height:197px; z-index:1"> 
   Date d'Edition
    <input type="text" name="date" size="10" maxlength="10">
</div>
<div id="calque2" style="position:absolute; left:50px; top:93px; height:197px; z-index:1"> 
  <p>Nom de la Brochure 
    <input type="text" name="nombroche">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Nombre d'exemplaire 
    <input type="text" name="nombrebroche" size="8" maxlength="8">
  </p>
</div>
<div id="calque3" style="position:absolute; left:400px; top:130px; height:197px; z-index:1"> 
<input type="submit" name="ok" value="Valider">
<input type="button" name="fermer" value="Fermer" onClick="window.close()">
</div>
</form>
<div id="calque3" style="position:absolute; left:33px; top:160px; height:197px; z-index:1"> 
<table width='100%' border='1'>
<tr bgcolor='#FFFF9B' class='news'>  
	<td width='33%'> 
      <div align='center'><b>Date Edition</b></div>
    </td> 
	<td width='33%'> 
      <div align='center'><b>Nom Brochure</b></div>
    </td>  
    <td width='33%'> 
      <div align='center'><b>Nombre Exemplaire</b></div>
    </td>	
	<td width='15%'> 
      <div align='center'><b>Modification</b></div>
    </td>	
</tr>
<tr>
<?php
while($contenu = mysql_fetch_array($requete)) 
    {
	if ($contenu["editionbrochure"] == 0)
	{
	print "<td><center><b>Pas de Date</b></center></td>";
	print "<td><center><b>Pas de Brochure</b></center></td>";
	print "<td><center><b>Pas d'exemplaire</b></center></td>";
	print "<td><center><a href='#' onClick=window.open(\"suivibrochure.php?ok=Modif&brochure=$contenu[idbrochure]&code=$code\",'brochure','left=300,top=250,width=600,height=180,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no')><img src='images/Icones/eye.ico' border=0 align=absmiddle width=20 height=20 alt='Modification des Informations sur les Brochures'></a></center></td></tr>";
	}
	else
		{
		print "<td><center>$contenu[datebrochure]</center></td>";
		print "<td><center>$contenu[nombrochure]</center></td>";
		print "<td><center>$contenu[exempbrochure]</center></td>";
		print "<td><center><a href='#' onClick=window.open(\"suivibrochure.php?ok=Modif&brochure=$contenu[idbrochure]&code=$code\",'brochure','left=300,top=250,width=600,height=180,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no')><img src='images/Icones/eye.ico' border=0 align=absmiddle width=20 height=20 alt='Modification des Informations sur les Brochures'></a></center></td></tr>";
		}
	}
echo "</table>";
?>
</div>
</body>
</html>
<?php
}
?>