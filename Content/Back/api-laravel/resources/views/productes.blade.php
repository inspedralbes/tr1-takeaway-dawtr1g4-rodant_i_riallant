@extends(app)

@section('content')
<ul>
        @foreach($productos as $producto)
            <li>
                <strong>{{ $producto->nombre }}</strong>
                <p>{{ $producto->descripcion }}</p>
                <p>Precio: ${{ $producto->precio }}</p>
            </li>
        @endforeach
    </ul>

@endsection