<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Epico Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header bg-dark text-white text-center">
                <h2 class="mb-0">Lista de Categorías</h2>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <a href="<?= base_url('registrarCategorias') ?>" class="btn btn-primary">Registrar Categorías</a>
                    <a href="<?= base_url('/') ?>" class="btn btn-primary">Consultar Ítems</a>
                </div>
                <table id="tablaCategorias" class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($categorias as $categoria): ?>
                            <tr>
                                <td><?= $categoria['id'] ?></td>
                                <td><?= $categoria['name'] ?></td>
                                <td>
                                    <a href="<?= base_url('editarCategorias/' . $categoria['id']) ?>"  
                                        class="btn btn-warning btn-sm">
                                            Editar
                                    </a>
                                    <a href="<?= base_url('eliminarCategorias/' . $categoria['id']) ?>" 
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Si elimina la categoría se eliminan los ítems registrados con ella, ¿Estás seguro de eliminar esta categoría?');">
                                            Eliminar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success mt-3"><?= session()->getFlashdata('success'); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tablaCategorias').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
                },
                "pageLength": 10, 
                "ordering": true,
                "searching": true,
                "lengthChange": false
            });
        });
    </script>
</body>
</html>
