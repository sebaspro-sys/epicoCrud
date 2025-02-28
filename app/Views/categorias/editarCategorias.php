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
                <h2>Actualizar categorias</h2>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <a href="<?= base_url('consultarCategorias') ?>" class="btn btn-primary">Consultar categorias</a>
                </div>
                <div class="container">
                    <form action="<?= base_url('actualizarCategoria') ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="categoriaNombre">Categoria</label>
                                <input type="text" name="categoriaNombre" value="<?= $categorias['name'] ?>" class="form-control">
                                <input type="hidden" name="categoriaId" value="<?= $categorias['id'] ?>">
                            </div>
                        </div>
                        <div class="row mt-2 mb-2">
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </div>
                    </form>
        
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger mt-1"><?= session()->getFlashdata('error'); ?></div>
                    <?php endif; ?>
        
                </div>
            </div>
        </div>
    </div>
</body>
</html>