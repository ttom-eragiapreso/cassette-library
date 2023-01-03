<?php 

// Utilities per prendermi i valori dalla risposta API
function getTitleAuthor($src, $switch){
    $output = ($switch == true) ?  trim(explode('-', $src[0]['title'])[1]) :  trim(explode('-', $src[0]['title'])[0]);
    return $output;  
  }

  function getThumb($src){
    return $src[0]['thumb'];
  }

  function getCover($src){
    return $src[0]['cover_image'];
  }
  
  function getGenres($src){
    return $src[0]['genre'];
  }
  
  function getYear($src){
    return $src[0]['year'];
  }
  function getId($src){
    return $src[0]['id'];
  }
  
  function getBarcode($src){
    return $src[0]['barcode'][0];
  }

  // Funzione principale che fa la ricerca e l'aggiunta al database

  function apiCall($barcode){
  
  
    $baseUrl = 'https://api.discogs.com/database/search?';
    $token = 'HWiFdStcHwaqgBqEAoEjjvCFhQUNnZHqZFuelXuZ';
    $db = json_decode(file_get_contents('db.json'), true);
    
    $opts = array(
      'http'=>array(
        'method'=>"GET",
        'header'=>"Accept-language: en",
        'user_agent' => 'My Library test app - localhost'
        )
      );
      
      $context = stream_context_create($opts);
      
      $response = json_decode(file_get_contents("$baseUrl" . "token=$token" . "&barcode=$barcode",false, $context), true);
      $results = $response['results'];
      
      $newRecord = [
        "id" => getId($results),
        "title" => getTitleAuthor($results, true),
        "author" => getTitleAuthor($results, false),
        "thumb" => getThumb($results),
        "cover_img" => getCover($results),
        "genres" => getGenres($results),
        "release_year" => getYear($results),
        "barcode" => getBarcode($results)
      ];
      
      if(isset($newRecord['id'])){
        $db[] = $newRecord;
      }else {
        return;
      }
      
      file_put_contents('db.json', json_encode($db, JSON_PRETTY_PRINT));
      return $db;
    };
  