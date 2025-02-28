<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\ItemModel;
use CodeIgniter\HTTP\ResponseInterface;

class ItemController extends BaseController
{
    public function registrarItem()
    {
        // enviamos las categorias para registrarlas
        $model = new CategoriaModel();
        $data['categorias'] = $model->findAll();

        return view('item/registrarItem', $data);
    }

    public function guardarItem()
    {
        $model = new ItemModel();

        $nombre = trim($this->request->getPost('categoriaNombre'));
        $categoriaId = intval($this->request->getPost('categoriaId'));
        $precioCosto = $this->request->getPost('precioCosto');
        $precioUnitario = $this->request->getPost('precioUnitario');

        $imagen = $this->request->getFile('imagenItem');

        // realizamos las validaciones
        if($nombre == "" || $categoriaId == 0 || $precioCosto == "" || !is_numeric($precioCosto) || $precioUnitario == "" || !is_numeric($precioUnitario)){
            return redirect()->to(base_url('registrarItems'))->with('error', 'Por favor llene todos los campos');
        }

        if (!$imagen->isValid()) {
            return redirect()->back()->with('error', 'Debes subir una imagen.');
        }
        
        $formatosImagen = ['image/png', 'image/jpg', 'image/jpeg'];

        if (!in_array($imagen->getMimeType(), $formatosImagen)) {
            return redirect()->back()->with('error', 'Solo se permiten imágenes PNG, JPG o JPEG.');
        }

        // creamos un nombre random para evitar que se sobreescriban archivos
        $nombreImagen = $imagen->getRandomName();
        $imagen->move(ROOTPATH . 'public/uploads', $nombreImagen);

        // registramos los otros datos en la tabla items
        $datosItem = [
            'name' => $nombre,
            'category_id' => $categoriaId,
            'cost_price' => $precioCosto,
            'unit_price'=> $precioUnitario,
            'pic_filename' => $nombreImagen,
        ];

        $model->insert($datosItem);

        return redirect()->to(base_url('/'))->with('success', 'Item guardado exitosamente.');
    }

    public function eliminarItem($id){

        // instanciamos el modelo
        $model = new ItemModel();

        $item = $model->find($id);
        if (!$item) {
            return redirect()->to(base_url('/'))->with('error', 'El item no existe.');
        }
        
        $imagenItem = ROOTPATH . 'public/uploads/' . $item['pic_filename'];

        // eliminamos la imagen de la carpeta uploads
        if (is_file($imagenItem)) {
            unlink($imagenItem);
        }

        $model->delete($id);

        return redirect()->to(base_url('/'))->with('success', 'Item eliminado correctamente.');
    }

    public function editarItem($id){

        $model = new ItemModel();
        $modelCategorias = new CategoriaModel();

        $data['items'] = $model->mostrarCategoria($id);
        $data['categorias'] = $modelCategorias->findAll();

        return view('item/editarItem', $data); 
    }

    public function actualizarItem(){

        $model = new ItemModel();

        $id = $this->request->getPost('itemId');
        $nombre = trim($this->request->getPost('categoriaNombre'));
        $categoriaId = intval($this->request->getPost('categoriaId'));
        $precioCosto = $this->request->getPost('precioCosto');
        $precioUnitario = $this->request->getPost('precioUnitario');

        $imagen = $this->request->getFile('imagenItem');

        // realizamos las validaciones
        if($nombre == "" || $categoriaId == 0 || $precioCosto == "" || !is_numeric($precioCosto) || $precioUnitario == "" || !is_numeric($precioUnitario)){
            return redirect()->to(base_url('editarItem/'.$id))->with('error', 'Por favor llene todos los campos');
        }

        $item = $model->find($id);
        if ($imagen->isValid()) {
            $imagenItem = ROOTPATH . 'public/uploads/' . $item['pic_filename'];
        
            if (is_file($imagenItem)) {
                unlink($imagenItem);
            }

            $formatosImagen = ['image/png', 'image/jpg', 'image/jpeg'];

            if (!in_array($imagen->getMimeType(), $formatosImagen)) {
                return redirect()->back()->with('error', 'Solo se permiten imágenes PNG, JPG o JPEG.');
            }
            // creamos un nombre random para evitar que se sobreescriban arhivos
            $nombreImagen = $imagen->getRandomName();
            $imagen->move(ROOTPATH . 'public/uploads', $nombreImagen);
            
        } else {
            $nombreImagen = $item['pic_filename'];
        }

        $data = [
            'name' => $nombre,
            'category_id' => $categoriaId,
            'cost_price' => $precioCosto,
            'unit_price' => $precioUnitario,
            'pic_filename' => $nombreImagen
        ];
        
        $model->update($id, $data);

        return redirect()->to(base_url('/'))->with('success', 'Item actualizado correctamente.');
    }
}
