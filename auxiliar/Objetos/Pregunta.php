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
    private $hisory;

    function __construct3($titulo, $tipo, $asig) {
        $this->titulo = $titulo;
        $this->tipo = $tipo;
        $this->asig = $asig;
        $this->hisory = false;
    }
    function __construct4($qid,$titulo, $tipo, $asig) {
        $this->qid=$qid;
        $this->titulo = $titulo;
        $this->tipo = $tipo;
        $this->asig = $asig;
        $this->hisory = false;
    }

    public function __construct() {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct' . $numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
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

    function setQid($qid){
        $this->qid = $qid;
    }

    function getAsig() {
        return $this->asig;
    }

    function setAsig($asig){
        $this->asig = $asig;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setTitulo($titulo){
        $this->titulo = $titulo;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function getHisory() {
        return $this->hisory;
    }

    function setHisory($hisory) {
        $this->hisory = $hisory;
    }

}
