<?php
// Envoie du mail
$destinataire = MAILPAYANT;
$subject = "Wifi Access Code Chambre: $sms";
/* Pour envoyer un mail au format HTML, vous pouvez configurer le type Content-type. */
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: Administrateur WifiOceaniaHotels.com <webmaster@hotel-sofibra.com>\r\n";

$message ="Le client de la chambre <b>$sms</b> desire un forfait payant sur le rezo Wifi Oceania Hotel...<br>

Les identifiants de connexion du client sont:<br>

Login:<b> $sms</b><br>
Password:<b> $newKey</b><br>";


/* et hop, à la poste */
mail($destinataire, $subject, $message, $headers);
?>
