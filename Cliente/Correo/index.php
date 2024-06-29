<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envio de Correo con PHP</title>
    <link rel="stylesheet" href="../estilo.css">
</head>
<body>

<?php
    require '../sesion.php';
    include '../header.php';
    include '../conecta.php';
    $con = conecta();
?>
    <br><br>
    <div class="container">
        <h1 class="text-center">Envianos tus comentarios</h1>
        <hr>
        <form action="enviar.php" method="post">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="correo" placeholder="correo@example.com" required>
              </div>
              <div class="mb-3">
                <label for="mensaje" class="form-label">Mensaje</label>
                <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="acepto" required>
                <label class="form-check-label" for="acepto" >Acepto la politica de privacidad</label>
              </div>
              <div class="d-grid gap-2 col-6 mx-auto">
              <button type="submit">Enviar</button>
            </div>
        </form>
        

    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <footer id="piePagina">
      <p>Todos los derechos reservados 2024 | 
      <a href="../terminos.php"> Terminos y Condiciones</a> |
      <a href="#">Redes sociales</a></p>
    </footer>
</body>
</html>