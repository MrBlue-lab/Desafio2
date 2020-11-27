<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php
        require_once '../diseño/extra.php';
        ?>
    </head>
    <body>
        <?php
        require_once '../estructura_pag/header.php';
        ?>
      <div class = "container">
         <h2>Collapse with Link</h2>
         <p>
            <a class = "btn btn-info" data-toggle = "collapse" 
               href = "#collapsewithlink" role = "button" aria-expanded = "false" 
               aria-controls = "collapsewithlink">Click Me</a>
         </p>
         
         <div class = "collapse" id = "collapsewithlink">
            <div class = "card card-body">
               Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
               tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim 
               veniam, quis nostrud exercitation.
            </div>
         </div>
      </div>
      
        <?php
        require_once '../estructura_pag/foother.php';
        ?>
    </body>
</html>
