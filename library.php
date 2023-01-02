<!-- Mi prendo il db -->
<?php $db = json_decode(file_get_contents('db.json'), true);?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require 'partials/head.php' ?>
    <link rel="stylesheet" href="styles/styles_library.css">
  </head>
<body>

<!-- Innesto la navbar -->
<?php require 'components/navbar.php' ?>

<!-- Faccio un foreach dei records nel db se non è vuoto -->
<?php if(!empty($db)): ?>
<main>
<div class="container">
  <div class="row row-cols-6">

      <?php foreach($db as $record) :?>
        <div class="col">
          <div class="card">
            <img src="<?php echo $record['cover_img']?>" class="card-img-top" alt="<?php echo $record['title']?>">
            <div class="card-body">
              <h5 class="card-title"><?php echo $record['title']?></h5>
              <h6 class="card-subtitle"><?php echo $record['author']?></h6>
              <a href="details.php?cassette_id=<?php echo $record['id'] ?>" class="btn btn-primary">Scopri di più</a>
            </div>
          </div>
        </div>
      <?php endforeach ;?>
      
    </div>
  </div>
</main>
<!-- Altrimenti messaggio triste -->
<?php else : ?>
  <main>
    <h1>Non hai nessuna cassetta :(</h1>
  </main>
<?php endif; ?>




</body>
</html>