<?php
// Envoie du mail
$destinataire = MAILPAYANT;
$subject = "Access Code Wifi.OceaniaHotels.com";
/* Pour envoyer un mail au format HTML, vous pouvez configurer le type Content-type. */
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: Administrateur WifiOceaniaHotels.com <webmaster@hotel-sofibra.com>\r\n";

$message ="Bonjour et Bienvenue sur le rezo Wifi Oceania Hotel...

Vos identifiants de connexion sont $sms et $newKey.";
/* et hop, à la poste */
mail($destinataire, $subject, $message, $headers);
?>
