<?php
session_start();
require_once("../../conexion.php");
require_once("../../paginacion.inc.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='marcas_nuevo.php'>Nueva Marca</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' 

       class='boton_cerrar'></a>";
        echo"<h3>USUARIO:".$_SESSION["sesion_usuario"]." &nbsp;&nbsp;";
        echo"ROL: ".$_SESSION["sesion_rol"]."</h3>"; 
        echo"<h1>LISTADO DE MARCAS</h1>";


        
        contarRegistros($db,"marcas");
        paginacion("marcas.php?");

$sql = $db->Prepare("SELECT CONCAT_WS(' ', p.nombre, p.fech_caducidad) AS productos,p.nombre as producto, p.*,m.*
                     FROM productos p, marcas m
                     WHERE p.id_producto = m.id_producto
                     AND m.id_marca > 1
                     AND p._estado <> 'X' 
                     AND m._estado <> 'X' 
                     ORDER BY m.id_marca DESC   
                     LIMIT ? OFFSET ?                      
                        ");
$rs = $db->GetAll($sql, array ($nElem,$regIni));
   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>PRODUCTO</th><th>MARCA</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=0;
                $total=$pag-1;
                $a=$nElem*$total;
                $b=$b+1+$a;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td>".$fila['producto']."</td>                        
                        <td>".$fila['marca']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_marca"]."' method='post' action='marcas_modificar.php'>
                            <input type='hidden' name='id_marca' value='".$fila['id_marca']."'>
                            <input type='hidden' name='id_producto' value='".$fila['id_producto']."'>
                            <a href='javascript:document.formModif".$fila['id_marca'].".submit();' title='Modificar Marca del Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_marca"]."' method='post' action='marcas_eliminar.php'>
                            <input type='hidden' name='id_marca' value='".$fila["id_marca"]."'>
                            <input type='hidden' name='id_producto' value='".$fila['id_producto']."'>
                            <a href='javascript:document.formElimi".$fila['id_marca'].".submit();' title='Eliminar Marca del Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar a la Marca ".$fila["marca"]. " del producto ".$fila["productos"]." ?\"))'; location.href='marcas_eliminar.php''> 
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

    echo"<!--PAGINACION‒‒‒‒‒------>";
  echo"<table border='0' align='center'>
    <tr>
      <td>";
       if (!empty($urlback)){
        echo "<a href=".$urlback." style='font-family:Verdana; font-size:9px;cursor:pointer'; >&laquo;Anterior</a>";
   }

    if (!empty($paginas)){
      foreach ($paginas as $k => $pagg) {
        if ($pagg["npag"]==$pag){
          if ($pag != '1'){
            echo"|";
       }
       echo"<b style='color: #FB992F; font-size: 12px;'>";
      } else
      echo"</b> | <a href=".$pagg["pagV"]." style='cursor:pointer;'>"; echo $pagg["npag"]; echo"</a>";

      }
    }
    if (($nPags > $nBotones) and (!empty($urlnext)) and ($pag < $nPags)){
      echo" |<a href=".$urlnext." style='font-family: Verdana; font-size: 9px;cursor:pointer'>Siguiente&raquo;</a>";

    }

echo "</body>
      </html> ";
/*SELECT DISTINCT TABLE_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME ='id_compra' AND TABLE_SCHEMA='licoreria';*/
 ?>