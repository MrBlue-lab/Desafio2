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
class Examen {

    private $id;
    private $titulo;
    private $fechacreacion;
    private $activo;
    private $fechaexpiracion;
    private $idcreador;
    private $preguntas;

    function __construct($titulo, $hora, $fecha) {
        $this->titulo = $titulo;
        $this->preguntas = array();
        if ($fecha != '') {
            $this->fechaexpiracion = $fecha . ' ' . $hora . ':00';
        } else {
            $this->fechaexpiracion = null;
        }
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
            $this->preguntas [] = $dato;
        }
    }
    
    function updatePregunta(Pregunta $dato,$pos) {
        if ($dato != null) {
            $this->preguntas [$pos] = $dato;
        }
    }

    function getFechacreacion() {
        return $this->fechacreacion;
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

    function setFechacreacion($fechacreacion): void {
        $this->fechacreacion = $fechacreacion;
    }

    function setActivo($activo): void {
        $this->activo = $activo;
    }

    function setFechaexpiracion($fechaexpiracion): void {
        $this->fechaexpiracion = $fechaexpiracion;
    }

    function setIdcreador($idcreador): void {
        $this->idcreador = $idcreador;
    }

}
