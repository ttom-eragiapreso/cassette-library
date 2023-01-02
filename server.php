<?php 

// Mi importo tutte le funzioni che ho fatto per rendere più pulito il passaggio qui
require 'functions.php';

$newBarcode = $_GET['barcode'] ?? null;

$db = json_decode(file_get_contents('db.json'), true);


if(isset($newBarcode)){

  $db = apiCall($newBarcode);
  header('Content-type: application/json');
  header('Location: library.php');
  echo $db;
  
}else {
    echo 'Questa cassetta è già aggiunta';
  }

