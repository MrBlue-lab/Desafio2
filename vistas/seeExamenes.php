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
        require_once '../auxiliar/Objetos/Conex.php';
        ?>
    </head>
    <body>
        <?php
        require_once '../estructura_pag/header.php';
        $examenes = Conex::getExamen();
        ?>
        <div class="creation-page">
            <?php
            foreach (Conex::getExamen() as $ex) {
                /*
                 * coger preguntas
                 */
                Conex::getPreguntas($ex);
                foreach ($ex->getPreguntas() as $j => $q) {
                    if ($q->getTipo() == 'option') {
                        Conex::getOptions($q);
                    }
                    $ex->updatePregunta($q, $j);
                }
                ?>
            <div class="borde">
                    <form name="for" action="../controladores/controlador_general.php" method="post" class="creation">

                        <h3><?= $ex->getTitulo() ?></h3>
                        <a>Creacion: <?= $ex->getFechacreacion() ?></a>
                        <a>Expira: <?= $ex->getFechaexpiracion() ?></a><br>
                        <?php
                        foreach ($ex->getPreguntas() as $i => $qest) {
                            echo '<a class="s40p">' . $i . ') ' . $qest->getTitulo() . ' ' . $qest->getTipo() . '</a><br>';
                            if ($qest->getTipo() == 'option') {
                                $op = $qest->getOpciones();
                                for ($index = 0; $index < count($op); $index++) {
                                    echo '<a class="s80p">' . $i . '.' . ($index + 1) . ')' . $op[$index] . '</a><br>';
                                }
                            }
                        }
                        ?>
                    </form>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
        require_once '../estructura_pag/foother.php';
        ?>
    </body>
</html>