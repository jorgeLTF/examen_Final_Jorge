<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       

$id_producto = $_POST["id_producto"];
$_nombre=$_POST["nombre"];
$_fecha_caducidad = $_POST["fech_caducidad"];

$_foto = $_POST["foto"];
$_foto1 = $_POST["foto1"];


if ($_foto!="") {
    $_foto = $_foto;
} else
   $_foto = $_foto1;


if(($_nombre!="") and  ($_fecha_caducidad!="")){
   $reg = array();
   $reg["id_licoreria"] = 1;
   $reg["nombre"] = $_nombre;
   $reg["fech_caducidad"] = $_fecha_caducidad;
   $reg["foto"] = $_foto;


   $reg["_usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("productos", $reg, "UPDATE","id_producto='".$id_producto."'");
   header("Location:productos.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DEL PRODUCTO";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='productos.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 