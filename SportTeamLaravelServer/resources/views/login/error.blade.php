<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- bootstrap link --}}
    <link href={{ asset('css/app.css') }} rel="stylesheet">

    <link rel="stylesheet" href="css/error.css">
    <link rel="stylesheet" href="css/comunes/colores/fondos.css">
    <link rel="stylesheet" href="css/comunes/colores/textos.css">

    <title>ERROR - Sport Team</title>
</head>

<body>
    <section class="bgVerde1">
        <div class="container-lg w-50 mx-auto px-5">
            <div class="row align-items-center textoVerde3">
                <div class="col-12">
                    <img src="{{url('img/iconos/warning.png')}}" alt="">
                    <h1>ERROR</h1>
                </div>
                <div class="col-12">
                    <h3>No toques donde no hay que tocar</h3>
                </div>
            </div>
        </div>
    </section>
    <script src={{ asset('js/app.js') }}></script>
</body>

</html>
