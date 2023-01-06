<?php

require 'user.class.php';

$users = json_decode(file_get_contents('users.json'), true);


// Mi prendo le variabili che mi arrivano dal login
$action = $_GET['action'] ?? '';
$username = $_POST['username'];
$password = $_POST['psw'];
// Inizio la sessione per salvarci dentro le informazioni. 

session_start();

// Ora devo controllare se l'utente ha cliccato su login se già esiste e se corrispondono le credenziali 

if($action == 'login'){

  $user_id = '';

  foreach($users as $key => $user){
   $result = array_search($username, $user);
   if(!empty($result)){
    $user_id = $key;
    $_SESSION['user'] = $users[$user_id];
    header('Location: index.php');
   }else {
    echo "Le credenziali non esistono";
   }
  }


}




// Se invece l'utente ha cliccato su register devo crearlo, aggiungerlo al db e loggarlo 


if($action == 'register'){
  $_SESSION['user'] = new User($username, $password);

}


// Una volta fatto il login o la registrazione dovrò tornare su index.php con l'informazione di login e mostrare il db corretto.


// Infine dovrò creare un semplice logout che killa la sessione, ricarica index e quindi poi di nuovo login, oppure direttamente login. Come chicca faccio un timestamp del momento del logout e lo aggiungo al last_online.