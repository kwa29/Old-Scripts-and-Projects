<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="../sofibra.css" type="text/css">
<body>
<center><h3><U>Décompression des fichiers</U></h3></center>
<?php
echo "Phase 1 : Décompression des fichiers<br>";
$unzip=`rsh 192.168.100.103 -l info -n ./statfiles.ope;exit` ; // Execution sur serveur distant 
echo "Décompression Terminée...";
exit
?>
</body>
</html>