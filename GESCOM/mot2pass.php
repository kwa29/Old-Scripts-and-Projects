<html>
	<head>
	<title>Password Change...</title>
	<link rel="stylesheet" href="sofibra.css" type="text/css">
	</head>
	<body bgcolor="#FFE0A3" class="text">
<?php
include("Admin/includes/fonctions.php");        //Connection à la SGBD
// Initialisation des variables
if ( ! isset($pass)) $pass=NULL;

switch ($pass)
{

case "ok":

$nomdelabdd="authentique";        // le nom de la Base de données 
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de données
@mysql_select_db($nomdelabdd, $bdd);                                // sélection de la Base de données
$req = @mysql_db_query($nomdelabdd,"SELECT *
									FROM utilisateur
	 								WHERE login='$login'
	 								AND pwd='$oldpass'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu = mysql_numrows($req); 
// Si $contenu != 0 alors l'utilisateur existe sinon il degage
if ($contenu != 0)
	{
	// les 2 mot de passe correspondent
	if ($newpass == $renewpass)
		{
		$requete = @mysql_db_query($nomdelabdd,"UPDATE utilisateur SET
												pwd=\"$renewpass\"
												WHERE login=\"$login\"
												AND pwd=\"$oldpass\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
		@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
		echo "<CENTER><b>F&eacute;licitations, vos informations sont bien enregistr&eacute;es.</b>
				<br><br>
			  <input type='button' name='fermer' value='Fermer' onClick='window.close()'></center>";
		}
		else
			{
			echo "<CENTER><b>Votre nouveau mot de passe n'est pas confirm&eacute;.</b>
					<br><br>
				  <A class='menu' HREF='mot2pass.php'>Cliquer ici</A>, pour retaper vos informations</CENTER>";
			}
	}
	else
		{
		echo "<CENTER><b>Votre login ou votre mot de passe sont incorrect.</b>
				<br><br>
			  <A class='menu' HREF='mot2pass.php'>Cliquer ici</A>, pour retaper vos informations</CENTER>";
		}
break;

default:
?>
<form method="POST" action="mot2pass.php">
<input type="hidden" name="pass" value="ok">
<CENTER>
Votre Login<br><input type="text" name="login" size='10' maxlength='10'>
<br> 
Ancien Mot de Passe<br><input type="password" name="oldpass" size='10' maxlength='10'>
<br> 
Nouveau Mot de Passe<br><input type="password" name="newpass" size='10' maxlength='10'>
<br>
Confirmer Nouveau Mot de Passe<br><input type="password" name="renewpass" size='10' maxlength='10'>
<br><br>
<input type="submit" value="Changer Mot de passe">
</CENTER>
</form>
<?php
break;
}
?>
</body>
</html>