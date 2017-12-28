<?php

/* Clase encargada de manejar la conexion directa con la DB*/
$servername = "localhost";
$username = "root";
$password = "4566";
$dbname = "test";

// Crear Conexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Revisar Conexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Para crear una nueva tarea
if (isset($_POST['save'])) {
    $tarea = $_POST['tarea'];
    $responsable = $_POST['responsable'];
    $fecha = $_POST['fecha'];
    $estado = $_POST['estado'];
    $observacion = $_POST['observacion'];

    //Sentencia SQL para agregar una tarea desde la forma
    $sql = "INSERT INTO tareas (tarea, responsable,fecha,estado,observacion) VALUES ('{$tarea}', '{$responsable}', '{$fecha}', '{$estado}', '{$observacion}')";
    if ($conn->query($sql) === TRUE) {
        echo $conn->insert_id;
    } else {
        echo "Error: ". mysqli_error($conn) . $sql;
    }
    exit();
}

//Para borrar una tarea
if (isset($_GET['delete'])) {
    $id = $_GET['id'];

    //Sentencia SQL para borrar segun ID
    $sql = "DELETE FROM tareas WHERE idTareas=" . $id;
    if ($conn->query($sql) === TRUE) {
        echo $conn->insert_id;
    } else {
        echo "Error: ". mysqli_error($conn) . $sql;
    }
    exit();
}

//SI se requiere actualizar la tabla, se actualiza el json temp
if (isset($_GET['updateTable'])) {
    //Request SQL sobre las tareas
    $RequestTareas = "SELECT * FROM tareas";
    $result = $conn->query($RequestTareas);

    //Crear el objeto JSON para tareas.js
    $TareasData = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $TareasData[] = $row;
        }
    } else {
        echo "0 results \n";
    }
    $json_data = json_encode($TareasData);
    file_put_contents('temp.json', $json_data);
    exit();
}

//Si se quiere actualizar una fila de la tabla
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $tarea = $_POST['tarea'];
    $responsable = $_POST['responsable'];
    $fecha = $_POST['fecha'];
    $estado = $_POST['estado'];
    $observacion = $_POST['observacion'];

    //Sentencia SQL de actualizacion
    $sql = "UPDATE tareas SET Tarea='{$tarea}', Responsable='{$responsable}', Fecha='{$fecha}', Estado='{$estado}', Observacion='{$observacion}' WHERE idTareas=".$id;
    if ($conn->query($sql) === TRUE) {
        echo $conn->insert_id;
    }else {
        echo "Error: ". mysqli_error($conn);
    }
    exit();
}



//Request SQL sobre las tareas, para llenar el json de forma inicial
$RequestTareas = "SELECT * FROM tareas";
$result = $conn->query($RequestTareas);

//Crear el objeto JSON para tareas.js
$TareasData = array();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $TareasData[] = $row;
    }
} else {
    echo "0 results \n";
}
$json_data = json_encode($TareasData);
file_put_contents('temp.json', $json_data);
?>