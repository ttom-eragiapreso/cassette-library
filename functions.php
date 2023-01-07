<?php 

// Utilities per prendermi i valori dalla risposta API
  function getAuthor($record){

    if(str_contains($record['title'],' - ')){
      return trim(explode('-', $record['title'])[0]);  
    }else {
      return $record['title'];
    }
  }

  function getTitle($record){

    if(str_contains($record['title'],' - ')){
      return trim(explode('-', $record['title'])[1]);
    }else {
      return $record['title'];
    }
  }

  function getThumb($record){
    return $record['thumb'];
  }

  function getCover($record){
    return $record['cover_image'];
  }
  
  function getGenres($record){
    $output = $record['genre'] ?? '';
    return $output;
  }
  
  function getYear($record){
    return $record['year'] ?? '';
  }
  function getId($record){
    return $record['id'];
  }
  
  function getBarcode($record){
    empty($record['barcode']) ? $output = 'Nessun codice a barre disponibile' : $output = $record['barcode'];
    return $output;
  }

  function getTimestamp(){
    return substr(date('r'), 0, -6) . ' - UK time';
  }

  function createRecord($record){
    $newRecord = [
      "id" => getId($record),
      "title" => getTitle($record),
      "author" => getAuthor($record),
      "thumb" => getThumb($record),
      "cover_img" => getCover($record),
      "genres" => getGenres($record),
      "release_year" => getYear($record),
      "barcode" => getBarcode($record),
      "timestamp" => getTimestamp()
    ];
    return $newRecord;
  }

  // Utility che aggiunge un item al db
  function addToDb($db, $item, $user){
    $db[$item['id']] = $item;
    file_put_contents("db-$user.json", json_encode($db, JSON_PRETTY_PRINT));
  }

  // Utility che rimuove un elemento dal db

  function deleteFromDb($db, $id, $user){


    //$db = array_filter($db, fn($record) => $record['id'] != $id);
    //Ridefinisco questa funzione per altervista
    $db = array_filter($db, function($record) use($id){
      return  $record['id'] != $id;
    });

    file_put_contents("db-$user.json", json_encode($db, JSON_PRETTY_PRINT));

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
        'header'=>"Accept-language: */*",
        'user_agent' => 'My Library test app - localhost'
        )
      );
    
    // Le racchiudo in uno stream context da mandare con la chiamata
    $context = stream_context_create($opts);

    // Mi salvo il risultato della chiamata nella variabile reponse, e in results ci metto i risultati. 
    $response = json_decode(file_get_contents("$baseUrl" . "token=$token" . "&barcode=$barcode" . "&artist=$artist" . "&release_title=$release_title" . "&per_page=48",false, $context), true);

    $pagination = $response['pagination'] ?? null;
    $results = $response['results'] ?? null;
    

    if(isset($results)){

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

      $searchedString = '';

      if(!empty($barcode)) $searchedString .= "Barcode: $barcode - ";
      if(!empty($artist)) $searchedString .= "Artist: $artist - ";
      if(!empty($release_title)) $searchedString .= "Searched Title: $release_title - ";
      if(!empty($searchedString)){
        return substr($searchedString, 0, -3);
      }
    }




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




// FUNZIONI PER LOGIN E AUTENTICAZIONE 



function addUser($db, $user){
  $db[$user['id']] = $user;
  file_put_contents('users.json', json_encode($db, JSON_PRETTY_PRINT));
}

function verifyPsw($psw){
  $output = null;
  strlen($psw) > 8 ? $output = true : $output = false;
  return $output;
}
function verifyUsername($username){
  $output = null;
  strlen($username) > 1 ? $output = true : $output = false;
  return $output;
}