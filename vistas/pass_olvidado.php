<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Contraseña olvidada</title>
        <link rel="stylesheet" type="text/css" href="diseño/mycss.css" media="screen" />
        <link rel="stylesheet" type="text/javascript" href="diseño/cssjs.js" media="screen" />
        <?php
        require_once '../diseño/extra.php';
        ?>
    </head>
    <body>
        <div class="modal-body">
            <div class="login-page">
                <div class="form">
                    <form name="for" action="../controladores/controlador_general.php" method="POST">
                        <fieldset>
                            <legend>Introduzca su correo</legend>
                            <label>Correo: </label>
                            </br>
                            <input type="email" name="correo" placeholder="Correo electrónico">
                            </br>
                            </br>
                            <input type="submit" class="botonsito" name="solicitar_password" value="Solicitar contraseña">
                            </br>
                            </br>
                            <hr>
                            <input type="submit" class="botonsitod" name="back" value="Volver">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
