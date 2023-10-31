<?php

namespace App\Http\Controllers;

use App\Mail\Notificacio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\Comanda;

class comandaController extends Controller
{

    public function index()
    {
        $comandes = Comanda::where('estat', '!=', 4)->get();
        return view('index', ['comandes' => $comandes]);
    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'productes' => 'required',
            'preuTotal' => 'required',
        ]);

        if ($validator->fails()) {
            return 'Error';
        } else {

            $c = Comanda::create($request->all());
            $c->estat = 0;
            return $c;

        }
    }

    public function show($id)
    {
        return Comanda::find($id);
    }

    public function buscar($id)
    {

        $comanda = Comanda::find($id);

        $productes = json_decode($comanda->productes);

        return view('comanda', ['comanda' => $comanda, 'productes' => $productes]);
        // return view('comanda', compact('comanda', 'productes') );
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'estat' => 'required',
        ]);
        if ($validator->fails()) {
            return `Error, el camp s'ha d'emplenar`;
        } else {
            $comanda = Comanda::find($id);
            $redirigir = false;
            switch ($comanda->estat) {
                case 0:
                    $comanda->momentPreparacio = now();
                    break;
                case 1:
                    $comanda->momentEnviament = now();
                    break;
                case 2:
                    $comanda->momentRepartiment = now();
                    break;
                case 3:
                    $comanda->momentRebuda = now();
                    break;
            }
            if ($request->estat == '1') {
                $notification = new Notificacio($comanda);

                Mail::to($comanda->email)->send($notification);
            }

            $comanda->estat += intval($request->estat);
            if ($comanda->estat == 4) {
                $redirigir = true;
            }

            $comanda->save();
            if ($redirigir) {
                return redirect()->route('comandes');
            } else {
                return redirect()->route('comanda-modif', ['id' => $comanda->id])->with('success', 'Modificat correctament');
            }
        }

    }


}
