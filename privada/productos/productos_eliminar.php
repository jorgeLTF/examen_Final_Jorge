<?php
session_start();/*inicio de sesion*/
require_once("../../conexion.php");



$_id_producto=$_REQUEST["id_producto"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";


$db->debug=true;
/*las consultasse tienen que hacer con todas las tablas en las que id_persona esta como herencia*/

$sql1 = $db->Prepare ("SELECT *
	                  FROM almacenes
	                  WHERE id_producto =?
	                  AND _estado <>'X'
	                  ");
$rs1=$db->GetAll($sql1, array($_id_producto));


$sql2 = $db->Prepare ("SELECT *
	                  FROM marcas
	                  WHERE id_producto =?
	                  AND _estado <>'X'
	                  ");

$rs2=$db->GetAll($sql2, array($_id_producto));


$sql3 = $db->Prepare ("SELECT *
	                  FROM tamano
	                  WHERE id_producto =?
	                  AND _estado <>'X'
	                  ");

$rs3=$db->GetAll($sql3, array($_id_producto));


$sql4 = $db->Prepare ("SELECT *
	                  FROM productos_proveedores
	                  WHERE id_producto =?
	                  AND _estado <>'X'
	                  ");

$rs4=$db->GetAll($sql4, array($_id_producto));



if((!$rs1) and (!$rs2) and (!$rs3) and (!$rs4)){
	$reg=array();
	$reg["_estado"]='X';
	$reg["_id_usuario"]=$_SESSION["sesion_id_usuario"];
	$rs1 = $db->AutoExecute("productos",$reg,"UPDATE","id_producto='".$_id_producto."'");
	header("Location:productos.php");
	exit();

}else{
	 echo"<div class='mensaje'>";
        $mensage = "NO SE ELIMINARON LOS DATOS DEL PRODUCTO PORQUE TIENE HERENCIA";
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