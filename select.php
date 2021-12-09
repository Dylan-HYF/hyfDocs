<?php
include("db-connect.php");

$stmt = $pdo->prepare("SELECT * FROM `docs`");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($results);
echo ($json);
