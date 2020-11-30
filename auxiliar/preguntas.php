<div id="demo"></div>
<script>
    function ShowSelected() {
        /* Para obtener el valor */
        var cod = document.getElementById("question").value;
        if (cod === "texto") {
            document.getElementById("demo").innerHTML = "<fieldset><legend>Respuesta texto</legend><div class='card-body'>" +
                    "<input type='text' placeholder='Respuesta' name='qtext' class='input_creation' required=''/></div></fieldset>" +
                    "<input type='submit' name='nueva_pregunta' value='Insertar pregunta' class='botonsito btn w10 text-center'>";
        }
        if (cod === "numero") {
            document.getElementById("demo").innerHTML =
                    "<fieldset><legend>Respuesta numerica</legend><div class='card-body'>" +
                    "<input type='number' value='0' name='numerica' class='input_creation' required=''/>" +
                    "</div></fieldset>" +
                    "<input type='submit' name='nueva_pregunta' value='Insertar pregunta' class='botonsito btn w10 text-center'>";
        }

        if (cod === "opcional") {
            document.getElementById("demo").innerHTML =
                    "<fieldset>" +
                    "<legend>Respuesta Opcional</legend>" +
                    "<div class='card-body'>" +
                    "<input type='text' placeholder='Opcion 1' name='Option[]' class='input_creation w70' required=''/>" +
                    "<input type='radio' id='radio0' name='radioq' value='0' checked=''><label> Correcto</label><br>" +
                    "<input type='text' placeholder='Opcion 2' name='Option[]' class='input_creation w70'/>" +
                    "<input type='radio' id='radio1' name='radioq' value='1'><label> Correcto</label><br>" +
                    "<input type='text' placeholder='Opcion 3' name='Option[]' class='input_creation w70'/>" +
                    "<input type='radio' id='radio2' name='radioq' value='2'><label> Correcto</label><br>" +
                    "<input type='text' placeholder='Opcion 4' name='Option[]' class='input_creation w70'/>" +
                    "<input type='radio' id='radio3' name='radioq' value='3'><label> Correcto</label><br>" +
                    "</div>" +
                    "</fieldset>" +
                    "<input type='submit' name='nueva_pregunta' value='Insertar pregunta' class='botonsito btn w10 text-center'>";
        }
    }

    function ShowQuest(salida) {
        var cod = document.getElementById("Demoexam" + salida).value;
        if (cod === "texto") {
            document.getElementById("demoEx" + salida).innerHTML = "<fieldset><div class='card-body'>" +
                    "<h4 class='s40p'>Respuesta: <input type='text' placeholder='Respuesta' name='qtext' class='input_creation w70' required=''/></h4></div></fieldset>" +
                    "<input type='submit' name='modificar_pregunta' value='Modificar pregunta' class='botonsito btn w10 text-center'>";
        }
        if (cod === "numero") {
            document.getElementById("demoEx" + salida).innerHTML =
                    "<fieldset><div class='card-body'>" +
                    "<h4 class='s40p'>Respuesta: <input type='number' value='0' name='numerica' class='input_creation w70' required=''/></h4>" +
                    "</div></fieldset>" +
                    "<input type='submit' name='modificar_pregunta' value='Modificar pregunta' class='botonsito btn w10 text-center'>";
        }

        if (cod === "opcional") {
            document.getElementById("demoEx" + salida).innerHTML =
                    "<fieldset>" +
                    "<div class='card-body'>" +
                    "<input type='text' placeholder='Opcion 1' name='Option[]' class='input_creation w70' required=''/>" +
                    "<input type='radio' id='radio0' name='radioq' value='0' checked=''><label> Correcto</label><br>" +
                    "<input type='text' placeholder='Opcion 2' name='Option[]' class='input_creation w70'/>" +
                    "<input type='radio' id='radio1' name='radioq' value='1'><label> Correcto</label><br>" +
                    "<input type='text' placeholder='Opcion 3' name='Option[]' class='input_creation w70'/>" +
                    "<input type='radio' id='radio2' name='radioq' value='2'><label> Correcto</label><br>" +
                    "<input type='text' placeholder='Opcion 4' name='Option[]' class='input_creation w70'/>" +
                    "<input type='radio' id='radio3' name='radioq' value='3'><label> Correcto</label><br>" +
                    "</div>" +
                    "</fieldset>" +
                    "<input type='submit' name='modificar_pregunta' value='Modificar pregunta' class='botonsito btn w10 text-center'>";
        }
    }
    function cambiaValores() {
        var inputNombre = document.getElementsById("nombre");
        inputNombre.value = "DYP";
    }
</script>
<!--

                $aux = $a->getPreguntas();
                $cont = 0;
                foreach ($aux as $i => $salida) {
                    echo '<div class="s90p"><h4>' . $cont . ') <input type="text" placeholder="titulo pregunta" name="tittleq" class="input_creation w97" required="" value="' . $salida->getTitulo() . '"/></h4>';
                    if ($salida->getTipo() == 'option') {
                        foreach ($salida->getOpciones() as $j => $fuera) {
                            if ($salida->getCorrecta() == '' . $j) {
                                echo '<h4 class="s40p">' . $j . ') <input type="text" placeholder="titulo pregunta" name="tittleq" class="input_creation w70" required="" value="' . $fuera. '"/> correcta</h4>';
                            } else {
                                echo '<h4 class="s40p">' . $j . ') <input type="text" placeholder="titulo pregunta" name="tittleq" class="input_creation w70" required="" value="' . $fuera. '"/>';
                            }
                        }
                    } else if ($salida->getTipo() != 'number') {
                        echo '<h4 class="s40p">Respuesta: <input type="text" placeholder="titulo pregunta" name="tittleq" class="input_creation w70" required="" value="' . $salida->getRespuesta() . '"/></h4>';
                    }
                    echo '</div>';
                    $cont++;
                }
-->