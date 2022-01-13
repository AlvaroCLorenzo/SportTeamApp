window.onload = crearComponentes;

var N_SECCIONES;
var NOMBRE_SECCIONES = new Array("Partido", "Entrenamientos", "Jugadores");
var li =

    function crearComponentes() {
        crearLi();
        crearMenuSecciones();
    }

function crearLi() {

}

function crearMenuSecciones() {

}

// resize

window.onresize = comprobarTamanio;

function comprobarTamanio() {
    if (window.screen.availWidth <= 991) {
        ponerSeccionesMenuPrincipal();
        quitarMenuSecciones();
    } else {
        quitarSeccionesMenuPrincipal();
        ponerMenuSecciones();
    }
}

function ponerSeccionesMenuPrincipal() {

}

function quitarMenuSecciones() {

}

function quitarSeccionesMenuPrincipal() {

}

function ponerMenuSecciones() {

}