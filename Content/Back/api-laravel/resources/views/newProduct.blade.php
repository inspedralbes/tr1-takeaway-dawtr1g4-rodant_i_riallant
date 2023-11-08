@extends('app')

@section('content')
<link rel="stylesheet" href="{{URL::asset('css/newProdForm.css') }}">


    <form action="{{ route('afegir') }}" method="POST" class="formulari">
      @csrf
      
      @if(session('success'))
        <h5 class="alert alert-success">
        {{ session('success') }}
        </h5>
      @endif
      @error('title')
      <h6 class="alert alert-danger">{{ $message }}</h6>
      @enderror
        <div class="nom formulari_nom">
          <h3>Nou producte</h3>
          <label for="nom">Nom</label>
          <input type="text" class="form-control" id="nom" name="nom">
        </div>
        <div class="descripcio formulari_descripcio">
          <label for="descripcio">Descripció</label>
          <textarea class="form-control" id="descripcio" name="descripcio" rows="3"></textarea>
        </div>
        <div class="estoc formulari_estoc">
          <label for="estoc">Estoc</label>
          <input type="number" class="form-control" id="estoc" name="estoc">
        </div>
        <div class="direccio formulari_direccio">
          <label for="img">Imatge</label>
          <input type="file" class="form-control" id="img" name="img" accept="image/">
        </div>
        <div class="categoria formulari_categoria">
          <label for="categoria">Categoria</label>
          <select class="form-control" id="categoria" name=categoria>
            <option value="1">Esports</option>
            <option value="2">Gimnàs</option>
            <option value="3">Salut</option>
          </select>
        </div> 
        <div class="preu formulari_preu">
          <label for="preu">Preu</label>
          <input type="number" step="0.01" class="form-control" id="preu" name="preu">
        </div>
        <button type="submit" class="btn formulari_btn">Afegir</button>
    </form>

@endsection