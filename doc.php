<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>untitled</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <link rel="stylesheet" href="reset.css">
  <link rel="stylesheet" href="doc.css">
  <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
  <link rel="manifest" href="favicon_io/site.webmanifest">
</head>

<body>
  <header>
    <?php
    if (isset($_GET["docId"])) {
      $docId = $_GET["docId"];
      include("db-connect.php");
      //prepare
      $stmt = $pdo->prepare("SELECT * FROM `docs` 
WHERE `docId` = $docId");
      //execute
      $stmt->execute();
      $row = $stmt->fetch();
      if (empty($row)) {
    ?>
        <script>
          if (typeof window.history.replaceState == 'function') {
            window.history.replaceState({}, "Hide", '<?php echo $_SERVER['PHP_SELF']; ?>');
          }
        </script>
      <?php
      }
      ?>
      <script>
        document.title = '<?= empty($row["title"]) ? "untitled" : $row["title"] ?>'
      </script>
      <input type="text" placeholder="untitled" tabindex="2" value="<?= $row["title"] ?>">
      <div>
        <span style="opacity:0">
          <i class="material-icons">
            done
          </i>
          <span>
            Saved!
          </span>
        </span>
        <button>Save</button>
      </div>

  </header>
  <section>
    <textarea tabindex="1" placeholder="press tab to type here(when on desktop)"><?= $row["content"] ?></textarea>
    <button onclick="delHandler()">Delete</button>
  </section>
<?php
    } else {
?>
  <input type="text" placeholder="untitled" tabindex="2">
  <!-- <button>edit</button> -->
  <div>
    <span style="opacity:0">
      <i class="material-icons">
        done
      </i>
      <span>
        Saved!
      </span>
    </span>
    <button>Save</button>
  </div>

  </header>
  <section>
    <textarea tabindex="1" placeholder="press tab to type here(when on desktop)"></textarea>

  </section>
<?php
    }

?>

<script src="doc.js"></script>
</body>

</html>