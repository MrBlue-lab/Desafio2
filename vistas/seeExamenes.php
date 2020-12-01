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
        $user = $_SESSION['loguin'];
        $examenes = Conex::getExamenIdU($user->getId());
        ?>
        <div class="creation-page">
            <?php
            foreach (Conex::getExamen() as $np => $ex) {
                $FECHA = $ex->getFechaE();
                ?>
                <hr>
                <form name="for" action="../controladores/controlador_general.php" method="post" class="creation">
                    <input type="text" id="eid" name="eid" value="<?= $ex->getId() ?>" hidden=""/>
                    <div class="mb10 ">
                        <p class="text-center">
                            <input type="text" name="title_end" class="input_creation text-center fs30" value="<?= $ex->getTitulo() ?>"/>
                        </p>
                        <p class="caja_creation text-center">
                            <a class="s5p">Fecha de finalizacion:</a>
                            <input type="date" name="date_end" class="input_creation" value="<?= $ex->getFechaE() ?>"/>
                            <a class="s5p">Hora de finalizacion:</a>
                            <input type="time" name="hour_end" class="input_creation" value="<?= $ex->getHoraE() ?>"/>
                            <input type="submit" name="modificar_see_examen" value="Modificar" class="btn btn-info s40p">
                        </p>
                        <p class="text-center">
                            <?php
                            if ($ex->getActivo() == 1) {
                                ?><input type="submit" name="desactivar_examen" value="Desactivar" class="btn btn-danger"><?php
                            } else {
                                ?><input type="submit" name="activar_examen" value="Activar" class="btn btn-success"><?php
                            }
                            ?>
                        </p>
                    </div>
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