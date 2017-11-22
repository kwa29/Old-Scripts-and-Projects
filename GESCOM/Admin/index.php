<html>
<head>
<title>Administration GESCOM&copy; SOFIBRA</title>
<link rel="stylesheet" href="../sofibra.css" type="text/css">
</head>
<body>
<center><div class='grostitre'>Partie Administration</div></center>
<?php
include("includes/fonctions.php");        // Encapsulation de fonction PHP

$bdd=mysql_connect( $nomhote, $identifiant , $motdepasse );  // Connection a la base MySQL
$nomdelabdd="authentique";        // le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);                                // sélection de la Base de données

if (@$envoyer=="ok") 
{
$req = @mysql_db_query($nomdelabdd,"SELECT *
									FROM utilisateur s,groupe g
	 								WHERE s.groupe=g.idgroupe
									AND s.login='$login'
	 								AND s.pwd='$pass'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val = mysql_fetch_array($req);
$contenu = mysql_numrows($req); 
if ($val[groupe] == 1 ||2)
{
$log=$val[groupe];
// On ouvre la session 
session_start(); 
session_name("sessionadmin");
session_register("log");
/* Redirige le client*/
redirect_url("accueil.php");
}
else
	{
	?>
<center>
<table width="373" height="236" border="0" class="text" cellpadding="0" cellspacing="0">
	 		<tr> 
				<td height="63"><img src="../images/spacer.gif" width="115" height="73"></td>
				<td width="100%"><div style="left-margin:80px"><img src="../images/Logo.gif"></div></td>
				</tr>
			<tr>
				<td colspan="2" align="center" valign="top" height="30"><img src="../images/acces_secu.gif"></td>
			</tr>
		<tr>
   	 	<td colspan="2" align="center" valign="top">
			<form method="POST" action="index.php?envoyer=ok">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="text">
  				<tr>
   					<td align="right" height="25">Votre Login</td>
    				<td>&nbsp;&nbsp;<img src="../images/menu_fleche.gif"></td>
    				<td><input type="text" name="login" value='<? echo "$login"; ?>'></td>
  				</tr>
  				<tr>
    				<td align="right" height="25">Votre Mot de Passe</td>
    				<td>&nbsp;&nbsp;<img src="../images/menu_fleche.gif"></td>
    				<td><input type="password" name="pass" value='<? echo "$pass"; ?>'></td>
  				</tr>
  				<tr>
    				<td colspan="3" align="center" height="25"><input type="submit" value="Se Connecter"></td>
  				</tr>
			</table>
			<br><br>
			<center><b>La connexion n'est pas autorisée...</b></center>
			</form>
		</td>
 	 	</tr>
</table>
</center>
	<?
	exit();
	}
}
else
{
?>
<center>
<table width="373" height="236" border="0" class="text" cellpadding="0" cellspacing="0">
	 		<tr> 
				<td height="63"><img src="../images/spacer.gif" width="115" height="73"></td>
				<td width="100%"><div style="left-margin:80px"><img src="../images/Logo.gif"></div></td>
				</tr>
			<tr>
				<td colspan="2" align="center" valign="top" height="30"><img src="../images/acces_secu.gif"></td>
			</tr>
		<tr>
   	 	<td colspan="2" align="center" valign="top">
			<form method="POST" action="index.php?envoyer=ok">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="text">
  				<tr>
   					<td align="right" height="25">Votre Login</td>
    				<td>&nbsp;&nbsp;<img src="../images/menu_fleche.gif"></td>
    				<td><input type="text" name="login"></td>
  				</tr>
  				<tr>
    				<td align="right" height="25">Votre Mot de Passe</td>
    				<td>&nbsp;&nbsp;<img src="../images/menu_fleche.gif"></td>
    				<td><input type="password" name="pass"></td>
  				</tr>
  				<tr>
    				<td colspan="3" align="center" height="25"><input type="submit" value="Se Connecter"></td>
  				</tr>
			</table>
			</form>
		</td>
 	 	</tr>
</table>
</center>
<?
}
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
?>
</body>
</html>
