<html>
<head>
<title>Fiches Hotel </title>
<style type="text/css">
<!--
.Style14 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Style15 {font-size: 12px}
.Style9 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
div.page        {
writing-mode: tb-rl;
height: 80%;
margin: 10% 0%;
}
-->

</style>
<link rel="stylesheet" href="../sofibra.css" type="text/css">

<br><br>
<script language="JavaScript1.2" src="../fonctions.js"></script>
<div size='16' font='Arial' align='center'><h1> <b>Consultation Fiche Hotel</b><br><br></div>
<CENTER>
 <? 
 include("./fonctions.php");
mysql_connect("molene", "root", "2#tB(5K");
mysql_select_db("datawarehouse");

  echo '<select size=1 name="cat">'."\n"; 
  echo '<option value="-1">Choisir un Hotel<option>'."\n"; 
   
  // Répétion des informations trié par ordre alphabéque 
  $sql = "SELECT nom FROM hotel "; 
  $ReqLog = mysql_query($sql); 
   
  while ($resultat = mysql_fetch_row($ReqLog)) { 
    echo '<option value="'.$resultat[0].'">'.$resultat[0]; 
    echo '</option>'."\n"; 
  } 
   
  echo '</select>'."\n"; 
?>

</head>
<body>
<br><br>
<?php
$soc='SAS SOCIETE';
$nom_hotel='MA SOCIETE';
print "<table width='90%'>";
print "<tr>
 <td width='10%'>
<label>  <span class="Style14">Societe</span>
 </td>
 <td width='20%'>
  <div>$soc</div>
 </td>
 <td width='60%'>
	<div>
	</div>
 </td>
</tr>";
print "<tr>
	<td width='10%'>
	  <div align='center'><h3> Nom Hotel </h3></div>
	</td>
	<td width='20%'>
	  <div> $nom_hotel </div>
	</td>
	<td width='60%'>
	 <div></div>
	</td>
</tr>";
		
print "</table>";
?>
</body>


