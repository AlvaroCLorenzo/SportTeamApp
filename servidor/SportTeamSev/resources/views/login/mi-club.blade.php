<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('componentes/head/headConstantes', ['logueado'=>true, 'mostrarMenuSecciones'=>true])

    <title>Mi club - Sport Team</title>
</head>

<body>
    @include('componentes/menus/menuLogueado')

    <section class="bgVerde1">
        <div class="container-lg py-5">
            <div class="row align-items-center py-5 my-5">
                {{-- Escudo --}}
                <div class="col-4">
                    <img src="{{ url('/img/iconos/clubIcon.png') }}" alt="" class="w-100">
                </div>

                {{-- Contenedor verde --}}
                <div class="col-8">
                    <div class="contenedor bgVerde5 textoBlanco">
                        <div class="row w-100 m-0 my-5">
                            <div>
                                <h1 class="text-center">F.C. Barcelona</h1>
                            </div>
                        </div>
                        <div class="row align-items-center my-5">
                            <div class="col-sm-6">
                                <h4 class="text-center">La liga</h4>
                            </div>
                            <div class="col-sm-6">
                                <h4 class="text-center">1ª División</h4>
                            </div>
                        </div>
                        <div class="row align-items-center my-5">
                            <button class="botonVerde">Cambio contraseña</button>
                        </div>
                        <form action="">
                            <input type="file">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    @include('componentes/footer')
    <script src={{ asset('js/app.js') }}></script>
</body>

</html>
