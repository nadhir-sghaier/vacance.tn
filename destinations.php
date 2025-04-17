<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Destinations - Vacance.tn</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f4f4f4;
    }
    header {
      background-color: #007BFF;
      color: white;
      padding: 1rem;
      text-align: center;
    }
    .container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 2rem;
      padding: 2rem;
    }
    .card {
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      overflow: hidden;
      width: 300px;
      transition: 0.3s ease;
    }
    .card:hover {
      transform: scale(1.03);
    }
    .card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }
    .card-content {
      padding: 1rem;
    }
    .card h2 {
      margin: 0 0 0.5rem;
    }
    .hotel {
      margin: 0.5rem 0;
    }
    .stars {
      color: gold;
    }
    footer {
      margin-top: 2rem;
      text-align: center;
      padding: 1rem;
      background-color: #222;
      color: #fff;
    }
    .btn-reserver {
  display: inline-block;
  margin-top: 10px;
  padding: 10px 20px;
  background-color: #007bff;
  color: white;
  text-decoration: none;
  border-radius: 8px;
  transition: background-color 0.3s;
}

.btn-reserver:hover {
  background-color: #0056b3;
}

  </style>
</head>
<body>

<header>
  <h1>Nos Destinations</h1>
</header>

<div class="container">

  <!-- Tunis -->
  <div class="card">
    <img src="images/tunis.jpg" alt="Tunis">
    <div class="card-content">
      <h2>Tunis</h2>
      <div class="hotel">Hôtel Africa <span class="stars">★★★★★</span></div>
      <div class="hotel">Golden Tulip El Mechtel <span class="stars">★★★★☆</span></div>
      <div class="hotel">Ibis Tunis <span class="stars">★★★☆☆</span></div>
    </div>
    <a href="reservation.php?destination=Tunis" class="btn-reserver">Réserver</a>
  </div>
  

  <!-- Djerba -->
  <div class="card">
    <img src="images/djerba.jpg" alt="Djerba">
    <div class="card-content">
      <h2>Djerba</h2>
      <div class="hotel">Radisson Blu Djerba <span class="stars">★★★★★</span></div>
      <div class="hotel">Hotel Telemaque Beach <span class="stars">★★★★☆</span></div>
      <div class="hotel">Hotel Sidi Mansour <span class="stars">★★★☆☆</span></div>
    </div>
    <a href="reservation.php?destination=Djerba" class="btn-reserver">Réserver</a>
  </div>

  <!-- Tozeur -->
  <div class="card">
    <img src="images/tozeur.jpg" alt="Tozeur">
    <div class="card-content">
      <h2>Tozeur</h2>
      <div class="hotel">Palm Beach Palace <span class="stars">★★★★★</span></div>
      <div class="hotel">El Mouradi Tozeur <span class="stars">★★★★☆</span></div>
      <div class="hotel">Résidence Le Ruisseau <span class="stars">★★★☆☆</span></div>
    </div>
    <a href="reservation.php?destination=Tozeur" class="btn-reserver">Réserver</a>
  </div>

</div>

<footer>
  <p>&copy; 2025 Vacance.tn - Tous droits réservés.</p>
</footer>

</body>
</html>
