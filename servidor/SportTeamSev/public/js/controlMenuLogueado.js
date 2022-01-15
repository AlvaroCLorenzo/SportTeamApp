window.onload = iniciarApp;
window.onresize = putLi;

var NOMBRE_SECCION = new Array("Partidos", "Entrenamientos", "Jugadores");
var LINK_SECCION = new Array(window.parent.urlPartido, window.parent.urlEntrenamientos, window.parent.urlJugadores);
//liMiClub lo uso como referencia para poder añadir el resto debajo
var liMiClub;
var arrayLi = {};

// objetos para crear el menu secciones. Header referencia.
var menuSeccionesActivo = window.parent.menuSeccionesActivo; //saber si esta el menu activo
var header;
var divMenu;
var nombreLinkActual = window.parent.paginaActiva;
var horizontal = true;

function iniciarApp() {
    recogerElementos();
    crearLi();
    if (menuSeccionesActivo) {
        crearMenu();
    }

    //al cargar la página hago la comprobación del tamaño horizontal de la ventana
    comprobarTamanio();
    putLi();
}

/**
 * Recoge el li de MI CLUB
 */
function recogerElementos() {
    liMiClub = document.getElementById("miClub");
    header = document.getElementsByTagName('header');
}

/**
 * Creo los li que voy a insertar más tarde
 */
function crearLi() {
    for (let i = 0; i < NOMBRE_SECCION.length; i++) {
        // creo el li con su respectivas clases
        var li = document.createElement('li');
        li.className = "nav-item logueado generico";
        var a = document.createElement('a');
        a.textContent = NOMBRE_SECCION[i];
        a.className = "nav-link linkB p-0";
        a.href = LINK_SECCION[i];
        li.appendChild(a);
        arrayLi[i] = li;
    }
}

function crearMenu() {
    // creo el li con su respectivas clases
    divMenu = document.createElement('div');
    divMenu.id = "menuSecciones";
    var nav = document.createElement('nav');
    divMenu.appendChild(nav);
    var ul = document.createElement('ul');
    ul.className = "row p-0 my-0 mx-0 align-items-center";
    nav.appendChild(ul);
    for (let i = 0; i < NOMBRE_SECCION.length; i++) {
        var li = document.createElement('li');
        li.className = "nav-item col-4 mx-0 secciones";
        var a = document.createElement('a');
        a.textContent = NOMBRE_SECCION[i];
        a.className = "nav-link py-4";
        if (nombreLinkActual != null && nombreLinkActual == NOMBRE_SECCION[i]) {
            li.className += li.className + " linkActual";
            a.className += a.className + " linkActual";
        }
        a.href = LINK_SECCION[i];
        li.appendChild(a);
        ul.appendChild(li);
    }
}

/**
 * Comprueba el tamaño horizontal para saber si insertar o quitar los li de las secciones
 */
function comprobarTamanio() {
    if (window.innerWidth <= 991) {
        horizontal = false;
    }
}

/**
 * Pone los li en el menu correspondiente
 */
function putLi() {
    if (window.innerWidth <= 991) {
        while (!horizontal) {
            if (menuSeccionesActivo) {
                removeMenuSeccion();
            }
            putOnMainMenu();
            horizontal = true;
            console.log("1: " + horizontal);
        }
    } else {
        while (horizontal) {
            removeOnMainMenu();
            if (menuSeccionesActivo) {
                putMenuSeccion();
            }
            horizontal = false;
            console.log("2: " + horizontal);
        }
    }
}

// acciones li del menu principal
function putOnMainMenu() {
    for (let i = (NOMBRE_SECCION.length - 1); i >= 0; i--) {
        liMiClub.parentNode.insertBefore(arrayLi[i], liMiClub.nextSibling);
    }
}

function removeOnMainMenu() {
    for (let i = (NOMBRE_SECCION.length - 1); i >= 0; i--) {
        arrayLi[i].remove();
    }
}

// acciones menu secciones
function putMenuSeccion() {
    header[0].parentNode.insertBefore(divMenu, header.nextSibling);
}

function removeMenuSeccion() {
    divMenu.remove();
}