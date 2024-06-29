
<?php
error_reporting(0);
session_start();
$id = $_SESSION['idUser'];
$nombre = $_SESSION['nombreUser'];
$correo = $_SESSION['correoUser'];

if (isset($_SESSION['nombreUser'])) {
    header("Location: bienvenido.php"); 
    exit();
}
?>

<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../estilo2.css">

    <script src="../js/jquery-3.3.1.min.js"></script>

        <script>
        function validar(){
            var correo = document.Forma01.correo.value;
            var password = document.Forma01.password.value;

            if (correo == "" || password == "") {
                $('#mensajeC').show();
                $('#mensajeC').html('Faltan campos por llenar');
                setTimeout("$('#mensajeC').html(''); $('#mensajeC').hide();", 5000);
            } else {
            $.ajax({
                url         : 'validarUsuario.php',
                type        : 'post',
                dataType    : 'text',
                data        : 'correo='+correo+'&password='+password,
                success     : function(res) {
                    console.log(res);
                    if (res == 0){
                        $('#mensaje').show();
                        $('#mensaje').html('Datos incorrectos');
                        setTimeout("$('#mensaje').html(''); $('#mensaje').hide();", 5000);
                    } else {
                        window.location.href="bienvenido.php"
                    }
                },error: function() {
                    alert ('Error archivo no encontrado...');
                }
            });
            }  
        }
    </script>

</head>

<body>
    <br><br>

    <div class="inicio">
        <form name="Forma01" id="Forma01">
            <div class="row">
                <div class="col-25">
                    <label for="correo">Correo:</label><br>
                </div>
                <div class="col-75">
                    <input type="email" name="correo" placeholder="Ingresa tu correo"><br>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="pass">Contraseña:</label><br>
                </div>
                <div class="col-75">
                    <input type="password" name="password" placeholder="Ingresa tu contraseña"><br><br>
                </div>
            </div>

            <input type="submit" onClick="validar(); return false;" value="Ingresar" class="enviar"/><br><br>
            <div id="mensaje"></div>
            <div id="mensajeC"></div>
        </form>
        <!-- <div id="mensaje"></div>
        <div id="mensajeC"></div> -->
    </div>
</body>

</html>