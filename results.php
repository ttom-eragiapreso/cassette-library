<?php $results = json_decode(file_get_contents('results.json'), true) ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php require 'partials/head.php' ?>
  <title>Search Results</title>
</head>
<body>
  
<?php require 'components/navbar.php' ?>
<main class="bg-space-300">

  <div class="container md:gap-x-4 mx-auto flex flex-wrap justify-around px-5 columns-2 md:columns-4 lg:columns-6">


<?php foreach($results as $record) :?>


    <div class="flex flex-col justify-between min-h-72 mb-28 p-3 bg-slate-300 shadow-lg shadow-space-700/80 rounded-xl">

    <div class="shadow-md shadow-slate-400 rounded-lg overflow-hidden">
      <img src="<?php echo $record['cover_img']?>" 
      class="shrink-0 w-48 object-cover h-full  max-w-full " 
      alt="<?php echo $record['title']?>">
    </div>
      

      <div class="w-48 rounded-b-xl h-auto text-center">
        <h5 class="text-black-500 mb-3"><?php echo $record['title']?></h5>
        <h6 class="text-slate-600 mb-4"><?php echo $record['author']?></h6>
        <div class="flex content-center">
          <a href="#" 
        class="
        mx-auto
         bg-mint-500 p-2 text-bisque-50
         rounded-xl 
         hover:bg-mint-700">Aggiungi alla libreria</a>
        </div>
        
      </div>

    </div>


<?php endforeach ;?>


  </div>
</main>

</body>
</html>