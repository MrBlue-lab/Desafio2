<?php

/**
 * Description of Pregunta
 *
 * @author daw205
 */
class Pregunta {
    private $titulo;
    private $tipo;
    
    function __construct($titulo, $tipo) {
        $this->titulo = $titulo;
        $this->tipo = $tipo;
    }
    function getTitulo() {
        return $this->titulo;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setTitulo($titulo): void {
        $this->titulo = $titulo;
    }

    function setTipo($tipo): void {
        $this->tipo = $tipo;
    }

}
