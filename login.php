<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require 'partials/head.php' ?>
  <title>Login Page</title>
</head>
<body>
  

<main class="bg-space-500">
  <h1 class="text-white">Ciao facciamo il login</h1>
  
  <form action="login-auth.php">
    <input type="text" placeholder="Inserisci il tuo nome">
    <input type="password" placeholder="Inseresci la tua password">
    <button type="submit">Login</button>
  </form>

</main>


</body>
</html>