@extends('app')

@section('content')
<link rel="stylesheet" href="comanda.css">

<div class="comanda"> 
    <div class="comanda__id">Comanda #{{ $comanda->id }}</div>

    <div class="comanda__email">Email del client: {{ $comanda->email }}</div>

    <!-- Mostra el total de productes amb el preu total i per producte -->
    <div class="comanda__productes productes">
        <h3 class="productes__titol">Productes:</h3>

        <div class="productes__total">Total: {{ $comanda->preuTotal }}€</div>
        <ol class="productes__llistat llistat"> 
                <li class="llistat__titols titols">
                    <span class="titols__id">ID</span>
                    <span class="titols__nom">NOM</span>
                    <span class="titols__quantitat">QUANT.</span>
                </li>
            @foreach ($productes as $producte) 
                <li class="llistat__producte producte">
                    <span class="producte__id">{{ $producte->id }}</span>
                    <span class="producte__nom">{{ $producte->nom }}</span>
                    <span class="producte__quantitat">{{ $producte->counter }}</span>
                </li>
            @endforeach
        </ol>
    </div>

    <!-- Son els diferents estats que por tindre una comanda -->
    <div class="comanda__estat estat">Estat: 
        <span class="estat__dreta">
            @switch($comanda->estat)
                @case(0)
                    Registrat
                    @break
                @case(1)
                    En preparacio
                    @break
                @case(2)
                    Enviant-se
                    @break
                @case(3)
                    Repartint-se
                    @break
                @case(4)
                    Arribat
                    @break
            @endswitch
        </span>
    </div>
    <!-- Canvia el missatge de l'estat de la comanda -->
    <div class="comanda__modificacions modificacions">
        <div class="modificacions__modificacio">Comanda creada a: <span class="modificacio__dreta">{{ $comanda->created_at }}</span></div>

        @if($comanda->estat > 0)
            <div class="modificacions__modificacio modificacio">Comanda començada a preparar a: <span class="modificacio__dreta">{{ $comanda->momentPreparacio }}</span></div>
            @if($comanda->estat > 1)
                <div class="modificacions__modificacio modificacio">Comanda preparada a: <span class="modificacio__dreta">{{ $comanda->momentEnviament }}</span></div>
                @if($comanda->estat > 2)
                    <div class="modificacions__modificacio modificacio">Comanda enviada a: <span class="modificacio__dreta">{{ $comanda->momentRepartiment }}</span></div>
                    @if($comanda->estat > 3)
                        <div class="modificacions__modificacio modificacio">Comanda rebuda a: <span class="modificacio__dreta">{{ $comanda->momentRebuda }}</span></div>
                    @endif
                @endif
            @endif
        @endif
    </div>
    
    
    <!-- Controlador dels estats de la comanda -->
    <form class="comanda__formulari formulari" id="myForm" action="{{ route('comanda-editar-estat', ['id'=> $comanda->id]) }}" method="post">
        @method('PATCH') 
        @csrf 
        @if($comanda->estat != 0)

            <label class="formulari__anterior">
                <input type="radio" name="estat" value="-1" class="anterior__input">Anterior estat
            </label>

        @endif


        <label class="formulari__posterior">
            <input type="radio" name="estat" value="1" class="posterior__input">Següent estat
        </label>

        <button type="submit" class="formulari__submit">Submit</button>
    </form>
</div>

<!-- Controlador JavaScript del formulari de canviar estat -->
<script>

    const radios = document.querySelectorAll('input[name="estat"]');

    document.getElementById('myForm').addEventListener('click', function (event) {
        for (const radio of radios) {
            if (radio.checked) {
                    radio.parentElement.classList.add("formulari__input__active");
                } else {
                    radio.parentElement.classList.remove("formulari__input__active");
            }
        }
    });

    document.getElementById('myForm').addEventListener('submit', function (event) {
        // Get all radio inputs with the name "estat"
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