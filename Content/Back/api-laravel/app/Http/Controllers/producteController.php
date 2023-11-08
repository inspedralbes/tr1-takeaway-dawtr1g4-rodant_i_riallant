<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Producte;
use Illuminate\Support\Facades\Validator;

class producteController extends Controller
{
    public function index(){
        return Producte::all();
    }

    public function indexView(){
        $productes = Producte::all();

        return view("productes")->with("productes",$productes);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'descripcio' => 'required',
            'preu' => 'required',
            'categoria' => 'required',
            'img' => 'required',
            'estoc' => 'required',
        ]);

        if ($validator->fails()) {
            return view('newProduct')->with('error', 'Error al formulari');
        } else {
            $producte = new Producte;

            $producte-> nom = $request->nom;
            $producte-> descripcio = $request->descripcio;
            $producte-> preu = $request->preu;
            $producte-> categoria = $request->categoria;
            $producte-> img = $request->img;
            $producte-> estoc = $request->estoc;

            $producte->save();
            return view('newProduct')->with('success', 'Producto añadido correctamente');

            //->with('success', 'Producto añadido correctamente')
        }    
    }

    public function show($id){
        return Producte::find($id);
    }

    public function showView($id){
        $producte = Producte::find($id);
        $categories = Categoria::all();
        return view('editarProducte')->with(['producte' => $producte, 'categories'=> $categories]);
    }

    public function update(Request $request, $id){

        $producte = Producte::find($id);
        $producte->update($request->all());

        return $producte;
    }

    public function editar(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'descripcio' => 'required',
            'preu' => 'required',
            'categoria' => 'required',
            'estoc' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('producte-form', ['id'=> $id])->with('error', 'Error al formulari');
        } else {
            $producte = Producte::find($id);

            $producte-> nom = $request->nom;
            $producte-> descripcio = $request->descripcio;
            $producte-> preu = $request->preu;
            $producte-> categoria = $request->categoria;
            $producte-> estoc = $request->estoc;

            $producte->save();


            return redirect()->route('llistat-prod')->with('success', 'Producte modificat correctament');

            //->with('success', 'Producto añadido correctamente')
        }
    }

    public function destroy($id){
        return Producte::destroy($id);
    }

    public function search($name){
        return Producte::where('name', 'like', '%'.$name.'%')->get();
    }
}
