@extends('app')

@section('content')

<div>Comanda #{{ $comanda->id }}</div>

<div>Email del client: {{ $comanda->email }}</div>
<div>
    <div>Productes:</div>
    <ol>
        @foreach ($productes as $producte)
            <li>
                <span>{{ $producte->id }}</span>
                <span>{{ $producte->nom }}</span>
                <span>{{ $producte->counter }}</span>
            </li>
        @endforeach
    </ol>    
</div>



<div>Comanda creada a: {{ $comanda->created_at }}</div>

@if($comanda->estat > 0)
    <div>Comanda començada a preparar a: {{ $comanda->momentPreparacio }}</div>
    @if($comanda->estat > 1)
        <div>Comanda preparada a: {{ $comanda->momentEnviament }}</div>
        @if($comanda->estat > 2)
            <div>Comanda enviada a: {{ $comanda->momentRepartiment }}</div>
            @if($comanda->estat > 3)
                <div>Comanda rebuda a: {{ $comanda->momentRebuda }}</div>
            @endif
        @endif
    @endif

@endif

<div>Estat: {{ $comanda->estat }}</div>

<form id="myForm" action="{{ route('comanda-editar-estat', ['id' => $comanda->id]) }}" method="post">
    @method('PATCH')
    @csrf

    @if($comanda->estat != 0)
    <!-- Content to be displayed when the condition is true -->
    <label>
        <input type="radio" name="estat" value="-1"> Canviar a anterior estat
    </label>
    @endif
    

    <label>
        <input type="radio" name="estat" value="1"> Canviar a següent estat
    </label>

    <button type="submit">Submit</button>
</form>

<script>
    document.getElementById('myForm').addEventListener('submit', function (event) {
        // Get all radio inputs with the name "estat"
        const radios = document.querySelectorAll('input[name="estat"]');
        let isOneSelected = false;

        // Check if at least one radio button is selected
        for (const radio of radios) {
            if (radio.checked) {
                isOneSelected = true;
                break;
            }
        }

        if (!isOneSelected) {
            alert('Please select at least one option.');
            event.preventDefault(); // Prevent form submission
        }
    });
</script>


@endsection