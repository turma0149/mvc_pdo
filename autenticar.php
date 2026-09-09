<?php
session_start();

require __DIR__ . "/database.php";
require __DIR__ . "/UsuarioModel.php";
require __DIR__ . "/LogModel.php";

$pdo = conectarBanco();

$email = $_POST["email"] ?? "";
$senha = $_POST["senha"] ?? "";
$lembrar = isset($_POST["lembrar"]);

$usuario = buscarUsuarioPorEmail($pdo, $email);

// Confere se o usuário existe e se a senha 
// digitada corresponde ao hash salvo.
if ($usuario && password_verify($senha, $usuario["senha"])) {

    // Guarda dados básicos no servidor, dentro da sessão.
    $_SESSION["usuario_id"] = $usuario["id"];
    $_SESSION["usuario_nome"] = $usuario["nome"];
    $_SESSION["usuario_email"] = $usuario["email"];

    // Cookie: lembra e-mail e senha por 7 dias.
    if ($lembrar == true) {
        setcookie("ultimo_email", $usuario["email"], time() + (7 * 24 * 60 * 60), "/");
    } else {
        setcookie("ultimo_email", "", time() - 3600, "/");
    }

    registrarLog($pdo, $usuario["id"], "LOGIN");

    header("Location: index.php");
    exit;
}

header("Location: login.php?erro=1");
exit;
