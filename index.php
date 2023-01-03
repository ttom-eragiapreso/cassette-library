<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require 'partials/head.php'?>
    <link rel="stylesheet" href="styles/styles_index.css">
    <script src="main.js" defer></script>
  </head>
<body>

<!-- Innesto la navbar -->
<?php require 'components/navbar.php' ?>

<main class="bg-space-100 font-mono subpixel-antialiased">
  <h1 class="text-center text-2xl font-bold my-3">Benvenuto Nella Mia Collezione di Cassette</h1>


<h2 class="text-center text-xl">Inserisci il codice a barre</h2>

<div class="container text-center my-3">
  <form action="server.php" method="GET">
  <input id="input_barcode" name="barcode" type="text" placeholder="Insert the barcode" class="rounded mx-auto py-1 px-2">
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