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
                <h2 class="mb-0">Registrar categorias</h2>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <a href="<?= base_url('consultarCategorias') ?>" class="btn btn-primary">Consultar categorias</a>
                </div>
                <div class="container">
                    <form action="<?= base_url('guardarCategorias') ?>" method="post">
                        <small>Los campos marcados con <code>*</code> son obligatorios</small>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="categoriaNombre">Categoria<code>*</code></label>
                                <input type="text" class="form-control" name="categoriaNombre">
                            </div>
                        </div>
                        <div class="row mt-2 mb-2">
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Guardar</button>   
                            </div>
                        </div>
                    </form>
                </div>
        
                <!-- agregamos los mensajes de error o exito -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger mt-1"><?= session()->getFlashdata('error'); ?></div>
                <?php endif; ?>
        
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success mt-2"><?= session()->getFlashdata('success'); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>