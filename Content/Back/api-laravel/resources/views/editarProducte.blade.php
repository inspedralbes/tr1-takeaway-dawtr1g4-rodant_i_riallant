@extends('app')

@section('content')

<link rel="stylesheet" href="editarProducte.css">

<h1>Modificar un producte</h1>
    <form action="{{ route('producte-editar', ['id'=> $producte->id]) }}" method="post" class="form">
        @csrf
        @method("PATCH")

        <div class="form__nom">
            <label for="nombre">Nom: </label>
            <input type="text" name="nombre" id="nombre" value="{{$producte->nom}}" required>
        </div>
        
        <div class="form__desc">
            <label for="descripcion">Descripció:</label>
            <textarea name="descripcion" id="descripcion" rows="4" cols="50" required>{{$producte->descripcio}}</textarea>
        </div>
        
        <div class="form__nom">
            <label for="stock">Estoc Disponible:</label>
            <input type="number" name="stock" id="stock" required value="{{$producte->estoc}}">
        </div>
        
        <div class="form__nom">
            <label for="precio">Preu:</label>
            <input type="number" name="precio" id="precio" required value="{{$producte->preu}}">
        </div>
        
        <div class="form__nom">
            <label for="categoria">Categoria:</label>
            <select name="categoria" id="categoria" required>
            @foreach($categories as $categoria)

                <option value="{{ $categoria->id }}">{{ $categoria->nom }}</option>

            @endforeach
                
            </select>
        </div>
        

        <input type="submit" value="Enviar">
    </form>


    @endsection