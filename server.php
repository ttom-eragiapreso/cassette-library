<?php 

// Mi importo tutte le funzioni che ho fatto per rendere più pulito il passaggio qui
require 'functions.php';

$newBarcode = $_GET['barcode'] ?? null;
$newRelease_title = $_GET['release_title'] ?? null;
$newArtist = $_GET['artist'] ?? null;
//$paginationEndPoint = $_GET['endpoint'] ?? null;
$isNavigation = $_GET['navigation'];

$destination = $_GET['destination'];

$db = json_decode(file_get_contents('db.json'), true);
$resultsStored = json_decode(file_get_contents('results.json'), true);
$currentPagination = json_decode(file_get_contents('pagination.json'), true);

if(!$isNavigation){

  $resultsStored = [];
  $currentPagination = [];
  apiCall($newBarcode, $newArtist, $newRelease_title);
  header('Content-type: application/json');
  header('Location: results.php');
  
}else {

  $resultsStored = [];
  
  if($destination === 'next'){
    pageNavigation($currentPagination['urls']['next']);
  }
  if($destination === 'prev'){
    pageNavigation($currentPagination['urls']['prev']);
  }
  if($destination === 'first'){
    pageNavigation($currentPagination['urls']['first']);
  }
  if($destination === 'last'){
    pageNavigation($currentPagination['urls']['last']);
  }

  header('Content-type: application/json');
  header('Location: results.php');
  }

