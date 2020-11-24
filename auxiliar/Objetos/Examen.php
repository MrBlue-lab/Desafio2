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

    private $titulo;
    private $hora;
    private $fecha;
    private $preguntas;

    function __construct($titulo, $hora, $fecha) {
        $this->titulo = $titulo;
        $this->hora = $hora;
        $this->fecha = $fecha;
        $this->preguntas = array();
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getHora() {
        return $this->hora;
    }

    function getFecha() {
        return $this->fecha;
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

    function getFechaHora() {
        if ($this->fecha == '') {
            $salida = null;
        } else {
            $salida = $this->fecha . ' ' . $this->hora . ':00';
        }
        return $salida;
    }

}
