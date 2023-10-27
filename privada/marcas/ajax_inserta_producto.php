
<?php
session_start();
require_once("../../conexion.php");


$nombre1=$_POST["nombre1"];
$fech_caducidad1 = $_POST["fech_caducidad1"];
$foto1=$_POST["foto1"];



   $reg = array();
   $reg["id_licoreria"] = 1;
   $reg["nombre"] = $nombre1;
   $reg["fech_caducidad"] = $fech_caducidad1;
   $reg["foto"] = $foto1;
   
   

  
   $reg["_fec_insercion"] = date("Y-m-d H:i:s");
   $reg["_estado"] = 'A';
   $reg["_usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("productos", $reg, "INSERT"); 

     ?>

