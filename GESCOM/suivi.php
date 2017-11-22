<? include("Admin/sessions.php") ?>
<?php
include("Admin/includes/fonctions.php");        //Connection a la base Statistique 
$annee  = date("y");							// Variable pour l'année

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="commercial";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);   								 // sélection de la Base de données
// Fiche en modification
if (@$modifier == 'Modifier') 
{
// Transformation du format de la date pour MySQL
$date = explode("/",$date);
// $date[0]>jour
// $date[1]>mois 
// $date[2]>annee
$date = "$date[2]-$date[1]-$date[0]";
$futur = explode("/",$futur);
$futur = "$futur[2]-$futur[1]-$futur[0]";

$requete = @mysql_db_query($nomdelabdd,"UPDATE suivi SET
										idtypsuivi=\"$typsuivi\",
										datesuivi=\"$date\",
										lieusuivi=\"$lieu\",
										contenusuivi=\"$contenu\",
										resumesuivi=\"$resume\",
										futursuivi=\"$futur\"
										WHERE idsuivi='$id'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Fenetre popup children avec fermeture + rechargement de la page mere
echo "<html><head>";
echo "<script language='JavaScript1.2'>
	  window.location; self.close();
	  opener.document.location.reload(); 
	  </script>";
echo "</head></html>";
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
}
// Fiche en insertion
if (@$valider == 'Valider') 
{
// Transformation du format de la date pour MySQL
$date = explode("/",$date);
// $date[0]>jour
// $date[1]>mois 
// $date[2]>annee
$date = "$date[2]-$date[1]-$date[0]";
$futur = explode("/",$futur);
$futur = "$futur[2]-$futur[1]-$futur[0]";

$requete = @mysql_db_query($nomdelabdd,"INSERT INTO suivi (idtypsuivi,idrce,datesuivi,lieusuivi,contenusuivi,resumesuivi,futursuivi)
										VALUES (
										\"$typsuivi\",
										\"$rce\",
										\"$date\",
										\"$lieu\",
										\"$contenu\",
										\"$resume\",
										\"$futur\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$requete3 = @mysql_db_query($nomdelabdd,"INSERT INTO liensuivi (idcontact,idsuivi)
										 VALUES ('$contact',LAST_INSERT_ID())")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Fenetre popup children avec fermeture + rechargement de la page mere
echo "<html><head>";
echo "<script language='JavaScript1.2'>
	  window.location; self.close();
	  opener.document.location.reload(); 
	  </script>";
echo "</head></html>";
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
}
if (@$type == 'modif')
{
$requete = @mysql_db_query($nomdelabdd,"SELECT s.*,t.*
										FROM suivi s,typsuivi t
										WHERE s.idtypsuivi=t.idtypsuivi
										AND s.idsuivi='$id'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu = mysql_fetch_array($requete);
$requete2 = @mysql_db_query($nomdelabdd,"SELECT *
										 FROM typsuivi
										 ORDER BY nomtypsuivi ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
?>
<html>
<head>
<title>Gestion Commerciale SOFIBRA</title>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script src="fonction.js"></script>
</head>
<body>
<div align='left' class='titre'><h3>Modification Suivi Contact...</h3></div>
<form name="form1" action="suivi.php" methode="POST" 
<?php
// Controle pour la sécurité du site $rce correspond a l'utilisateur en cours et $contenu[idrce] à celui ki a creer la fiche
if ($contenu['idrce'] == $rce)
{
?>
onSubmit="return controlsuivi();"
<?
}
else
	{
	switch ($saphira)
		{
		case 1:
		?>
		onSubmit="return controlsuivi();"
		<?php
		break;

		case 2:
		?>
		onSubmit="return controlsuivi();"
		<?php
		break;

		case 3:
		?>
		onSubmit="return controlsuivi();"
		<?php
		break;

		default:
		?>
		onSubmit="return attention();"
		<?php
		break;
		}
	}
?>
><input type="hidden" name="id" value='<?php echo "$id"; ?>'>

<div style="position:absolute; left:20px; top:57px; height:46px; z-index:1"> 
Date RDV
<input type="text" name="date" size="8" maxlength="8" 
value="
<?php 
$date = transformfrench_date(@$contenu[datesuivi]);
$datechoisi = transformfrench_date(@$contenu[futursuivi]);
$date = split("/",$date); 
$date[2] = substr($date[2],2);

echo "$date[0]/$date[1]/$date[2]"; 
?>">
 (JJ/MM/AA)
</div>

<div style="position:absolute; left:345px; top:57px; height:46px; z-index:1"> 
Type de Suivi 
<select name="typsuivi">
	<? while ($val2= mysql_fetch_array($requete2)) { 
    if ($contenu["nomtypsuivi"] == $val2["nomtypsuivi"]) 
	{ 
	echo "<option value=\"".$val2["idtypsuivi"]."\" selected>".$val2["nomtypsuivi"]."</option>\n"; 
	} 
	else 
	{ 
	echo "<option value=\"".$val2["idtypsuivi"]."\">".$val2["nomtypsuivi"]."</option>\n"; 
	} 
													}
	?>
</select> 
</div>

<div style="position:absolute; left:50px; top:93px; height:46px; z-index:1"> 
Lieu <input type="text" name="lieu" value="<?php echo "$contenu[lieusuivi]"; ?>">
</div>

<div style="position:absolute; left:370px; top:98px; height:46px; z-index:1"> 
R&eacute;sum&eacute;
</div>
<div style="position:absolute; left:420px; top:93px; height:46px; z-index:1"> 
<textarea name="resume"><?php echo "$contenu[resumesuivi]"; ?></textarea>
</div>

<div style="position:absolute; left:15px; top:129px; height:46px; z-index:1"> 
Suivi Futur 
<input type="text" name="futur" value='<?php 
if ($datechoisi <> NULL)
{
$datechoisi = split("/",$datechoisi); 
$datechoisi[2] = substr($datechoisi[2],2);

echo "$datechoisi[0]/$datechoisi[1]/$datechoisi[2]";
}
else
{
echo "$datechoisi"; 
}
?>' size="8" maxlength="8">
 (JJ/MM/AA)
<?php
echo "&nbsp;&nbsp;<a href='#' onClick=window.open('calendrier.php','calendrier','left=70,top=250,width=220,height=190,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')><img src='images/calendrier.gif' border=0 align='absmiddle' alt='Cliquer ici pour afficher le calendrier!!!'></a>";
?>
</div>

<div style="position:absolute; left:25px; top:170px; height:46px; z-index:1"> 
Contenu
</div>
<div style="position:absolute; left:80px; top:170px; height:46px; z-index:1"> 
<textarea name="contenu" rows="18" cols="80"><?php echo "$contenu[contenusuivi]"; ?></textarea>
</div>

<div style="position:absolute; left:500px; top:470px; height:37px; z-index:4">
<?php
echo "<input type='submit' name='modifier' value='Modifier'> ";
echo "<input type='button' name='fermer' value='Fermer' onClick='window.close()'>";  
?>
</div>
</form>
</body>
</html>
<?php
}
else
{
$requete2 = @mysql_db_query($nomdelabdd,"SELECT *
										 FROM typsuivi
										 ORDER BY nomtypsuivi ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
?>
<html>
<head>
<title>Gestion Commerciale SOFIBRA</title>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script src="fonction.js"></script>
</head>
<body>
<div align='left' class='titre'><h3>Nouveau Suivi Contact...</h3></div>
<form name="form1" action="suivi.php" methode="POST" onSubmit="return controlsuivi();">
<input type="hidden" name="contact" value='<?php echo "$code"; ?>'>
<input type="hidden" name="rce" value='<?php echo "$rce"; ?>'>

<div style="position:absolute; left:20px; top:57px; height:46px; z-index:1"> 
Date RDV
<?php
$datedujour = date("d/m/y");
echo "<input type='text' name='date' size='8' maxlength='8' value='$datedujour'>";
?>
 (JJ/MM/AA)
</div>

<div style="position:absolute; left:345px; top:57px; height:46px; z-index:1"> 
Type de Suivi 
<select name="typsuivi">
	<? while ($val2= mysql_fetch_array($requete2)) { 
  	echo "<option value=\"".$val2["idtypsuivi"]."\">".$val2["nomtypsuivi"]."</option>\n"; 
																					}
	?>
</select> 
</div>

<div style="position:absolute; left:50px; top:93px; height:46px; z-index:1"> 
Lieu <input type="text" name="lieu">
</div>

<div style="position:absolute; left:370px; top:96px; height:46px; z-index:1"> 
R&eacute;sum&eacute;
</div>
<div style="position:absolute; left:420px; top:93px; height:46px; z-index:1"> 
<textarea name="resume" rows="3"></textarea>
</div>

<div style="position:absolute; left:15px; top:129px; height:46px; z-index:1"> 
Suivi Futur
<input type='text' name='futur' size='8' maxlength='8'> 
 (JJ/MM/AA)
<?php
echo "&nbsp;&nbsp;<a href='#' onClick=window.open('calendrier.php','calendrier','left=70,top=250,width=220,height=190,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')><img src='images/calendrier.gif' border=0 align='absmiddle' alt='Cliquer ici pour afficher le calendrier!!!'></a>";
?>
</div>

<div style="position:absolute; left:25px; top:170px; height:46px; z-index:1"> 
Contenu
</div>
<div style="position:absolute; left:80px; top:170px; height:46px; z-index:1"> 
<textarea name="contenu" rows="18" cols="80"></textarea>
</div>

<div style="position:absolute; left:500px; top:470px; height:37px; z-index:4">
<input type="submit" name="valider" value="Valider">
<input type="button" name="fermer" value="Fermer" onClick="window.close()">  
</div>
</form>
</body>
</html>
<? 
}
?>
