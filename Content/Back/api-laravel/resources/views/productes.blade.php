@extends('app')

@section('content')

<h1>LListat productes</h1>

<link rel="stylesheet" href="css/index.css">

<div class="productes__llistat llistat">
    <div class="llistat__titols titols">
        <h2 class="titols__id">ID</h2>
        <h2 class="titols__email">Nom</h2>
        <h2 class="titols__estat">Estoc</h2>
    </div>
    <div class="llistat__comandes comandes">
        @foreach($productes as $producte)
            <div class="comandes__comanda comanda">
                <a href="{{ route('producte-form', ['id' => $producte->id]) }}">{{ $producte->id }}</a>
                <div class="producte__nom">{{ $producte->nom }}</div>
                <div class="producte__estoc">{{ $producte->estoc }}</div>
            </div>
        @endforeach
    </div>
</div>

@endsection