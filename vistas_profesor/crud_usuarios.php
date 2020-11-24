<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Creacion de examen</title>
        <?php
        require_once '../diseño/extra.php';
        ?>
    </head>
    <body>
        <?php
        require_once '../estructura_pag/header.php';
        session_start();
        require_once '../auxiliar/Objetos/Conex.php';
        ?>
        
        <div class="creation-page">
            <h3 class="text-center">Añadir usuario</h3>
            <form name="for" action="../controladores/controlador_general.php" method="post" class="creation">
                <input type="email" name="email" class="input_creation w20"  placeholder="Email"/>
                <input type="text" name="nombre" class="input_creation w20" placeholder="Nombre"/>
                <input type="text" name="apellido" class="input_creation w20" placeholder="Apellido"/>
                <input type="password" name="pass" class="input_creation w20" placeholder="pass"/>
                <input type="number" name="rol" class="input_creation w10"  width="2" value="0"/>
                <input type="submit" name="addUser" value="Añadir" class="btn botonsito w10">
            </form>
        </div>
        <div class="creation-page">
            <?php foreach (Conex::getUsers() as $user) { ?>
                <form name="for" action="../controladores/controlador_general.php" method="post" class="creation">
                    <input type="text" name="id" class="input_creation w20" value="<?= $user->getId() ?>" readonly=""/>
                    <input type="text" name="email" class="input_creation w20" value="<?= $user->getEmail() ?>" readonly=""/>
                    <input type="text" name="nombre" class="input_creation w20" value="<?= $user->getNombre() ?>"/>
                    <input type="text" name="apellido" class="input_creation w20" value="<?= $user->getApellidos() ?>"/>
                    <input type="number" name="rol" class="input_creation w10" value="<?= $user->getRol() ?>" width="2"/>
                    <input type="submit" name="updateUser" value="Actualizar" class="btn botonsito w10">
                    <input type="submit" name="dropUser" value="Delete" class="btn botonsitod w10">
                </form>
                <hr>
            <?php } ?>
        </div>
        <?php
        require_once '../estructura_pag/foother.php';
        ?>
    </body>
</html>
