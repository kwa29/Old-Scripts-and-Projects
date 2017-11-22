<? include("Admin/sessions.php") ?>
<HTML>
<HEAD>
<link rel="stylesheet" href="sofibra.css" type="text/css">
<base target="corps">
</HEAD>
<BODY LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>

<TABLE height="100%" WIDTH=120 BORDER=0 CELLPADDING=0 CELLSPACING=0>
	<TR>
		<TD COLSPAN=3>			
			<IMG SRC="images/spacer.gif" ALT="Menu deroulant">
		</TD>
	</TR>
	<TR>
		<TD COLSPAN=3>
		<DIV ID=mv2></DIV>
		<?php
		// Cas ou l'utilisateur est receptionniste
		if ($saphira == 7)
		{
		echo "<SCRIPT LANGUAGE='JavaScript' SRC='menu_reception.js'></SCRIPT>";
		}
		// Cas ou l'utilisateur est du siege
		if ($saphira <= 3)
		{
		echo "<SCRIPT LANGUAGE='JavaScript' SRC='menu_siege.js'></SCRIPT>";
		}
		else
			{
			echo "<SCRIPT LANGUAGE='JavaScript' SRC='menu.js'></SCRIPT>";
			}		
		?>
		</TD>
	</TR>		
	<TR>
		<TD BGCOLOR=#FFE0A3><IMG SRC="images/spacer.gif" ALT="Menu deroulant"></TD>			
			
		<TD background="images/menu_droite.gif"><IMG SRC="images/spacer.gif" WIDTH=7 ALT=""></TD>		
	</TR>
	<TR>
		<TD WIDTH=120 COLSPAN=2 BGCOLOR="#FFE0A3" height="100%"><IMG SRC="images/menu_photo.jpg"></TD>
			
		<TD WIDTH=7 height="100%" background="images/menu_droite.gif">&nbsp;</TD>
			
	</TR>
	<TR>
		<TD COLSPAN=2>&nbsp;</TD>
		<TD background="images/menu_droite.gif">
			<IMG SRC="images/spacer.gif" WIDTH=7 HEIGHT=242></TD>
	</TR>
</TABLE>
</BODY>
</HTML>