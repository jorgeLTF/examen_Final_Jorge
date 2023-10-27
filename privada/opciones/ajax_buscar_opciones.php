<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$grup = $_POST["grup"]; 
$opciones = $_POST["opciones"]; 
$contenid = $_POST["contenid"];

$db->debug=true;
if ($grup or $opciones or $contenid){
    $sql3 = $db->Prepare("SELECT *
                          FROM grupos g
                          INNER JOIN opciones o ON g.id_grupo=o.id_grupo   
                          WHERE g.grupo LIKE ?
                          AND o.opcion LIKE ?
                          AND o.contenido LIKE ?
                          AND o._estado <> 'X' 
                          AND g._estado <> 'X'
                       
                          ");
   $rs3 = $db->GetAll($sql3, array($grup."%", $opciones. "%",$contenid."%"));
  if ($rs3) {
      echo"<center>
            <table class='listado'>
             <tr>
               <th>GRUPO</th><th>OPCION</th><th>CONTENIDO<th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                 </tr>";
            foreach ($rs3 as $k => $fila){
                     $str = $fila["grupo"];
                     $str1 = $fila["opcion"];
                     $str2 = $fila["contenido"];
              echo "<tr>
                       <td align='center'>".resaltar($grup, $str)."</td>
                       <td>".resaltar($opciones, $str1)."</td> 
                       <td>".resaltar($contenid, $str2)."</td> 
                       <td align='center'>
                       <form name='formModif".$fila["id_opcion"]."' method='post' action='Opcion_modificar.php'>
                           <input type='hidden' name='id_opcion' value='".$fila['id_opcion']."'>
                           <a href='javascript:document.formModif".$fila['id_opcion'].".submit();'title='Modificar Opcion Sistema'>
                             Modificar>>
                          </a>

                        </form>
                        </td>
                        <td align='center'>
                          <form name='formElimi" .$fila["id_opcion"]."' method='post' action='opcion_eliminar.php'>
                            <input type='hidden' name='id_opcion' value='".$fila["id_opcion"]."'>
                            <a href='javascript:document.formElimi".$fila['id_opcion'].".submit();' title='Eliminar Opcion Sistema' 
                            onclick='javascript:return(confirm( Desea realmente Eliminar a la Opcion..?))'; location.href='opcion_eliminar.php''>
                                Eliminar>>
                                </a>
                            </form>
                           </td>
                        </tr>";
                      }
                       echo"</table>
                     </center>";
                    } else {
                          echo"<center><b> LA OPCION NO EXISTE!!</b></center><br>";
                    }
                 }

     ?>

