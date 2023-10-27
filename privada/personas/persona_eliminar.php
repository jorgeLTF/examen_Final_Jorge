<?php
session_start();/*inicio de sesion*/
require_once("../../conexion.php");
require_once ("../../libreria_menu.php");


$_id_persona=$_REQUEST["id_persona"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";


//$db->debug=true;
/*las consultasse tienen que hacer con todas las tablas en las que id_persona esta como herencia*/

$sql = $db->Prepare ("SELECT *
	                  FROM usuarios
	                  WHERE id_persona =?
	                  AND _estado <>'X'
	                  ");

$rs=$db->GetAll($sql, array($_id_persona));

if(!$rs){
	$reg=array();
	$reg["_estado"]='X';
	$reg["_id_usuario"]=$_SESSION["sesion_id_usuario"];
	$rs1 = $db->AutoExecute("personas",$reg,"UPDATE","id_persona='".$_id_persona."'");
	header("Location:personas.php");
	exit();

}else{
	 echo"<div class='mensaje'>";
        $mensage = "NO SE ELIMINARON LOS DATOS DE LA PERSONA PORQUE TIENE HERENCIA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='personas.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?>