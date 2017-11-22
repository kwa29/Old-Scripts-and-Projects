<?php
// Envoie du mail
$login = oceania.brest@oceaniahotels.com	# login reception OCB a decommenter selon hotel
#$login = oceania.brest@oceaniahotels.com	# login reception OCB a decommenter selon hotel
#$login = mascotte.aix@oceaniahotels.com	# login reception MAA a decommenter selon hotel
#$login = amirautebrest@oceaniahotels.com	# login reception AMB a decommenter selon hotel 
#$login = mascotte.lemans@oceaniahotels.com	# login reception MLM a decommenter selon hotel 
#$login = mascotte.marseille@oceaniahotels.com	# login reception MAM a decommenter selon hotel 
#$login = mascotte.nantes@oceaniahotels.com	# login reception MAN a decommenter selon hotel 
#$login = oceania-.nantes@oceaniahotels.com	# login reception OCN a decommenter selon hotel 
#$login = mascotte.orleans@oceaniahotels.com	# login reception MAO a decommenter selon hotel 
#$login = mascotte.quimper@oceaniahotels.com	# login reception MAQ a decommenter selon hotel 
#$login = oceania.quimper@oceaniahotels.com	# login reception OCQ a decommenter selon hotel 
#$login = oceania.rennes@oceaniahotels.com	# login reception OCR a decommenter selon hotel 
#$login = mascotte.saintmalo@oceaniahotels.com	# login reception MAS a decommenter selon hotel 
#$login = oceania.saintmalo@oceaniahotels.com	# login reception OCS a decommenter selon hotel 
#$login = mascotte.vannes@oceaniahotels.com	# login reception MAV a decommenter selon hotel 
#$login = oceania.paris@oceaniahotels.com	# login reception Paris a decommenter selon hotel

$psw = sms6550					# psw reception OCB a decommenter selon hotel
#$psw = sms5859					# psw reception MAA a decommenter selon hotel
#$psw = sms8484					# psw reception AMB a decommenter selon hotel 
#$psw = sms0450					# psw reception MLM a decommenter selon hotel 
#$psw = sms9561					# psw reception MAM a decommenter selon hotel 
#$psw = sms1413					# psw reception MAN a decommenter selon hotel 
#$psw = sms1203					# psw reception OCN a decommenter selon hotel 
#$psw = sms0591					# psw reception MAO a decommenter selon hotel 
#$psw = sms3151					# psw reception MAQ a decommenter selon hotel 
#$psw = sms0196					# psw reception OCQ a decommenter selon hotel 
#$psw = 					# psw reception OCR a decommenter selon hotel 
#$psw = sms1878					# psw reception MAS a decommenter selon hotel 
#$psw = sms4573					# psw reception OCS a decommenter selon hotel 
#$psw = sms0754					# psw reception MAV a decommenter selon hotel 
#$psw = sms0919					# psw reception Paris a decommenter selon hotel

$destinataire = MAILFREE;
$subject = "Access Code Wifi.OceaniaHotels.com";
/* Pour envoyer un mail au format HTML, vous pouvez configurer le type Content-type. */
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: Administrateur WifiOceaniaHotels.com <webmaster@hotel-sofibra.com>\r\n";

$message ="Bonjour et Bienvenue sur le rezo Wifi Oceania Hotel...<br>

Vos identifiants de connexion sont:<br>
Login :<b> $sms</b><br>
Password:<b>$newKey</b><br></br>
Ce sms ne vous sera envoy&eacute; qu'une seule fois.<br>
Veuillez noter votre login et votre mot de passe .<br>
Ils vous serviront dans l'ensemble des Hotels du groupe<br>
&eacute;quip&eacute; en WIFI.<br>
En cas de soucis, veuillez prendre contact avec la r&eacute;eption qui pourra vous aider.<br>
Merci, l'&eacute;quipe de l'Hotel";
/* et hop, à la poste */
mail($login,$psw,$destinataire, $subject, $message, $headers);
?>
