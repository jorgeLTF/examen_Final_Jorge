<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;


echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <meta http-equiv='Content-type' content='text/html'; charset=utf-8'/>
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript' src='js/buscar_opciones.js'></script>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='opcion_nuevo.php'>Nueva Opcion</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;'

        class='boton_cerrar'></a>";
        echo"<h3>USUARIO:".$_SESSION["sesion_usuario"]." &nbsp;&nbsp;";
        echo"ROL: ".$_SESSION["sesion_rol"]."</h3>"; 
        echo"<h1>LISTADO DE OPCIONES</h1>";

        $sql = $db->Prepare("SELECT *
                     FROM  grupos g
                     INNER JOIN opciones o ON g.id_grupo=o.id_grupo  
                     WHERE o._estado <> 'X'  
                     AND g._estado <> 'X' 
                     GROUP BY (g.grupo)   
                     ORDER BY o.id_opcion DESC

                                      
                        ");
        $rs = $db->GetAll($sql);

          echo"
<!------INICIO BUSCADOR--------->
    <center>
    <form action='#'' method='post' name='formu'> 
    <table border='1' class='listado'>
     <tr>
       <th>
       <b>Grupo</b><br />
                    
                     <select name='grup'onclick='buscar_opciones()'>
                     <option value=''>--Seleccione--</option>";
                        foreach ($rs as $k => $fila){
                        echo"<option  value='".$fila['grupo']."'>".$fila['grupo']."</option>";    
                        }  
                       
                echo"</select>
                    

                
          <th>
            <b>Opcion</b><br />
            <input type='text' name='opciones' value='' size='10' onkeyUp='buscar_opciones()'> 
          </th>
           <th>
          <b>Contenido</b><br />
          <input type='text' name='contenid' value='' size='10' onkeyUp='buscar_opciones()'> 
          </th>
          
          
          </tr>
         </table>
         </form>
         </center>
         <!------FIN BUSCADOR--------->";



echo"<div id='opciones1'>";




   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>GRUPO</th><th>OPCION</th><th>CONTENIDO</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td>".$fila['grupo']."</td>                        
                        <td>".$fila['opcion']."</td>
                        <td>".$fila['contenido']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_opcion"]."' method='post' action='opcion_modificar.php'>
                             <input type='hidden' name='id_opcion' value='".$fila['id_opcion']."'> 
                            <input type='hidden' name='id_grupo' value='".$fila['id_grupo']."'>
                            <a href='javascript:document.formModif".$fila['id_opcion'].".submit();' title='Modificar Opcion del Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_opcion"]."' method='post' action='Opcion_eliminar.php'>
                            <input type='hidden' name='id_opcion' value='".$fila["id_opcion"]."'>
                            <a href='javascript:document.formElimi".$fila['id_opcion'].".submit();' title='Eliminar Opcion del Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar a la opcion ".$fila["opcion"]." ?\"))'; location.href='opcion_eliminar.php''> 
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

echo"</div>";
echo "</body>
      </html> ";

 ?>