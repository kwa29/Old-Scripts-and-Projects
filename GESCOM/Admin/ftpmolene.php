<html>
<head>
<link rel="stylesheet" href="../sofibra.css" type="text/css">
<body>
<center><h3><U>Transfert des fichiers sur MOLENE</U></h3></center>
<br><br>
<?php
$ftp_server ="192.168.100.103";
$ftp_user_name="root";
$ftp_user_pass="bridge";

$destination_file="/var/www/html/gescom/Admin/Spool/";
$source_file='/usr2/report/stats/';

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
		else {echo "Connecté Ю $ftp_server, en tant que $ftp_user_name.";}
// TИlИchargement d un fichier.
if(ftp_chdir($conn_id, "$source_file"))
	{
	echo "<br>Le dossier FTP courant est : ", ftp_pwd($conn_id), "\n<br><br>Il contient les fichiers suivants:<br>";
	foreach(ftp_nlist($conn_id,".") as $fichiers)
		{
		if ($fichiers != "." && $fichiers != ".." && $fichiers != "nbr_files")
			{ 
			print("<li>$fichiers<br>");
			$upload = ftp_get($conn_id, "$destination_file$fichiers","$source_file$fichiers", FTP_BINARY);
			//VИrification de tИlИchargement
			if (!$upload) 
			{
       		echo "T&eacute;l&eacute;chargement FTP &eacute;chou&eacute;!";
    		} 
			else 
				{
        		echo "Téléchargement de $source_file sur $ftp_server en $destination_file";
   				}			
			}
		}
	}
// Fermeture de la connexion FTP.
ftp_quit($conn_id);
?>
</body>
</html>