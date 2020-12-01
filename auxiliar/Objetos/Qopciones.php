<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Qopciones
 *
 * @author daw205
 */
require_once 'Pregunta.php';

class Qopciones extends Pregunta {

    private $opciones;
    private $correcta;

    function __construct($titulo, $tipo, $opciones, $correcta, $asig) {
        $this->opciones = $opciones;
        $this->correcta = $correcta;
        parent::__construct($titulo, $tipo, $asig);
    }

    function getCorrecta() {
        return $this->correcta;
    }

    function setCorrecta($correcta){
        $this->correcta = $correcta;
    }

    function getOpciones() {
        return $this->opciones;
    }

    function setOpciones($opciones){
        $this->opciones = $opciones;
    }
    
}
