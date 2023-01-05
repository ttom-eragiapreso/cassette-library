<!-- Mi prendo il db -->
<?php $db = json_decode(file_get_contents('db.json'), true);?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require 'partials/head.php' ?>
    <title>Home | My Library</title>
  </head>
<body>

<!-- Innesto la navbar -->
<?php require 'components/navbar.php' ?>

<!-- Faccio un foreach dei records nel db se non è vuoto -->
<?php if(!empty($db)): ?>
<main class="bg-space-300">
<h1 class="text-center text-pastel-200 text-3xl font-bold mb-7">Benvenuto Nella Mia Collezione Musicale!</h1>


  <div class="container md:gap-x-4 mx-auto flex flex-wrap justify-around px-5 columns-2 md:columns-4 lg:columns-6">


<?php foreach($db as $record) :?>


    <div class="flex flex-col justify-between min-h-72 mb-28 p-3 bg-slate-300 shadow-lg shadow-space-600/80 rounded-xl transition ease-in-out delay-50 duration-300 hover:scale-110 hover:shadow-xl hover:shadow-space-700/90">

    <div class="shadow-md shadow-slate-400 rounded-lg overflow-hidden">
      <img src="<?php echo $record['cover_img']?>" 
      class="shrink-0 w-48 object-cover h-full  max-w-full " 
      alt="<?php echo $record['title']?>">
    </div>
      

      <div class="w-48 rounded-b-xl h-auto">
        <h5 class="text-black-500 mt-2"><?php echo $record['title']?></h5>
        <h6 class="text-slate-600 mb-2"><?php echo $record['author']?></h6>
        <div class="flex justify-between mb-0">
          <a href="details.php?cassette_id=<?php echo $record['id'] ?>" 
           class="bg-mint-500 p-2 text-bisque-50
           rounded-xl 
           hover:bg-mint-700">Scopri di più</a>
          <a href="server.php?cassette_id=<?php echo $record['id'] ?>" 
           class="bg-pastel-500 p-2 text-bisque-50
           rounded-xl 
           hover:bg-pastel-700">Elimina</a>
        </div>
      </div>

    </div>


<?php endforeach ;?>


</div>
</main>
<!-- Altrimenti messaggio triste -->

<?php else : ?>
  <main class="bg-space-300 px-5">
    <h1 class="text-2xl ">Non hai ancora nessuna cassetta :(</h1>
    <h2 class="text-2xl my-3"><a href="search.php" class="text-pastel-100 hover:text-pastel-400">Clicca qui</a> per cercare il tuo album preferito e aggiungerlo alla tua libreria!</h2>
  </main>
<?php endif; ?>



</body>
</html>