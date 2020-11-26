<?php

/*
 * controlador loguin / roles
 */
if (isset($_POST['loguin'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    require_once '../auxiliar/Objetos/Conex.php';
    require_once '../auxiliar/Objetos/User.php';
    if ($u = Conex::isUser($email, $pass)) {
        session_start();
        $_SESSION['loguin'] = $u;
        if ($u->getRol() == 'user') {
            header('location: ../vistas_comun/home.php');
        } else if ($u->getRol() == 'profesor') {
            header('location: ../vistas_comun/home.php');
        }else if ($u->getRol() == 'admin') {
            header('location: ../vistas_comun/home.php');
        }
    } else {
        header('location: ../index.php');
    }
}

/*
 * controlador salir
 */
if (isset($_POST['back'])) {
    session_destroy();
    header('location: ../index.php');
}

/*
 * controlador añadir usuario
 */
if (isset($_POST['addUser'])) {
    require_once '../auxiliar/Objetos/Conex.php';
    Conex::addUser($_POST['email'], $_POST['nombre'], $_POST['apellido'], $_POST['pass'], $_POST['rol']);
    header('location: ../vistas_profesor/crud_usuarios.php');
}

/*
 * controlador actualizar usuario
 */
if (isset($_POST['updateUser'])) {
    require_once '../auxiliar/Objetos/Conex.php';
    Conex::updateUser($_POST['id'], $_POST['email'], $_POST['nombre'], $_POST['apellido'], $_POST['rol']);
    header('location: ../vistas_profesor/crud_usuarios.php');
}

/*
 * controlador eliminar usuario
 */
if (isset($_POST['dropUser'])) {
    require_once '../auxiliar/Objetos/Conex.php';
    Conex::dropUser($_POST['id']);
    header('location: ../vistas_profesor/crud_usuarios.php');
}

/*
 * controlador registro
 */
if (isset($_POST['registro'])) {
    require_once '../auxiliar/Objetos/Conex.php';
    Conex::insertUser($_POST['email'], $_POST['nombre'], $_POST['apellidos'], $_POST['pass']);
    header('location: ../index.php');
}

/*
 * controlador agregar examen a bd
 */
if (isset($_POST['addExamen'])) {
    require_once '../auxiliar/Objetos/Examen.php';
    require_once '../auxiliar/Objetos/Pregunta.php';
    require_once '../auxiliar/Objetos/Qrespuesta.php';
    require_once '../auxiliar/Objetos/Qopciones.php';
    require_once '../auxiliar/Objetos/Conex.php';
    require_once '../auxiliar/Objetos/User.php';
    session_start();
    Conex::insertExamen($_SESSION['loguin'], $_SESSION['examen']);

    $aux = $_SESSION['examen']->getPreguntas();
    foreach ($aux as $i => $salida) {
        Conex::insertPregunta($_SESSION['idex'], $salida);
        if ($salida->getTipo() == 'option') {
            foreach ($salida->getOpciones() as $j => $fuera) {
                if ($salida->getCorrecta() == '' . $j) {
                    Conex::insertOpcion($_SESSION['idq'], $fuera, 1);
                } else {
                    Conex::insertOpcion($_SESSION['idq'], $fuera, 0);
                }
            }
        } else if ($salida->getTipo() == 'texto') {
            Conex::insertTexto($_SESSION['idq'], $salida->getRespuesta());
        } else if ($salida->getTipo() == 'numerico') {
            Conex::insertNumer($_SESSION['idq'], $salida->getRespuesta());
        }
    }
    unset($_SESSION['examen']);
    unset($_SESSION['idq']);
    unset($_SESSION['idex']);
    header('location: ../vistas_comun/home.php');
}

/*
 * controlador agregar examen o pregunta a sesion
 */
if (isset($_POST['nuevo_examen'])) {
    require_once '../auxiliar/Objetos/Examen.php';
    session_start();
    $_SESSION['examen'] = new Examen($_POST['tittle'], $_POST['hour_end'], $_POST['date_end']);
    header('location: ../vistas_profesor/creation.php');
} else if (isset($_POST['nueva_pregunta'])) {
    require_once '../auxiliar/Objetos/Examen.php';
    require_once '../auxiliar/Objetos/Pregunta.php';
    require_once '../auxiliar/Objetos/Qopciones.php';
    require_once '../auxiliar/Objetos/Qrespuesta.php';
    session_start();
    $a = $_SESSION['examen'];
    if (isset($_POST['nueva_pregunta']) && $_POST['tittleq'] != '') {
        require_once 'auxiliar.php';
        Randomid::generate_string(20);
        /*
         * control del tipo de pregunta
         */
        if ($_POST['qtext'] != "") {
            $a->addPregunta(new Qrespuesta($_POST['tittleq'], 'texto', $_POST['qtext'], $_REQUEST['asignatura']));
        } else if ($_POST['numerica'] != "") {
            $a->addPregunta(new Qrespuesta($_POST['tittleq'], 'numerico', $_POST['numerica'], $_REQUEST['asignatura']));
        } else if ($_POST['Option'] != null && $_POST['radioq'] != '') {
            $aux = array();
            foreach ($_POST['Option'] as $como) {
                if ($como != '') {
                    $aux[] = $como;
                }
            }
            $a->addPregunta(new Qopciones($_POST['tittleq'], 'option', $aux, $_POST['radioq'], $_REQUEST['asignatura']));
        }
    }
    $_SESSION['examen'] = $a;
    header('location: ../vistas_profesor/creation.php');
} else if (isset($_POST['cancelar'])) {
    /*
     * cancelar el proceso de nuevo examen
     */
    session_start();
    unset($_SESSION['examen']);
    header('location: ../vistas_profesor/creation.php');
}