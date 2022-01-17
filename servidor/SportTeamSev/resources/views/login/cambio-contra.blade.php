<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('componentes/head/scriptsBasicosEncriptar')

    <script>
        window.onload = function() {

            var boton = document.getElementById('btnlogin');

            boton.onclick = enviar;
        }

        function enviar() {


            var contras = document.getElementsByClassName('inputContra');

            var formulario = document.getElementById('formularioCambioContra');

            for (let i = 0; i < contras.length; i++) {

                let contraSincodificar = contras[i].value;

                let contraCodificada = generateHash(contraSincodificar);

                contras[i].value = contraCodificada;

            }

            if (contras[1] == contras[2]) {
                formulario.submit();
            }else{
                contras[i].style.color = 'red';
            }

        }
    </script>
    @include('componentes/head/headConstantes', ['logueado'=>false])

    {{-- propios --}}
    <link rel="stylesheet" href="css/comunes/formularios.css">

    <title>Cambio contraseña - Sport Team</title>
</head>

<body>
    @include('componentes/menus/menuDeslogueado', ['btnDesplegable' => false,'btnRegistro' => false, 'btnLogin' =>
    false])

    <section class="w-100 mx-auto row align-items-center bgVerde1">
        <div class="container-fluid my-auto textoBlanco">
            <div class="container-sm contenedor formulario bgBlanco">
                <h1 class="textoVerde3 centrado">Cambio contraseña</h1>
                <form action="" id="formularioCambioContra">
                    <div class="grupo">
                        <input class="textoVerde1" type="password" required>
                        <label class="textoVerde1 textfield" for="">Contraseña antigua</label>
                    </div>
                    <div class="grupo">
                        <input class="textoVerde1" type="password" required>
                        <label class="textoVerde1 textfield" for="">Contraseña</label>
                    </div>
                    <div class="grupo">
                        <input class="textoVerde1" type="password" required>
                        <label class="textoVerde1 textfield" for="">Repite la ontraseña</label>
                    </div>
                    <div class="centrado">
                        <button class="submit botonVerde">Cambiar contraseña</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    @include('componentes/footer')
    <script src={{ asset('js/app.js') }}></script>
</body>

</html>
