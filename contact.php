<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $telephone = $_POST['telephone'] ?? '';
    $message = $_POST['message'] ?? '';

    $mail = new PHPMailer(true);
    try {
        // Paramètres du serveur mail IONOS
        $mail->isSMTP();
        $mail->Host       = 'smtp.ionos.fr';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ton-adresse-mail@ton-domaine.com';
        $mail->Password   = 'ton-mot-de-passe-mail';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Destinataire
        $mail->setFrom('ton-adresse-mail@ton-domaine.com', 'À Vos Projets');
        $mail->addAddress('contact@a-vos-projets.fr', 'À Vos Projets');

        // Contenu
        $mail->isHTML(true);
        $mail->Subject = 'Formulaire contact';
        $mail->Body    = "Nom : $nom<br>Email : $email<br>Téléphone : $telephone<br>Message : $message";

        $mail->send();
        echo 'Message envoyé avec succès !';
    } catch (Exception $e) {
        echo "Le message n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
    }
} else {
    echo 'Méthode invalide';
}
