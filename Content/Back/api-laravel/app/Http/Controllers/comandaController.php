<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Comanda;

class comandaController extends Controller
{
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'productes' => 'required',
            'preuTotal' => 'required',
        ]);

        if ($validator->fails()) {
            return 'Error';
        } else {
            return Comanda::create($request->all());
        }    
    }

    public function show($id){
        return Comanda::find($id);
    }
}
