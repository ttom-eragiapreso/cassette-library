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

<main class="h-full bg-space-300 flex items-start">

<div class="container-md mx-auto">

<div class="">

    <div class="shadow-md shadow-space-400 rounded-lg overflow-hidden flex bg-slate-300">
      <img src="<?php echo $the_one['cover_img'] ?>" class="" alt="<?php echo $the_one['title'] ?>">


      <div class="card-details p-3">

        <h5 class="text-2xl mb-3"><?php echo $the_one['title'] ?> <span class="text-slate-600">by</span>  <?php echo $the_one['author'] ?></h5>
        <p class="mb-3">Questa cassetta è uscita nel <?php echo $the_one['release_year'] ?>, col codice a barre <?php echo $the_one['barcode'] ?></p>
        <h4>Generi:</h4>
        <ul class="list-disc list-inside">
          <?php foreach($the_one['genres'] as $genre): ?>
            <li><?php echo $genre ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      




    </div>




</div>

</div>

</main>


</body>
</html>