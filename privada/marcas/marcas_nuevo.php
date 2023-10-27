<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
                <script type='text/javascript' src='../../ajax.js'></script> 
         <script type='text/javascript'>

        function buscar() {
          var d1, contenedor, url;
          contenedor = document.getElementById('productos');
          contenedor2 = document.getElementById('producto_seleccionado'); 
          contenedor3 = document.getElementById('producto_insertado'); 
          d1= document.formu.nombre.value;
          d2= document.formu.fech_caducidad.value; 
          d3= document.formu.foto.value;  
          ajax = nuevoAjax();
          url='ajax_buscar_producto.php'
          param = 'nombre='+d1+'&fech_caducidad='+d2+'&foto='+d3; 
          ajax.open('POST', url, true); 
          ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
          ajax.onreadystatechange = function() {
          if (ajax.readyState== 4) {

          contenedor.innerHTML = ajax.responseText; 
          contenedor2.innerHTML = '';
          contenedor3.innerHTML = '';
          }
         }
        ajax.send(param);
      }




      function buscar_producto(id_producto) {
        var d1, contenedor, url;
         contenedor = document.getElementById('producto_seleccionado'); 
         contenedor2 = document.getElementById('productos'); 
         document.formu.id_producto.value = id_producto;

        d1 = id_producto;

       ajax = nuevoAjax();
   
       url='ajax_buscar_producto1.php'; 
       param = 'id_producto='+d1;

      ajax.open('POST', url, true);
      ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
          contenedor.innerHTML = ajax.responseText;
          contenedor2.innerHTML = '';

    }
  }

ajax.send(param);

}





   function insertar_producto() { 
  
    var d1, contenedor, url;
    contenedor = document.getElementById('producto_seleccionado'); 
    contenedor2 = document.getElementById('productos');
    contenedor3 = document.getElementById('producto_insertado');


    d1 = document.formu.nombre1.value;
    d2 = document.formu.fech_caducidad1.value; 
    d3= document.formu.foto1.value; 


    if (d1=='') {
      alert('nombre incorrecto'); 
      document.formu.nombre1.focus();
      return;
    }

  


   if (d2 =='') {
        alert('La fecha de caducidad no fue seleccionada');
        document.formu.fecha_caducidad1.focus();
        return;
    }


    

    if (d3=='') {
      alert('La foto es incorrecta o el campo esta vacio'); 
      document.formu.foto1.focus();
      return;
   }




     ajax=nuevoAjax();
     url = 'ajax_inserta_producto.php';
     param = 'nombre1='+d1+'&fech_caducidad1='+d2+'&foto1='+d3; 
     ajax.open('POST', url, true);
     ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
     alert('llega');
     ajax.onreadystatechange = function() {
       if (ajax.readyState== 4) {
           contenedor.innerHTML = '';
           contenedor2.innerHTML = '';
           contenedor3.innerHTML = ajax.responseText;
         }
       }
     ajax.send(param);


     
   }
  </script>






       </head>";
       echo"<body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='marcas.php'>Listado de Marcas</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;'

        class='boton_cerrar'></a>";
        echo"<h3>USUARIO:".$_SESSION["sesion_usuario"]." &nbsp;&nbsp;";
        echo"ROL: ".$_SESSION["sesion_rol"]."</h3>"; 
        echo"<h1>INSERTAR MARCA</h1>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ' ,nombre,fech_caducidad) as producto, id_producto
                     FROM productos
                     WHERE _estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql);
 /*  if ($rs) {*/



      echo" <form action='marcas_nuevo1.php' method='post' name='formu'>"; 
      echo"<center>
       <table class='listado'>
         <tr>
          <th>(*)Selecciona al producto</th>
            <td>
              <table> 
               <tr>
                <td>
                 <b>Nombre</b><br />
                 <input type='text' name='nombre' value='' size='10' onkeyUp='buscar()'> 
                 </td>
                 <td>
                   <b>Fecha caducidad</b><br />
                   <input type='date' name='fech_caducidad'>
                 </td>
                 <td>
                <b>Foto</b><br />
                <input type='text' name='foto' value='' size='10'> 
                </td>
                
             </tr>
          </table>
        </td>
     </tr>";
 echo"<tr>
        <td colspan='6' align='center'>
          <table width='100%'>
            <tr>
             <td colspan='3' align='center'> 
             <div id='productos'> </div>
       </td>
     </tr>
    </table>
   </td>
</tr>




   <tr>
     <td colspan='6' align='center'>
       <table width='100%'>
         <tr>
        <td colspan='3'>
       <div id='producto_seleccionado'> </div>
      </td>
     </tr>
    </table>
   </td>
  </tr>
  <tr>
   <td colspan='6' align='center'>
     <table width='100%'>
       <tr>
         <td colspan='3'>
         <input type='hidden' name='id_producto'>
         <div id='producto_insertado'> </div>
        </td>
       </tr>
      </table> 
      </td>
     </tr>";
  echo"<tr>
         <th><b>(*)Marca del producto</b></th>
         <td><input type='text' name='marca' size='10'></td>
         </tr> 


         <tr>
            <td align='center' colspan='2'>
            <input type='submit' value='ADICIONAR MARCA'><br> 
            (*)Datos Obligatorios
           </td>
          </tr>
        </table>
      </center>";
      echo"</form>";
/*}*/

  echo "</body>
  </html>";
?>

