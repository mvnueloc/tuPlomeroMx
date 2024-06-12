<?php
  session_start();

  if (!isset($_SESSION['usuario'])) {
    echo '
      <script>
            alert("No tienes permiso para ver esta pagina.");
            window.location = "./login.php"
        </script>
    ';
    session_destroy();
    die();
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <body>
    <h1>Log in con exito</h1>
    <h2>Bienvenido <?php echo $_SESSION['nombre'] . $_SESSION['apellido'] ; ?></h2> 
    <h2>Correo: <?php echo $_SESSION['usuario']; ?></h2>

    <button>
      <a href="./php/logout_bd.php">Cerrar sesion</a>
    </button>
  </body>
</html>
