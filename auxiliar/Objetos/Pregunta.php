<?php

/**
 * Description of Pregunta
 *
 * @author daw205
 */
class Pregunta {

    private $qid;
    private $titulo;
    private $tipo;
    private $asig;
    private $fechaCreacion;

    function __construct($titulo, $tipo, $asig) {
        $this->titulo = $titulo;
        $this->tipo = $tipo;
        $this->asig = $asig;
    }

    function getFechaCreacion() {
        return $this->fechaCreacion;
    }

    function setFechaCreacion($fechaCreacion): void {
        $this->fechaCreacion = $fechaCreacion;
    }

    function getQid() {
        return $this->qid;
    }

    function setQid($qid): void {
        $this->qid = $qid;
    }

    function getAsig() {
        return $this->asig;
    }

    function setAsig($asig): void {
        $this->asig = $asig;
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
