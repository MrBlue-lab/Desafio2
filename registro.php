<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Loguin</title>
        <link rel="stylesheet" type="text/css" href="diseño/mycss.css" media="screen" />
        <link rel="stylesheet" type="text/javascript" href="diseño/cssjs.js" media="screen" />
    </head>
    <body>
        <div class="login-page">
            <div class="form">
                <form name="for" action="controladores/controlador_general.php" method="post" class="login-form">
                    <input type="text" name="email" value="" placeholder="email">
                    <input type="text" name="nombre" value="" placeholder="nombre">
                    <input type="text" name="apellidos" value="" placeholder="apellidos">
                    <input type="password" name="pass" value="" placeholder="contraseña">
                    <input type="password" name="pass2" value="" placeholder="repita la contraseña">
                    <input type="submit" name="registro" value="registrarse" class="botonsito">
                    <input type="submit" name="back" value="back" class="botonsitod">
                </form>
            </div>
        </div>
    </body>
</html>
