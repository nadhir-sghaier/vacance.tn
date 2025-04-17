<?php
$apiKey = "sk-..."; // Mets ta vraie clé ici

$ch = curl_init("https://api.openai.com/v1/chat/completions");

$data = [
  "model" => "gpt-3.5-turbo",
  "messages" => [
    ["role" => "user", "content" => "Bonjour !"]
  ]
];

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Content-Type: application/json",
  "Authorization: Bearer $apiKey"
]);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);

if ($err) {
  echo "Erreur CURL: $err";
} else {
  echo $response;
}
curl_setopt($ch, CURLOPT_CAINFO, "C:/EasyPHP/cacert.pem"); // chemin complet vers ton fichier cacert.pem
