<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conex
 * Conexion como el atributo estatico de la clase conexion
 * @author daw205
 */
class Conex {

    private static $Conexion;

    static function Nueva() {
        require_once __DIR__ . '/../Constantes.php';
        self::$Conexion = new mysqli(Constantes::$ruta, Constantes::$usuario, Constantes::$password, Constantes::$BBDD);
    }

    static function closeConexion() {
        self::$Conexion->close();
    }

    /**
     * funcion comprobar si existe usuario oo
     * @param type User
     */
    static function isUser($email, $password) {
        require_once 'User.php';
        self::Nueva();
        $u = false;
        if ($stmt = self::$Conexion->prepare('SELECT * FROM user WHERE email = ? AND pasword = ?')) {
            $stmt->bind_param("ss", $email, md5($password));
            $stmt->execute();
            $stmt->bind_result($id, $email, $nombre, $apellidos, $pass, $rol);

            if ($stmt->fetch()) {
                $u = new User($id, $email, $nombre, $apellidos, $pass, $rol);
            }
            $stmt->close();
            self::closeConexion();
        }
        return $u;
    }

    /**
     * 
     * @param type $email
     * @return \User
     */
    static function existePersona($email) {
        require_once 'User.php';
        self::Nueva();
        $u = false;
        if ($stmt = self::$Conexion->prepare('SELECT * FROM user WHERE email = ?')) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($id, $email, $nombre, $apellidos, $pass, $rol);

            if ($stmt->fetch()) {
                $u = new User($id, $email, $nombre, $apellidos, $pass, $rol);
            }
            $stmt->close();
            self::closeConexion();
        }
        return $u;
    }

    /**
     * cambia la contraseña del usuario
     * @param type $email
     * @param type $pass
     */
    static function nuevoPass($email, $pass) {
        self::Nueva();
        if ($stmt = self::$Conexion->prepare('UPDATE user SET pasword=? WHERE email=?')) {
            $stmt->bind_param("ss", md5($pass), $email);
            $stmt->execute();
            $stmt->close();
        }
        self::closeConexion();
    }

    /**
     * funcion insertar usuarios oo
     * @param type $email
     * @param type $nombre
     * @param type $pass
     */
    static function insertUser($email, $nombre, $apellidos, $password) {
        self::Nueva();
        require_once __DIR__ . '/../auxiliar.php';
        if ($stmt = self::$Conexion->prepare('INSERT INTO user (uid, email, nombre, apellidos, pasword) VALUES (?,?,?,?,?)')) {
            $stmt->bind_param("sssss", Randomid::generate_string(20), $email, $nombre, $apellidos, md5($password));
            $stmt->execute();
            $stmt->close();
        }
        self::closeConexion();
    }

    static function addUser($email, $nombre, $apellidos, $password, $rol) {
        self::Nueva();
        require_once __DIR__ . '/../auxiliar.php';
        if ($stmt = self::$Conexion->prepare('INSERT INTO user (uid, email, nombre, apellidos, pasword,rol) VALUES (?,?,?,?,?,?)')) {
            $stmt->bind_param("sssssi", Randomid::generate_string(20), $email, $nombre, $apellidos, md5($password), $rol);
            $stmt->execute();
            $stmt->close();
        }
        self::closeConexion();
    }

    /**
     * funcion obtener usuarios oo
     * @return users devuelve una lista de usuarios
     */
    static function getUsers() {
        require_once 'User.php';
        $salida = array();
        self::Nueva();
        if ($stmt = self::$Conexion->prepare('SELECT * FROM user')) {
            $stmt->execute();
            $stmt->bind_result($uid, $email, $nombre, $apellidos, $pasword, $rol);

            while ($stmt->fetch()) {
                $u = new User($uid, $email, $nombre, $apellidos, $pasword, $rol);
                $salida[] = $u;
            }
            $stmt->close();
            self::closeConexion();
            return $salida;
        }
    }

    /**
     * funcion actualizar usuarios oo
     * @param type $uid
     * @param type $email
     * @param type $nombre
     * @param type $apellidos
     * @param type $id_rol
     */
    static function updateUser($uid, $email, $nombre, $apellidos, $rol) {
        self::Nueva();
        if ($stmt = self::$Conexion->prepare('UPDATE user SET email=?, nombre=?,apellidos=?, rol=? WHERE uid=?')) {
            $stmt->bind_param("sssss", $email, $nombre, $apellidos, $rol, $uid);
            $stmt->execute();
            $stmt->close();
        }
        self::closeConexion();
    }

    /**
     * funcion borrar usuario oo
     * @param type $id
     */
    static function dropUser($id) {
        self::Nueva();
        if ($stmt = self::$Conexion->prepare('DELETE FROM user WHERE uid=?')) {
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $stmt->close();
        }
        self::closeConexion();
    }

    /**
     * 
     * @param type $user
     * @param type $examen
     */
    static function insertExamen($user, $ex) {
        self::Nueva();
        require_once 'Examen.php';
        require_once __DIR__ . '/../auxiliar.php';
        require_once 'User.php';
        $id = Randomid::generate_string(20);
        $idu = $user->getId();
        $fecha = $ex->getFechaexpiracion();
        $titulo = $ex->getTitulo();
        if ($stmt = self::$Conexion->prepare('INSERT INTO examen (eid, tittle, active, creation, expire, id_creator) VALUES (?,?,1,NOW(),?,?)')) {
            $stmt->bind_param("ssss", $id, $titulo, $fecha, $idu);
            $stmt->execute();
            $stmt->close();
        }
        self::closeConexion();
        $_SESSION['idex'] = $id;
    }

    /**
     * 
     * @return \Examen
     */
    static function getExamen() {
        require_once 'Examen.php';
        $salida = array();
        self::Nueva();
        if ($stmt = self::$Conexion->prepare('SELECT * FROM examen  ORDER BY creation DESC')) {
            $stmt->execute();
            $stmt->bind_result($eid, $tittle, $active, $creation, $expire, $id_creator);

            while ($stmt->fetch()) {
                $u = new Examen($tittle, $expire, $creation);
                $u->setId($eid);
                $u->setActivo($active);
                $u->setFechacreacion($creation);
                $u->setFechaexpiracion($expire);
                $u->setIdcreador($id_creator);
                $salida[] = $u;
            }
            $stmt->close();
            self::closeConexion();
            return $salida;
        }
    }

    static function getPreguntas(&$ex) {
        require_once 'Pregunta.php';
        require_once 'Qopciones.php';
        require_once 'Qrespuesta.php';
        require_once 'Examen.php';
        self::Nueva();
        $eid = $ex->getId();
        if ($stmt = self::$Conexion->prepare('SELECT quiz.* FROM quiz,examen_quiz WHERE examen_quiz.eid=? AND examen_quiz.qid=quiz.qid ')) {
            $stmt->bind_param("s", $eid);
            $stmt->execute();
            $stmt->bind_result($qid, $titulo, $tipo, $asig, $fechaCreacion);

            while ($stmt->fetch()) {
                $p = new Pregunta($titulo, $tipo, $asig);
                $p->setQid($qid);
                $p->setFechaCreacion($fechaCreacion);
                $ex->addPregunta($p);
            }
            $stmt->close();
            self::closeConexion();
        }
    }

    /**
     * 
     * @param type $idex
     * @param type $ex
     * @return type
     */
    static function insertPregunta($idex, $ex) {
        self::Nueva();
        require_once 'Examen.php';
        require_once __DIR__ . '/../auxiliar.php';
        require_once 'Pregunta.php';
        require_once 'User.php';
        $id = Randomid::generate_string(20);
        $titulo = $ex->getTitulo();
        $tipo = $ex->getTipo();
        $asig = $ex->getAsig();
        /** esto se editara para que la asignatura ordene las preguntas* */
        $tema = 'nada';
        if ($stmt = self::$Conexion->prepare('INSERT INTO quiz (qid, nombre, type, asignatura, creation) VALUES (?, ?, ?, ?, NOW())')) {
            $stmt->bind_param("ssss", $id, $titulo, $tipo, $asig);
            $stmt->execute();
            $stmt->close();
        }
        if ($stmt = self::$Conexion->prepare('INSERT INTO examen_quiz (eid, qid) VALUES (?, ?)')) {
            $stmt->bind_param("ss", $idex, $id);
            $stmt->execute();
            $stmt->close();
        }
        self::closeConexion();
        $_SESSION['idq'] = $id;
    }

    /**
     * 
     * @param type $idq
     * @param type $res
     * @param type $es
     * @return type
     */
    static function insertOpcion($idq, $res, $es) {
        self::Nueva();
        require_once 'Examen.php';
        require_once __DIR__ . '/../auxiliar.php';
        require_once 'Pregunta.php';
        require_once 'Qopciones.php';
        require_once 'User.php';
        $id = Randomid::generate_string(20);
        if ($stmt = self::$Conexion->prepare('INSERT INTO options (oid, qid, nombre,correcta) VALUES (?,?,?,?)')) {
            $stmt->bind_param("ssss", $id, $idq, $res, $es);
            $stmt->execute();
            $stmt->close();
        }
        self::closeConexion();
    }

    /**
     * 
     * @param type $idq
     * @param type $res
     */
    static function insertTexto($idq, $res) {
        self::Nueva();
        require_once 'Examen.php';
        require_once __DIR__ . '/../auxiliar.php';
        require_once 'Pregunta.php';
        require_once 'Qrespuesta.php';
        require_once 'User.php';
        $id = Randomid::generate_string(20);
        if ($stmt = self::$Conexion->prepare('INSERT INTO text (tid, qid, tittle) VALUES (?,?,?)')) {
            $stmt->bind_param("sss", $id, $idq, $res);
            $stmt->execute();
            $stmt->close();
        }
        self::closeConexion();
    }

    /**
     * 
     * @param type $idq
     * @param type $res
     */
    static function insertNumer($idq, $res) {
        self::Nueva();
        require_once 'Examen.php';
        require_once __DIR__ . '/../auxiliar.php';
        require_once 'Pregunta.php';
        require_once 'Qrespuesta.php';
        require_once 'User.php';
        $id = Randomid::generate_string(20);
        if ($stmt = self::$Conexion->prepare('INSERT INTO number (nid, qid, sol) VALUES (?,?,?)')) {
            $stmt->bind_param("ssi", $id, $idq, $res);
            $stmt->execute();
            $stmt->close();
        }
        self::closeConexion();
    }

    static function getOptions(&$qui) {
        require_once 'Pregunta.php';
        require_once 'Qopciones.php';
        require_once 'Qrespuesta.php';
        require_once 'Examen.php';
        self::Nueva();
        $eid = $qui->getQid();
        if ($stmt = self::$Conexion->prepare('SELECT DISTINCT options.nombre,options.correcta FROM quiz,options WHERE options.qid=?')) {
            $stmt->bind_param("s", $eid);
            $stmt->execute();
            $stmt->bind_result($nombre, $correcta);
            $options = array();
            $correctas = array();
            $cont = 0;
            while ($stmt->fetch()) {
                if ($correcta == 0) {
                    $cont++;
                    $options[] = $nombre;
                } else {
                    $options[] = $nombre;
                    $correctas[] = $cont;
                    $cont++;
                }
            }
            $p = new Qopciones($qui->getTitulo(), $qui->getTipo(), $options, $correctas, $qui->getAsig());
            $p->setQid($qui->getQid());
            $p->setFechaCreacion($qui->getFechaCreacion());
            $qui = $p;
            $stmt->close();
            self::closeConexion();
        }
    }

}
