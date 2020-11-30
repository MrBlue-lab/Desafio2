<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Crud examenes</title>
        <?php
        require_once '../diseño/extra.php';
        ?>
    </head>
    <body>
        <?php
        require_once '../estructura_pag/header.php';
        ?>
        <div class="creation-page mt30">
            <table class="egt">
                <tr>
                    <th class="text-center">TITULO</th>
                    <th class="text-center">FECHA CREACION</th>
                    <th class="text-center">FECHA EXPIRATION</th>
                    <th class="text-center">ACTUALIZAR</th>
                    <th class="text-center">BORRAR</th>
                </tr>
                <?php
                require_once '../auxiliar/Objetos/Conex.php';
                require_once '../auxiliar/Objetos/Examen.php';
                foreach (Conex::getExamen() as $ex) {
                    ?>
                <tr class="borde">
                    <form name="for" action="../controladores/controlador_general.php" method="post" class="creation">
                        <td><input type="text" name="tittleq" class="input_creation" value="<?= $ex->getTitulo() ?>"/></td>
                        <th><input type="datetime" name="tittleq" class="input_creation" value="<?= $ex->getFechacreacion() ?>" readonly=""/></th>
                        <td><input type="datetime" name="tittleq" class="input_creation" value="<?= $ex->getFechaexpiracion() ?>"/></td>
                        <td><input type="submit" name="updateExamen" value="Actualizar" class="btn botonsito"></td>
                        <td><input type="submit" name="deleteExamen" value="Borrar" class="btn botonsitod"></td>
                    </form>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
        <?php
        require_once '../estructura_pag/foother.php';
        ?>
    </body>
</html>
