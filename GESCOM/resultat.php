<? include("Admin/sessions.php") ?>
<?php
include("Admin/includes/fonctions.php");        //Connection a la base Statistique 
?>
<html>
<head>
<title>Gestion Commerciale SOFIBRA</title>
<link rel="stylesheet" href="sofibra.css" type="text/css">
</head>
<body>
<SCRIPT language="JavaScript1.2">
function imprime()
{
	var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
    document.body.insertAdjacentHTML('beforeEnd', WebBrowser);
    WebBrowser1.ExecWB(6,2);
}
</SCRIPT>
<?php
switch ($requete) 
{
case 1:
?>
<br>
<center><input type="button" value="Impression du Tableau" onClick="imprime()"></center>
<br>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Part du CA et du nbre de Nuit&eacute;es pour <? echo "$an"; ?> par Mois et par H&ocirc;tel</center></h3>

<table width='100%' border='1'>
<tr> 
  <td width='9%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>H&ocirc;tel<center></b></div>
	  <table width='100%'>
        <tr><td>&nbsp;</td></tr>
	  </table>
    </td>    
    <td width='13%' bgcolor='#FFFF9B' class='news'> 
      <div align='center'><b>Janvier</b></div>
	  <table width='100%'>
        <tr>
          <td class='anotation'><div align='center'>CA</div></td>
          <td class='anotation'><div align='center'>Nuit&eacute;</div></td>
        </tr>
      </table>	      
    </td>
	<td width='13%' bgcolor='#FFFF9B' class='news'> 
      <div align='center'><b>F&eacute;vrier</b></div>
	   <table width='100%'>
        <tr>
          <td class='anotation'><div align='center'>CA</div></td>
          <td class='anotation'><div align='center'>Nuit&eacute;</div></td>
        </tr>
      </table>	      
    </td>
	<td width='13%' bgcolor='#FFFF9B' class='news'> 
      <div align='center'><b>Mars</b></div>
	   <table width='100%'>
        <tr>
          <td class='anotation'><div align='center'>CA</div></td>
          <td class='anotation'><div align='center'>Nuit&eacute;</div></td>
        </tr>
      </table>	      
    </td>	
	<td width='13%' bgcolor='#FFFF9B' class='news'> 
      <div align='center'><b>Avril</b></div>
	   <table width='100%'>
        <tr>
          <td class='anotation'><div align='center'>CA</div></td>
          <td class='anotation'><div align='center'>Nuit&eacute;</div></td>
        </tr>
      </table>	      
    </td>
	<td width='13%' bgcolor='#FFFF9B' class='news'> 
      <div align='center'><b>Mai</b></div>
	   <table width='100%'>
        <tr>
          <td class='anotation'><div align='center'>CA</div></td>
          <td class='anotation'><div align='center'>Nuit&eacute;</div></td>
        </tr>
      </table>	      
    </td>
	<td width='13%' bgcolor='#FFFF9B' class='news'> 
      <div align='center'><b>Juin</b></div>
	   <table width='100%'>
        <tr>
          <td class='anotation'><div align='center'>CA</div></td>
          <td class='anotation'><div align='center'>Nuit&eacute;</div></td>
        </tr>
      </table>	      
    </td>	
	<td width='13%' bgcolor='#FFFF9B' class='news'> 
      
	  <table width='100%'>
        <tr>
          <td class='anotation'><div align='center'>CA</div></td>
          <td class='anotation'><div align='center'>Nuit&eacute;</div></td>
        </tr>
      </table>	
	</td>
</tr>
</table>
<table width='100%' border='1'>
<?php
$nomdelabdd="statistique";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es

// Selection en fonction du choix utilisateur
if ($indice == 'T')
{
$requete = @mysql_query("SELECT s.codetablis,s.mois,SUM(catotal) AS catotal,SUM(nuite) AS nuite,h.siglehotel
						 FROM statistique s,hotel h
						 WHERE s.codetablis=h.codehotel
						 AND s.annee='$an'
						 AND s.codeclient BETWEEN '950000' AND '990000'
						 GROUP BY s.codetablis,s.mois")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
}
else
	{
	$requete = @mysql_query("SELECT s.codetablis,s.mois,SUM(catotal) AS catotal,SUM(nuite) AS nuite,h.siglehotel
							 FROM statistique s,hotel h
							 WHERE s.codetablis=h.codehotel
							 AND s.annee='$an'
							 AND s.codeclient BETWEEN '800000' AND '949999'
							 GROUP BY s.codetablis,s.mois")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
	}

$req_cree = @mysql_db_query($nomdelabdd,"CREATE TEMPORARY TABLE tmp (
										 idtemp         int not null auto_increment,
										 codetablis     varchar(4),
										 siglehotel     varchar(4),
										 catotal        varchar(10),
										 nuite          varchar(10),
										 mois 			int(2),
										 PRIMARY KEY   (idtemp),
										 UNIQUE idtemp (idtemp))")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");

while($contenu = mysql_fetch_array($requete)) 								
{
$req_insert = @mysql_db_query($nomdelabdd,"INSERT INTO tmp (codetablis,siglehotel,catotal,nuite,mois)
										   VALUES (\"$contenu[codetablis]\",			
												   \"$contenu[siglehotel]\",
												   \"$contenu[catotal]\",
												   \"$contenu[nuite]\",											   
												   \"$contenu[mois]\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}

$req_hotel = @mysql_query("SELECT *
						   FROM hotel
						   WHERE siglehotel <> ''")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								

while($valeur = mysql_fetch_array($req_hotel)) 
          {	 
          $req_sel_1 = @mysql_query("SELECT *
						   FROM tmp t
						   WHERE mois='1'
						   AND t.codetablis=\"$valeur[codehotel]\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
        $val_1 = mysql_fetch_array($req_sel_1);
         $val_1['catotal'] = round($val_1['catotal']);	
		  print "<tr class='news'>";		  
		  print "<td width='9%' class='news'>$valeur[siglehotel]</td>";			 
		  print "<td width='6,5%'><div align=right>$val_1[catotal] &euro;</div></td>";			     				
		  print "<td width='6,5%'><div align=right>$val_1[nuite]</div></td>";									
		  $req_sel_2 = @mysql_query("SELECT *
						             FROM tmp t
						   			 WHERE t.mois='2'
									 	 AND t.codetablis=\"$valeur[codehotel]\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");										
  		  $val_2 = mysql_fetch_array($req_sel_2);
          $val_2['catotal'] = round($val_2['catotal']);	
		  print "<td width='6,5%'><div align=right>$val_2[catotal] &euro;</div></td>";			     				
		  print "<td width='6,5%'><div align=right>$val_2[nuite]</div></td>";		
		  $req_sel_3 = @mysql_query("SELECT *
						             FROM tmp t
						   			 WHERE t.mois='3'
									    AND t.codetablis=\"$valeur[codehotel]\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");										
  		  $val_3 = mysql_fetch_array($req_sel_3);
          $val_3['catotal'] = round($val_3['catotal']);	
		  print "<td width='6,5%'><div align=right>$val_3[catotal] &euro;</div></td>";			     				
		  print "<td width='6,5%'><div align=right>$val_3[nuite]</div></td>";		
		  $req_sel_4 = @mysql_query("SELECT *
						             FROM tmp t
						   			 WHERE t.mois='4'
									    AND t.codetablis=\"$valeur[codehotel]\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");										
  		  $val_4 = mysql_fetch_array($req_sel_4);
          $val_4['catotal'] = round($val_4['catotal']);	
		  print "<td width='6,5%'><div align=right>$val_4[catotal] &euro;</div></td>";			     				
		  print "<td width='6,5%'><div align=right>$val_4[nuite]</div></td>";		
		  $req_sel_5 = @mysql_query("SELECT *
						             FROM tmp t
						   			 WHERE t.mois='5'
									    AND t.codetablis=\"$valeur[codehotel]\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");										
  		  $val_5 = mysql_fetch_array($req_sel_5);
          $val_5['catotal'] = round($val_5['catotal']);	
		  print "<td width='6,5%'><div align=right>$val_5[catotal] &euro;</div></td>";			     				
		  print "<td width='6,5%'><div align=right>$val_5[nuite]</div></td>";		
		  $req_sel_6 = @mysql_query("SELECT *
						             FROM tmp t
						   			 WHERE t.mois='6'
									    AND t.codetablis=\"$valeur[codehotel]\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");										
  		  $val_6 = mysql_fetch_array($req_sel_6);
          $val_6['catotal'] = round($val_6['catotal']);	
		  print "<td width='6,5%'><div align=right>$val_6[catotal] &euro;</div></td>";			     				
		  print "<td width='6,5%'><div align=right>$val_6[nuite]</div></td>";		
		  
		  @$total_ca = $val_1['catotal']+$val_2['catotal']+$val_3['catotal']+$val_4['catotal']+$val_5['catotal']+$val_6['catotal'];	
		  @$total_nuite = $val_1['nuite']+$val_2['nuite']+$val_3['nuite']+$val_4['nuite']+$val_5['nuite']+$val_6['nuite'];
		  
		  @$total1 = $total1 + $val_1['catotal'];
		  @$total2 = $total2 + $val_2['catotal'];
		  @$total3 = $total3 + $val_3['catotal'];
		  @$total4 = $total4 + $val_4['catotal'];
		  @$total5 = $total5 + $val_5['catotal'];
		  @$total6 = $total6 + $val_6['catotal'];
		  @$nuite1 = $nuite1 + $val_1['nuite'];
		  @$nuite2 = $nuite2 + $val_2['nuite'];
		  @$nuite3 = $nuite3 + $val_3['nuite'];
		  @$nuite4 = $nuite4 + $val_4['nuite'];
		  @$nuite5 = $nuite5 + $val_5['nuite'];
		  @$nuite6 = $nuite6 + $val_6['nuite'];
		  
		  print "<td width='6,5%'><div align=right><b>$total_ca &euro;</b></div></td>
		  		 <td width='6,5%'><div align=right><b>$total_nuite</b></div></td>"; 
		  print "</tr>";	
		  }	
		  @$total = $total1 + $total2 + $total3 + $total4 + $total5 + $total6; 
		  @$nuite = $nuite1 + $nuite2 + $nuite3 + $nuite4 + $nuite5 + $nuite6;
		   
		  print "<tr width='9%' class='anotation'><td><b>TOTAL</b></td>";		  
		  print "<td width='6,5%'><div align=right><b>$total1 &euro;</b></div></td>";
		  print "<td width='6,5%'><div align=right><b>$nuite1</b></div></td>";
		  print "<td width='6,5%'><div align=right><b>$total2 &euro;</b></div></td>";
		  print "<td width='6,5%'><div align=right><b>$nuite2</b></div></td>";
        print "<td width='6,5%'><div align=right><b>$total3 &euro;</b></div></td>";
		  print "<td width='6,5%'><div align=right><b>$nuite3</b></div></td>";
		  print "<td width='6,5%'><div align=right><b>$total4 &euro;</b></div></td>";
		  print "<td width='6,5%'><div align=right><b>$nuite4</b></div></td>";
		  print "<td width='6,5%'><div align=right><b>$total5 &euro;</b></div></td>";
		  print "<td width='6,5%'><div align=right><b>$nuite5</b></div></td>";
   	  print "<td width='6,5%'><div align=right><b>$total6 &euro;</b></div></td>"; 
		  print "<td width='6,5%'><div align=right><b>$nuite6</b></div></td>";
		  print "<td width='6,5%'><div align=right><b>$total &euro;</b></div></td>";
		  print "<td width='6,5%'><div align=right><b>$nuite</b></div></td></tr>";	  
		  
		  // On garde l'info pour le total final
		  $total_1 = $total;
		  $nuite_1 = $nuite;
?>
</table>
<br>
<table width="100%" border="1">
<tr> 
  <td width="9%" bgcolor='#FFFF9B' class='news'> 
     <div align="center"><b>H&ocirc;tel<center></b></div>
	  <table width="100%">
        <tr><td>&nbsp;</td></tr>
	  </table>
    </td>    
    <td width="13%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Juillet</b></div>
	  <table width="100%">
        <tr>
          <td class='anotation'><div align="center">CA</div></td>
          <td class='anotation'><div align="center">Nuit&eacute;</div></td>
        </tr>
      </table>	      
    </td>
	<td width="13%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Août</b></div>
	   <table width="100%">
        <tr>
          <td class='anotation'><div align="center">CA</div></td>
          <td class='anotation'><div align="center">Nuit&eacute;</div></td>
        </tr>
      </table>	      
    </td>
	<td width="13%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Septembre</b></div>
	   <table width="100%">
        <tr>
          <td class='anotation'><div align="center">CA</div></td>
          <td class='anotation'><div align="center">Nuit&eacute;</div></td>
        </tr>
      </table>	      
    </td>	
	<td width="13%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Octobre</b></div>
	   <table width="100%">
        <tr>
          <td class='anotation'><div align="center">CA</div></td>
          <td class='anotation'><div align="center">Nuit&eacute;</div></td>
        </tr>
      </table>	      
    </td>
	<td width="13%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Novembre</b></div>
	   <table width="100%">
        <tr>
          <td class='anotation'><div align="center">CA</div></td>
          <td class='anotation'><div align="center">Nuit&eacute;</div></td>
        </tr>
      </table>	      
    </td>
	<td width="13%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>D&eacute;cembre</b></div>
	   <table width="100%">
        <tr>
          <td class='anotation'><div align="center">CA</div></td>
          <td class='anotation'><div align="center">Nuit&eacute;</div></td>
        </tr>
      </table>	      
    </td>	
	<td width="13%" bgcolor='#FFFF9B' class='news'> 
      
	  <table width="100%">
        <tr>
          <td class='anotation'><div align="center">CA</div></td>
          <td class='anotation'><div align="center">Nuit&eacute;</div></td>
        </tr>
      </table>	
	</td>
</tr>
</table>
<table width="100%" border="1">
<?php
$req_hotel = @mysql_query("SELECT *
						   FROM hotel
						   WHERE siglehotel <> ''")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								

while($valeur = mysql_fetch_array($req_hotel)) 
          {	 
          $req_sel_7 = @mysql_query("SELECT *
						   FROM tmp t
						   WHERE t.mois='7'
						   AND t.codetablis=\"$valeur[codehotel]\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
        $val_7 = mysql_fetch_array($req_sel_7);
		  $val_7[catotal] = round($val_7[catotal]);	
		  print "<tr class='news'>";
		  print "<td width='9%' class='news'>$valeur[siglehotel]</td>";
		  print "<td width='6,5%'><div align=right>$val_7[catotal] &euro;</div></td>";			     				
		  print "<td width='6,5%'><div align=right>$val_7[nuite]</div></td>";		
		   $req_sel_8 = @mysql_query("SELECT *
						   FROM tmp t
						   WHERE t.mois='8'
						   AND t.codetablis=\"$valeur[codehotel]\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
     	  $val_8 = mysql_fetch_array($req_sel_8);
          $val_8[catotal] = round($val_8[catotal]);	
		  print "<td width='6,5%'><div align=right>$val_8[catotal] &euro;</div></td>";			     				
		  print "<td width='6,5%'><div align=right>$val_8[nuite]</div></td>";		
		  $req_sel_9 = @mysql_query("SELECT *
						             FROM tmp t
						   			 WHERE t.mois='9'
									    AND t.codetablis=\"$valeur[codehotel]\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");										
  		  $val_9 = mysql_fetch_array($req_sel_9);
          $val_9[catotal] = round($val_9[catotal]);	
		  print "<td width='6,5%'><div align=right>$val_9[catotal] &euro;</div></td>";			     				
		  print "<td width='6,5%'><div align=right>$val_9[nuite]</div></td>";		
		  $req_sel_10 = @mysql_query("SELECT *
						             FROM tmp t
						   			 WHERE t.mois='10'
									    AND t.codetablis=\"$valeur[codehotel]\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");										
  		  $val_10 = mysql_fetch_array($req_sel_10);
          $val_10[catotal] = round($val_10[catotal]);	
		  print "<td width='6,5%'><div align=right>$val_10[catotal] &euro;</div></td>";			     				
		  print "<td width='6,5%'><div align=right>$val_10[nuite]</div></td>";		
		  $req_sel_11 = @mysql_query("SELECT *
						             FROM tmp t
						   			 WHERE t.mois='11'
									    AND t.codetablis=\"$valeur[codehotel]\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");										
  		  $val_11 = mysql_fetch_array($req_sel_11);
          $val_11[catotal] = round($val_11[catotal]);	
		  print "<td width='6,5%'><div align=right>$val_11[catotal] &euro;</div></td>";			     				
		  print "<td width='6,5%'><div align=right>$val_11[nuite]</div></td>";		
		  $req_sel_12 = @mysql_query("SELECT *
						             FROM tmp t
						   			 WHERE t.mois='12'
									    AND t.codetablis=\"$valeur[codehotel]\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");										
  		  $val_12 = mysql_fetch_array($req_sel_12);
          $val_12[catotal] = round($val_12[catotal]);	
		  print "<td width='6,5%'><div align=right>$val_12[catotal] &euro;</div></td>";			     				
		  print "<td width='6,5%'><div align=right>$val_12[nuite]</div></td>";		
		  
		  $total_ca = $val_7[catotal]+$val_8[catotal]+$val_9[catotal]+$val_10[catotal]+$val_11[catotal]+$val_12[catotal];	
		  $total_nuite = $val_7[nuite]+$val_8[nuite]+$val_9[nuite]+$val_10[nuite]+$val_11[nuite]+$val_12[nuite];
		  
		  $total7 = $total7 + $val_7[catotal];
		  $total8 = $total8 + $val_8[catotal];
		  $total9 = $total9 + $val_9[catotal];
		  $total10 = $total10 + $val_10[catotal];
		  $total11 = $total11 + $val_11[catotal];
		  $total12 = $total12 + $val_12[catotal];
		  $nuite7 = $nuite7 + $val_7[nuite];
		  $nuite8 = $nuite8 + $val_8[nuite];
		  $nuite9 = $nuite9 + $val_9[nuite];
		  $nuite10 = $nuite10 + $val_10[nuite];
		  $nuite11 = $nuite11 + $val_11[nuite];
		  $nuite12 = $nuite12 + $val_12[nuite];
		  
		  print "<td width='6,5%'><div align=right><b>$total_ca &euro;</b></div></td>
		  		 <td width='6,5%'><div align=right><b>$total_nuite</b></div></td>"; 
		  }
		  $total = $total7 + $total8 + $total9 + $total10 + $total11 + $total12; 
		  $nuite = $nuite7 + $nuite8 + $nuite9 + $nuite10 + $nuite11 + $nuite12;
		   
		  print "<tr width='9%' class='anotation'><td><b>TOTAL</b></td>";		  
		  print "<td width='6,5%'><div align=right><b>$total7 &euro;</b></div></td>";
		  print "<td width='6,5%'><div align=right><b>$nuite7</b></div></td>";
		  print "<td width='6,5%'><div align=right><b>$total8 &euro;</b></div></td>";
		  print "<td width='6,5%'><div align=right><b>$nuite8</b></div></td>";
        print "<td width='6,5%'><div align=right><b>$total9 &euro;</b></div></td>";
		  print "<td width='6,5%'><div align=right><b>$nuite9</b></div></td>";
		  print "<td width='6,5%'><div align=right><b>$total10 &euro;</b></div></td>";
		  print "<td width='6,5%'><div align=right><b>$nuite10</b></div></td>";
		  print "<td width='6,5%'><div align=right><b>$total11 &euro;</b></div></td>";
		  print "<td width='6,5%'><div align=right><b>$nuite11</b></div></td>";
   	  print "<td width='6,5%'><div align=right><b>$total12 &euro;</b></div></td>"; 
		  print "<td width='6,5%'><div align=right><b>$nuite12</b></div></td>";
		  print "<td width='6,5%'><div align=right><b>$total &euro;</b></div></td>";
		  print "<td width='6,5%'><div align=right><b>$nuite</b></div></td></tr>";	  
		  print "</table>";
		   // On garde l'info pour le total final
		  $total_2 = $total;
		  $nuite_2 = $nuite;

// Destruction de la table temporaire
$req_del = @mysql_db_query($nomdelabdd,"DROP TABLE tmp")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
@mysql_close();	

$total_complet = $total_1 + $total_2;
$nuite_complet = $nuite_1 + $nuite_2;
echo "<span class=menu><div align=right><br>Total Nuit&eacute; : <b>";
echo $nuite_complet;
echo "</b>";
echo "<br>Total CA : <b>";
echo $total_complet;
echo " &euro;</b></div></span>";
?>
</body>
</html>
<?php
break;

case 2:
?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Mailing de tous les Clients</h3>
<br>
<center><input type="button" value="Impression du Mailing Complet" onClick="imprime()"></center>
<br>
<table width="100%" border="1">
  <tr> 
  	<td width="20%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Code Client</b></div>
    </td>
    <td width="20%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Nom Client</b></div>
    </td>
    <td width="30%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Adresse Client</b></div>
    </td>
    <td width="7%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>CP Client</b></div>
    </td>
    <td width="20%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Ville Client</b></div>
    </td>
    <td width="20%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Mail Client</b></div>
    </td>
    <td width="20%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Tel Client</b></div>
    </td>
    <td width="20%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Fax Client</b></div>
    </td>
  </tr>
<?php
$nomdelabdd="commercial";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es

$requete = @mysql_db_query($nomdelabdd,"SELECT c.*,v.nomville
										FROM client c,ville v
										WHERE c.idrce='$rce'
										AND c.idville=v.idville
										AND c.etat <> 0
										GROUP BY c.codeclient
										ORDER BY c.nomclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
$i = 0;
while($val = mysql_fetch_array($requete)) 	
	{
	print "<tr>";
	print "<td>$val[codeclient]</td>";
	print "<td>$val[nomclient]</td>";
	print "<td><center>$val[adresseclient]</center></td>";
	print "<td><center>$val[cpclient]</center></td>";
	print "<td><center>$val[nomville]</center></td>";
	print "<td>$val[mailclient]</td>";
	print "<td>$val[telclient]</td>";
	print "<td>$val[faxclient]</td>";
	print "</tr>";		  		
	$i++;
	}	
echo "<br>Il y a $i r&eacute;sultats";
@mysql_close();	
?>
</table></center>
</body>
</html>
<?php
break;

case 3:
?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Listing des Clients dont le pays contient <? echo "$option1"; ?> et le code commence par <? echo "$option2"; ?></h3></center>
<br>
<center><input type="button" value="Impression du Listing Complet" onClick="imprime()"></center>
<br>
<table width="100%" border="1">
  <tr> 
    <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Code Client</b></div>
    </td>
    <td width="14%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Nom Client</b></div>
    </td>
	<td width="15%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Adresse Client</b></div>
    </td>
	<td width="3%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>CP Client</b></div>
    </td>
	<td width="10%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Ville Client</b></div>
    </td>
    <td width="8%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Pays Client</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Client depuis le</b></div>
    </td>
    <td width="10%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>T&eacute;l&eacute;phone, Mail</b></div>
    </td>
	<td width="30%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Nom du Contact</b></div>
    </td>
	<td width="30%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Dernier Suivi</b></div>
    </td>
  </tr>
<?php
$nomdelabdd="commercial";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es

$requete = @mysql_db_query($nomdelabdd,"SELECT *,c.codeclient,p.nompays,v.nomville
										FROM client c,pays p,ville v
										WHERE p.nompays LIKE '$option1%'
										AND c.codeclient LIKE '$option2%'
										AND c.idville=v.idville
										AND c.etat <> 0
										AND c.idpays=p.idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
$compteures = mysql_numrows($requete);
while($contenu = mysql_fetch_array($requete)) 	
{	
	$requete1 = @mysql_db_query($nomdelabdd,"SELECT c.*,i.siglecivil,l.idclient
						FROM contact c,liencontact l,civil i
						WHERE c.idcontact=l.idcontact
						AND c.idcivil=i.idcivil
						AND l.idclient='$contenu[codeclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	if (mysql_numrows($requete1) == NULL)
	{
	echo "<tr>";
	echo "<td>$contenu[codeclient]</td>";
	echo "<td class='news'>$contenu[nomclient]</td>";
	echo "<td class='anotation'>$contenu[adresseclient]</td>";
	echo "<td>$contenu[cpclient]</td>";
	echo "<td>$contenu[nomville]</td>";
	echo "<td>$contenu[nompays]</td>";
	echo "<td>$contenu[dateclient]/$contenu[origineclient]</td>";
	echo "<td>$contenu[telclient]<br>$contenu[mailclient]</td>";
	echo "<td></td>";
	echo "<td>Aucun suivi</td>";
	echo "</tr>";
	}

	while($contenu1 = mysql_fetch_array($requete1))
	{
	$requete2 = @mysql_db_query($nomdelabdd,"SELECT c.*,p.nompays,v.nomville
						FROM client c,pays p,ville v
						WHERE c.codeclient='$contenu[codeclient]'
						AND c.idpays=p.idpays
						AND c.idville=v.idville
						AND c.etat <> 0
						ORDER BY c.nomclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
	$contenu2 = mysql_fetch_array($requete2);
	$requete3 = @mysql_db_query($nomdelabdd,"SELECT s.*
						FROM suivi s,liensuivi l
						WHERE l.idsuivi=s.idsuivi
						AND l.idcontact='$contenu1[idcontact]'
						ORDER BY idsuivi DESC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
	$contenu3 = mysql_fetch_array($requete3);
	
	$compt++;	
			echo "<tr>";
			echo "<td>$contenu[codeclient]</td>";
			echo "<td class='news'>$contenu2[nomclient]</td>";
			echo "<td class='anotation'>$contenu2[adresseclient]</td>";
			echo "<td>$contenu2[cpclient]</td>";
			echo "<td>$contenu2[nomville]</td>";
			echo "<td>$contenu2[nompays]</td>";
			echo "<td>$contenu2[dateclient]/$contenu2[origineclient]</td>";
			echo "<td>$contenu2[telclient]<br>$contenu2[mailclient]</td>";
			if (($contenu1[siglecivil] == "Non renseigne")||($contenu1[siglecivil] == "-"))
				{
				echo "<td>$contenu1[nomcontact] $contenu1[prenomcontact]</td>";
				}
				else
					{
					echo "<td>$contenu1[siglecivil] $contenu1[nomcontact] $contenu1[prenomcontact]</td>";
					}
			$contenu3[futursuivi] = transformfrench_date(@$contenu3[futursuivi]);
			if ($contenu3[futursuivi] == NULL){ echo "<td>Aucun suivi</td>"; }
			else { echo "<td>$contenu3[futursuivi]</td>"; }
			echo "</tr>";
	}
}
@mysql_close();	
?>
</table>
<?
if ($compteures <> 0)
{
echo "<br><br><b>La recherche a donn&eacute; $compteures Clients et $compt Contacts.</b>";
}
else
{
echo "La recherche n'a pas donn&eacute; de r&eacute;sultats.";
}
?>
</body>
</html>
<?php
break;

case 4:

?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Listing des Clients dont le pays contient <? echo "$option2"; ?></h3>
<br>
<center><input type="button" value="Impression du Listing Complet" onClick="imprime()"></center>
<br>
<table width="80%" border="1">
  <tr> 
  	<td width="10%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Type de Client</b></div>
    </td>
    <td width="10%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Code Client</b></div>
    </td>
    <td width="10%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Nom Client</b></div>
    </td>
	<td width="15%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Adresse Client</b></div>
    </td>
	<td width="10%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>CP Client</b></div>
    </td>
	<td width="10%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Ville Client</b></div>
    </td>
    <td width="15%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>T&eacute;l&eacute;phone</b></div>
    </td>
  </tr>
<?php
$nomdelabdd="commercial";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es

$requete = @mysql_db_query($nomdelabdd,"SELECT idpays
										FROM pays
										WHERE nompays LIKE '$option2%'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
$val = mysql_fetch_array($requete);
$requete1 = @mysql_db_query($nomdelabdd,"SELECT *,t.nomtype,v.nomville
										 FROM client c,type t,ville v
										 WHERE c.idtype='$option1'
										 AND c.idpays='$val[idpays]'
										 AND c.idtype=t.idtype
										 AND c.idville=v.idville
										 AND c.etat <> 0
										 ORDER BY c.nomclient ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
$compteur = mysql_numrows($requete1);
print "La recherche a donn&eacute; $compteur r&eacute;sultats.<br><br>";

while($contenu = mysql_fetch_array($requete1)) 	
	{	
	echo "<tr>";	
	echo "<td>$contenu[nomtype]</td>";
	echo "<td>$contenu[codeclient]</td>";
	echo "<td>$contenu[nomclient]</td>";
	echo "<td>$contenu[adresseclient]</td>";
	echo "<td>$contenu[cpclient]</td>";
	echo "<td>$contenu[nomville]</td>";
	echo "<td>$contenu[telclient]</td>";
	echo "</tr>";
	}	
@mysql_close();	
?>
</table>
</body>
</html>
<?php
break;

case 5:

?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>CA et du Nbre de Nuit&eacute;es</center></h3>
<br>
<center><input type="button" value="Impression des du CA et du nbre de Nuit&eacute;es" onClick="imprime()"></center>
<br>
<center><table width='80%' border='1'>
  <tr> 
  <td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Code Client<center></b></div>
  </td>    
  <td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nom Client<center></b></div>
  </td>    
  <td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nuit&eacute;es <? echo "$an"; ?><center></b></div>
  </td>     
  <td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA <? echo "$an"; ?><center></b></div>
  </td>     
  </tr>
<?php
$nomdelabdd="commercial";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es

// Selection en fonction du choix utilisateur
if ($indice == 'T')
{
$requete = @mysql_db_query($nomdelabdd,"SELECT c.codeclient,c.nomclient,p.nompays
										FROM client c,pays p
										WHERE c.idpays=\"$pays\"
										AND c.idpays=p.idpays
										AND c.codeclient BETWEEN '950000' AND '990000'
										AND c.etat <> 0			
										GROUP BY c.codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
}
else
	{
	$requete = @mysql_db_query($nomdelabdd,"SELECT c.codeclient,c.nomclient,p.nompays
											FROM client c,pays p
											WHERE c.idpays=\"$pays\"
											AND c.idpays=p.idpays
											AND c.codeclient BETWEEN '800000' AND '949999'
											AND c.etat <> 0				
											GROUP BY c.codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
	}

@mysql_close(); 

$nomdelabdd="statistique";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es

$requete1 = @mysql_db_query($nomdelabdd,"CREATE TEMPORARY TABLE tmp (
										 idtemp int not null auto_increment,
										 codeclient varchar(6),
										 nomclient varchar(50),
										 nompays varchar(50),
										 PRIMARY KEY   (idtemp),
										 UNIQUE idtemp (idtemp))")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Insertion des donn&eacute;es de la base commercial pour comparaison avec la base statistique
while($contenu = mysql_fetch_array($requete)) 								
{
$requete2 = @mysql_db_query($nomdelabdd,"INSERT INTO tmp (codeclient,nomclient,nompays)
					VALUES (\"$contenu[codeclient]\",			
					\"$contenu[nomclient]\",
					\"$contenu[nompays]\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}
$requete3 = @mysql_db_query($nomdelabdd,"SELECT SUM(catotal) AS catotal,SUM(nuite) AS nuite,t.nompays,s.codeclient,s.nomclient
										 FROM statistique s,tmp t
										 WHERE s.codeclient=t.codeclient
										 AND s.catotal <> 0
										 AND s.annee=\"$an\"
										 GROUP BY s.catotal DESC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");

while($val = mysql_fetch_array($requete3)) 	
		{
		$val[catotal] = str_replace(".",",",$val[catotal]); 
		echo "<tr><td width='20%'>$val[codeclient]</td>";
		echo "<td width='20%'><center>$val[nomclient]</center></td>";
		echo "<td width='20%'><div align='right'>$val[nuite]</div></td>";
		echo "<td width='20%'><div align='right'><b>$val[catotal] &euro;</b></div></td></tr>";
		}
echo "</table></center>";
// Destruction de la table temporaire
$requete4 = @mysql_db_query($nomdelabdd,"DROP TABLE tmp")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
@mysql_close();	
?>
</body>
</html>
<?
break;

case 6:

?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Listing de tous les Clients Tourisme par Pays</center></h3>
<br>
<center><input type="button" value="Impression du Listing" onClick="imprime()"></center>
<br>
<?php
$nomdelabdd="statistique";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es

// Selection en fonction du choix utilisateur
if ($indice == 'T')
{
$requete = @mysql_db_query($nomdelabdd,"SELECT s.*,SUM(catotal) AS catotal
					FROM statistique s,hotel h
					WHERE s.codetablis=h.codehotel
					AND s.codetablis='$hotel'
					AND s.annee='$an'
					AND s.codeclient BETWEEN '950000' AND '990000'
					AND s.catotal<>'0'
					GROUP BY s.codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
}
else
	{
	$requete = @mysql_db_query($nomdelabdd,"SELECT s.*,SUM(catotal) AS catotal
						FROM statistique s,hotel h
						WHERE s.codetablis=h.codehotel
						AND s.codetablis='$hotel'
						AND s.annee='$an'
						AND s.codeclient BETWEEN '800000' AND '949999'
						AND s.catotal<>'0'
						GROUP BY s.codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
	}
@mysql_close(); 

$compte = mysql_numrows($requete); 
echo "Il y a un total de <b>$compte</b> r&eacute;sultats.";

$nomdelabdd="commercial";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es
echo "<center><table width='90%' border='1'>
  <tr> 
   <td bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Pays<center></b></div>
  </td>    
   <td bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Code Client<center></b></div>
  </td>    
 <td bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nom Client<center></b></div>
  </td>    
 <td bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA r&eacute;alis&eacute; en $annee<center></b></div>
  </td>    
  </tr>";

while($valeur = mysql_fetch_array($requete)) 	
{
$req_sel_pays = @mysql_db_query($nomdelabdd,"SELECT c.*,p.*
					FROM client c,pays p
					WHERE c.codeclient=\"$valeur[codeclient]\"
					AND c.etat <> 0
					AND c.idpays=p.idpays
					ORDER BY p.nompays ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
  while($val_sel = mysql_fetch_array($req_sel_pays)) 	
	{	
	echo "<tr><td><b>$val_sel[nompays]</b></td>";
	echo "<td><center>$val_sel[codeclient]</center></td>";
	echo "<td><center>$val_sel[nomclient]</center></td>";
	$total = $total + $valeur[catotal];
	$valeur[catotal] = str_replace(".",",",$valeur[catotal]);
	echo "<td><div align='right'>$valeur[catotal] &euro;</div></td>";
	echo "</tr>";
	$total = str_replace(".",",",$total);
	}
}
	echo "<tr><td><center><i>TOTAL</i></center></td>";
	echo "<td></td>";
	echo "<td></td>";
	echo "<td><div align='right'><b>$total &euro;</b></div></td></tr>";
	echo "</table>";
	echo "</tr>";
echo "</table></center>";
@mysql_close();	
?>
</body>
</html>
<?
break;

case 7:

?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Destinations pr&eacute;f&eacute;r&eacute;es des Clients pour l'ann&eacute;e <? echo "$an"; ?></center></h3>
<br>
<center><input type="button" value="Impression des Destinations Pr&eacute;f&eacute;r&eacute;es" onClick="imprime()"></center>
<br>
<center><table width='80%' border='1'>
  <tr> 
  <td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Pays<center></b></div>
  </td>    
  <td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>H&#244;tel<center></b></div>
  </td>     
  <td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA <? echo "$an"; ?><center></b></div>
  </td>     
  </tr>
  <tr>
<?php
$nomdelabdd="statistique";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es
// Selection en fonction du choix utilisateur
if ($indice == 'T')
{
$requete = @mysql_db_query($nomdelabdd,"SELECT s.codeclient,s.catotal,h.nomhotel,s.codetablis
										FROM statistique s,hotel h 
										WHERE s.codetablis=h.codehotel
										AND s.annee='$an'
										AND s.codeclient BETWEEN '950000' AND '990000'
										AND catotal<>'0'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
}
else
	{
	$requete = @mysql_db_query($nomdelabdd,"SELECT s.codeclient,SUM(catotal) AS catotal,h.nomhotel,s.codetablis
											FROM statistique s,hotel h 
											WHERE s.codetablis=h.codehotel
											AND s.annee='$an'
											AND s.codeclient BETWEEN '800000' AND '949999'
											AND catotal<>'0'
											GROUP BY s.codetablis,s.codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
	}
@mysql_close(); 

$nomdelabdd="commercial";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es

$requete1 = @mysql_db_query($nomdelabdd,"CREATE TEMPORARY TABLE tmp (
										 idtemp int not null auto_increment,
										 codeclient varchar(6),
										 nomhotel varchar(50),
										 codetablis varchar(5),
										 catotal varchar(10),
										 PRIMARY KEY   (idtemp),
										 UNIQUE idtemp (idtemp))")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Insertion des donn&eacute;es de la base commercial pour comparaison avec la base statistique
while($contenu = mysql_fetch_array($requete)) 								
{
$requete2 = @mysql_db_query($nomdelabdd,"INSERT INTO tmp (codeclient,nomhotel,codetablis,catotal)
										 VALUES (\"$contenu[codeclient]\",			
												 \"$contenu[nomhotel]\",
												 \"$contenu[codetablis]\",
												 \"$contenu[catotal]\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}
// Selection dans la table commercial
$requete3 = @mysql_db_query($nomdelabdd,"SELECT SUM(catotal) AS catotal,t.nomhotel,p.nompays,t.codeclient
										 FROM client c,tmp t,pays p
										 WHERE c.codeclient=t.codeclient
										 AND c.idpays=p.idpays
										 AND c.etat <> 0
										 GROUP BY t.codetablis,p.nompays
										 ORDER BY p.nompays ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$compteur = mysql_numrows($requete3); 
while($val = mysql_fetch_array($requete3)) 	
		{
		$total = $total + $val[catotal];
		$total = str_replace(".",",",$total);
		$val[catotal] = str_replace(".",",",$val[catotal]);
		echo "<td><b>$val[nompays]</b></td>";
		echo "<td><center>$val[nomhotel]</center></td>";
		echo "<td><div align='right'><b>$val[catotal] &euro;</b></div></td></tr>";
		}
echo "<tr><td><center><i>TOTAL</i></center></td>";
echo "<td></td>";
echo "<td><div align='right'><b>$total &euro;</b></div></td></tr>";
echo "</table>";
if ($compteur <> 0)
{
echo "<br><br><b>La recherche a donn&eacute; $compteur r&eacute;sultats.</b>";
}
else
	{
	echo "<br><br><b>La recherche n'a pas donn&eacute; de r&eacute;sultats.</b>";
	}
echo "</center>";
// Destruction de la table temporaire
$requete4 = @mysql_db_query($nomdelabdd,"DROP TABLE tmp")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
@mysql_close();	
?>
</body>
</html>
<?
break;

case 8:
?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Les nouveaux Clients pour l'ann&eacute;e <? echo "$an"; ?></center></h3>
<br>
<center><input type="button" value="Impression des nouveaux Clients" onClick="imprime()"></center>
<br>
<table width='100%' border='1'>
<tr> 
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Code du Client<center></b></div>
  </td>    
 <td width='15%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nom du Client<center></b></div>
  </td> 
  <td width='15%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Adresse<center></b></div>
  </td>    
  <td width='15%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Code Postal<center></b></div>
  </td>    
  <td width='15%' bgcolor='#FFFF9B' class='news'>  
     <div align='center'><b>Ville<center></b></div>
  </td>    
  <td width='15%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Pays<center></b></div>
  </td>   
  <td width='15%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>T&eacute;l&eacute;phone<center></b></div>
  </td>    
  </tr>
<?php
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
$nomdelabdd="commercial";       										// le nom de la Base de donn&eacute;es 
@mysql_select_db($nomdelabdd,$bdd);   			
$requete = @mysql_query("SELECT c.*,p.nompays,v.nomville
						 FROM client c,pays p,ville v
						 WHERE c.idpays=p.idpays
						 AND c.idville=v.idville
						 AND c.dateclient LIKE '%$an%'
						 AND c.indiceclient=\"$indice\"
						 AND c.etat <> 0
						 ORDER BY c.nomclient ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
$compteur = mysql_numrows($requete); 
@mysql_close(); 
while ($val = mysql_fetch_array($requete))
		{
		echo "<tr><td>$val[codeclient]</td>";
		echo "<td><center>$val[nomclient]</center></td>";
		echo "<td><center>$val[adresseclient]</center></td>";
		echo "<td><center>$val[cpclient]</center></td>";
		echo "<td><center>$val[nomville]</center></td>";
		if ($val['nompays'] == "Non renseigne")
			{
			echo "<td></td>";
			}
			else
				{
				echo "<td><center>$val[nompays]</center></td>";
				}				
		echo "<td><center>$val[telclient]</center></td></tr>";
		}
echo "</table>";
if ($compteur <> 0)
{
echo "<br><br><b>La recherche a donn&eacute; $compteur Clients.</b>";
}
else
	{
	echo "<br><br><b>La recherche n'a pas donn&eacute; de r&eacute;sultats.</b>";
	}
?>
</body>
</html>
<?
break;

case 9 :

// On assigne au mois la variable $option
$mois = $option;   
$annee  = $an;
$anmoinun = $an - 1;     
$anmoindeu = $an - 2;
?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Statistiques par Client, nbre Nuit&eacute; et CA Total pour le mois</center></h3>
<br>
<center><input type="button" value="Impression des Statistiques" onClick="imprime()"></center>
<br>
<center>
<table width='100%' border='1'>
  <tr> 
  <td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Soci&eacute;t&eacute;s<center></b></div>
  </td>    
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>No de Soci&eacute;t&eacute;<center></b></div>
  </td>     
   <td width='7%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nuit&eacute;es <? echo "$mois/$annee"; ?><center></b></div>
  </td>   
   <td width='7%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nuit&eacute;es <? echo "$mois/$anmoinun"; ?><center></b></div>
  </td>     
 <td width='7%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nuit&eacute;es <? echo "$mois/$anmoindeu"; ?><center></b></div>
  </td>   
  <td width='7%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Variations Nuit&eacute;es <? echo "$anmoinun/$annee"; ?><center></b></div>
  </td>     
  <td width='7%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Variations Nuit&eacute;es <? echo "$anmoindeu/$annee"; ?><center></b></div>
  </td> 
  <td width='7%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA <? echo "$mois/$annee"; ?><center></b></div>
  </td>     
  <td width='7%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA <? echo "$mois/$anmoinun"; ?><center></b></div>
  </td>     
  <td width='7%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA <? echo "$mois/$anmoindeu"; ?><center></b></div>
  </td>       
  <td width='7%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Variations CA <? echo "$anmoinun/$annee"; ?><center></b></div>
  </td>    
  <td width='7%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Variations CA <? echo "$anmoindeu/$annee"; ?><center></b></div>
  </td>   
  </tr>
<?php
$nomdelabdd="authentique";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es$req_user = @mysql_db_query($nomdelabdd,"SELECT * FROM utilisateur WHERE idutil='$log'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
$user = mysql_fetch_array($req_user);
if ($user < 4) 
{
$user[nummin] = '800000';
$user[nummax] = '949999';
}
@mysql_close();

$nomdelabdd="statistique";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es

// Selection en fonction du choix utilisateur
if ($indice == 'T')
{
	// Cas ou l'utilisateur peut voir tous les hotels
	if ($sofibra_avec == 1)
	{
	$req_sel_bis = @mysql_db_query($nomdelabdd,"SELECT s.annee,s.mois,s.codeclient,s.nomclient,s.catotal,s.nuite
											FROM statistique s
											WHERE mois=$mois
											AND s.codeclient BETWEEN '950000' AND '990000'
											ORDER BY s.nomclient,s.annee")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	
	}
	else
		// Cas ou on affiche en fonction de l'hotel
		{
		$tab = explode(",",$sofibra_sel);
	 		// Nombre dhotel pour un utilisateur
	 		$taille = sizeof($tab);	 	
			for ($boucle=0;$boucle < $taille;$boucle++)
					{
					$tableau[$boucle]="'$tab[$boucle]'";
					}
		$tableau = implode(",",$tableau);
		$req_sel_bis = @mysql_db_query($nomdelabdd,"SELECT s.annee,s.mois,s.codeclient,s.nomclient,s.catotal,s.nuite
											FROM statistique s
											WHERE mois=$mois
											AND s.codeclient BETWEEN '950000' AND '990000'
											AND s.codetablis IN ($tableau)
											ORDER BY s.nomclient,s.annee")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	
		}
}
else
	{
	// Cas ou l'utilisateur peut voir tous les hotels
	if ($sofibra_avec == 1)
		{
		$req_sel_bis = @mysql_db_query($nomdelabdd,"SELECT s.annee,s.mois,s.codeclient,s.nomclient,s.catotal,s.nuite
												FROM statistique s
												WHERE mois=$mois
												AND s.codeclient BETWEEN '$user[nummin]' AND '$user[nummax]'
												ORDER BY s.nomclient,s.annee")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	
		}
		else
			// Cas ou on affiche en fonction de l'hotel
			{
	 		$tab = explode(",",$sofibra_sel);
	 		// Nombre dhotel pour un utilisateur
	 		$taille = sizeof($tab);	 	
			for ($boucle=0;$boucle < $taille;$boucle++)
					{
					$tableau[$boucle]="'$tab[$boucle]'";
					}
			$tableau = implode(",",$tableau);
			$req_sel_bis = @mysql_db_query($nomdelabdd,"SELECT s.annee,s.mois,s.codeclient,s.nomclient,s.catotal,s.nuite
												FROM statistique s
												WHERE mois=$mois
												AND s.codeclient BETWEEN '$user[nummin]' AND '$user[nummax]'
												OR s.codetablis IN ($tableau)
												ORDER BY s.nomclient,s.annee")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	
			}
	}
$req_cree = @mysql_db_query($nomdelabdd,"CREATE TEMPORARY TABLE tmp (
										 idtemp         int not null auto_increment,
										 codeclient     varchar(6),
										 nomclient      varchar(100),
										 catotal        varchar(10),
										 nuite          varchar(10),
										 annee          int(4),
										 mois 			int(2),
										 PRIMARY KEY   (idtemp),
										 UNIQUE idtemp (idtemp))")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");

while($contenu = mysql_fetch_array($req_sel_bis)) 								
{
$contenu[nomclient] = addslashes($contenu[nomclient]);
$req_insert1 = @mysql_db_query($nomdelabdd,"INSERT INTO tmp (codeclient,nomclient,catotal,nuite,annee,mois)
										    VALUES (\"$contenu[codeclient]\",			
												    \"$contenu[nomclient]\",
												    \"$contenu[catotal]\",
												    \"$contenu[nuite]\",
												    \"$contenu[annee]\",												   
												    \"$contenu[mois]\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}

$req_sel_1 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(catotal) AS catotal,SUM(nuite) AS nuite
										  FROM tmp
										  WHERE annee=$annee
										  AND mois=$mois
										  GROUP BY codeclient
										  ORDER BY nomclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
$compteur = mysql_numrows($req_sel_1); 
echo "Affichage de <b>$compteur</b> r&eacute;sultats.<br><br>";

while($val = mysql_fetch_array($req_sel_1)) 								
{
		$req_sel7 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(catotal) AS catotal,SUM(nuite) AS nuite
										 		 FROM tmp
										 		 WHERE codeclient=\"$val[codeclient]\"
												 AND annee=$anmoinun
												 AND mois=$mois
												 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
		$valmoinun = mysql_fetch_array($req_sel7);
		$req_sel8 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(catotal) AS catotal,SUM(nuite) AS nuite
										 		 FROM tmp
										 		 WHERE codeclient=\"$val[codeclient]\"
												 AND annee=$anmoindeu
												 AND mois=$mois
												 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
		$valmoindeu = mysql_fetch_array($req_sel8);
		
		// Arrondi a la virgule pres
		$val[catotal] = round($val[catotal]);
		$valmoinun[catotal] = round($valmoinun[catotal]);
		$valmoindeu[catotal] = round($valmoindeu[catotal]);
		// Calcul des variations
		$nuiteun = $val[nuite]- $valmoinun[nuite];
		$nuitedeu = $val[nuite]- $valmoindeu[nuite];
		$catotalun = $val[catotal]- $valmoinun[catotal];
		$catotaldeu = $val[catotal]- $valmoindeu[catotal];
		// Calcul des totaux
		$total1 = $total1 + $val[nuite];
		$total2 = $total2 + $valmoinun[nuite];
		$total3 = $total3 + $valmoindeu[nuite];		
		$total4 = $total4 + $nuiteun;
		$total5 = $total5 + $nuitedeu;		
		$total6 = $total6 + $val[catotal];
		$total7 = $total7 + $valmoinun[catotal];
		$total8 = $total8 + $valmoindeu[catotal];
		$total9 = $total9 + $catotalun;
		$total10 = $total10 + $catotaldeu;
		
		if ($sofibra_sel <> NULL)
		{ echo "<tr><td class=menu>$val[nomclient]</td>"; }
		else
		{ echo "<tr class='news'><td><a class='menu' href='resultat.php?requete=17&code=$val[codeclient]&annee=$annee&mois=$mois'>$val[nomclient]</a></td>"; }
		echo "<td><center><b>$val[codeclient]</b></center></td>";
		echo "<td><center>$val[nuite]</center></td>";		
		echo "<td><center>$valmoinun[nuite]</center></td>";
		echo "<td><center>$valmoindeu[nuite]</center></td>";
		echo "<td><div align='right'><b>$nuiteun</b></div></td>";	
		echo "<td><div align='right'><b>$nuitedeu</b></div></td>";		
		echo "<td><center>$val[catotal] &euro;</center></td>";
		echo "<td><center>$valmoinun[catotal] &euro;</center></td>";		
		echo "<td><center>$valmoindeu[catotal] &euro;</center></td>";		
		echo "<td><div align='right'><b>$catotalun &euro;</b></div></td>";
		echo "<td><div align='right'><b>$catotaldeu &euro;</b></div></td></tr>";		
}

echo "<tr class='anotation'><td><center><i>TOTAL</i></center></td>";
echo "<td></td>";
echo "<td><div align='right'><b>$total1</b></div></td>";
echo "<td><div align='right'><b>$total2</b></div></td>";
echo "<td><div align='right'><b>$total3</b></div></td>";
echo "<td><div align='right'><b>$total4</b></div></td>";
echo "<td><div align='right'><b>$total5</b></div></td>";
echo "<td><div align='right'><b>$total6 &euro;</b></div></td>";
echo "<td><div align='right'><b>$total7 &euro;</b></div></td>";
echo "<td><div align='right'><b>$total8 &euro;</b></div></td>";
echo "<td><div align='right'><b>$total9 &euro;</b></div></td>";
echo "<td><div align='right'><b>$total10 &euro;</b></div></td></tr>";
echo "</table></center><br><br>";

// Destruction de la table temporaire
$req_del1 = @mysql_db_query($nomdelabdd,"DROP TABLE tmp")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
@mysql_close();	
?>
<center>
</body>
</html>
<?
break;

case 10:

$annee  = date("Y");
?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Liste des Clients Fid&egrave;les depuis 2003</center></h3>
<br>
<center><input type="button" value="Impression des Clients Fid&egrave;les" onClick="imprime()"></center>
<br>
<center><table width='80%' border='1'>
  <tr> 
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Code Client<center></b></div>
  </td>    
  <td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nom Client<center></b></div>
  </td>     
  <td width='30%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Adresse Client<center></b></div>
  </td>     
   <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b><center>Nuit&eacute;es</b></div>
  </td>    
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b><center>CA Total</b></div>
  </td>    
  </tr>
  <tr>
<?php
$nomdelabdd="statistique";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es
// Selection en fonction du choix utilisateur
if ($indice == 'T')
{
$requete = @mysql_db_query($nomdelabdd,"SELECT SUM(catotal) AS catotal,SUM(nuite) AS nuite,codeclient
										FROM statistique
										WHERE annee BETWEEN 2003 AND $annee
										AND catotal <> 0
										AND codeclient BETWEEN '950000' AND '990000'
										GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
}
else
	{
	$requete = @mysql_db_query($nomdelabdd,"SELECT SUM(catotal) AS catotal,SUM(nuite) AS nuite,codeclient
		  									FROM statistique
		  									WHERE annee BETWEEN 2003 AND $annee
											AND catotal <> 0
											AND codeclient BETWEEN '800000' AND '949999'
											GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
	}
@mysql_close(); 

$nomdelabdd="commercial";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es
$requete1 = @mysql_db_query($nomdelabdd,"CREATE TEMPORARY TABLE tmp (
										 idtemp int not null auto_increment,
										 codeclient varchar(6),
										 nuite varchar(10),
										 catotal varchar(10),
										 PRIMARY KEY   (idtemp),
										 UNIQUE idtemp (idtemp))")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Insertion des donn&eacute;es de la base commercial pour comparaison avec la base statistique
while($contenu = mysql_fetch_array($requete)) 								
{
$requete2 = @mysql_db_query($nomdelabdd,"INSERT INTO tmp (codeclient,nuite,catotal)
										 VALUES (\"$contenu[codeclient]\",
												 \"$contenu[nuite]\",				
												 \"$contenu[catotal]\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}
$requete3 = @mysql_db_query($nomdelabdd,"SELECT c.nomclient,c.adresseclient,t.nuite,t.catotal,t.codeclient
										 FROM client c,tmp t
										 WHERE c.codeclient=t.codeclient
										 AND c.etat <> 0
										 GROUP BY c.codeclient
										 ORDER BY c.nomclient ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
while($val = mysql_fetch_array($requete3)) 	
		{
		$val[catotal] = str_replace(".",",",$val[catotal]);
		echo "<td width='10%'>$val[codeclient]</td>";
		echo "<td width='20%'><center><b><a class='menu' href='statclient.php?ok=3&codeclient=$val[codeclient]'>$val[nomclient]</a></b></center></td>";		
		echo "<td width='30%'>$val[adresseclient]</div></td>";
		echo "<td width='10%'><div align='right'>$val[nuite]</div></td>";	
		echo "<td width='10%'><div align='right'>$val[catotal]</div></td></tr>";	
		}
echo "</table></center>";
// Destruction de la table temporaire
$requete4 = @mysql_db_query($nomdelabdd,"DROP TABLE tmp")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
@mysql_close();	
?>
</body>
</html>
<?
break;

case 11:

?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Liste des Soci&eacute;t&eacute;s et Contacts pr&eacute;sents sur <? echo "$salon"; ?></center></h3>
<br>
<center><input type="button" value="Impression de la liste des Clients et Contacts" onClick="imprime()"></center>
<br>
<table width='100%' border='1'>
<tr> 
 <td width='5%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Date</b></div>
  </td>    
  <td width='5%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Lieu</b></div>
  </td>     
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nom Client</b></div>
  </td> 
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Titre Contact</b></div>
  </td>   
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b><center>Nom Contact</b></div>
  </td>    
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Pr&eacute;nom Contact</b></div>
  </td> 
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Adresse Client</b></div>
  </td> 
  <td width='5%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CP Client</b></div>
  </td> 
  <td width='5%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Ville Client</b></div>
  </td> 
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Pays Client</b></div>
  </td> 
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>T&eacute;l&eacute;phone</b></div>
  </td>   
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>E-mail</b></div>
  </td> 
  </tr>
  <tr>
<?php
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
$nomdelabdd="commercial";       										// le nom de la Base de donn&eacute;es 
@mysql_select_db($nomdelabdd,$bdd);   			
$requete = @mysql_query("SELECT c.idcontact,v.datesuivi,v.lieusuivi,c.nomcontact,c.prenomcontact,i.siglecivil,c.telcontact,c.mailcontact
						 FROM suivi v,liensuivi l,contact c,civil i
						 WHERE v.idsuivi=l.idsuivi
						 AND c.idcontact=l.idcontact
						 AND c.idcivil=i.idcivil
						 AND v.lieusuivi LIKE '$salon%'
						 ORDER BY v.datesuivi DESC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								

while ($val = mysql_fetch_array($requete))
		{
		$requete1 = @mysql_query("SELECT c.nomclient,c.telclient,c.mailclient,c.adresseclient,c.cpclient,v.nomville,p.nompays
						 		  FROM client c,liencontact l,ville v,pays p
						 		  WHERE l.idcontact='$val[idcontact]'
								  AND c.idville=v.idville
								  AND c.idpays=p.idpays
								  AND c.etat <> 0
						 		  AND c.codeclient=l.idclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
		$contenu = mysql_fetch_array($requete1);
		$date=transformfrench_date($val['datesuivi']);
		// Remplacement des retours a la ligne \n par des <br> 
		$texte = $contenu['adresseclient']; 
		$texte = nl2br($texte);	 
		echo "<td>$date</td>";
		echo "<td><b>$val[lieusuivi]</b></td>";
		echo "<td>$contenu[nomclient]</td>";	
		echo "<td>$val[siglecivil]</td>";		
		echo "<td>$val[nomcontact]</td>";
		echo "<td>$val[prenomcontact]</td>";
		echo "<td>$texte</td>";
		echo "<td>$contenu[cpclient]</td>";
		echo "<td>$contenu[nomville]</td>";
		echo "<td>$contenu[nompays]</td>";
		if ($val['telcontact'] <> NULL){echo "<td>$val[telcontact]</td>";}
		else {echo "<td>$contenu[telclient]</td>";}
		if ($val['mailcontact'] <> NULL){echo "<td>$val[mailcontact]</td></tr>";}
		else {echo "<td>$contenu[mailclient]</td></tr>";}
		}
echo "</table>";
@mysql_close(); 
?>
</body>
</html>
<?php
break;

case 12:

$nomdelabdd="authentique";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es
$req = @mysql_query("SELECT * 
					 FROM utilisateur
					 WHERE siglerce=\"$rce\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								

$va = mysql_fetch_array($req);
@mysql_close();
?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Relances de <? echo "$va[prenom] $va[nom]"; ?> pour le <? echo "$dateap"; ?> jusqu'au <? echo "$datedp"; ?></center></h3>
<br>
<center><input type="button" value="Impression des Relances" onClick="imprime()"></center>
<br>
<?php
$nomdelabdd="commercial";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es
@$datej = transformmysql_date($dateap);
@$datef = transformmysql_date($datedp);
$requete = @mysql_query("SELECT c.idcontact,s.datesuivi,s.lieusuivi,s.contenusuivi,s.resumesuivi,s.futursuivi,t.nomtypsuivi,c.nomcontact,i.siglecivil,c.telcontact
			FROM suivi s,contact c,liensuivi l,typsuivi t,civil i
			WHERE s.idsuivi=l.idsuivi
			AND c.idcontact=l.idcontact 
			AND c.idcivil=i.idcivil
			AND s.idtypsuivi=t.idtypsuivi
			AND s.idrce='$rce'
			AND s.futursuivi <= '$datef' 
			AND s.futursuivi >= '$datej'
			GROUP BY c.idcontact")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								

while ($val = mysql_fetch_array($requete))
{
$requete1 = @mysql_query("SELECT c.nomclient
			FROM client c,liencontact l
			WHERE l.idcontact='$val[idcontact]'
			AND c.etat <> 0
			AND l.idclient=c.codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
$contenu = mysql_fetch_array($requete1);
$val['datesuivi'] = transformfrench_date($val['datesuivi']);
$val['futursuivi'] = transformfrench_date($val['futursuivi']);

echo "<div class='anotation'>Pour le $val[futursuivi] avec le Client <b>$contenu[nomclient]</b>.</div>";
echo " <blockquote><li>Dernier Contact le $val[datesuivi] 
avec <a class='menu' href=\"suivicontact.php?ok=Modif&code=$contenu[codeclient]&codecontact=$val[idcontact]\">$val[siglecivil] $val[nomcontact]</a>. R&eacute;sum&eacute; : $val[resumesuivi]
<br>
T&eacute;l&eacute;phone : $val[telcontact]
</blockquote>";
}
@mysql_close();
?>
</body>
</html>
<?php
break;

case 13:

$annee = date("Y");
$mois = date("m");
$anmoin = $annee - 1;
?>
<center><input type="button" value="Impression des Clients" onClick="imprime()"></center>
<br>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<div class='titre'><center>Les Clients...</center></div>
<center>
<table width='80%' border='1'>
<tr> 
	<td width='10%' bgcolor='#FFFF9B' class='news'> 
    <div align='center'><b>Code Postal<center></b></div>
  	</td>    
	<td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Code du Client<center></b></div>
  	</td>    
 	<td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nom du Client<center></b></div>
  	</td> 
  	<td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nuit&eacute;es<center></b></div>
  	</td>    
  	<td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA Total<center></b></div>
 	</td>   
  	</tr>
    <tr>
<?php
$nomdelabdd="commercial";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es

if ($indice == 'T')
{
$requete = @mysql_query("SELECT *
			FROM client
			WHERE codeclient BETWEEN '950000' AND '990000'
			AND etat <> 0
			AND cpclient LIKE '$cp%'
			GROUP BY codeclient ")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
}
else
	{
	$requete = @mysql_query("SELECT *
				FROM client
				WHERE codeclient BETWEEN '800000' AND '949999'
				AND etat <> 0
				AND cpclient LIKE '$cp%'
				GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
	}
@mysql_close(); 

$nomdelabdd="statistique";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es
// Initialisation des variables
if ( ! isset($compte)) $compte=NULL;

while ($valeur = mysql_fetch_array($requete))
	{
	$requete4 = @mysql_db_query($nomdelabdd,"SELECT SUM(catotal) AS catotal,SUM(nuite) AS nuite
						FROM statistique
						WHERE codeclient=\"$valeur[codeclient]\"
						AND annee BETWEEN $anmoin AND $annee
						AND catotal <> 0
						GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$contenu = mysql_fetch_array($requete4);
	if ($contenu['catotal'] <> NULL)
		{
		echo "<td width='10%'><b>$valeur[cpclient]</b></td>";
		echo "<td width='10%'><b>$valeur[codeclient]</b></td>";
		echo "<td width='20%'><center>$valeur[nomclient]<center></td>";
		echo "<td width='20%'><div align='right'>$contenu[nuite]</div></td>";
		echo "<td width='20%'><div align='right'><b>$contenu[catotal] &euro;</b></div></td>";
		echo "</tr>";
		$compte++;
		}
	}
echo "</table></center>";
echo "<br>Il y a un total de $compte r&eacute;sultats.";

@mysql_close(); 	
?>
</body>
</html>
<?
break;

case 14:
$anmoins = $an -1;
?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Le TOP 50 en <? echo "$an"; ?></center></h3>
<center><input type="button" value="Impression du TOP 50" onClick="imprime()">
<br><br>
<table width='80%' border='1'>
<tr> 
  <td width='15%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Place en <? echo "$an"; ?><center></b></div>
  </td>    
 <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Code du Client<center></b></div>
  </td> 
  <td width='40%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nom du Client<center></b></div>
  </td>    
  <td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA en <? echo "$an"; ?><center></b></div>
  </td>  
   <td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA en <? echo "$anmoins"; ?><center></b></div>
  </td> 
  </tr>
<?php
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
$nomdelabdd="statistique";       										// le nom de la Base de donn&eacute;es 
@mysql_select_db($nomdelabdd,$bdd);   			
// Selection en fonction du choix utilisateur
if ($indice == 'T')
{
$requete = @mysql_query("SELECT codeclient,nomclient,SUM(catotal) AS catotal
						 FROM statistique
						 WHERE annee='$an'
						 AND codeclient BETWEEN '950000' AND '990000'
						 GROUP BY codeclient 
						 ORDER BY catotal DESC
						 LIMIT 0,50")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}
else
	{
	$requete = @mysql_query("SELECT codeclient,nomclient,SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$an'
						 	 AND codeclient BETWEEN '800000' AND '949999'
						 	 GROUP BY codeclient 
						 	 ORDER BY catotal DESC
						 	 LIMIT 0,50")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
	}
$compte = 0;

while ($val = mysql_fetch_array($requete))
		{
		$requete1 = @mysql_query("SELECT codeclient,nomclient,SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$anmoins'
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$val1 = mysql_fetch_array($requete1); 					
		$val[catotal] = str_replace(".",",",$val[catotal]);
		$val1[catotal] = str_replace(".",",",$val1[catotal]);
		if ($val1[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		$compte =$compte + 1;
		echo "<tr>";
		echo "<td><div align='right'><b>$compte</b></div></td>";
		echo "<td><center>$val[codeclient]</center></td>";
		echo "<td>$val[nomclient]</td>";
		echo "<td><div align='right'>$val[catotal] &euro;</div></td>";		
		echo "<td><div align='right'>$val1[catotal] $euro</div></td>";	
		echo "</tr>";
		
		$requete11 = @mysql_query("SELECT SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$an'
						 	 AND mois=1
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$requete12 = @mysql_query("SELECT SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$anmoins'
						 	 AND mois=1
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$val11 = mysql_fetch_array($requete11); 					
		$val11[catotal] = str_replace(".",",",$val11[catotal]);
		$val12 = mysql_fetch_array($requete12); 					
		$val12[catotal] = str_replace(".",",",$val12[catotal]);
		if ($val11[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		if ($val12[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		echo "<tr>";
		echo "<td>Pour Janvier</div></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td><div align='right'>$val11[catotal] &euro;</div></td>";		
		echo "<td><div align='right'>$val12[catotal] $euro</div></td>";	
		echo "</tr>";

		$requete21 = @mysql_query("SELECT SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$an'
						 	 AND mois=2
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$requete22 = @mysql_query("SELECT SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$anmoins'
						 	 AND mois=2
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$val21 = mysql_fetch_array($requete21); 					
		$val21[catotal] = str_replace(".",",",$val21[catotal]);
		$val22 = mysql_fetch_array($requete22); 					
		$val22[catotal] = str_replace(".",",",$val22[catotal]);
		if ($val21[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		if ($val22[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		echo "<tr>";
		echo "<td>Pour F&eacute;vrier</div></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td><div align='right'>$val21[catotal] &euro;</div></td>";		
		echo "<td><div align='right'>$val22[catotal] $euro</div></td>";	
		echo "</tr>";

		$requete31 = @mysql_query("SELECT SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$an'
						 	 AND mois=3
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$requete32 = @mysql_query("SELECT SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$anmoins'
						 	 AND mois=3
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$val31 = mysql_fetch_array($requete31); 					
		$val31[catotal] = str_replace(".",",",$val31[catotal]);
		$val32 = mysql_fetch_array($requete32); 					
		$val32[catotal] = str_replace(".",",",$val32[catotal]);
		if ($val31[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		if ($val32[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		echo "<tr>";
		echo "<td>Pour Mars</div></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td><div align='right'>$val31[catotal] &euro;</div></td>";		
		echo "<td><div align='right'>$val32[catotal] $euro</div></td>";	
		echo "</tr>";

		$requete41 = @mysql_query("SELECT SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$an'
						 	 AND mois=4
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$requete42 = @mysql_query("SELECT SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$anmoins'
						 	 AND mois=4
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$val41 = mysql_fetch_array($requete41); 					
		$val41[catotal] = str_replace(".",",",$val41[catotal]);
		$val42 = mysql_fetch_array($requete42); 					
		$val42[catotal] = str_replace(".",",",$val42[catotal]);
		if ($val41[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		if ($val42[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		echo "<tr>";
		echo "<td>Pour Avril</div></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td><div align='right'>$val41[catotal] &euro;</div></td>";		
		echo "<td><div align='right'>$val42[catotal] $euro</div></td>";	
		echo "</tr>";

		$requete51 = @mysql_query("SELECT SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$an'
						 	 AND mois=5
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$requete52 = @mysql_query("SELECT SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$anmoins'
						 	 AND mois=5
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$val51 = mysql_fetch_array($requete51); 					
		$val51[catotal] = str_replace(".",",",$val51[catotal]);
		$val52 = mysql_fetch_array($requete52); 					
		$val52[catotal] = str_replace(".",",",$val52[catotal]);
		if ($val51[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		if ($val52[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		echo "<tr>";
		echo "<td>Pour Mai</div></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td><div align='right'>$val51[catotal] &euro;</div></td>";		
		echo "<td><div align='right'>$val52[catotal] $euro</div></td>";	
		echo "</tr>";

		$requete61 = @mysql_query("SELECT SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$an'
						 	 AND mois=6
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$requete62 = @mysql_query("SELECT SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$anmoins'
						 	 AND mois=6
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$val61 = mysql_fetch_array($requete61); 					
		$val61[catotal] = str_replace(".",",",$val61[catotal]);
		$val62 = mysql_fetch_array($requete62); 					
		$val62[catotal] = str_replace(".",",",$val62[catotal]);
		if ($val61[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		if ($val62[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		echo "<tr>";
		echo "<td>Pour Juin</div></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td><div align='right'>$val61[catotal] &euro;</div></td>";		
		echo "<td><div align='right'>$val62[catotal] $euro</div></td>";	
		echo "</tr>";

		$requete71 = @mysql_query("SELECT SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$an'
						 	 AND mois=7
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$requete72 = @mysql_query("SELECT SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$anmoins'
						 	 AND mois=7
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$val71 = mysql_fetch_array($requete71); 					
		$val71[catotal] = str_replace(".",",",$val71[catotal]);
		$val72 = mysql_fetch_array($requete72); 					
		$val72[catotal] = str_replace(".",",",$val72[catotal]);
		if ($val71[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		if ($val72[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		echo "<tr>";
		echo "<td>Pour Juillet</div></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td><div align='right'>$val71[catotal] &euro;</div></td>";		
		echo "<td><div align='right'>$val72[catotal] $euro</div></td>";	
		echo "</tr>";

		$requete81 = @mysql_query("SELECT SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$an'
						 	 AND mois=8
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$requete82 = @mysql_query("SELECT SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$anmoins'
						 	 AND mois=8
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$val81 = mysql_fetch_array($requete81); 					
		$val81[catotal] = str_replace(".",",",$val81[catotal]);
		$val82 = mysql_fetch_array($requete82); 					
		$val82[catotal] = str_replace(".",",",$val82[catotal]);
		if ($val81[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		if ($val82[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		echo "<tr>";
		echo "<td>Pour Aout</div></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td><div align='right'>$val81[catotal] &euro;</div></td>";		
		echo "<td><div align='right'>$val82[catotal] $euro</div></td>";	
		echo "</tr>";

		$requete91 = @mysql_query("SELECT SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$an'
						 	 AND mois=9
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$requete92 = @mysql_query("SELECT SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$anmoins'
						 	 AND mois=9
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$val91 = mysql_fetch_array($requete91); 					
		$val91[catotal] = str_replace(".",",",$val91[catotal]);
		$val92 = mysql_fetch_array($requete92); 					
		$val92[catotal] = str_replace(".",",",$val92[catotal]);
		if ($val91[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		if ($val92[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		echo "<tr>";
		echo "<td>Pour Septembre</div></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td><div align='right'>$val91[catotal] &euro;</div></td>";		
		echo "<td><div align='right'>$val92[catotal] $euro</div></td>";	
		echo "</tr>";

		$requete101 = @mysql_query("SELECT SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$an'
						 	 AND mois=10
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$requete102 = @mysql_query("SELECT SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$anmoins'
						 	 AND mois=10
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$val101 = mysql_fetch_array($requete101); 					
		$val101[catotal] = str_replace(".",",",$val101[catotal]);
		$val102 = mysql_fetch_array($requete102); 					
		$val102[catotal] = str_replace(".",",",$val102[catotal]);
		if ($val101[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		if ($val102[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		echo "<tr>";
		echo "<td>Pour Octobre</div></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td><div align='right'>$val101[catotal] &euro;</div></td>";		
		echo "<td><div align='right'>$val102[catotal] $euro</div></td>";	
		echo "</tr>";

		$requete111 = @mysql_query("SELECT SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$an'
						 	 AND mois=11
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$requete112 = @mysql_query("SELECT SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$anmoins'
						 	 AND mois=11
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$val111 = mysql_fetch_array($requete111); 					
		$val111[catotal] = str_replace(".",",",$val111[catotal]);
		$val112 = mysql_fetch_array($requete112); 					
		$val112[catotal] = str_replace(".",",",$val112[catotal]);
		if ($val111[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		if ($val112[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		echo "<tr>";
		echo "<td>Pour Novembre</div></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td><div align='right'>$val111[catotal] &euro;</div></td>";		
		echo "<td><div align='right'>$val112[catotal] $euro</div></td>";	
		echo "</tr>";

		$requete121 = @mysql_query("SELECT SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$an'
						 	 AND mois=12
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$requete122 = @mysql_query("SELECT SUM(catotal) AS catotal
						 	 FROM statistique
						 	 WHERE annee='$anmoins'
						 	 AND mois=12
						 	 AND codeclient='$val[codeclient]'
						 	 GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$val121 = mysql_fetch_array($requete121); 					
		$val121[catotal] = str_replace(".",",",$val121[catotal]);
		$val122 = mysql_fetch_array($requete122); 					
		$val122[catotal] = str_replace(".",",",$val122[catotal]);
		if ($val121[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		if ($val122[catotal] == NULL) { $euro = ""; } else { $euro = "&euro;"; }
		echo "<tr>";
		echo "<td>Pour D&eacute;cembre</div></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td><div align='right'>$val121[catotal] &euro;</div></td>";		
		echo "<td><div align='right'>$val122[catotal] $euro</div></td>";	
		echo "</tr>";
		}
echo "</table>";
?>

<?php
@mysql_close(); 
?>
</center>
</body>
</html>
<?php
break;

case 15:

$nomdelabdd="authentique";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es
$req = @mysql_query("SELECT * 
					 FROM utilisateur
					 WHERE siglerce=\"$rce\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								

$va = mysql_fetch_array($req);
@mysql_close();
?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Rapport Hebdomadaire de <? echo "$va[prenom] $va[nom]"; ?> du <? echo "$dateap"; ?> au <? echo "$datedp"; ?></center></h3>
<br>
<center><input type="button" value="Impression du Rapport" onClick="imprime()"></center>
<br>
<?php
$nomdelabdd="commercial";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es

@$datej = transformmysql_date($dateap);
@$datef = transformmysql_date($datedp);
$requete = @mysql_query("SELECT c.idcontact,s.datesuivi,s.lieusuivi,s.contenusuivi,s.resumesuivi,s.futursuivi,t.nomtypsuivi,c.nomcontact,i.siglecivil
						 FROM suivi s,contact c,liensuivi l,typsuivi t,civil i
						 WHERE s.idsuivi=l.idsuivi
						 AND c.idcontact=l.idcontact 
						 AND c.idcivil=i.idcivil
						 AND s.idtypsuivi=t.idtypsuivi
						 AND s.idrce='$rce'
						 AND s.datesuivi <= '$datef' 
						 AND s.datesuivi >= '$datej'
						 ORDER BY s.datesuivi DESC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								

while ($val = mysql_fetch_array($requete))
{
$requete1 = @mysql_query("SELECT c.nomclient,c.codeclient
						  FROM client c,liencontact l
						  WHERE l.idcontact='$val[idcontact]'
						  AND c.etat <> 0
						  AND l.idclient=c.codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
$contenu = mysql_fetch_array($requete1);
$val['datesuivi'] = transformfrench_date($val['datesuivi']);
$val['futursuivi'] = transformfrench_date($val['futursuivi']);
// Modification pour les retour à la ligne
$texte = $val['contenusuivi']; 
$texte = nl2br($texte);	 
echo "Client : <a class='menu' href=\"suivicontact.php?ok=Modif&code=$contenu[codeclient]&codecontact=$val[idcontact]\">$contenu[nomclient]</a>";
echo "<blockquote>Le $val[datesuivi] &agrave; $val[lieusuivi] rencontre du Contact $val[siglecivil] $val[nomcontact].<br>
Type de Suivi: $val[nomtypsuivi], Resum&eacute; : $val[resumesuivi].<br>
<blockquote>$texte<br>Prochain suivi le : <b>$val[futursuivi]</b></blockquote></blockquote>";
}
@mysql_close();
?>
</body>
</html>
<?php
break;

case 16:

$annee = date("Y");
$anneemoins = $annee - 1;
$lemois = date("m");
?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Mailing
<?php
if ($type_client == 'C') { $nom_type_client = "Client"; }
else { $nom_type_client = "Prospect"; }
if ($option == 'cp'){echo "du Code Postal commençant par $opt pour un $nom_type_client.";} 
if ($option == 'ville'){echo "de la Ville contenant $opd pour un $nom_type_client.";}
if ($option == 'pays'){echo "du Pays contenant $opd pour un $nom_type_client.";}
if ($option == 'secteur'){echo "du Secteur Economique contenant $opd pour un $nom_type_client.";}
?>
</center></h3>
<br>
<center><input type="button" value="Impression du Mailing" onClick="imprime()"></center>
<br>
<table width="100%" border="1">
  <tr> 
    <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Nom Client</b></div>
    </td>
   <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Nom Contact</b></div>
    </td>
   <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Pr&eacute;nom Contact</b></div>
    </td>
   <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Adresse Contact</b></div>
    </td>
   <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>CP Contact</b></div>
    </td>
   <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Ville Contact</b></div>
    </td>
   <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>T&eacute;l Contact</b></div>
    </td>
   <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Fax Contact</b></div>
    </td>
   <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>E-mail Contact</b></div>
    </td>
    <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Circ</b></div>
    </td>
    <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>S&eacute;j</b></div>
    </td>
    <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Inc</b></div>
    </td>
    <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>SL</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Promo</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>FG</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>FW</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Scol</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Bal</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Sant</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Ling</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>VG</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Sport</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Reli</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Noel</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>St Sylv</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>TA</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Cult</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>HCS</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>HLS</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Resto</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>PdJ</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>LS</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>JE</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>S&eacute;mi</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>SE</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Pack</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Cocktail</b></div>
    </td>
  </tr>
<?php
if ($option == 'cp')
{
$nomdelabdd="statistique";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es

$requete = @mysql_db_query($nomdelabdd,"SELECT codeclient,SUM(catotal) AS catotal
		  			FROM statistique
		  			WHERE annee BETWEEN $anneemoins AND $annee
					GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close(); 	

$nomdelabdd="commercial";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es
$requete1 = @mysql_db_query($nomdelabdd,"CREATE TEMPORARY TABLE tmp (
					idtemp int    	not null auto_increment,
					codeclient    	varchar(10),
					idcontact			varchar(10),
					catotal				varchar(10),
					nomclient		varchar(100),
					nomcontact	varchar(100),
					prenomcontact	varchar(100),
					adressecontact	varchar(100),
					cpcontact				varchar(100),
					nomville				varchar(100),
					telcontact				varchar(100),
					faxcontact			varchar(100),
					mailcontact			varchar(100),
					PRIMARY KEY   	(idtemp),
					UNIQUE idtemp 	(idtemp))")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Cas ou pas tous les commerciaux
if ($rce <> "tous")
{
$requete2 = @mysql_query("SELECT c.*,v.nomville,i.siglecivil
			FROM suivi s,contact c,liensuivi l,civil i,ville v
			WHERE s.idsuivi=l.idsuivi
			AND c.idcontact=l.idcontact
			AND c.idcivil=i.idcivil
			AND c.idville=v.idville
			AND c.cpcontact LIKE '$opt%'
			AND s.idrce='$rce'
			GROUP BY c.idcontact")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
}
else
	{
	$requete2 = @mysql_query("SELECT c.*,v.nomville,i.siglecivil
			FROM suivi s,contact c,liensuivi l,civil i,ville v
			WHERE s.idsuivi=l.idsuivi
			AND c.idcontact=l.idcontact
			AND c.idcivil=i.idcivil
			AND c.idville=v.idville
			AND c.cpcontact LIKE '$opt%'
			GROUP BY c.idcontact")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
// Insertion pour compte du rce
while($contenu = mysql_fetch_array($requete2)) 								
{
$req = @mysql_query("SELECT c.nomclient,c.codeclient
		FROM client c,liencontact l
		WHERE l.idcontact='$contenu[idcontact]'
		AND c.etat <> 0
		AND l.idclient=c.codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
$val_req = mysql_fetch_array($req);

if ($val_req[nomclient] <> NULL)
	{
$req_insert = @mysql_db_query($nomdelabdd,"INSERT INTO tmp (
				codeclient,
				idcontact,
				nomclient,
				nomcontact,
				prenomcontact,
				adressecontact,
				cpcontact,
				nomville,
				telcontact,
				faxcontact,
				mailcontact) VALUES (
				\"$val_req[codeclient]\",
				\"$contenu[idcontact]\",
				\"$val_req[nomclient]\",
				\"$contenu[siglecivil] $contenu[nomcontact]\",
				\"$contenu[prenomcontact]\",
				\"$contenu[adressecontact]\",
				\"$contenu[cpcontact]\",
				\"$contenu[nomville]\",
				\"$contenu[telcontact]\",
				\"$contenu[faxcontact]\",
				\"$contenu[mailcontact]\")")or mysql_error();
				//\"$contenu[mailcontact]\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__."). mysql_error());
	}
}
// Modification du tmp pour les prospects et clients
while($contenu = mysql_fetch_array($requete)) 								
{
$req_update = @mysql_db_query($nomdelabdd,"UPDATE tmp SET
					catotal='$contenu[catotal]'
					WHERE codeclient='$contenu[codeclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");

}

$requete3 = @mysql_query("SELECT *
			FROM tmp
			ORDER BY nomclient ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								

$compteur = 0;
while($val = mysql_fetch_array($requete3)) 	
	{
	// Recherche dans les prod util
	$requete4 = @mysql_db_query($nomdelabdd,"SELECT *
		  	FROM produtil
		  	WHERE idcontact='$val[idcontact]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
	$val4 = mysql_fetch_array($requete4);
	// Recherche dans les interets
	$requete5 = @mysql_db_query($nomdelabdd,"SELECT *
		  	FROM prodsoc
		  	WHERE idcontact='$val[idcontact]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
	$val5 = mysql_fetch_array($requete5);
	
	if (($val[catotal] == NULL) && ($type_client == 'P'))
		{
	print "<tr><td class='anotation'><b>$val[nomclient]</b></td>";
	print "<td class='anotation'>$val[siglecivil] $val[nomcontact]</td>";
	print "<td class='anotation'><center>$val[prenomcontact]</center></td>";
	print "<td class='anotation'><center>$val[adressecontact]</center></td>";	
	print "<td class='anotation'><center>$val[cpcontact]</center></td>";
	print "<td class='anotation'><center>$val[nomville]</center></td>";
	print "<td class='anotation'><center>$val[telcontact]</center></td>";
	print "<td class='anotation'><center>$val[faxcontact]</center></td>";
	print "<td class='anotation'><center>$val[mailcontact]</center></td>";
	if ($val4[cirprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[sejprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[incprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[stoprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[promprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[golfprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[weekprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[scolprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[balnprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[santeprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[linprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[vinprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[sportprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[reliprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[noelprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[sylprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[tourprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[cultprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[hebcourtsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[heblongsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[restosoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[pdasoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[locsallesoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[jetudsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[semisoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[soiretapsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[packsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[coktaisoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	
	print "</tr>";
	$compteur++;
		}

	if (($val[catotal] <> NULL) && ($type_client == 'C'))
		{
	print "<tr><td class='anotation'><b>$val[nomclient]</b></td>";
	print "<td class='anotation'>$val[siglecivil] $val[nomcontact]</td>";
	print "<td class='anotation'><center>$val[prenomcontact]</center></td>";
	print "<td class='anotation'><center>$val[adressecontact]</center></td>";	
	print "<td class='anotation'><center>$val[cpcontact]</center></td>";
	print "<td class='anotation'><center>$val[nomville]</center></td>";
	print "<td class='anotation'><center>$val[telcontact]</center></td>";
	print "<td class='anotation'><center>$val[faxcontact]</center></td>";
	print "<td class='anotation'><center>$val[mailcontact]</center></td>";
	if ($val4[cirprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[sejprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[incprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[stoprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[promprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[golfprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[weekprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[scolprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[balnprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[santeprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[linprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[vinprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[sportprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[reliprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[noelprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[sylprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[tourprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[cultprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[hebcourtsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[heblongsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[restosoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[pdasoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[locsallesoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[jetudsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[semisoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[soiretapsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[packsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[coktaisoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	
	print "</tr>";
	$compteur++;
		}
	
	}	
echo "Il y a $compteur r&eacute;sultats.";

// Destruction de la table temporaire
$requete7 = @mysql_db_query($nomdelabdd,"DROP TABLE tmp")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
@mysql_close();
echo "</table>";
}

if ($option == 'ville')
{
$nomdelabdd="statistique";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es

$requete = @mysql_db_query($nomdelabdd,"SELECT codeclient,SUM(catotal) AS catotal
		  			FROM statistique
		  			WHERE annee BETWEEN $anneemoins AND $annee
					GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close(); 	

$nomdelabdd="commercial";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es
$requete1 = @mysql_db_query($nomdelabdd,"CREATE TEMPORARY TABLE tmp (
					idtemp int    	not null auto_increment,
					codeclient    	varchar(10),
					idcontact	varchar(10),
					catotal		varchar(10),
					nomclient	varchar(100),
					nomcontact	varchar(100),
					prenomcontact	varchar(100),
					adressecontact	varchar(100),
					cpcontact	varchar(100),
					nomville	varchar(100),
					telcontact	varchar(100),
					faxcontact	varchar(100),
					mailcontact	varchar(100),
					PRIMARY KEY   	(idtemp),
					UNIQUE idtemp 	(idtemp))")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Cas ou pas tous les commerciaux
if ($rce <> "tous")
{
$requete2 = @mysql_query("SELECT c.*,i.siglecivil,v.nomville
			FROM suivi s,contact c,liensuivi l,civil i,ville v
			WHERE s.idsuivi=l.idsuivi
			AND c.idcontact=l.idcontact
			AND c.idville=v.idville
			AND c.idcivil=i.idcivil
			AND s.idrce='$rce'
			AND v.nomville LIKE '%$opd%'
			GROUP BY c.idcontact")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
}
else
	{
	$requete2 = @mysql_query("SELECT c.*,i.siglecivil,v.nomville
			FROM suivi s,contact c,liensuivi l,civil i,ville v
			WHERE s.idsuivi=l.idsuivi
			AND c.idcontact=l.idcontact
			AND c.idville=v.idville
			AND c.idcivil=i.idcivil
			AND v.nomville LIKE '%$opd%'
			GROUP BY c.idcontact")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
// Insertion pour compte du rce
while($contenu = mysql_fetch_array($requete2)) 								
{
$req = @mysql_query("SELECT c.nomclient,c.codeclient
		FROM client c,liencontact l, ville v
		WHERE l.idcontact='$contenu[idcontact]'
		AND c.idville=v.idville
		AND c.etat <> 0
		AND l.idclient=c.codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
$val_req = mysql_fetch_array($req);

if ($val_req[nomclient] <> NULL)
	{
$req_insert = @mysql_db_query($nomdelabdd,"INSERT INTO tmp (
				codeclient,
				idcontact,
				nomclient,
				nomcontact,
				prenomcontact,
				adressecontact,
				cpcontact,
				nomville,
				telcontact,
				faxcontact,
				mailcontact) VALUES (
				\"$val_req[codeclient]\",
				\"$contenu[idcontact]\",
				\"$val_req[nomclient]\",
				\"$contenu[siglecivil] $contenu[nomcontact]\",
				\"$contenu[prenomcontact]\",
				\"$contenu[adressecontact]\",
				\"$contenu[cpcontact]\",
				\"$contenu[nomville]\",
				\"$contenu[telcontact]\",
				\"$contenu[faxcontact]\",
				\"$contenu[mailcontact]\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
}
// Modification du tmp pour les prospects et clients
while($contenu = mysql_fetch_array($requete)) 								
{
$req_update = @mysql_db_query($nomdelabdd,"UPDATE tmp SET
					catotal='$contenu[catotal]'
					WHERE codeclient='$contenu[codeclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");

}

$requete3 = @mysql_query("SELECT *
			FROM tmp
			ORDER BY nomclient ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								

$compteur = 0;
while($val = mysql_fetch_array($requete3)) 	
	{
	// Recherche dans les prod util
	$requete4 = @mysql_db_query($nomdelabdd,"SELECT *
		  	FROM produtil
		  	WHERE idcontact='$val[idcontact]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
	$val4 = mysql_fetch_array($requete4);
	// Recherche dans les interets
	$requete5 = @mysql_db_query($nomdelabdd,"SELECT *
		  	FROM prodsoc
		  	WHERE idcontact='$val[idcontact]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
	$val5 = mysql_fetch_array($requete5);
	
	if (($val[catotal] == NULL) && ($type_client == 'P'))
		{
	print "<tr><td class='anotation'><b>$val[nomclient]</b></td>";
	print "<td class='anotation'>$val[siglecivil] $val[nomcontact]</td>";
	print "<td class='anotation'><center>$val[prenomcontact]</center></td>";
	print "<td class='anotation'><center>$val[adressecontact]</center></td>";	
	print "<td class='anotation'><center>$val[cpcontact]</center></td>";
	print "<td class='anotation'><center>$val[nomville]</center></td>";
	print "<td class='anotation'><center>$val[telcontact]</center></td>";
	print "<td class='anotation'><center>$val[faxcontact]</center></td>";
	print "<td class='anotation'><center>$val[mailcontact]</center></td>";
	if ($val4[cirprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[sejprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[incprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[stoprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[promprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[golfprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[weekprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[scolprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[balnprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[santeprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[linprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[vinprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[sportprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[reliprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[noelprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[sylprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[tourprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[cultprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[hebcourtsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[heblongsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[restosoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[pdasoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[locsallesoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[jetudsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[semisoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[soiretapsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[packsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[coktaisoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	
	print "</tr>";
	$compteur++;
		}

	if (($val[catotal] <> NULL) && ($type_client == 'C'))
		{
	print "<tr><td class='anotation'><b>$val[nomclient]</b></td>";
	print "<td class='anotation'>$val[siglecivil] $val[nomcontact]</td>";
	print "<td class='anotation'><center>$val[prenomcontact]</center></td>";
	print "<td class='anotation'><center>$val[adressecontact]</center></td>";	
	print "<td class='anotation'><center>$val[cpcontact]</center></td>";
	print "<td class='anotation'><center>$val[nomville]</center></td>";
	print "<td class='anotation'><center>$val[telcontact]</center></td>";
	print "<td class='anotation'><center>$val[faxcontact]</center></td>";
	print "<td class='anotation'><center>$val[mailcontact]</center></td>";
	if ($val4[cirprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[sejprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[incprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[stoprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[promprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[golfprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[weekprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[scolprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[balnprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[santeprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[linprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[vinprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[sportprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[reliprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[noelprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[sylprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[tourprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[cultprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[hebcourtsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[heblongsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[restosoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[pdasoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[locsallesoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[jetudsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[semisoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[soiretapsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[packsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val5[coktaisoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	
	print "</tr>";
	$compteur++;
		}
	
	}	
echo "Il y a $compteur r&eacute;sultats.";

// Destruction de la table temporaire
$requete7 = @mysql_db_query($nomdelabdd,"DROP TABLE tmp")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
@mysql_close();
echo "</table>";
}

if ($option == 'pays')
{
$nomdelabdd="statistique";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es

$requete = @mysql_db_query($nomdelabdd,"SELECT codeclient,SUM(catotal) AS catotal
		  			FROM statistique
		  			WHERE annee BETWEEN $anneemoins AND $annee
					GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close(); 	

$nomdelabdd="commercial";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es
$requete1 = @mysql_db_query($nomdelabdd,"CREATE TEMPORARY TABLE tmp (
					idtemp int    	not null auto_increment,
					codeclient    	varchar(10),
					idcontact	varchar(10),
					catotal		varchar(10),
					nomclient	varchar(100),
					nomcontact	varchar(100),
					prenomcontact	varchar(100),
					adressecontact	varchar(100),
					cpcontact	varchar(100),
					nomville	varchar(100),
					telcontact	varchar(100),
					faxcontact	varchar(100),
					mailcontact	varchar(100),
					PRIMARY KEY   	(idtemp),
					UNIQUE idtemp 	(idtemp))")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Cas ou pas tous les commerciaux
if ($rce <> "tous")
{
$requete2 = @mysql_query("SELECT c.*,v.nomville,i.siglecivil
			FROM suivi s,contact c,liensuivi l,civil i,ville v
			WHERE s.idsuivi=l.idsuivi
			AND c.idcontact=l.idcontact 
			AND c.idcivil=i.idcivil
			AND c.idville=v.idville
			AND s.idrce='$rce'
			GROUP BY c.idcontact")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
}
else
	{
	$requete2 = @mysql_query("SELECT c.*,v.nomville,i.siglecivil
			FROM suivi s,contact c,liensuivi l,civil i,ville v
			WHERE s.idsuivi=l.idsuivi
			AND c.idcontact=l.idcontact 
			AND c.idcivil=i.idcivil
			AND c.idville=v.idville
			GROUP BY c.idcontact")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
	}

// Insertion pour compte du rce
while($contenu = mysql_fetch_array($requete2)) 								
{
$req = @mysql_query("SELECT c.nomclient,c.codeclient,p.nompays
		FROM client c,liencontact l,pays p
		WHERE l.idcontact='$contenu[idcontact]'
		AND p.nompays LIKE '%$opd%'
		AND c.idpays=p.idpays
		AND c.etat <> 0
		AND l.idclient=c.codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
$val_req = mysql_fetch_array($req);

if ($val_req['nomclient'] <> NULL)
	{
$req_insert = @mysql_db_query($nomdelabdd,"INSERT INTO tmp (
				codeclient,
				idcontact,
				nomclient,
				nomcontact,
				prenomcontact,
				adressecontact,
				cpcontact,
				nomville,
				telcontact,
				faxcontact,
				mailcontact) VALUES (
				\"$val_req[codeclient]\",
				\"$contenu[idcontact]\",
				\"$val_req[nomclient]\",
				\"$contenu[siglecivil] $contenu[nomcontact]\",
				\"$contenu[prenomcontact]\",
				\"$contenu[adressecontact]\",
				\"$contenu[cpcontact]\",
				\"$contenu[nomville]\",
				\"$contenu[telcontact]\",
				\"$contenu[faxcontact]\",
				\"$contenu[mailcontact]\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
}
// Modification du tmp pour les prospects et clients
while($contenu = mysql_fetch_array($requete)) 								
{
$req_update = @mysql_db_query($nomdelabdd,"UPDATE tmp SET
					catotal='$contenu[catotal]'
					WHERE codeclient='$contenu[codeclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");

}

$requete3 = @mysql_query("SELECT *
			FROM tmp
			ORDER BY nomclient ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								

$compteur = 0;
while($val = mysql_fetch_array($requete3)) 	
	{
	// Recherche dans les prod util
	$requete4 = @mysql_db_query($nomdelabdd,"SELECT *
		  	FROM produtil
		  	WHERE idcontact='$val[idcontact]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
	$val4 = mysql_fetch_array($requete4);
	// Recherche dans les interets
	$requete5 = @mysql_db_query($nomdelabdd,"SELECT *
		  	FROM prodsoc
		  	WHERE idcontact='$val[idcontact]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
	$val5 = mysql_fetch_array($requete5);
	
	if (($val[catotal] == NULL) && ($type_client == 'P'))
		{
	print "<tr><td class='anotation'><b>$val[nomclient]</b></td>";
	print "<td class='anotation'>$val[siglecivil] $val[nomcontact]</td>";
	print "<td class='anotation'><center>$val[prenomcontact]</center></td>";
	print "<td class='anotation'><center>$val[adressecontact]</center></td>";	
	print "<td class='anotation'><center>$val[cpcontact]</center></td>";
	print "<td class='anotation'><center>$val[nomville]</center></td>";
	print "<td class='anotation'><center>$val[telcontact]</center></td>";
	print "<td class='anotation'><center>$val[faxcontact]</center></td>";
	print "<td class='anotation'><center>$val[mailcontact]</center></td>";
	if (@$val4[cirprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[sejprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[incprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[stoprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[promprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[golfprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[weekprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[scolprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[balnprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[santeprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[linprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[vinprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[sportprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[reliprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[noelprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[sylprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[tourprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[cultprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[hebcourtsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[heblongsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[restosoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[pdasoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[locsallesoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[jetudsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[semisoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[soiretapsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[packsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[coktaisoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	
	print "</tr>";
	$compteur++;
		}

	if (($val[catotal] <> NULL) && ($type_client == 'C'))
		{
	print "<tr><td class='anotation'><b>$val[nomclient]</b></td>";
	print "<td class='anotation'>$val[siglecivil] $val[nomcontact]</td>";
	print "<td class='anotation'><center>$val[prenomcontact]</center></td>";
	print "<td class='anotation'><center>$val[adressecontact]</center></td>";	
	print "<td class='anotation'><center>$val[cpcontact]</center></td>";
	print "<td class='anotation'><center>$val[nomville]</center></td>";
	print "<td class='anotation'><center>$val[telcontact]</center></td>";
	print "<td class='anotation'><center>$val[faxcontact]</center></td>";
	print "<td class='anotation'><center>$val[mailcontact]</center></td>";
	if (@$val4[cirprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[sejprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[incprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[stoprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[promprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[golfprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[weekprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[scolprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[balnprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[santeprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[linprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[vinprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[sportprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[reliprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[noelprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[sylprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[tourprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[cultprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[hebcourtsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[heblongsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[restosoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[pdasoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[locsallesoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[jetudsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[semisoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[soiretapsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[packsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[coktaisoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	
	print "</tr>";
	$compteur++;
		}
	
	}	
echo "Il y a $compteur r&eacute;sultats.";

// Destruction de la table temporaire
$requete7 = @mysql_db_query($nomdelabdd,"DROP TABLE tmp")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
@mysql_close();
echo "</table>";
}

if ($option == 'secteur')
{
$nomdelabdd="statistique";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es

$requete = @mysql_db_query($nomdelabdd,"SELECT codeclient,SUM(catotal) AS catotal
		  			FROM statistique
		  			WHERE annee BETWEEN $anneemoins AND $annee
					GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
@mysql_close(); 	

$nomdelabdd="commercial";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es
$requete1 = @mysql_db_query($nomdelabdd,"CREATE TEMPORARY TABLE tmp (
					idtemp int    	not null auto_increment,
					codeclient    	varchar(10),
					idcontact	varchar(10),
					catotal		varchar(10),
					nomclient	varchar(100),
					nomcontact	varchar(100),
					prenomcontact	varchar(100),
					adressecontact	varchar(100),
					cpcontact	varchar(100),
					nomville	varchar(100),
					telcontact	varchar(100),
					faxcontact	varchar(100),
					mailcontact	varchar(100),
					PRIMARY KEY   	(idtemp),
					UNIQUE idtemp 	(idtemp))")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Cas ou pas tous les commerciaux
if ($rce <> "tous")
{
$requete2 = @mysql_query("SELECT c.*,v.nomville,i.siglecivil
			FROM suivi s,contact c,liensuivi l,civil i,ville v
			WHERE s.idsuivi=l.idsuivi
			AND c.idcontact=l.idcontact 
			AND c.idcivil=i.idcivil
			AND c.idville=v.idville
			AND s.idrce='$rce'
			GROUP BY c.idcontact")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
}
else
	{
	$requete2 = @mysql_query("SELECT c.*,v.nomville,i.siglecivil
			FROM suivi s,contact c,liensuivi l,civil i,ville v
			WHERE s.idsuivi=l.idsuivi
			AND c.idcontact=l.idcontact 
			AND c.idcivil=i.idcivil
			AND c.idville=v.idville
			GROUP BY c.idcontact")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
	}

// Insertion pour compte du rce
while($contenu = mysql_fetch_array($requete2)) 								
{
$req = @mysql_query("SELECT c.nomclient,c.codeclient,s.nomsecteur
		FROM client c,liencontact l,secteur s
		WHERE l.idcontact='$contenu[idcontact]'
		AND c.idsecteur=s.idsecteur
		AND s.nomsecteur LIKE '%$opd%'
		AND c.etat <> 0
		AND l.idclient=c.codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
$val_req = mysql_fetch_array($req);

if ($val_req[nomclient] <> NULL)
	{
$req_insert = @mysql_db_query($nomdelabdd,"INSERT INTO tmp (
				codeclient,
				idcontact,
				nomclient,
				nomcontact,
				prenomcontact,
				adressecontact,
				cpcontact,
				nomville,
				telcontact,
				faxcontact,
				mailcontact) VALUES (
				\"$val_req[codeclient]\",
				\"$contenu[idcontact]\",
				\"$val_req[nomclient]\",
				\"$contenu[siglecivil] $contenu[nomcontact]\",
				\"$contenu[prenomcontact]\",
				\"$contenu[adressecontact]\",
				\"$contenu[cpcontact]\",
				\"$contenu[nomville]\",
				\"$contenu[telcontact]\",
				\"$contenu[faxcontact]\",
				\"$contenu[mailcontact]\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}
}
// Modification du tmp pour les prospects et clients
while($contenu = mysql_fetch_array($requete)) 								
{
$req_update = @mysql_db_query($nomdelabdd,"UPDATE tmp SET
					catotal='$contenu[catotal]'
					WHERE codeclient='$contenu[codeclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");

}

$requete3 = @mysql_query("SELECT *
			FROM tmp
			ORDER BY nomclient ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								

$compteur = 0;
while($val = mysql_fetch_array($requete3)) 	
	{
	// Recherche dans les prod util
	$requete4 = @mysql_db_query($nomdelabdd,"SELECT *
		  	FROM produtil
		  	WHERE idcontact='$val[idcontact]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
	$val4 = mysql_fetch_array($requete4);
	// Recherche dans les interets
	$requete5 = @mysql_db_query($nomdelabdd,"SELECT *
		  	FROM prodsoc
		  	WHERE idcontact='$val[idcontact]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
	$val5 = mysql_fetch_array($requete5);
	
	if (($val[catotal] == NULL) && ($type_client == 'P'))
		{
	print "<tr><td class='anotation'><b>$val[nomclient]</b></td>";
	print "<td class='anotation'>$val[siglecivil] $val[nomcontact]</td>";
	print "<td class='anotation'><center>$val[prenomcontact]</center></td>";
	print "<td class='anotation'><center>$val[adressecontact]</center></td>";	
	print "<td class='anotation'><center>$val[cpcontact]</center></td>";
	print "<td class='anotation'><center>$val[nomville]</center></td>";
	print "<td class='anotation'><center>$val[telcontact]</center></td>";
	print "<td class='anotation'><center>$val[faxcontact]</center></td>";
	print "<td class='anotation'><center>$val[mailcontact]</center></td>";
	if (@$val4[cirprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[sejprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[incprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[stoprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[promprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[golfprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[weekprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[scolprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[balnprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[santeprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[linprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[vinprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[sportprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[reliprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[noelprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[sylprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[tourprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[cultprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[hebcourtsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[heblongsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[restosoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[pdasoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[locsallesoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[jetudsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[semisoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[soiretapsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[packsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[coktaisoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	
	print "</tr>";
	$compteur++;
		}

	if (($val[catotal] <> NULL) && ($type_client == 'C'))
		{
	print "<tr><td class='anotation'><b>$val[nomclient]</b></td>";
	print "<td class='anotation'>$val[siglecivil] $val[nomcontact]</td>";
	print "<td class='anotation'><center>$val[prenomcontact]</center></td>";
	print "<td class='anotation'><center>$val[adressecontact]</center></td>";	
	print "<td class='anotation'><center>$val[cpcontact]</center></td>";
	print "<td class='anotation'><center>$val[nomville]</center></td>";
	print "<td class='anotation'><center>$val[telcontact]</center></td>";
	print "<td class='anotation'><center>$val[faxcontact]</center></td>";
	print "<td class='anotation'><center>$val[mailcontact]</center></td>";
	if (@$val4[cirprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[sejprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[incprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[stoprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[promprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[golfprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[weekprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[scolprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[balnprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[santeprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[linprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if ($val4[vinprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[sportprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[reliprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[noelprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[sylprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[tourprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val4[cultprodutil] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[hebcourtsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[heblongsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[restosoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[pdasoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[locsallesoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[jetudsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[semisoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[soiretapsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[packsoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val5[coktaisoc] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	
	print "</tr>";
	$compteur++;
		}
	
	}	
echo "Il y a $compteur r&eacute;sultats.";

// Destruction de la table temporaire
$requete7 = @mysql_db_query($nomdelabdd,"DROP TABLE tmp")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
@mysql_close();
echo "</table>";
}

?>
</body>
</html>
<?php
break;

case 17:

$NomDuMois = array ("Janvier", "F&eacute;vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "D&eacute;cembre");   // cr&eacute;ation d'un tableau virtuel contenant les noms des mois
$anmoinun  = $annee - 1;
$anmoindeu  = $annee - 2;
?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Productivit&eacute; du Client <? echo "$code"; ?> pour le mois de <? print($NomDuMois[ date($mois - 1) ]); ?></center></h3>
<br>
<center><input type="button" value="Impression de la Productivit&eacute;" onClick="imprime()">
<br><br>
<table width='100%' border='1'>
<tr> 
  <td width='18%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>H&ocirc;tels<center></b></div>
  </td>    
 <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nuit&eacute;es en <? echo "$annee"; ?><center></b></div>
  </td>   
 <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nuit&eacute;es en <? echo "$anmoinun"; ?><center></b></div>
  </td>   
  <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nuit&eacute;es en <? echo "$anmoindeu"; ?><center></b></div>
  </td>   
  <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Variations Nuit&eacute;es <? echo "$anmoinun/$annee"; ?><center></b></div>
  </td> 
  <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Variations Nuit&eacute;es <? echo "$anmoindeu/$annee"; ?><center></b></div>
  </td> 
   <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA en <? echo "$annee"; ?><center></b></div>
  </td> 
  <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA en <? echo "$anmoinun"; ?><center></b></div>
  </td>     
  <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA en <? echo "$anmoindeu"; ?><center></b></div>
  </td> 
  <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Variations CA <? echo "$anmoinun/$annee"; ?><center></b></div>
  </td>  
  <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Variations CA <? echo "$anmoindeu/$annee"; ?><center></b></div>
  </td> 
  </tr>
<?php
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
$nomdelabdd="statistique";       										// le nom de la Base de donn&eacute;es 
@mysql_select_db($nomdelabdd,$bdd);   			

$req_sel_hot = @mysql_query("SELECT *
						 	 FROM hotel
							 WHERE codehotel <> ''
							 ORDER BY nomhotel ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								

$req_sel = @mysql_db_query($nomdelabdd,"SELECT *
										FROM statistique
										WHERE codeclient=\"$code\"
										AND mois=$mois")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		

$req_cree = @mysql_db_query($nomdelabdd,"CREATE TEMPORARY TABLE tmp (
										 idtemp         int not null auto_increment,
										 codetablis     varchar(6),
										 catotal        varchar(10),
										 nuite          varchar(10),
										 annee          int(4),
										 PRIMARY KEY   (idtemp),
										 UNIQUE idtemp (idtemp))")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");

while($contenu = mysql_fetch_array($req_sel)) 								
{
$req_insert1 = @mysql_db_query($nomdelabdd,"INSERT INTO tmp (codetablis,catotal,nuite,annee)
										    VALUES (\"$contenu[codetablis]\",			
												    \"$contenu[catotal]\",
												    \"$contenu[nuite]\",
												    \"$contenu[annee]\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}

while ($val = mysql_fetch_array($req_sel_hot))
{
		$req_sel_1 = @mysql_query("SELECT SUM(catotal) AS catotal,SUM(nuite) AS nuite
						 	 	   FROM tmp
							 	   WHERE codetablis=\"$val[codehotel]\"
								   AND annee=\"$anmoinun\"
								   GROUP BY codetablis")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
		$val_1 = mysql_fetch_array($req_sel_1);
		$req_sel_2 = @mysql_query("SELECT SUM(catotal) AS catotal,SUM(nuite) AS nuite
						 	 	   FROM tmp
							 	   WHERE codetablis=\"$val[codehotel]\"
								   AND annee=\"$anmoindeu\"
								   GROUP BY codetablis")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
		$val_2 = mysql_fetch_array($req_sel_2);
		$req_sel_3 = @mysql_query("SELECT SUM(catotal) AS catotal,SUM(nuite) AS nuite
						 	 	   FROM tmp
							 	   WHERE codetablis=\"$val[codehotel]\"
								   AND annee=\"$annee\"
								   GROUP BY codetablis")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
		$val_3 = mysql_fetch_array($req_sel_3);
		// Arrondi a la virgule pres
		$val_1['catotal'] = round($val_1['catotal']);
		$val_2['catotal'] = round($val_2['catotal']);
		$val_3['catotal'] = round($val_3['catotal']);
		// Calcul des variations		
		$nuiteun = $val_3['nuite'] - $val_1['nuite'];	
		$nuitedeu = $val_3['nuite'] - $val_2['nuite'];		
		$totalun = $val_3['catotal'] - $val_1['catotal'];
		$totaldeu = $val_3['catotal'] - $val_2['catotal'];	
		// Calcul des totaux
		$total1 = $val_1['nuite'] + $total1;
		$total2 = $val_2['nuite'] + $total2;
		$total3 = $val_3['nuite'] + $total3;
		$total4 = $val_1['catotal'] + $total4;
		$total5 = $val_2['catotal'] + $total5;
		$total6 = $val_3['catotal'] + $total6;
		$total7 = $nuiteun + $total7;
		$total8 = $nuitedeu + $total8;
		$total9 = $totalun + $total9;
		$total10 = $totaldeu + $total10;
		
		echo "<tr class=news><td>$val[nomhotel]</td>";
		if ($val_3[nuite] == NULL)
		{
		echo "<td><div align='center'>&nbsp;</div></td>";
		}
		else
			{
			echo "<td><div align='center'>$val_3[nuite]</div></td>";
			}		
		if ($val_1[nuite] == NULL)
		{
		echo "<td><div align='center'>&nbsp;</div></td>";
		}
		else
			{
			echo "<td><div align='center'>$val_1[nuite]</div></td>";
			}		
		if ($val_2[nuite] == NULL)
		{
		echo "<td><div align='center'>&nbsp;</div></td>";
		}
		else
			{
			echo "<td><div align='center'>$val_2[nuite]</div></td>";
			}		
		echo "<td><div align='right'><b>$nuiteun</b></div></td>";
		echo "<td><div align='right'><b>$nuitedeu</b></div></td>";
		if ($val_3[catotal] == NULL)
		{
		echo "<td><div align='center'>&nbsp;</div></td>";
		}
		else
			{
			echo "<td><div align='center'>$val_3[catotal] &euro;</div></td>";
			}				
	
		if ($val_1[catotal] == NULL)
		{
		echo "<td><div align='center'>&nbsp;</div></td>";
		}
		else
			{
			echo "<td><div align='center'>$val_1[catotal] &euro;</div></td>";
			}				
		if ($val_2[catotal] == NULL)
		{
		echo "<td><div align='center'>&nbsp;</div></td>";
		}
		else
			{
			echo "<td><div align='center'>$val_2[catotal] &euro;</div></td>";
			}				
		echo "<td><div align='right'><b>$totalun &euro;</b></div></td>";
		echo "<td><div align='right'><b>$totaldeu &euro;</b></div></td></tr>";
}
// Destruction de la table temporaire
$requete3 = @mysql_db_query($nomdelabdd,"DROP TABLE tmp")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
@mysql_close();	

echo "<tr class=anotation><td><i>Total</i></td>";
echo "<td><div align='right'><b>$total3</b></div></td>";
echo "<td><div align='right'><b>$total1</b></div></td>";
echo "<td><div align='right'><b>$total2</b></div></td>";
echo "<td><div align='right'><b>$total7</b></div></td>";
echo "<td><div align='right'><b>$total8</b></div></td>";
echo "<td><div align='right'><b>$total6 &euro;</b></div></td>";
echo "<td><div align='right'><b>$total4 &euro;</b></div></td>";
echo "<td><div align='right'><b>$total5 &euro;</b></div></td>";
echo "<td><div align='right'><b>$total9 &euro;</b></div></td>";
echo "<td><div align='right'><b>$total10 &euro;</b></div></td></tr>";
echo "</table></center>";
?>
</body>
</html>
<?
break;

case 18:

?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Les Clients pour l'ann&eacute;e <? echo "$an"; ?></center></h3>
<br>
<center><input type="button" value="Impression des nouveaux Clients" onClick="imprime()"></center>
<br>
<table width='100%' border='1'>
<tr> 
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Code<center></b></div>
  </td>    
 <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nom du Client<center></b></div>
  </td> 
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nom/Pr&eacute;nom Contact<center></b></div>
  </td> 
  <td width='15%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Adresse<center></b></div>
  </td>    
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Code Postal<center></b></div>
  </td>    
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Ville<center></b></div>
  </td>    
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Pays<center></b></div>
  </td>   
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>T&eacute;l&eacute;phone<center></b></div>
  </td>    
  </tr>
<?php
$nomdelabdd="statistique";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es

// Selection en fonction du choix utilisateur
if ($indice == 'T')
{
$req_sel2 = @mysql_db_query($nomdelabdd,"SELECT s.*
										 FROM statistique s
										 WHERE s.codeclient BETWEEN '950000' AND '990000'
										 AND s.annee=$an
										 AND s.catotal <> '0'
										 GROUP BY s.codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
}
else
	{
	$req_sel2 = @mysql_db_query($nomdelabdd,"SELECT s.*
										 	 FROM statistique s
										 	 WHERE s.codeclient BETWEEN '800000' AND '949999'
										 	 AND s.annee=$an
											 AND s.catotal <> '0'
											 GROUP BY s.codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
	}
@mysql_close(); 

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
$nomdelabdd="commercial";       										// le nom de la Base de donn&eacute;es 
@mysql_select_db($nomdelabdd,$bdd); 

$req_cree = @mysql_db_query($nomdelabdd,"CREATE TEMPORARY TABLE tmp (
										 idtemp         int not null auto_increment,
										 codeclient     varchar(6),
										 PRIMARY KEY   (idtemp),
										 UNIQUE idtemp (idtemp))")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
// Insertion des donn&eacute;es de la base statistique pour comparaison avec la base commercial 
while($contenu = mysql_fetch_array($req_sel2)) 								
{
$req_insert1 = @mysql_db_query($nomdelabdd,"INSERT INTO tmp (codeclient)
										    VALUES (\"$contenu[codeclient]\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}
  			
$requete = @mysql_query("SELECT c.*,p.nompays,v.nomville
						 FROM client c,pays p,ville v,tmp t
						 WHERE t.codeclient=c.codeclient
						 AND c.idpays=p.idpays
						 AND c.idville=v.idville
						 AND c.etat <> 0
						 ORDER BY p.nompays,c.nomclient ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
$compteur = mysql_numrows($requete); 

while ($val = mysql_fetch_array($requete))
		{
		echo "<tr><td class=news>$val[codeclient]</td>";
		echo "<td><center>$val[nomclient]</center></td>";
		echo "<td class=anotation>";
		$requete1 = @mysql_db_query($nomdelabdd,"SELECT c.nomcontact,c.prenomcontact,n.siglecivil
											 	 FROM contact c,liencontact l,civil n
											 	 WHERE c.idcontact=l.idcontact
												 AND c.idcivil=n.idcivil
											 	 AND l.idclient='$val[codeclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
		while($contenu1 = @mysql_fetch_array ($requete1))
			{	
			echo "<center>$contenu1[siglecivil] $contenu1[nomcontact] $contenu1[prenomcontact]</center>";
			}
		echo "</td>";
		echo "<td><center>$val[adresseclient]</center></td>";
		echo "<td><center>$val[cpclient]</center></td>";
		echo "<td><center>$val[nomville]</center></td>";
		if ($val[nompays] == "Non renseigne")
			{
			echo "<td></td>";
			}
			else
				{
				echo "<td><center>$val[nompays]</center></td>";
				}				
		echo "<td><center>$val[telclient]</center></td></tr>";
		}
echo "</table>";
if ($compteur <> 0)
{
echo "<br><br><b>La recherche a donn&eacute; $compteur Clients.</b>";
}
else
	{
	echo "<br><br><b>La recherche n'a pas donn&eacute; de r&eacute;sultats.</b>";
	}
// Destruction de la table temporaire
$req_del = @mysql_db_query($nomdelabdd,"DROP TABLE tmp")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
@mysql_close(); 
?>
</body>
</html>
<?
break;

case 19:
?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>TOP 50 du Mois</center></h3>
<br>
<center><input type="button" value="Impression du TOP 50" onClick="imprime()">
<br><br>
<table width='80%' border='1'>
<tr> 
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Place en <? echo "$an"; ?><center></b></div>
  </td> 
  <td width='7%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Code<center></b></div>
  </td>    
 <td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nom<center></b></div>
  </td> 
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nbre de Client pour ce mois<center></b></div>
  </td>     
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nuit&eacute; pour ce mois<center></b></div>
  </td>     
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA pour N<center></b></div>
  </td>  
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA pour N-1<center></b></div>
  </td>      
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA depuis N<center></b></div>
  </td>    
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA depuis N-1<center></b></div>
  </td>
  </tr>
<?php
$anmoins = $an - 1;
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
$nomdelabdd="statistique";       										// le nom de la Base de donn&eacute;es 
@mysql_select_db($nomdelabdd,$bdd);  

// Selection en fonction du choix utilisateur
if ($indice == 'T')
{
$requete = @mysql_query("SELECT codeclient,nomclient,SUM(catotal) AS catotal,SUM(nuite) AS nuite,SUM(nbreclient) AS nbreclient
						 FROM statistique
						 WHERE annee='$an'
						 AND mois='$mois'
						 AND codeclient BETWEEN '950000' AND '990000'
						 GROUP BY codeclient,annee
						 ORDER BY catotal DESC
						 LIMIT 0,50")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");						 						
}
else
	{
	$requete = @mysql_query("SELECT codeclient,nomclient,SUM(catotal) AS catotal,SUM(nuite) AS nuite,SUM(nbreclient) AS nbreclient
						 	 FROM statistique
						 	 WHERE annee='$an'
						 	 AND mois='$mois'
						 	 AND codeclient BETWEEN '800000' AND '949999'
						 	 GROUP BY codeclient,annee
						 	 ORDER BY catotal DESC
						 	 LIMIT 0,50")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
	}
 			
$compte = 0;

while ($val = mysql_fetch_array($requete))
		{		
		$compte =$compte + 1;
		$requete1 = @mysql_query("SELECT SUM(catotal) AS catotal
						 		  FROM statistique
						 		  WHERE codeclient=\"$val[codeclient]\"
								  AND annee='$an'
						 		  AND mois <= '$mois'
						 		  GROUP BY codeclient,annee")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");			
		$requete2 = @mysql_query("SELECT SUM(catotal) AS catotal
						 		  FROM statistique
						 		  WHERE codeclient=\"$val[codeclient]\"
								  AND annee='$anmoins'
						 		  AND mois <= '$mois'
						 		  GROUP BY codeclient,annee")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	
		$requete3 = @mysql_query("SELECT codeclient,nomclient,SUM(catotal) AS catotal,SUM(nuite) AS nuite,SUM(nbreclient) AS nbreclient
						 FROM statistique
						 WHERE annee='$anmoins'
						 AND mois='$mois'
						 AND codeclient=\"$val[codeclient]\"
						 GROUP BY codeclient,annee")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");						 						
				
		$val1 = mysql_fetch_array($requete1);
		$val2 = mysql_fetch_array($requete2);
		$val3 = mysql_fetch_array($requete3);
		$val[catotal] = str_replace(".",",",$val[catotal]);
		$val1[catotal] = str_replace(".",",",$val1[catotal]);
		$val2[catotal] = str_replace(".",",",$val2[catotal]);
		$val3[catotal] = str_replace(".",",",$val3[catotal]);
		echo "<tr><td><div align='center'><b>$compte</b></div></td>";
		echo "<td>$val[codeclient]</td>";
		echo "<td>$val[nomclient]</td>";
		echo "<td><div align='right'>$val[nbreclient]</div></td>";
		echo "<td><div align='right'>$val[nuite]</div></td>";
		echo "<td><div align='right'><b>$val[catotal] &euro;</b></div></td>";
		echo "<td><div align='right'>$val3[catotal] &euro;</td>";
		echo "<td><div align='right'><b>$val1[catotal] &euro;</b></div></td>";
		echo "<td><div align='right'>$val2[catotal] &euro;</div></td>";
		echo "</tr>";
		}
echo "</table>";
@mysql_close(); 
?>
</center>
</body>
</html>
<?php
break;

case 20:
// On assigne au mois la variable $option
$mois = $option;   
$annee  = $an;
$anmoinun = $an - 1;     
$anmoindeu = $an - 2;
?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Statistiques par Client, nbre Nuit&eacute; et CA Total en cumul&eacute; au mois</center></h3>
<br>
<center><input type="button" value="Impression des Statistiques" onClick="imprime()"></center>
<br>
<center>
<table width='100%' border='1'>
  <tr> 
  <td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Soci&eacute;t&eacute;s<center></b></div>
  </td>    
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>No de Soci&eacute;t&eacute;<center></b></div>
  </td>     
   <td width='7%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nuit&eacute;es <? echo "$mois/$annee"; ?><center></b></div>
  </td>   
   <td width='7%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nuit&eacute;es <? echo "$mois/$anmoinun"; ?><center></b></div>
  </td>     
 <td width='7%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nuit&eacute;es <? echo "$mois/$anmoindeu"; ?><center></b></div>
  </td>   
  <td width='7%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Variations Nuit&eacute;es <? echo "$anmoinun/$annee"; ?><center></b></div>
  </td>     
  <td width='7%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Variations Nuit&eacute;es <? echo "$anmoindeu/$annee"; ?><center></b></div>
  </td> 
  <td width='7%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA <? echo "$mois/$annee"; ?><center></b></div>
  </td>     
  <td width='7%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA <? echo "$mois/$anmoinun"; ?><center></b></div>
  </td>     
  <td width='7%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA <? echo "$mois/$anmoindeu"; ?><center></b></div>
  </td>       
  <td width='7%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Variations CA <? echo "$anmoinun/$annee"; ?><center></b></div>
  </td>    
  <td width='7%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Variations CA <? echo "$anmoindeu/$annee"; ?><center></b></div>
  </td>   
  </tr>
<?php
$nomdelabdd="authentique";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es$req_user = @mysql_db_query($nomdelabdd,"SELECT * FROM utilisateur WHERE idutil='$log'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
$user = mysql_fetch_array($req_user);
if ($user[groupe] < 4) 
{
$user[nummin] = '800000';
$user[nummax] = '949999';
}
@mysql_close();

$nomdelabdd="statistique";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es

// Selection en fonction du choix utilisateur
if ($indice == 'T')
{
	// Cas ou l'utilisateur peut voir tous les hotels
	if ($sofibra_avec == 1)
	{
	$req_sel_bis = @mysql_db_query($nomdelabdd,"SELECT s.annee,s.mois,s.codeclient,s.nomclient,SUM(catotal) AS catotal,SUM(nuite) AS nuite
											FROM statistique s
											WHERE mois <= $mois
											AND s.codeclient BETWEEN '950000' AND '990000'
											GROUP BY annee,codeclient
											ORDER BY s.nomclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
	}
	else
		// Cas ou on affiche en fonction de l'hotel
		{
		$tab = explode(",",$sofibra_sel);
	 		// Nombre dhotel pour un utilisateur
	 		$taille = sizeof($tab);	 	
			for ($boucle=0;$boucle < $taille;$boucle++)
					{
					$tableau[$boucle]="'$tab[$boucle]'";
					}
			$tableau = implode(",",$tableau);
			$req_sel_bis = @mysql_db_query($nomdelabdd,"SELECT s.codetablis,s.annee,s.mois,s.codeclient,s.nomclient,SUM(catotal) AS catotal,SUM(nuite) AS nuite
											FROM statistique s
											WHERE mois <= $mois
											AND s.codeclient BETWEEN '950000' AND '990000'
											AND s.codetablis IN ($tableau)
											GROUP BY annee,codeclient
											ORDER BY s.nomclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
		}
}
else
	{
	// Cas ou l'utilisateur peut voir tous les hotels
	if ($sofibra_avec == 1)
	{
	$req_sel_bis = @mysql_db_query($nomdelabdd,"SELECT s.annee,s.mois,s.codeclient,s.nomclient,SUM(catotal) AS catotal,SUM(nuite) AS nuite
												FROM statistique s
												WHERE mois <= $mois
												AND s.codeclient BETWEEN '$user[nummin]' AND '$user[nummax]'
												GROUP BY annee,codeclient
												ORDER BY s.nomclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
	}
	else
		// Cas ou on affiche en fonction de l'hotel
		{
		$tab = explode(",",$sofibra_sel);
	 		// Nombre dhotel pour un utilisateur
	 		$taille = sizeof($tab);	 	
			for ($boucle=0;$boucle < $taille;$boucle++)
					{
					$tableau[$boucle]="'$tab[$boucle]'";
					}
			$tableau = implode(",",$tableau);
			$req_sel_bis = @mysql_db_query($nomdelabdd,"SELECT s.codetablis,s.annee,s.mois,s.codeclient,s.nomclient,SUM(catotal) AS catotal,SUM(nuite) AS nuite
											FROM statistique s
											WHERE mois <= $mois
											AND s.codeclient BETWEEN '$user[nummin]' AND '$user[nummax]'
											OR s.codetablis IN ($tableau)
											GROUP BY annee,codeclient
											ORDER BY s.nomclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
		}
	}

$req_cree = @mysql_db_query($nomdelabdd,"CREATE TEMPORARY TABLE tmp (
										 idtemp         int not null auto_increment,
										 codeclient     varchar(6),
										 nomclient      varchar(100),
										 catotal        varchar(10),
										 nuite          varchar(10),
										 annee          int(4),
										 mois 			int(2),
										 codetablis	varchar(10),
										 PRIMARY KEY   (idtemp),
										 UNIQUE idtemp (idtemp))")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");

while($contenu = mysql_fetch_array($req_sel_bis)) 								
{
$contenu[nomclient] = addslashes($contenu[nomclient]);
$req_insert1 = @mysql_db_query($nomdelabdd,"INSERT INTO tmp (codeclient,nomclient,catotal,nuite,annee,mois,codetablis)
										    VALUES (\"$contenu[codeclient]\",			
												    \"$contenu[nomclient]\",
												    \"$contenu[catotal]\",
												    \"$contenu[nuite]\",
												    \"$contenu[annee]\",												   
												    \"$contenu[mois]\",
												    \"$contenu[codetablis]\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}

$req_sel_1 = @mysql_db_query($nomdelabdd,"SELECT *
										  FROM tmp
										  WHERE annee=$annee
										  ORDER BY nomclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
$compteur = mysql_numrows($req_sel_1); 

echo "Affichage de <b>$compteur</b> r&eacute;sultats.<br><br> -- $user - $user[nummin] - $user[nummax]";

while($val = mysql_fetch_array($req_sel_1)) 								
{
		$req_sel7 = @mysql_db_query($nomdelabdd,"SELECT *
										 		 FROM tmp
										 		 WHERE codeclient=\"$val[codeclient]\"
												 AND annee=$anmoinun")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
		$valmoinun = mysql_fetch_array($req_sel7);
		$req_sel8 = @mysql_db_query($nomdelabdd,"SELECT *
										 		 FROM tmp
										 		 WHERE codeclient=\"$val[codeclient]\"
												 AND annee=$anmoindeu")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
		$valmoindeu = mysql_fetch_array($req_sel8);
		
		// Arrondi a la virgule pres
		$val[catotal] = round($val[catotal]);
		$valmoinun[catotal] = round($valmoinun[catotal]);
		$valmoindeu[catotal] = round($valmoindeu[catotal]);
		// Calcul des variations
		$nuiteun = $val[nuite]- $valmoinun[nuite];
		$nuitedeu = $val[nuite]- $valmoindeu[nuite];
		$catotalun = $val[catotal]- $valmoinun[catotal];
		$catotaldeu = $val[catotal]- $valmoindeu[catotal];
		// Calcul des totaux
		$total1 = $total1 + $val[nuite];
		$total2 = $total2 + $valmoinun[nuite];
		$total3 = $total3 + $valmoindeu[nuite];		
		$total4 = $total4 + $nuiteun;
		$total5 = $total5 + $nuitedeu;		
		$total6 = $total6 + $val[catotal];
		$total7 = $total7 + $valmoinun[catotal];
		$total8 = $total8 + $valmoindeu[catotal];
		$total9 = $total9 + $catotalun;
		$total10 = $total10 + $catotaldeu;
		
		if ($sofibra_sel <> NULL)
		{ echo "<tr class=news><td><a class='menu' href='statclient.php?ok=3&code=$val[codeclient]&codetablis=$val[codetablis]'>$val[nomclient]</a></td>"; }
		else
		{ echo "<tr class=news><td><a class='menu' href='resultat.php?requete=21&code=$val[codeclient]&annee=$annee&mois=$mois'>$val[nomclient]</a></td>"; }
		echo "<td><center><b>$val[codeclient]</b></center></td>";
		echo "<td><center>$val[nuite]</center></td>";		
		echo "<td><center>$valmoinun[nuite]</center></td>";
		echo "<td><center>$valmoindeu[nuite]</center></td>";
		echo "<td><div align='right'><b>$nuiteun</b></div></td>";	
		echo "<td><div align='right'><b>$nuitedeu</b></div></td>";		
		echo "<td><center>$val[catotal] &euro;</center></td>";
		echo "<td><center>$valmoinun[catotal] &euro;</center></td>";		
		echo "<td><center>$valmoindeu[catotal] &euro;</center></td>";		
		echo "<td><div align='right'><b>$catotalun &euro;</b></div></td>";
		echo "<td><div align='right'><b>$catotaldeu &euro;</b></div></td></tr>";		
}

echo "<tr class=anotation><td><center><i><a class='menu' href='resultat.php?requete=17&code=$code&annee=$annee&mois=$mois'>TOTAL</a></i></center></td>";
echo "<td></td>";
echo "<td><div align='right'><b>$total1</b></div></td>";
echo "<td><div align='right'><b>$total2</b></div></td>";
echo "<td><div align='right'><b>$total3</b></div></td>";
echo "<td><div align='right'><b>$total4</b></div></td>";
echo "<td><div align='right'><b>$total5</b></div></td>";
echo "<td><div align='right'><b>$total6 &euro;</b></div></td>";
echo "<td><div align='right'><b>$total7 &euro;</b></div></td>";
echo "<td><div align='right'><b>$total8 &euro;</b></div></td>";
echo "<td><div align='right'><b>$total9 &euro;</b></div></td>";
echo "<td><div align='right'><b>$total10 &euro;</b></div></td></tr>";
echo "</table></center><br><br>";
// Destruction de la table temporaire
$req_del1 = @mysql_db_query($nomdelabdd,"DROP TABLE tmp")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
@mysql_close();	
?>
<center>
</body>
</html>
<?php
break;

case 21:

$NomDuMois = array ("Janvier", "F&eacute;vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "D&eacute;cembre");   // cr&eacute;ation d'un tableau virtuel contenant les noms des mois
$anmoinun  = $annee - 1;
$anmoindeu  = $annee - 2;
?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Productivit&eacute; du Client <? echo "$code"; ?> en cumul&eacute; à partir du mois de <? print($NomDuMois[ date($mois - 1) ]); ?></center></h3>
<br>
<center><input type="button" value="Impression de la Productivit&eacute;" onClick="imprime()">
<br><br>
<table width='100%' border='1'>
<tr> 
  <td width='18%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>H&ocirc;tels<center></b></div>
  </td>    
 <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nuit&eacute;es en <? echo "$annee"; ?><center></b></div>
  </td>   
 <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nuit&eacute;es en <? echo "$anmoinun"; ?><center></b></div>
  </td>   
  <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nuit&eacute;es en <? echo "$anmoindeu"; ?><center></b></div>
  </td>   
  <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Variations Nuit&eacute;es <? echo "$anmoinun/$annee"; ?><center></b></div>
  </td> 
  <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Variations Nuit&eacute;es <? echo "$anmoindeu/$annee"; ?><center></b></div>
  </td> 
   <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA en <? echo "$annee"; ?><center></b></div>
  </td> 
  <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA en <? echo "$anmoinun"; ?><center></b></div>
  </td>     
  <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA en <? echo "$anmoindeu"; ?><center></b></div>
  </td> 
  <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Variations CA <? echo "$anmoinun/$annee"; ?><center></b></div>
  </td>  
  <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Variations CA <? echo "$anmoindeu/$annee"; ?><center></b></div>
  </td> 
  </tr>
<?php
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
$nomdelabdd="statistique";       										// le nom de la Base de donn&eacute;es 
@mysql_select_db($nomdelabdd,$bdd);   			

$req_sel_hot = @mysql_query("SELECT *
						 	 FROM hotel
							 WHERE codehotel <> ''
							 ORDER BY nomhotel ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								

$req_sel = @mysql_db_query($nomdelabdd,"SELECT *
										FROM statistique
										WHERE codeclient=\"$code\"
										AND mois <= $mois")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		

$req_cree = @mysql_db_query($nomdelabdd,"CREATE TEMPORARY TABLE tmp (
										 idtemp         int not null auto_increment,
										 codetablis     varchar(6),
										 catotal        varchar(10),
										 nuite          varchar(10),
										 annee          int(4),
										 PRIMARY KEY   (idtemp),
										 UNIQUE idtemp (idtemp))")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");

while($contenu = mysql_fetch_array($req_sel)) 								
{
$req_insert1 = @mysql_db_query($nomdelabdd,"INSERT INTO tmp (codetablis,catotal,nuite,annee)
										    VALUES (\"$contenu[codetablis]\",			
												    \"$contenu[catotal]\",
												    \"$contenu[nuite]\",
												    \"$contenu[annee]\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}

while ($val = mysql_fetch_array($req_sel_hot))
{
		$req_sel_1 = @mysql_query("SELECT SUM(catotal) AS catotal,SUM(nuite) AS nuite
						 	 	   FROM tmp
							 	   WHERE codetablis=\"$val[codehotel]\"
								   AND annee=\"$anmoinun\"
								   GROUP BY codetablis")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
		$val_1 = mysql_fetch_array($req_sel_1);
		$req_sel_2 = @mysql_query("SELECT SUM(catotal) AS catotal,SUM(nuite) AS nuite
						 	 	   FROM tmp
							 	   WHERE codetablis=\"$val[codehotel]\"
								   AND annee=\"$anmoindeu\"
								   GROUP BY codetablis")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
		$val_2 = mysql_fetch_array($req_sel_2);
		$req_sel_3 = @mysql_query("SELECT SUM(catotal) AS catotal,SUM(nuite) AS nuite
						 	 	   FROM tmp
							 	   WHERE codetablis=\"$val[codehotel]\"
								   AND annee=\"$annee\"
								   GROUP BY codetablis")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
		$val_3 = mysql_fetch_array($req_sel_3);
		// Arrondi a la virgule pres
		$val_1[catotal] = round($val_1[catotal]);
		$val_2[catotal] = round($val_2[catotal]);
		$val_3[catotal] = round($val_3[catotal]);
		// Calcul des variations		
		$nuiteun = $val_3[nuite] - $val_1[nuite];	
		$nuitedeu = $val_3[nuite] - $val_2[nuite];		
		$totalun = $val_3[catotal] - $val_1[catotal];
		$totaldeu = $val_3[catotal] - $val_2[catotal];	
		// Calcul des totaux
		$total1 = $val_1[nuite] + $total1;
		$total2 = $val_2[nuite] + $total2;
		$total3 = $val_3[nuite] + $total3;
		$total4 = $val_1[catotal] + $total4;
		$total5 = $val_2[catotal] + $total5;
		$total6 = $val_3[catotal] + $total6;
		$total7 = $nuiteun + $total7;
		$total8 = $nuitedeu + $total8;
		$total9 = $totalun + $total9;
		$total10 = $totaldeu + $total10;
		
		echo "<tr class=news><td><a class='news' href='statclient.php?ok=3&code=$code&an=$annee&codetablis=$val[codehotel]'>$val[nomhotel]</a></td>";
		if ($val_3[nuite] == NULL)
		{
		echo "<td><div align='center'>&nbsp;</div></td>";
		}
		else
			{
			echo "<td><div align='center'>$val_3[nuite]</div></td>";
			}		
		if ($val_1[nuite] == NULL)
		{
		echo "<td><div align='center'>&nbsp;</div></td>";
		}
		else
			{
			echo "<td><div align='center'>$val_1[nuite]</div></td>";
			}		
		if ($val_2[nuite] == NULL)
		{
		echo "<td><div align='center'>&nbsp;</div></td>";
		}
		else
			{
			echo "<td><div align='center'>$val_2[nuite]</div></td>";
			}		
		echo "<td><div align='right'><b>$nuiteun</b></div></td>";
		echo "<td><div align='right'><b>$nuitedeu</b></div></td>";
		if ($val_3[catotal] == NULL)
		{
		echo "<td><div align='center'>&nbsp;</div></td>";
		}
		else
			{
			echo "<td><div align='center'>$val_3[catotal] &euro;</div></td>";
			}				
	
		if ($val_1[catotal] == NULL)
		{
		echo "<td><div align='center'>&nbsp;</div></td>";
		}
		else
			{
			echo "<td><div align='center'>$val_1[catotal] &euro;</div></td>";
			}				
		if ($val_2[catotal] == NULL)
		{
		echo "<td><div align='center'>&nbsp;</div></td>";
		}
		else
			{
			echo "<td><div align='center'>$val_2[catotal] &euro;</div></td>";
			}				
		echo "<td><div align='right'><b>$totalun &euro;</b></div></td>";
		echo "<td><div align='right'><b>$totaldeu &euro;</b></div></td></tr>";
}
// Destruction de la table temporaire
$requete3 = @mysql_db_query($nomdelabdd,"DROP TABLE tmp")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
@mysql_close();	

echo "<tr class=anotation><td><i><a class='menu' href='resultat.php?requete=22&code=$code&annee=$annee'>Total</a></i></td>";
echo "<td><div align='right'><b>$total3</b></div></td>";
echo "<td><div align='right'><b>$total1</b></div></td>";
echo "<td><div align='right'><b>$total2</b></div></td>";
echo "<td><div align='right'><b>$total7</b></div></td>";
echo "<td><div align='right'><b>$total8</b></div></td>";
echo "<td><div align='right'><b>$total6 &euro;</b></div></td>";
echo "<td><div align='right'><b>$total4 &euro;</b></div></td>";
echo "<td><div align='right'><b>$total5 &euro;</b></div></td>";
echo "<td><div align='right'><b>$total9 &euro;</b></div></td>";
echo "<td><div align='right'><b>$total10 &euro;</b></div></td></tr>";
echo "</table></center>";
?>
</body>
</html>
<?php
break;

case 22:

$anmoinun  = $annee - 1;
$anmoindeu  = $annee - 2;
?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Productivit&eacute; du Client <? echo "$code"; ?> en cumul&eacute; annuel</center></h3>
<br>
<center><input type="button" value="Impression de la Productivit&eacute;" onClick="imprime()">
<br><br>
<table width='100%' border='1'>
<tr> 
  <td width='18%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>H&ocirc;tels<center></b></div>
  </td>    
 <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nuit&eacute;es en <? echo "$annee"; ?><center></b></div>
  </td>   
 <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nuit&eacute;es en <? echo "$anmoinun"; ?><center></b></div>
  </td>   
  <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nuit&eacute;es en <? echo "$anmoindeu"; ?><center></b></div>
  </td>   
  <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Variations Nuit&eacute;es <? echo "$anmoinun/$annee"; ?><center></b></div>
  </td> 
  <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Variations Nuit&eacute;es <? echo "$anmoindeu/$annee"; ?><center></b></div>
  </td> 
   <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA en <? echo "$annee"; ?><center></b></div>
  </td> 
  <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA en <? echo "$anmoinun"; ?><center></b></div>
  </td>     
  <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CA en <? echo "$anmoindeu"; ?><center></b></div>
  </td> 
  <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Variations CA <? echo "$anmoinun/$annee"; ?><center></b></div>
  </td>  
  <td width='8%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Variations CA <? echo "$anmoindeu/$annee"; ?><center></b></div>
  </td> 
  </tr>
<?php
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
$nomdelabdd="statistique";       										// le nom de la Base de donn&eacute;es 
@mysql_select_db($nomdelabdd,$bdd);   			

$req_sel_hot = @mysql_query("SELECT *
						 	 FROM hotel
							 WHERE codehotel <> ''
							 ORDER BY nomhotel ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								

$req_sel = @mysql_db_query($nomdelabdd,"SELECT *
										FROM statistique
										WHERE codeclient=\"$code\"")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		

$req_cree = @mysql_db_query($nomdelabdd,"CREATE TEMPORARY TABLE tmp (
										 idtemp         int not null auto_increment,
										 codetablis     varchar(6),
										 catotal        varchar(10),
										 nuite          varchar(10),
										 annee          int(4),
										 PRIMARY KEY   (idtemp),
										 UNIQUE idtemp (idtemp))")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");

while($contenu = mysql_fetch_array($req_sel)) 								
{
$req_insert1 = @mysql_db_query($nomdelabdd,"INSERT INTO tmp (codetablis,catotal,nuite,annee)
										    VALUES (\"$contenu[codetablis]\",			
												    \"$contenu[catotal]\",
												    \"$contenu[nuite]\",
												    \"$contenu[annee]\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}

while ($val = mysql_fetch_array($req_sel_hot))
{
		$req_sel_1 = @mysql_query("SELECT SUM(catotal) AS catotal,SUM(nuite) AS nuite
						 	 	   FROM tmp
							 	   WHERE codetablis=\"$val[codehotel]\"
								   AND annee=\"$anmoinun\"
								   GROUP BY codetablis")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
		$val_1 = mysql_fetch_array($req_sel_1);
		$req_sel_2 = @mysql_query("SELECT SUM(catotal) AS catotal,SUM(nuite) AS nuite
						 	 	   FROM tmp
							 	   WHERE codetablis=\"$val[codehotel]\"
								   AND annee=\"$anmoindeu\"
								   GROUP BY codetablis")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
		$val_2 = mysql_fetch_array($req_sel_2);
		$req_sel_3 = @mysql_query("SELECT SUM(catotal) AS catotal,SUM(nuite) AS nuite
						 	 	   FROM tmp
							 	   WHERE codetablis=\"$val[codehotel]\"
								   AND annee=\"$annee\"
								   GROUP BY codetablis")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
		$val_3 = mysql_fetch_array($req_sel_3);
		// Arrondi a la virgule pres
		$val_1[catotal] = round($val_1[catotal]);
		$val_2[catotal] = round($val_2[catotal]);
		$val_3[catotal] = round($val_3[catotal]);
		// Calcul des variations		
		$nuiteun = $val_3[nuite] - $val_1[nuite];	
		$nuitedeu = $val_3[nuite] - $val_2[nuite];		
		$totalun = $val_3[catotal] - $val_1[catotal];
		$totaldeu = $val_3[catotal] - $val_2[catotal];	
		// Calcul des totaux
		$total1 = $val_1[nuite] + $total1;
		$total2 = $val_2[nuite] + $total2;
		$total3 = $val_3[nuite] + $total3;
		$total4 = $val_1[catotal] + $total4;
		$total5 = $val_2[catotal] + $total5;
		$total6 = $val_3[catotal] + $total6;
		$total7 = $nuiteun + $total7;
		$total8 = $nuitedeu + $total8;
		$total9 = $totalun + $total9;
		$total10 = $totaldeu + $total10;
		
		echo "<tr><td class=news>$val[nomhotel]</td>";
		if ($val_3[nuite] == NULL)
		{
		echo "<td><div align='center'>&nbsp;</div></td>";
		}
		else
			{
			echo "<td><div align='center'>$val_3[nuite]</div></td>";
			}		
		if ($val_1[nuite] == NULL)
		{
		echo "<td><div align='center'>&nbsp;</div></td>";
		}
		else
			{
			echo "<td><div align='center'>$val_1[nuite]</div></td>";
			}		
		if ($val_2[nuite] == NULL)
		{
		echo "<td><div align='center'>&nbsp;</div></td>";
		}
		else
			{
			echo "<td><div align='center'>$val_2[nuite]</div></td>";
			}		
		echo "<td><div align='right'><b>$nuiteun</b></div></td>";
		echo "<td><div align='right'><b>$nuitedeu</b></div></td>";
		if ($val_3[catotal] == NULL)
		{
		echo "<td><div align='center'>&nbsp;</div></td>";
		}
		else
			{
			echo "<td><div align='center'>$val_3[catotal] &euro;</div></td>";
			}				
	
		if ($val_1[catotal] == NULL)
		{
		echo "<td><div align='center'>&nbsp;</div></td>";
		}
		else
			{
			echo "<td><div align='center'>$val_1[catotal] &euro;</div></td>";
			}				
		if ($val_2[catotal] == NULL)
		{
		echo "<td><div align='center'>&nbsp;</div></td>";
		}
		else
			{
			echo "<td><div align='center'>$val_2[catotal] &euro;</div></td>";
			}				
		echo "<td><div align='right'><b>$totalun &euro;</b></div></td>";
		echo "<td><div align='right'><b>$totaldeu &euro;</b></div></td></tr>";
}
// Destruction de la table temporaire
$requete3 = @mysql_db_query($nomdelabdd,"DROP TABLE tmp")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
@mysql_close();	

echo "<tr><td><i>Total</i></td>";
echo "<td><div align='right'><b>$total3</b></div></td>";
echo "<td><div align='right'><b>$total1</b></div></td>";
echo "<td><div align='right'><b>$total2</b></div></td>";
echo "<td><div align='right'><b>$total7</b></div></td>";
echo "<td><div align='right'><b>$total8</b></div></td>";
echo "<td><div align='right'><b>$total6 &euro;</b></div></td>";
echo "<td><div align='right'><b>$total4 &euro;</b></div></td>";
echo "<td><div align='right'><b>$total5 &euro;</b></div></td>";
echo "<td><div align='right'><b>$total9 &euro;</b></div></td>";
echo "<td><div align='right'><b>$total10 &euro;</b></div></td></tr>";
echo "</table></center>";
?>
</body>
</html>
<?php
break;

case 23:

?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Interêts H&#244;tels</center></h3>
<br>
<center><input type="button" value="Impression des Interêts" onClick="imprime()"></center>
<br>
<table width="100%" border="1">
  <tr> 
    <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Code Client</b></div>
    </td>
   <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Nom Client</b></div>
    </td>
   <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>H&#244;tel *</b></div>
    </td>
   <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>H&#244;tel **</b></div>
    </td>
   <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>H&#244;tel ***</b></div>
    </td>
   <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>H&#244;tel ++++</b></div>
    </td>
   <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Individuel</b></div>
    </td>
   <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Appartement</b></div>
    </td>
   <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Chalet</b></div>
    </td>
    <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>MobileHome</b></div>
    </td>
    <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Groupe ponctuels</b></div>
    </td>
    <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Groupe en s&eacute;ries</b></div>
    </td>
    <td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Groupe d'adultes</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Groupe d'&eacute;tudiants</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Roscoff</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Orl&eacute;ans</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Aix</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Vannes</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Quimper</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>St Malo</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Brest</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Rennes</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Nantes</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Dol</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Lorient</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Le Mans</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Marseille</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Paris</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Dijon</b></div>
    </td>
	<td width="5%" bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Autres</b></div>
    </td>
  </tr>
<?php
$nomdelabdd="commercial";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es

$resultat = substr_count ($option,"interet");
if ( $resultat == 1 )
{
$requete = @mysql_db_query($nomdelabdd,"SELECT i.*,l.idclient AS codeclient,l.idcontact AS idcontact
					FROM interet i,liencontact l
					WHERE $option=1
					AND i.idcontact=l.idcontact")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$compteur = mysql_numrows($requete);
print "La recherche a donn&eacute; $compteur r&eacute;sultats.<br><br>";

while($val = mysql_fetch_array($requete)) 	
	{
	$requete1 = @mysql_db_query($nomdelabdd,"SELECT nomclient
			FROM client
			WHERE codeclient='$val[codeclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	
	$val1 = mysql_fetch_array($requete1);
	$requete2 = @mysql_db_query($nomdelabdd,"SELECT *
			FROM region
			WHERE idclient='$val[codeclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	
	$val2 = mysql_fetch_array($requete2);
	
	print "<tr><td class='anotation'><b><a class='menu' href=\"suivicontact.php?ok=Modif&code=$val[codeclient]&codecontact=$val[idcontact]\">$val[codeclient]</a></b></td>";
	print "<td class='anotation'>$val1[nomclient]</td>";

	if (@$val[uninteret] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[deuinteret] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[trointeret] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[plusinteret] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[individuinteret] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[indiapinteret] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[indichalinteret] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[indimobinteret] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[poncinteret] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[serinteret] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[adulinteret] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[etudinteret] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[rosregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[orleregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[aixregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[vanregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[quimregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[stmalregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[brestregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[renregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[nantregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[dolregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[lorregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[mansregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[marsregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[parisregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[dijonregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	
	if (@$val2[autreregion] <> NULL) { print "<td class='anotation'><center>$val2[autreregion]</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	
	print "</tr>";
	}
}
else
	{
	$requete = @mysql_db_query($nomdelabdd,"SELECT r.*
					FROM region r
					WHERE $option=1")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	while($val = mysql_fetch_array($requete)) 	
		{
	$requete1 = @mysql_db_query($nomdelabdd,"SELECT nomclient
			FROM client
			WHERE codeclient='$val[idclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	
	$val1 = mysql_fetch_array($requete1);
	$requete2 = @mysql_db_query($nomdelabdd,"SELECT i.*,l.*,i.idcontact AS numcontact
					FROM interet i,liencontact l
					WHERE i.idcontact=l.idcontact
					AND l.idclient='$val[idclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	
	$val2 = mysql_fetch_array($requete2);
	
	print "<tr><td class='anotation'><b><a class='menu' href=\"suivicontact.php?ok=Modif&code=$val[idclient]&codecontact=$val2[numcontact]\">$val[idclient]</a></b></td>";
	print "<td class='anotation'>$val1[nomclient]</td>";

	if (@$val2[uninteret] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[deuinteret] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[trointeret] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[plusinteret] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[individuinteret] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[indiapinteret] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[indichalinteret] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[indimobinteret] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[poncinteret] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[serinteret] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[adulinteret] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val2[etudinteret] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[rosregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[orleregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[aixregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[vanregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[quimregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[stmalregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[brestregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[renregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[nantregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[dolregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[lorregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[mansregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[marsregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[parisregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	if (@$val[dijonregion] == 1) { print "<td class='anotation'><center>X</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	
	if ($val[autreregion] <> NULL) { print "<td class='anotation'><center>$val[autreregion]</center></td>"; }
	else { print "<td class='anotation'></td>"; }
	
	print "</tr>";
		}
	}	

@mysql_close();
?>
</table>
</body>
</html>
<?phpbreak;

case 24:

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
$nomdelabdd="statistique";       										// le nom de la Base de donn&eacute;es 
@mysql_select_db($nomdelabdd,$bdd);   
			
if ($indice == 'T')
{
$req_sel = @mysql_db_query($nomdelabdd,"SELECT a.*,m.*,a.quantannul AS nuite,a.prixannul AS prix
																									FROM annulation a,motif m
																									WHERE a.idclient BETWEEN '950000' AND '990000'
																									AND a.idmotif=m.idmotif
																									AND a.annee=$an
																									ORDER BY a.idclient ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
}
else
	{
	$req_sel = @mysql_db_query($nomdelabdd,"SELECT a.*,m.*,a.quantannul AS nuite,a.prixannul AS prix
																									FROM annulation a,motif m
																									WHERE a.idclient BETWEEN '800000' AND '949999'
																									AND a.idmotif=m.idmotif
																									AND a.annee=$an
																									ORDER BY a.idclient ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
$nomdelabdd="commercial";       										// le nom de la Base de donn&eacute;es 
@mysql_select_db($nomdelabdd,$bdd);   

$req_cree = @mysql_db_query($nomdelabdd,"CREATE TEMPORARY TABLE tmp (
										 idtemp           int not null auto_increment,
										 codeclient     varchar(6),
										 idpays				 varchar(10),
										 idmotif				 varchar(10),
										 prix               varchar(10),
										 nuite             varchar(10),
										 mois             int(2),
										 PRIMARY KEY   (idtemp),
										 UNIQUE idtemp (idtemp))")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");

while($contenu = mysql_fetch_array($req_sel)) 								
{
// Regroupement pour les pays ou pour un seul pays
if ($pays == "tous")
{
$req_sel1 = @mysql_db_query($nomdelabdd,"SELECT c.*,p.*
										FROM client c,pays p
										WHERE c.idpays=p.idpays
										AND c.codeclient='$contenu[idclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	
}
else
{
$req_sel1 = @mysql_db_query($nomdelabdd,"SELECT c.*,p.*
										FROM client c,pays p
										WHERE c.idpays=p.idpays
										AND c.idpays=$pays
										AND c.codeclient='$contenu[idclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	
}
$contenu1 = mysql_fetch_array($req_sel1);

$req_sel11 = @mysql_db_query($nomdelabdd,"SELECT c.*,p.*
										FROM client c,pays p
										WHERE c.idpays=p.idpays
										AND c.codeclient='$contenu[idclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
$contenu11 = mysql_fetch_array($req_sel11);

$req_insert1 = @mysql_db_query($nomdelabdd,"INSERT INTO tmp (codeclient,idpays,idmotif,prix,nuite,mois)
										    VALUES (
										    		\"$contenu[idclient]\",
										    		 \"$contenu1[idpays]\",
										    		 \"$contenu[idmotif]\",
												    \"$contenu[prix]\",
												    \"$contenu[nuite]\",
												    \"$contenu[mois]\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}
?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Annulations H&#244;tels pour l'ann&eacute;e <? echo "$an"; ?></center></h3>
<center><input type="button" value="Impression des Annulations" onClick="imprime()"></center>
<br>
<table width="100%" border="1">
  <tr> 
    <td width="10"></td>
    <td><table width="100%" border=0><tr> 
    <td bgcolor='#FFFF9B' class='news' colspan="2" align='center'><b>Janvier</b></td>
    </tr><tr>
    <td width="50%" align=left>CA</td><td width="50%" align=right>#</td>
    </tr></table>
    </td>
    <td><table width="100%" border=0><tr> 
    <td bgcolor='#FFFF9B' class='news' colspan="2" align='center'><b>F&eacute;vrier</b></td>
    </tr><tr>
    <td width="50%" align=left>CA</td><td width="50%" align=right>#</td>
    </tr></table>
    </td>
    <td><table width="100%" border=0><tr> 
    <td bgcolor='#FFFF9B' class='news' colspan="2" align='center'><b>Mars</b></td>
    </tr><tr>
    <td width="50%" align=left>CA</td><td width="50%" align=right>#</td>
    </tr></table>
    </td>
    <td><table width="100%" border=0><tr> 
    <td bgcolor='#FFFF9B' class='news' colspan="2" align='center'><b>Avril</b></td>
    </tr><tr>
    <td width="50%" align=left>CA</td><td width="50%" align=right>#</td>
    </tr></table>
    </td>
    <td><table width="100%" border=0><tr> 
    <td bgcolor='#FFFF9B' class='news' colspan="2" align='center'><b>Mai</b></td>
    </tr><tr>
    <td width="50%" align=left>CA</td><td width="50%" align=right>#</td>
    </tr></table>
    </td>
    <td><table width="100%" border=0><tr> 
    <td bgcolor='#FFFF9B' class='news' colspan="2" align='center'><b>Juin</b></td>
    </tr><tr>
    <td width="50%" align=left>CA</td><td width="50%" align=right>#</td>
    </tr></table>
    </td>
    <td><table width="100%" border=0><tr> 
    <td bgcolor='#FFFF9B' class='news' colspan="2" align='center'><b>Juillet</b></td>
    </tr><tr>
    <td width="50%" align=left>CA</td><td width="50%" align=right>#</td>
    </tr></table>
    </td>
    <td><table width="100%" border=0><tr> 
    <td bgcolor='#FFFF9B' class='news' colspan="2" align='center'><b>Août</b></td>
    </tr><tr>
    <td width="50%" align=left>CA</td><td width="50%" align=right>#</td>
    </tr></table>
    </td>
    <td><table width="100%" border=0><tr> 
    <td bgcolor='#FFFF9B' class='news' colspan="2" align='center'><b>Septembre</b></td>
    </tr><tr>
    <td width="50%" align=left>CA</td><td width="50%" align=right>#</td>
    </tr></table>
    </td>
    <td><table width="100%" border=0><tr> 
    <td bgcolor='#FFFF9B' class='news' colspan="2" align='center'><b>Octobre</b></td>
    </tr><tr>
    <td width="50%" align=left>CA</td><td width="50%" align=right>#</td>
    </tr></table>
    </td>
    <td><table width="100%" border=0><tr> 
    <td bgcolor='#FFFF9B' class='news' colspan="2" align='center'><b>Novembre</b></td>
    </tr><tr>
    <td width="50%" align=left>CA</td><td width="50%" align=right>#</td>
    </tr></table>
    </td>
    <td><table width="100%" border=0><tr> 
    <td bgcolor='#FFFF9B' class='news' colspan="2" align='center'><b>D&eacute;cembre</b></td>
    </tr><tr>
    <td width="50%" align=left>CA</td><td width="50%" align=right>#</td>
    </tr></table>
    </td>
  </tr>
<?php
$req_sel2 = @mysql_db_query($nomdelabdd,"SELECT t.*,p.nompays,SUM(nuite) AS nuite,SUM(prix) AS prix
																									 FROM tmp t,pays p
																									 WHERE t.idpays=p.idpays
																									 GROUP BY p.idpays
																									 ORDER BY p.nompays ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");

while($val = mysql_fetch_array($req_sel2)) 	
{
echo "<tr>";
echo "<td>
$val[nompays]<br>
<div class=anotation>
- Sans suite<br>
- Trop chère<br>
- Evénement<br>
- Autres...
</div>
</td>";
// Cas pour Janvier, Février, Mars, Avril, ........
$req_sel3 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=1
																									 		AND idpays=$val[idpays]
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val3 = mysql_fetch_array($req_sel3);
if ($val3[prix] == NULL)
{
echo "<td align=center></td>";
}
else
	{
	$req_sel31 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=1
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=1
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val31 = mysql_fetch_array($req_sel31);
   $req_sel32 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=1
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=2
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val32 = mysql_fetch_array($req_sel32);
   $req_sel33 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=1
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=3
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val33 = mysql_fetch_array($req_sel33);
   $req_sel34 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=1
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=7
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val34 = mysql_fetch_array($req_sel34);
   $req_sel35 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=1
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=13
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val35 = mysql_fetch_array($req_sel35);
   $val3[prix] = $val3[prix]-$val34[prix];
   $val3[nuite] = $val3[nuite]-$val34[nuite];
	echo "<td><table width='100%'><tr><td align=left width='50%'>$val3[prix]<span class=anotation><br>$val31[prix]<br>$val32[prix]<br>$val33[prix]<br>$val35[prix]</span></td><td align=right width='50%'>$val3[nuite]<span class=anotation><br>$val31[nuite]<br>$val32[nuite]<br>$val33[nuite]<br>$val35[nuite]</span></td></table></td>";
	}

$req_sel4 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=2
																									 		AND idpays=$val[idpays]
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val4 = mysql_fetch_array($req_sel4);
if ($val4[prix] == NULL)
{
echo "<td align=center></td>";
}
else
	{
	$req_sel41 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=2
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=1
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val41 = mysql_fetch_array($req_sel41);
   $req_sel42 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=2
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=2
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val42 = mysql_fetch_array($req_sel42);
   $req_sel43 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=2
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=3
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val43 = mysql_fetch_array($req_sel43);
   $req_sel44 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=2
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=7
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val44 = mysql_fetch_array($req_sel44);
   $req_sel45 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=2
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=13
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val45 = mysql_fetch_array($req_sel45);
   $val4[prix] = $val4[prix]-$val44[prix];
   $val4[nuite] = $val4[nuite]-$val44[nuite];
   echo "<td><table width='100%'><tr><td align=left width='50%'>$val4[prix]<span class=anotation><br>$val41[prix]<br>$val42[prix]<br>$val43[prix]<br>$val45[prix]</span></td><td align=right width='50%'>$val4[nuite]<span class=anotation><br>$val41[nuite]<br>$val42[nuite]<br>$val43[nuite]<br>$val45[nuite]</span></td></table></td>";
	}
	
$req_sel5 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=3
																									 		AND idpays=$val[idpays]
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val5 = mysql_fetch_array($req_sel5);
if ($val5[prix] == NULL)
{
echo "<td align=center></td>";
}
else
	{
	$req_sel51 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=3
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=1
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val51 = mysql_fetch_array($req_sel51);
   $req_sel52 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=3
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=2
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val52 = mysql_fetch_array($req_sel52);
   $req_sel53 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=3
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=3
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val53 = mysql_fetch_array($req_sel53);
   $req_sel54 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=3
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=7
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val54 = mysql_fetch_array($req_sel54);
   $req_sel55 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=3
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=13
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val55 = mysql_fetch_array($req_sel55);
   $val5[prix] = $val5[prix]-$val54[prix];
   $val5[nuite] = $val5[nuite]-$val54[nuite];
   echo "<td><table width='100%'><tr><td align=left width='50%'>$val5[prix]<span class=anotation><br>$val51[prix]<br>$val52[prix]<br>$val53[prix]<br>$val55[prix]</span></td><td align=right width='50%'>$val5[nuite]<span class=anotation><br>$val51[nuite]<br>$val52[nuite]<br>$val53[nuite]<br>$val55[nuite]</span></td></table></td>";
   }

$req_sel6 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=4
																									 		AND idpays=$val[idpays]
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val6 = mysql_fetch_array($req_sel6);
if ($val6[prix] == NULL)
{
echo "<td align=center></td>";
}
else
	{
	$req_sel61 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=4
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=1
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val61 = mysql_fetch_array($req_sel61);
   $req_sel62 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=4
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=2
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val62 = mysql_fetch_array($req_sel62);
   $req_sel63 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=4
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=3
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val63 = mysql_fetch_array($req_sel63);
   $req_sel64 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=4
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=7
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val64 = mysql_fetch_array($req_sel64);
   $req_sel65 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=4
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=13
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val65 = mysql_fetch_array($req_sel65);
   $val6[prix] = $val6[prix]-$val64[prix];
   $val6[nuite] = $val6[nuite]-$val64[nuite];
   echo "<td><table width='100%'><tr><td align=left width='50%'>$val6[prix]<span class=anotation><br>$val61[prix]<br>$val62[prix]<br>$val63[prix]<br>$val65[prix]</span></td><td align=right width='50%'>$val6[nuite]<span class=anotation><br>$val61[nuite]<br>$val62[nuite]<br>$val63[nuite]<br>$val65[nuite]</span></td></table></td>";
   }

$req_sel7 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=5
																									 		AND idpays=$val[idpays]
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val7 = mysql_fetch_array($req_sel7);
if ($val7[prix] == NULL)
{
echo "<td align=center></td>";
}
else
	{
	$req_sel71 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=5
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=1
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val71 = mysql_fetch_array($req_sel71);
   $req_sel72 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=5
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=2
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val72 = mysql_fetch_array($req_sel72);
   $req_sel73 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=5
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=3
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val73 = mysql_fetch_array($req_sel73);
   $req_sel74 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=5
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=7
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val74 = mysql_fetch_array($req_sel74);
   $req_sel75 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=5
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=13
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val75 = mysql_fetch_array($req_sel75);
   $val7[prix] = $val7[prix]-$val74[prix];
   $val7[nuite] = $val7[nuite]-$val74[nuite];
   echo "<td><table width='100%'><tr><td align=left width='50%'>$val7[prix]<span class=anotation><br>$val71[prix]<br>$val72[prix]<br>$val73[prix]<br>$val75[prix]</span></td><td align=right width='50%'>$val7[nuite]<span class=anotation><br>$val71[nuite]<br>$val72[nuite]<br>$val73[nuite]<br>$val75[nuite]</span></td></table></td>";
   }

$req_sel8 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=6
																									 		AND idpays=$val[idpays]
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val8 = mysql_fetch_array($req_sel8);
if ($val8[prix] == NULL)
{
echo "<td align=center></td>";
}
else
	{
	$req_sel81 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=6
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=1
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val81 = mysql_fetch_array($req_sel81);
   $req_sel82 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=6
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=2
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val82 = mysql_fetch_array($req_sel82);
   $req_sel83 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=6
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=3
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val83 = mysql_fetch_array($req_sel83);
   $req_sel84 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=6
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=7
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val84 = mysql_fetch_array($req_sel84);
   $req_sel85 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=6
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=13
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val85 = mysql_fetch_array($req_sel85);
   $val8[prix] = $val8[prix]-$val84[prix];
   $val8[nuite] = $val8[nuite]-$val84[nuite];
   echo "<td><table width='100%'><tr><td align=left width='50%'>$val8[prix]<span class=anotation><br>$val81[prix]<br>$val82[prix]<br>$val83[prix]<br>$val85[prix]</span></td><td align=right width='50%'>$val8[nuite]<span class=anotation><br>$val81[nuite]<br>$val82[nuite]<br>$val83[nuite]<br>$val85[nuite]</span></td></table></td>";
   }

$req_sel9 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=7
																									 		AND idpays=$val[idpays]
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val9 = mysql_fetch_array($req_sel9);
if ($val9[prix] == NULL)
{
echo "<td align=center></td>";
}
else
	{
	$req_sel91 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=7
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=1
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val91 = mysql_fetch_array($req_sel91);
   $req_sel92 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=7
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=2
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val92 = mysql_fetch_array($req_sel92);
   $req_sel93 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=7
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=3
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val93 = mysql_fetch_array($req_sel93);
   $req_sel94 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=7
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=7
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val94 = mysql_fetch_array($req_sel94);
   $req_sel95 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=7
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=13
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val95 = mysql_fetch_array($req_sel95);
   $val9[prix] = $val9[prix]-$val94[prix];
   $val9[nuite] = $val9[nuite]-$val94[nuite];
   echo "<td><table width='100%'><tr><td align=left width='50%'>$val9[prix]<span class=anotation><br>$val91[prix]<br>$val92[prix]<br>$val93[prix]<br>$val95[prix]</span></td><td align=right width='50%'>$val9[nuite]<span class=anotation><br>$val91[nuite]<br>$val92[nuite]<br>$val93[nuite]<br>$val95[nuite]</span></td></table></td>";
   }

$req_sel10 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=8
																									 		AND idpays=$val[idpays]
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val10 = mysql_fetch_array($req_sel10);
if ($val10[prix] == NULL)
{
echo "<td align=center></td>";
}
else
	{
	$req_sel101 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=8
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=1
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val101 = mysql_fetch_array($req_sel101);
   $req_sel102 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=8
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=2
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val102 = mysql_fetch_array($req_sel102);
   $req_sel103 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=8
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=3
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val103 = mysql_fetch_array($req_sel103);
   $req_sel104 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=8
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=7
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val104 = mysql_fetch_array($req_sel104);
   $req_sel105 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=8
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=13
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val105 = mysql_fetch_array($req_sel105);
   $val10[prix] = $val10[prix]-$val104[prix];
   $val10[nuite] = $val10[nuite]-$val104[nuite];
   echo "<td><table width='100%'><tr><td align=left width='50%'>$val10[prix]<span class=anotation><br>$val101[prix]<br>$val102[prix]<br>$val103[prix]<br>$val105[prix]</span></td><td align=right width='50%'>$val10[nuite]<span class=anotation><br>$val101[nuite]<br>$val102[nuite]<br>$val103[nuite]<br>$val105[nuite]</span></td></table></td>";
   }

$req_sel11 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=9
																									 		AND idpays=$val[idpays]
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val11 = mysql_fetch_array($req_sel11);
if ($val11[prix] == NULL)
{
echo "<td align=center></td>";
}
else
	{
	$req_sel111 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=9
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=1
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val111 = mysql_fetch_array($req_sel111);
   $req_sel112 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=9
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=2
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val112 = mysql_fetch_array($req_sel112);
   $req_sel113 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=9
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=3
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val113 = mysql_fetch_array($req_sel113);
   $req_sel114 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=9
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=7
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val114 = mysql_fetch_array($req_sel114);
   $req_sel115 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=9
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=13
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val115 = mysql_fetch_array($req_sel115);
   $val11[prix] = $val11[prix]-$val114[prix];
   $val11[nuite] = $val11[nuite]-$val114[nuite];
   echo "<td><table width='100%'><tr><td align=left width='50%'>$val11[prix]<span class=anotation><br>$val111[prix]<br>$val112[prix]<br>$val113[prix]<br>$val115[prix]</span></td><td align=right width='50%'>$val11[nuite]<span class=anotation><br>$val111[nuite]<br>$val112[nuite]<br>$val113[nuite]<br>$val115[nuite]</span></td></table></td>";
   }

$req_sel12 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=10
																									 		AND idpays=$val[idpays]
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val12 = mysql_fetch_array($req_sel12);
if ($val12[prix] == NULL)
{
echo "<td align=center></td>";
}
else
	{
	$req_sel121 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=10
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=1
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val121 = mysql_fetch_array($req_sel121);
   $req_sel122 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=10
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=2
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val122 = mysql_fetch_array($req_sel122);
   $req_sel123 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=10
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=3
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val123 = mysql_fetch_array($req_sel123);
   $req_sel124 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=10
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=7
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val124 = mysql_fetch_array($req_sel124);
   $req_sel125 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=10
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=13
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val125 = mysql_fetch_array($req_sel125);
   $val12[prix] = $val12[prix]-$val124[prix];
   $val12[nuite] = $val12[nuite]-$val124[nuite];
   echo "<td><table width='100%'><tr><td align=left width='50%'>$val12[prix]<span class=anotation><br>$val121[prix]<br>$val122[prix]<br>$val123[prix]<br>$val125[prix]</span></td><td align=right width='50%'>$val12[nuite]<span class=anotation><br>$val121[nuite]<br>$val122[nuite]<br>$val123[nuite]<br>$val125[nuite]</span></td></table></td>";
   }

$req_sel13 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=11
																									 		AND idpays=$val[idpays]
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val13 = mysql_fetch_array($req_sel13);
if ($val13[prix] == NULL)
{
echo "<td align=center></td>";
}
else
	{
	$req_sel131 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=11
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=1
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val131 = mysql_fetch_array($req_sel131);
   $req_sel132 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=11
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=2
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val132 = mysql_fetch_array($req_sel132);
   $req_sel133 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=11
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=3
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val133 = mysql_fetch_array($req_sel133);
   $req_sel134 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=11
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=7
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val134 = mysql_fetch_array($req_sel134);
   $req_sel135 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=11
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=13
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val135 = mysql_fetch_array($req_sel135);
   $val13[prix] = $val13[prix]-$val134[prix];
   $val13[nuite] = $val13[nuite]-$val134[nuite];
   echo "<td><table width='100%'><tr><td align=left width='50%'>$val13[prix]<span class=anotation><br>$val131[prix]<br>$val132[prix]<br>$val133[prix]<br>$val135[prix]</span></td><td align=right width='50%'>$val13[nuite]<span class=anotation><br>$val131[nuite]<br>$val132[nuite]<br>$val133[nuite]<br>$val135[nuite]</span></td></table></td>";
   }

$req_sel14 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=12
																									 		AND idpays=$val[idpays]
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val14 = mysql_fetch_array($req_sel14);
if ($val14[prix] == NULL)
{
echo "<td align=center></td>";
}
else
	{
	$req_sel141 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=12
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=1
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val141 = mysql_fetch_array($req_sel141);
   $req_sel142 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=12
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=2
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val142 = mysql_fetch_array($req_sel142);
   $req_sel143 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=12
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=3
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val143 = mysql_fetch_array($req_sel143);
   $req_sel144 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=12
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=7
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val144 = mysql_fetch_array($req_sel144);
   $req_sel145 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(prix) AS prix,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=12
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=13
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val145 = mysql_fetch_array($req_sel145);
   $val14[prix] = $val14[prix]-$val144[prix];
   $val14[nuite] = $val14[nuite]-$val144[nuite];
   echo "<td><table width='100%'><tr><td align=left width='50%'>$val14[prix]<span class=anotation><br>$val141[prix]<br>$val142[prix]<br>$val143[prix]<br>$val145[prix]</span></td><td align=right width='50%'>$val14[nuite]<span class=anotation><br>$val141[nuite]<br>$val142[nuite]<br>$val143[nuite]<br>$val145[nuite]</span></td></table></td>";
   }

echo "</tr>";

$prixtotal1 = $val3[prix]+$prixtotal1;
$prixtotal2 = $val4[prix]+$prixtotal2;
$prixtotal3 = $val5[prix]+$prixtotal3;
$prixtotal4 = $val6[prix]+$prixtotal4;
$prixtotal5 = $val7[prix]+$prixtotal5;
$prixtotal6 = $val8[prix]+$prixtotal6;
$prixtotal7 = $val9[prix]+$prixtotal7;
$prixtotal8 = $val10[prix]+$prixtotal8;
$prixtotal9 = $val11[prix]+$prixtotal9;
$prixtotal10 = $val12[prix]+$prixtotal10;
$prixtotal11 = $val13[prix]+$prixtotal11;
$prixtotal12 = $val14[prix]+$prixtotal12;

$nuitetotal1 = $val3[nuite]+$nuitetotal1;
$nuitetotal2 = $val4[nuite]+$nuitetotal2;
$nuitetotal3 = $val5[nuite]+$nuitetotal3;
$nuitetotal4 = $val6[nuite]+$nuitetotal4;
$nuitetotal5 = $val7[nuite]+$nuitetotal5;
$nuitetotal6 = $val8[nuite]+$nuitetotal6;
$nuitetotal7 = $val9[nuite]+$nuitetotal7;
$nuitetotal8 = $val10[nuite]+$nuitetotal8;
$nuitetotal9 = $val11[nuite]+$nuitetotal9;
$nuitetotal10 = $val12[nuite]+$nuitetotal10;
$nuitetotal11 = $val13[nuite]+$nuitetotal11;
$nuitetotal12 = $val14[nuite]+$nuitetotal12;
}

echo "<tr><td bgcolor='#FFFF9B' class='news'>TOTAL</td>
<td align=center class=anotation>$prixtotal1 $nuitetotal1</td>
<td align=center class=anotation>$prixtotal2 $nuitetotal2</td>
<td align=center class=anotation>$prixtotal3 $nuitetotal3</td>
<td align=center class=anotation>$prixtotal4 $nuitetotal4</td>
<td align=center class=anotation>$prixtotal5 $nuitetotal5</td>
<td align=center class=anotation>$prixtotal6 $nuitetotal6</td>
<td align=center class=anotation>$prixtotal7 $nuitetotal7</td>
<td align=center class=anotation>$prixtotal8 $nuitetotal8</td>
<td align=center class=anotation>$prixtotal9 $nuitetotal9</td>
<td align=center class=anotation>$prixtotal10 $nuitetotal10</td>
<td align=center class=anotation>$prixtotal11 $nuitetotal11</td>
<td align=center class=anotation>$prixtotal12 $nuitetotal12</td>
</tr>";

// Destruction de la table temporaire
$req_del = @mysql_db_query($nomdelabdd,"DROP TABLE tmp")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
@mysql_close();	
?>
</table>
</body>
</html>
<?phpbreak;

case 25:

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
$nomdelabdd="statistique";       										// le nom de la Base de donn&eacute;es 
@mysql_select_db($nomdelabdd,$bdd);   
			
if ($indice == 'T')
{
$req_sel = @mysql_db_query($nomdelabdd,"SELECT r.*,m.*,r.chambre_refus AS nuite
																									FROM refus r,motif m
																									WHERE r.idclient BETWEEN '950000' AND '990000'
																									AND r.idmotif=m.idmotif
																									AND r.annee_ref=$an
																									ORDER BY r.idclient ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
}
else
	{
	$req_sel = @mysql_db_query($nomdelabdd,"SELECT r.*,m.*,r.chambre_refus AS nuite
																									FROM refus r,motif m
																									WHERE r.idclient BETWEEN '800000' AND '949999'
																									AND r.idmotif=m.idmotif
																									AND r.annee_ref=$an
																									ORDER BY r.idclient ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}

$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
$nomdelabdd="commercial";       										// le nom de la Base de donn&eacute;es 
@mysql_select_db($nomdelabdd,$bdd);   

$req_cree = @mysql_db_query($nomdelabdd,"CREATE TEMPORARY TABLE tmp (
										 idtemp           int not null auto_increment,
										 codeclient     varchar(6),
										 idpays				 varchar(10),
										 idmotif				 varchar(10),
										 nuite             varchar(10),
										 mois             int(2),
										 PRIMARY KEY   (idtemp),
										 UNIQUE idtemp (idtemp))")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");

while($contenu = mysql_fetch_array($req_sel)) 								
{
// Regroupement pour les pays ou pour un seul pays
if ($pays == "tous")
{
$req_sel1 = @mysql_db_query($nomdelabdd,"SELECT c.*,p.*
										FROM client c,pays p
										WHERE c.idpays=p.idpays
										AND c.codeclient='$contenu[idclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	
}
else
{
$req_sel1 = @mysql_db_query($nomdelabdd,"SELECT c.*,p.*
										FROM client c,pays p
										WHERE c.idpays=p.idpays
										AND c.idpays=$pays
										AND c.codeclient='$contenu[idclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");	
}
$contenu1 = mysql_fetch_array($req_sel1);

$req_sel11 = @mysql_db_query($nomdelabdd,"SELECT c.*,p.*
										FROM client c,pays p
										WHERE c.idpays=p.idpays
										AND c.codeclient='$contenu[idclient]'")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
$contenu11 = mysql_fetch_array($req_sel11);

$req_insert1 = @mysql_db_query($nomdelabdd,"INSERT INTO tmp (codeclient,idpays,idmotif,nuite,mois)
										    VALUES (
										    		\"$contenu[idclient]\",
										    		 \"$contenu1[idpays]\",
										    		 \"$contenu[idmotif]\",
												    \"$contenu[nuite]\",
												    \"$contenu[mois]\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}
?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Refus H&#244;tels pour l'ann&eacute;e <? echo "$an"; ?></center></h3>
<center><input type="button" value="Impression des Refus" onClick="imprime()"></center>
<br>
<table width="100%" border="1">
  <tr> 
    <td width=10></td>
    <td bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Janvier</b><br>
      #</div>
    </td>
   <td bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>F&eacute;vrier</b><br>
      #</div>
    </td>
   <td bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Mars</b><br>
      #</div>
    </td>
   <td bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Avril</b><br>
      #</div>
    </td>
   <td bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Mai</b><br>
      #</div>
    </td>
   <td bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Juin</b><br>
      #</div>
    </td>
   <td bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Juillet</b><br>
      #</div>
    </td>
   <td bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Août</b><br>
      #</div>
    </td>
   <td bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Septembre</b><br>
      #</div>
    </td>
    <td bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Octobre</b><br>
      #</div>
    </td>
    <td bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Novembre</b><br>
      #</div>
    </td>
    <td bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>D&eacute;cembre</b><br>
      #</div>
    </td>
  </tr>
<?php
$req_sel2 = @mysql_db_query($nomdelabdd,"SELECT t.*,p.nompays,SUM(nuite) AS nuite
																									 FROM tmp t,pays p
																									 WHERE t.idpays=p.idpays
																									 GROUP BY p.idpays
																									 ORDER BY p.nompays ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");

while($val = mysql_fetch_array($req_sel2)) 	
{
echo "<tr>";
echo "<td>
$val[nompays]<br>
<div class=anotation>
- Mauvais payeur<br>
- Indésirable<br>
- Complet<br>
- Autres...
</div>
</td>";
// Cas pour Janvier, Février, Mars, Avril, ........
$req_sel3 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=1
																									 		AND idpays=$val[idpays]
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val3 = mysql_fetch_array($req_sel3);
if ($val3[nuite] == NULL)
{
echo "<td align=center></td>";
}
else
	{
	$req_sel31 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=1
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=11
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val31 = mysql_fetch_array($req_sel31);
   $req_sel32 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=1
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=10
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val32 = mysql_fetch_array($req_sel32);
   $req_sel33 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=1
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=9
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val33 = mysql_fetch_array($req_sel33);
   $req_sel34 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=1
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=14
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val34 = mysql_fetch_array($req_sel34);
   $req_sel35 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=1
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=12
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val35 = mysql_fetch_array($req_sel35);
   $val3[nuite] = $val3[nuite]-$val33[nuite];
	echo "<td align=center>$val3[nuite]<br><span class=anotation>$val31[nuite]</span><br><span class=anotation>$val32[nuite]</span><br><span class=anotation>$val34[nuite]</span><br><span class=anotation>$val35[nuite]</span></td>";
	}

$req_sel4 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=2
																									 		AND idpays=$val[idpays]
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val4 = mysql_fetch_array($req_sel4);
if ($val4[nuite] == NULL)
{
echo "<td align=center></td>";
}
else
	{
	$req_sel41 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=2
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=11
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val41 = mysql_fetch_array($req_sel41);
   $req_sel42 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=2
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=10
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val42 = mysql_fetch_array($req_sel42);
   $req_sel43 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=2
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=9
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val43 = mysql_fetch_array($req_sel43);
   $req_sel44 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=2
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=14
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val44 = mysql_fetch_array($req_sel44);
   $req_sel45 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=2
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=12
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val45 = mysql_fetch_array($req_sel45);
   $val4[nuite] = $val4[nuite]-$val43[nuite];
	echo "<td align=center>$val4[nuite]<br><span class=anotation>$val41[nuite]</span><br><span class=anotation>$val42[nuite]</span><br><span class=anotation>$val44[nuite]</span><br><span class=anotation>$val45[nuite]</span></td>";
	}
	
$req_sel5 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=3
																									 		AND idpays=$val[idpays]
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val5 = mysql_fetch_array($req_sel5);
if ($val5[nuite] == NULL)
{
echo "<td align=center></td>";
}
else
	{
	$req_sel51 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=3
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=11
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val51 = mysql_fetch_array($req_sel51);
   $req_sel52 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=3
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=10
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val52 = mysql_fetch_array($req_sel52);
   $req_sel53 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=3
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=9
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val53 = mysql_fetch_array($req_sel53);
   $req_sel54 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=3
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=14
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val54 = mysql_fetch_array($req_sel54);
   $req_sel55 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=3
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=12
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val55 = mysql_fetch_array($req_sel55);
   $val5[nuite] = $val5[nuite]-$val53[nuite];
	echo "<td align=center>$val5[nuite]<br><span class=anotation>$val51[nuite]</span><br><span class=anotation>$val52[nuite]</span><br><span class=anotation>$val54[nuite]</span><br><span class=anotation>$val55[nuite]</span></td>";
	}

$req_sel6 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=4
																									 		AND idpays=$val[idpays]
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val6 = mysql_fetch_array($req_sel6);
if ($val6[nuite] == NULL)
{
echo "<td align=center></td>";
}
else
	{
	$req_sel61 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=4
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=11
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val61 = mysql_fetch_array($req_sel61);
   $req_sel62 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=4
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=10
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val62 = mysql_fetch_array($req_sel62);
   $req_sel63 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=4
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=9
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val63 = mysql_fetch_array($req_sel63);
   $req_sel64 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=4
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=14
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val64 = mysql_fetch_array($req_sel64);
   $req_sel65 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=4
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=12
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val65 = mysql_fetch_array($req_sel65);
   $val6[nuite] = $val6[nuite]-$val63[nuite];
	echo "<td align=center>$val6[nuite]<br><span class=anotation>$val61[nuite]</span><br><span class=anotation>$val62[nuite]</span><br><span class=anotation>$val64[nuite]</span><br><span class=anotation>$val65[nuite]</span></td>";
	}

$req_sel7 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=5
																									 		AND idpays=$val[idpays]
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val7 = mysql_fetch_array($req_sel7);
if ($val7[nuite] == NULL)
{
echo "<td align=center></td>";
}
else
	{
	$req_sel71 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=5
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=11
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val71 = mysql_fetch_array($req_sel71);
   $req_sel72 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=5
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=10
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val72 = mysql_fetch_array($req_sel72);
   $req_sel73 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=5
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=9
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val73 = mysql_fetch_array($req_sel73);
   $req_sel74 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=5
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=14
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val74 = mysql_fetch_array($req_sel74);
   $req_sel75 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=5
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=12
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val75 = mysql_fetch_array($req_sel75);
   $val7[nuite] = $val7[nuite]-$val73[nuite];
	echo "<td align=center>$val7[nuite]<br><span class=anotation>$val71[nuite]</span><br><span class=anotation>$val72[nuite]</span><br><span class=anotation>$val74[nuite]</span><br><span class=anotation>$val75[nuite]</span></td>";
	}

$req_sel8 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=6
																									 		AND idpays=$val[idpays]
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val8 = mysql_fetch_array($req_sel8);
if ($val8[nuite] == NULL)
{
echo "<td align=center></td>";
}
else
	{
	$req_sel81 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=6
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=11
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val81 = mysql_fetch_array($req_sel81);
   $req_sel82 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=6
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=10
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val82 = mysql_fetch_array($req_sel82);
   $req_sel83 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=6
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=9
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val83 = mysql_fetch_array($req_sel83);
   $req_sel84 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=6
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=14
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val84 = mysql_fetch_array($req_sel84);
   $req_sel85 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=6
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=12
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val85 = mysql_fetch_array($req_sel85);
   $val8[nuite] = $val8[nuite]-$val83[nuite];
	echo "<td align=center>$val8[nuite]<br><span class=anotation>$val81[nuite]</span><br><span class=anotation>$val82[nuite]</span><br><span class=anotation>$val84[nuite]</span><br><span class=anotation>$val85[nuite]</span></td>";
	}

$req_sel9 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=7
																									 		AND idpays=$val[idpays]
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val9 = mysql_fetch_array($req_sel9);
if ($val9[nuite] == NULL)
{
echo "<td align=center></td>";
}
else
	{
	$req_sel91 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=7
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=11
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val91 = mysql_fetch_array($req_sel91);
   $req_sel92 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=7
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=10
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val92 = mysql_fetch_array($req_sel92);
   $req_sel93 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=7
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=9
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val93 = mysql_fetch_array($req_sel93);
   $req_sel94 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=7
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=14
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val94 = mysql_fetch_array($req_sel94);
   $req_sel95 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=7
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=12
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val95 = mysql_fetch_array($req_sel95);
   $val9[nuite] = $val9[nuite]-$val93[nuite];
	echo "<td align=center>$val9[nuite]<br><span class=anotation>$val91[nuite]</span><br><span class=anotation>$val92[nuite]</span><br><span class=anotation>$val94[nuite]</span><br><span class=anotation>$val95[nuite]</span></td>";
	}

$req_sel10 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=8
																									 		AND idpays=$val[idpays]
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val10 = mysql_fetch_array($req_sel10);
if ($val10[nuite] == NULL)
{
echo "<td align=center></td>";
}
else
	{
	$req_sel101 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=8
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=11
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val101 = mysql_fetch_array($req_sel101);
   $req_sel102 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=8
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=10
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val102 = mysql_fetch_array($req_sel102);
   $req_sel103 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=8
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=9
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val103 = mysql_fetch_array($req_sel103);
   $req_sel104 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=8
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=14
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val104 = mysql_fetch_array($req_sel104);
   $req_sel105 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=8
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=12
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val105 = mysql_fetch_array($req_sel105);
   $val10[nuite] = $val10[nuite]-$val103[nuite];
	echo "<td align=center>$val10[nuite]<br><span class=anotation>$val101[nuite]</span><br><span class=anotation>$val102[nuite]</span><br><span class=anotation>$val104[nuite]</span><br><span class=anotation>$val105[nuite]</span></td>";
	}

$req_sel11 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=9
																									 		AND idpays=$val[idpays]
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val11 = mysql_fetch_array($req_sel11);
if ($val11[nuite] == NULL)
{
echo "<td align=center></td>";
}
else
	{
	$req_sel111 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=9
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=11
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val111 = mysql_fetch_array($req_sel111);
   $req_sel112 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=9
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=10
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val112 = mysql_fetch_array($req_sel112);
   $req_sel113 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=9
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=9
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val113 = mysql_fetch_array($req_sel113);
   $req_sel114 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=9
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=14
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val114 = mysql_fetch_array($req_sel114);
   $req_sel115 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=9
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=12
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val115 = mysql_fetch_array($req_sel115);
   $val11[nuite] = $val11[nuite]-$val113[nuite];
	echo "<td align=center>$val11[nuite]<br><span class=anotation>$val111[nuite]</span><br><span class=anotation>$val112[nuite]</span><br><span class=anotation>$val114[nuite]</span><br><span class=anotation>$val115[nuite]</span></td>";
	}

$req_sel12 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=10
																									 		AND idpays=$val[idpays]
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val12 = mysql_fetch_array($req_sel12);
if ($val12[nuite] == NULL)
{
echo "<td align=center></td>";
}
else
	{
	$req_sel121 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=10
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=11
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val121 = mysql_fetch_array($req_sel121);
   $req_sel122 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=10
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=10
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val122 = mysql_fetch_array($req_sel122);
   $req_sel123 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=10
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=9
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val123 = mysql_fetch_array($req_sel123);
   $req_sel124 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=10
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=14
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val124 = mysql_fetch_array($req_sel124);
   $req_sel125 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=10
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=12
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val125 = mysql_fetch_array($req_sel125);
   $val12[nuite] = $val12[nuite]-$val123[nuite];
	echo "<td align=center>$val12[nuite]<br><span class=anotation>$val121[nuite]</span><br><span class=anotation>$val122[nuite]</span><br><span class=anotation>$val124[nuite]</span><br><span class=anotation>$val125[nuite]</span></td>";
	}

$req_sel13 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=11
																									 		AND idpays=$val[idpays]
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val13 = mysql_fetch_array($req_sel13);
if ($val13[nuite] == NULL)
{
echo "<td align=center></td>";
}
else
	{
	$req_sel131 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=11
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=11
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val131 = mysql_fetch_array($req_sel131);
   $req_sel132 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=11
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=10
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val132 = mysql_fetch_array($req_sel132);
   $req_sel133 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=11
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=9
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val133 = mysql_fetch_array($req_sel133);
   $req_sel134 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=11
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=14
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val134 = mysql_fetch_array($req_sel134);
   $req_sel135 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=11
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=12
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val135 = mysql_fetch_array($req_sel135);
   $val13[nuite] = $val13[nuite]-$val133[nuite];
	echo "<td align=center>$val13[nuite]<br><span class=anotation>$val131[nuite]</span><br><span class=anotation>$val132[nuite]</span><br><span class=anotation>$val134[nuite]</span><br><span class=anotation>$val135[nuite]</span></td>";
	}

$req_sel14 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=12
																									 		AND idpays=$val[idpays]
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$val14 = mysql_fetch_array($req_sel14);
if ($val14[nuite] == NULL)
{
echo "<td align=center></td>";
}
else
	{
	$req_sel141 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=12
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=11
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val141 = mysql_fetch_array($req_sel141);
   $req_sel142 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=12
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=10
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val142 = mysql_fetch_array($req_sel142);
   $req_sel143 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=12
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=9
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val143 = mysql_fetch_array($req_sel143);
   $req_sel144 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=12
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=14
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val144 = mysql_fetch_array($req_sel144);
   $req_sel145 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(nuite) AS nuite
																									 		FROM tmp
																									 		WHERE mois=12
																									 		AND idpays=$val[idpays]
																									 		AND idmotif=12
																									 		GROUP BY idpays")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
   $val145 = mysql_fetch_array($req_sel145);
   $val14[nuite] = $val14[nuite]-$val143[nuite];
	echo "<td align=center>$val14[nuite]<br><span class=anotation>$val141[nuite]</span><br><span class=anotation>$val142[nuite]</span><br><span class=anotation>$val144[nuite]</span><br><span class=anotation>$val145[nuite]</span></td>";
	}

echo "</tr>";

$nuitetotal1 = $val3[nuite]+$nuitetotal1;
$nuitetotal2 = $val4[nuite]+$nuitetotal2;
$nuitetotal3 = $val5[nuite]+$nuitetotal3;
$nuitetotal4 = $val6[nuite]+$nuitetotal4;
$nuitetotal5 = $val7[nuite]+$nuitetotal5;
$nuitetotal6 = $val8[nuite]+$nuitetotal6;
$nuitetotal7 = $val9[nuite]+$nuitetotal7;
$nuitetotal8 = $val10[nuite]+$nuitetotal8;
$nuitetotal9 = $val11[nuite]+$nuitetotal9;
$nuitetotal10 = $val12[nuite]+$nuitetotal10;
$nuitetotal11 = $val13[nuite]+$nuitetotal11;
$nuitetotal12 = $val14[nuite]+$nuitetotal12;
}

echo "<tr><td bgcolor='#FFFF9B' class='news'>TOTAL</td>
<td align=center class=anotation>$nuitetotal1</td>
<td align=center class=anotation>$nuitetotal2</td>
<td align=center class=anotation>$nuitetotal3</td>
<td align=center class=anotation>$nuitetotal4</td>
<td align=center class=anotation>$nuitetotal5</td>
<td align=center class=anotation>$nuitetotal6</td>
<td align=center class=anotation>$nuitetotal7</td>
<td align=center class=anotation>$nuitetotal8</td>
<td align=center class=anotation>$nuitetotal9</td>
<td align=center class=anotation>$nuitetotal10</td>
<td align=center class=anotation>$nuitetotal11</td>
<td align=center class=anotation>$nuitetotal12</td>
</tr>";

// Destruction de la table temporaire
$req_del = @mysql_db_query($nomdelabdd,"DROP TABLE tmp")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
@mysql_close();	
?>
</table>
</body>
</html>
<?break;

case 26:

$annee = date("Y");
$mois = date("m");
$anmoin = $annee - 1;
?>
<center><input type="button" value="Impression des Prospects" onClick="imprime()"></center>
<br>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<div class='titre'><center>Les Prospects...</center></div>
<center>
<table width='80%' border='1'>
<tr> 
	<td width='10%' bgcolor='#FFFF9B' class='news'> 
    <div align='center'><b>Code Postal<center></b></div>
  	</td>    
	<td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Code du Client<center></b></div>
  	</td>    
 	<td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nom du Client<center></b></div>
  	</td> 
  	</tr>
    <tr>
<?php
$nomdelabdd="commercial";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es

if ($indice == 'T')
{
$requete = @mysql_query("SELECT *
			FROM client
			WHERE codeclient BETWEEN '950000' AND '990000'
			AND etat <> 0
			AND cpclient LIKE '$cp%'
			GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
}
else
	{
	$requete = @mysql_query("SELECT *
				FROM client
				WHERE codeclient BETWEEN '800000' AND '949999'
				AND etat <> 0
				AND cpclient LIKE '$cp%'
				GROUP BY codeclient")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
	}
@mysql_close(); 

$nomdelabdd="statistique";
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
@mysql_select_db($nomdelabdd, $bdd);                                // s&eacute;lection de la Base de donn&eacute;es
// Initialisation des variables
if ( ! isset($compte)) $compte=NULL;

while ($valeur = mysql_fetch_array($requete))
	{
	$requete4 = @mysql_db_query($nomdelabdd,"SELECT *
						FROM statistique
						WHERE codeclient=\"$valeur[codeclient]\"
						AND catotal <> 0
						AND annee BETWEEN $anmoin AND $annee")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	$contenu = mysql_fetch_array($requete4);
	if ($contenu ['catotal'] == NULL)
		{
		echo "<td width='10%'><b>$valeur[cpclient]</b></td>";
		echo "<td width='10%'><b>$valeur[codeclient]</b></td>";
		echo "<td width='20%'><center>$valeur[nomclient]<center></td>";
		echo "</tr>";
		$compte++;
		}
	}
echo "</table></center>";
echo "<br>Il y a un total de $compte r&eacute;sultats.";

@mysql_close(); 	
?>
</body>
</html>
<?
break;

case 27:

?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Annulation pour l'ann&eacute;e <? echo "$an"; ?></center></h3>
<center><input type="button" value="Impression des Annulations" onClick="imprime()"></center>
<br>
<table width="100%" border="1">
  <tr> 
    <td width=10></td>
    <td bgcolor='#FFFF9B' class='news' colspan=2> 
      <div align="center"><b>Janvier</b><br>
      CA&nbsp;&nbsp;&nbsp;&nbsp;#</div>
    </td>
   <td bgcolor='#FFFF9B' class='news' colspan=2> 
      <div align="center"><b>F&eacute;vrier</b><br>
      CA&nbsp;&nbsp;&nbsp;&nbsp;#</div>
    </td>
   <td bgcolor='#FFFF9B' class='news' colspan=2> 
      <div align="center"><b>Mars</b><br>
      CA&nbsp;&nbsp;&nbsp;&nbsp;#</div>
    </td>
   <td bgcolor='#FFFF9B' class='news' colspan=2> 
      <div align="center"><b>Avril</b><br>
      CA&nbsp;&nbsp;&nbsp;&nbsp;#</div>
    </td>
   <td bgcolor='#FFFF9B' class='news' colspan=2> 
      <div align="center"><b>Mai</b><br>
     CA&nbsp;&nbsp;&nbsp;&nbsp;#</div>
    </td>
   <td bgcolor='#FFFF9B' class='news' colspan=2> 
      <div align="center"><b>Juin</b><br>
      CA&nbsp;&nbsp;&nbsp;&nbsp;#</div>
    </td>
   <td bgcolor='#FFFF9B' class='news' colspan=2> 
      <div align="center"><b>Juillet</b><br>
      CA&nbsp;&nbsp;&nbsp;&nbsp;#</div>
    </td>
   <td bgcolor='#FFFF9B' class='news' colspan=2> 
      <div align="center"><b>Août</b><br>
      CA&nbsp;&nbsp;&nbsp;&nbsp;#</div>
    </td>
   <td bgcolor='#FFFF9B' class='news' colspan=2> 
      <div align="center"><b>Septembre</b><br>
      CA #</div>
    </td>
    <td bgcolor='#FFFF9B' class='news' colspan=2> 
      <div align="center"><b>Octobre</b><br>
      CA #</div>
    </td>
    <td bgcolor='#FFFF9B' class='news' colspan=2> 
      <div align="center"><b>Novembre</b><br>
      CA #</div>
    </td>
    <td bgcolor='#FFFF9B' class='news' colspan=2> 
      <div align="center"><b>D&eacute;cembre</b><br>
      CA #</div>
    </td>
  </tr>
<?php
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
$nomdelabdd="statistique";       										// le nom de la Base de donn&eacute;es 
@mysql_select_db($nomdelabdd,$bdd);   
			
if ($indice == 'T')
{
$req_sel = @mysql_db_query($nomdelabdd,"SELECT *
					FROM annulation
					WHERE idclient BETWEEN '950000' AND '990000'
					AND annee=$an
					ORDER BY mois ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
}
else
	{
	$req_sel = @mysql_db_query($nomdelabdd,"SELECT *
						FROM annulation
						WHERE idclient BETWEEN '800000' AND '949999'
						AND annee=$an
						ORDER BY mois ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}

$req_cree = @mysql_db_query($nomdelabdd,"CREATE TEMPORARY TABLE tmp (
					idtemp           int not null auto_increment,
					codeclient     varchar(6),
					idmotif		varchar(10),
					quantite       varchar(10),
					prix           varchar(10),
					mois           int(2),
					PRIMARY KEY   (idtemp),
					UNIQUE idtemp (idtemp))")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");

while($contenu = mysql_fetch_array($req_sel)) 								
{
$req_inser = @mysql_db_query($nomdelabdd,"INSERT INTO tmp (codeclient,idmotif,quantite,prix,mois)
					VALUES (
					\"$contenu[idclient]\",
					\"$contenu[idmotif]\",
					\"$contenu[quantannul]\",
					\"$contenu[prixannul]\",
					\"$contenu[mois]\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}

$req_sel1 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(quantite) AS quantite,SUM(prix) As prix
					 FROM tmp 
					 WHERE idmotif=1
					 GROUP BY mois
					 ORDER BY mois ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$req_sel2 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(quantite) AS quantite,SUM(prix) As prix
					 FROM tmp 
					 WHERE idmotif=2
					 GROUP BY mois
					 ORDER BY mois ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$req_sel3 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(quantite) AS quantite,SUM(prix) As prix
					 FROM tmp 
					 WHERE idmotif=3
					 GROUP BY mois
					 ORDER BY mois ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$req_sel4 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(quantite) AS quantite,SUM(prix) As prix
					 FROM tmp 
					 WHERE idmotif=7
					 GROUP BY mois
					 ORDER BY mois ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
global $prix1_mois;
global $quantite1_mois;
global $prix2_mois;
global $quantite2_mois;
global $prix3_mois;
global $quantite3_mois;
global $prix4_mois;
global $quantite4_mois;

while($val1 = mysql_fetch_array($req_sel1)) 	
{		
$i = $val1[mois];
$prix1_mois[$i] = $val1[prix];
if ($prix1_mois[$i] <> NULL) { $prix1_mois[$i] = $prix1_mois[$i]." &euro;"; }
$quantite1_mois[$i] = $val1[quantite];
}				 
echo "<tr><td><div class=news>Sans suite</div></td>";
echo "<td class=news align=center>$prix1_mois[1]</td> <td class=news align=center>$quantite1_mois[1]</td>";
echo "<td class=news align=center>$prix1_mois[2]</td> <td class=news align=center>$quantite1_mois[2]</td>";
echo "<td class=news align=center>$prix1_mois[3]</td> <td class=news align=center>$quantite1_mois[3]</td>";
echo "<td class=news align=center>$prix1_mois[4]</td> <td class=news align=center>$quantite1_mois[4]</td>";
echo "<td class=news align=center>$prix1_mois[5]</td> <td class=news align=center>$quantite1_mois[5]</td>";
echo "<td class=news align=center>$prix1_mois[6]</td> <td class=news align=center>$quantite1_mois[6]</td>";
echo "<td class=news align=center>$prix1_mois[7]</td> <td class=news align=center>$quantite1_mois[7]</td>";
echo "<td class=news align=center>$prix1_mois[8]</td> <td class=news align=center>$quantite1_mois[8]</td>";
echo "<td class=news align=center>$prix1_mois[9]</td> <td class=news align=center>$quantite1_mois[9]</td>";
echo "<td class=news align=center>$prix1_mois[10]</td> <td class=news align=center>$quantite1_mois[10]</td>";
echo "<td class=news align=center>$prix1_mois[11]</td> <td class=news align=center>$quantite1_mois[11]</td>";
echo "<td class=news align=center>$prix1_mois[12]</td> <td class=news align=center>$quantite1_mois[12]</td>";
echo "</tr>";

while($val2 = mysql_fetch_array($req_sel2)) 	
{		
$i = $val2[mois];
$prix2_mois[$i] = $val2[prix];
if ($prix2_mois[$i] <> NULL) { $prix2_mois[$i] = $prix2_mois[$i]." &euro;"; }
$quantite2_mois[$i] = $val2[quantite];
}				 
echo "<tr><td><div class=news>Trop chère</div></td>";
echo "<td class=news align=center>$prix2_mois[1]</td> <td class=news align=center>$quantite2_mois[1]</td>";
echo "<td class=news align=center>$prix2_mois[2]</td> <td class=news align=center>$quantite2_mois[2]</td>";
echo "<td class=news align=center>$prix2_mois[3]</td> <td class=news align=center>$quantite2_mois[3]</td>";
echo "<td class=news align=center>$prix2_mois[4]</td> <td class=news align=center>$quantite2_mois[4]</td>";
echo "<td class=news align=center>$prix2_mois[5]</td> <td class=news align=center>$quantite2_mois[5]</td>";
echo "<td class=news align=center>$prix2_mois[6]</td> <td class=news align=center>$quantite2_mois[6]</td>";
echo "<td class=news align=center>$prix2_mois[7]</td> <td class=news align=center>$quantite2_mois[7]</td>";
echo "<td class=news align=center>$prix2_mois[8]</td> <td class=news align=center>$quantite2_mois[8]</td>";
echo "<td class=news align=center>$prix2_mois[9]</td> <td class=news align=center>$quantite2_mois[9]</td>";
echo "<td class=news align=center>$prix2_mois[10]</td> <td class=news align=center>$quantite2_mois[10]</td>";
echo "<td class=news align=center>$prix2_mois[11]</td> <td class=news align=center>$quantite2_mois[11]</td>";
echo "<td class=news align=center>$prix2_mois[12]</td> <td class=news align=center>$quantite2_mois[12]</td>";
echo "</tr>";

while($val3 = mysql_fetch_array($req_sel3)) 	
{		
$i = $val3[mois];
$prix3_mois[$i] = $val3[prix];
if ($prix3_mois[$i] <> NULL) { $prix3_mois[$i] = $prix3_mois[$i]." &euro;"; }
$quantite3_mois[$i] = $val3[quantite];
}				 
echo "<tr><td><div class=news>Evénement</div></td>";
echo "<td class=news align=center>$prix3_mois[1]</td> <td class=news align=center>$quantite3_mois[1]</td>";
echo "<td class=news align=center>$prix3_mois[2]</td> <td class=news align=center>$quantite3_mois[2]</td>";
echo "<td class=news align=center>$prix3_mois[3]</td> <td class=news align=center>$quantite3_mois[3]</td>";
echo "<td class=news align=center>$prix3_mois[4]</td> <td class=news align=center>$quantite3_mois[4]</td>";
echo "<td class=news align=center>$prix3_mois[5]</td> <td class=news align=center>$quantite3_mois[5]</td>";
echo "<td class=news align=center>$prix3_mois[6]</td> <td class=news align=center>$quantite3_mois[6]</td>";
echo "<td class=news align=center>$prix3_mois[7]</td> <td class=news align=center>$quantite3_mois[7]</td>";
echo "<td class=news align=center>$prix3_mois[8]</td> <td class=news align=center>$quantite3_mois[8]</td>";
echo "<td class=news align=center>$prix3_mois[9]</td> <td class=news align=center>$quantite3_mois[9]</td>";
echo "<td class=news align=center>$prix3_mois[10]</td> <td class=news align=center>$quantite3_mois[10]</td>";
echo "<td class=news align=center>$prix3_mois[11]</td> <td class=news align=center>$quantite3_mois[11]</td>";
echo "<td class=news align=center>$prix3_mois[12]</td> <td class=news align=center>$quantite3_mois[12]</td>";
echo "</tr>";

while($val4 = mysql_fetch_array($req_sel4)) 	
{		
$i = $val4[mois];
$prix4_mois[$i] = $val4[prix];
if ($prix4_mois[$i] <> NULL) { $prix4_mois[$i] = $prix4_mois[$i]." &euro;"; }
$quantite4_mois[$i] = $val4[quantite];
}				 
echo "<tr><td><div class=news>Autres...</div></td>";
echo "<td class=news align=center>$prix4_mois[1]</td> <td class=news align=center>$quantite4_mois[1]</td>";
echo "<td class=news align=center>$prix4_mois[2]</td> <td class=news align=center>$quantite4_mois[2]</td>";
echo "<td class=news align=center>$prix4_mois[3]</td> <td class=news align=center>$quantite4_mois[3]</td>";
echo "<td class=news align=center>$prix4_mois[4]</td> <td class=news align=center>$quantite4_mois[4]</td>";
echo "<td class=news align=center>$prix4_mois[5]</td> <td class=news align=center>$quantite4_mois[5]</td>";
echo "<td class=news align=center>$prix4_mois[6]</td> <td class=news align=center>$quantite4_mois[6]</td>";
echo "<td class=news align=center>$prix4_mois[7]</td> <td class=news align=center>$quantite4_mois[7]</td>";
echo "<td class=news align=center>$prix4_mois[8]</td> <td class=news align=center>$quantite4_mois[8]</td>";
echo "<td class=news align=center>$prix4_mois[9]</td> <td class=news align=center>$quantite4_mois[9]</td>";
echo "<td class=news align=center>$prix4_mois[10]</td> <td class=news align=center>$quantite4_mois[10]</td>";
echo "<td class=news align=center>$prix4_mois[11]</td> <td class=news align=center>$quantite4_mois[11]</td>";
echo "<td class=news align=center>$prix4_mois[12]</td> <td class=news align=center>$quantite4_mois[12]</td>";
echo "</tr>";

// Destruction de la table temporaire
$req_del = @mysql_db_query($nomdelabdd,"DROP TABLE tmp")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
@mysql_close();	
?>
</table>
</body>
</html>
<?phpbreak;

case 28:

?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Refus pour l'ann&eacute;e <? echo "$an"; ?></center></h3>
<center><input type="button" value="Impression des Annulations" onClick="imprime()"></center>
<br>
<table width="100%" border="1">
  <tr> 
    <td width=10></td>
    <td bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Janvier</b><br>
      #</div>
    </td>
   <td bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>F&eacute;vrier</b><br>
      #</div>
    </td>
   <td bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Mars</b><br>
      #</div>
    </td>
   <td bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Avril</b><br>
      #</div>
    </td>
   <td bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Mai</b><br>
      #</div>
    </td>
   <td bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Juin</b><br>
      #</div>
    </td>
   <td bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Juillet</b><br>
      #</div>
    </td>
   <td bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Août</b><br>
      #</div>
    </td>
   <td bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Septembre</b><br>
      #</div>
    </td>
    <td bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Octobre</b><br>
      #</div>
    </td>
    <td bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>Novembre</b><br>
      #</div>
    </td>
    <td bgcolor='#FFFF9B' class='news'> 
      <div align="center"><b>D&eacute;cembre</b><br>
      #</div>
    </td>
  </tr>
<?php
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
$nomdelabdd="statistique";       										// le nom de la Base de donn&eacute;es 
@mysql_select_db($nomdelabdd,$bdd);   
			
if ($indice == 'T')
{
$req_sel = @mysql_db_query($nomdelabdd,"SELECT *
					FROM refus
					WHERE idclient BETWEEN '950000' AND '990000'
					AND annee_ref=$an
					ORDER BY mois ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
}
else
	{
	$req_sel = @mysql_db_query($nomdelabdd,"SELECT *
						FROM refus
						WHERE idclient BETWEEN '800000' AND '949999'
						AND annee_ref=$an
						ORDER BY mois ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}

$req_cree = @mysql_db_query($nomdelabdd,"CREATE TEMPORARY TABLE tmp (
					idtemp           int not null auto_increment,
					codeclient     varchar(6),
					idmotif		varchar(10),
					quantite       varchar(10),
					mois           int(2),
					PRIMARY KEY   (idtemp),
					UNIQUE idtemp (idtemp))")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");

while($contenu = mysql_fetch_array($req_sel)) 								
{
$req_inser = @mysql_db_query($nomdelabdd,"INSERT INTO tmp (codeclient,idmotif,quantite,mois)
					VALUES (
					\"$contenu[idclient]\",
					\"$contenu[idmotif]\",
					\"$contenu[chambre_refus]\",
					\"$contenu[mois]\")")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
}

$req_sel1 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(quantite) AS quantite
					 FROM tmp 
					 WHERE idmotif=11
					 GROUP BY mois
					 ORDER BY mois ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$req_sel2 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(quantite) AS quantite
					 FROM tmp 
					 WHERE idmotif=10
					 GROUP BY mois
					 ORDER BY mois ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$req_sel3 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(quantite) AS quantite
					 FROM tmp 
					 WHERE idmotif=9
					 GROUP BY mois
					 ORDER BY mois ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
$req_sel4 = @mysql_db_query($nomdelabdd,"SELECT *,SUM(quantite) AS quantite
					 FROM tmp 
					 WHERE idmotif=12
					 GROUP BY mois
					 ORDER BY mois ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
global $quantite1_mois;
global $quantite2_mois;
global $quantite3_mois;
global $quantite4_mois;

while($val1 = mysql_fetch_array($req_sel1)) 	
{		
$i = $val1[mois];
$quantite1_mois[$i] = $val1[quantite];
}				 
echo "<tr><td><div class=news>Mauvais payeur</div></td>";
echo "<td class=news align=center>$quantite1_mois[1]</td>";
echo "<td class=news align=center>$quantite1_mois[2]</td>";
echo "<td class=news align=center>$quantite1_mois[3]</td>";
echo "<td class=news align=center>$quantite1_mois[4]</td>";
echo "<td class=news align=center>$quantite1_mois[5]</td>";
echo "<td class=news align=center>$quantite1_mois[6]</td>";
echo "<td class=news align=center>$quantite1_mois[7]</td>";
echo "<td class=news align=center>$quantite1_mois[8]</td>";
echo "<td class=news align=center>$quantite1_mois[9]</td>";
echo "<td class=news align=center>$quantite1_mois[10]</td>";
echo "<td class=news align=center>$quantite1_mois[11]</td>";
echo "<td class=news align=center>$quantite1_mois[12]</td>";
echo "</tr>";

while($val2 = mysql_fetch_array($req_sel2)) 	
{		
$i = $val2[mois];
$quantite2_mois[$i] = $val2[quantite];
}				 
echo "<tr><td><div class=news>Ind&eacute;sirable</div></td>";
echo "<td class=news align=center>$quantite2_mois[1]</td>";
echo "<td class=news align=center>$quantite2_mois[2]</td>";
echo "<td class=news align=center>$quantite2_mois[3]</td>";
echo "<td class=news align=center>$quantite2_mois[4]</td>";
echo "<td class=news align=center>$quantite2_mois[5]</td>";
echo "<td class=news align=center>$quantite2_mois[6]</td>";
echo "<td class=news align=center>$quantite2_mois[7]</td>";
echo "<td class=news align=center>$quantite2_mois[8]</td>";
echo "<td class=news align=center>$quantite2_mois[9]</td>";
echo "<td class=news align=center>$quantite2_mois[10]</td>";
echo "<td class=news align=center>$quantite2_mois[11]</td>";
echo "<td class=news align=center>$quantite2_mois[12]</td>";
echo "</tr>";

while($val3 = mysql_fetch_array($req_sel3)) 	
{		
$i = $val3[mois];
$quantite3_mois[$i] = $val3[quantite];
}				 
echo "<tr><td><div class=news>Complet</div></td>";
echo "<td class=news align=center>$quantite3_mois[1]</td>";
echo "<td class=news align=center>$quantite3_mois[2]</td>";
echo "<td class=news align=center>$quantite3_mois[3]</td>";
echo "<td class=news align=center>$quantite3_mois[4]</td>";
echo "<td class=news align=center>$quantite3_mois[5]</td>";
echo "<td class=news align=center>$quantite3_mois[6]</td>";
echo "<td class=news align=center>$quantite3_mois[7]</td>";
echo "<td class=news align=center>$quantite3_mois[8]</td>";
echo "<td class=news align=center>$quantite3_mois[9]</td>";
echo "<td class=news align=center>$quantite3_mois[10]</td>";
echo "<td class=news align=center>$quantite3_mois[11]</td>";
echo "<td class=news align=center>$quantite3_mois[12]</td>";
echo "</tr>";

while($val4 = mysql_fetch_array($req_sel4)) 	
{		
$i = $val4[mois];
$quantite4_mois[$i] = $val4[quantite];
}				 
echo "<tr><td><div class=news>Autres...</div></td>";
echo "<td class=news align=center>$quantite4_mois[1]</td>";
echo "<td class=news align=center>$quantite4_mois[2]</td>";
echo "<td class=news align=center>$quantite4_mois[3]</td>";
echo "<td class=news align=center>$quantite4_mois[4]</td>";
echo "<td class=news align=center>$quantite4_mois[5]</td>";
echo "<td class=news align=center>$quantite4_mois[6]</td>";
echo "<td class=news align=center>$quantite4_mois[7]</td>";
echo "<td class=news align=center>$quantite4_mois[8]</td>";
echo "<td class=news align=center>$quantite4_mois[9]</td>";
echo "<td class=news align=center>$quantite4_mois[10]</td>";
echo "<td class=news align=center>$quantite4_mois[11]</td>";
echo "<td class=news align=center>$quantite4_mois[12]</td>";
echo "</tr>";

// Destruction de la table temporaire
$req_del = @mysql_db_query($nomdelabdd,"DROP TABLE tmp")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
@mysql_close();	
?>
</table>
</body>
</html>
<?phpbreak;

case 29:

?>
<SCRIPT language="Javascript" src="nbconnectes.php?action=hide"></SCRIPT>
<h3><center>Liste des Soci&eacute;t&eacute;s et Contacts </center></h3>
<br>
<center><input type="button" value="Impression de la liste des Clients et Contacts" onClick="imprime()"></center>
<br>
<table width='100%' border='1'>
<tr> 
	<td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Type Client</b></div>
  </td>   
  <td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Code Client</b></div>
  </td>   
 <td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nom Client</b></div>
  </td>    
  <td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CP Client</b></div>
  </td>   
  <td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Ville Client</b></div>
  </td>   
  <td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Pays Client</b></div>
  </td>   
  <td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>E-mail Client</b></div>
  </td>     
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>T&eacute;l Client</b></div>
  </td> 
  <td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Nom Contact</b></div>
  </td>   
  <td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>CP Contact</b></div>
  </td>   
  <td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>Ville Contact</b></div>
  </td>
  <td width='20%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b><center>E-mail Contact</b></div>
  </td>    
  <td width='10%' bgcolor='#FFFF9B' class='news'> 
     <div align='center'><b>T&eacute;l Contact</b></div>
  </td>
  </tr>
  <tr>
<?php
$bdd = @mysql_connect( $nomhote , $identifiant , $motdepasse );          // connection à la Base de donn&eacute;es
$nomdelabdd="commercial";       										// le nom de la Base de donn&eacute;es 
@mysql_select_db($nomdelabdd,$bdd);   		
if ($indice == 'T')
{
$requete = @mysql_db_query($nomdelabdd,"SELECT c.*, t.nomtype AS type, v.nomville AS ville, p.nompays AS pays
					FROM client c, type t, ville v, pays p
					WHERE c.codeclient BETWEEN '950000' AND '990000'
					AND t.indiceclient='T'
					AND c.idtype=t.idtype
					AND c.idville=v.idville
					AND c.idpays=p.idpays
					GROUP BY c.codeclient
					ORDER BY p.nompays,c.nomclient ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");		
}
else
	{
	$requete = @mysql_db_query($nomdelabdd,"SELECT c.*, t.nomtype AS type, v.nomville AS ville, p.nompays AS pays
						FROM client c,type t, ville v, pays p
						WHERE c.codeclient BETWEEN '800000' AND '949999'
						AND t.indiceclient='S'
						AND c.idtype=t.idtype
						AND c.idville=v.idville
						AND c.idpays=p.idpays
						GROUP BY c.codeclient
						ORDER BY p.nompays,c.nomclient ASC")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");
	}

$i = 0;
while ($val = mysql_fetch_array($requete))
		{
		$requete1 = @mysql_query("SELECT o.nomcontact, o.telcontact, o.mailcontact, o.cpcontact, v.nomville AS ville				 		  FROM liencontact l,contact o,ville v				 		  WHERE l.idclient='$val[codeclient]'
				 		  AND o.idville=v.idville
				 		  AND l.idcontact=o.idcontact")or die ("Erreur de requete: (ligne:". __LINE__." dans".__FILE__.") mysql_error()");								
		while ($contenu = mysql_fetch_array($requete1))
			{
			if ( ($val[mailclient] <> NULL) || ($contenu[mailcontact] <> NULL) )
				{
				echo "<td>$val[type]</td>";
				echo "<td>$val[codeclient]</td>";
				echo "<td><b>$val[nomclient]</b></td>";
				echo "<td>$val[cpclient]</td>";
				echo "<td>$val[ville]</td>";
				echo "<td>$val[pays]</td>";
				echo "<td>$val[mailclient]</td>";
				echo "<td>$val[telclient]</td>";		
				echo "<td>$contenu[nomcontact]</td>";		
				echo "<td>$contenu[cpcontact]</td>";
				echo "<td>$contenu[ville]</td>";
				echo "<td>$contenu[mailcontact]</td>";
				echo "<td>$contenu[telcontact]</td></tr>";
				$i++;
				}
			}
		}
echo "</table>";
echo "<br>Il y a $i r&eacute;sultats";
@mysql_close();

break;
}
?>
