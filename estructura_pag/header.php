<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" style="font-size: 31px;" href="../vistas/home.php">Delphosdos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../vistas/creation.php">Crear examen</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../vistas/creation_pregunta.php">Crear pregunta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../vistas/crud_ex_prop.php">Crud examenenes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../vistas/crud_usuarios.php">Crud usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../vistas/seeExamenes.php">Mis examenenes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../vistas/responder.php">Responder examen</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../vistas/prueba.php">Prueba</a>
            </li>
            <li class="nav-item">
                <form name="for" action="../controladores/controlador_general.php" method="post" class="login-form">
                    <input type="submit" class="btn botonsitod" name="back" value="salir">
                </form>
            </li>
            <li class="nav-item">
                <img src="../diseño/img/keanu.png" alt="alt" width="55px" style="position: absolute;z-index: 1000; margin-top: -9px; right: 50px;d"/>
            </li>
            <?php
            session_start();
            ?>
        </ul>
    </div>
</nav>