<?php
session_start();

require __DIR__ . "/database.php";
require __DIR__ . "/LogModel.php";

// Antes de destruir a sessão, registra quem saiu.
if (isset($_SESSION["usuario_id"])) {
    $pdo = conectarBanco();
    registrarLog($pdo, $_SESSION["usuario_id"], "LOGOUT");
}

session_unset();
session_destroy();

header("Location: login.php");
exit;
