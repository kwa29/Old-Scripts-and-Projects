<? include("sessions.php") ?>
<html>
<head>
<base target="corps">
<link rel="stylesheet" href="../sofibra.css" type="text/css">
<body>
<?php
// Initialisation des variables
if ( ! isset($choix)) $choix=NULL;

// Corps par default de l'accueil
switch ($log)
{
case 1 :
// On demande une integration MySQL
if ($choix == 'traitement')
	{
?>
<center><h3><U>Traitements de fichiers Hotix avant Intégration MySql</U></h3></center>
<br>
<li><a class='menu' href='decompfiles.php'><b>Décompression des fichiers</b></a></li>
<li><a class='menu' href='transfert_ftp.php'><b>Transfert de fichiers vers MOLENEPRO</b></a></li>
<li><a class='menu' href='statistique.php'><b>Int&eacute;gration des fichiers dans MySql</b></a>
<?
	}
?>
<center><h3><U>Mise à Jour et Transfert Divers</U></h3></center>
<li><a class='menu' href='transfert.php?type=client'><b>Transfert de Client</b></a>
<li><a class='menu' href='transfert.php?type=contact'><b>Transfert de Contact</b></a>
<li><a class='menu' href='transfert.php?type=suppression'><b>Suppression de Comptes Clients</b></a>
<li><a class='menu' href='transfert.php?type=suppression_contact'><b>Suppression de Comptes Contacts</b></a>
<br>
<li><a class='menu' href='utilisateur.php'><b>Mise à jour des Utilisateurs dans MySQL</b></a>
<li><a class='menu' href='corps.php?choix=traitement'><b>Mise à jour des Statistiques dans MySQL</b></a>
<li><a class='menu' href='test.php'><b>Test de Script PHP ou Perl</b></a>
<br>
<center><h3><U>Informations Diverses sur l'Application</U></h3></center>
<li><a class='menu' href='listing.php?type=stat'><b>Rapport du fichier Statistique.log</b></a>
<br>
<li><a class='menu' href='listing.php?type=session'><b>Statistiques des utilisateurs</b></a>
<br>
<center><h3><U>Nettoyage de Fichiers et MySQL</U></h3></center>
<li><a class='menu' href='nettoyage.php?type=gescom'><b>Nettoyage automatique GESCOM &copy; : @ faire 1 fois par mois...</b></a>
<br>
<li><a class='menu' href='nettoyage.php?type=session'><b>Nettoyage des Logs de Sessions</b></a>
<li><a class='menu' href='nettoyage.php?type=stat'><b>Nettoyage total du Statistique.log</b></a>
<?
break;

case 2 :

?>
<center><h3><U>Informations Diverses sur l'Application</U></h3></center>
<li><a class='menu' href='listing.php?type=session'><b>Statistiques des utilisateurs</b></a>
<br>
<center><h3><U>Mise à Jour et Transfert Divers</U></h3></center>
<li><a class='menu' href='utilisateur.php'><b>Mise à jour des Utilisateurs dans MySQL</b></a>
<?
break; 
}
?>
</body>
</html>
