function resumenHorarios() {

    //$(document).ready(function(){

    /*      $('div#tabsContenido').tabs({
	 heightStyle: "content",
         fx: { opacity: 'toggle', duration: 400 },
         load:function(){
            toogleDocentes();
            toogleHora();
            toogleDia();
            toogleMateria();
            toogleCupos();
            botonAbrirFormulario();
            botonBorrarElemento();
            botonAccionesAjax();
         }
      });

      $('.acciones a').button();
      $('.acciones').buttonset();
*/

    /***********/
    // ACCIONES GENERALES //
    /*      $('#cerrar').click(function(){
         window.close();
         return false; 
      });
  */
    $('#imprimir').click(function () {
        window.print();
        return false;
    });

    $('#actualizar').click(function () {
        $("div#tabsContenido").tabs("load", $("div#tabsContenido").tabs("option", "active")); // Refrescar el tab activo.
        return false;
    });


    /******************************/

    $('#tipo-hora').click(function () {
        if (hora == 'normal') {
            hora = 'numero';
        } else if (hora == 'numero') {
            hora = 'mil'
        } else {
            hora = 'normal';
        }
        toogleHora();
        return false;
    });

    $('#ocultar-docentes').click(function () {
        if (docente == 'completo') {
            docente = 'min';
        } else if (docente == 'min') {
            docente = 'oculto';
        } else {
            docente = 'completo';
        }
        toogleDocentes();
        return false;
    });

    $('#ocultar-cupos').click(function () {
        if (cupo == 'completo') {
            cupo = 'oculto';
        } else {
            cupo = 'completo';
        }
        toogleCupos();
        return false;
    });

    $('#tipo-dia').click(function () {
        if (dia == 'completo') {
            dia = 'avr';
        } else {
            dia = 'completo';
        }
        toogleDia();
        return false;

    });

    $('#tipo-materias').click(function () {
        if (materia == 'completo') {
            materia = 'avr';
        } else {
            materia = 'completo';
        }
        toogleMateria();
        return false;
    });

    /*      $( "#dialog-form" ).dialog({
         autoOpen: false,
//         height: 400,
         position: { at: "top-30"},
         width: 400,
         modal: true,
         hide: "explode",
         open: function(){
            $('#dialog-form #formulario').html('<img src="img/loader.gif" /> '+'Cargando...');
            if(formulario){
//               $('#dialog-form #formulario').load(formulario);
               $.ajax({
                    url: formulario,
                    dataType: 'html',
                    success: function(datos){
                       $('#dialog-form #formulario').html(datos);
                    },
                    complete: function(){
                        $('form .error').addClass('ui-state-error ui-corner-all');
                        $('form .input').addClass('ui-state-default ui-corner-all');
                    }
               });
            }else{
               $( "#dialog-form" ).dialog('close');
            }
         },
         buttons: {
            "Guardar": function() {
               $( '#formularioDialog' ).submit( function() {
                  $(this).ajaxSubmit({
                     type: 'post',        // 'get' or 'post', override for form's 'method' attribute
                     success: function(data){
                           if(data == 'ok'){
                              $( "#dialog-form" ).dialog('close');
                              $( "div#tabsContenido" ).tabs( "load", $( "div#tabsContenido" ).tabs( "option", "active")); // Refrescar el tab activo.
                             // $('#relacionados').load();
                           }else{
                              $('#dialog-form #formulario').html(data);
                              $('form .error').addClass('ui-state-error ui-corner-all');
                              $('form .input').addClass('ui-state-default ui-corner-all');
                           }
                         },	// post-submit callback
                     complete: function(){
                        // reloadAjax('#relacionados');
//                              refrescarBotonesAcciones();                        
//      			$( "#dialog-form" ).dialog('close');
                     }
                  });
                  return false;
               }).submit();
            },
            "Cancelar": function() {
               $( this ).dialog( "close" );
            }
         },
         close: function() {
            $('#dialog-form #formulario').html('');
            formulario = null;
         }
      });
      /**/
    //      alert(formulario);


    /*      $('.abrir-formulario a').button().click(function(){
         formulario = $(this).attr('href');
         alert(formulario);
//         $( '#dialog-form' ).dialog({ title: $(this).text() });
         $( '#dialog-form' ).dialog( "open" );
         formulario = null;
         return false;
      });
*/

    //});
}




/*

function botonAccionesAjax(){
      $('.acciones-ajax a').click(function(){
         url = $(this).attr('href');
               $.ajax({
                    url: url,
                    dataType: 'html',
                    beforeSend: function(){
                       $('#cargador').html('<img src="img/loader.gif" />');
                    },
                    success: function(datos){
                        alert("Realizado con exito!!");
                        $( "div#tabsContenido" ).tabs( "load", $( "div#tabsContenido" ).tabs( "option", "active")); // Refrescar el tab activo.
                    },
                    complete: function(){
                        // Nada
                    }
               });
         return false;
      });
}
*/
/*
function botonBorrarElemento(){
      $('a#borrar').click(function(){
           if(!confirm('¿Esta seguro que desea realizar esta acción?\nUna vez eliminado el registro no podra volver a recuperarlo')){
                return false;
           }
           $( "div#tabsContenido" ).tabs( "load", $( "div#tabsContenido" ).tabs( "option", "active")); // Refrescar el tab activo.
           return false;
        });
    }
*/

function toogleDocentes() {
    if (docente == 'completo') {
        $('.docente-completo').attr('style', 'display: inline;');
        $('.docente-min').attr('style', 'display: none;');
        $('.docente-oculto').attr('style', 'display: none;');
    } else if (docente == 'min') {
        $('.docente-completo').attr('style', 'display: none;');
        $('.docente-min').attr('style', 'display: inline;');
        $('.docente-oculto').attr('style', 'display: none;');
    } else {
        $('.docente-completo').attr('style', 'display: none;');
        $('.docente-min').attr('style', 'display: none;');
        $('.docente-oculto').attr('style', 'display: inline;');
    }
}

function toogleCupos() {
    if (cupo == 'completo') {
        $('.cupo-completo').attr('style', 'display: inline;');
        $('.cupo-oculto').attr('style', 'display: none;');
    } else {
        $('.cupo-completo').attr('style', 'display: none;');
        $('.cupo-oculto').attr('style', 'display: inline;');
    }
}

function toogleHora() {
    /*   display: none;
   display: inline; */
    if (hora == 'normal') {
        $('span.hora-normal').attr('style', 'display: inline;');
        $('span.hora-numero').attr('style', 'display: none;');
        $('span.hora-mil').attr('style', 'display: none;');
    }
    if (hora == 'numero') {
        $('span.hora-normal').attr('style', 'display: none;');
        $('span.hora-numero').attr('style', 'display: inline;');
        $('span.hora-mil').attr('style', 'display: none;');
    }
    if (hora == 'mil') {
        $('span.hora-normal').attr('style', 'display: none;');
        $('span.hora-numero').attr('style', 'display: none;');
        $('span.hora-mil').attr('style', 'display: inline;');
    }
}

function toogleDia() {
    /*   display: none;
   display: inline; */
    if (dia == 'completo') {
        $('span.dia-comp').attr('style', 'display: inline;');
        $('span.dia-avr').attr('style', 'display: none;');
    } else {
        $('span.dia-comp').attr('style', 'display: none;');
        $('span.dia-avr').attr('style', 'display: inline;');
    }
}

function toogleMateria() {
    /*   display: none;
   display: inline; */
    if (materia == 'completo') {
        $('span.materia-nombre').attr('style', 'display: inline;');
        $('span.materia-avr').attr('style', 'display: none;');
    } else {
        $('span.materia-nombre').attr('style', 'display: none;');
        $('span.materia-avr').attr('style', 'display: inline;');
    }
}