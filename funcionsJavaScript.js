async function carrega(id, accio) {
    let resposta;
    switch (accio) {
        case "categoria":
            resposta = await fetch("?accio=llistat&categoria_id=" + id);
            break;
        case "producte":
            resposta = await fetch("?accio=producte&producte_id=" + id);
            break;
        case "cerca":
            resposta = await fetch("?accio=cerca&valor=" + id);
            break;
        default:
            resposta = await fetch("?accio=" + id);
            break;
    }
    var element = document.getElementById("cos");
    var respostaTxt = await resposta.text();
    element.innerHTML = respostaTxt;
}


async function buidaCistella() {
    await fetch("/controller/buidar.php");
    carrega('cistella');
    actualitzar_previw_cistella();
}

async function actualitzar_previw_cistella() {
    var r = await fetch("?accio=preview");
    var element = document.getElementById("quantitatIpreu");
    var respostaTxt = await r.text();
    element.innerHTML = respostaTxt;
}


async function tancarSessio() {
    await fetch("?accio=tancar_sessio");
    window.location.reload();
}


$(document).ready(function () {
    $.ajax({
        url: '/model/validar_estat_inici_sessio.php',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            const usuariIniciaSessio = response.estat_sessio;

            // Genera el contingut del menú desplegable
            const $menuCompte = $('#menu-compte');
            if (usuariIniciaSessio) {
                $menuCompte.append('<a href="#" onclick="carrega(\'editar_perfil\')">El meu compte</a>');
                $menuCompte.append('<a href="#" onclick="carrega(\'les_meves_compres\')">Les meves compres</a>');
                $menuCompte.append('<a href="#" onclick="tancarSessio()">Tancar sessió</a>');
            } else {
                $menuCompte.append('<a href="#" onclick="carrega(\'iniciar_sessio\')">Iniciar sessió</a>');
            }
        },
        error: function (xhr, status, error) {
            console.error('Error en la petició AJAX:', status, error);
        }
    });

    // Mostra o amaga el menú desplegable quan es fa clic al botó "Compte"
    $('#compte-btn').on('click', function (event) {
        event.preventDefault();
        $('#menu-compte').toggle(); // Utilitzem toggle() de jQuery per mostrar/amagat el menú
    });

    // Amaga el menú desplegable si es fa clic fora
    $(document).on('click', function (event) {
        if (!$(event.target).closest('.compte_menu').length) {
            $('#menu-compte').hide(); // Amaga el menú si es fa clic fora d'ell
        }
    });
});



async function afegirALaCistella(id_producte, preu, quantitat) {

    // Dades per enviar a PHP
    const dades = new FormData();
    dades.append('id_producte', id_producte);
    dades.append('quantitat', quantitat);
    dades.append('preu', preu);

    try {
        // Enviament de la petició AJAX a afegir_a_cistella.php
        const resposta = await fetch('/model/afegir_a_la_cistella.php', {
            method: 'POST',
            body: dades
        });

        const resultat = await resposta.json();

        actualitzar_previw_cistella();

        // Mostrar el missatge de resposta
        const missatgeCistella = document.getElementById('missatge-cistella');
        if (missatgeCistella) { // Comprovem si l'element existeix
            if (resultat.estat === 'èxit') {
                missatgeCistella.textContent = resultat.missatge;
                missatgeCistella.style.color = 'green'; // Color d'èxit
            } else {
                missatgeCistella.textContent = resultat.missatge;
                missatgeCistella.style.color = 'red'; // Color d'error
            }
        }
    } catch (error) {
        console.error('Error en la petició AJAX:', error);
        document.getElementById('missatge-cistella').textContent = 'Hi ha hagut un error al processar la teva petició.';
        document.getElementById('missatge-cistella').style.color = 'red';
    }
}



document.addEventListener("DOMContentLoaded", function () {
    const audio = document.getElementById('musica_fons');
    if (audio) {
        audio.addEventListener('loadeddata', function () {
            audio.volume = 0.1;
            audio.play().catch(error => console.error('Error audio:', error));
        });
        document.body.addEventListener('click', function () {
            audio.volume = 0.1;
            audio.play().catch(error => console.error('Error audio:', error));
        }, { once: true });
    } else {
        console.error("Element 'musica_fons' no trobat al DOM.");
    }
});
