@extends('app')

@section('content')

<link rel="stylesheet" href="editarProducte.css">
<!-- Plantilla de modificar l'informacio d'un producte -->
<h1>Modificar un producte</h1>

@if(session('error'))

    <div class="error">{{session('error')}}</div>

@endif
    <!-- Formulari de la modificacio -->
    <form action="{{ route('producte-editar', ['id'=> $producte->id]) }}" method="post" class="form">
        @csrf
        @method("PATCH")

        <div class="form__nom">
            <label for="nom">Nom: </label>
            <input type="text" name="nom" id="nom" value="{{$producte->nom}}" required>
        </div>
        
        <div class="form__desc">
            <label for="descripcio">Descripció:</label>
            <textarea name="descripcio" id="descripcio" rows="4" cols="50" required>{{$producte->descripcio}}</textarea>
        </div>
        
        <div class="form__nom">
            <label for="estoc">Estoc Disponible:</label>
            <input type="number" name="estoc" id="estoc" required value="{{$producte->estoc}}">
        </div>
        
        <div class="form__nom">
            <label for="preu">Preu:</label>
            <input type="number" name="preu" id="preu" required value="{{$producte->preu}}">
        </div>
        
        <div class="form__nom">
            <label>Categoria:</label>
            <select name="categoria" id="categoria" required>
            @foreach($categories as $categoria)

                <option value="{{ $categoria->id }}">{{ $categoria->nom }}</option>

            @endforeach
                
            </select>
        </div>
        

        <input type="submit" value="Confirmar">
    </form>


    @endsection