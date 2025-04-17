<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Avis reçu</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      padding: 30px;
    }
    .container {
      max-width: 600px;
      margin: auto;
      background: white;
      padding: 20px;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    a {
      color: #00bcd4;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nom = trim($_POST["nom"]);
        $message = trim($_POST["message"]);
        $note = isset($_POST["note"]) ? intval($_POST["note"]) : 0;

        if (!empty($nom) && !empty($message) && $note >= 1 && $note <= 5) {
            $date = date("d/m/Y H:i");
            $avis = "[$date]\nNom : $nom\nNote : $note\nMessage : $message\n---\n";
            file_put_contents("avis.txt", $avis, FILE_APPEND | LOCK_EX);

            echo "<h2>✅ Merci pour votre avis, $nom !</h2>";
            echo "<p>Votre message a bien été enregistré avec une note de $note étoile(s).</p>";
        } else {
            echo "<h2>❌ Erreur</h2>";
            echo "<p>Veuillez remplir tous les champs et donner une note.</p>";
        }

        echo "<p><a href='index.php'>⬅ Retour à l'accueil</a></p>";
    } else {
        echo "<h2>⚠️ Accès refusé</h2>";
        echo "<p>Veuillez utiliser le formulaire pour envoyer un avis.</p>";
        echo "<p><a href='index.php'>⬅ Retour à l'accueil</a></p>";
    }
    ?>
  </div>
</body>
</html>
