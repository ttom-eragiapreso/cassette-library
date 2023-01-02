<!DOCTYPE html>
<html lang="en">
<?php require 'partials/head.php'?>
<body class="d-flex flex-column py-5">

<div class="container">
  <h1 class="text-center mb-4">Benvenuto Nella Mia Collezione di Cassette</h1>
</div>

<h2 class="text-center">Inserisci il codice a barre</h2>

<div class="container text-center my-3">
  <form action="server.php" method="GET">
  <input name="barcode" type="text" placeholder="Insert the barcode" class="form-control w-25 mx-auto">
  <button type="submit" class="btn btn-primary mt-3">Search</button>
</form>
</div>

<h2 class="text-center">Oppure usa la telecamera per scannerizzarlo</h2>
<div class="container">
  <div id="test"></div>
  <div class="container text-center mt-4">
    <button class="btn btn-success" id="start">Inizia Stream</button>
    <button class="btn btn-danger" id="stop">Termina Stream</button>
  </div>
</div>
 

</body>
</html>