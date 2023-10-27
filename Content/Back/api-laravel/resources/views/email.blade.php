<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Estimat/da client,</p>
    <p>Li escribim per a avisar-li que la seva comanda avança correctament</p>
    <br>
    <p>Actualment, la seva comanda
        @switch($comanda->estat)
            @case(0)
                es troba en procés de preparació
                @break
            @case(1)
                es troba en procés d'enviament
                @break
            @case(2)
                es troba en procés de repartiment
                @break
            @case(3)
                Ja ha arribat!!
                @break
        @endswitch
    </p>


</body>
</html>