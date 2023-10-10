<?php 
    if(!isset($_GET['codigo'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include 'model/conexion.php';
    // Recupera el ID de la tarea a eliminar desde la URL
    $codigo = $_GET['codigo'];

    // Actualiza la columna eliminada en lugar de eliminar la tarea
    $actualizarQuery = $bd->prepare("UPDATE tareas SET eliminada = 1 WHERE id = ?");
    $actualizarQuery->execute([$codigo]);

    // Redirecciona a la página principal con un mensaje de éxito
    header("Location: index.php?mensaje=eliminado");
    exit();
?>