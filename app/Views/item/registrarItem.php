<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Epico Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header bg-dark text-white text-center">
                <h2>Registrar Items</h2>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <a href="<?= base_url('/') ?>" class="btn btn-primary">Consultar items</a>
                    <a href="<?= base_url('registrarCategorias') ?>" class="btn btn-primary">Registrar categorias</a>
                </div>
                <div class="container">
                    <form action="<?= base_url('guardarItem') ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <small>Los campos marcados con <code>*</code> son obligatorios</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <small>Nota: Recuerde tener categorias registradas para registrar items</small>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-3">
                                <label for="categoriaNombre">Nombre<code>*</code></label>
                                <input type="text" class="form-control" name="categoriaNombre">
                            </div>
                            <div class="col-md-3">
                                <label for="categoriaNombre">Categoria<code>*</code></label>
                                <select class="form-select" name="categoriaId">
                                    <option value="0">Seleccione</option>
                                    <?php foreach($categorias as $categoria): ?>
                                        <option value="<?= $categoria['id'] ?>"><?= $categoria['name'] ?></option>
                                    <?php endforeach ?>    
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="precioCosto">Precio de costo<code>*</code></label>
                                <input type="number" step="0.01" class="form-control" name="precioCosto">
                            </div>
                            <div class="col-md-3">
                                <label for="precioUnitario">Precio unitario<code>*</code></label>
                                <input type="number" class="form-control" name="precioUnitario">
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label for="imagenItem">Imagen<code>*</code></label>
                                    <input class="form-control" type="file" name="imagenItem">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mt-3">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger mt-2">
                            <?= session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
