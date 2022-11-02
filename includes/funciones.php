<?php

function debuguear($variable = 'ok') : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// Funciones para validar el usuario

function is_auth(){
    if(!isset($_SESSION['login'])){
        header('Location: /');
    }
}

function es_ultimo(string $actual, string $proximo): bool{

    if($actual !== $proximo){
        return true;
    }
    return false;

}

function isAdmin() : void{

    if(!isset($_SESSION['admin'])){
        header('Location: /');
    }

}