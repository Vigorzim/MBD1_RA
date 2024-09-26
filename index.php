<?php

session_start();

if (isset($_GET['comando']) && isset($_GET['save']) && $_GET['save'] != '') {
    $comando = rawurldecode($_GET['comando']);
    $save = rawurldecode($_GET['save']);
    $conteudo = file_get_contents("http://localhost:123/{$comando}/{$save}");

} else if (isset($_GET['comando'])) {
    $comando = rawurldecode($_GET['comando']);
    $conteudo = file_get_contents("http://localhost:123/{$comando}");
} else {
    $conteudo = file_get_contents("http://localhost:123");
}

$arrayAssociativo = json_decode($conteudo);
$_SESSION['historico'] = isset($_SESSION['historico']) ? array_merge($_SESSION['historico'], $arrayAssociativo) : [];

$arrayAssociativo = $_SESSION['historico'];

include "template phtml";
