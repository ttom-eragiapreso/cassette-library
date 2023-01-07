<?php 

  session_start();
  $user = $_SESSION['user'] ?? null;

  if(!isset($user)){header('Location: login.php');};

  $results = json_decode(file_get_contents('results.json'), true);
  $currentPagination = json_decode(file_get_contents('pagination.json'), true);

  $search = $_GET['search'] ?? null;
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php require 'partials/head.php' ?>
  <title>Search Results</title>
</head>
<body>
  
<?php require 'components/navbar.php' ?>

<main class="bg-space-300">

<div class="container mx-auto px-5 flex justify-between">
  <h2 class="text-bisque-200 text-2xl"><?php echo $currentPagination['items'] ?> Results found for <?php echo ucwords($search)?></h2>
  <h2 class="text-bisque-200 text-2xl mb-7">Page: <?php echo $currentPagination['page'] ?> of <?php echo $currentPagination['pages'] ?></h2>
</div>
  
<div class="container md:gap-x-4 mx-auto flex flex-wrap justify-around px-5 columns-2 md:columns-4 lg:columns-6">
<?php foreach($results as $record) :?>

  <div class="flex flex-col justify-between min-h-72 mb-28 p-3 bg-slate-300 shadow-lg shadow-space-700/80 rounded-xl transition ease-in-out delay-50 duration-300 hover:scale-110 hover:shadow-xl hover:shadow-space-700/90">

    <div class="shadow-md shadow-slate-400 rounded-lg overflow-hidden">
      <img src="<?php echo $record['cover_img']?>" 
      class="shrink-0 w-48 object-cover h-full  max-w-full " 
      alt="<?php echo $record['title']?>">
    </div>
      

    <div class="w-48 rounded-b-xl h-auto text-center">
      <h5 class="text-black-500 mb-3"><?php echo $record['title'] ?></h5>
      <h6 class="text-slate-600 mb-4"><?php echo $record['author']?></h6>
      <div class="flex justify-center">
        <a href="server.php?result_id=<?php echo $record['id'] ?>" 
      class="
        bg-mint-500 p-2 text-bisque-50
        rounded-xl 
        hover:bg-mint-700">Aggiungi alla libreria</a>
      </div>
      
    </div>

  </div>


<?php endforeach ;?>


  </div>

<div class="container mx-auto px-5 pb-5 text-bisque-200 text-2xl flex justify-between">

  <div>

      <?php if(isset($currentPagination['urls']['prev'])): ?>
      <a class="hover:text-slate-200 mr-4" href="server.php?navigation=true&destination=prev">Prev Page</a>
      <?php endif; ?>

      <?php if(isset($currentPagination['urls']['next'])) :?>
      <a class="hover:text-slate-200 mr-4" href="server.php?navigation=true&destination=next">Next Page</a>
      <?php endif;?>
  </div>
 

  <div>
    <?php if(isset($currentPagination['urls']['first'])): ?>
    <a class="hover:text-slate-200" href="server.php?navigation=true&destination=first">First Page</a>
    <?php endif; ?>
      <?php if(isset($currentPagination['urls']['last'])): ?>
    <a class="hover:text-slate-200 ml-4" href="server.php?navigation=true&destination=last">Last Page</a>
    <?php endif ; ?>
  </div>
  
</div>
  

</main>

</body>
</html>