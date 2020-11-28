<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
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
                    <h1>Hemos enviado un correo con los nuevos datos</h1>
                    <form name="for" action="../controladores/controlador_general.php" method="POST">
                        <fieldset>
                            <input type="submit" class="botonsitod" name="back" value="Volver">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
