<?php

require 'user.class.php';

$users = json_decode(file_get_contents('users.json'), true);


// Mi prendo le variabili che mi arrivano dal login
$action = $_GET['action'] ?? '';
$username = trim(strval($_POST['username']));
$password = trim(strval($_POST['psw']));
// Inizio la sessione per salvarci dentro le informazioni. 

session_start();

// Ora devo controllare se l'utente ha cliccato su login se già esiste e se corrispondono le credenziali 

if($action === 'login' && verifyPsw($password) && verifyUsername($username)){

  $user_id = '';


  $filter = array_filter($users, fn($user) => $user['username'] === $username);
  
  
  if(!empty($filter)){

  $key = array_key_first($filter);
  $_SESSION['user'] = $filter[$key];
  header('Location: index.php');
  }else {
  header('Location: login.php?user-found=false');
  }


}




// Se invece l'utente ha cliccato su register devo crearlo, aggiungerlo al db e loggarlo 


if($action === 'register' && verifyPsw($password) && verifyUsername($username)){

  $filter = array_filter($users, fn($user) => $user['username'] === $username);

  if(empty($filter)){
    $_SESSION['user'] = new User($username, $password);
    $users[$_SESSION['user']->getId()] = $_SESSION['user']->makeArray();
    file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
    file_put_contents("db-$username.json", []);
    header('Location: index.php');
  }else {
    header('Location: login.php?user-exists=true');
  }
     

}else if(!verifyPsw($password)) {
  header('Location: login.php?psw-wrong=true');
}else if(!verifyUsername($username)){
  header('Location: login.php?username-wrong=true');
}


// Una volta fatto il login o la registrazione dovrò tornare su index.php con l'informazione di login e mostrare il db corretto.


// Infine dovrò creare un semplice logout che killa la sessione, ricarica index e quindi poi di nuovo login, oppure direttamente login. Come chicca faccio un timestamp del momento del logout e lo aggiungo al last_online.