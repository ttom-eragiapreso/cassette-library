<?php 

// Mi importo tutte le funzioni che ho fatto per rendere più pulito il passaggio qui
require 'functions.php';

$newBarcode = $_GET['barcode'] ?? '';
$newRelease_title = $_GET['release_title'] ?? '';
$newArtist = $_GET['artist'] ?? '';

$db = json_decode(file_get_contents('db.json'), true);
$results = json_decode(file_get_contents('results.json'), true);

if(isset($newBarcode) || isset($newArtist) || isset($newRelease_title)){
  
  $results = apiCall($newBarcode, $newArtist, $newRelease_title);
  header('Content-type: application/json');
  header('Location: results.php');
  //echo $db;
  
}else {
    echo 'Questa ricerca non è valida';
  }

