<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Avis récents - Vacance.tn</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
  <div class="header-container">
    <h1 class="logo">Vacance.tn</h1>
    <div class="auth-buttons">
      <a href="login.php" class="btn-login">Se connecter</a>
      <a href="register.php" class="btn-register">S'inscrire</a>
    </div>
  </div>
  <p class="subtitle">Voir les avis récents ✨</p>
</header>

<section class="reviews">
  <h2>Avis récents</h2>
  <div class="avis-liste">
    <?php
    if (file_exists("avis.txt")) {
      $avis = file("avis.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      $avis = array_reverse($avis); // Les plus récents en premier

      $avis_groupes = [];
      $temp = "";

      foreach ($avis as $line) {
        if (trim($line) === "---") {
          if (!empty($temp)) {
            $avis_groupes[] = trim($temp);
            $temp = "";
          }
        } else {
          $temp .= $line . "\n";
        }
      }

      foreach ($avis_groupes as $avis_item) {
        echo "<div class='avis-item'>";
        echo nl2br(htmlspecialchars($avis_item));
        echo "</div>";
      }
    }
    ?>
  </div>
  <p><a href="index.php">Retour à l'accueil</a></p> <!-- Lien vers la page d'accueil -->
</section>

<footer>
  <div class="footer-wrapper">
    <div class="footer-col">
      <h4>Vacance.tn</h4>
      <p>Votre guide de voyage pour explorer les merveilles de la Tunisie.</p>
    </div>
    
    <div class="footer-col">
      <h4>Liens rapides</h4>
      <ul>
        <li><a href="#">Accueil</a></li>
        <li><a href="#">Destinations</a></li>
        <li><a href="#">Réservations</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </div>
    
    <div class="footer-col">
      <h4>Contact</h4>
      <div class="social-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-youtube"></i></a>
      </div>
      <p>contact@vacance.tn</p>
    </div>
  </div>
  <div class="footer-bottom">
    &copy; <?= date("Y") ?> Vacance.tn — Tous droits réservés.
  </div>
</footer>

</body>
</html>
