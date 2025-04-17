<?php
session_start();
// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=vacance.tn;charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupère les réservations de l'utilisateur
$stmt = $pdo->prepare("SELECT destination, date, created_at FROM reservations WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mes réservations – Vacance.tn</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include 'header.inc.php'; // Ton header ?>
  <main class="container">
    <h2>Mes réservations</h2>
    <?php if (empty($reservations)): ?>
      <p>Vous n'avez aucune réservation pour le moment.</p>
    <?php else: ?>
      <table class="reservations-table">
        <thead>
          <tr>
            <th>Destination</th>
            <th>Date de voyage</th>
            <th>Réservé le</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($reservations as $r): ?>
            <tr>
              <td><?= htmlspecialchars($r['destination']) ?></td>
              <td><?= htmlspecialchars($r['date']) ?></td>
              <td><?= htmlspecialchars($r['created_at']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
    <p><a href="index.php" class="btn">← Retour à l'accueil</a></p>
  </main>
  <?php include 'footer.inc.php'; // Ton footer ?>
</body>
</html>
