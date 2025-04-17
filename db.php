<?php
$host = 'localhost';
$dbname = 'vacance.tn';
$username = 'root'; // à adapter selon ton serveur
$password = '';     // mot de passe vide par défaut sous XAMPP

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die('Connexion échouée : ' . $e->getMessage());
}
?>
