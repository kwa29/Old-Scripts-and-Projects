<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Administration SOFIBRA</title>
<link rel="stylesheet" href="../style/styles.css" type="text/css">
<body style="background-image: url('../images/wireless_logo.png'); background-repeat: no-repeat; background-position: center;">
<center><h3>Cr&eacute;ation Utilisateur WifiOceaniaHotels</h3></center>
<?php
switch ($ok) {   

case 'Supp':

include("../../site-lib/config.inc");
// Connection à la base MySQL
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );
$nomdelabdd="freeradius";
@mysql_select_db($nomdelabdd, $bdd);
$req_del = @mysql_db_query($nomdelabdd,"DELETE FROM radcheck
					WHERE id=\"$id\"");
mysql_close();
// Fenetre popup children avec fermeture + rechargement de la page mere
echo "<html><head>";
echo "<script language='JavaScript1.2'>
          window.location; self.close();
          opener.document.location.reload();
          </script>";
echo "</head></html>";

break; 

case 'Ajouter': 

include("../../site-lib/config.inc");
// Connection à la base MySQL
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );
$nomdelabdd="freeradius";
@mysql_select_db($nomdelabdd, $bdd);
$newKey = genPass();
$req_auth = @mysql_db_query($nomdelabdd,"INSERT INTO radcheck (UserName,Attribute,op,Value,forfait)
                                        VALUES (\"$nom\",\"User-Password\",\"==\",\"$newKey\",\"$forfait\")");
mysql_close();
// Fenetre popup children avec fermeture + rechargement de la page mere
echo "<html><head>";
echo "<script language='JavaScript1.2'>
	  window.location; self.close();
	  opener.document.location.reload(); 
	  </script>";
echo "</head></html>";
break;

default :
?>
<form name="form1" action="ajout.php" methode="POST">
  <center>
  <input type="submit" name="ok" value="Ajouter">&nbsp;&nbsp;
  <input type="button" name="fermer" value="Fermer" onClick="window.close()">
  <br><br>
  Login
  <input type="text" name="nom" size="15" maxlength="15">&nbsp;&nbsp;
  Forfait
  <select name="forfait">
  <option value="payant" SELECTED>Forfait payant 24H</option>
  <option value="free">Forfait gratuit 15min</option>
  </select>
 </center> 
<?php
break;
}
?>
</body>
</html>
