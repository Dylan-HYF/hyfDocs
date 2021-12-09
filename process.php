<?php
$title = $_POST["title"];
$content = $_POST["content"];
if (isset($_POST["docId"])) {
  $docId = $_POST["docId"];
  include("db-connect.php");
  $stmt = $pdo->prepare("UPDATE `docs` 
	SET `title` = '$title', 
	`content` = '$content'
	WHERE `docs`.`docId` = $docId;");
  if ($stmt->execute()) {
    echo ('{"success": "edited"}');
  } else {
    echo ('{"success": false}');
  }
  exit();
}
include("db-connect.php");
$stmt = $pdo->prepare("INSERT INTO `docs` (`docId`, `title`, `content`) VALUES (NULL, '$title', '$content')");
// execute
if ($stmt->execute()) {
  $docId = $pdo->lastInsertId();
  $str = array(
    'success' => true,
    'docId' => $docId
  );

  $jsonencode = json_encode($str);
  echo $jsonencode;
} else {
  echo ('{"success": false}');
}
