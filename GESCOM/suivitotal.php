<? include("Admin/sessions.php") ?>
<?php
include("Admin/includes/fonctions.php");        //Connection a la base Statistique 

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse ); 	// connection à la Base de données
$nomdelabdd="commercial";       										// le nom de la Base de données 
@mysql_select_db($nomdelabdd, $bdd);   								 // sélection de la Base de données

$requete = @mysql_db_query($nomdelabdd,"SELECT nomclient
										FROM client
										WHERE codeclient='$codeclient'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$contenu = @mysql_fetch_array ($requete);
$requete1 = @mysql_db_query($nomdelabdd,"SELECT c.nomclient,o.idcontact,o.nomcontact,o.prenomcontact,o.telcontact,v.nomville
										 FROM client c,contact o,ville v,liencontact l 
										 WHERE c.codeclient=l.idclient
										 AND o.idville=v.idville
										 AND o.idcontact=l.idcontact
										 AND l.idclient='$codeclient'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
?>
<html>
<head>
<title>Gestion Commerciale SOFIBRA</title>
<link rel="stylesheet" href="sofibra.css" type="text/css">
</head>
<body>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<div align='left' class='titre'><h2>Listing des contacts du client <?php echo "$contenu[nomclient]";?>...</h2></div>
<?php
while($contenu1 = @mysql_fetch_array ($requete1))
	{ 
	echo "<h3><center>$contenu1[nomcontact] $contenu1[prenomcontact] $contenu1[telcontact] $contenu1[nomville]</center></h3>";
	$requete2 = @mysql_db_query($nomdelabdd,"SELECT s.idsuivi,s.datesuivi,s.lieusuivi,s.resumesuivi,s.futursuivi,t.nomtypsuivi
										 	 FROM suivi s,liensuivi l,typsuivi t
										 	 WHERE s.idsuivi=l.idsuivi
										 	 AND s.idtypsuivi=t.idtypsuivi
										 	 AND l.idcontact='$contenu1[idcontact]'
										 	 ORDER BY s.idsuivi DESC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$contenu2 = mysql_numrows($requete2); 
	if ($contenu2 == NULL){echo "<li><font color='#CE3A05'><b>Aucun suivi n'est associ&eacute; au Contact</b></font>";}
		else
		{
		echo "<table width='100%' border='1'>
					<tr>  
					<td width='5%'> 
     				<div align='center'><b>Date</b></div>
    				</td> 
					<td width='15%'> 
     				<div align='center'><b>Suivi Futur</b></div>
    				</td>  
    				<td width='15%'> 
    			    <div align='center'><b>RCE</b></div>
   					</td>	
					<td width='15%'> 
      				<div align='center'><b>Type de Suivi</b></div>
    				</td>	
					<td width='15%'> 
     	 			<div align='center'><b>Lieu</b></div>
    				</td>	
					<td width='15%'> 
      				<div align='center'><b>R&eacute;sum&eacute;</b></div>
    				</td>	
					<td width='15%'> 
      				<div align='center'><b>Contenu</b></div>
    				</td>	
					</tr>";
		while($contenu2 = @mysql_fetch_array ($requete2))
			{
			$datej = transformfrench_date(@$contenu2[datesuivi]);
			$datef = transformfrench_date(@$contenu2[futursuivi]);
			@$contenu2[siglerce] = $contenu2['siglerce'];
			print "<tr><td>$datej</td>";
			print "<td><center>$datef</center></td>";
			print "<td><center>$contenu2[siglerce]</center></td>";
			print "<td><center>$contenu2[nomtypsuivi]</center></td>";
			print "<td><center>$contenu2[lieusuivi]</center></td>";
			print "<td>$contenu2[resumesuivi]</td>";
			print "<td><center>
			<a class='menu' href='#' onClick=window.open('historique.php?type=contenu&code=$contenu1[idcontact]&id=$contenu2[idsuivi]','contenu','left=300,top=250,width=600,height=180,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no')><img src='images/Icones/contenu3.ico' border=0 align=absmiddle width=20 height=20 alt='Visualisation du contenu du Contact'></a>
				   </center></td>";										
			echo "</tr>";
			}		
		}
		echo "</table>";			
	}
@mysql_close();       // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
?>
<p></p>
<center><input type="button" name="fermer" value="Fermer" onClick="window.close()"></center>
</body>
</html>