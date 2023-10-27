<?php
session_start();
require_once("../../conexion.php");
require_once ("../../libreria_menu.php");


$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
      <p> &nbsp;</p>";

/*$sql = $db->Prepare("SELECT *
                     FROM _personas
                     WHERE _estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql);*/
 /*  if ($rs) {*/
        echo"<form action='compras_nuevo1.php' method='post' name='formu'>";
       echo"<center>
        <h1>INSERTAR PRODUCTO</h1>
        
                <table class='listado'


                 <tr>
                    <th><b>Producto</b></th>
                    <td><input type='text' name='nombre' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>

                  <tr>
                    <th><b>(*)Fecha de caducidad</b></th>
                    <td><input type='date' name='fech_caducidad' size='10'></td>
                  </tr>

                

                  <tr>
                    <th><b>foto</b></th>
                    <td><input type='file' name='foto' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>

                    <tr>
                   
                 
                  
                  
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR PRODUCTO'  >
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    /*}*/

echo "</body>
      </html> ";

 ?>