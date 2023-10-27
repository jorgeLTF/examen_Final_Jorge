<?php
session_start();
require_once("../../conexion.php");
require_once ("../../libreria_menu.php");


$db->debug=true;
$_id_producto=$_POST["id_producto"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
      <p> &nbsp;</p>";

 

$sql = $db->Prepare("SELECT *
                     FROM productos
                     WHERE id_producto = ?
                     AND _estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql,array($_id_producto)); 
   /*if ($rs) {*/
        foreach ($rs as $k => $fila) {
        echo"<form action='productos_modificar1.php' method='post' name='formu' enctype=''>";
        echo"<center>
         <h1>MODIFICAR PRODUCTO</h1>
                <table class='listado'


                   <tr>
                    <th><b>(*)Producto</b></th>
                    <td><input type='text' name='nombre' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["nombre"]."'></td>
                    </td>
                  </tr>


                  <tr>
                    <th><b>Fecha de caducidad</b></th>
                    <td><input type='date' name='fech_caducidad' size='10' value='".$fila["fech_caducidad"]."'></td>
                  </tr>


                  <tr>
                    <th><b>Foto<br>".$fila["foto"]."</b></th>
                    <td><input type='file' name='foto' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                      <input type='hidden' name='foto1' value='".$fila["foto"]."'>
                      
                    </td>
                  </tr>


         
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='MODIFICAR PRODUCTO'  >
                      <input type='hidden' name='id_producto' value='".$fila["id_producto"]."'>
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
   /* }*/
 }

echo "</body>
      </html> ";

 ?>