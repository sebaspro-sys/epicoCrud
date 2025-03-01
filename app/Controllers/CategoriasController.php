<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\ItemModel;
use CodeIgniter\HTTP\ResponseInterface;

class CategoriasController extends BaseController
{

    protected $modelCategoria;
    protected $modelItem;
    
    public function __construct()
    {
        $this->modelCategoria = new CategoriaModel();
        $this->modelItem = new ItemModel();
    }

    public function consultarCategorias()
    {
        $data['categorias'] = $this->modelCategoria->findAll();
        return view('categorias/consultarCategorias', $data);
    }

    public function registrarCategorias(){
        return view('categorias/registrarCategorias');
    }

    public function guardarCategorias(){

        // usamos el trim para quitar espacios en la catgoria que se envie
        $nombre = trim($this->request->getPost('categoriaNombre'));
        // lo convertimos a minuscula para poder comparar mejor
        $nombreNormalizado = strtolower($nombre);

        // validamos que la categoria no este vacia
        if($nombre == ""){
            return redirect()->to(base_url('registrarCategorias'))->with('error', 'El campo de categoria es obligatorio.');
        }

        // Igualmente validamos en la base de datos con los que ya estan registrados con el nameNormalizado
        $existe = $this->modelCategoria->where('LOWER(TRIM(name))', $nombreNormalizado)->first();

        if ($existe) {
            return redirect()->to(base_url('registrarCategorias'))->with('error', 'La categoría ya existe.');
        }

        $data = ['name' => $nombre];
        $this->modelCategoria->insert($data);

        return redirect()->to(base_url('registrarCategorias'))->with('success', 'Categoría guardada correctamente.');
    }

    public function eliminarCategorias($id){

        $categoria = $this->modelCategoria->find($id);

        if (!$categoria) {
            return redirect()->to(base_url('consultarCategorias'))->with('error', 'La categoría no existe.');
        }
        
        // obtenemos todos los items con esa categoria
        $items = $this->modelItem->where('category_id', $id)->findAll();
        // se debe recorrer los items para eliminar las imagenes relacionadas tambien
        foreach ($items as $item) {
            $imagenRuta = ROOTPATH . 'public/uploads/' . $item['pic_filename'];
            if (is_file($imagenRuta)) {
                unlink($imagenRuta);
            }
        }

        $this->modelCategoria->delete($id);

        return redirect()->to(base_url('consultarCategorias'))->with('success', 'Categoría eliminada correctamente.');

    }

    public function editarCategorias($id){

        $data['categorias'] = $this->modelCategoria->where('id', $id)->first();

        return view('categorias/editarCategorias', $data); 
    }

    public function actualizarCategoria(){
        
        $id = $this->request->getPost('categoriaId');
        $nombre = trim($this->request->getPost('categoriaNombre'));
        // lo convertimos a minuscula para poder comparar mejor
        $nombreNormalizado = strtolower($nombre);

        // validamos que llegue el nombre de la categoria
        if($nombreNormalizado == ""){
            return redirect()->to(base_url('editarCategorias/' . $id))->with('error', 'El campo categoria es obligatorio');
        }

        // validamos que no se pueda editar la categoria con una que ya existe
        $existe = $this->modelCategoria
            ->where('LOWER(TRIM(name))', $nombreNormalizado)
            ->where('id !=', $id)
            ->first();

        if ($existe) {
            return redirect()->to(base_url('editarCategorias/' . $id))->with('error', 'Ya existe una categoría con este nombre.');
        } 

        $this->modelCategoria->update($id, ['name' => $nombre]);

        return redirect()->to(base_url('consultarCategorias'))->with('success', 'Categoría actualizada correctamente.');
    }
}
