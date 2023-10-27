<?php
session_start();
require_once("../../conexion.php");


echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='licoreria.php'>Listado de Personas</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' 

       class='boton_cerrar'></a>";
        echo"<h3>USUARIO:".$_SESSION["sesion_usuario"]." &nbsp;&nbsp;";
        echo"ROL: ".$_SESSION["sesion_rol"]."</h3>"; 
        echo"<h1>MODIFICAR LICORERIA</h1>";
 

$sql = $db->Prepare("SELECT *
                     FROM licoreria
                     WHERE id_licoreria = 1
                     AND _estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql); 
$logo=$rs[0]["logo"];
   /*if ($rs) {*/
        foreach ($rs as $k => $fila) {
        echo"<form action='licoreria1.php' method='post' name='formu' enctype='multipart/form-data'>";
        echo"<center>
                <table class='listado'

                <tr>
                    <th><b>(*)Nombre</b></th><td><input type='text' name='nombre' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["nombre"]."'></td>
                    </td>
                  </tr>

                 <tr>
                    <th><b>Dirección</b></th>
                    <td><input type='text' name='direccion' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["direccion"]."'></td>
                    </td>
                  </tr>

                  <tr>
                    <th><b>Telefono</b></th><td><input type='text' name='telefono' size='10' value='".$fila["telefono"]."'></td>
                  </tr>


                  <tr>
                    <th><b>DIRECCION WEB</b></th>
                    <td><input type='text' name='sitio_web' size='20' value='".$fila["sitio_web"]."'></td>
                    </td>                    
                  </tr>



                  <tr>
                    <th><b>Logo</b></th>
                    <td>
                    <input type='hidden' name ='MAX_FILE_SIZE' VALUE='1000000'>
                    <input type='hidden' name ='logo1' value='".$fila["logo"]."'>
                    <input type='file' name ='logo' size='10'><br>";
                    echo $fila["logo"];
                    echo"</td>
                  </tr>
                  

                  
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='MODIFICAR LICORERIA'  >
                      <input type='hidden' name='id_licoreria' value='".$fila["id_licoreria"]."'>
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