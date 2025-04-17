<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Vacance.tn - Explorez la Tunisie</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="script.js" defer></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    .stars {
      display: flex;
      gap: 3px;
      font-size: 1.5em;
      margin: 10px 0;
    }

    .stars i.fas.fa-star {
      color: #FFD700;
    }

    .stars i.far.fa-star {
      color: #ccc;
    }

    .note-moyenne {
      font-size: 1.3em;
      font-weight: bold;
      color: #ff9800;
      background-color: #fff3e0;
      padding: 10px 15px;
      border-radius: 8px;
      display: inline-block;
      margin-top: 15px;
    }

    #back-to-top {
      position: fixed;
      bottom: 30px;
      right: 30px;
      background-color: #00bcd4;
      color: white;
      border: none;
      border-radius: 50%;
      padding: 15px;
      font-size: 20px;
      cursor: pointer;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      display: none; /* Caché au départ */
      transition: background-color 0.3s, transform 0.3s;
    }

    #back-to-top:hover {
      background-color: #0097a7;
      transform: scale(1.1);
    }

    #back-to-top i {
      font-size: 1.5em; /* Augmenter la taille de la flèche */
    }
  </style>
  <style>
#chat-container {
  position: fixed;
  bottom: 20px;
  left: 20px;    /* ← on passe de right à left */
  right: auto;   /* ← pour éviter tout conflit */
  width: 300px;
  max-height: 400px;
  background-color: white;
  border: 1px solid #ccc;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  font-family: Arial, sans-serif;
  z-index: 1000;
}


#chat-messages {
  height: 300px;
  overflow-y: auto;
  padding: 10px;
}

.user-msg {
  background-color: #e0f7fa;
  margin-bottom: 5px;
  padding: 8px;
  border-radius: 5px;
  text-align: right;
}

.bot-msg {
  background-color: #f1f1f1;
  margin-bottom: 5px;
  padding: 8px;
  border-radius: 5px;
  text-align: left;
}

#chat-form {
  display: flex;
  border-top: 1px solid #ccc;
}

#chat-input {
  flex: 1;
  border: none;
  padding: 10px;
}

#chat-input:focus {
  outline: none;
}

#chat-form button {
  border: none;
  background-color: #00bcd4;
  color: white;
  padding: 10px 15px;
  cursor: pointer;
}
/* → La bulle cliquable */
/* Bulle cliquable à gauche */
#chat-bubble {
  position: fixed;
  bottom: 20px;
  left: 20px;       /* ← à gauche */
  width: 60px;
  height: 60px;
  background: #00bcd4;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 1.5rem;
  cursor: pointer;
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  z-index: 1000;
}

/* Conteneur de chat masqué / visible */
#chat-container.hidden {
  display: none;
}
#chat-container {
  position: fixed;
  bottom: 100px;    /* Laisse un petit espace au-dessus de la bulle */
  left: 20px;       /* ← à gauche */
  width: 300px;
  max-height: 400px;
  background: white;
  border: 1px solid #ccc;
  border-radius: 10px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  overflow: hidden;
  font-family: Arial, sans-serif;
  z-index: 999;
}

/* Zone de messages */
#chat-messages {
  height: 300px;
  overflow-y: auto;
  padding: 10px;
}

/* Messages utilisateur / bot */
.user-msg { background:#e0f7fa; margin:5px 0; padding:8px; border-radius:5px; text-align:right; }
.bot-msg  { background:#f1f1f1; margin:5px 0; padding:8px; border-radius:5px; text-align:left; }

/* Formulaire */
#chat-form { display:flex; border-top:1px solid #ccc; }
#chat-input { flex:1; border:none; padding:10px; }
#chat-form button { border:none; background:#00bcd4; color:#fff; padding:10px 15px; cursor:pointer; }

</style>
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
  <p class="subtitle">Explorez la Tunisie avec nous ✈️</p>
</header>

<section class="search-section">
  <form action="search.php" method="GET">
    <input type="text" name="destination" placeholder="Où voulez-vous aller ?" required>
    <input type="date" name="date" required>
    <button type="submit">🔍 Rechercher</button>
  </form>
</section>

<section class="destinations">
  <h2>Nos meilleures expériences</h2>
  <div class="destinations-grid">
    <?php
    $destinations = [
      ['title' => 'Tunis', 'desc' => 'Culture, musées et gastronomie.', 'icon' => 'fa-landmark'],
      ['title' => 'Djerba', 'desc' => 'Plages et ambiance méditerranéenne.', 'icon' => 'fa-umbrella-beach'],
      ['title' => 'Tozeur', 'desc' => 'Désert et oasis magiques.', 'icon' => 'fa-campground']
    ];

    foreach ($destinations as $d) {
      echo "
        <div class='destination'>
          <i class='fas {$d['icon']} fa-4x icon'></i>
          <h3>{$d['title']}</h3>
          <p>{$d['desc']}</p>
          <a class='btn' href='reservation.php?destination={$d['title']}'>Réserver</a>
        </div>
      ";
    }
    ?>
  </div>
</section>

<section class="gallery">
  <h2>Ambiances & Activités</h2>
  <div class="gallery-container">
    <div class="gallery-item"><i class="fa-solid fa-mountain-sun fa-3x"></i><p>Randonnées</p></div>
    <div class="gallery-item"><i class="fa-solid fa-water-ladder fa-3x"></i><p>Piscines</p></div>
    <div class="gallery-item"><i class="fa-solid fa-spa fa-3x"></i><p>Bien-être</p></div>
  </div>
</section>

<section class="map-section">
  <h2>Nous trouver</h2>
  <div id="map" style="height: 400px;"></div>
</section>

<section class="reviews">
  <h2>Votre avis compte</h2>
  <form action="avis.php" method="POST">
    <input type="text" name="nom" placeholder="Votre nom" required><br>
    <textarea name="message" placeholder="Votre message..." rows="5" required></textarea><br>
    <button type="submit" class="btn">Envoyer</button>
  </form>
  
  <section class="note-section">
    <h3>Notez votre expérience</h3>
    <form action="noter.php" method="POST">
      <label for="note">Votre note :</label>
      <select name="note" id="note" required>
        <center><option value=""> Sélectionner une note </option></center>
        <option value="5">⭐️⭐️⭐️⭐️⭐️ (5)</option>
        <option value="4">⭐️⭐️⭐️⭐️ (4)</option>
        <option value="3">⭐️⭐️⭐️ (3)</option>
        <option value="2">⭐️⭐️ (2)</option>
        <option value="1">⭐️ (1)</option>
      </select>
      <button type="submit" class="btn">Envoyer la note</button>
    </form>
  </section>

  <!-- ✅ Affichage de la note moyenne -->
  <div class="note-moyenne">
    <?php
    $note_file = "notes.txt";
    if (file_exists($note_file)) {
      $notes = file($note_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      $notes = array_map("floatval", $notes);
      $nb = count($notes);
      if ($nb > 0) {
        $moyenne = array_sum($notes) / $nb;
        $moyenne_arrondie = round($moyenne, 1);
        echo "Note moyenne : $moyenne_arrondie / 5";
        echo "<div class='stars'>";
        for ($i = 1; $i <= 5; $i++) {
          if ($i <= floor($moyenne)) {
            echo "<i class='fas fa-star'></i>";
          } elseif ($i - $moyenne <= 0.5) {
            echo "<i class='fas fa-star-half-alt'></i>";
          } else {
            echo "<i class='far fa-star'></i>";
          }
        }
        echo "</div>";
      } else {
        echo "Aucune note pour le moment.";
      }
    } else {
      echo "Aucune note enregistrée.";
    }
    ?>
  </div>

  <h3>Avis récents</h3>
  <div class="avis-liste">
    <?php
    if (file_exists("avis.txt")) {
      $avis = file("avis.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      $avis = array_reverse($avis);
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
</section>

<button id="back-to-top" title="Retour en haut">
  <i class="fas fa-arrow-up"></i>
</button>

<footer>
  <div class="footer-wrapper">
    <div class="footer-col">
      <h4>Vacance.tn</h4>
      <p>Votre guide de voyage pour explorer les merveilles de la Tunisie.</p>
    </div>
    <div class="footer-col">
      <h4>Liens rapides</h4>
      <ul>
      <li><a href="index.php">Accueil</a></li>
        <li><a href="destinations.php">Destinations</a></li>
        <li><a href="reservation.php">Réserver</a></li>
        <li><a href="mes_reservations.php">Mes réservations</a></li>  <!-- ← Nouveau lien -->
        <li><a href="contact.php">Contact</a></li>
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
    <center>&copy; <?= date("Y") ?> Vacance.tn — Tous droits réservés.</center>
  </div>
</footer>

<!-- Map -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
  const map = L.map('map').setView([36.8065, 10.1815], 6);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);
  const agences = [
    { nom: "Tunis", coord: [36.8065, 10.1815] },
    { nom: "Djerba", coord: [33.8076, 10.8451] },
    { nom: "Tozeur", coord: [33.9197, 8.1335] }
  ];
  agences.forEach(a => {
    L.marker(a.coord).addTo(map).bindPopup(`<b>Agence à ${a.nom}</b>`);
  });
</script>
<div id="chat-container">
  <div id="chat-messages"></div>
  <form id="chat-form">
    <input type="text" id="chat-input" placeholder="Posez votre question..." required>
    <button type="submit">Envoyer</button>
  </form>
</div>
<!-- Retour haut -->
<script>
  const backToTopButton = document.getElementById("back-to-top");
  window.onscroll = function() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
      backToTopButton.style.display = "block";
    } else {
      backToTopButton.style.display = "none";
    }
  };
  backToTopButton.addEventListener("click", function() {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
  const chatInput = document.getElementById("chat-input");
  const chatMessages = document.getElementById("chat-messages");
  const chatForm = document.getElementById("chat-form");

  chatForm.addEventListener("submit", function(e) {
    e.preventDefault();
    const message = chatInput.value;
    if (message.trim() === "") return;

    chatMessages.innerHTML += "<div class='user-msg'>" + message + "</div>";
    chatInput.value = "";

    fetch("chatbot.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ message: message })
    })
    .then(response => response.text())
    .then(reply => {
      chatMessages.innerHTML += "<div class='bot-msg'>" + reply + "</div>";
      chatMessages.scrollTop = chatMessages.scrollHeight;
    })
    .catch(error => {
      chatMessages.innerHTML += "<div class='bot-msg error'>Erreur lors de la réponse.</div>";
    });
  });
});
</script>
<!-- Bul­les / Conteneur de chatbot -->
<div id="chat-bubble"><i class="fas fa-comment"></i></div>

<div id="chat-container" class="hidden">
  <div id="chat-messages"></div>
  <form id="chat-form">
    <input type="text" id="chat-input" placeholder="Posez votre question..." required>
    <button type="submit">Envoyer</button>
  </form>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
  const bubble = document.getElementById("chat-bubble");
  const container = document.getElementById("chat-container");
  const chatForm = document.getElementById("chat-form");
  const chatInput = document.getElementById("chat-input");
  const chatMessages = document.getElementById("chat-messages");

  // 1) Toggle d’affichage du chat
  bubble.addEventListener("click", () => {
    container.classList.toggle("hidden");
  });

  // 2) Envoi du message
  chatForm.addEventListener("submit", function(e) {
    e.preventDefault();
    const message = chatInput.value.trim();
    if (!message) return;

    // Affiche message user
    chatMessages.innerHTML += `<div class="user-msg">${message}</div>`;
    chatInput.value = "";

    // Appel AJAX vers chatbot.php
    fetch("chatbot.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ message })
    })
    .then(r => r.text())
    .then(reply => {
      chatMessages.innerHTML += `<div class="bot-msg">${reply}</div>`;
      chatMessages.scrollTop = chatMessages.scrollHeight;
    })
    .catch(() => {
      chatMessages.innerHTML += `<div class="bot-msg error">Erreur lors de la réponse.</div>`;
    });
  });
});
</script>
</body>
</html>
