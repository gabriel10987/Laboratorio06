<?php
//print_r($_POST);
if (empty($_POST["oculto"]) || empty($_POST["txtTitulo"]) || empty($_POST["txtDescripcion"]) || empty($_POST["txtFechaCreacion"]) || empty($_POST["txtFechaVencimiento"]) || empty($_POST["txtPrioridad"]) || empty($_POST["txtEstado"])) {
    header('Location: index.php?mensaje=falta');
    exit();
}

include_once 'model/conexion.php';
$titulo = $_POST['txtTitulo'];
$descripcion = $_POST['txtDescripcion'];
$fecha_creacion = $_POST['txtFechaCreacion'];
$fecha_vencimiento = $_POST['txtFechaVencimiento'];
$prioridad = $_POST['txtPrioridad'];
$estado = $_POST['txtEstado'];


$sentencia = $bd->prepare("INSERT INTO tareas(titulo, descripcion, fecha_creacion, fecha_vencimiento, prioridad, estado) VALUES (?,?,?,?,?,?);");
$resultado = $sentencia->execute([$titulo, $descripcion, $fecha_creacion, $fecha_vencimiento, $prioridad, $estado]);

if ($resultado === TRUE) {
    header('Location: index.php?mensaje=registrado');
} else {
    header('Location: index.php?mensaje=error');
    exit();
}