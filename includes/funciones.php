<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false) {
    include TEMPLATES_URL . "/{$nombre}.php";
}

function estadoAutenticado() {
    session_start();

    if(!$_SESSION['login']) {
        header('Location: /');
    }
}

function debuguear($variable) {
    
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    exit;
}

// Escapar / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// Validar tipo de contenido
function validarTipoContenido($tipo) {
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos);
}

// Muestra los mensajes de notificacion de exito
function mostrarNotificacion($codigo) {
    $mensaje = '';

    switch($codigo) {
        case 1:
            $mensaje = 'Creado Correctamente';
        break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
        break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
        break;
        default:
            $mensaje = false;
        break;
    }

    return $mensaje;
}

function validarORedireccionar(string $url) {
    // Validar la URL por ID valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header("Location: {$url}");
    }

    return $id;
}