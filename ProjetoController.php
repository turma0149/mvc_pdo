<?php

session_start();

// As operações do sistema só podem ser usadas por quem está logado.
if (!isset($_SESSION["usuario_id"])) {
    http_response_code(401);
    header("Content-Type: application/json; charset=utf-8");

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Sessão encerrada. Faça login novamente.",
        "dados" => null
    ]);

    exit;
}

// Define que a resposta será em JSON.
header("Content-Type: application/json; charset=utf-8");

// Importa a conexão e os Models.
require __DIR__ . "/database.php";
require __DIR__ . "/ProjetoModel.php";
require __DIR__ . "/LogModel.php";

// Conecta ao banco.
$pdo = conectarBanco();

// Recebe a ação enviada pelo JavaScript.
$acao = $_REQUEST["acao"] ?? "listar";

// Decide qual operação executar.
switch ($acao) {

    // LISTAR
    case "listar":

        $projetos = listarProjetos($pdo);

        echo json_encode([
            "sucesso" => true,
            "mensagem" => "Projetos listados.",
            "dados" => $projetos
        ]);

        break;


    // BUSCAR
    case "buscar":

        $projeto = buscarProjeto(
            $pdo,
            $_GET["id"]
        );

        echo json_encode([
            "sucesso" => true,
            "mensagem" => "Projeto encontrado.",
            "dados" => $projeto
        ]);

        break;


    // CADASTRAR
    case "cadastrar":

        $idProjeto = cadastrarProjeto($pdo, $_POST);

        registrarLog(
            $pdo,
            $_SESSION["usuario_id"],
            "CADASTROU",
            $idProjeto
        );

        echo json_encode([
            "sucesso" => true,
            "mensagem" => "Projeto cadastrado com sucesso.",
            "dados" => null
        ]);

        break;

    // EDITAR
    case "editar":

        editarProjeto($pdo, $_POST);

        registrarLog(
            $pdo,
            $_SESSION["usuario_id"],
            "EDITOU",
            $_POST["id"]
        );

        echo json_encode([
            "sucesso" => true,
            "mensagem" => "Projeto atualizado com sucesso.",
            "dados" => null
        ]);

        break;


    // EXCLUIR
    case "excluir":
        excluirProjeto($pdo, $_POST["id"]);

        registrarLog(
            $pdo,
            $_SESSION["usuario_id"],
            "EXCLUIU",
            $_POST["id"]
        );

        echo json_encode([
            "sucesso" => true,
            "mensagem" => "Projeto excluído com sucesso.",
            "dados" => null
        ]);

        break;


    // Ação não encontrada.
    default:

        echo json_encode([
            "sucesso" => false,
            "mensagem" => "Ação inválida.",
            "dados" => null
        ]);
}
