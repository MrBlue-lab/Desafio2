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
        ?>
        <div class="creation-page">
            <form name="for" action="../controladores/controlador_general.php" method="post" class="creation">
                <input type="text" placeholder="titulo pregunta" name="tittleq" class="input_creation" required=""/>
                <a>Tipo de pregunta</a>
                <select id="question" name="question" onchange="ShowSelected();">
                    <option value="texto" selected="">Texto</option>
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
        </div>
        <?php
        require_once '../estructura_pag/foother.php';
        ?>
    </body>
</html>