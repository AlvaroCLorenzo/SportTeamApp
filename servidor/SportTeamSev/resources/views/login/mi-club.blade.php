<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('componentes/head/headConstantes', ['logueado'=>true, 'mostrarMenuSecciones'=>true])

    <link rel="stylesheet" href="css/comunes/formularios.css">

    <title>Mi club - Sport Team</title>
</head>

<body>
    @include('componentes/menus/menuLogueado')

    <section class="bgVerde1">
        <div class="container-lg py-5">
            <div class="row align-items-center py-5 my-5">
                {{-- Escudo --}}
                <div class="col-lg-4">

                    <?php
                        if($club->pathImagen == null){
                            $club->pathImagen = 'userBig.png';
                        }
                    ?>
                    <img src="{{ url('/storage/'.$club->pathImagen) }}" alt="" class="w-100">
                </div>

                {{-- Contenedor verde --}}
                <div class="col-lg-8">
                    <div class="contenedor bgVerde5 textoBlanco">
                        <div class="row w-100 m-0 my-5">
                            <div>
                                <h1 class="text-center">{{$club->nombre}}</h1>
                            </div>
                        </div>
                        <div class="row align-items-center my-5">
                            <div class="col-sm-6">
                                <h4 class="text-center">{{$club->deporte}}</h4>
                            </div>
                            <div class="col-sm-6">
                                <h4 class="text-center">@if($club->categoria != null) {{ $club->categoria}} @else {{"sin categoría"}} @endif</h4>
                            </div>
                        </div>
                        <div class="row align-items-center my-5">
                            <button class="botonVerde">Cambio contraseña</button>
                        </div>

                        <div class="row w-100 m-0 my-5">
                            <form action="{{url('/cambiar-imagen')}}" method="post" enctype="multipart/form-data" class="text-center">
                                <input type="file" name="avatar" accept=".png">
                                <input type="submit" name="Guardar" value="Guardar">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('componentes/footer')
    <script src={{ asset('js/app.js') }}></script>
</body>

</html>
