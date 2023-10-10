    <?php include 'template/header.php'; ?>

    <?php
    include_once "model/conexion.php";
    $sentencia = $bd->query("select * from tareas where eliminada = 0");
    $tarea = $sentencia->fetchAll(PDO::FETCH_OBJ);
    //print_r($tarea);
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- inicio alerta -->
                <?php
                if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'falta') {
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Rellena todos los campos.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                }
                ?>


                <?php
                if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'registrado') {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Tarea registrada!</strong> Se agregaron los datos.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                }
                ?>

                <?php
                if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'error') {
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Vuelve a intentar.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                }
                ?>

                <?php
                if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'editado') {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Tarea editada!</strong> Los datos fueron actualizados.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                }
                ?>

                <?php
                if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'eliminado') {
                ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Tarea eliminada!</strong> Los datos fueron enviados a la papelera.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                }
                ?>

                <?php
                if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'restaurado') {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Tarea restaurada!</strong> Los datos fueron restaurados.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                }
                ?>
                <!-- fin alerta -->

                <!-- Botón para abrir el modal de registro de tareas -->
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Registrar tarea
                </button>
                
                <!-- Botón para abrir la página de papelera -->
                <a class="btn btn-secondary" href="papelera.php">Ir a la Papelera</a>

                <!-- Modal de Registro de Tareas-->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Ingresar Tarea</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="card">
                                    <form class="p-4" method="POST" action="registrar.php">
                                        <div class="mb-3">
                                            <label class="form-label">Titulo:</label>
                                            <input type="text" class="form-control" name="txtTitulo" autofocus required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Descripción:</label>
                                            <input type="text" class="form-control" name="txtDescripcion" autofocus required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Fecha de Creación: </label>
                                            <input type="date" class="form-control" name="txtFechaCreacion" autofocus required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Fecha de Vencimiento: </label>
                                            <input type="date" class="form-control" name="txtFechaVencimiento" autofocus required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Prioridad: </label>
                                            <select class="form-select" name="txtPrioridad" required>
                                                <option value="Alta">Alta</option>
                                                <option value="Media">Media</option>
                                                <option value="Baja">Baja</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Estado: </label>
                                            <select class="form-select" name="txtEstado" required>
                                                <option value="Pendiente">Pendiente</option>
                                                <option value="EnProgreso">En Progreso</option>
                                                <option value="Completada">Completada</option>
                                            </select>
                                        </div>

                                        <div class="d-grid">
                                            <input type="hidden" name="oculto" value="1">
                                            <input type="submit" class="btn btn-secondary" value="Registrar">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Registro de tareas -->
                <div class="card mt-4">
                    <div class="card-header">
                        Registro de tareas
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Titulo</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">F.Creacion</th>
                                    <th scope="col">F.Vencimiento</th>
                                    <th scope="col">Prioridad</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col" colspan="2">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($tarea as $dato) {
                                ?>
                                    <tr>
                                        <td scope="row"><?php echo $dato->id; ?></td>
                                        <td><?php echo $dato->titulo; ?></td>
                                        <td><?php echo $dato->descripcion; ?></td>
                                        <td><?php echo $dato->fecha_creacion; ?></td>
                                        <td><?php echo $dato->fecha_vencimiento; ?></td>
                                        <td><?php echo $dato->prioridad; ?></td>
                                        <td><?php echo $dato->estado; ?></td>

                                        <td><a class="btn btn-success btn-sm" href="editar.php?codigo=<?php echo $dato->id; ?>">Editar tarea</a></td>
                                        <td><a class="btn btn-danger btn-sm" onclick="return confirm('Estás seguro de eliminar?');" href="eliminar.php?codigo=<?php echo $dato->id; ?>">Eliminar tarea</a></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'template/footer.php'; ?>