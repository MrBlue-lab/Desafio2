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
        self::$Conexion = new mysqli('localhost', 'sergio', 'Chubaca2020', 'desafio2');
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
        require_once 'auxiliar.php';
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
     * funcion insertar usuarios oo
     * @param type $email
     * @param type $nombre
     * @param type $pass
     */
    static function insertUser($email, $nombre, $apellidos, $password) {
        self::Nueva();
        require_once 'auxiliar.php';
        if ($stmt = self::$Conexion->prepare('INSERT INTO user (uid, email, nombre, apellidos, pasword) VALUES (?,?,?,?,?)')) {
            $stmt->bind_param("sssss", Randomid::generate_string(20), $email, $nombre, $apellidos, md5($password));
            $stmt->execute();
            $stmt->close();
        }
        self::closeConexion();
    }

    static function addUser($email, $nombre, $apellidos, $password, $rol) {
        self::Nueva();
        require_once 'auxiliar.php';
        if ($stmt = self::$Conexion->prepare('INSERT INTO user (uid, email, nombre, apellidos, pasword,id_rol) VALUES (?,?,?,?,?,?)')) {
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
            $stmt->bind_result($uid, $email, $nombre, $apellidos, $pasword, $id_rol);

            while ($stmt->fetch()) {
                $u = new User($uid, $email, $nombre, $apellidos, $pasword, $id_rol);
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
    static function updateUser($uid, $email, $nombre, $apellidos, $id_rol) {
        self::Nueva();
        if ($stmt = self::$Conexion->prepare('UPDATE user SET email=?, nombre=?,apellidos=?,  id_rol=? WHERE uid=?')) {
            $stmt->bind_param("sssis", $email, $nombre, $apellidos, $id_rol, $uid);
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
        require_once 'auxiliar.php';
        require_once 'User.php';
        $id = Randomid::generate_string(20);
        $idu = $user->getId();
        $fecha = $ex->getFechaHora();
        $titulo = $ex->getTitulo();
        if ($stmt = self::$Conexion->prepare('INSERT INTO examen (eid, tittle, active, creation, expire, id_creator) VALUES (?,?,1,NOW(),?,?)')) {
            $stmt->bind_param("ssss", $id, $titulo, $fecha, $idu);
            $stmt->execute();
            $stmt->close();
        }
        self::closeConexion();
        $_SESSION['idex'] = $id;
    }

    static function getExamen() {
        require_once 'Examen.php';
        $salida = array();
        self::Nueva();
        if ($stmt = self::$Conexion->prepare('SELECT * FROM examen')) {
            $stmt->execute();
            $stmt->bind_result($eid, $tittle, $active, $creation, $expire, $id_creator);

            while ($stmt->fetch()) {
                $u = new Examen($tittle, $expire, $creation);
                $salida[] = $u;
            }
            $stmt->close();
            self::closeConexion();
            return $salida;
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
        require_once 'auxiliar.php';
        require_once 'Pregunta.php';
        require_once 'User.php';
        $id = Randomid::generate_string(20);
        $titulo = $ex->getTitulo();
        $tipo = $ex->getTipo();
        if ($stmt = self::$Conexion->prepare('INSERT INTO quiz (qid, nombre, type, eid, creation) VALUES (?, ?, ?, ?, NOW())')) {
            $stmt->bind_param("ssss", $id, $titulo, $tipo, $idex);
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
        require_once 'auxiliar.php';
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
        require_once 'auxiliar.php';
        require_once 'Pregunta.php';
        require_once 'Qopciones.php';
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
        require_once 'auxiliar.php';
        require_once 'Pregunta.php';
        require_once 'Qopciones.php';
        require_once 'User.php';
        $id = Randomid::generate_string(20);
        if ($stmt = self::$Conexion->prepare('INSERT INTO number (nid, qid, sol) VALUES (?,?,?)')) {
            $stmt->bind_param("ssi", $id, $idq, $res);
            $stmt->execute();
            $stmt->close();
        }
        self::closeConexion();
    }

}
