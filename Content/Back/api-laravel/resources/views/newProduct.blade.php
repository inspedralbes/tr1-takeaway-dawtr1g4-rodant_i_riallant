@extends('app')

@section('content')
    <form action="{{ route('afegir') }}" method="POST" enctype="multipart/form-data">

      @csrf
      
      @if(session('success'))
        <h5 class="alert alert-success">
        {{ session('success') }}
        </h5>
      @endif
      @error('title')
      <h6 class="alert alert-danger">{{ $message }}</h6>
      @enderror
        <div class="form-group">
          <label>Nou producte</label><br>
          <label for="nom">Nom</label>
          <input type="text" class="form-control" id="nom" name="nom" aria-describedby="emailHelp" placeholder="Nom del producte">
        </div>
        <div class="form-group">
          <label for="descripcio">Descripcio</label>
          <textarea class="form-control" id="descripcio" name="descripcio" rows="3"></textarea>
        </div>
        <div class="form-group">
          <label for="estoc">Estoc</label>
          <input type="number" class="form-control" id="estoc" name="estoc">
        </div>
        <div class="form-group">
          <label for="img">Direcció de la imatge</label>
          <input type="file" id="img" name="img" accept="image/">
        </div>
        <div class="form-group">
          <label for="categoria">Categoria</label>
          <select class="form-control" id="categoria" name=categoria>
            <option value="1">Esports</option>
            <option value="2">Gimnàs</option>
            <option value="3">Salut</option>
          </select>
        </div> 
        <div class="form-group">
          <label for="preu">Preu</label>
          <input type="number" step="0.01" class="form-control" id="preu" name="preu">
        </div>
        <button type="submit" class="btn btn-primary">Afegir</button>
    </form>

@endsection