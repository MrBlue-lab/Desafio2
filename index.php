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
        <div class="modal-body row pm0">
            <div class="col-md-6 pr0">
                <div class="login-page mr0">
                    <div class="form">
                        <h4>Loguin user</h4>
                        <form name="for" action="controladores/controlador_general.php" method="post" class="login-form">
                            <input type="text" placeholder="email" name="email"/>
                            <input type="password" placeholder="contraseña"  name="pass"/>
                            <input type="submit" name="loguin" value="Aceptar" class="botonsito">
                            <p class="message">No estas registrado? <a href="registro.php">Crea una cuenta</a></p>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pl0">
                <div class="login-page ml0" style="height: 414.1px;">
                    <div class="form" style="background: white;height: 361.1px;">
                        <h4>Loguin admin</h4>
                        <form name="for" action="controladores/controlador_general.php" method="post" class="login-form">
                            <input type="text" placeholder="email" name="email"/>
                            <input type="password" placeholder="contraseña"  name="pass"/>
                            <input type="submit" name="loguin" value="Aceptar" class="botonsito">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
