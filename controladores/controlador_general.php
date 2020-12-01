<?php

//Biblioteca

require_once '../auxiliar/auxiliar.php';
require_once '../auxiliar/Objetos/User.php';
require_once '../auxiliar/Objetos/Conex.php';
require_once '../auxiliar/Objetos/Examen.php';
require_once '../auxiliar/Objetos/Pregunta.php';
require_once '../auxiliar/Objetos/Qrespuesta.php';
require_once '../auxiliar/Objetos/Qopciones.php';
require_once '../auxiliar/PHPMailer/EnviarCorreo.php';
/*
 * controlador loguin / roles
 */
if (isset($_POST['loguin'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    if ($u = Conex::isUser($email, $pass)) {
        session_start();
        $_SESSION['loguin'] = $u;
        if ($u->getRol() == 'user') {
            header('location: ../vistas/home.php');
        } else if ($u->getRol() == 'profesor') {
            header('location: ../vistas/home.php');
        } else if ($u->getRol() == 'admin') {
            header('location: ../vistas/home.php');
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
    Conex::addUser($_POST['email'], $_POST['nombre'], $_POST['apellido'], $_POST['pass'], $_POST['rol']);
    header('location: ../vistas/crud_usuarios.php');
}

/*
 * controlador actualizar usuario
 */
if (isset($_POST['updateUser'])) {
    Conex::updateUser($_POST['id'], $_POST['email'], $_POST['nombre'], $_POST['apellido'], $_POST['rol']);
    header('location: ../vistas/crud_usuarios.php');
}

/*
 * controlador eliminar usuario
 */
if (isset($_POST['dropUser'])) {
    Conex::dropUser($_POST['id']);
    header('location: ../vistas/crud_usuarios.php');
}

/*
 * controlador registro
 */
if (isset($_POST['registro'])) {
    Conex::insertUser($_POST['email'], $_POST['nombre'], $_POST['apellidos'], $_POST['pass']);
    header('location: ../index.php');
}

/*
 * ******************************************************************************
 * ********************************************* controlador agregar examen a bd
 */
if (isset($_POST['addExamen'])) {
    session_start();
    Conex::insertExamen($_SESSION['loguin'], $_SESSION['examen']);

    $aux = $_SESSION['examen']->getPreguntas();
    //comprobar si la pregunta existe
    foreach ($aux as $i => $salida) {
        if (Conex::isPreunta($i) == null) {
            $idpreunta = Conex::insertPregunta($salida);
            Conex::insertPreguntaExamen($_SESSION['idex'], $idpreunta);
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
        } else {
            Conex::insertPreguntaExamen($_SESSION['idex'], $i);
        }
    }
    unset($_SESSION['examen']);
    unset($_SESSION['idq']);
    unset($_SESSION['idex']);
    header('location: ../vistas/home.php');
}
/*
 * ******************************************************************************
 * ********************************************* controlador agregar examen a bd
 */
if (isset($_POST['nueva_pregunta_bd'])) {
    session_start();
    /*
     * control del tipo de pregunta
     */
    $id = Conex::insertPregunta(new Pregunta($_POST['tittleq'], $_POST['question'], $_POST['asignatura']));
    if ($_POST['qtext'] != "") {
        Conex::insertTexto($id, $_POST['qtext']);
    } else if ($_POST['numerica'] != "") {
        Conex::insertNumer($id, $_POST['numerica']);
    } else if ($_POST['Option'] != null && $_POST['radioq'] != '') {
        $aux = array();
        foreach ($_POST['Option'] as $a => $como) {
            if ($como != '') {
                $es = 0;
                if ($a == $_POST['radioq']) {
                    $es = 1;
                }
                Conex::insertOpcion($id, $como, $es);
            }
        }
        $a->addPregunta(new Qopciones($_POST['tittleq'], 'option', $aux, $_POST['radioq'], $_REQUEST['asignatura']));
    }
    header('location: ../vistas/home.php');
}

/*
 * controlador agregar examen o pregunta a sesion
 */
if (isset($_POST['nuevo_examen'])) {
    session_start();
    $_SESSION['examen'] = new Examen($_POST['tittle'], $_POST['hour_end'], $_POST['date_end']);
    $Preguntast = Conex::getPreguntasTipo();
    foreach ($Preguntast as $a => $salida) {
        foreach ($salida as $j => $q) {
            if ($q->getTipo() == 'option') {
                Conex::getOptions($salida[$j]);
                $Preguntast[$a] = $salida;
            } else if ($q->getTipo() == 'texto') {
                Conex::getQTexto($salida[$j]);
                $Preguntast[$a] = $salida;
            } else if ($q->getTipo() == 'numerico') {
                Conex::getNumerico($salida[$j]);
                $Preguntast[$a] = $salida;
            }
        }
    }
    $_SESSION['QuizH'] = $Preguntast;
    header('location: ../vistas/creation.php');
}
if (isset($_POST['nueva_pregunta'])) {
    session_start();
    $a = $_SESSION['examen'];
    if (isset($_POST['nueva_pregunta']) && $_POST['tittleq'] != '') {
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
    header('location: ../vistas/creation.php');
}
if (isset($_POST['agregar_pregunta_history'])) {
    session_start();
    $a = $_SESSION['examen'];
    $idquest = $_POST['idpregunta'];
    if ($a->isPreguntaId($idquest) == null) {
        $quest = Conex::getPreguntaId($idquest);
        if ($quest->getTipo() == 'option') {
            Conex::getOptions($quest);
        } else if ($quest->getTipo() == 'numerico') {
            Conex::getNumerico($quest);
        } else {
            Conex::getQTexto($quest);
        }
        $quest->setHisory(true);
        $a->addPreguntaId($quest);
        $_SESSION['examen'] = $a;
    }
    header('location: ../vistas/creation.php');
}
if (isset($_POST['modificar_pregunta'])) {
    session_start();
    $a = $_SESSION['examen'];
    $idpregunta = $_POST['idpregunta'];
    if ($_POST['tittleq'] != '') {
        if ($_POST['qtext'] != "") {
            $a->modPregunta(new Qrespuesta($_POST['tittleq'], 'texto', $_POST['qtext'], $_REQUEST['asignatura']), $idpregunta);
        } else if ($_POST['numerica'] != "") {
            $a->modPregunta(new Qrespuesta($_POST['tittleq'], 'numerico', $_POST['numerica'], $_REQUEST['asignatura']), $idpregunta);
        } else if ($_POST['Option'] != null && $_POST['radioq'] != '') {
            $aux = array();
            foreach ($_POST['Option'] as $como) {
                if ($como != '') {
                    $aux[] = $como;
                }
            }
            $a->modPregunta(new Qopciones($_POST['tittleq'], 'option', $aux, $_POST['radioq'], $_REQUEST['asignatura']), $idpregunta);
        }
    }
    $_SESSION['examen'] = $a;
    header('location: ../vistas/creation.php');
}
if (isset($_POST['borrar_pregunta'])) {
    session_start();
    $a = $_SESSION['examen'];
    $idpregunta = $_POST['idpregunta'];
    $a->dropPregunta($idpregunta);
    $_SESSION['examen'] = $a;
    header('location: ../vistas/creation.php');
}
if (isset($_POST['cancelar'])) {
    /*
     * cancelar el proceso de nuevo examen
     */
    session_start();
    unset($_SESSION['examen']);
    header('location: ../vistas/creation.php');
}


// Botón de solicitar nuevo password
if (isset($_REQUEST['solicitar_password'])) {
    // Recupero lo datos del formulario
    $correo = $_REQUEST['correo'];
    // Comprueba el correo para ver si el usuario esta registrado
    if (Conex::existePersona($correo)) {
        // Si existe creo una nueva
        $nuevoPass = Randomid::generate_string(10);
        // Inserto la nueva contraseña en la base de datos
        Conex::nuevoPass($correo, $nuevoPass);
        // Envio el correo
        EnviarCorreo::nuevoCorreo($correo, $nuevoPass);
    }
    // Muestro existo tanto este registrado o no, por motivos de seguridad
    header('Location: ../vistas/exito_cambio_pass.php');
}
if (isset($_REQUEST['deleteExamen'])) {
    $id = $_REQUEST['eid'];
    if (Conex::isExamen($id)) {
        Conex::dropPreguntasEx($id);
        Conex::dropEx($id);
    }
    header('Location: ../vistas/crud_ex_prop.php');
}
if (isset($_REQUEST['updateExamen'])) {
    $id = $_REQUEST['eid'];
    if (Conex::isExamen($id)) {
        $exTitulo = $_REQUEST['exTitulo'];
        $exFechaE = $_REQUEST['exFechaE'];
        $exHoraE = $_REQUEST['exHoraE'];
        $exFechaHora = $exFechaE . ' ' . $exHoraE;
        Conex::updateEx($id, $exFechaHora, $exTitulo);
    }
    header('Location: ../vistas/crud_ex_prop.php');
}
if (isset($_REQUEST['addExamenN'])) {
    session_start();
    $exTitulo = $_REQUEST['exTitulo'];
    $exFechaE = $_REQUEST['exFechaE'];
    $exHoraE = $_REQUEST['exHoraE'];
    $exFechaHoraE = $exFechaE . ' ' . $exHoraE;
    Conex::addEx($_SESSION['loguin'], $exFechaHoraE, $exTitulo);
    header('Location: ../vistas/crud_ex_prop.php');
}
if (isset($_REQUEST['modificar_see_examen'])) {
    $id = $_REQUEST['eid'];
    if (Conex::isExamen($id)) {
        $exFechaE = $_REQUEST['date_end'];
        $exHoraE = $_REQUEST['hour_end'];
        $exTitulo = $_REQUEST['title_end'];
        $exFechaHora = $exFechaE . ' ' . $exHoraE;
        Conex::updateEx($id, $exFechaHora, $exTitulo);
    }
    header('Location: ../vistas/seeExamenes.php');
}
if (isset($_REQUEST['desactivar_examen']) || isset($_REQUEST['activar_examen'])) {
    $id = $_REQUEST['eid'];
    if (Conex::isExamen($id)) {
        if (isset($_REQUEST['activar_examen'])) {
            Conex::activoEx($id,1);
        } else {
            Conex::activoEx($id,0);
        }
    }
    header('Location: ../vistas/seeExamenes.php');
}
