<?php 
session_start()

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require 'partials/head.php' ?>
  <title>Login Page</title>
</head>
<body>
  

<main class="bg-space-500 min-h-full flex justify-center items-center">
  
  <div class="bg-bisque-300 shadow-xl shadow-bisque-700/80 p-12 rounded-lg">
    <h2>Login</h2>
    <form action="login-auth.php?action=login" method="post">
      <input name="username" type="text" placeholder="Username" class="px-2 py-1 rounded-md">
      <input name="psw" type="password" placeholder="Password" class="px-2 py-1 rounded-md">
      <button type="submit" class="btn-primary block my-3">Login</button>
    </form>
  
    <h2>Oppure Registrati</h2>
    <form action="login-auth.php?action=register" method="post">
      <input name="username" type="text" placeholder="Username" class="px-2 py-1 rounded-md">
      <input name="psw" type="password" placeholder="Password" class="px-2 py-1 rounded-md">
      <button type="submit" class="btn-primary block mt-3">Registrati</button>
    </form>

  </div>

</main>


</body>
</html>