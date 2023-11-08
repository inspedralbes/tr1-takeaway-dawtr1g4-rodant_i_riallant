<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producte;
use Illuminate\Support\Facades\Validator;

class producteController extends Controller
{
    public function index(){
        return Producte::all();
    }

    public function store(Request $request){
    $validator = Validator::make($request->all(), [
        'nom' => 'required',
        'descripcio' => 'required',
        'preu' => 'required|numeric', 
        'categoria' => 'required',
        'img' => 'required|image|mimes:jpeg,png,jpg,gif',
        'estoc' => 'required|integer', 
    ]);



    $producte = new Producte;
    $producte->nom = $request->input('nom');
    $producte->descripcio = $request->input('descripcio');
    $producte->preu = $request->input('preu');
    $producte->categoria = $request->input('categoria');
    $producte->estoc = $request->input('estoc');
    if ($request->hasFile('img')) {
        $img = $request->file('img');
        $originalFileName = $img->getClientOriginalName();
        
        // Define la ruta donde deseas almacenar la imagen y utiliza el nombre original del archivo
        $imgPath = 'public/storage/img/' . $originalFileName;
        
        // Mueve la imagen a la ubicación deseada con el nombre original
        $img->move(public_path('../public/storage/img/'), $originalFileName);
    
        // Asigna la ruta completa al atributo 'img' del modelo
        $producte->img = $imgPath;
    }

    $producte->save();
    
    return view('newProduct')->with('success', 'Producto añadido correctamente');
}

    

    public function show($id){
        return Producte::find($id);
    }

    public function update(Request $request, $id){

        $producte = Producte::find($id);
        $producte->update($request->all());

        return $producte;
    }

    public function destroy($id){
        return Producte::destroy($id);
    }

    public function search($name){
        return Producte::where('name', 'like', '%'.$name.'%')->get();
    }
}
