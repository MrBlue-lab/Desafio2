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
        session_start();
        if (isset($_SESSION['examen'])) {
            $a = $_SESSION['examen'];
            ?>
            <div class="creation-page mt30">
                <form name="for" action="../controladores/controlador_general.php" method="post" class="creation">
                    <p class="message text-center"><h1 class="text-center"><?= $a->getTitulo() ?> </h1><a><?= $a->getFechaexpiracion() ?></a></p>
                    <input type="text" placeholder="titulo pregunta" name="tittleq" class="input_creation" required=""/>
                    <a>Tipo de pregunta</a>
                    <select id="question" name="question" onchange="ShowSelected();">
                        <option value="" selected=""> --- </option>
                        <option value="texto">Texto</option>
                        <option value="numero">Numerico</option>
                        <option value="opcional">Opcional</option>
                    </select>
                    <a>Asignatura de la pregunta</a>
                    <select id="asignatura" name="asignatura" onchange="">
                        <option value="nada" selected=""> --- </option>
                        <option value="Matematicas">Matematicas</option>
                        <option value="Ingles">Ingles</option>
                        <option value="Filosofia">Filosofia</option>
                    </select>
                    <div class="text-center">
                        <?php
                        require_once '../auxiliar/preguntas.php';
                        ?>
                    </div>
                </form>
                <br><hr>
                <form name="for" action="../controladores/controlador_general.php" method="post" class="creation text-center">
                    <br><br>
                    <input type="submit" name="cancelar" value="Cancelar examen" class="btn botonsitod w10 text-center">
                    <input type="submit" name="addExamen" value="Terminar examen" class="btn botonsito w10 text-center">
                </form>
                <br><hr>
                <?php
                $aux = $a->getPreguntas();
                foreach ($aux as $i => $salida) {
                    echo '<div class="s90p"><h4>' . $i . ') <input type="text" placeholder="titulo pregunta" name="tittleq" class="input_creation w97" required="" value="' . $salida->getTitulo() . '"/></h4>';
                    if ($salida->getTipo() == 'option') {
                        foreach ($salida->getOpciones() as $j => $fuera) {
                            if ($salida->getCorrecta() == '' . $j) {
                                echo '<h4 class="s40p">' . $j . ') <input type="text" placeholder="titulo pregunta" name="tittleq" class="input_creation w70" required="" value="' . $fuera. '"/> correcta</h4>';
                            } else {
                                echo '<h4 class="s40p">' . $j . ') <input type="text" placeholder="titulo pregunta" name="tittleq" class="input_creation w70" required="" value="' . $fuera. '"/>';
                            }
                        }
                    } else if ($salida->getTipo() != 'number') {
                        echo '<h4 class="s40p">Respuesta: <input type="text" placeholder="titulo pregunta" name="tittleq" class="input_creation w70" required="" value="' . $salida->getRespuesta() . '"/></h4>';
                    }
                    echo '</div>';
                }
                ?>
            </div>
            <?php
        } else {
            ?>
            <div class="creation-page">
                <form name="for" action="../controladores/controlador_general.php" method="post" class="creation">
                    <input type="text" placeholder="titulo examen" name="tittle" class="input_creation"/>
                    <p class="caja_creation">Fecha de finalizacion:<input type="date" name="date_end"  class="input_creation"/> <a class="s40"></a>Hora de finalizacion:<input type="time" name="hour_end"  class="input_creation"/></p>
                    <input type="submit" name="nuevo_examen" value="Aceptar" class="botonsito">
                </form>
            </div>
            <?php
        }
        require_once '../estructura_pag/foother.php';
        ?>
    </body>
</html>