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
        $b = Conex::getExamenIdU($user->getId());
        $a=$b['tUenQUFtVZDrmvFgkqOA'];
        ?>
        <div class="creation-page mt30">
            <p class="message text-center"><h1 class="text-center"><?= $a->getTitulo() ?> </h1><a><?= $a->getFechaexpiracion() ?></a></p>
        <form name="for" action="../controladores/controlador_general.php" method="post" class="creation text-center">
            <br><br>
            <input type="submit" name="cancelar" value="Cancelar examen" class="btn botonsitod w10 text-center">
            <input type="submit" name="addExamen" value="Crear examen" class="btn botonsito w10 text-center">
        </form>
        <br><hr>
        <form name="for" action="../controladores/controlador_general.php" method="post" class="creation">
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
            <div class="text-center mt30">
                <?php
                require_once '../auxiliar/preguntas.php';
                ?>
            </div>
            <script>ShowSelected();</script>
        </form>
        <?php if ($a->getPreguntas()) { ?>
            <br><hr>
            <h2 class="text-center mb10">Vista previa del examen</h2>
            <?php
//************************************************Vista previa del examen**************************************************************//
            $aux = $a->getPreguntas();
            $cont = 0;
            foreach ($aux as $i => $salida) {
                $hist = '';
                $hist2 = '';
                $hist3 = '';
                ?>
                <form name="for" action="../controladores/controlador_general.php" method="post" class="creation">
                    <div class="s90p mb10"><h4><?= $cont ?>) <input type="text" placeholder="titulo pregunta" name="tittleq" class="input_creation w90" <?= $hist ?> required="" value="<?= $salida->getTitulo() ?>"/><?= $hist3 ?></h4>
                        <input type="text" id="idpregunta" name="idpregunta" value="<?= $i ?>" hidden=""/>
                        <a>Tipo de pregunta</a>
                        <select id="Demoexam<?= $i ?>" name="Demoexam<?= $i ?>" onchange='ShowQuest("<?= $i ?>")' <?= $hist2 ?>>
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
                        <select id="asignatura" name="asignatura" <?= $hist2 ?>>
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
                                            $correcta = $salida->getCorrecta();
                                            if (!is_array($correcta)) {
                                                $correcta = array(0 => $correcta);
                                            }
                                            for ($k = 0; $k < count($correcta); $k++) {
                                                if ($correcta[$k] == '' . $j) {
                                                    echo '<h4 class="s40p">' . $j . ') <input type="text" name="Option[]" class="input_creation w70" required="" value="' . $fuera . '" ' . $hist . '/><input type="radio" id="radioq" name="radioq" value="' . $j . '" checked="" ' . $hist2 . '><label> Correcto</label></h4>';
                                                } else {
                                                    echo '<h4 class="s40p">' . $j . ') <input type="text" name="Option[]" class="input_creation w70" required="" value="' . $fuera . '" ' . $hist . '/><input type="radio" id="radioq" name="radioq" value="' . $j . '" ' . $hist2 . '></h4>';
                                                }
                                            }
                                        }
                                    } else if ($salida->getTipo() == 'texto') {
                                        echo '<h4 class="s40p"><textarea name="qtext" class="input_creation w70" required=""' . $hist . '>' . $salida->getRespuesta() . '</textarea></h4>';
                                    } else if ($salida->getTipo() == 'numerico') {
                                        echo '<h4 class="s40p"><input type="number" name="numerica" class="input_creation w70" required="" value="' . $salida->getRespuesta() . '"  ' . $hist . '/></h4>';
                                    }
                                    $cont++;
                                    ?>
                                </div>
                            </fieldset>
                            <p class="text-center">
                                <input type="submit" name="modificar_pregunta" value="Modificar pregunta" class="botonsito btn w10 text-center">
                                <input type="submit" name="borrar_pregunta" value="Borrar pregunta" class="botonsitod btn w10 text-center">
                            </p>
                        </div>
                    </div>
                </form>
                <?php
            }
        }
        ?>
    </div>
    <?php
    require_once '../estructura_pag/foother.php';
    ?>
</body>
</html>