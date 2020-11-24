<!--
<div class="accordion row" id="accordionExample">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Texto
                </button>
            </h5>
        </div>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <input type="text" placeholder="Respuesta" name="tittle" class="input_creation"/>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Numerico
                </button>
            </h5>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
                <input type="number" placeholder="Respuesta" name="numerica" class="input_creation"/>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingThree">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Opciones
                </button>
            </h5>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="card-body">
                <input type="text" placeholder="Opcion 1" name="Option[]" class="input_creation"/>
                <input type="text" placeholder="Opcion 2" name="Option[]" class="input_creation"/>
                <input type="text" placeholder="Opcion 3" name="Option[]" class="input_creation"/>
                <input type="text" placeholder="Opcion 4" name="Option[]" class="input_creation"/>
                <input type="text" placeholder="Opcion 5" name="Option[]" class="input_creation"/>
                <input type="text" placeholder="Opcion 6" name="Option[]" class="input_creation"/>
            </div>
        </div>
    </div>
</div>
<br><br>
<hr>
<fieldset>
    <legend>Respuesta texto</legend>
    <div class="card-body">
        <input type="text" placeholder="Respuesta" name="qtext" class="input_creation"/>
    </div>
</fieldset>
<hr>
<fieldset>
    <legend>Respuesta numerica</legend>
    <div class="card-body">
        <input type="number" placeholder="Respuesta" name="numerica" class="input_creation"/>
    </div>
</fieldset>
<hr>
<fieldset>
    <legend>Respuesta Opcional</legend>
    <div class="card-body">
        <input type="text" placeholder="Opcion 1" name="Option[]" class="input_creation"/>
        <input type="text" placeholder="Opcion 2" name="Option[]" class="input_creation"/>
        <input type="text" placeholder="Opcion 3" name="Option[]" class="input_creation"/>
        <input type="text" placeholder="Opcion 4" name="Option[]" class="input_creation"/>
        <input type="text" placeholder="Opcion 5" name="Option[]" class="input_creation"/>
        <input type="text" placeholder="Opcion 6" name="Option[]" class="input_creation"/>
    </div>
</fieldset>
<hr>
-->

<div id="demo"></div>
<script>
    function ShowSelected() {
        /* Para obtener el valor */
        var cod = document.getElementById("question").value;
        if (cod === "texto") {
            document.getElementById("demo").innerHTML = "<hr><fieldset><legend>Respuesta texto</legend><div class='card-body'>" +
                    "<input type='text' placeholder='Respuesta' name='qtext' class='input_creation' required=''/></div></fieldset>" +
                    "<input type='submit' name='nueva_pregunta' value='Insertar pregunta' class='botonsito btn w10 text-center'>";
        }
        if (cod === "numero") {
            document.getElementById("demo").innerHTML =
                    "<hr><fieldset><legend>Respuesta numerica</legend><div class='card-body'>" +
                    "<input type='number' value='0' name='numerica' class='input_creation' required=''/>" +
                    "</div></fieldset>" +
                    "<input type='submit' name='nueva_pregunta' value='Insertar pregunta' class='botonsito btn w10 text-center'>";
        }

        if (cod === "opcional") {
            document.getElementById("demo").innerHTML =
                    "<hr><fieldset>" +
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
</script>