<?php   

  require 'user.class.php';
  session_start();
  $user = $_SESSION['user'] ?? null;
  if(!isset($user)){header('Location: login.php');}; 
  
  $username = '';
  $registration_timestamp = '';
  $last_login = '';

  gettype($user) === 'object' ? $username = $user->getUsername() : $username = $user['username'];
  gettype($user) === 'object' ? $registration_timestamp = $user->getRegistrationDate() : $registration_timestamp = $user['registration_timestamp'];
  gettype($user) === 'object' ? $last_login = $user->getLastLogin() : $last_login = $user['last_login'];
  ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require 'partials/head.php'?>
    <link rel="stylesheet" href="styles/styles_index.css">
    <script src="main.js" defer></script>
    <title>Search</title>
  </head>
<body>

<!-- Innesto la navbar -->
<?php require 'components/navbar.php' ?>

<main class="bg-space-100 subpixel-antialiased">

<h2 class="text-center text-xl">Qui puoi cercare musica per codice a barre, titolo dell'album o artista</h2>

<div class="container mx-auto text-center my-3">
  <form action="server.php?navigation=false" method="GET">
  <input id="input_barcode" name="barcode" type="text" placeholder="Search by barcode" class="rounded mx-auto py-1 px-2">
  <input name="artist" type="text" placeholder="Search by artist name" class="rounded mx-auto py-1 px-2">
  <input name="release_title" type="text" placeholder="Search by release title" class="rounded mx-auto py-1 px-2">
  <button type="submit" class="btn-primary mt-3">Search</button>
</form>
</div>

<h2 class="text-center text-xl mb-4">Oppure usa la telecamera per scannerizzarlo</h2>

<div class="container mx-auto px-3">
  <div id="test"></div>
  <div class="container text-center mt-4">
    <button class="btn-primary" id="start">Inizia Stream</button>
    <button class="btn-danger" id="stop">Termina Stream</button>
  </div>
</div>
 
</main>
  

</body>
</html>