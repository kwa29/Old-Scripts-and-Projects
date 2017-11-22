<? include("Admin/sessions.php") ?>
<?
include("Admin/includes/fonctions.php");        //Connection a la base Statistique 

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="commercial";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);   								 // sélection de la Base de données

if (@$modifier == 'Enregistrer') 
{
$requete1 = @mysql_db_query($nomdelabdd,"SELECT idperso,idcontact
										 FROM perso
										 WHERE idperso='$perso'
										 AND idcontact='$code'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu1 = @mysql_fetch_array ($requete1);
// Cas ou la fiche est existante dans UPDATE
if ($contenu1 <> NULL)
{
// Transformation du format de la date pour MySQL
$annif = explode("/",$annif);
// $date[0]>jour
// $date[1]>mois 
// $date[2]>annee
$annif = "$annif[2]-$annif[1]-$annif[0]";
$requete2 = @mysql_db_query($nomdelabdd,"UPDATE perso SET
										 hobbieperso=\"$hobbie\",
										 enfantperso=\"$enfant\",
										 adresseperso=\"$commentaire\",
										 annifperso=\"$annif\",
										 cpperso=\"$cp\",
										 telperso=\"$telperso\",
										 villeperso=\"$ville\"									
										 WHERE idperso='$perso'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Fenetre popup children
echo "<html><head>";
echo "<script language='JavaScript1.2'>window.location; self.close();</script>";
echo "</head></html>";
}
// Cas ou la fiche n'existe pas donc INSERT
else
{
// Transformation du format de la date pour MySQL
$annif = explode("/",$annif);
$annif = "$annif[2]-$annif[1]-$annif[0]";
$requete2 = @mysql_db_query($nomdelabdd,"INSERT INTO perso (
										 idcontact,
										 hobbieperso,
										 enfantperso,
										 adresseperso,
										 annifperso,
										 cpperso,
										 telperso,
										 villeperso)
										 VALUES (					
										 '$code',
										 \"$hobbie\",
										 \"$enfant\",
										 \"$commentaire\",
										 \"$annif\",
										 \"$cp\",
										 \"$telperso\",
										 \"$villeperso\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
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
										idperso,
										hobbieperso,
										enfantperso,
										adresseperso,
										annifperso,
										cpperso,
										telperso,
										villeperso										
										FROM perso 
										WHERE idcontact='$code'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu = @mysql_fetch_array ($requete);
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
<div align='left' class='titre'><h3>Information Personnelle...</h3></div>
<form name="form1" action="suiviperso.php" methode="POST">
<input type="hidden" name="code" value='<?php echo "$code"; ?>'>
<input type="hidden" name="perso" value='<?php echo "$contenu[idperso]"; ?>'>
<div style="position:absolute; left:33px; top:57px; height:197px; z-index:1"> 
Commentaire/Adresse
</div>
<div style="position:absolute; left:170px; top:57px; height:197px; z-index:1"> 
<textarea name="commentaire"><?php echo "$contenu[adresseperso]"; ?></textarea>
</div>
<div style="position:absolute; left:410px; top:57px; height:197px; z-index:1"> 
Hobbies
</div>
<div style="position:absolute; left:465px; top:57px; height:197px; z-index:1"> 
<textarea name="hobbie"><?php echo "$contenu[hobbieperso]"; ?></textarea>
</div>
<div style="position:absolute; left:33px; top:110px; height:197px; z-index:1"> 
Enfants : Nombre et &acirc;ge
</div>
<div id="calque6" style="position:absolute; left:170px; top:110px; height:197px; z-index:1"> 
<textarea name="enfant"><?php echo "$contenu[enfantperso]"; ?></textarea>
</div>
<div style="position:absolute; left:360px; top:110px; height:200px; z-index:1"> 
Anniversaire le (JJ/MM/AAAA)<input type="text" name="annif" size="10" maxlength="10" value='<?php $datechoisi = transformfrench_date(@$contenu[annifperso]); echo "$datechoisi"; ?>'>
</div>
<div style="position:absolute; left:55px; top:165px; height:197px; z-index:1"> 
  <p>T&eacute;l&eacute;phone personnel 
    <input type="text" name="telperso" size="15" maxlength="15" value='<?php echo "$contenu[telperso]"; ?>'>
</div>
<div style="position:absolute; left:305px; top:165px; height:197px; z-index:1"> 
   Code Postal 
    <input type="text" name="cp" size="10" maxlength="10" value='<?php echo "$contenu[cpperso]"; ?>'>
    Ville 
    <input type="text" name="ville" size="15" maxlength="15" value='<?php echo "$contenu[villeperso]"; ?>'>
  </p>
</div>
<div style="position:absolute; left:440px; top:205px; height:197px; z-index:1"> 
<input type="submit" name="modifier" value="Enregistrer">
<input type="button" name="fermer" value="Fermer" onClick="window.close()">
</div>
</form>
</body>
</html>
<?
}
?>
