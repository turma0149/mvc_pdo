<?php

// Inicia ou recupera a sessão do usuário.
session_start();

// Se não existe usuário na sessão, volta para o login.
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}
