   <?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$nombre = $_POST["nombre"]; 
$fech_caducidad = $_POST["fech_caducidad"]; 
$foto = $_POST["foto"];
$db->debug=true;
if ($nombre or $fech_caducidad or $foto){
    $sql3 = $db->Prepare("SELECT *
                          FROM productos
                          WHERE nombre LIKE ?
                          AND fech_caducidad LIKE ?
                          AND foto LIKE ?
                          AND _estado <> 'X' 
                          ");
   $rs3 = $db->GetAll($sql3, array($nombre."%", $fech_caducidad. "%", $foto."%"));
  if ($rs3) {
      echo"<center>
            <table width='60%' border='1'>
             <tr>
               <th>NOMBRE</th><th>FECHA DE CADUCIDAD</th><th>FOTO<th>?</th>
                 </tr>";
            foreach ($rs3 as $k => $fila) {
                     $str = $fila["nombre"];
                     $str1 = $fila["fech_caducidad"];
                     $str2 = $fila["foto"];
              echo "<tr>
                       <td align='center'>".resaltar($nombre, $str)."</td>
                       <td>".resaltar($fech_caducidad, $str1)."</td> 
                       <td>".resaltar($foto, $str2)."</td> 
                       <td align='center'>
                        <input type='radio' name='opcion' value=''onclick='buscar_producto(".$fila["id_producto"].")'>
                        </td>
                        </tr>";
                      }


                       
                       echo"</table>
                     </center>";
                    }else{
                  echo"<center><b> EL PRODUCTO NO EXISTE!!</b></center><br>";
                  echo"<center>

          <table class='listado'>
          <tr>
          <td><b>(*)NOMBRE</b></td>
          <td><input type='text' name='nombre1' size='10' ></td>
          </tr>

          <tr>
          <td><b>FECHA DE CADUCIDAD</b></td>
          <td><input type='date' name='fech_caducidad1' size='10'  ></td>
          </tr>


          <tr>
          <td><b>FOTO</b></td>
          <td><input type='text' name='foto1' size='10' ></td>
          </tr>


      
           


           <tr>
                    <td align='center' colspan='2'>  
                      <input type='button' value='ADICIONAR PRODUCTO' onclick='insertar_producto()'>
                    </td>
                  </tr>
                </table>

                </center>
                ";
              }
            }          

     ?>

