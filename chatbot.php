<?php
// Définir l'en-tête de réponse
header('Content-Type: text/plain');

// Clé API OpenAI (remplace-la si besoin)
$apiKey = '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'; // ⚠️ Remplace par ta clé réelle

// Lire le message envoyé depuis l'index.php
$raw = file_get_contents("php://input");
$data = json_decode($raw, true);
$message = isset($data["message"]) ? $data["message"] : "";
// Vérification
if (!$message) {
  echo "Message vide.";
  exit;
}

// Préparer la requête pour OpenAI
$url = "https://api.openai.com/v1/chat/completions";
$postData = [
  "model" => "gpt-3.5-turbo",
  "messages" => [
    ["role" => "system", "content" => "Tu es un assistant de voyage pour la Tunisie."],
    ["role" => "user", "content" => $message]
  ],
  "temperature" => 0.7
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Content-Type: application/json",
  "Authorization: Bearer $apiKey"
]);

// 🔧 Important pour corriger le bug SSL sous EasyPHP
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);

// Gérer les erreurs cURL
if (curl_errno($ch)) {
  echo "Erreur CURL: " . curl_error($ch);
  curl_close($ch);
  exit;
}

curl_close($ch);

// Traiter la réponse de l'API
$result = json_decode($response, true);
if (isset($result['choices'][0]['message']['content'])) {
  echo trim($result['choices'][0]['message']['content']);
} else {
  echo "Désolé, une erreur est survenue.";
}
?>
