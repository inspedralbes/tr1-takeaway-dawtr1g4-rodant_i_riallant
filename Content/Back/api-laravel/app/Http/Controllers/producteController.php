<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\producte;
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
            'preu' => 'required',
            'categoria' => 'required',
            'img' => 'required',
            'estoc' => 'required',
        ]);

        if ($validator->fails()) {
            return 'Error';
        } else {
            return Producte::create($request->all());
        }    
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
