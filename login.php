<?php
require 'db.php';

$message = ''; // Variable pour afficher les messages dans le HTML

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $hashedPassword = $user['password'];

        if ($password === $hashedPassword) {
            $message = "<div class='success'>Bienvenue <strong>" . htmlspecialchars($user['nom']) . "</strong> !</div>";
        } else {
            $message = "<div class='erreur-box'>Mot de passe incorrect.</div>";
        }
    } else {
        $message = "<div class='erreur-box'>Aucun utilisateur trouvé avec cet email.</div>";
    }
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion | vacance.tn</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }
    body {
      background: linear-gradient(135deg, #dce35b, #45b649);
      background-attachment: fixed;
      background-size: cover;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px;
    }
    .container {
      background-color: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(8px);
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.1);
      max-width: 400px;
      width: 100%;
      text-align: center;
    }
    h2 {
      margin-bottom: 20px;
      font-size: 26px;
      color: #333;
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }
    label {
      text-align: left;
      font-weight: 600;
      color: #444;
    }
    input {
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 15px;
      transition: border-color 0.3s ease;
    }
    input:focus {
      border-color: #45b649;
      outline: none;
    }
    button {
      padding: 12px;
      background-color: #45b649;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #3da341;
    }
    .success {
      color: green;
      margin-bottom: 10px;
    }
    .error {
      color: red;
      margin-bottom: 10px;
    }
    a {
      color: #45b649;
      text-decoration: none;
      font-weight: 500;
    }
    a:hover {
      text-decoration: underline;
    }
    .erreur-box {
  background-color: #ffe6e6;
  border: 1px solid #ff4d4d;
  color: #b30000;
  padding: 10px 15px;
  margin: 15px 0;
  border-radius: 5px;
  font-weight: bold;
  text-align: center;
}

  </style>
</head>
<body>
  <div class="container">
    <h2>Connexion</h2>
    <?= isset($message) ? $message : '' ?>
    <form action="login.php" method="POST">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Mot de passe</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Se connecter</button>
    </form>
    <p>Pas encore de compte ? <a href="register.php">S'inscrire ici</a></p>
  </div>
</body>
</html>
