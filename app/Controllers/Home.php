<?php

namespace App\Controllers;

use App\Models\ItemModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new ItemModel();
        $data['items'] = $model->mostrarCategoria(0);
        return view('home', $data);
    }
}
