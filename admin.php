<?php
require 'db.php';
$res = $pdo->query("SELECT * FROM reservations ORDER BY created_at DESC");
?>

<h1>Liste des réservations</h1>
<table border=\"1\" cellpadding=\"8\">
  <tr>
    <th>Nom</th><th>Email</th><th>Destination</th><th>Date</th><th>Réservé le</th>
  </tr>
  <?php while ($row = $res->fetch()) : ?>
    <tr>
      <td><?= htmlspecialchars($row['nom']) ?></td>
      <td><?= htmlspecialchars($row['email']) ?></td>
      <td><?= htmlspecialchars($row['destination']) ?></td>
      <td><?= $row['date_depart'] ?></td>
      <td><?= $row['created_at'] ?></td>
    </tr>
  <?php endwhile; ?>
</table>
