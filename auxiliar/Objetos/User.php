<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author daw205
 */
class User {

    private $id;
    private $email;
    private $nombre;
    private $apellidos;
    private $pass;
    private $rol;

    function __construct($id, $email, $nombre, $apellidos, $pass, $rol) {
        $this->id = $id;
        $this->email = $email;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->pass = $pass;
        $this->rol = $rol;
    }


    function getEmail() {
        return $this->email;
    }
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }
    function getNombre() {
        return $this->nombre;
    }

        function getPass() {
        return $this->pass;
    }

    function getRol() {
        return $this->rol;
    }

    function setEmail($email){
        $this->email = $email;
    }

    function setNombre($nombre){
        $this->nombre = $nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setPass($pass){
        $this->pass = $pass;
    }

    function setRol($rol){
        $this->rol = $rol;
    }

}
