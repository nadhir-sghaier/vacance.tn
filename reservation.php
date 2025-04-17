<?php
// Vérification de la présence de la destination dans l'URL et mise en place d'une valeur par défaut
$destination = isset($_GET['destinations']) ? htmlspecialchars($_GET['destinations']) : 'Inconnue';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Réserver - Vacance.tn</title>
  <style>
    /* RESET */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* GLOBAL */
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f8fa;
      color: #333;
      line-height: 1.6;
    }

    /* HEADER */
    header {
      background-color: #00bcd4;
      color: white;
      padding: 2rem;
      text-align: center;
    }

    header h1 {
      font-size: 2.5rem;
      font-weight: bold;
    }

    header .subtitle {
      font-size: 1.2rem;
      margin-top: 0.5rem;
    }

    /* MAIN CONTENT */
    main {
      margin: 2rem;
    }

    /* Reservation Section */
    .reservation-section {
      background-color: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .reservation-section h2 {
      margin-bottom: 1rem;
      color: #003049;
    }

    .reservation-form {
      max-width: 500px;
      margin: auto;
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    .form-group {
      display: flex;
      flex-direction: column;
    }

    .form-group label {
      font-weight: bold;
      margin-bottom: 0.5rem;
    }

    .form-group input {
      padding: 0.8rem;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      width: 100%;
    }

    .form-group input:focus {
      border-color: #00bcd4;
      outline: none;
    }

    .btn {
      padding: 1rem;
      font-size: 1.1rem;
      background-color: #00bcd4;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .btn:hover {
      background-color: #0097a7;
    }

    /* FOOTER */
    footer {
      background-color: #00293c;
      color: white;
      padding: 2rem 0;
      text-align: center;
    }

    .footer-wrapper {
      display: flex;
      justify-content: center;
      gap: 50px;
    }

    .footer-col h4 {
      font-size: 1.5rem;
      margin-bottom: 1rem;
    }

    .footer-col p {
      font-size: 1rem;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
      .footer-wrapper {
        flex-direction: column;
        align-items: center;
      }

      .reservation-form {
        width: 100%;
      }
    }
  </style>
</head>
<body>

  <header>
    <div class="header-container">
      <h1 class="logo">Vacance.tn</h1>
      <p class="subtitle">Réservez votre aventure en Tunisie</p>
    </div>
  </header>

  <main>
    <section class="reservation-section">
      <h2>Réservation pour <?= $destination ?></h2>

      <form action="confirmation.php" method="POST" class="reservation-form">
        <input type="hidden" name="destination" value="<?= $destination ?>">

        <div class="form-group">
          <label for="nom">Votre nom</label>
          <input type="text" name="nom" id="nom" placeholder="Votre nom" required>
        </div>

        <div class="form-group">
          <label for="email">Votre email</label>
          <input type="email" name="email" id="email" placeholder="Votre email" required>
        </div>

        <div class="form-group">
          <label for="date">Date de réservation</label>
          <input type="date" name="date" id="date" required>
        </div>

        <button type="submit" class="btn">Confirmer la réservation</button>
      </form>
    </section>
  </main>

  <footer>
    <div class="footer-wrapper">
      <div class="footer-col">
        <h4>Vacance.tn</h4>
        <p>Votre guide de voyage pour explorer les merveilles de la Tunisie.</p>
      </div>
    </div>
    <div class="footer-bottom">
      &copy; <?= date("Y") ?> Vacance.tn — Tous droits réservés.
    </div>
  </footer>

</body>
</html>
