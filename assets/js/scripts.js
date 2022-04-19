/*!
* Start Bootstrap - SB Admin v6.0.0 (https://startbootstrap.com/templates/sb-admin)
* Copyright 2013-2020 Start Bootstrap
* Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap-sb-admin/blob/master/LICENSE)
*/
(function ($) {
  "use strict";

  // Add active state to sidbar nav links
  var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
  $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function () {
    if (this.href === path) {
      sessionStorage.setItem("lasTUrl", path);
      $(this).addClass("active");
    }
  });

  // Toggle the side navigation
  $("#sidebarToggle").on("click", function (e) {
    e.preventDefault();
    $("body").toggleClass("sb-sidenav-toggled");
  });


})(jQuery);

function getAbsolutePath() {
  var loc = window.location;

  //var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
  var pathName = loc.pathname.substring(0, 1);
  // var pathName = loc.pathname.substring(0, 1);
  return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
}

/*validacion*/
function expRegular(texto, contenido) {
  let letras_latinas;
  let letras_Frm;
  let ercorreo;
  let phonearray;
  let mesaje;
  let pass;
  let varif;
  let decimal;
  let fecha;
  let rfc;

  switch (texto) {
    case "nombre":
      letras_latinas = /^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ/-_-\s]+$/;
      varif = letras_latinas;
      break;

    case "frm":
      letras_Frm = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/;
      varif = letras_Frm;
      break;

    case "email":
      ercorreo = /^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/;
      varif = ercorreo;
      break;

    case "phone":
      phonearray = /^[0-9]+$/;
      varif = phonearray;
      break;

    case "decimales":
      decimal = /^([0-9]+\.?[0-9]{0,3})$/;
      varif = decimal;
      break;

    case "messagge":
    case "dir":
      mesaje = /^[0-9a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_;,.()¿$?\s]+$/;
      varif = mesaje;
      break;

    case "date":
      fecha = /^\d{1,2}\-\d{1,2}\-\d{2,4}$/;
      varif = fecha;
      break;

    case "dateSlash":
      fecha = /^\d{2,4}\-\d{1,2}\-\d{1,2}$/;
      varif = fecha;
      break;
    case "rfc":
      rfc = /^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/;
      varif = rfc;
      break;

    case "pass":
      pass = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/;
      varif = pass;
      /*La contraseña debe tener al entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula.
  NO puede tener otros símbolos.
  Ejemplo:
  w3Unpocodet0d0 */
      break;

  }
  if (!(varif.test(contenido))) {
    return 0;
  } else {
    return texto;
  }

}
// funcion para limpiar formularios
function limpiarFormulario(formulario) {
  document.getElementById(formulario).reset();
}
// funcion para limpiar inputs
function limpiarInput(idInput) {
  document.getElementById(idInput).value = "";
}

// funcion para colocar el cursor en un inpucon focus
function focusInput(idInput) {
  document.getElementById(idInput).focus();
}

function multi(uno = 0, dos = 0) {
  let result = parseFloat(0.0);
  result = (parseFloat(uno) * parseFloat(dos));
  if (result == "NaN" || result == "") {
    result = 0;
  } else {
    result = result.toFixed(2);
  }
  return result;
}

function sumar(uno, dos) {
  var result;
  result = (uno + dos);

  return result;
}

function restar(uno, dos) {
  var resta;
  resta = (uno - dos);

  if (resta < 0) {
    return 0;
  } else {
    return resta;
  }
}

function emptyInput(input) {
  if (input === '') {
    return 'empty';
  } else {
    return input;
  }
}

function dosDecimales(n) {
  let t = n.toString();
  let regex = /(\d*.\d{0,2})/;
  return t.match(regex)[0];
}


/**
 * @param String name
 * @return String
 */
function getParameterByName(name) {
  name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
  var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
  return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function hoy() {
  var hoy = new Date();
  var hoyAno = hoy.getFullYear();
  var hoyMes = hoy.getMonth() + 1;
  var hoyDia = hoy.getDate();

  return hoyDia + "-" + hoyMes + "-" + hoyAno;
}

function mayusculas(e) {
  e.value = e.value.toUpperCase();
}

/* boton regresar una pantalla atras en la historia */
document.getElementById('botondiv').onclick = function (e) {
  sessionStorage.setItem("logguin", "logueado");
  if (e.target == document.getElementById('backHisotry')) {
    window.history.back();
  }
}



//Función para validar un RFC
// Devuelve el RFC sin espacios ni guiones si es correcto
// Devuelve false si es inválido
// (debe estar en mayúsculas, guiones y espacios intermedios opcionales)
function rfcValido(rfc, aceptarGenerico = true) {
  const re = /^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/;
  var validado = rfc.match(re);

  if (!validado)  //Coincide con el formato general del regex?
    return false;

  //Separar el dígito verificador del resto del RFC
  const digitoVerificador = validado.pop(),
    rfcSinDigito = validado.slice(1).join(''),
    len = rfcSinDigito.length,

    //Obtener el digito esperado
    diccionario = "0123456789ABCDEFGHIJKLMN&OPQRSTUVWXYZ Ñ",
    indice = len + 1;
  var suma,
    digitoEsperado;

  if (len == 12) suma = 0
  else suma = 481; //Ajuste para persona moral

  for (var i = 0; i < len; i++)
    suma += diccionario.indexOf(rfcSinDigito.charAt(i)) * (indice - i);
  digitoEsperado = 11 - suma % 11;
  if (digitoEsperado == 11) digitoEsperado = 0;
  else if (digitoEsperado == 10) digitoEsperado = "A";

  //El dígito verificador coincide con el esperado?
  // o es un RFC Genérico (ventas a público general)?
  if ((digitoVerificador != digitoEsperado)
    && (!aceptarGenerico || rfcSinDigito + digitoVerificador != "XAXX010101000"))
    return false;
  else if (!aceptarGenerico && rfcSinDigito + digitoVerificador == "XEXX010101000")
    return false;
  return rfcSinDigito + digitoVerificador;
}


//Handler para el evento cuando cambia el input
// -Lleva la RFC a mayúsculas para validarlo
// -Elimina los espacios que pueda tener antes o después
function validarInput(input) {
  var rfc = input.value.trim().toUpperCase(),
    resultado = document.getElementById("resultado"),
    valido;

  var rfcCorrecto = rfcValido(rfc);   // ⬅️ Acá se comprueba

  if (rfcCorrecto) {
    valido = "Válido";
    resultado.classList.add("ok");
  } else {
    valido = "No válido"
    resultado.classList.remove("ok");
  }

  resultado.innerText = "RFC: " + rfc
    + "\nResultado: " + rfcCorrecto
    + "\nFormato: " + valido;
}


function separaTexto(texto,limite) {
  let separador = "_";
  //let limit = 3;
  let textoNuevo = "";
  textoNuevo = texto.split(separador, limite);
  return textoNuevo
  /* let validarTexto = expRegular('nombre', texto)
  if (validarTexto = !0) {
    textoNuevo = texto.split(separador, limit);
    return textoNuevo
  } else {
    return 0
  } */
}

function tamanoTxt(texto, length_txt) {
  let tamano = texto.length;

  if (tamano > length_txt) {
    return false
  } else {
    return texto
  }
}
//validar formualrios
/* NOTA:
        para que regrese un valor valido debe der igual a cero (0),
        si este regresa un valor mayor a cero este se toma como un valor 
        negativo*/
function validarCampos(arrayDatos) {
  let contador = 0;
  for (var clave in arrayDatos[0]) {
    var indice = separaTexto(clave,3)

    if (arrayDatos[0][clave] === 'empty') {
      $("#" + indice[1]).css('border', '1px solid red')
      $("." + indice[1]).html('este campo es obligatorio')
      $("." + indice[1]).css('color', 'red')
      contador = contador + 1;
    } else {
      var error = expRegular(indice[0], arrayDatos[0][clave])
      if (error != 0) {
        let largoTexto = tamanoTxt(arrayDatos[0][clave], indice[2])
        if (largoTexto) {
          $("#" + indice[1]).css('border', '1px solid green')
          $("." + indice[1]).html('correcto')
          $("." + indice[1]).css('color', 'green')
        } else {
          $("#" + indice[1]).css('border', '1px solid red')
          $("." + indice[1]).html('EXCEDE EL TAMAÑO PERMITIDO')
          $("." + indice[1]).css('color', 'red')
          contador = contador + 2;
        }
      } else {
        $("#" + indice[1]).css('border', '1px solid red')
        $("." + indice[1]).html('Formato Incorrecto')
        $("." + indice[1]).css('color', 'red')
        contador = contador + 2;
      }
    }
  }
  return contador
}

function humanizeNumber(n) {
  n = n.toString()
  while (true) {
    var n2 = n.replace(/(\d)(\d{3})($|,|\.)/g, '$1,$2$3')
    if (n == n2) break
    n = n2
  }
  return n
}

function deleteArray(arrayDelete) {
  let complete = arrayDelete.length;

  if (complete == 0) {
    return -1;
  } else {
    for (let i = arrayDelete.length; i > 0; i--) {
      arrayDelete.pop();
    }
  }
}

function existeRegistro(idDeTabla) {
  let filas = $('#'+idDeTabla).find('tbody tr').length;
  /* let filas = $('table#'+idDeTabla+' tbody tr').length; */
  if (filas > 0) {
    return 1;
  } else {
    return 0;
  }
}
/* tabla clientes */
function tablasClientes(jsonElement,idDiv){
      let indiceJson = 0;
      let contador = 2;
      let ContadorSecundario=1;
      //sessionStorage.clear();
     /* console.log(JSON.stringify(jsonElement));
return */
      // creamos la tabla
      let table = document.createElement('table');
      table.classList.add('table');
      table.classList.add('table-hover');
      table.classList.add('tblDatosCliente');
      table.setAttribute('id','tblCliente');
      let thead = document.createElement('thead');
      let tbody = document.createElement('tbody');

      table.appendChild(thead);
      table.appendChild(tbody);

      // Agregar la tabla completa a la etiqueta del cuerpo
      document.getElementById(idDiv).appendChild(table);

      // Crear y agregar datos a la primera fila de la tabla este es el encabezado
      let row_1 = document.createElement('tr');
      let heading_1 = document.createElement('th');
      heading_1.innerHTML = "ESTADO";
      let heading_2 = document.createElement('th');
      heading_2.innerHTML = "MUNICIPIO";
      let heading_3 = document.createElement('th');
      heading_3.innerHTML = "COLINIA";
      let heading_4 = document.createElement('th');
      heading_4.innerHTML = "CALLE";

      row_1.appendChild(heading_1);
      row_1.appendChild(heading_2);
      row_1.appendChild(heading_3);
      row_1.appendChild(heading_4);
      thead.appendChild(row_1);
      // iteramos en cada uno de los datos que tiene json y hacemos la tabla
      for(let x of Object.keys(jsonElement)) {
        var capital = jsonElement[x];
        let titulo = "row_"+contador;
        let titulofila1 = "row_"+contador+"_data_"+ContadorSecundario;
        let titulofila2 = "row_"+(contador+1)+"_data_"+ContadorSecundario;
        let titulofila3 = "row_"+(contador+2)+"_data_"+ContadorSecundario;
        let titulofila4 = "row_"+(contador+3)+"_data_"+ContadorSecundario;        

        // Creating and adding data to second row of the table
        titulo= document.createElement('tr');
        titulo.setAttribute('id',indiceJson);
        titulofila1 = document.createElement('td');
        titulofila1.innerHTML = capital.estado;
        titulofila2 = document.createElement('td');
        titulofila2.innerHTML = capital.municipio;
        titulofila3 = document.createElement('td');
        titulofila3.innerHTML = capital.calleDomicilioCliente;
        titulofila4 = document.createElement('td');
        titulofila4.innerHTML = '<button type="button" id="" data-id="'+ContadorSecundario+'" class="btn btn-primary btn-lg seleccionarIdCliente">Seleccionar</button>';
        sessionStorage.setItem('JSON_'+ContadorSecundario,JSON.stringify(capital));
        
        titulo.appendChild(titulofila1);
        titulo.appendChild(titulofila2);
        titulo.appendChild(titulofila3);
        titulo.appendChild(titulofila4);
        tbody.appendChild(titulo);
       
        contador++;
        ContadorSecundario++;
        indiceJson++;
      }

      // Reemplazar cuerpo anterior por el actual
    const tabla = document.getElementById('tblCliente')
    tabla.replaceChild(thead, tabla.querySelector('thead'))
    tabla.replaceChild(tbody, tabla.querySelector('tbody'))
 } 
/* tabl aproductos */
 function tablasProductos(jsonElement,idDiv){
  let indiceJson = 0;
  let contador = 2;
  let ContadorSecundario=1;
  //sessionStorage.clear();
 /* console.log(JSON.stringify(jsonElement));
 return */
  // creamos la tabla
  let table = document.createElement('table');
  table.classList.add('table');
  table.classList.add('table-hover');
  table.classList.add('tblDatosProdXAlmacen');
  table.setAttribute('id','tblDatosProdXAlmacen');
  let thead = document.createElement('thead');
  let tbody = document.createElement('tbody');

  table.appendChild(thead);
  table.appendChild(tbody);

  // Agregar la tabla completa a la etiqueta del cuerpo
  document.getElementById(idDiv).appendChild(table);

  // Crear y agregar datos a la primera fila de la tabla este es el encabezado
  let row_1 = document.createElement('tr');
  let heading_1 = document.createElement('th');
  heading_1.innerHTML = "Id Producto";
  let heading_2 = document.createElement('th');
  heading_2.innerHTML = "Nombre";
  let heading_3 = document.createElement('th');
  heading_3.innerHTML = "Lote";
  let heading_4 = document.createElement('th');
  heading_4.innerHTML = "Total Peso";
  let heading_5 = document.createElement('th');
  heading_5.innerHTML = "Total Pz";

  row_1.appendChild(heading_1);
  row_1.appendChild(heading_2);
  row_1.appendChild(heading_3);
  row_1.appendChild(heading_4);
  row_1.appendChild(heading_5);
  thead.appendChild(row_1);
  // iteramos en cada uno de los datos que tiene json y hacemos la tabla
  for(let x of Object.keys(jsonElement)) {
    var capital = jsonElement[x];
    let tituloXAlmacen = "row_"+contador;
    let titulofila1XAlmacen = "row_"+contador+"_data_"+ContadorSecundario;
    let titulofila2XAlmacen = "row_"+(contador+1)+"_data_"+ContadorSecundario;
    let titulofila3XAlmacen = "row_"+(contador+2)+"_data_"+ContadorSecundario;
    let titulofila4XAlmacen = "row_"+(contador+3)+"_data_"+ContadorSecundario;        
    let titulofila5XAlmacen = "row_"+(contador+4)+"_data_"+ContadorSecundario;        
    let titulofila6XAlmacen = "row_"+(contador+5)+"_data_"+ContadorSecundario;        

    // Creating and adding data to second row of the table
    tituloXAlmacen= document.createElement('tr');
     titulofila1XAlmacen = document.createElement('td');
    titulofila1XAlmacen.innerHTML = capital.id;
    titulofila2XAlmacen = document.createElement('td');
    titulofila2XAlmacen.innerHTML = capital.nombre;
    titulofila3XAlmacen = document.createElement('td');
    titulofila3XAlmacen.innerHTML = capital.lote;
    titulofila4XAlmacen = document.createElement('td');
    titulofila4XAlmacen.innerHTML = capital.sumaPeso;
    titulofila5XAlmacen = document.createElement('td');
    titulofila5XAlmacen.innerHTML = capital.sumapz; 
    titulofila6XAlmacen = document.createElement('td');
    titulofila6XAlmacen.innerHTML = '<button type="button" id="'+capital.id+'" data-id="'+ContadorSecundario+'" class="btn btn-primary btn-lg seleccionarIdProductoXAlmacen">Seleccionar</button>';
    sessionStorage.setItem('producto_'+ContadorSecundario,JSON.stringify(capital));
    
    tituloXAlmacen.appendChild(titulofila1XAlmacen);
    tituloXAlmacen.appendChild(titulofila2XAlmacen);
    tituloXAlmacen.appendChild(titulofila3XAlmacen);
    tituloXAlmacen.appendChild(titulofila4XAlmacen);
    tituloXAlmacen.appendChild(titulofila5XAlmacen);
    tituloXAlmacen.appendChild(titulofila6XAlmacen); 
    tbody.appendChild(tituloXAlmacen);
   
    contador++;
    ContadorSecundario++;
    indiceJson++;
  }
  // Reemplazar cuerpo anterior por el actual
  const tabla = document.getElementById('tblDatosProdXAlmacen')
  tabla.replaceChild(thead, tabla.querySelector('thead'))
  tabla.replaceChild(tbody, tabla.querySelector('tbody'))
} 
// funcion para eliminar tabla menos la primer fila
 function deleteTable(idTable){
   let tableHeaderRowCount = 0;
   let table = document.getElementById(idTable);
   let countRows = table.rows.length;
   for(var i = tableHeaderRowCount; i<countRows; i++){
     table.deleteRow(tableHeaderRowCount)
   }
   
 }
 function clearDiv(idDiv){
   document.getElementById(idDiv);
 }
// este un helper par obtener las filas de las tablas 
 function upTo(el, tagName) {
  tagName = tagName.toLowerCase(); // se convierte en minuscula 

  while (el && el.parentNode) {
    el = el.parentNode;
    if (el.tagName && el.tagName.toLowerCase() == tagName) {
      return el;
    }
  }
  return null;
}    

 function deleteRow(r){
   var row = upTo(r, 'tr');
   if(row) row.parentNode.removeChild(row);
   
 }


 function porcentaje(porcentaje,total){
  let dato1 = parseFloat(porcentaje);
  let dato2 = parseFloat(total);
  let reesultadoDato  =  (dato1 * dato2) / 100;
  let reesultado = restar(total, reesultadoDato)
  return reesultado.toFixed(2);
 }

 function limpiarSession(){
  sessionStorage.clear();
}

function cambiarAempty(dato){
  let v = dato;
  if(dato == 500 || dato == "empty@empty.com"){
    v = 'SIN DATO';
  }

  return v;
}

function  visible(dato){
  datos = dato;
  var esVisible = false;
			if($("#"+dato).is(':visible') && $("#"+dato).css("visibility") != "hidden" && $("#"+dato).css("opacity") > 0) {
				esVisible =true;
			}
      return esVisible;
}