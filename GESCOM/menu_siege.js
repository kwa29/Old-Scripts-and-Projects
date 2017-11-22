mv2_menu = new Array(); 
mv2_lien = new Array(); 
 
mv2_menu[0] = '<IMG SRC="images/menu_suivi.gif" WIDTH=120 HEIGHT=27 ALT="" border="0">'; 
mv2_menu[1] = '<IMG SRC="images/menu_statistique.gif" ALT="" WIDTH=120 HEIGHT=27 border="0">'; 
mv2_menu[2] = '<IMG SRC="images/menu_flash.gif" ALT="" WIDTH=120 HEIGHT=27 border="0">'; 
mv2_menu[3] = '<IMG SRC="images/menu_annul.gif" ALT="" WIDTH=120 HEIGHT=27 border="0">'; 
mv2_menu[4] = '<IMG SRC="images/menu_requete.gif" ALT="" WIDTH=120 HEIGHT=27 border="0">'; 

mv2_lien[0] = '' 
mv2_lien[1] = '' 
mv2_lien[2] = '' 
mv2_lien[3] = '' 
mv2_lien[4] = '' 

mv2_lien[0] += '<img src="images/menu_fleche_2.gif" align="absmiddle">&nbsp;&nbsp;<a href="recherchesuivi.php?search=client" class="menu" target="corps">Recherche Client</a><BR>'; 
mv2_lien[0] += '<img src="images/menu_fleche_2.gif" align="absmiddle">&nbsp;&nbsp;<a href="recherchesuivi.php?search=contact" class="menu" target="corps">Recherche Contact</a><BR>'; 
mv2_lien[0] += '<img src="images/menu_fleche_2.gif" align="absmiddle">&nbsp;&nbsp;<a href="recherchemailing.php" class="menu" target="corps">Mailing List</a><BR>'; 
mv2_lien[0] += '<img src="images/menu_fleche_2.gif" align="absmiddle">&nbsp;&nbsp;<a href="news.php" class="menu" target="corps">Les news</a><BR>'; 
mv2_lien[0] += '<img src="images/menu_fleche_2.gif" align="absmiddle">&nbsp;&nbsp;<a href="Admin/listing.php?type=hotel" class="menu" target="corps">Rapport des Codes Client</a><BR>'; 
mv2_lien[0] += '<img src="images/menu_fleche_2.gif" align="absmiddle">&nbsp;&nbsp;<a href="requete.php?type=suivi" class="menu" target="corps">Requêtes</a><BR>'; 

mv2_lien[1] += '<img src="images/menu_fleche_2.gif" align="absmiddle">&nbsp;&nbsp;<a href="stathotel.php" class="menu" target="corps">Productivité<br>par Hôtel</a><BR>'; 
mv2_lien[1] += '<img src="images/menu_fleche_2.gif" align="absmiddle">&nbsp;&nbsp;<a href="statsofibra.php" class="menu" target="corps">Productivité<br>pour Sofibra</a><BR>'; 
mv2_lien[1] += '<img src="images/menu_fleche_2.gif" align="absmiddle">&nbsp;&nbsp;<a href="requete.php?type=stat" class="menu" target="corps">Requêtes</a><BR>'; 

mv2_lien[2] += '<img src="images/menu_fleche_2.gif" align="absmiddle">&nbsp;&nbsp;<a href="construction.php" class="menu" target="corps">Flash<br>d\'activités</a><BR>'; 
mv2_lien[2] += '<img src="images/menu_fleche_2.gif" align="absmiddle">&nbsp;&nbsp;<a href="construction.php" class="menu" target="corps">Requêtes</a><BR>'; 

mv2_lien[3] += '<img src="images/menu_fleche_2.gif" align="absmiddle">&nbsp;&nbsp;<a href="recherchealiment.php" class="menu" target="corps">Visualisation</a><BR>'; 
mv2_lien[3] += '<img src="images/menu_fleche_2.gif" align="absmiddle">&nbsp;&nbsp;<a href="requete.php?type=refus" class="menu" target="corps">Requêtes</a><BR>'; 

mv2_lien[4] += '<img src="images/menu_fleche_2.gif" align="absmiddle">&nbsp;&nbsp;<a href="requete.php?type=pre" class="menu" target="corps">Total<br>Pré-formatées</a><BR>'; 
mv2_lien[4] += '<img src="images/menu_fleche_2.gif" align="absmiddle">&nbsp;&nbsp;<a href="construction.php" class="menu" target="corps">Total<br>Paramétrables</a><BR>'; 
 
mv2_pos = 0; 
 
function mv2_menu_draw() 
	{ 
	mv2_aff = "<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 WIDTH=100%>"; 
 
	for(a=0;a<mv2_menu.length;a++) 
		{ 
		if(a == 0 || !document.getElementById) 
			bgcolor = "#FFFF9B"; 
		if(a == 1 || !document.getElementById) 
			bgcolor = "#FFFF9B"; 
		if(a == 2 || !document.getElementById) 
			bgcolor = "#FFFF9B"; 
		if(a == 3 || !document.getElementById) 
			bgcolor = "#FFFF9B"; 
		if(a == 4 || !document.getElementById) 
			bgcolor = "#FFFF9B"; 
	if(document.getElementById) 
			mv2_aff += "<TR><TD><TABLE BORDER=0 BGCOLOR=#000000 CELLPADDING=0 CELLSPACING=0 width=\"120\"><TR><TD BGCOLOR="+bgcolor+"><A HREF=\"#\" onclick=\"mv2_pos="+a+";mv2_menu_draw()\" CLASS=mv2style><FONT FACE=\"Verdana\" SIZE=2>"+mv2_menu[a]+"</FONT></A></TD></TR></TABLE></TD></TR>"; 
		 
	if(mv2_pos == a || !document.getElementById) 
			mv2_aff += "<TR><TD><TABLE BORDER=0 BGCOLOR=#000000 CELLPADDING=0 CELLSPACING=0 width=\"120\"><TR><TD BGCOLOR="+bgcolor+"><div style=\"margin-left:10px;margin-bottom:7px\">"+mv2_lien[a]+"</div></TD><TD width=\"7\"  background=\"images/menu_droite.gif\"><IMG SRC=\"images/spacer.gif\"></TD></TR></TABLE></TD></TR>"; 
		} 
 
	mv2_aff += "</TABLE>"; 
	if(document.getElementById) 
		document.getElementById("mv2").innerHTML = mv2_aff; 
	else 
		document.write(mv2_aff); 
	} 
 
mv2_menu_draw(); 
