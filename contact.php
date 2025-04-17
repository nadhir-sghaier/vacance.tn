<?php
require 'db.php'; // Assure-toi que ce fichier contient ta connexion PDO

$message_envoye = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $contenu = htmlspecialchars($_POST['message']);

    if (!empty($nom) && !empty($email) && !empty($contenu)) {
        $stmt = $pdo->prepare("INSERT INTO messages (nom, email, message) VALUES (:nom, :email, :message)");
        $stmt->execute([
            ':nom' => $nom,
            ':email' => $email,
            ':message' => $contenu
        ]);
        $message_envoye = true;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Contact | vacance.tn</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background: #f0f4f8;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    .contact-box {
      background: white;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 500px;
    }
    h2 {
      margin-bottom: 20px;
      color: #333;
    }
    input, textarea {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }
    button {
      background-color: #45b649;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 8px;
      cursor: pointer;
    }
    button:hover {
      background-color: #3a9d3a;
    }
    .success {
      background-color: #d4edda;
      border: 1px solid #28a745;
      color: #155724;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>
  <div class="contact-box">
    <h2>Contactez-nous</h2>

    <?php if ($message_envoye): ?>
      <div class="success">✅ Message envoyé avec succès !</div>
    <?php endif; ?>

    <form method="POST" action="contact.php">
      <input type="text" name="nom" placeholder="Votre nom" required>
      <input type="email" name="email" placeholder="Votre email" required>
      <textarea name="message" placeholder="Votre message" rows="5" required></textarea>
      <button type="submit">Envoyer</button>
    </form>
  </div>
</body>
</html>
