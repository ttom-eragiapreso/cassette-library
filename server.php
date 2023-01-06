<?php 
require 'user.class.php';

session_start();

$user = $_SESSION['user'];

$username = '';

gettype($user) === 'object' ? $username = $user->getUsername() : $username = $user['username'];


// Mi importo tutte le funzioni che ho fatto per rendere più pulito il passaggio qui
//require 'functions.php';

$newBarcode = $_GET['barcode'] ?? null;
$newRelease_title = $_GET['release_title'] ?? null;
$newArtist = $_GET['artist'] ?? null;
$isNavigation = $_GET['navigation'] ?? null;
$destination = $_GET['destination'] ?? null;
$result_id = $_GET['result_id'] ?? null;
$cassette_id = $_GET['cassette_id'] ?? null;
$action = $_GET['action'] ?? null;


$db = json_decode(file_get_contents("db-$username.json"), true);
$resultsStored = json_decode(file_get_contents('results.json'), true);
$currentPagination = json_decode(file_get_contents('pagination.json'), true);


if(isset($result_id)){
  addToDb($db, $resultsStored[$result_id], $username);
  header('Location: index.php');
  return;
}

if(isset($cassette_id)){
  deleteFromDb($db, $cassette_id, $username);
  header('Location: index.php');
  return;
}
  





if($action === 'logout'){
  session_destroy();
  header('Location: index.php');
}








if(!$isNavigation){

  $resultsStored = [];
  $currentPagination = [];
  apiCall($newBarcode, $newArtist, $newRelease_title);
  header('Content-type: application/json');
  header('Location: results.php');
  
}else if($isNavigation) {

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

