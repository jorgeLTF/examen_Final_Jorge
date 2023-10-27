<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       


$_id_producto = $_POST["id_producto"];
$_id_marca = $_POST["id_marca"];
$_marca = $_POST["marca"];

if(($_id_producto!="") and  ($_marca!="")){
   $reg = array();
   $reg["id_producto"] = $_id_producto;
   $reg["marca"] = $_marca;;
   $reg["_usuario"] = $_SESSION["sesion_id_usuario"];   
    
   $rs1 = $db->AutoExecute("marcas", $reg, "UPDATE","id_marca='".$_id_marca."'");
   header("Location: marcas.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DE LA MARCA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='marcas_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 