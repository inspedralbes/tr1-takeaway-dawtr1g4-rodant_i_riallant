<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class categoriaController extends Controller
{
    public function index(){
        return Categoria::all();
    }

}
