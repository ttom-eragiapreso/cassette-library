<?php 

require 'functions.php';

class User {

  protected $username = '';
  protected $password = '';
  protected $registration_timestamp = '';
  protected $last_login = '';
  protected $id = '';

  public function __construct(String $_username, String $_password)
  {
    // Inizializzo le variabili dell'utente
    $this->username = $_username;
    $this->password = $_password;
    $this->registration_timestamp = getTimestamp() . ' - UK time';
    $this->id = uniqid('', true);
  }

  // Getter per prendere l'ultimo login dell'utente
  public function getLastLogin(){
    return $this->last_login;
  }

  public function getUsername(){
    return $this->username;
  }

  public function getRegistrationDate(){
    return $this->registration_timestamp;
  }

  public function setLastLogin($timestamp){
    $this->last_login = $timestamp;
  }

  public function getId(){
    return $this->id;
  }

  public function makeArray(){
    $output = [
      "username" => $this->username,
      "password" => $this->password,
      "id" => $this->id,
      "registration_timestamp" => $this->registration_timestamp,
      "last_login" => $this->last_login,
    ];
    return $output;
  }

  public function addUser(){
    // Lo aggiungo al db
    $users = json_decode(file_get_contents('users.json'), true);
    addUser($users, $this->makeArray());
  }
}