window.onload = crearComponentes;

var NOMBRE_SECCIONES = new Array("Partidos", "Entrenamientos", "Jugadores");
var arrayLi = {};
var liMiClub;

function crearComponentes() {
    recogerElementos();
    crearLi();
    crearMenuSecciones();

    //al cargar la página hago la comprobación del tamaño horizontal de la ventana
    comprobarTamanio();
}

function recogerElementos() {
    liMiClub = document.getElementById("miClub");
}

// comentario de prueba. git no funcoina como debería

function crearLi() {
    for (let i = 0; i < NOMBRE_SECCIONES.length; i++) {
        // creo el li con su respectivas clases
        var li = document.createElement('li');
        li.className = "nav-item logueado generico";
        var a = document.createElement('a');
        a.textContent = NOMBRE_SECCIONES[i];
        a.className = "nav-link linkB p-0";
        // Hay que configurar el link del componente a. 
        a.href = "'{{ url('/partidos') }}'";
        li.appendChild(a);
        arrayLi[i] = li;
    }
}

// creo el menu de secciones
function crearMenuSecciones() {

}

// resize

window.onresize = comprobarTamanio;

// comprueba el tamaño horizontal de la pantalla
function comprobarTamanio() {
    if (window.screen.availWidth <= 991) {
        ponerSeccionesMenuPrincipal();
        quitarMenuSecciones();
    } else {
        quitarSeccionesMenuPrincipal();
        ponerMenuSecciones();
    }
}

// acciones li del menu principal
function ponerSeccionesMenuPrincipal() {
    for (let i = (NOMBRE_SECCIONES.length - 1); i >= 0; i--) {
        liMiClub.parentNode.insertBefore(arrayLi[i], liMiClub.nextSibling);
    }
}

function quitarSeccionesMenuPrincipal() {
    for (let i = (NOMBRE_SECCIONES.length - 1); i >= 0; i--) {
        arrayLi[i].remove();
    }
}

// acciones menu secundario
function quitarMenuSecciones() {

}

function ponerMenuSecciones() {

}