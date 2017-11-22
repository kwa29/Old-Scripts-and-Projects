<?php 

session_start();

if(!session_is_registered(@log)) 
{
?>
<html>
<head>
<title>GESCOM &copy; Application de Gestion Commerciale</title>
<link rel="stylesheet" href="../sofibra.css" type="text/css">
</head>
<body bgcolor="#FFE0A3">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><img src="../images/acces_refuse.gif"></td>
  </tr>
</table>
<br>
</body>
</html>
<?
    exit();
}
?>  

