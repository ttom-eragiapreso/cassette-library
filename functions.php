<?php 

// Utilities per prendermi i valori dalla risposta API
function getTitleAuthor($src, $switch){
    $output = ($switch == true) ?  trim(explode('-', $src['title'])[1]) :  trim(explode('-', $src['title'])[0]);
    return $output;  
  }

  function getThumb($src){
    return $src['thumb'];
  }

  function getCover($src){
    return $src['cover_image'];
  }
  
  function getGenres($src){
    return $src['genre'];
  }
  
  function getYear($src){
    return $src['year'] ?? '';
  }
  function getId($src){
    return $src['id'];
  }
  
  function getBarcode($src){
    return $src['barcode'];
  }

  function createRecord($record){
    $newRecord = [
      "id" => getId($record),
      "title" => getTitleAuthor($record, true),
      "author" => getTitleAuthor($record, false),
      "thumb" => getThumb($record),
      "cover_img" => getCover($record),
      "genres" => getGenres($record),
      "release_year" => getYear($record),
      "barcode" => getBarcode($record)
    ];
    return $newRecord;
  }

  // Utility che aggiunge un item al db
  function addToDb($db, $item){
    $db[] = $item;
    file_put_contents('db.json', json_encode($db, JSON_PRETTY_PRINT));
  }
  // Funzione principale che fa la ricerca 

  function apiCall(String $barcode = '', String $artist = '', String $release_title = ''){
  
    // Prendo il base Url e il mio token per le chiamate
    $baseUrl = 'https://api.discogs.com/database/search?';
    $token = 'HWiFdStcHwaqgBqEAoEjjvCFhQUNnZHqZFuelXuZ';
    
    // Creo le options necessarie per fare la chiamata
    $opts = array(
      'http'=>array(
        'method'=>"GET",
        'header'=>"Accept-language: en",
        'user_agent' => 'My Library test app - localhost'
        )
      );
    
    // Le racchiudo in uno stream context da mandare con la chiamata
    $context = stream_context_create($opts);

    // Mi salvo il risultato della chiamata nella variabile reponse, e in results ci metto i risultati. 
    $response = json_decode(file_get_contents("$baseUrl" . "token=$token" . "&barcode=$barcode" . "&artist=$artist" . "&release_title=$release_title",false, $context), true);
    $pagination = $response['pagination'];
    $results = $response['results'];
    
    // Mi creo i miei array da tutto quello che mi arriva da discogs e lo ritorno.
    $polished_results = array_map('createRecord', $results);
    $allIds = [];
    foreach($polished_results as $record){
      $allIds[] = $record['id'];
    }
    $assocPolishedResults = array_combine($allIds, $polished_results);

    // Scrivo i file all'interno di un altro json che contiene tutti i risultati di una ricerca
    file_put_contents('results.json', json_encode($assocPolishedResults,  JSON_PRETTY_PRINT));
    file_put_contents('pagination.json', json_encode($pagination, JSON_PRETTY_PRINT));
    };
  
function pageNavigation($url){

    // Creo le options necessarie per fare la chiamata
    $opts = array(
      'http'=>array(
        'method'=>"GET",
        'header'=>"Accept-language: en",
        'user_agent' => 'My Library test app - localhost'
        )
      );
    
    // Le racchiudo in uno stream context da mandare con la chiamata
    $context = stream_context_create($opts);

    $response = json_decode(file_get_contents($url, false, $context), true);
    $results = $response['results'];
    $pagination = $response['pagination'];

    $polished_results = array_map('createRecord', $results);
    $allIds = [];
    foreach($polished_results as $record){
      $allIds[] = $record['id'];
    }
    $assocPolishedResults = array_combine($allIds, $polished_results);

    // Scrivo i file all'interno di un altro json che contiene tutti i risultati di una ricerca
    file_put_contents('results.json', json_encode($assocPolishedResults,  JSON_PRETTY_PRINT));
    file_put_contents('pagination.json', json_encode($pagination, JSON_PRETTY_PRINT));
}