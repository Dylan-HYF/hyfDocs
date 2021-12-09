<?php
$docId = $_GET["docId"];
include("db-connect.php");
$stmt = $pdo->prepare("DELETE FROM `docs` 
WHERE `docId` = $docId");

if ($stmt->execute() == true) {
  header("Location: index.php");
} else {
  echo ("error, please try again");
?>
  <a href="doc.php?docId=<?= $docId ?>">go back</a>
<?php
}
