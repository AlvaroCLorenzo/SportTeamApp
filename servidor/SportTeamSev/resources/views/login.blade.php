<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- bootstrap link --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    {{-- CSS LINKS --}}
    {{-- generales --}}
    <link rel="stylesheet" href="../resources/css/comunes/basico.css">
    <link rel="stylesheet" href="../resources/css/comunes/menuBasico.css">
    <link rel="stylesheet" href="../resources/css/comunes/colores/fondos.css">
    <link rel="stylesheet" href="../resources/css/comunes/colores/textos.css">
    <link rel="stylesheet" href="../resources/css/comunes/colores/textosLinks.css">
    {{-- propios --}}
    <title>SportTeam</title>
</head>

<body>
    <div>@include('componentes/menuBasico')</div>

    <section class="w-100 mx-auto row align-items-center bgVerde1">
        <div class="container-fluid my-auto textoBlanco bg-Verde5">
            <div class="">
                <form action="">
                    <input type="input">
                </form>
            </div>
        </div>
    </section>

    <div>@include('componentes/footer')</div>
</body>
</html>
