<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       

$id_licoreria = $_POST["id_licoreria"];
$nombre=$_POST["nombre"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];
$sitio_web = $_POST["sitio_web"];

$logo1 = $_POST["logo1"];
$nombre_log=$_FILES['logo']['name'];
/*if($logo=="")
$logo=$logo1;*/

//guardar imagen




if((!empty($_FILES['logo'])) and  is_uploaded_file($_FILES['logo']['tmp_name'])){
    copy($_FILES['logo']['tmp_name'],'logos/'.$nombre_log);
    $logo=$_FILES['logo']['name'];
    }elseif($logo1==""){
       $nombre_log='';
    }else
       $nombre_log=$logo1;
    






if(($nombre!="") and  ($direccion!="")){

   $reg = array();
   $reg["id_licoreria"] = 1;
   $reg["nombre"] = $nombre;
   $reg["direccion"] = $direccion;
   $reg["telefono"] = $telefono;
   $reg["sitio_web"] = $sitio_web;
   $reg["logo"] = $nombre_log;
   
   


   $reg["_usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("licoreria", $reg, "UPDATE","id_licoreria='".$id_licoreria."'");
   header("Location:  ../../listado_tablas.php");
   exit();
} else {

        if(!$rs1){

        echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DE LA LICORERIA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='licoreria.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }
}

echo "</body>
      </html> ";
?> 