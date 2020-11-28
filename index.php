<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Loguin</title>
        <link rel="stylesheet" type="text/css" href="diseño/mycss.css" media="screen" />
        <link rel="stylesheet" type="text/javascript" href="diseño/cssjs.js" media="screen" />
        <?php
        require_once 'diseño/extra.php';
        ?>
    </head>
    <body>
        <div class="modal-body">
            <div class="login-page">
                <div class="form">
                    <h4>Loguin user</h4>
                    <form name="for" action="controladores/controlador_general.php" method="post" class="login-form">
                        <input type="text" placeholder="email" name="email"/>
                        <input type="password" placeholder="contraseña"  name="pass"/>
                        <input type="submit" name="loguin" value="Aceptar" class="botonsito">
                        <p class="message">No estas registrado? <a href="registro.php">Crea una cuenta</a></p>
                        <p class="message">Olvidaste tu contraseña? <a href="vistas/pass_olvidado.php">Recupera tu cuenta</a></p>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
