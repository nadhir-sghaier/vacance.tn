<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=vacance.tn;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $nom = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);
        $password = md5($_POST['password']); // Moins sécurisé
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $checkStmt->execute([$email]);
        $emailExists = $checkStmt->fetchColumn();

        if ($emailExists > 0) {
            $message = "<p class='error'>Cet email est déjà utilisé. Veuillez en choisir un autre ou <a href='login.php'>vous connecter</a>.</p>";
        } else {
            $stmt = $pdo->prepare("INSERT INTO users (nom, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$nom, $email, $password]);
            $message = "<p class='success'>Inscription réussie ! <a href='login.php'>Connectez-vous ici</a></p>";
        }

    } catch (PDOException $e) {
        $message = "<p class='error'>Erreur : " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Créer un compte | vacance.tn</title>
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
  </style>
</head>
<body>
  <div class="container">
    <h2>Créer un compte</h2>
    <?= isset($message) ? $message : '' ?>
    <form action="register.php" method="POST">
      <label for="nom">Nom</label>
      <input type="text" id="nom" name="nom" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Mot de passe</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">S'inscrire</button>
    </form>
  </div>
</body>
</html>
