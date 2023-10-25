@section('content')
    <form action="{{ route('afegir-form') }}" method="post">
        <div class="form-group">
        <label>Nou producte</label><br>
        <label for="inputName">Nom</label>
        <input type="text" class="form-control" id="inputName" aria-describedby="emailHelp" placeholder="Nom del producte">
        </div>
        <div class="form-group">
          <label for="inputDesc">Descripcio</label>
          <textarea class="form-control" id="inputDesc" rows="3"></textarea>
        </div>
        <div class="form-group">
          <label for="inputStock">Estoc</label>
          <input type="number" class="form-control" id="inputStock">
        </div>
        <div class="form-group">
          <label for="inputPath">Direcció de la imatge</label>
          <input type="text" class="form-control" id="inputPath" placeholder="Ex. './img/nomFitxer.jpg'">
        </div>
        <div class="form-group">
          <label for="inputCateg">Categoria</label>
          <select class="form-control" id="inputCateg">
            <option>Esports</option>
            <option>Gimnàs</option>
            <option>Salut</option>
          </select>
        </div> 
        <div class="form-group">
          <label for="inputPreu">Preu</label>
          <input type="number" step="0.01" class="form-control" id="inputPreu">
        </div>
        <button type="submit" class="btn btn-primary">Afegir</button>
    </form>

@endsection