<html>
<head>
<base target="corps">
<link rel="stylesheet" href="../sofibra.css" type="text/css">
</head>
<?php
include("includes/fonctions.php");        // Encapsulation de fonction PHP
$lemois = date("m");
$lannee = date("Y");  

$rep1 = "/data/Backup/Gescom/STATCOM/".$lemois.$lannee."/";      			  // Repertoire fichier brut
$rep2 = "/var/www/html/gescom/Admin/Temporaire";                						// Repertoire fichier retravaillé

// Manipulation pour le mois et l'annee
if ($lemois == 01)							// Régle le mois pour le 12
{
$lemois = 12;
$lemoisav = 11;
$an  = date("Y")-1;      				
}
else
	{
	$lemoisav = 01;
	$an  = date("Y");      				
	}

$dir = opendir($rep1);               				// Teste si le repertoire existe
@$compte = NULL;									// Mise a zero
@$i = NULL;
@$j = NULL;
$fi = fopen("Temporaire/statistique","w+");							  // Fichier en mode ecriture

// 1er Traitement
while ($fichier = readdir($dir)) 					// Le repertoire existe 
{
	if ($fichier != "." && $fichier != "..")
	{ 
	$nomfichier = $fichier[4].$fichier[5].$fichier[6].$fichier[7];
	
	if ($nomfichier == 'STAT')
		{
		$fd = fopen("$rep1$fichier","r"); 			// Fichier en mode lecture
		if (!$fd) die("Impossible d'ouvrir le fichier $fichier:Ouverture stoppé"); // si fopen retourne faux c'est que le fichier ne peut Йtre ouvert en Иcriture 
			while (! feof($fd))
				{
				$ligne=fgets($fd,1024); 														// Renvoie la ligne courante sur laquelle se trouve le pointeur du fichier
				$liste=explode(";",$ligne); 
				$liste0=$liste[0];																		// numero hotel				
				$liste1=$liste[1];																		// mois	
				$liste2=$liste[2];																		// numero client
				$liste3=trim("$liste[3]"); 														// Efface les espaces en debut et en fin de chaine nom client
				$liste3=str_replace('"','',$liste3);										// suppression des guillemets dans la base
				$liste4=$liste[4];		
				$liste5=str_replace(",",".",$liste[5]);
				$liste6=str_replace(",",".",$liste[6]);
				$liste7=str_replace(",",".",$liste[7]);
				$liste8=$liste[8];
				$liste9=str_replace(",",".",$liste[9]);						// CATotal

				//if (($liste1==$lemoisav)||($liste1==$lemois))			// Nettoyage du fichier
					{			
					// Catotal different de NULL				 
					if ($liste9 <> 0)
						{
						fputs($fi,"$liste0;$liste1;$liste2;$liste3;$liste4;$liste5;$liste6;$liste7;$liste8;$liste9;$an\n"); // Ecriture de la ligne dans le fichier
						echo "$liste0;$liste1;$liste2;$liste3;$liste4;$liste5;$liste6;$liste7;$liste8;$liste9;$an<br>";
						$j++;
						}
					}
				$i++;
				}			
		fclose($fd);
		$compte++;
		}		
	}
}
fclose($fi);

// 2eme Traitement
$nomdelabdd="statistique";        								// le nom de la Base de données 
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );
@mysql_select_db($nomdelabdd, $bdd);                                 // sélection de la Base de données
// Suppression des anciens enregistrement a 0 pour faire une bonne mise a jour
$requete1 = @mysql_query("DELETE FROM statistique
						  WHERE annee='$an'
						  AND mois BETWEEN '$lemoisav' AND '$lemois'",$bdd)or die ('Erreur :'.mysql_error());
$requete2 = @mysql_query("LOAD DATA LOCAL INFILE '/var/www/html/gescom/Admin/Temporaire/statistique' INTO TABLE statistique 
						  FIELDS terminated by ';' 
						 (codetablis,mois,codeclient,nomclient,nuite,caheb,cares,cadiv,nbreclient,catotal,annee)",$bdd)or die ("Erreur de requete:".mysql_error());								
$requete3 = @mysql_query("DELETE FROM statistique
						  WHERE nomclient=''
						  OR codeclient=''",$bdd)or die ('Erreur :'.mysql_error());
				  
@mysql_close();       // spИcifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin

$rep3 = "../Admin/Temporaire/statistique.log";							// Repertoire fichier log
$log = fopen("$rep3","a+");		
@$temps=affichedate();						// Fonction de retour de date et heure
if (!$log) die("Impossible d'ouvrir le fichier statistique.log : Actualisation stoppée");		
fputs ($log,"$temps : Le r&eacute;pertoire $rep1 contient $compte Fichiers avec $i Enregistrements.
			          Insertion et Mise &agrave; jour de $j donn&eacute;es.\n");  // Ecriture du statistique.log sur le serveur
fclose($log);
echo "<center><b>Bravo, L'insertion dans la Base Statistique s'est effectu&eacute;e avec succ&egrave;s !!!</b></center>";

// Envoye de mail automatique pour confirmer l'insertion de nouvelles données statistique
$NomDuJour = array ("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");                                          
$NomDuMois = array ("Janvier", "F&eacute;vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "D&eacute;cembre"); 
$lejour = date("d");         
$annee  = date("Y");        
$lemois = date("m");
$mois = ($NomDuMois[ date($lemois - 1) ]);

$destinataire = "commercial@oceaniahotels.com";
$subject = "Mise a jour Base Statistique Gescom jusqu'au 1er $mois $annee";
/* Pour envoyer un mail au format HTML, vous pouvez configurer le type Content-type. */
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: Administrateur GESCOM <webmaster@oceaniahotels.com>\r\n";
$headers .= "Cc: informatique@oceaniahotels.com\r\n";
$headers .= "Cc: commercial.hotel@oceaniahotels.com\r\n";

$message ="<html>
				<head></head>
				<body style='background-color: #FFFFFF; color: #002D70; font-size: 12;'>
				Bonjour,<br><br>
				Ce mail a &eacute;t&eacute;  &eacute;mis automatiquement &agrave; partir du serveur web MOLENEPRO le <b>$lejour $mois $annee</b>.
				<p>Nous avons le plaisir de vous annoncer que la base Statistique a &eacute;t&eacute; mise &agrave; jour.</p>
				<blockquote>Cordialement...</blockquote>
				<img src='http://gescom/images/oceania_hotels.jpg' border='0' />
				<br>
				<span style='color: #002D70;'><b>Didier CAROFF</b></span>
				<br>
				<span style='color: #09A1C6;'>Service Informatique</span>
				<br>
				<span style='color: #09A1C6; text-transform: uppercase;'>Retrouvez tous les h&ocirc;tels du groupe sur oceaniahotels.com</span>
				</body></html>";
/* et hop, à la poste */
mail($destinataire, $subject, $message, $headers);

echo "<center>Mail au format HTML envoy&eacute; à $destinataire.</center>";

closedir($dir);
?>
</html>
