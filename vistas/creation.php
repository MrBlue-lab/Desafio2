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
                        <option value="texto">Texto</option>
                        <option value="numero">Numerico</option>
                        <option value="opcional">Opcional</option>
                    </select>
                    <a>Asignatura de la pregunta</a>
                    <select id="asignatura" name="asignatura" onchange="">
                        <option value="Matematicas" selected="">Matematicas</option>
                        <option value="Ingles">Ingles</option>
                        <option value="Filosofia">Filosofia</option>
                    </select>
                    <div class="text-center">
                        <?php
                        require_once '../auxiliar/preguntas.php';
                        ?>
                    </div>
                    <script>ShowSelected();</script>
                </form>
                <br><hr>
                <form name="for" action="../controladores/controlador_general.php" method="post" class="creation text-center">
                    <br><br>
                    <input type="submit" name="cancelar" value="Cancelar examen" class="btn botonsitod w10 text-center">
                    <input type="submit" name="addExamen" value="Terminar examen" class="btn botonsito w10 text-center">
                </form>
                <br><hr><h2 class="text-center mb10">Vista previa del examen</h2>
                <?php
                $aux = $a->getPreguntas();
                $cont = 0;
                foreach ($aux as $i => $salida) {
                    ?>
                    <form name="for" action="../controladores/controlador_general.php" method="post" class="creation">
                        <div class="s90p mb10"><h4><?= $cont ?>) <input type="text" placeholder="titulo pregunta" name="tittleq" class="input_creation w97" required="" value="<?= $salida->getTitulo() ?>"/></h4>
                            <input type="text" id="idpregunta" name="idpregunta" value="<?= $i ?>" hidden=""/>
                            <a>Tipo de pregunta</a>
                            <select id="Demoexam<?= $i ?>" name="Demoexam<?= $i ?>" onchange='ShowQuest("<?= $i ?>")'>
                                <?php if ($salida->getTipo() == 'option') { ?>
                                    <option value="texto">Texto</option>
                                    <option value="numero">Numerico</option>
                                    <option value="opcional"  selected="">Opcional</option>
                                <?php } else if ($salida->getTipo() == 'numerico') { ?>  
                                    <option value="texto">Texto</option>
                                    <option value="numero" selected="">Numerico</option>
                                    <option value="opcional">Opcional</option>
                                <?php } else { ?>
                                    <option value="texto" selected="">Texto</option>
                                    <option value="numero">Numerico</option>
                                    <option value="opcional">Opcional</option>
                                <?php } ?>
                            </select>
                            <a>Asignatura de la pregunta</a>
                            <select id="asignatura" name="asignatura">
                                <?php if ($salida->getAsig() == 'Matematicas') {
                                    ?>
                                    <option value="Matematicas"selected="">Matematicas</option>
                                    <option value="Ingles">Ingles</option>
                                    <option value="Filosofia">Filosofia</option>
                                    <?php
                                } else if ($salida->getAsig() == 'Ingles') {
                                    ?>
                                    <option value="Matematicas">Matematicas</option>
                                    <option value="Ingles" selected="">Ingles</option>
                                    <option value="Filosofia">Filosofia</option>
                                    <?php
                                } else if ($salida->getAsig() == 'Filosofia') {
                                    ?>
                                    <option value="Matematicas">Matematicas</option>
                                    <option value="Ingles">Ingles</option>
                                    <option value="Filosofia" selected="">Filosofia</option>
                                <?php }
                                ?>
                            </select>
                            <div id="demoEx<?= $i ?>">
                                <fieldset>
                                    <div class='card-body'>
                                        <?php
                                        if ($salida->getTipo() == 'option') {
                                            foreach ($salida->getOpciones() as $j => $fuera) {
                                                if ($salida->getCorrecta() == '' . $j) {
                                                    echo '<h4 class="s40p">' . $j . ') <input type="text" name="Option[]" class="input_creation w70" required="" value="' . $fuera . '"/><input type="radio" id="radioq" name="radioq" value="' . $j . '" checked=""><label> Correcto</label></h4>';
                                                } else {
                                                    echo '<h4 class="s40p">' . $j . ') <input type="text" name="Option[]" class="input_creation w70" required="" value="' . $fuera . '"/><input type="radio" id="radioq" name="radioq" value="' . $j . '"></h4>';
                                                }
                                            }
                                        } else if ($salida->getTipo() == 'texto') {
                                            echo '<h4 class="s40p">Respuesta: <input type="text" name="qtext" class="input_creation w70" required="" value="' . $salida->getRespuesta() . '"/></h4>';
                                        } else if ($salida->getTipo() == 'numerico') {
                                            echo '<h4 class="s40p">Respuesta: <input type="number" name="numerica" class="input_creation w70" required="" value="' . $salida->getRespuesta() . '"/></h4>';
                                        }
                                        $cont++;
                                        ?>
                                    </div>
                                </fieldset>
                                <input type="submit" name="modificar_pregunta" value="Modificar pregunta" class="botonsito btn w10 text-center">
                            </div>
                        </div>
                    </form><hr>
                    <?php
                }
                ?>
            </div>
        <?php } else { ?>
            <div class="creation-page">
                <form name="for" action="../controladores/controlador_general.php" method="post" class="creation">
                    <input type="text" placeholder="titulo examen" name="tittle" class="input_creation"/>
                    <p class="caja_creation">Fecha de finalizacion:<input type="date" name="date_end"  class="input_creation"/> <a class="s40"></a>Hora de finalizacion:<input type="time" name="hour_end"  class="input_creation"/></p>
                    <input type="submit" name="nuevo_examen" value="Aceptar" class="botonsito">
                </form>
            </div>
            <?php }
        require_once '../estructura_pag/foother.php';
        ?>
    </body>
</html>