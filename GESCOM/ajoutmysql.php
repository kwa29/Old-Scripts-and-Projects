<? include("Admin/sessions.php") ?>
<html>
<head>
<?php
// Initialisation des variables
if ( ! isset($ok)) $ok=NULL;
// Insertion d'une nouvelle ville avec son code postal
if ($ok == "Entrer Ville")
{
include("Admin/includes/fonctions.php");        //Connection a la base Statistique 

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="commercial";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);   								 // sélection de la Base de données

$req_select = @mysql_db_query($nomdelabdd,"SELECT * FROM ville
					   WHERE nomville=\"$nomville\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu = mysql_numrows($req_select);
if ($contenu <> 0)
{
echo "<link rel='stylesheet' href='sofibra.css' type='text/css'></head>";
echo "<b>La ville existe d&eacute;j&agrave;...</b><br><br>Vous pouvez fermer cette fenetre.Merci...</html>";
}
else
	{
	$req_insert = @mysql_db_query($nomdelabdd,"INSERT INTO ville (nomville)
					   VALUES (					
					   \"$nomville\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	echo "<link rel='stylesheet' href='sofibra.css' type='text/css'></head>";
	echo "<b>La ville et son code postal ont &eacute;t&eacute; enregistr&eacute;s avec succ&egrave;s...</b><br><br>Vous pouvez fermer cette fenetre.Merci...</html>";
	}
@mysql_close();
}
if ($type == 'denomination')
{
print "<title>Ajout d'une D&eacute;nomination</title>";
?>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script language="JavaScript1.2" src="fonction.js"></script>
</head>
<center class=menu>Pour ajouter une entr&eacute;e cliquer sur <i>Valider</i> et saisisser votre texte.<br>Sinon Cliquer sur <i>Fermer la fenetre</i></center>
<p></p>
<form name="form1">
<input type="hidden" name="cacher" value='<?php echo "$type"; ?>'>
</form>
<center><input type="button" name="fermer" value="Valider" onClick='disparition(document.form1.cacher.value);return(false)'></center>
<p>
<center><input type="button" name="fermer" value="Fermer la fenetre" onClick="window.close()"></center>
</p>
</html>
<?
}
if ($type == 'type')
{
print "<title>Ajout d'un Type de Client</title>";
?>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script language="JavaScript1.2" src="fonction.js"></script>
</head>
<center class=menu>Pour ajouter une entr&eacute;e cliquer sur <i>Valider</i> et saisisser votre texte.<br>Sinon Cliquer sur <i>Fermer la fenetre</i></center>
<p></p>
<form name="form1">
<input type="hidden" name="cacher" value='<?php echo "$type"; ?>'>
</form>
<center><input type="button" name="fermer" value="Valider" onClick='disparition(document.form1.cacher.value);return(false)'></center>
<p>
<center><input type="button" name="fermer" value="Fermer la fenetre" onClick="window.close()"></center>
</p>
</html>
<?
}
if ($type == 'pays')
{
print "<title>Ajout d'un Pays</title>";
?>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script language="JavaScript1.2" src="fonction.js"></script>
</head>
<center class=menu>Pour ajouter une entr&eacute;e cliquer sur <i>Valider</i> et saisisser votre texte.<br>Sinon Cliquer sur <i>Fermer la fenetre</i></center>
<p></p>
<form name="form1">
<input type="hidden" name="cacher" value='<?php echo "$type"; ?>'>
</form>
<center><input type="button" name="fermer" value="Valider" onClick='disparition(document.form1.cacher.value);return(false)'></center>
<p>
<center><input type="button" name="fermer" value="Fermer la fenetre" onClick="window.close()"></center>
</p>
</html>
<?
}
if ($type == 'ville')
{
print "<title>Ajout d'une Ville</title>";
?>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script language="JavaScript1.2" src="fonction.js"></script>
</head>
<center class=menu>Pour ajouter une entr&eacute;e cliquer sur <i>Valider</i> et saisisser votre texte.<br>Sinon Cliquer sur <i>Fermer la fenetre</i></center>
<br>
<form name="form1" action="ajoutmysql.php" method="POST" onSubmit="return controlville();">
Nom de la ville
<input type="text" name="nomville" size="40">    
<br>
<input type="submit" name="ok" value="Entrer Ville">&nbsp;
<input type="reset" name="effacer" value="Effacer">
</form>
</html>
<?
}
if ($type == 'contrat')
{
print "<title>Ajout d'un Type de Contrat</title>";
?>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script language="JavaScript1.2" src="fonction.js"></script>
</head>
<center class=menu>Pour ajouter une entr&eacute;e cliquer sur <i>Valider</i> et saisisser votre texte.<br>Sinon Cliquer sur <i>Fermer la fenetre</i></center>
<p></p>
<form name="form1">
<input type="hidden" name="cacher" value='<?php echo "$type"; ?>'>
</form>
<center><input type="button" name="fermer" value="Valider" onClick='disparition(document.form1.cacher.value);return(false)'></center>
<p>
<center><input type="button" name="fermer" value="Fermer la fenetre" onClick="window.close()"></center>
</p>
</html>
<?
}
if ($type == 'secteur')
{
print "<title>Ajout d'un Secteur Economique</title>";
?>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script language="JavaScript1.2" src="fonction.js"></script>
</head>
<center class=menu>Pour ajouter une entr&eacute;e cliquer sur <i>Valider</i> et saisisser votre texte.<br>Sinon Cliquer sur <i>Fermer la fenetre</i></center>
<p></p>
<form name="form1">
<input type="hidden" name="cacher" value='<?php echo "$type"; ?>'>
</form>
<center><input type="button" name="fermer" value="Valider" onClick='disparition(document.form1.cacher.value);return(false)'></center>
<p>
<center><input type="button" name="fermer" value="Fermer la fenetre" onClick="window.close()"></center>
</p>
</html>
<?
}
if ($type == 'implantation')
{
print "<title>Ajout d'une Forme d'implantation</title>";
?>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script language="JavaScript1.2" src="fonction.js"></script>
</head>
<center class=menu>Pour ajouter une entr&eacute;e cliquer sur <i>Valider</i> et saisisser votre texte.<br>Sinon Cliquer sur <i>Fermer la fenetre</i></center>
<p></p>
<form name="form1">
<input type="hidden" name="cacher" value='<?php echo "$type"; ?>'>
</form>
<center><input type="button" name="fermer" value="Valider" onClick='disparition(document.form1.cacher.value);return(false)'></center>
<p>
<center><input type="button" name="fermer" value="Fermer la fenetre" onClick="window.close()"></center>
</p>
</html>
<?
}
if ($type == 'reseau')
{
print "<title>Ajout d'un R&eacute;seau d'appartenance</title>";
?>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script language="JavaScript1.2" src="fonction.js"></script>
</head>
<center class=menu>Pour ajouter une entr&eacute;e cliquer sur <i>Valider</i> et saisisser votre texte.<br>Sinon Cliquer sur <i>Fermer la fenetre</i></center>
<p></p>
<form name="form1">
<input type="hidden" name="cacher" value='<?php echo "$type"; ?>'>
</form>
<center><input type="button" name="fermer" value="Valider" onClick='disparition(document.form1.cacher.value);return(false)'></center>
<p>
<center><input type="button" name="fermer" value="Fermer la fenetre" onClick="window.close()"></center>
</p>
</html>
<?
}
if ($type == 'civilite')
{
print "<title>Ajout d'une Civilit&eacute;</title>";
?>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script language="JavaScript1.2" src="fonction.js"></script>
</head>
<center class=menu>Pour ajouter une entr&eacute;e cliquer sur <i>Valider</i> et saisisser votre texte.<br>Sinon Cliquer sur <i>Fermer la fenetre</i></center>
<p></p>
<form name="form1">
<input type="hidden" name="cacher" value='<?php echo "$type"; ?>'>
</form>
<center><input type="button" name="fermer" value="Valider" onClick='disparition(document.form1.cacher.value);return(false)'></center>
<p>
<center><input type="button" name="fermer" value="Fermer la fenetre" onClick="window.close()"></center>
</p>
</html>
<?
}
if ($type == 'fonction')
{
print "<title>Ajout d'une Fonction</title>";
?>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script language="JavaScript1.2" src="fonction.js"></script>
</head>
<center class=menu>Pour ajouter une entr&eacute;e cliquer sur <i>Valider</i> et saisisser votre texte.<br>Sinon Cliquer sur <i>Fermer la fenetre</i></center>
<p></p>
<form name="form1">
<input type="hidden" name="cacher" value='<?php echo "$type"; ?>'>
</form>
<center><input type="button" name="fermer" value="Valider" onClick='disparition(document.form1.cacher.value);return(false)'></center>
<p>
<center><input type="button" name="fermer" value="Fermer la fenetre" onClick="window.close()"></center>
</p>
</html>
<?
}
if ($type == 'service')
{
print "<title>Ajout d'un Service</title>";
?>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script language="JavaScript1.2" src="fonction.js"></script>
</head>
<center class=menu>Pour ajouter une entr&eacute;e cliquer sur <i>Valider</i> et saisisser votre texte.<br>Sinon Cliquer sur <i>Fermer la fenetre</i></center>
<p></p>
<form name="form1">
<input type="hidden" name="cacher" value='<?php echo "$type"; ?>'>
</form>
<center><input type="button" name="fermer" value="Valider" onClick='disparition(document.form1.cacher.value);return(false)'></center>
<p>
<center><input type="button" name="fermer" value="Fermer la fenetre" onClick="window.close()"></center>
</p>
</html>
<?
}
if ($type == 'metro')
{
print "<title>Ajout d'un Metro</title>";
?>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script language="JavaScript1.2" src="fonction.js"></script>
</head>
<center class=menu>Pour ajouter une entr&eacute;e cliquer sur <i>Valider</i> et saisisser votre texte.<br>Sinon Cliquer sur <i>Fermer la fenetre</i></center>
<p></p>
<form name="form1">
<input type="hidden" name="cacher" value='<?php echo "$type"; ?>'>
</form>
<center><input type="button" name="fermer" value="Valider" onClick='disparition(document.form1.cacher.value);return(false)'></center>
<p>
<center><input type="button" name="fermer" value="Fermer la fenetre" onClick="window.close()"></center>
</p>
</html>
<?
}
?>
