<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;
$_id_marca=$_POST["id_marca"];
$_id_producto =$_POST["id_producto"];



echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='marcas.php'>Listado de Marcas</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' 

        class='boton_cerrar'></a>";
        echo"<h3>USUARIO:".$_SESSION["sesion_usuario"]." &nbsp;&nbsp;";
        echo"ROL: ".$_SESSION["sesion_rol"]."</h3>"; 
        echo"<h1>MODIFICAR MARCA</h1>";


$sql = $db->Prepare("SELECT *
                     FROM marcas
                     WHERE id_marca = ? 
                     AND _estado='A'                       
                        ");
$rs = $db->GetAll($sql, array($_id_marca));



$sql1 = $db->Prepare("SELECT CONCAT_WS(' ' ,nombre, fech_caducidad) as producto, id_producto
                     FROM productos
                     WHERE id_producto =?
                     AND _estado = 'A'                        
                        ");
$rs1 = $db->GetAll($sql1,array($_id_producto));



$sql2 = $db->Prepare("SELECT CONCAT_WS(' ' ,nombre, fech_caducidad) as producto, id_producto
                     FROM productos
                     WHERE id_producto <>?
                     AND _estado = 'A'                        
                        ");
$rs2 = $db->GetAll($sql2,array($_id_producto));


 /*  if ($rs) {*/
        echo"<form action='marcas_modificar1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th>(*)Producto</th>
                    <td>
                      <select name='id_producto'>";
                  
                        foreach ($rs1 as $k => $fila) {
                        echo"<option value='".$fila['id_producto']."'>".$fila['producto']."</option>";    
                        }  
                        foreach ($rs2 as $k => $fila) {
                        echo"<option value='".$fila['id_producto']."'>".$fila['producto']."</option>";    
                        } 

                echo"</select>
                    </td>
                  </tr>";
                  foreach ($rs as $k =>$fila){


             echo"<tr>
                    <th><b>(*)Marca</b></th>
                    <td><input type='text' name='marca' size='23' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["marca"]."'></td>
                  </tr>
        
                  
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='MODIFICAR MARCA'><br>
                      (*)Datos Obligatorios
                      <input type='hidden' name='id_marca' value='".$fila["id_marca"]."'>
                    </td>
                  </tr>";
                }
                echo"</table>
                </center>";
          echo"</form>" ;     
    /*}*/

echo "</body>
      </html>";

 ?>