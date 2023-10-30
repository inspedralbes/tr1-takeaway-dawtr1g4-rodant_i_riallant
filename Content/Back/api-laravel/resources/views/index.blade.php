@extends('app')

@section('content')

<link rel="stylesheet" href="index.css">

<h1>LListat comandes obertes</h1>

<div class="llistat">
    <div class="llistat__titols titols">
        <h2 class="titols__id">ID</h2>
        <h2 class="titols__email">Email</h2>
        <h2 class="titols__estat">Estat</h2>
    </div>
    <div class="llistat__comandes comandes">
        @foreach ($comandes as $comanda)
            <div class="comandes__comanda comanda">
                <a href="{{ route('comanda-modif', ['id' => $comanda->id]) }}" class="" style="text-decoration: none; color: black;">{{ $comanda->id }}</a>
                <div class="">{{ $comanda->email }}</div>
                <div class="">{{ $comanda->estat }}</div>
            </div>
        @endforeach
    </div>
    
</div>



@endsection