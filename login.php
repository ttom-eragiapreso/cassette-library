<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require 'partials/head.php' ?>
  <title>Login Page</title>
</head>
<body>
  

<main class="bg-space-500 min-h-full flex justify-center items-center">
  
  <div class="bg-bisque-300 shadow-2xl shadow-bisque-700/80 p-12 rounded-lg">

    <h2>Login</h2>
    <!-- Se le credienzali inserite per il login non corrispondono a quelle nel db mostro messaggio di errore -->
    <?php if( isset($_GET['user-found']) && $_GET['user-found'] === 'false'):?>
    <span class="text-pastel-400 mb-3">Nessun utente trovato con queste credenziali.</span>
    <?php endif;?>
    <!--  -->
    <form action="login-auth.php?action=login" method="post">
      <input name="username" type="text" placeholder="Username" class="px-2 py-1 rounded-md">
      <input name="psw" type="password" placeholder="Password" class="px-2 py-1 rounded-md">
      <button type="submit" class="btn-primary block my-3">Login</button>
    </form>
  
    <h2>Oppure Registrati</h2>
    <!-- Se l'utente prova a registrarsi con uno username che già esiste mostro il messaggio d'errore -->
    <?php if(isset($_GET['user-exists'])):?>
    <span class="text-pastel-400 mb-3">Esiste già un utente con questo Username, provane un altro.</span>
    <?php endif;?>
    <!--  -->

    <form action="login-auth.php?action=register" method="post">
      <input name="username" type="text" placeholder="Username" class="px-2 py-1 rounded-md">
      <input name="psw" type="password" placeholder="Password" class="px-2 py-1 rounded-md">
      <!-- Mostro i messaggi di errore se lo username o la password non soddisfano i requisiti -->
      <?php if(isset($_GET['username-wrong']) && $_GET['username-wrong'] === 'true') : ?>
      <span class="text-pastel-400 mb-3 block">Username non valido, inserire almeno 2 caratteri.</span>
      <?php endif;?>
      <?php if(isset($_GET['psw-wrong']) && $_GET['psw-wrong'] === 'true') : ?>
      <span class="text-pastel-400 mb-3 block">Password non valida, inserire almeno 8 caratteri.</span>
      <?php endif;?>
      <!--  -->
      <button type="submit" class="btn-primary block mt-3">Registrati</button>
    </form>

  </div>

</main>


</body>
</html>