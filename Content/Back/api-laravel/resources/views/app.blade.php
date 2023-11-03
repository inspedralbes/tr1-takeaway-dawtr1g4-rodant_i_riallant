<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administració</title>
</head>
<body>
    <header>
        <nav class="header__navbar">
            <h1>RODANT I RIALLANT</h1>
            <div class="menu-icon">&#9776;</div>
            <ul class="nav-list" id="nav-list">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Acerca de</a></li>
                <li><a href="#">Servicios</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
            <button class="cart-button" @click="canviarPantalla('checkout')">
                <i class="fas fa-shopping-cart"></i> Carro
            </button>
        </nav>
    </header>
    <!-- header -->

    @yield('content')

    
</body>
</html>