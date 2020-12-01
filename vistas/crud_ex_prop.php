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
                    <th class="text-center">FECHA EXPIRATION</th>
                    <th class="text-center">HORA EXPIRATION</th>
                    <th class="text-center">AÑADIR</th>
                </tr>
                <tr class="borde">
                <form name="for" action="../controladores/controlador_general.php" method="post" class="creation">
                    <th><input type="text" name="exTitulo" class="input_creation" value=""/></th>
                    <th><input type="date" name="exFechaE" class="input_creation" value=""/></th>
                    <th><input type="time" name="exHoraE" class="input_creation" value=""/></th>
                    <td><input type="submit" name="addExamenN" value="AÑADIR" class="btn botonsito"></td>
                </form>
                </tr>
            </table>
        </div>
        <div class="creation-page mt30">
            <table class="egt">
                <tr>
                    <th class="text-center">TITULO</th>
                    <th class="text-center">FECHA CREACION</th>
                    <th class="text-center">FECHA EXPIRATION</th>
                    <th class="text-center">HORA EXPIRATION</th>
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
                        <input type="text" name="exId" id="eid" value="<?= $ex->getId() ?>" hidden="">
                        <th><input type="text" name="exTitulo" class="input_creation" value="<?= $ex->getTitulo() ?>"/></th>
                        <th><input type="datetime" name="exFechaHoraC" class="input_creation" value="<?= $ex->getFechacreacion() ?>" readonly=""/></th>
                        <th><input type="date" name="exFechaE" class="input_creation" value="<?= $ex->getFechaE() ?>"/></th>
                        <th><input type="time" name="exHoraE" class="input_creation" value="<?= $ex->getHoraE() ?>"/></th>
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
