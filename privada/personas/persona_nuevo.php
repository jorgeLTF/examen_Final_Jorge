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
       
        echo"<form action='persona_nuevo1.php' method='post' name='formu'>";
        echo"<center>
        <h1>INSERTAR PERSONA</h1>
                <table class='listado'

                 <tr>
                    <th><b>Dirección</b></th>
                    <td><input type='text' name='direccion' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                    </td>
                  </tr>

                  <tr>
                    <th><b>Telefono</b></th><td><input type='text' name='telefono' size='10'></td>
                  </tr>


                  <tr>
                    <th><b>(*)CI</b></th>
                    <td><input type='text' name='ci' size='10'></td>
                  </tr>

                  <tr>
                    <th><b>(*)Nombres</b></th><td><input type='text' name='nombres' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                    </td>
                  </tr>

                  <tr>
                    <th><b>Paterno</b></th>
                    <td><input type='text' name='ap' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>
                  <tr>
                    <th><b>Materno</b></th>
                    <td><input type='text' name='am' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                    </td>                    
                  </tr>
                  
                 
                  
                  
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR PERSONA'  >
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    /*}*/

echo "</body>
      </html> ";

 ?>