<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Administration SOFIBRA</title>
<link rel="stylesheet" href="../style/styles.css" type="text/css">
<body style="background-image: url('../images/wireless_logo.png'); background-repeat: no-repeat; background-position: center;">
<center><h3>Logs WifiOceaniaHotels</h3>
<form name="form1" action="log.php" methode="POST">
<input type="text" name="recherche" size="15" maxlength="30" value='<?php echo "$recherche"; ?>'>
<input type="submit" name="type" value="Rechercher">
</form>
</center>
<br />
<?php
$rep = "/var/log/squid/";      			  // Repertoire des fichier acces
$fichier = "access.log";			  // Fichier d'acces
$fd = fopen("$rep$fichier","r");                 
$i = 0;

if (!$fd) die("Impossible d'ouvrir le fichier $fichier:Ouverture stoppé");  
	while (! feof($fd))
			{
			$buffer = fgets($fd, 4096);
			if ($recherche <> NULL)
			{
			if (ereg($recherche,$buffer)) {
			echo "<li class=news>".$buffer."</li><br />";
			$i++;
							}
			}
			else
				{
				echo "<li class=news>".$buffer."</li><br />";
				$i++;
				}
			}
echo "Il y a $i r&eacute;sultats...";
fclose($fd);
?>
</body>
</html>
