<html>
<head>
<title>Integration fichiers Commercial Hotix</title>
<link rel="stylesheet" href="../sofibra.css" type="text/css">
<body link="#CE3A05" alink="#CE3A05" vlink="#CE3A05">
<center><h3><U>Traitements de fichiers Hotix avant Intégration MySql</U></h3></center>
<center><h3><U>Transfert des fichiers sur MOLENEPRO (Sauvegarde) et SPOOL</U></h3></center>
<?php

$ftp_server ="192.168.100.103";
$ftp_user_name="root";
$ftp_user_pass="bridge";

// Création du repertoire en fonction da la date
$lemois = date("m");
$annee  = date("Y");
$destination = "/data/Backup/Gescom/STATCOM/";
$spool ="/var/www/html/gescom/Admin/Spool/";
$destination_fichiers = $destination.$lemois.$annee."/";
mkdir ("$destination_fichiers", 0777);
echo "<br> Le repertoire de destination est : $destination_fichiers";


$source_file = '/usr2/report/stats/';

// CrИation de la connexion
$conn_id = ftp_connect("$ftp_server");

// Authentification avec nom de compte et mot de passe
$login_result = ftp_login($conn_id, "$ftp_user_name", "$ftp_user_pass");

// VИrification de la connexion
if ((!$conn_id) || (!$login_result)) 
		{
        echo "La connexion FTP a échoué!";
        echo "Tentative de connexion à $ftp_server avec $ftp_user_name";
        die;
		} 
		else {echo "Connecté à $ftp_server, en tant que $ftp_user_name.";}
// TИlИchargement d'un fichier.
if(ftp_chdir($conn_id, "$source_file"))
	{
	echo "<br>Le dossier FTP courant est : ", ftp_pwd($conn_id), "\n<br><br>Il contient les fichiers suivants:<br>";
	foreach(ftp_nlist($conn_id,".") as $fichiers)
		{
		if ($fichiers != "." && $fichiers != ".." && $fichiers != "nbr_files")
			{ 
			print("<li>$fichiers<br>");
			$upload = ftp_get($conn_id, "$destination_fichiers$fichiers","$source_file$fichiers", FTP_BINARY);
			//Vérification de téléchargement
			if (!$upload) 
			{
       		echo "T&eacute;l&eacute;chargement FTP &eacute;chou&eacute;!";
    		} 
			else 
				{
        		echo "Téléchargement de $source_file sur $ftp_server en $destination_fichiers";
        				// Tente d'effacer le fichier $fichier        				
						if (ftp_delete($conn_id,"$source_file$fichiers")) { echo "<blockquote>$fichiers effac&eacute; avec succ&egrave;s</blockquote>"; } 
 						else { echo "<blockquote>Impossible d'effacer le fichier $fichiers</blockquote>"; }        		
   			}			
			}
		}
	}
// Fermeture de la connexion FTP.
ftp_quit($conn_id);
?>
</body>
</html>
