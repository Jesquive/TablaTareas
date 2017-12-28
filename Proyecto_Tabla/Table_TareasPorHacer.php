<?php
/**
La tarea puntual es que haga un formulario "TAREAS POR HACER" usando php, bootstrap y mysql que guarde una bitácora de tareas con los siguientes datos:
Tabla Tareas: Campos (Tarea, Responsable, Fecha, Estado, ObservacionFinal)

Con una tabla de Estados con los siguientes campos: abierto, cerrado, en proceso, anulado, fusionado, postergado
Esta tabla de Estados la dejas en la base de datos, con estos datos. No es necesario un mantenedor aún. Pero si un mantenedor de Tareas.
 */

?>
<?php include('Controller_TareasPorHacer.php');
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Tareas Por Hacer</title>
        <meta name="author" content="Jordan Esquivel">
        <meta name="description" content="Tabla Reponsive Tareas por hacer">
        <!-- Bootstrap-->
        <link rel="stylesheet" type="text/css" href="bootstrap4beta2/css/bootstrap.min.css">

        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <!-- JQUERY-->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    </head>
    <body>



    <div class="container-fluid">

        <h2 id="Titulo"> Tareas por Hacer </h2>
        <div class="row">
            <div class="col-sm-4">
                <div class="alerts" id="Message">
                    <!-- Donde esta el HTML de las notificaciones-->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <!-- Forma de Creacion de Tarea-->
                <h3>Crear Tarea</h3>
                <form>
                    <div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="tarea">Tarea:</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" size="10" name="tarea" id="tarea">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="responsable">Responsable:</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" size="10" name="responsable" id="responsable">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="fecha">Fecha:</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" id="fecha" name="fecha">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="estado">Estado:</label>
                            </div>
                            <div class="col-sm-3">
                                <select name="estado" id="estado">
                                    <option value="Abierto">Abierto</option>
                                    <option value="En proceso">En proceso</option>
                                    <option value="Cerrado">Cerrado</option>
                                    <option value="Fusionado">Fusionado</option>
                                    <option value="Postergado">Postergado</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="observacion">Observacion:</label>
                            </div>
                            <div class="col-sm-3">
                                <textarea type="text" rows="2" cols="10" name="observacion" id="observacion"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="submit_btn">Crear</button>
                </form>
            </div>

            <!-- Forma de Edicion de Tarea-->
            <div class="col-md-4">
                <h3>Editar Tarea</h3>
                <form>
                    <div>
                        <input id="tareaIdEdit" name="tareaIdEdit" type="hidden" value="">
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="tarea">Tarea:</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" size="10" name="tareaEDIT" id="tareaEDIT" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="responsable">Responsable:</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" size="10" name="responsableEDIT" id="responsableEDIT" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="fecha">Fecha:</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" id="fecha2" name="fecha2" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="estado">Estado:</label>
                            </div>
                            <div class="col-sm-3">
                                <select name="estadoEDIT" id="estadoEDIT" disabled>
                                    <option value="Abierto">Abierto</option>
                                    <option value="En proceso">En proceso</option>
                                    <option value="Cerrado">Cerrado</option>
                                    <option value="Fusionado">Fusionado</option>
                                    <option value="Postergado">Postergado</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="observacion">Observacion:</label>
                            </div>
                            <div class="col-sm-3">
                                <textarea type="text" rows="2" cols="10" name="observacionEDIT" id="observacionEDIT" disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-info" id="edit_btn" disabled>Editar</button>
                </form>
            </div>
        </div>

        <!--Tabla de Tareas -->
        <div class="row">
            <div class="col-md-12">
                <table class="table table-responsive table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Tarea</th>
                        <th>Responsable</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th style="width: 150px;">Observacion Final</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody id="TareasContainer">
                    <!-- Donde se cargaran las templates con datos-->
                    </tbody>
                </table>
            </div>
        </div>


    </div>





        <!-- Tareas Template -->
        <script id="TareasTemplate" type="text/x-handlebars-template">
            {{#each this}}
                {{#if this}}
                    <tr class= {{DisplayStatus Estado}}>
                        <td>{{Tarea}}</td>
                        <td>{{Responsable}}</td>
                        <td>{{Fecha}}</td>
                        <td>{{Estado}}</td>
                        <td>{{Observacion}}</td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" id="loadEdit_btn" data-id={{idTareas}} data-TarName='{{Tarea}}' data-Resp='{{Responsable}}' data-Fech={{Fecha}} data-Estad={{Estado}} data-Obs='{{Observacion}}' class="btn btn-info" >Editar</button>
                                </div>
                                <div class="col-md-6">
                                        <button type="button" id="destroy_btn" data-id={{idTareas}} class="btn btn-danger">Borrar</button>
                                </div>
                            </div>

                        </td>
                    </tr>
                {{/if}}
            {{/each}}
        </script>


        <!-- jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $( function() {
                $( "#fecha" ).datepicker({
                    dateFormat: "yy-mm-dd",
                    defaultDate: +1,
                    autoSize: true
                });

                $( "#fecha2" ).datepicker({
                    dateFormat: "yy-mm-dd",
                    defaultDate: +1,
                    autoSize: true
                });
            } );
        </script>

        <!-- SCRIPTS -->
        <script src="bootstrap4beta2/js/bootstrap.bundle.js"></script>

        <!--App-->
        <script src="js/handlebars-v4.0.11.js"></script>
        <script src="js/tareas.js"></script>



    </body>
</html>
