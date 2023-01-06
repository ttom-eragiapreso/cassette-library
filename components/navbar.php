
<div class="container max-w-full mx-auto px-5 h-20 flex items-center bg-bisque-100 text-2xl font-medium">
  <a href="index.php" class="hover:text-stone-600 hover:underline underline-offset-8">Home</a>
  <a href="search.php" class="hover:text-stone-600 hover:underline underline-offset-8 px-3">Search Music</a>
  <?php if(isset($username)) :?>
  <span class="ml-auto px-3">Bentornato <?php echo ucfirst($username) ?>!</span>
  <a href="server.php?action=logout" class="text-pastel-200 hover:text-pastel-500">Log out</a>
  <?php endif;?>
</div>
