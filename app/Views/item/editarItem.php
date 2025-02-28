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
                <h2>Actualizar Items</h2>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <a href="<?= base_url('/') ?>" class="btn btn-primary">Consultar items</a>
                </div>
                <div class="container">
                    <form action="<?= base_url('actualizarItem') ?>" method="post" enctype="multipart/form-data">
                        <small>Los campos marcados con <code>*</code> son obligatorios</small>
                        <div class="row mt-2">
                            <div class="col-md-3">
                                <label for="categoriaNombre">Nombre<code>*</code></label>
                                <input type="text" value="<?= $items['name'] ?>" class="form-control" name="categoriaNombre">
                                <input type="hidden" name="itemId" value="<?= $items['id'] ?>">
                            </div>
                            <div class="col-md-3">
                                <label for="categoriaNombre">Categoria<code>*</code></label>
                                <select class="form-select" name="categoriaId">
                                    <option value="0">Seleccione</option>
                                    <?php foreach($categorias as $categoria): 
                                        $select = $categoria['id'] == $items['category_id'] ? "selected" : "";
                                        ?>
                                        <option value="<?= $categoria['id'] ?>" <?= $select ?> ><?= $categoria['name'] ?></option>
                                    <?php endforeach ?>    
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="precioCosto">Precio de costo<code>*</code></label>
                                <input type="number" value="<?= $items['cost_price'] ?>" step="0.01" class="form-control" name="precioCosto">
                            </div>
                            <div class="col-md-3">
                                <label for="precioUnitario">Precio unitario<code>*</code></label>
                                <input type="number" value="<?= $items['unit_price'] ?>" class="form-control" name="precioUnitario">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="imagenItem">Imagen</label>
                                <input class="form-control" type="file" name="imagenItem">
                            </div>
                            <div class="col-md-3 mt-3">
                                <a href="<?= base_url('uploads/' . $items['pic_filename']) ?>" target="_blank" class="btn btn-success mt-2">Ver imagen actual</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mt-3">
                                <button type="submit" class="btn btn-primary">Guardar</button>
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