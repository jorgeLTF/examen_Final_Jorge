"use strict"
function buscar_personas() {
      var d1, d2,d3, d4, ajax, url, param, contenedor; 
        contenedor = document.getElementById('personas1'); 
        d1 = document.formu.paterno.value;
        d2 = document.formu.materno.value;
        d3 = document.formu.nombres.value;
        d4 = document.formu.ci.value;
        ajax = nuevoAjax();
        url= "ajax_buscar_persona.php"
        param = "paterno="+d1+"&materno="+d2+"&nombres="+d3+"&ci="+d4;
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

