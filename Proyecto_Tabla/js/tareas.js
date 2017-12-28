
//Helper que revisa el estado y devuelve la clase que pintara la fila actual
Handlebars.registerHelper("DisplayStatus", function (EstadoActual) {
    if (EstadoActual === "Cerrado") {
        return "table-success";
    } else if (EstadoActual === "Abierto") {
        return "table-danger";

    } else if (EstadoActual === "En proceso") {
        return "table-warning";
    } else if (EstadoActual === "Fusionado") {
        return "table-info";
    } else if (EstadoActual === "Postergado") {
        return "table-custom";
    } else {
        return "";
    }
});

//Funcion que busca el template de HandleBars, luego lo compila, le pone sus datos generando un html y devolviendolo
function createHTML(TareasData) {
    var rawTemplate =  document.getElementById("TareasTemplate").innerHTML;
    var compiledTemplate = Handlebars.compile(rawTemplate);
    var GeneratedHTML = compiledTemplate(TareasData);
    var TareasContainer = document.getElementById("TareasContainer");
    TareasContainer.innerHTML = GeneratedHTML;

}

//Funcion que busca el template de HandleBars, que agrega una fila al principio del html
function addHTML(newTarea) {
    var rawTemplate =  document.getElementById("TareasTemplate").innerHTML;
    var compiledTemplate = Handlebars.compile(rawTemplate);
    var GeneratedHTML = compiledTemplate(newTarea);
    var TareasContainer = document.getElementById("TareasContainer");
    TareasContainer.innerHTML = GeneratedHTML + TareasContainer.innerHTML;

}

$(document).ready(function () {
    //Guardar tarea a la database
    $(document).on('click','#submit_btn',function () {
        var tarea = $('#tarea').val();
        var responsable = $('#responsable').val();
        var fecha = $('#fecha').val();
        var estado = $('#estado').val();
        var observacion = $('#observacion').val();

        //Peticion AJAX al servidor php, seteando  SAVE
        $.ajax({
            url: 'Controller_TareasPorHacer.php',
            type: 'POST',
            data: {
                'save': 1,
                'tarea': tarea,
                'responsable': responsable,
                'fecha': fecha,
                'estado': estado,
                'observacion': observacion
            },
            success: function (response) {
                //Al recibir un success en ajax, revisar si la response es buena o un error
                //console.log(response.substring(0,5));

                if(response.substring(0,5) !== "Error"){
                    //var idactual = parseInt(response);
                    //var newData = [{"idTareas":idactual,"Tarea":tarea,"Responsable":responsable,"Fecha":fecha,"Estado":estado,"Observacion":observacion}];
                    //addHTML(newData);
                    CreateAlert("Creado");
                    ActualizarTemp();
                    $('#tarea').val('');
                    $('#responsable').val('');
                    $('#fecha').val('');
                    $('#estado').val('');
                    $('#observacion').val('');
                } else {
                    CreateAlert("CreadoFail");
                }


            }
        });
    });

    //Al apretar el boton de eliminar de una tarea
    $(document).on('click', '#destroy_btn', function(){
        var id = $(this).data('id');
        //$clicked_btn = $(this);

        //Peticion AJAX al servidor php, seteando  DELETE
        $.ajax({
            url: 'Controller_TareasPorHacer.php',
            type: 'GET',
            data: {
                'delete': 1,
                'id': id
            },
            success: function(response){
                //Al recibir un success en ajax, revisar si la response es buena o un error
                if (response.substring(0,5) !== "Error"){
                    //Actualizar el json de la tabla y cargar la tabla con los nuevos datos
                    CreateAlert("Eliminar");
                    ActualizarTemp();
                } else{
                    CreateAlert("EliminarFail");
                }
            }
        });
    });

    //Cargar datos en la forma para editar desde una tarea
    $(document).on('click', '#loadEdit_btn', function(){
        var id = $(this).attr('data-id');
        var tarea = $(this).attr('data-TarName');
        var responsable = $(this).attr('data-Resp');
        var fecha = $(this).attr('data-Fech');
        var estado = $(this).attr('data-Estad');
        var observacion = $(this).attr('data-Obs');

        var input2 = $("#tareaEDIT");
        var input3 = $("#responsableEDIT");
        var input4 = $("#fecha2");
        var input5 = $("#estadoEDIT");
        var input6 = $("#observacionEDIT");
        var editButton = $("#edit_btn");


        input2.prop("disabled", false);
        input3.prop("disabled", false);
        input4.prop("disabled", false);
        input5.prop("disabled", false);
        input6.prop("disabled", false);
        editButton.prop("disabled", false);

        $("#tareaIdEdit").val(id);
        input2.val(tarea);
        input3.val(responsable);
        input4.val(fecha);
        input5.val(estado);
        input6.val(observacion);
    });

    //Al apretar el boton de mandar editar
    $(document).on('click','#edit_btn',function () {
        var id = $('#tareaIdEdit').val();
        var tarea = $('#tareaEDIT').val();
        var responsable = $('#responsableEDIT').val();
        var fecha = $('#fecha2').val();
        var estado = $('#estadoEDIT').val();
        var observacion = $('#observacionEDIT').val();

        //Peticion AJAX al servidor php, seteando  UPDATE
        $.ajax({
            url: 'Controller_TareasPorHacer.php',
            type: 'POST',
            data: {
                'update': 1,
                'id': id,
                'tarea': tarea,
                'responsable': responsable,
                'fecha': fecha,
                'estado': estado,
                'observacion': observacion
            },
            success: function (response) {
                //console.log(response);

                //Al recibir un success en ajax, revisar si la response es buena o un error
                if(response.substring(0,5) !== "Error"){
                    $('#tarea').val('');
                    $('#responsable').val('');
                    $('#fecha').val('');
                    $('#estado').val('');
                    $('#observacion').val('');

                    //Actualizar el json de la tabla y cargar la tabla con los nuevos datos
                    CreateAlert("Edit");
                    ActualizarTemp();
                } else {
                    CreateAlert("EditFail");
                }
            }
        });
    });

});

function CreateAlert(tipo){
    var node = document.getElementById('Message');
    if(tipo === "Creado"){
        node.innerHTML = ('<div class="alert alert-success alert-dismissable">\n' +
            '                    <button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
            '                    <strong>Genial!</strong> Se ha creado su nueva tarea satisfactoriamente.\n' +
            '                </div>');
    } else if(tipo === "CreadoFail"){
        node.innerHTML = ('<div class="alert alert-warning alert-dismissable">\n' +
            '                    <button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
            '                    <strong>Oh no!</strong> Su tarea no se pudo crear, intentelo otra vez.\n' +
            '                </div>');
    } else if(tipo === "Edit"){
        node.innerHTML = ('<div class="alert alert-success alert-dismissable">\n' +
            '                    <button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
            '                    <strong>Genial!</strong> Se ha editado la tarea satisfactoriamente.\n' +
            '                </div>');
    }   else if(tipo === "EditFail"){
        node.innerHTML = ('<div class="alert alert-warning alert-dismissable">\n' +
            '                    <button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
            '                    <strong>Oh no!</strong> Su tarea no se pudo editar, intentelo otra vez.\n' +
            '                </div>');
    } else if(tipo === "Eliminar"){
        node.innerHTML = ('<div class="alert alert-success alert-dismissable">\n' +
            '                    <button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
            '                    <strong>Genial!</strong> Se ha eliminado la tarea satisfactoriamente.\n' +
            '                </div>');
    } else if(tipo === "EliminarFail"){
        node.innerHTML = ('<div class="alert alert-warning alert-dismissable">\n' +
            '                    <button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
            '                    <strong>Oh no!</strong> Su tarea no se pudo eliminar, intentelo otra vez.\n' +
            '                </div>');
    }
}
//Actualizador del JSON con los datos de las tareas
function ActualizarTemp() {

    //Peticion AJAX al servidor php, seteando  updateTable
    var request = $.ajax({
        url: 'Controller_TareasPorHacer.php',
        type: 'GET',
        data: {
            'updateTable': 1
        },
        success: function(response){
            //Al recibir un success en ajax, revisar si la response es buena o un error
           // console.log("table");
            //console.log(response);

        },
        complete: function (response) {
            //SI se completo, luego del success, actualizar la tabla con los datos actualizados
            loadTableData();
        }

    });


}

//Cargar tabla con los datos del JSON
function loadTableData() {

    //Resetear las casillas de EDIT
    var input1 = $("#tareaIdEdit");
    var input2 = $("#tareaEDIT");
    var input3 = $("#responsableEDIT");
    var input4 = $("#fecha2");
    var input5 = $("#estadoEDIT");
    var input6 = $("#observacionEDIT");
    var editButton = $("#edit_btn");

    input2.prop("disabled", true);
    input3.prop("disabled", true);
    input4.prop("disabled", true);
    input5.prop("disabled", true);
    input6.prop("disabled", true);
    editButton.prop("disabled", true);

    input1.val('');
    input2.val('');
    input3.val('');
    input4.val('');
    input5.val('');
    input6.val('');


    //Conexion por GET al controlador pidiendo los datos
    var TareasRequest = new XMLHttpRequest();
    var URL = "temp.json";
    TareasRequest.open('GET', URL, true);

    //Al cargar la pagina, se ve si la request y se crea segun esta el cuerpo de las tablas
    TareasRequest.onload = function () {
        if (TareasRequest.status >= 200 && TareasRequest.status < 400) {
            var data = JSON.parse(TareasRequest.responseText);
            //console.log(TareasRequest);
            createHTML(data.reverse());

        } else {
            console.log("Connectado a la DB pero sucedio un errorr");
        }

    };

    //ErrorHandler de la conexion
    TareasRequest.onerror = function () {
        console.log("Connection error");
    };

    //Envio Datos a la vista
    TareasRequest.send();
}

//Carga de tabla inicial de la pagina
loadTableData();