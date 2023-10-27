<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       


$_ci=$_POST["ci"];
$_nombres=$_POST["nombres"];
$_ap = $_POST["ap"];
$_am = $_POST["am"];
$_direccion = $_POST["direccion"];
$_telefono = $_POST["telefono"];





if(($_nombres!="") and  ($_ci!="")){
   $reg = array();
   $reg["id_licoreria"] = 1;
   $reg["ci"] = $_ci;
   $reg["nombres"] = $_nombres;
   $reg["ap"] = $_ap;
   $reg["am"] = $_am;
   $reg["direccion"] = $_direccion;
   $reg["telefono"] = $_telefono;
   
   

  
   $reg["_fec_insercion"] = date("Y-m-d H:i:s");
   $reg["_estado"] = 'A';
   $reg["_usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("personas", $reg, "INSERT"); 
   header("Location:personas.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DE LA PERSONA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='persona_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 