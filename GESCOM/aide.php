<? include("Admin/sessions.php") ?>
<html>
<head>
<title>GESCOM&copy; Aide</title>
<base target="corps">
<link rel="stylesheet" href="sofibra.css" type="text/css">
<script src="fonction.js"></script>
</head>
<body class="text">
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<div align='left' class='titre'><h3>Aide en ligne...</h3></div>
<?
include("Admin/includes/fonctions.php");        //Connection à la SGBD

switch ($aide) 
{
// Cas ou requete est total pour les preformatées
case 1:
?>
<img src="images/1240.gif" align="absmiddle"> La recherche par client
<br><br>
<center class="anotation">
Entrer un nom de client ou son num&eacute;ro.<br>
Nous avons interdit la possiblit&eacute; de mettre un num&eacute;ro et un nom.
De plus si le champ est vide, une boite d'avertissement apparait.
<br>
Vous pouvez cr&eacute;er directement une nouvelle fiche Client si celle-ci n'existe pas.
Vous avez le choix entre un client Soci&eacute;t&eacute;, Tourisme ou Particulier.
</center>
<?
break;

case 2:
?>
<img src="images/1240.gif" align="absmiddle"> La recherche par contact
<br><br>
<center class="anotation">
Entrer un nom de contact.<br>
Nous avons interdit la possiblit&eacute; d'avoir un champ vide. Dans le cas contraire, une boite d'avertissement apparait.
</center>
<?
break;

case 3:
?>

<?
break;
}
?>
</body>
</html>