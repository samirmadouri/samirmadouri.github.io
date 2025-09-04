<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "contact@a-vos-projets.fr";  // ton email IONOS
    $subject = "Nouveau message depuis le site";

    $name = strip_tags(trim($_POST["nom"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $telephone = strip_tags(trim($_POST["telephone"]));
    $message = trim($_POST["message"]);

    $body = "Nom : $name\n";
    $body .= "Email : $email\n";
    $body .= "Téléphone : $telephone\n";
    $body .= "Message :\n$message\n";

    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Merci ! Votre message a été envoyé.'); window.location.href='contact.html';</script>";
    } else {
        echo "<script>alert('Erreur : votre message n’a pas pu être envoyé.'); window.location.href='contact.html';</script>";
    }
}
?>
