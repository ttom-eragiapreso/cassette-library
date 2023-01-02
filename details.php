<?php 

  $cassette_id = $_GET['cassette_id']; 
  $db = json_decode(file_get_contents('db.json'), true);

  //$the_one = array_filter($db, fn($record) => $record['id'] == $cassette_id);
  $the_one = $db[$cassette_id];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php require 'partials/head.php' ?>
  <link rel="stylesheet" href="styles/styles_details.css">
</head>
<body>
  
<?php require 'components/navbar.php' ?>

<main>

<div class="container">

<div class="card em-card mb-3" >
  <div class="row g-0">
    <div class="col-md-4">
      <img src="<?php echo $the_one['cover_img'] ?>" class="img-fluid rounded-start" alt="<?php echo $the_one['title'] ?>">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?php echo $the_one['title'] ?> by <?php echo $the_one['author'] ?></h5>
        <p class="card-text">Questa cassetta è uscita nel <?php echo $the_one['release_year'] ?>, col codice a barre <?php echo $the_one['barcode'] ?></p>
        <p class="card-text"><small class="text-muted">
          <ul>
            <?php foreach($the_one['genres'] as $genre): ?>
              <li><?php echo $genre ?></li>
            <?php endforeach; ?>
          </ul>
        </small></p>
      </div>
    </div>
  </div>
</div>

</div>

</main>


</body>
</html>