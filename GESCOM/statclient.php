<? include("Admin/sessions.php") ?>
<html>
<title>Gestion Commerciale SOFIBRA</title>
<base target="corps">
<link rel="stylesheet" href="sofibra.css" type="text/css">
<body>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<?
include("Admin/includes/fonctions.php");        //Connection à la SGBD
// Initialisation des variables
if ( ! isset($ok)) $ok=NULL;

// Initialisation des variables
if ( ! isset($nuite)) $nuite=NULL;
if ( ! isset($refus)) $refus=NULL;
if ( ! isset($nbreclient)) $nbreclient=NULL;
if ( ! isset($caheb)) $caheb=NULL;
if ( ! isset($cadiv)) $cadiv=NULL;
if ( ! isset($cares)) $cares=NULL;
if ( ! isset($catotal)) $catotal=NULL;
if ( ! isset($quantannul)) $quantannul=NULL;
if ( ! isset($quantrefus)) $quantrefus=NULL;

switch ($ok)
{
case '1':

$conte=crypte($stat); 			// Fonction de deleanerisation de l'url de requete
$nomclient = $conte['nomclient'];
$codeclient = $conte['codeclient'];

echo "<div align='left' class='titre'><h3>Statistique du Client : $codeclient $nomclient...</h3></div>";
?>
<table width="100%" border="1">
  <tr bgcolor='#FFFF9B' class='news'> 
  <td width="12%"> 
      <div align="center"><b>Mois</b></div>
    </td>
    <td width="5%"> 
      <div align="center"><b>Nbre Nuitée</b></div>
    </td>
    <td width="5%"> 
      <div align="center"><b>Nbre Client</b></div>
    </td>
	<td width="10%"> 
      <div align="center"><b>CA Hébergement</b></div>
    </td>
	<td width="10%"> 
      <div align="center"><b>CA Restauration</b></div>
    </td>	
	<td width="10%"> 
      <div align="center"><b>CA Divers</b></div>
    </td>
	<td width="10%"> 
      <div align="center"><b>CA Total</b></div>
    </td>
	<td width="5%"> 
      <div align="center"><b>Nbre Annul</b></div>
    </td>	
	 <td width="5%"> 
      <div align="center"><b>Nbre Refus</b></div>
    </td>   
	<td width="8%"> 
      <div align="center"><b>Nbre Nuitée N-1</b></div>
    </td>   
	<td width="8%"> 
      <div align="center"><b>CA Total N-1</b></div>
    </td>   
  </tr>
<?
$Mois = array (1=>'Janvier',2=>'Février',3=>'Mars',4=>'Avril',5=>'Mai',6=>'Juin',7=>'Juillet',8=>'Août',9=>'Septembre',10=>'Octobre',11=>'Novembre',12=>'Décembre');   // création d'un tableau virtuel contenant les noms des mois
$mois = date("m"); 
// Date
if ( ! isset($an)) $an=date("Y");
$anmoins = $an - 1;
             
$conte['nomclient']=mysql_escape_string($conte['nomclient']);
$nomdelabdd="statistique";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de données
@mysql_select_db($nomdelabdd, $bdd);                                // sélection de la Base de données

$req_a = @mysql_query("SELECT *
		FROM statistique 
		WHERE codeclient='$codeclient'
		AND nomclient=\"$nomclient\"
		ORDER BY mois ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
$req_b= @mysql_db_query($nomdelabdd,"CREATE TEMPORARY TABLE tmp (
				idtemp 		int    	not null auto_increment,
				codeclient    	varchar(10),
				mois		varchar(2),
				annee		varchar(4),
				nuite		varchar(10),
				caheb		varchar(10),
				cares		varchar(10),
				cadiv		varchar(10),
				nbreclient	varchar(10),
				catotal		varchar(10),
				PRIMARY KEY   	(idtemp),
				UNIQUE idtemp 	(idtemp))")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
while($contenu = mysql_fetch_array($req_a)) 								
{
$req_insert = @mysql_db_query($nomdelabdd,"INSERT INTO tmp (
				codeclient,
				mois,
				annee,
				nuite,
				caheb,
				cares,
				cadiv,
				nbreclient,
				catotal) VALUES (
				\"$contenu[codeclient]\",
				\"$contenu[mois]\",
				\"$contenu[annee]\",
				\"$contenu[nuite]\",
				\"$contenu[caheb]\",
				\"$contenu[cares]\",
				\"$contenu[cadiv]\",
				\"$contenu[nbreclient]\",
				\"$contenu[catotal]\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}	

for($i=1;$i<=12;$i++)
	{
	$req_1 = @mysql_query("SELECT SUM(nuite) AS nuite,SUM(caheb) AS caheb,SUM(cares) AS cares,SUM(cadiv) AS cadiv,SUM(nbreclient) AS nbreclient,SUM(catotal) AS catotal
	FROM tmp
	WHERE mois=$i
	AND annee=$an
	GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	
	$contenu = mysql_fetch_array($req_1);
	$req_2 = @mysql_query("SELECT SUM(nuite) AS nuite,SUM(caheb) AS caheb,SUM(cares) AS cares,SUM(cadiv) AS cadiv,SUM(nbreclient) AS nbreclient,SUM(catotal) AS catotal
	FROM tmp
	WHERE mois=$i
	AND annee=$anmoins
	GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$contenu_2 = mysql_fetch_array($req_2);
	$req_1 = @mysql_query("SELECT COUNT(idannul) AS annulation
			FROM annulation 
			WHERE idclient='$contenu[codeclient]'
			AND annee='$an'
			AND mois='$i'
			GROUP BY mois")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
	$con_1 = mysql_fetch_array($req_1);
	$req_2 = @mysql_query("SELECT COUNT(idrefus) AS refus
			FROM refus
			WHERE idclient='$contenu[codeclient]'	
			AND annee_ref='$an'
			AND mois='$i'
			GROUP BY mois")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$con_2 = mysql_fetch_array($req_2);

	@$nuite = $nuite+$contenu['nuite'];
	@$nbreclient = $nbreclient+$contenu['nbreclient'];
	@$caheb = $caheb+$contenu['caheb'];
	@$cares = $cares+$contenu['cares'];
	@$cadiv = $cadiv+$contenu['cadiv'];
	@$catotal = $catotal+$contenu['catotal'];
	@$quantannul = $quantannul+$con_1['annulation'];
	@$quantrefus = $quantrefus+$con_2['refus'];
	@$contenu[caheb] = str_replace(".",",",$contenu['caheb']);
	@$contenu[cares] = str_replace(".",",",$contenu['cares']);
	@$contenu[cadiv] = str_replace(".",",",$contenu['cadiv']);
	@$contenu[catotal] = str_replace(".",",",$contenu['catotal']);

	echo "<tr><td>$Mois[$i]</td>";
	if (@$contenu[nuite] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu[nuite]</center></td>"; }		  
	if (@$contenu[nbreclient] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu[nbreclient]</center></td>"; }
	if (@$contenu[caheb] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu[caheb] &euro;</center></td>"; }
	if (@$contenu[cares] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu[cares] &euro;</center></td>"; }
	if (@$contenu[cadiv] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu[cadiv] &euro;</center></td>"; }
	if (@$contenu[catotal] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu[catotal] &euro;</center></td>"; }
	if (@$con_1[annulation] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$con_1[annulation]</center></td>"; }
	if (@$con_2[refus] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$con_2[refus]</center></td>"; }
	
	@$nuitmoin = $nuitmoin+$contenu_2['nuite'];
	@$camoin = $camoin+$contenu_2['catotal'];		    
	@$contenu_2['catotal'] = str_replace(".",",",$contenu_2['catotal']);
			
	if (@$contenu_2[nuite] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu_2[nuite]</center></td>"; }
	if (@$contenu_2[catotal] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu_2[catotal] &euro;</center></td>"; }
    	echo "</tr>";
	}
		  $caheb = str_replace(".",",",$caheb);
		  $cares = str_replace(".",",",$cares);
		  $cadiv = str_replace(".",",",$cadiv);
		  $catotal = str_replace(".",",",$catotal);
		  $camoin = str_replace(".",",",$camoin);
		  	 
		  print "<tr><td class='news'><center>TOTAL</center></td>";
		  print "<td><center><b>$nuite</b></center></td>";
		  print "<td><center><b>$nbreclient</b></center></td>";
		  print "<td><div align=right><b>$caheb &euro;</b></div></td>";
		  print "<td><div align=right><b>$cares &euro;</b></div></td>";
		  print "<td><div align=right><b>$cadiv &euro;</b></div></td>";
          	  print "<td><div align=right><b>$catotal &euro;</b></div></td>"; 
		  print "<td><center><b>$quantannul</b></center></td>";
		  print "<td><center><b>$quantrefus</b></center></td>";
		  print "<td><center><b>$nuitmoin</b></center></td>";
		  print "<td><b>$camoin &euro;</b></td>";
print "</tr></table>";  
// Destruction de la table temporaire
$req_del = @mysql_db_query($nomdelabdd,"DROP TABLE tmp")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	
@mysql_close();          // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
?>
</table>
</body>
</html>
<?php
break;

case '2':
// Pop-up Productivite
echo "<div align='left' class='titre'><h3>Statistique du Client : $code...</h3></div>";
?>
<table width="100%" border="1">
  <tr bgcolor='#FFFF9B' class='news'> 
  <td width="12%"> 
      <div align="center"><b>Mois</b></div>
    </td>
    <td width="5%"> 
      <div align="center"><b>Nbre Nuitée</b></div>
    </td>
    <td width="5%"> 
      <div align="center"><b>Nbre Client</b></div>
    </td>
	<td width="10%"> 
      <div align="center"><b>CA Hébergement</b></div>
    </td>
	<td width="10%"> 
      <div align="center"><b>CA Restauration</b></div>
    </td>	
	<td width="10%"> 
      <div align="center"><b>CA Divers</b></div>
    </td>
	<td width="10%"> 
      <div align="center"><b>CA Total</b></div>
    </td>
	<td width="5%"> 
      <div align="center"><b>Nbre Annul</b></div>
    </td>	
	 <td width="5%"> 
      <div align="center"><b>Nbre Refus</b></div>
    </td>   
	<td width="8%"> 
      <div align="center"><b>Nbre Nuitée N-1</b></div>
    </td>   
	<td width="8%"> 
      <div align="center"><b>CA Total N-1</b></div>
    </td>   
  </tr>
<?
$Mois = array (1=>'Janvier',2=>'Février',3=>'Mars',4=>'Avril',5=>'Mai',6=>'Juin',7=>'Juillet',8=>'Août',9=>'Septembre',10=>'Octobre',11=>'Novembre',12=>'Décembre');   // création d'un tableau virtuel contenant les noms des mois
$mois = date("m"); 
$an = date("Y");
$anmoins = $an - 1;               
$nomdelabdd="statistique";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de données
@mysql_select_db($nomdelabdd, $bdd);                                // sélection de la Base de données

$req_a = @mysql_query("SELECT *
		FROM statistique 
		WHERE codeclient='$code'
		ORDER BY mois ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
$req_b= @mysql_db_query($nomdelabdd,"CREATE TEMPORARY TABLE tmp (
				idtemp 		int    	not null auto_increment,
				codeclient    	varchar(10),
				mois		varchar(2),
				annee		varchar(4),
				nuite		varchar(10),
				caheb		varchar(10),
				cares		varchar(10),
				cadiv		varchar(10),
				nbreclient	varchar(10),
				catotal		varchar(10),
				PRIMARY KEY   	(idtemp),
				UNIQUE idtemp 	(idtemp))")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
while($contenu = mysql_fetch_array($req_a)) 								
{
$req_insert = @mysql_db_query($nomdelabdd,"INSERT INTO tmp (
				codeclient,
				mois,
				annee,
				nuite,
				caheb,
				cares,
				cadiv,
				nbreclient,
				catotal) VALUES (
				\"$contenu[codeclient]\",
				\"$contenu[mois]\",
				\"$contenu[annee]\",
				\"$contenu[nuite]\",
				\"$contenu[caheb]\",
				\"$contenu[cares]\",
				\"$contenu[cadiv]\",
				\"$contenu[nbreclient]\",
				\"$contenu[catotal]\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}	

for($i=1;$i<=12;$i++)
	{
	$req_1 = @mysql_query("SELECT *,SUM(nuite) AS nuite,SUM(caheb) AS caheb,SUM(cares) AS cares,SUM(cadiv) AS cadiv,SUM(nbreclient) AS nbreclient,SUM(catotal) AS catotal
	FROM tmp
	WHERE mois=$i
	AND annee=$an
	GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	
	$contenu = mysql_fetch_array($req_1);
	$req_2 = @mysql_query("SELECT *,SUM(nuite) AS nuite,SUM(caheb) AS caheb,SUM(cares) AS cares,SUM(cadiv) AS cadiv,SUM(nbreclient) AS nbreclient,SUM(catotal) AS catotal
	FROM tmp
	WHERE mois=$i
	AND annee=$anmoins
	GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$contenu_2 = mysql_fetch_array($req_2);
	$req_1 = @mysql_query("SELECT COUNT(idannul) AS annulation
			FROM annulation 
			WHERE idclient='$contenu[codeclient]'
			AND annee='$an'
			AND mois='$i'
			GROUP BY mois")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
	$con_1 = mysql_fetch_array($req_1);
	$req_2 = @mysql_query("SELECT COUNT(idrefus) AS refus
			FROM refus
			WHERE idclient='$contenu[codeclient]'	
			AND annee_ref='$an'
			AND mois='$i'
			GROUP BY mois")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$con_2 = mysql_fetch_array($req_2);

	$nuite = $nuite+$contenu['nuite'];
	$nbreclient = $nbreclient+$contenu['nbreclient'];
	$caheb = $caheb+$contenu['caheb'];
	$cares = $cares+$contenu['cares'];
	$cadiv = $cadiv+$contenu['cadiv'];
	$catotal = $catotal+$contenu['catotal'];
	$quantannul = $quantannul+$con_1['annulation'];
	$quantrefus = $quantrefus+$con_2['refus'];
	@$contenu[caheb] = str_replace(".",",",$contenu[caheb]);
	@$contenu[cares] = str_replace(".",",",$contenu[cares]);
	@$contenu[cadiv] = str_replace(".",",",$contenu[cadiv]);
	@$contenu[catotal] = str_replace(".",",",$contenu[catotal]);

	echo "<tr><td>$Mois[$i]</td>";
	if (@$contenu[nuite] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu[nuite]</center></td>"; }		  
	if (@$contenu[nbreclient] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu[nbreclient]</center></td>"; }
	if (@$contenu[caheb] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu[caheb] &euro;</center></td>"; }
	if (@$contenu[cares] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu[cares] &euro;</center></td>"; }
	if (@$contenu[cadiv] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu[cadiv] &euro;</center></td>"; }
	if (@$contenu[catotal] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu[catotal] &euro;</center></td>"; }
	if (@$con_1[annulation] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$con_1[annulation]</center></td>"; }
	if (@$con_2[refus] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$con_2[refus]</center></td>"; }
	
	@$nuitmoin = $nuitmoin+$contenu_2[nuite];
	@$camoin = $camoin+$contenu_2[catotal];		    
	@$contenu_2[catotal] = str_replace(".",",",$contenu_2[catotal]);
			
	if (@$contenu_2[nuite] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu_2[nuite]</center></td>"; }
	if (@$contenu_2[catotal] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu_2[catotal] &euro;</center></td>"; }
    	echo "</tr>";
	}
		  $caheb = str_replace(".",",",$caheb);
		  $cares = str_replace(".",",",$cares);
		  $cadiv = str_replace(".",",",$cadiv);
		  $catotal = str_replace(".",",",$catotal);
		  $camoin = str_replace(".",",",$camoin);
		  	 
		  print "<tr><td class='news'><center>TOTAL</center></td>";
		  print "<td><center><b>$nuite</b></center></td>";
		  print "<td><center><b>$nbreclient</b></center></td>";
		  print "<td><div align=right><b>$caheb &euro;</b></div></td>";
		  print "<td><div align=right><b>$cares &euro;</b></div></td>";
		  print "<td><div align=right><b>$cadiv &euro;</b></div></td>";
          	  print "<td><div align=right><b>$catotal &euro;</b></div></td>"; 
		  print "<td><center><b>$quantannul</b></center></td>";
		  print "<td><center><b>$quantrefus</b></center></td>";
		  print "<td><center><b>$nuitmoin</b></center></td>";
		  print "<td><b>$camoin &euro;</b></td>";
print "</tr></table>";  
// Destruction de la table temporaire
$req_del = @mysql_db_query($nomdelabdd,"DROP TABLE tmp")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	
@mysql_close();          // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
?>
</table>
<br>
<center>
<input type="button" name="fermer" value="Fermer" onClick="window.close()"></center>
</body>
</html>
<?php

break;

case '3':

// Sers dans les requetes
$conte=crypte($stat); 			// Fonction de deleanerisation de l'url de requete
@$nomclient = $conte[nomclient];
@$codeclient = $conte[codeclient];
if ($conte[codetablis] <> NULL){ $codetablis = $conte[codetablis]; }
if ($code <> NULL){ $codeclient = $code; }

echo "<div align='left' class='titre'><h3>Statistique du Client : $codeclient...</h3></div>";
?>
<table width="100%" border="1">
  <tr bgcolor='#FFFF9B' class='news'> 
  <td width="12%"> 
      <div align="center"><b>Mois</b></div>
    </td>
    <td width="5%"> 
      <div align="center"><b>Nbre Nuitée</b></div>
    </td>
    <td width="5%"> 
      <div align="center"><b>Nbre Client</b></div>
    </td>
	<td width="10%"> 
      <div align="center"><b>CA Hébergement</b></div>
    </td>
	<td width="10%"> 
      <div align="center"><b>CA Restauration</b></div>
    </td>	
	<td width="10%"> 
      <div align="center"><b>CA Divers</b></div>
    </td>
	<td width="10%"> 
      <div align="center"><b>CA Total</b></div>
    </td>
	<td width="5%"> 
      <div align="center"><b>Nbre Annul</b></div>
    </td>	
	 <td width="5%"> 
      <div align="center"><b>Nbre Refus</b></div>
    </td>   
	<td width="8%"> 
      <div align="center"><b>Nbre Nuitée N-1</b></div>
    </td>   
	<td width="8%"> 
      <div align="center"><b>CA Total N-1</b></div>
    </td>   
  </tr>
<?
$Mois = array (1=>'Janvier',2=>'Février',3=>'Mars',4=>'Avril',5=>'Mai',6=>'Juin',7=>'Juillet',8=>'Août',9=>'Septembre',10=>'Octobre',11=>'Novembre',12=>'Décembre');   // création d'un tableau virtuel contenant les noms des mois               
$mois = date("m"); 
$an = date("Y");
$anmoins = $an - 1;

$nomdelabdd="statistique";
@$conte[nomclient]=mysql_escape_string($conte[nomclient]);

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de données
@mysql_select_db($nomdelabdd, $bdd);                                // sélection de la Base de données
$req_a = @mysql_query("SELECT *
		FROM statistique 
		WHERE codetablis='$codetablis'
		AND codeclient='$codeclient'
		ORDER BY mois ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
$req_b= @mysql_db_query($nomdelabdd,"CREATE TEMPORARY TABLE tmp (
				idtemp 		int    	not null auto_increment,
				codeclient    	varchar(10),
				mois		varchar(2),
				annee		varchar(4),
				nuite		varchar(10),
				caheb		varchar(10),
				cares		varchar(10),
				cadiv		varchar(10),
				nbreclient	varchar(10),
				catotal		varchar(10),
				PRIMARY KEY   	(idtemp),
				UNIQUE idtemp 	(idtemp))")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
while($contenu = mysql_fetch_array($req_a)) 								
{
$req_insert = @mysql_db_query($nomdelabdd,"INSERT INTO tmp (
				codeclient,
				mois,
				annee,
				nuite,
				caheb,
				cares,
				cadiv,
				nbreclient,
				catotal) VALUES (
				\"$contenu[codeclient]\",
				\"$contenu[mois]\",
				\"$contenu[annee]\",
				\"$contenu[nuite]\",
				\"$contenu[caheb]\",
				\"$contenu[cares]\",
				\"$contenu[cadiv]\",
				\"$contenu[nbreclient]\",
				\"$contenu[catotal]\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}	

for($i=1;$i<=12;$i++)
	{
	$req_1 = @mysql_query("SELECT *
	FROM tmp
	WHERE mois=$i
	AND annee=$an")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	
	$contenu = mysql_fetch_array($req_1);
	$req_2 = @mysql_query("SELECT *
	FROM tmp
	WHERE mois=$i
	AND annee=$anmoins")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$contenu_2 = mysql_fetch_array($req_2);
	$req_1 = @mysql_query("SELECT COUNT(idannul) AS annulation
			FROM annulation 
			WHERE idhotel='$codetablis'
			AND idclient='$contenu[codeclient]'
			AND annee='$an'
			AND mois='$i'
			GROUP BY mois")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
	$con_1 = mysql_fetch_array($req_1);
	$req_2 = @mysql_query("SELECT COUNT(idrefus) AS refus
			FROM refus
			WHERE idetablis='$codetablis'
			AND idclient='$contenu[codeclient]'	
			AND annee_ref='$an'
			AND mois='$i'
			GROUP BY mois")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$con_2 = mysql_fetch_array($req_2);

	$nuite = $nuite+$contenu[nuite];
	$nbreclient = $nbreclient+$contenu[nbreclient];
	$caheb = $caheb+$contenu[caheb];
	$cares = $cares+$contenu[cares];
	$cadiv = $cadiv+$contenu[cadiv];
	$catotal = $catotal+$contenu[catotal];
	$quantannul = $quantannul+$con_1[annulation];
	$quantrefus = $quantrefus+$con_2[refus];
	$contenu[caheb] = str_replace(".",",",$contenu[caheb]);
	$contenu[cares] = str_replace(".",",",$contenu[cares]);
	$contenu[cadiv] = str_replace(".",",",$contenu[cadiv]);
	$contenu[catotal] = str_replace(".",",",$contenu[catotal]);

	echo "<tr><td>$Mois[$i]</td>";
	if ($contenu[nuite] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu[nuite]</center></td>"; }		  
	if ($contenu[nbreclient] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu[nbreclient]</center></td>"; }
	if ($contenu[caheb] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu[caheb] &euro;</center></td>"; }
	if ($contenu[cares] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu[cares] &euro;</center></td>"; }
	if ($contenu[cadiv] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu[cadiv] &euro;</center></td>"; }
	if ($contenu[catotal] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu[catotal] &euro;</center></td>"; }
	if ($con_1[annulation] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$con_1[annulation]</center></td>"; }
	if ($con_2[refus] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$con_2[refus]</center></td>"; }
	
	$nuitmoin = $nuitmoin+$contenu_2[nuite];
	$camoin = $camoin+$contenu_2[catotal];		    
	$contenu_2[catotal] = str_replace(".",",",$contenu_2[catotal]);
			
	if ($contenu_2[nuite] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu_2[nuite]</center></td>"; }
	if ($contenu_2[catotal] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu_2[catotal] &euro;</center></td>"; }
    	echo "</tr>";
	}
		  $caheb = str_replace(".",",",$caheb);
		  $cares = str_replace(".",",",$cares);
		  $cadiv = str_replace(".",",",$cadiv);
		  $catotal = str_replace(".",",",$catotal);
		  $camoin = str_replace(".",",",$camoin);
		  	 
		  print "<tr><td class='news'><center>TOTAL</center></td>";
		  print "<td><center><b>$nuite</b></center></td>";
		  print "<td><center><b>$nbreclient</b></center></td>";
		  print "<td><div align=right><b>$caheb &euro;</b></div></td>";
		  print "<td><div align=right><b>$cares &euro;</b></div></td>";
		  print "<td><div align=right><b>$cadiv &euro;</b></div></td>";
          	  print "<td><div align=right><b>$catotal &euro;</b></div></td>"; 
		  print "<td><center><b>$quantannul</b></center></td>";
		  print "<td><center><b>$quantrefus</b></center></td>";
		  print "<td><center><b>$nuitmoin</b></center></td>";
		  print "<td><b>$camoin &euro;</b></td>";
print "</tr></table>";  
// Destruction de la table temporaire
$req_del = @mysql_db_query($nomdelabdd,"DROP TABLE tmp")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	
@mysql_close();          // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
?>
</table>
</body>
</html>
<?php
break;

case '4':

// Pour la recherche de productivité par hotel
$conte=crypte($stat); 			// Fonction de deleanerisation de l'url de requete
@$nomclient = $conte[nomclient];
@$codeclient = $conte[codeclient];
@$codetablis = $conte[codetablis];
$nomdelabdd="statistique";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de données
@mysql_select_db($nomdelabdd, $bdd);                                // sélection de la Base de données
$requete = @mysql_db_query($nomdelabdd,"SELECT nomhotel FROM hotel
										WHERE codehotel='$codetablis'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
$hot = mysql_fetch_array ($requete);

echo "<div align='left' class='titre'><h3>Statistique du Client : $codeclient $nomclient pour l'hôtel $hot[nomhotel]...</h3></div>";

?>
<table width="100%" border="1">
<tr bgcolor='#FFFF9B' class='news'> 
  <td width="12%"> 
      <div align="center"><b>Mois</b></div>
    </td>
    <td width="5%"> 
      <div align="center"><b>Nbre Nuitée</b></div>
    </td>
    <td width="5%"> 
      <div align="center"><b>Nbre Client</b></div>
    </td>
	<td width="10%"> 
      <div align="center"><b>CA Hébergement</b></div>
    </td>
	<td width="10%"> 
      <div align="center"><b>CA Restauration</b></div>
    </td>	
	<td width="10%"> 
      <div align="center"><b>CA Divers</b></div>
    </td>
	<td width="10%"> 
      <div align="center"><b>CA Total</b></div>
    </td>
	<td width="5%"> 
      <div align="center"><b>Nbre Annul</b></div>
    </td>	
	 <td width="5%"> 
      <div align="center"><b>Nbre Refus</b></div>
    </td>   
	<td width="8%"> 
      <div align="center"><b>Nbre Nuitée N-1</b></div>
    </td>   
	<td width="8%"> 
      <div align="center"><b>CA Total N-1</b></div>
    </td>   
  </tr>
<?php
$Mois = array (1=>'Janvier',2=>'Février',3=>'Mars',4=>'Avril',5=>'Mai',6=>'Juin',7=>'Juillet',8=>'Août',9=>'Septembre',10=>'Octobre',11=>'Novembre',12=>'Décembre');   // création d'un tableau virtuel contenant les noms des mois
$mois = date("m"); 
// Date
if ( ! isset($an)) $an=date("Y");
$anmoins = $an - 1;

$nomclient=mysql_escape_string($conte['nomclient']);

$req_a = @mysql_query("SELECT *
		FROM statistique 
		WHERE codetablis='$codetablis'
		AND codeclient='$codeclient'
		AND nomclient=\"$nomclient\"
		ORDER BY mois ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
$req_b= @mysql_db_query($nomdelabdd,"CREATE TEMPORARY TABLE tmp (
				idtemp 		int    	not null auto_increment,
				codeclient    	varchar(10),
				mois		varchar(2),
				annee		varchar(4),
				nuite		varchar(10),
				caheb		varchar(10),
				cares		varchar(10),
				cadiv		varchar(10),
				nbreclient	varchar(10),
				catotal		varchar(10),
				PRIMARY KEY   	(idtemp),
				UNIQUE idtemp 	(idtemp))")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
while($contenu = mysql_fetch_array($req_a)) 								
{
$req_insert = @mysql_db_query($nomdelabdd,"INSERT INTO tmp (
				codeclient,
				mois,
				annee,
				nuite,
				caheb,
				cares,
				cadiv,
				nbreclient,
				catotal) VALUES (
				\"$contenu[codeclient]\",
				\"$contenu[mois]\",
				\"$contenu[annee]\",
				\"$contenu[nuite]\",
				\"$contenu[caheb]\",
				\"$contenu[cares]\",
				\"$contenu[cadiv]\",
				\"$contenu[nbreclient]\",
				\"$contenu[catotal]\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}	

for($i=1;$i<=12;$i++)
	{
	$req_1 = @mysql_query("SELECT SUM(nuite) AS nuite,SUM(caheb) AS caheb,SUM(cares) AS cares,SUM(cadiv) AS cadiv,SUM(nbreclient) AS nbreclient,SUM(catotal) AS catotal
	FROM tmp
	WHERE mois=$i
	AND annee=$an
	GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	
	$contenu = mysql_fetch_array($req_1);
	$req_2 = @mysql_query("SELECT SUM(nuite) AS nuite,SUM(caheb) AS caheb,SUM(cares) AS cares,SUM(cadiv) AS cadiv,SUM(nbreclient) AS nbreclient,SUM(catotal) AS catotal
	FROM tmp
	WHERE mois=$i
	AND annee=$anmoins
	GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$contenu_2 = mysql_fetch_array($req_2);
	$req_1 = @mysql_query("SELECT COUNT(idannul) AS annulation
			FROM annulation 
			WHERE idhotel='$codetablis'
			AND idclient='$contenu[codeclient]'
			AND annee='$an'
			AND mois='$i'
			GROUP BY mois")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
	$con_1 = mysql_fetch_array($req_1);
	$req_2 = @mysql_query("SELECT COUNT(idrefus) AS refus
			FROM refus
			WHERE idetablis='$codetablis'
			AND idclient='$contenu[codeclient]'	
			AND annee_ref='$an'
			AND mois='$i'
			GROUP BY mois")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$con_2 = mysql_fetch_array($req_2);

	@$nuite = $nuite+$contenu['nuite'];
	@$nbreclient = $nbreclient+$contenu['nbreclient'];
	@$caheb = $caheb+$contenu['caheb'];
	@$cares = $cares+$contenu['cares'];
	@$cadiv = $cadiv+$contenu['cadiv'];
	@$catotal = $catotal+$contenu['catotal'];
	@$quantannul = $quantannul+$con_1['annulation'];
	@$quantrefus = $quantrefus+$con_2['refus'];
	@$contenu['caheb'] = str_replace(".",",",$contenu['caheb']);
	@$contenu['cares'] = str_replace(".",",",$contenu['cares']);
	@$contenu['cadiv'] = str_replace(".",",",$contenu['cadiv']);
	@$contenu['catotal'] = str_replace(".",",",$contenu['catotal']);

	echo "<tr><td>$Mois[$i]</td>";
	if (@$contenu['nuite'] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu[nuite]</center></td>"; }		  
	if (@$contenu['nbreclient'] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu[nbreclient]</center></td>"; }
	if (@$contenu['caheb'] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu[caheb] &euro;</center></td>"; }
	if (@$contenu['cares'] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu[cares] &euro;</center></td>"; }
	if (@$contenu['cadiv'] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu[cadiv] &euro;</center></td>"; }
	if (@$contenu['catotal'] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu[catotal] &euro;</center></td>"; }
	if (@$con_1['annulation'] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$con_1[annulation]</center></td>"; }
	if (@$con_2['refus'] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$con_2[refus]</center></td>"; }
	
	@$nuitmoin = $nuitmoin+$contenu_2['nuite'];
	@$camoin = $camoin+$contenu_2['catotal'];		    
	@$contenu_2['catotal'] = str_replace(".",",",$contenu_2['catotal']);
			
	if (@$contenu_2['nuite'] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu_2[nuite]</center></td>"; }
	if (@$contenu_2['catotal'] == NULL) { echo "<td><center>0</center></td>"; }
	else { echo "<td><center>$contenu_2[catotal] &euro;</center></td>"; }
    	echo "</tr>";
	}
		  $caheb = str_replace(".",",",$caheb);
		  $cares = str_replace(".",",",$cares);
		  $cadiv = str_replace(".",",",$cadiv);
		  $catotal = str_replace(".",",",$catotal);
		  $camoin = str_replace(".",",",$camoin);
		  	 
		  print "<tr><td class='news'><center>TOTAL</center></td>";
		  print "<td><center><b>$nuite</b></center></td>";
		  print "<td><center><b>$nbreclient</b></center></td>";
		  print "<td><div align=right><b>$caheb &euro;</b></div></td>";
		  print "<td><div align=right><b>$cares &euro;</b></div></td>";
		  print "<td><div align=right><b>$cadiv &euro;</b></div></td>";
          	  print "<td><div align=right><b>$catotal &euro;</b></div></td>"; 
		  print "<td><center><b>$quantannul</b></center></td>";
		  print "<td><center><b>$quantrefus</b></center></td>";
		  print "<td><center><b>$nuitmoin</b></center></td>";
		  print "<td><b>$camoin &euro;</b></td>";
print "</tr></table>";  
// Destruction de la table temporaire
$req_del = @mysql_db_query($nomdelabdd,"DROP TABLE tmp")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	
@mysql_close();          // spécifie que l'on n'a plus besoin de la connection Mysql et que l'on demande d'y mettre fin
?>
</table>
</body>
</html>
<?
}
?>