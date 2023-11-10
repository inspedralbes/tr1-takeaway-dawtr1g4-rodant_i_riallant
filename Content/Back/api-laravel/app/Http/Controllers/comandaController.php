<?php

namespace App\Http\Controllers;

use App\Mail\Notificacio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Comanda;
use App\Models\Producte;

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

            DB::beginTransaction();

            try {
                $comprovarEstoc = json_decode($request->productes);
                for ($i = 0; $i < count($comprovarEstoc); $i++) {
                    if ($comprovarEstoc[$i]->counter < 0) {

                        DB::rollBack();

                        return response()->json(['message' => 'Number of items is negative'], 400);
                    }
                    $producte = Producte::find($comprovarEstoc[$i]->id);
                    $producte->estoc -= $comprovarEstoc[$i]->counter;

                    $producte->save();

                }
                DB::commit();


                $c = Comanda::create($request->all());
                $c->estat = 0;
                return $c;

            } catch (\Exception $e) {

                DB::rollBack();

                return response()->json(['message' => 'An error occurred', $e], 500);

            }
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

    public function modificar($id, Request $request)
    {
        $comanda = Comanda::find($id);

        if ($comanda->estat != 0) {
            return response()->json(['message' => `La compra ja s'està processant`]);
        } else {

            DB::beginTransaction();

            try {
                $restarEstoc = json_decode($request->productes);
                for ($i = 0; $i < count($restarEstoc); $i++) {
                    if ($restarEstoc[$i]->counter < 0) {

                        DB::rollBack();

                        return response()->json(['message' => 'Number of items is negative'], 400);
                    }
                    $producte = Producte::find($restarEstoc[$i]->id);
                    $producte->estoc -= $restarEstoc[$i]->counter;

                    $producte->save();

                }
                $sumarEstoc = json_decode($comanda->productes);
                for ($i = 0; $i < count($sumarEstoc); $i++) {

                    $producte = Producte::find($sumarEstoc[$i]->id);
                    $producte->estoc += $sumarEstoc[$i]->counter;

                    $producte->save();

                }
                DB::commit();

                $comanda->productes = $request->productes;
                $comanda->email = $request->email;
                $comanda->preuTotal = $request->preuTotal;

                $comanda->save();

            } catch (\Exception $e) {

                DB::rollBack();

                return response()->json(['message' => 'An error occurred' . $e,], 500);

            }

            return $comanda;
        }
    }


}
