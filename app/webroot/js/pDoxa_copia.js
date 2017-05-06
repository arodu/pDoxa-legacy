//var ultimo = null;
var global = new Object();
    global.formulario = null;

var globalFormato = new Object();
    globalFormato["docente"] = "completo";
    globalFormato["hora"] = "normal";
    globalFormato["dia"] = "completo";
    globalFormato["materia"] = "completo";
    globalFormato["cupo"] = "completo";

//var docente = 'completo';
//var hora = 'normal';
//var dia = 'completo';
//var materia = 'completo';
//var cupo = 'completo';

/* Funcion para Iniciar el Layout*/
function iniciar() {
    
    /*$(document).tooltip({
        tooltipClass: "ui-widget-header",
    });*/

    /* Borde de las Columnas */
    $('#layout #bordeBoton').draggable({
        axis: "x",
        zIndex: 100,
        cursor: 'ew-resize',
        containment: "#layout",
        drag: function( event, ui ) {
            $( "#layout #content" ).css("left",((ui.position.left)+2)+'px');
            $( "#layout #left" ).css("width",(ui.position.left)+'px');
        },
        stop: function( event, ui ) {
            if(ui.position.left <= 100){
                $( "#layout #left" ).addClass('no-screen');
            }else{
                $( "#layout #left" ).removeClass('no-screen');
            }
        },
    });
    
    $("#mainmenu").buttonset();

    $("#mainmenu a.left").click(function () {
        cargarContent($(this), "#left", "Cargando menu...");

        return false;
    });

    //$("#mainmenu a.inicio").click(true);
    //$("#mainmenu a.cerrar").click(true);

    $("#mainmenu .inactivo").button("disable");

    $("#dialog-form").dialog({autoOpen: false,width: 400,modal: true,hide: "explode",
        title: "pDoxa",
        //height: 400,
        position: { at: "top-30"},
        open: function () {
            $('#dialog-form #formulario').html('<img src="' + globalUrl + 'img/loader.gif" /> ' + 'Cargando...');
            if (global.formulario) {
                $.ajax({url:global.formulario, dataType:'html', 
                    error: function () {
                        window.open(globalUrl);
                    },
                    success: function (datos) {
                        $('#dialog-form #formulario').html(datos);
                    },
                    complete: function () {
                        addClassFormulario();
                    }
                });
            } else {
                $("#dialog-form").dialog('close');
            }
        },
        close: function () {
            $('#dialog-form #formulario').html('');
            global.formulario = null;
        },
        buttons: {
            "Guardar": function () {
                $('#formularioDialog').submit(function () {
                    $(this).ajaxSubmit({
                        type: 'post', // 'get' or 'post', override for form's 'method' attribute
                        success: function (data) {
                            if (data == 'ok') {
                                $("#dialog-form").dialog('close');
                                global.formulario = null;
                                $("div#tabsContenido").tabs("load", $("div#tabsContenido").tabs("option", "active")); // Refrescar el tab activo.
                                //$('#relacionados').load();
                            } else {
                                $('#dialog-form #formulario').html(data);
                                addClassFormulario();
                            }
                        },
                        complete: function () {
                            reloadAjax('#relacionados');
                        }
                    });
                    return false;
                }).submit();
            },
            "Cancelar": function () {
                $("#dialog-form").dialog('close');
            }
        },
    });
    
    toogleDatosImpresion();
    refrescarContenido();
    
} // Fin Funcion Iniciar()

function reloadAjax(etiqueta) {
    var href = $(etiqueta).find('span#url').text();
    $.ajax({
        url: href,
        dataType: 'html',
        beforeSend: function (){
            cargador('Cargando datos, por favor espere...');
        },
        success: function (datos) {
            $(etiqueta).html(datos);
        },
        complete: function () {
            refrescarBotonesAccionInterno(etiqueta);
            cargador(null);
        }
    });
}

function mensajeFlash() {
    $('#flashMessage').dialog({hide: "explode",title: 'pDoxa',modal: true,
        //draggable: false,
        //resizable: false,
        buttons: {
            Aceptar: function () {
                $(this).dialog("close");
            }
        },
        close: function () {
            $(this).addClass("no-print no-screen");
            $(this).dialog("destroy");
        }
    });
}

function authMessage() {
    $('#authMessage').addClass("ui-state-error");
}

function cambiarEstilos(){
    var tema;
    $("#cambiarTemas").change(function (){
        if($('#cambiarTemas option:selected').val() != ""){
            tema = $('#cambiarTemas option:selected').text();
        }else{
            tema = 'cupertino';
        }
        $("#tema").attr("href", globalUrl+"css/temas/"+tema+"/jquery-ui.css"); 
    });
}

function refrescarContenido(){
    $("#content .paginator a").click(function () {
        $("#content").load(this.href);
        return false;
    });

    $("#content .buttonset").buttonset();

    $("#content div#accordionContenido").accordion({
        //collapsible: true,
        heightStyle: "fill"
    });
    
    $("#content div#accordionImpresion").accordion({
        heightStyle: "content"
    });

    $("#content div#tabsInformacion").tabs({
        heightStyle: "fill",
        fx: {
            opacity: 'toggle',
            duration: 200
        }
    });

    var tabsAulas = $("#content div#tabsContenido").tabs({
        //heightStyle: "fill",  // TEMPORAL POR IMPRESION
        fx: {
            opacity: 'toggle',
            duration: 200
        },
        //collapsible: true,
        activate: function () {
            //alert($( "div#tabsContenido" ).tabs( "option", "active"));
        },
        load: function () {
            refrescarBotonesAccionesContent();
            toogleDatosImpresion();
            refrescarCuadroAula(); 
            encuentrosCargado(); // Actualiza los encuentros en la barra left
        }
    });

    tabsAulas.find(".ui-tabs-nav").sortable({
        axis: "x",
        stop: function () {
            tabsAulas.tabs("refresh");
        }
    });

    $('#content #formularioAjax').submit(function () {
        // inside event callbacks 'this' is the DOM element so we first 
        // wrap it in a jQuery object and then invoke ajaxSubmit 
        $(this).ajaxSubmit({
            target: '#content',
            beforeSubmit: function () {
                cargador('Cargando datos, por favor espere...');
//                $('#cargador').html('<img src="' + url + 'img/loader.gif" /> ' + 'Cargando datos, por favor espere...');
            },
            complete: function () {
                cargador(null);
//                $('#cargador').html('');
                refrescarContenido();
            }
        });
        // !!! Important !!! 
        // always return false to prevent standard browser submit and page navigation 
        return false;
    });

    // Paginacion en content
/*    $('#content .index .ordenar a,#content a.ordenar,#content .paging a').click(function () {
        cargarContent($(this));
        return false;
    }); */

    mensajeFlash();
    authMessage();
    refrescarBotonesAccionesContent();
    refrescarPaginacion();
    addClassFormulario();
    refrescarMultiplesCheckBox();
    cambiarEstilos();
}

function refrescarPaginacion() {

    $(".paginas span.disabled").button({
        disabled: true
    });

    $(".paginas span.current").button({
        disabled: true
    });
    
    $(".paginas").buttonset();
    
    $('.ordenar a').addClass('link');

    $('#paginacion .paginas a, #paginacion .ordenar a').click(function () {
        cargarContent($(this), '#paginacion');
        return false;
    });

    $('#paginacionContent .paginas a, #paginacionContent .ordenar a').click(function () {
        cargarContent($(this), '#content');
        return false;
    });

    refrescarBotonesAccionInterno('#paginacion');
}


function refrescarBotonesAccionInterno(etiqueta) {

    $(etiqueta+' .acciones a').button().click(function () {
        $('.acciones a').button('disable');
        if ($(this).attr('id') === 'borrar') {
            if (!confirm('¿Esta seguro que desea realizar esta acción?\nUna vez eliminado el registro no podra volver a recuperarlo')) {
                $('.acciones a').button('enable');
                $('.acciones a.inactivo').button('disable');
                return false;
            }
        }
        
        if ($(this).attr('id') == 'alerta') {
            alert('Acción delicada! - ');
            if (!confirm('¿Esta seguro que desea realizar esta acción?')) {
                $('.acciones a').button('enable');
                $('.acciones a.inactivo').button('disable');
                return false;
            }
        }
        
        cargarContent($(this),'#content');
        return false;
    });

    $(etiqueta+' .acciones a.inactivo').button('disable');
    
    $(etiqueta+' .boton a',etiqueta+' div.boton').button();
    
    

    $(etiqueta+' .abrir-formulario a').click(function () {
        global.formulario = $(this).attr('href');
        $('#dialog-form').dialog("open");
        //formulario = null;
        return false;
    });
}

function refrescarBotonesAcciones(etiqueta){
//function refrescarBotonesAccionesContent(){
    

    $(etiqueta+' .abrir-formulario a').not('#paginacion a').click(function () {
        global.formulario = $(this).attr('href');
        $('#dialog-form').dialog("open");
        //formulario = null;
        return false;
    });

    $(etiqueta+' .acciones a').not('#paginacion a').button().click(function () {
        $('.acciones a').button('disable');
        if ($(this).attr('id') == 'borrar') {
            if (!confirm('¿Esta seguro que desea realizar esta acción?\nUna vez eliminado el registro no podra volver a recuperarlo')) {
                $('.acciones a').button('enable');
                $('.acciones a.inactivo').button('disable');
                return false;
            }
        }

        if ($(this).attr('id') == 'alerta') {
            if (!confirm('¿Esta seguro que desea realizar esta acción?')) {
                $('.acciones a').button('enable');
                $('.acciones a.inactivo').button('disable');
                return false;
            }
        }

        cargarContent($(this),'#content');
        return false;
    });

    $('#content .acciones a.inactivo').not('#paginacion a').button('disable');

    $("#content .boton a, #content div.boton").not('#paginacion a').button();
    
    $('#content .popup a, #content .vistaImpresion a').click(function (){
        window.open($(this).attr('href'),'_blank');
        return false;
    });
}

function refrescarMenu() {
    /*$("#left a.boton").button().click(function () {
        cargarContent($(this));
        return false;
    });*/

    $("#left div#accordionMenu").accordion({
        //collapsible: true, 
        heightStyle: "fill"
    });

    //$('.submenu').menu('destroy');
    $('#left .submenu').menu();

    $('#left .submenu .inactivo').addClass("ui-state-disabled");
    $('#left .submenu .inactivo a').click(false);

    $('#left .submenu .content.activo a').click(function () {
        /*if ($(this).attr('id') == 'borrar') {
            if (!confirm('¿Esta seguro que desea realizar esta acción?\nUna vez eliminado el registro no podra volver a recuperarlo')) {
                return false;
            }
        }*/
        cargarContent($(this));

        return false;
    });

    $('#left .submenu .popup.activo a').click(function () {
        // alert('Abrir Ventana: '+$(this).attr('href'));
        // window.open($(this).attr('href'),'popup','menubar=1,resizable=1,top=0,width=700,height=600');
        window.open($(this).attr('href'));
        // window.open($(this).attr('href'),'popup','top=0,width=700,height=600');
        return false;
    });

    refrescarSeleccionarSecciones();
    resumenHorarios();
    cambiarEstilos();
    addClassFormulario();
}

function cargador(mensaje,finalizado){
    if(mensaje == null){
        if(!finalizado){ finalizado = '<span class="ui-icon ui-icon-check" style="display: inline-block;"></span>Realizado con Exito!'}
        $('#cargador').html(finalizado);
        $("#cargador").hide( "highlight",{},"slow" );
    }else{
        $('#cargador').html('<img src="' + globalUrl + 'img/loader.gif" /> ' + mensaje);
        $("#cargador").show();
    }
}

function cargarContent(objetoUrl, etiqueta, mensaje) {
    var localUrl
    if (!mensaje) { mensaje = "Cargando, por favor espere..."; }
    if (!etiqueta) { etiqueta = '#content'; }
    if((typeof objetoUrl) === 'string'){
        localUrl = objetoUrl;
    }else{
        localUrl = objetoUrl.attr('href');
    }
    
    $.ajax({
        url: localUrl,
        beforeSend: function () {
//            $('#cargador').html('<img src="' + url + 'img/loader.gif" /> ' + mensaje);
            cargador(mensaje);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            if (xhr.status == 403) {
                alert('La Sesion ha Caducado');
                window.open(globalUrl, '_self');
            }
        },
        success: function (datos) {
            $(etiqueta).html(datos);
        },
        complete: function () {
            if (etiqueta === '#content') {       refrescarContenido(); }
            else if (etiqueta === '#paginacion') {    refrescarPaginacion(); }
            else if (etiqueta === '#left') {   refrescarMenu(); }
            cargador(null);            
        }
    });
}

function refrescarCuadroAula(){
    var htmlAntes;
    $('#content .bloque-libre').droppable({
        activeClass: "ui-state-hover",
        hoverClass: "ui-state-active",
        accept: ".mtr-libre, .mtr-ocupado, .bloque-ocupado",

        drop: function (event, ui) {
            var aula_id = $(this).find('span.aula_id').text();
            var objeto = $(this);
            var htmlAntes = objeto.html();
            //$(this).addClass("ui-state-active").html('<img src="' + globalUrl + 'img/loader.gif" />Cargando..'); // Modifica el valor del bloque antes de enviar.
            //ultimo = $(this).attr('id');
            var bloque_id = $(this).attr('id');
            var encuentros_seccion_id = ui.draggable.attr('id');
            $.ajax({
                url: globalUrl + 'bloques/asignarSeccion/' + bloque_id + '/' + encuentros_seccion_id,
                beforeSend: function () {
                    cargador("Guardando Datos...");
                    objeto.addClass("ui-state-active").removeClass('ui-state-disabled').html('<img src="' + globalUrl + 'img/loader.gif" />Cargando..'); // Modifica el valor del bloque antes de enviar.
                },
                success: function (datos) {
                    if (datos != 'ok'){
                        objeto.removeClass("ui-state-active").addClass('ui-state-disabled').html(htmlAntes);
                        alert(datos);
                    }else{
                        $("div#tabsContenido").tabs("load", $("div#tabsContenido").tabs("option", "active")); // Refrescar el tab activo.
                    }
                    //encuentrosCargado();
                    //$("#cuadro-" + aula_id).load(url + "aulas/verBloques/" + aula_id,refrescarCuadroAula);
                },
                complete: function () {
                    //encuentrosCargado();
                    cargador(null);
                    //$(this).removeClass("ui-state-active").html(htmlAntes);
                }
            });
            addClass: "ui-state-default";
        }
    });
    
    $('#content #ubicacion').tooltip({
        
         content: function() {
            return $(this).find('#tooltip').html();
            //return "<img class='map' src='http://"+ escape("maps.googleapis.com/maps/api/staticmap?size=400x400&maptype=hybrid&sensor=false&markers=color:red|" + coord ) +"'>";
         }
    });
    

    $('#content .inactivo').droppable("disable");
    
    $('#content .papelera').droppable({
        greedy: true,
        accept: ".mtr-ocupado, .bloque-ocupado",
        activeClass: "ui-state-focus",
        hoverClass: "ui-state-active",
        //over: function () {
        //    $('#content .bloque-libre').droppable('disable');
        //},
        //out: function () {
        //    $('#content .bloque-libre').droppable('enable');
        //},
        /*
        create: function () {
            $('#papelera').button( "disable" );
        },
        active: function () {
            $('#papelera').button( "enable" );
        },
        deactivate: function () {
            $('#papelera').button( "disable" );
        },*/
        drop: function (event, ui) {
            var objeto = $(this);
            if (confirm("¿Esta seguro que desea eliminar esta seccion del Horario?")) {
                //$(this).addClass("ui-state-active").find('p').html('<img src="' + globalUrl + 'img/loader.gif" />Borrando Seccion de Horario..'); // Modifica el valor del bloque antes de enviar
                $.ajax({
                    url: globalUrl + 'bloques/desasignarSeccion/' + ui.draggable.attr('id'),
                    beforeSend: function () {
                        cargador('Borrando Datos...');
                        objeto.addClass("ui-state-active").find('#texto').html('<img src="' + globalUrl + 'img/loader.gif" />Borrando Seccion de Horario..'); // Modifica el valor del bloque antes de enviar
                    },
                    success: function (datos) {
                        
                        
                    },
                    complete: function () {
                        $("div#tabsContenido").tabs("load", $("div#tabsContenido").tabs("option", "active")); // Refrescar el tab activo.
                        cargador(null,'Borrado con Exito!');
                    }
                });
            }
        }
    });

    $('#content #papelera').tooltip({
        position: { my: "left+15 center", at: "right center" },
        tooltipClass: "ui-widget-header",
    });

    $('.bloque-ocupado').draggable({
        revert: "invalid",
        cursor: "move",
        helper: 'clone',
        containment: '#content',
        scroll: false,
        zIndex: 100,
        opacity: 0.80,
        cursorAt: { top: 10, left: 10 },
    });

/*    $('#content .abrir-formulario a').not('#paginacion a').click(function () {
        formulario = $(this).attr('href');
        $('#dialog-form').dialog("open");
        return false;
    }); */

    $('#cuadroAula .abrir-formulario a').click(function () {
        global.formulario = $(this).attr('href');
        $('#dialog-form').dialog("open");
        //formulario = null;
        return false;
    });

}

function refrescarMultiplesCheckBox() {
    $(".check_todos").click(function (event) {
        var id = $(this).closest("fieldset").attr("id");

        //        alert(id);

        if ($(this).is(":checked")) {
            $("#" + id + " .ck:checkbox:not(:checked)").attr("checked", "checked");
        } else {
            $("#" + id + " .ck:checkbox:checked").removeAttr("checked");
        }
    });
}

function refrescarSeleccionarSecciones() {

    $('#left .input').addClass('ui-state-default ui-corner-all');

    $("#btn-maestroAulas").button({
        icons: {
            primary: "ui-icon-refresh"
        }
    });

    $("#selectMaterias select").change(function () {
        $("#selectMaterias select option:selected").each(function () {
            materia_id = $(this).val();
            $.ajax({
                url: globalUrl + "seccions/seleccionar/" + materia_id,
                success: function (datos) {
                    $("#selectSecciones").html(datos);
                    $("#selectEncuentros").html("");
                },
                complete: function () {
                    seccionesCargado();
                }
            });
        });
        $(this).blur();
    });

    addClassFormulario();

}

function seccionesCargado() {
    $("#selectSecciones .input").addClass('ui-state-default ui-corner-all');

    $("#selectSecciones select").change(function () {
        encuentrosCargado();
        $(this).blur();
    });
    addClassFormulario();
}

function encuentrosCargado() {
    $("#selectSecciones select option:selected").each(function () {
        seccion_id = $(this).val();
        $.ajax({
            url: globalUrl + "seccions/seleccionarEncuentros/" + seccion_id,
            success: function (datos) {
                $("#selectEncuentros").html(datos);
            },
            complete: function () {
                $('.mtr-libre, .mtr-ocupado').draggable({
                    revert: "invalid",
                    cursor: "move",
                    helper: 'clone',
                    //containment: '#content',
                    scroll: false,
                    zIndex: 100,
                    opacity: 0.80,
                    cursorAt: { top: 10, left: 10 },
                });

                $('.irContent a').click(function (){
                    cargarContent($(this));
                    return false;
                });
                //$("#selectSecciones .input").addClass('ui-state-default ui-corner-all');
            }
        });
    });
}

function addClassFormulario() {
    var tipos = $("form input,form select,select, textarea").not("input[type=submit],input[type=button],input[type=hidden]");
    
    tipos.addClass('ui-widget-content ui-corner-all');
    
    tipos.tooltip({
        position: {},
    });

    tipos.focus(function () {
        $(this).addClass('ui-state-highlight');
        $(this).tooltip("open");
    });
    
    tipos.blur(function () {
        $(this).removeClass('ui-state-highlight');
        $(this).tooltip("close");
    });

    $('form .error').addClass('ui-state-error ui-corner-all');
    
    $('form .input').addClass('ui-state-default ui-corner-all');

    $('form .submit input').button();
    
    $('input[type=submit],input[type=button]').button();
    
    $('.submit.principal input').button({
        
        
    });
    
    $('form select.changeSubmit').change(function (){
        $(this).closest('form').submit();
    });

    $('form select[multiple]').chosen({
        no_results_text: "No encontrado...",
        width: "95%",
    }).change(function(){
        $('form .chosen-container .search-choice').addClass('ui-widget-header ui-corner-all');
    });
    
    $('form .chosen-container .search-choice').addClass('ui-widget-header ui-corner-all');
    $('form .chosen-container .chosen-choices').addClass('ui-corner-all ui-widget-content');
    $('form .chosen-container .chosen-results').addClass('ui-state-highlight');
    $('form .chosen-container .chosen-drop').addClass('ui-corner-bottom ui-widget-content');
    
    
    
}

function resumenHorarios() {
    
    $('#left a#imprimir').click(function () {
        window.print();
        return false;
    });

    $('#left a#actualizar').click(function () {
        $("div#tabsContenido").tabs("load", $("div#tabsContenido").tabs("option", "active")); // Refrescar el tab activo.
        return false;
    });

    /******************************/

    $('#left #tipo-hora').click(function () {
        if (globalFormato.hora == 'normal') {
            globalFormato.hora = 'numero';
        } else if (globalFormato.hora == 'numero') {
            globalFormato.hora = 'mil'
        } else {
            globalFormato.hora = 'normal';
        }
        toogleHora();
        return false;
    });

    $('#left #ocultar-docentes').click(function () {
        if (globalFormato.docente == 'completo') {
            globalFormato.docente = 'min';
        } else if (globalFormato.docente == 'min') {
            globalFormato.docente = 'oculto';
        } else {
            globalFormato.docente = 'completo';
        }
        toogleDocentes();
        return false;
    });

    $('#left #ocultar-cupos').click(function () {
        if (globalFormato.cupo == 'completo') {
            globalFormato.cupo = 'oculto';
        } else {
            globalFormato.cupo = 'completo';
        }
        toogleCupos();
        return false;
    });

    $('#left #tipo-dia').click(function () {
        if (globalFormato.dia == 'completo') {
            globalFormato.dia = 'avr';
        } else {
            globalFormato.dia = 'completo';
        }
        toogleDia();
        return false;
    });

    $('#left #tipo-materias').click(function () {
        if (globalFormato.materia == 'completo') {
            globalFormato.materia = 'avr';
        } else {
            globalFormato.materia = 'completo';
        }
        toogleMateria();
        return false;
    });
}

function toogleDocentes() {
    if (globalFormato.docente == 'completo') {
        $('.docente-completo').attr('style', 'display: inline;');
        $('.docente-min').attr('style', 'display: none;');
        $('.docente-oculto').attr('style', 'display: none;');
    } else if (globalFormato.docente == 'min') {
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
    if (globalFormato.cupo == 'completo') {
        $('.cupo-completo').attr('style', 'display: inline;');
        $('.cupo-oculto').attr('style', 'display: none;');
    } else {
        $('.cupo-completo').attr('style', 'display: none;');
        $('.cupo-oculto').attr('style', 'display: inline;');
    }
}

function toogleHora() {
    if (globalFormato.hora == 'normal') {
        $('span.hora-normal').attr('style', 'display: inline;');
        $('span.hora-numero').attr('style', 'display: none;');
        $('span.hora-mil').attr('style', 'display: none;');
    }
    if (globalFormato.hora == 'numero') {
        $('span.hora-normal').attr('style', 'display: none;');
        $('span.hora-numero').attr('style', 'display: inline;');
        $('span.hora-mil').attr('style', 'display: none;');
    }
    if (globalFormato.hora == 'mil') {
        $('span.hora-normal').attr('style', 'display: none;');
        $('span.hora-numero').attr('style', 'display: none;');
        $('span.hora-mil').attr('style', 'display: inline;');
    }
}

function toogleDia() {
    /*   display: none;
   display: inline; */
    if (globalFormato.dia == 'completo') {
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
    if (globalFormato.materia == 'completo') {
        $('span.materia-nombre').attr('style', 'display: inline;');
        $('span.materia-avr').attr('style', 'display: none;');
    } else {
        $('span.materia-nombre').attr('style', 'display: none;');
        $('span.materia-avr').attr('style', 'display: inline;');
    }
}

function toogleDatosImpresion(){
    toogleDocentes();
    toogleCupos();
    toogleHora();
    toogleDia();
    toogleMateria();
}

$(document).ready(iniciar);