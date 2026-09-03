<?php

// Define que a resposta será em JSON
header("Content-Type: application/json; charset=utf-8");

// Importa a conexão e o Model
require __DIR__ . "/database.php";
require __DIR__ . "/ProjetoModel.php";

// Conecta ao banco
$pdo = conectarBanco();

// Recebe a ação enviada pelo JavaScript
$acao = $_REQUEST["acao"] ?? "listar";


// Decide qual operação executar
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
        $projeto = buscarProjeto($pdo, $_GET["id"]);

        echo json_encode([
            "sucesso" => true,
            "mensagem" => "Projeto encontrado.",
            "dados" => $projeto
        ]);
        break;

    // CADASTRAR
    case "cadastrar":
        cadastrarProjeto($pdo, $_POST);

        echo json_encode([
            "sucesso" => true,
            "mensagem" => "Projeto cadastrado com sucesso.",
            "dados" => null
        ]);
        break;

    // EDITAR
    case "editar":
        editarProjeto($pdo, $_POST);

        echo json_encode([
            "sucesso" => true,
            "mensagem" => "Projeto atualizado com sucesso.",
            "dados" => null
        ]);
        break;

    // EXCLUIR
    case "excluir":
        excluirProjeto($pdo, $_POST["id"]);

        echo json_encode([
            "sucesso" => true,
            "mensagem" => "Projeto excluído com sucesso.",
            "dados" => null
        ]);
        break;

    // Ação não encontrada
    default:
        echo json_encode([
            "sucesso" => false,
            "mensagem" => "Ação inválida.",
            "dados" => null
        ]);
}
