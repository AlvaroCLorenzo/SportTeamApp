<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/forge/0.8.2/forge.all.min.js"></script>
    <script src="{{asset('/js/codificadorContra.js')}}"></script>

    <script>

        window.onload = function(){

            var boton = document.getElementById('btnlogin');

            boton.onclick = enviar;
        }

        function enviar(){

            var inContra = document.getElementById('inContra');

            var formulario = document.getElementById('formularioLogin');

            let contraSincodificar = inContra.value;

            let contraCodificada = generateHash(contraSincodificar);

            console.log(contraCodificada);

            inContra.value = contraCodificada;

            formulario.submit();

        }
  
    </script>

    @include('componentes/head/headConstantes')
    
    {{-- propios --}}
    <link rel="stylesheet" href="css/comunes/formularios.css">

    <title>Login - Sport Team</title>
</head>

<body>
    @include('componentes/menus/menuDeslogueado', ['btnDesplegable' => true, 'btnRegistro' => true, 'btnLogin' => false])

    <section class="w-100 mx-auto row align-items-center bgVerde1">
        <div class="container-fluid my-auto textoBlanco ">
            <div class="container-sm contenedor formulario bgBlanco">
                <h1 class="textoVerde3 centrado">Login</h1>
                
                <form action="{{url('/validacion-login')}}" method="post" id="formularioLogin">
                    <div class="grupo">
                        <input class="textoVerde1" type="text" name="nombre" required>
                        <label class="textoVerde1 textfield" for="">Club</label>
                    </div>
                    <div class="grupo">
                        <input id="inContra" class="textoVerde1" type="password" name="contra" required>
                        <label class="textoVerde1 textfield" for="">Contraseña</label>
                    </div>
                    
                </form>

                <div class="centrado">
                    <button class="submit botonVerde" id="btnlogin">Login</button>
                </div>
            </div>
        </div>
    </section>
    
    @include('componentes/footer')
    <script src={{ asset('js/app.js')}}></script>
</body>
</html>
