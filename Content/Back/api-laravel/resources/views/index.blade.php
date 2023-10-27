@extends('app')

@section('content')
<div>
    <div>
        <div>ID</div>
        <div>email</div>
        <div>estat</div>
    </div>
    @foreach ($comandes as $comanda)
        <div class="row">
            <a href="{{ route('comanda-modif', ['id' => $comanda->id]) }}" class="" style="text-decoration: none; color: black;">{{ $comanda->id }}</a>
            <div class="">{{ $comanda->email }}</div>
            <div class="">{{ $comanda->estat }}</div>
        </div>
    @endforeach
</div>



@endsection