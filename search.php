<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$destination = isset($_GET['destination']) ? $_GET['destination'] : '';
$date = isset($_GET['date']) ? $_GET['date'] : '';
$offres = [];

try {
  $pdo = new PDO('mysql:host=localhost;dbname=vacance.tn;charset=utf8', 'root', '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $pdo->prepare("SELECT * FROM offres WHERE destination = ? AND date = ?");
  $stmt->execute([$destination, $date]);

  if ($stmt->rowCount() > 0) {
    $offres = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
} catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Résultats de recherche - Vacance.tn</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #e0f7fa, #ffffff);
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #00bcd4;
      color: white;
      padding: 2rem;
      text-align: center;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    h1 {
      margin: 0;
      font-size: 2rem;
    }

    main {
      padding: 30px;
      max-width: 1200px;
      margin: auto;
    }

    .offre-box {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      margin-bottom: 20px;
      padding: 20px;
      transition: transform 0.3s ease;
    }

    .offre-box:hover {
      transform: translateY(-5px);
    }

    .offre-box h3 {
      color: #00796b;
      margin-bottom: 10px;
    }

    .offre-box p {
      margin: 5px 0;
      font-size: 16px;
    }

    .no-result {
      text-align: center;
      font-size: 18px;
      color: #555;
      margin-top: 40px;
    }

    a.back-link {
      display: inline-block;
      margin-top: 30px;
      text-decoration: none;
      background: #00bcd4;
      color: white;
      padding: 10px 20px;
      border-radius: 6px;
      transition: background 0.3s;
    }

    a.back-link:hover {
      background: #0097a7;
    }

    @media screen and (max-width: 600px) {
      main {
        padding: 20px;
      }

      .offre-box {
        padding: 15px;
      }
    }
  </style>
</head>
<body>
  <header>
    <h1>Résultats pour "<?= htmlspecialchars($destination) ?>" le <?= htmlspecialchars($date) ?></h1>
  </header>

  <main>
    <?php if (!empty($offres)): ?>
      <?php foreach ($offres as $offre): ?>
        <div class="offre-box">
          <h3><?= htmlspecialchars($offre['titre']) ?></h3>
          <p>📍 Destination : <?= htmlspecialchars($offre['destination']) ?></p>
          <p>📅 Date : <?= htmlspecialchars($offre['date']) ?></p>
          <p>💰 Prix : <?= htmlspecialchars($offre['prix']) ?> TND</p>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="no-result">Aucune offre trouvée pour cette recherche.</p>
    <?php endif; ?>

    <div style="text-align: center;">
      <a href="index.php" class="back-link">⬅ Retour à l'accueil</a>
    </div>
  </main>
</body>
</html>