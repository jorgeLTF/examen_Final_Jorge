"use strict"
function buscar_opciones() {
      var d1, d2,d3, ajax, url, param, contenedor; 
        contenedor = document.getElementById('opciones1'); 
        d1 = document.formu.grup.value;
        d2 = document.formu.opciones.value;
        d3 = document.formu.contenid.value;
        ajax = nuevoAjax();
        url= "ajax_buscar_opciones.php"
        param = "grup="+d1+"&opciones="+d2+"&contenid="+d3;
        //alert(param);
        ajax.open("POST", url, true);
        ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        ajax.onreadystatechange = function() {
          if (ajax.readyState == 4) {
            contenedor.innerHTML = ajax.responseText;
         }
     }
     ajax.send(param);

 }

