<?php

session_start();

header("Content-Type: application/json; charset=utf-8");

require __DIR__ . "/database.php";
require __DIR__ . "/UsuarioModel.php";

$pdo = conectarBanco();

$nome = trim($_POST["nome"] ?? "");
$email = trim($_POST["email"] ?? "");
$senha = $_POST["senha"] ?? "";

$idUsuario = cadastrarUsuario($pdo, [
    "nome" => $nome,
    "email" => $email,
    "senha" => $senha
]);

echo json_encode([
    "sucesso" => true,
    "mensagem" => "Usuário cadastrado com sucesso.",
    "dados" => ["id" => $idUsuario]
]);
