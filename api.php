<?php
$apiKey = "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"; // Remplace avec ta propre clé API
$message = "Bonjour, comment ça va ?";  // Test du message

$data = [
    "model" => "gpt-3.5-turbo",
    "messages" => [
        ["role" => "system", "content" => "Tu es un assistant utile pour les clients de vacance.tn."],
        ["role" => "user", "content" => $message],
    ]
];

$ch = curl_init("https://api.openai.com/v1/chat/completions");
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "Authorization: Bearer $apiKey"
    ],
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data)
]);

$response = curl_exec($ch);
if ($response === false) {
    echo 'Erreur cURL: ' . curl_error($ch);  // Cela va afficher une erreur si cURL échoue
} else {
    $result = json_decode($response, true);
    echo $result['choices'][0]['message']['content'] ?? "Aucune réponse de l'API";
}
curl_close($ch);
?>
