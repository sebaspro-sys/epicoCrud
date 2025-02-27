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
                <h2>Lista de Items</h2>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <a href="<?= base_url('consultarCategorias') ?>" class="btn btn-primary">Consultar Categorías</a>
                    <a href="<?= base_url('registrarItems') ?>" class="btn btn-primary">Registrar Items</a>
                </div>
                <table id="tableItems" class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Precio Costo</th>
                            <th>Precio Unitario</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($items as $item): ?>
                            <tr>
                                <td><?= $item['id'] ?></td>
                                <td><?= $item['name'] ?></td>
                                <td><?= $item['category_name'] ?></td>
                                <td>$<?= number_format($item['cost_price']) ?></td>
                                <td>$<?= number_format($item['unit_price']) ?></td>
                                <td>
                                    <a href="<?= base_url('uploads/' . $item['pic_filename']) ?>" target="_blank">Ver imagen</a>
                                </td>
                                <td>
                                    <a href="<?= base_url('editarItem/'.$item['id']) ?>"class="btn btn-warning btn-sm">Editar</a>
                                    <a onclick="return confirm('¿Estás seguro de eliminar este item?')" href="<?= base_url('eliminarItem/'. $item['id']) ?>"class="btn btn-danger btn-sm">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                
        
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success mt-2"><?= session()->getFlashdata('success'); ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger mt-2"><?= session()->getFlashdata('error'); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tableItems').DataTable({
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