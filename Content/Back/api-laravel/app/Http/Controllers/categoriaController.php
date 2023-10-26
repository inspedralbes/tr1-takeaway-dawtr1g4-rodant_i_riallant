<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use Illuminate\Http\Request;

class categoriaController extends Controller
{
    public function index(){
        return categoria::all();
    }

}
