<?php
session_start();/*inicio de sesion*/

require_once("../../conexion.php");
echo "llega";

$_id_marca=$_REQUEST["id_marca"];
$_id_producto=$_REQUEST["id_producto"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";




$db->debug=true;

/*las consultas se tienen que hacer con todas las tablas en las que id_usuario esta como herencia*/

/*$sql = $db->Prepare ("SELECT *
                    FROM detalles_compras
                    WHERE id_compra = ? 
                    AND _estado <>'X'
                    ");

$rs=$db->GetAll($sql, array($_id_compra));


if(!$rs){*/
  $reg=array();
  $reg["_estado"]='X';
  $reg["_id_usuario"]=$_SESSION["sesion_id_usuario"];
  $rs1 = $db->AutoExecute("marcas",$reg,"UPDATE","id_marca='".$_id_marca."'");
  header("Location:marcas.php");
  exit();

/*}else{*/
	echo"<div class='mensaje'>";
        $mensage = "NO SE ELIMINARON LOS DATOS DE LA MARCA PORQUE TIENE HERENCIA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='marcas.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   /*}*/

echo "</body>
      </html> ";
?>