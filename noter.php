<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $note = isset($_POST['note']) ? (int)$_POST['note'] : 0;

    if ($note >= 1 && $note <= 5) {
        file_put_contents("notes.txt", $note . PHP_EOL, FILE_APPEND);
        header("Location: index.php?noté=ok");
        exit;
    } else {
        echo "Note invalide.";
    }
} else {
    echo "Méthode non autorisée.";
}
