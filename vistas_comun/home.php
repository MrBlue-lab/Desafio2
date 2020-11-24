<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Home</title>
        <?php
        require_once '../diseño/extra.php';
        ?>
    </head>
    <body>
        <?php
        require_once '../estructura_pag/header.php';
        ?>
        
        <div class="modal-body row pm0">
            
            <div class="col-md-6 pr0">
                <div class="creation-page">
                <div class = "container">
                    <h2>Loguin correcto</h2>
                    <p>
                        <a class = "btn botonsito" data-toggle = "collapse" href = "#collapsewithlink" role = "button" aria-expanded = "false" aria-controls = "collapsewithlink">
                            Click Me
                        </a>
                    </p>

                    <div class = "collapse" id = "collapsewithlink">
                        <div class = "card card-body">
                            esto es una prueba del loguin
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-6 pr0">
                <img src="../auxiliar/peridot.png" alt="alt"/>
            </div>
        </div>

        <?php
        require_once '../estructura_pag/foother.php';
        ?>
    </body>
</html>
