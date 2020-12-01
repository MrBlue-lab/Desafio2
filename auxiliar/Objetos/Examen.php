<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Examen
 *
 * @author daw205
 */
require_once __DIR__ . '/../auxiliar.php';

class Examen {

    private $id;
    private $titulo;
    private $fechacreacion;
    private $activo;
    private $fechaexpiracion;
    private $idcreador;
    private $preguntas;

    public function __construct() {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct' . $numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
    }

    function __construct3($titulo, $hora, $fecha) {
        $this->titulo = $titulo;
        $this->preguntas = array();
        if ($fecha != '') {
            $this->fechaexpiracion = $fecha . ' ' . $hora . ':00';
        } else {
            $this->fechaexpiracion = null;
        }
    }

    function __construct6($eid, $tittle, $active, $creation, $expire, $id_creator) {
        $this->titulo = $tittle;
        $this->id = $eid;
        $this->activo = $active;
        $this->fechacreacion = $creation;
        $this->fechaexpiracion = $expire;
        $this->idcreador = $id_creator;
    }

    function __construct8($titulo, $hora, $fecha, $eid, $active, $creation, $expire, $id_creator) {
        $this->titulo = $titulo;
        $this->preguntas = array();
        if ($fecha != '') {
            $this->fechaexpiracion = $fecha . ' ' . $hora . ':00';
        } else {
            $this->fechaexpiracion = null;
        }
        $this->id = $eid;
        $this->activo = $active;
        $this->fechacreacion = $creation;
        $this->fechaexpiracion = $expire;
        $this->idcreador = $id_creator;
    }

    function getId() {
        return $this->id;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getPreguntas() {
        return $this->preguntas;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setPreguntas($preguntas) {
        $this->preguntas = $preguntas;
    }

    function addPregunta(Pregunta $dato) {
        if ($dato != null) {
            $id = Randomid::generate_string(20);
            $dato->setQid($id);
            $this->preguntas [$id] = $dato;
        }
    }

    function addPreguntaId(Pregunta $dato) {
        if ($dato != null) {
            $this->preguntas [$dato->getQid()] = $dato;
        }
    }

    function isPreguntaId($id) {
        $salida = null;
        if ($this->preguntas [$id]) {
            $salida = $this->preguntas [$id];
        }
        return $salida;
    }

    function modPregunta(Pregunta $dato, $id) {
        if ($dato != null) {
            $dato->setQid($id);
            $this->preguntas [$id] = $dato;
        }
    }

    function dropPregunta($id) {
        unset($this->preguntas [$id]);
    }

    function updatePregunta(Pregunta $dato, $pos) {
        if ($dato != null) {
            $this->preguntas [$pos] = $dato;
        }
    }

    function getFechacreacion() {
        return $this->fechacreacion;
    }

    function getFechaE() {
        return substr($this->fechaexpiracion, 0, 10);
    }

    function getHoraE() {
        return substr($this->fechaexpiracion, 11);
    }

    function getActivo() {
        return $this->activo;
    }

    function getFechaexpiracion() {
        return $this->fechaexpiracion;
    }

    function getIdcreador() {
        return $this->idcreador;
    }

    function setFechacreacion($fechacreacion) {
        $this->fechacreacion = $fechacreacion;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }

    function setFechaexpiracion($fechaexpiracion) {
        $this->fechaexpiracion = $fechaexpiracion;
    }

    function setIdcreador($idcreador) {
        $this->idcreador = $idcreador;
    }

}
