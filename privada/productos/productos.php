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
       <center>
      <h1>LISTADO DE PRODUCTOS</h1>
    <b><a href='productos_nuevo.php'>Nuevo Producto>>></a></b>
       <body>
       <p> &nbsp;</p>";

$sql = $db->Prepare("SELECT *
                     FROM productos
                     WHERE _estado <> 'X' 
                     ORDER BY id_producto DESC                      
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>PRODUCTO</th><th>FECHA DE CADUCIDAD</th><th>FOTO</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td align='center'>".$fila['nombre']."</td>
                        <td>".$fila['fech_caducidad']."</td>
                        <td>".$fila['foto']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_producto"]."' method='post' action='productos_modificar.php'>
                            <input type='hidden' name='id_producto' value='".$fila['id_producto']."'>
                            <a href='javascript:document.formModif".$fila['id_producto'].".submit();' title='Modificar Producto del Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_producto"]."' method='post' action='productos_eliminar.php'>
                            <input type='hidden' name='id_producto' value='".$fila["id_producto"]."'>
                            <a href='javascript:document.formElimi".$fila['id_producto'].".submit();' title='Eliminar Producto del Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar al producto ".$fila["nombre"]." con fehca de caducidad ".$fila["fech_caducidad"]." ?\"))'; location.href='productos_eliminar.php''> 
                              Eliminar>>
                            </a>
                          </form>                        
                        </td>
                     </tr>";
                     $b=$b+1;
            }
             echo"</table>
          </center>";
    }

echo "</body>
      </html> ";

 ?>