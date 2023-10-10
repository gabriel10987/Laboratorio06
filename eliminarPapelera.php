<?php 
    if(!isset($_GET['codigo'])){
        header('Location: papelera.php?mensaje=error');
        exit();
    }

    include 'model/conexion.php';
    $codigo = $_GET['codigo'];
    
    $sentencia = $bd->prepare("DELETE FROM tareas where id = ?;");
    $resultado = $sentencia->execute([$codigo]);

    if ($resultado === TRUE){
        header('Location: papelera.php?mensaje=eliminadoPapelera');
    } else {
        header('Location: papelera.php?mensaje=error');
    }
?>
