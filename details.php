<?php 

  // Mi prendo l'id della cassetta sulla quale ho cliccato e il db
  $cassette_id = $_GET['cassette_id']; 
  $db = json_decode(file_get_contents('db.json'), true);
  // La cassetta sulla quale ho cliccato corrispondere al db all'indice dell'id della cassetta stessa.
  $the_one = $db[$cassette_id];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php require 'partials/head.php' ?>
  <title>Dettagli di <?php echo $the_one['title'] ?></title>
</head>
<body>
  
<?php require 'components/navbar.php' ?>

<main class="h-full bg-space-300 flex items-start">

<div class="container-md mx-auto h-full">

    <div class="shadow-md shadow-space-400 rounded-lg overflow-hidden flex bg-slate-300 max-h-[80%]">
      <div>
        <img src="<?php echo $the_one['cover_img'] ?>" class="max-h-full object-contain" alt="<?php echo $the_one['title'] ?>">
      </div>

      <div class="card-details p-3">

        <h5 class="text-2xl mb-3"><span class="text-mint-400">Title: </span><?php echo $the_one['title'] ?></h5>
        <h5 class="text-2xl mb-2"><span class="text-mint-400">Author: </span><?php echo $the_one['author'] ?></h5>
        <p class="mb-3">Questa album è uscito nel <?php echo $the_one['release_year'] ?>, con questo/i codice/i a barre: </p>
        <ul class="list-disc list-inside">
          <?php if(is_array($the_one['barcode'])): ?>
        <?php foreach($the_one['barcode'] as $barcode): ?>
            <li><?php echo $barcode ?></li>
          <?php endforeach; ?>
          <?php else: ?>
            <li>
              <?php echo $the_one['barcode'] ?>
            </li>
            <?php endif;?>
        </ul>
        <?php if(isset($the_one['genres'])): ?>
        <h4 class="mt-2">Generi:</h4>
        <ul class="list-disc list-inside">
          <?php foreach($the_one['genres'] as $genre): ?>
            <li><?php echo $genre ?></li>
          <?php endforeach; ?>
        </ul>
        <?php endif;?>
        <h4 class="mt-2">L'hai aggiunta in data: <span class="text-bold italic"><?php echo $the_one['timestamp'] ?></span></h4>
      </div>
      

    </div>

</div>

</main>


</body>
</html>