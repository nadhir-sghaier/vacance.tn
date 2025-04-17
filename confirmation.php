<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Réservation</title>
    <style>
        /* Placez ici tout le code CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Card de confirmation */
        .confirmation-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
        }

        .confirmation-title {
            font-size: 2em;
            color: #4caf50;
            margin-bottom: 20px;
        }

        .confirmation-message {
            font-size: 1.2em;
            margin-bottom: 30px;
        }

        .error-message {
            color: red;
            font-size: 1.2em;
            text-align: center;
        }

        .btn {
            background-color: #00bcd4;
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 1em;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0097a7;
        }

        .btn-back {
            background-color: #ff5722;
            margin-top: 20px;
        }

        .btn-back:hover {
            background-color: #e64a19;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        require 'db.php';

        // Vérifier si toutes les données nécessaires sont présentes
        if (
            isset($_POST['destination'], $_POST['nom'], $_POST['email'], $_POST['date']) &&
            !empty($_POST['destination']) && !empty($_POST['nom']) &&
            !empty($_POST['email']) && !empty($_POST['date'])
        ) {
            $dest = htmlspecialchars($_POST['destination']);
            $nom = htmlspecialchars($_POST['nom']);
            $email = htmlspecialchars($_POST['email']);
            $date = $_POST['date'];

            $sql = "INSERT INTO reservations (destination, nom, email, date_depart)
                    VALUES (:destination, :nom, :email, :date)";
            
            try {
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':destination' => $dest,
                    ':nom' => $nom,
                    ':email' => $email,
                    ':date' => $date
                ]);
                
                echo "<div class='confirmation-card'>
                        <h1 class='confirmation-title'>Merci, $nom !</h1>
                        <p class='confirmation-message'>Votre réservation pour <strong>$dest</strong> le <strong>$date</strong> a été enregistrée avec succès.</p>
                        <a href='index.php' class='btn btn-back'>Retour à l'accueil</a>
                      </div>";

            } catch (PDOException $e) {
                echo "<p class='error-message'>Erreur lors de l'enregistrement : " . $e->getMessage() . "</p>";
            }

        } else {
            echo "<p class='error-message'>Tous les champs sont obligatoires.</p>";
        }
        ?>
    </div>
</body>
</html>
