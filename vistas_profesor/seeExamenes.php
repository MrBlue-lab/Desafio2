<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Creacion de examen</title>
        <?php
        require_once '../diseño/extra.php';
        require_once '../auxiliar/Objetos/Pregunta.php';
        require_once '../auxiliar/Objetos/Examen.php';
        require_once '../auxiliar/Objetos/Qopciones.php';
        require_once '../auxiliar/Objetos/Qrespuesta.php';
        ?>
    </head>
    <body>
        <?php
        require_once '../estructura_pag/header.php';
        require_once '../auxiliar/Objetos/Conex.php';
        $examenes = Conex::getExamen();
        ?>
        <div class="creation-page">
            <?php
            session_start();
            foreach (Conex::getExamen() as $ex) {
                ?>
                <form name="for" action="../controladores/controlador_general.php" method="post" class="creation">
                    <h3><?= $ex->getTitulo()?></h3>
                    <a><?= $ex->getFecha()?></a>
                    <a><?= $ex->getHora()?></a>
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