<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Qrespuesta
 *
 * @author daw205
 */
class Qrespuesta  extends Pregunta {
    private $respuesta;
    function __construct($titulo, $tipo, $respuesta) {
        $this->respuesta = $respuesta;
        parent::__construct($titulo, $tipo);
    }

    function getRespuesta() {
        return $this->respuesta;
    }

    function setRespuesta($respuesta): void {
        $this->respuesta = $respuesta;
    }


}
