<?php
// Vérification si la note a été envoyée via la session
session_start();
if (!isset($_SESSION['note_envoyee']) || $_SESSION['note_envoyee'] !== true) {
    header("Location: index.php"); // Si la note n'a pas été envoyée, redirigez vers la page d'accueil
    exit;
}

// Réinitialiser la variable de session
$_SESSION['note_envoyee'] = false;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vacance.tn - Confirmation de votre note</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Merci pour votre note !</h1>
    </header>
    <section>
        <h2>Votre note a été envoyée avec succès !</h2>
        <p>Merci d'avoir partagé votre expérience avec nous. Votre avis nous aide à améliorer nos services.</p>
        <a href="index.php" class="btn">Retour à l'accueil</a>
    </section>
</body>
</html>
