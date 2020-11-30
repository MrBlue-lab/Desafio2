<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Crud usuario</title>
        <?php
        require_once '../diseño/extra.php';
        ?>
    </head>
    <body>
        <?php
        require_once '../estructura_pag/header.php';
        require_once '../auxiliar/Objetos/Conex.php';
        ?>
        <div class="creation-page p20 mt30">
            <h3 class="text-center">Añadir usuario</h3>
            <table class="egt">
                <tr>
                    <th class="text-center">EMAIL</th>
                    <th class="text-center">NOMBRE</th>
                    <th class="text-center">APELLIDO</th>
                    <th class="text-center">PASS</th>
                    <th class="text-center">ROL</th>
                    <th class="text-center">AÑADIR</th>
                </tr>
                <tr class="borde">
                <form name="for" action="../controladores/controlador_general.php" method="post" class="creation">
                    <td><input type="email" name="email" class="input_creation"  placeholder="Email"/></td>
                    <td><input type="text" name="nombre" class="input_creation" placeholder="Nombre"/></td>
                    <td><input type="text" name="apellido" class="input_creation" placeholder="Apellido"/></td>
                    <td><input type="password" name="pass" class="input_creation" placeholder="pass"/></td>
                    <td>
                        <select name="rol">
                            <option value="user" selected>User</option> 
                            <option value="profesor">Profesor</option>
                            <option value="admin">Administrador</option>
                        </select>     
                    </td>
                    <td><input type="submit" name="addUser" value="Añadir" class="btn botonsito"></td>
                </form>
                </tr>
            </table>
        </div>
        <div class="creation-page p20 mt30"><table class="egt">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">EMAIL</th>
                    <th class="text-center">NOMBRE</th>
                    <th class="text-center">APELLIDO</th>
                    <th class="text-center">ROL</th>
                    <th class="text-center">ACTUALIZAR</th>
                    <th class="text-center">BORRAR</th>
                </tr>
                <?php foreach (Conex::getUsers() as $user) { ?>
                    <tr class="borde">
                    <form name="for" action="../controladores/controlador_general.php" method="post" class="creation">
                        <td><input type="text" name="id" class="input_creation" value="<?= $user->getId() ?>" readonly=""/></td>
                        <td><input type="text" name="email" class="input_creation" value="<?= $user->getEmail() ?>" readonly=""/></td>
                        <td><input type="text" name="nombre" class="input_creation" value="<?= $user->getNombre() ?>"/></td>
                        <td><input type="text" name="apellido" class="input_creation" value="<?= $user->getApellidos() ?>"/></td>
                        <td>
                            <select name="rol">
                                <?php
                                if ($user->getRol() == 'user') {
                                    ?>
                                    <option value="user" selected>User</option> 
                                    <option value="profesor">Profesor</option>
                                    <option value="admin">Administrador</option>
                                    <?php
                                } else if ($user->getRol() == 'profesor') {
                                    ?>
                                    <option value="user">User</option> 
                                    <option value="profesor"selected>Profesor</option>
                                    <option value="admin">Administrador</option>
                                    <?php
                                } else if ($user->getRol() == 'admin') {
                                    ?>
                                    <option value="user">User</option> 
                                    <option value="profesor">Profesor</option>
                                    <option value="admin" selected="">Administrador</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                        <td><input type="submit" name="updateUser" value="Actualizar" class="btn botonsito"></td>
                        <td><input type="submit" name="dropUser" value="Delete" class="btn botonsitod"></td>
                    </form>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <?php
        require_once '../estructura_pag/foother.php';
        ?>
    </body>
</html>
