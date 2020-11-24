<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Examenes</title>
        <?php
        require_once '../diseño/extra.php';
        ?>
    </head>
    <body>
        <?php
        require_once '../estructura_pag/header.php';
        ?>
        <div class="creation-page">
            <?php
            require_once '../auxiliar/Objetos/Conex.php';
            require_once '../auxiliar/Objetos/Examen.php';
            session_start();
            foreach (Conex::getExamen() as $ex) {
                ?>
                <form name="for" action="../controladores/controlador_general.php" method="post" class="creation">
                    <input type="text" name="tittleq" class="input_creation w20" value="<?= $ex->getTitulo() ?>" readonly=""/>
                    <input type="datetime" name="tittleq" class="input_creation w20" value="<?= $ex->getFecha() ?>"/>
                    <input type="datetime" name="tittleq" class="input_creation w20" value="<?= $ex->getHora() ?>"/>
                    <input type="submit" name="updateExamen" value="Actualizar" class="btn botonsito w10">
                    <input type="submit" name="deleteExamen" value="Borrar" class="btn botonsitod w10">
                </form>
                <?php
            }
            ?>
        </div>
        <?php
        require_once '../estructura_pag/foother.php';
        ?>
    </body>
</html>
