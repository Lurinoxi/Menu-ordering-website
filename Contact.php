<?php
// Inkludiere die PHPMailer-Bibliothek
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// E-Mail-Einstellungen
$empfaenger = 'vorname.nachname@example.com'; // E-Mail-Adresse des Empfängers
$betreff = 'Menü-Bestellung erinnern'; // Betreff der E-Mail
$nachricht = 'Bitte nicht vergessen, Ihr Menü vor Mittwoch zu bestellen.'; // Inhalt der E-Mail

// Erstelle eine neue Instanz von PHPMailer
$mail = new PHPMailer();
$mail->isSMTP(); // Verwende SMTP zum Senden der E-Mail
$mail->Host = 'smtp.example.com'; // SMTP-Host
$mail->Port = 587; // SMTP-Port
$mail->SMTPAuth = true; // SMTP-Authentifizierung verwenden
$mail->Username = 'username'; // Benutzername für den SMTP-Server
$mail->Password = 'password'; // Passwort für den SMTP-Server
$mail->SMTPSecure = 'tls'; // Verschlüsselungstyp (tls oder ssl)

// E-Mail-Einstellungen konfigurieren
$mail->setFrom('noreply@example.com', 'Mein Restaurant'); // Absender-E-Mail-Adresse und -Name
$mail->addAddress($empfaenger); // Empfänger-E-Mail-Adresse
$mail->Subject = $betreff; // Betreff der E-Mail
$mail->Body = $nachricht; // Inhalt der E-Mail

// Sende die E-Mail
if ($mail->send()) {
    echo 'Erinnerungs-E-Mail wurde erfolgreich gesendet.';
} else {
    echo 'Fehler beim Senden der Erinnerungs-E-Mail: ' . $mail->ErrorInfo;
}
?>
