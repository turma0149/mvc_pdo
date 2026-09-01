<?php

header("Content-Type: application/json; charset=utf-8");

require __DIR__ . "/database.php";
require __DIR__ . "/ProjetoModel.php";

$pdo = conectarBanco();
$acao = $_REQUEST["acao"] ?? "listar";

switch ($acao) {
    case "listar":
        $projetos = listarProjetos($pdo);
        responder(true, "Projetos listados.", $projetos);
        break;

    case "buscar":
        $id = $_GET["id"] ?? 0;
        $projeto = buscarProjeto($pdo, $id);
        responder(true, "Projeto encontrado.", $projeto);
        break;

    case "cadastrar":
        cadastrarProjeto($pdo, $_POST["nome"], $_POST["duracao"], $_POST["responsavel"]);
        responder(true, "Projeto cadastrado com sucesso.");
        break;

    case "editar":
        editarProjeto($pdo, $_POST["id"], $_POST["nome"], $_POST["duracao"], $_POST["responsavel"]);
        responder(true, "Projeto atualizado com sucesso.");
        break;

    case "excluir":
        excluirProjeto($pdo, $_POST["id"]);
        responder(true, "Projeto excluído com sucesso.");
        break;

    default:
        responder(false, "Ação inválida.");
}


function responder($sucesso, $mensagem, $dados = null)
{
    echo json_encode(
        [
            "sucesso" => $sucesso,
            "mensagem" => $mensagem,
            "dados" => $dados
        ],
        JSON_UNESCAPED_UNICODE
    );

    exit;
}
