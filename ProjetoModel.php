<?php

// CADASTRAR
function cadastrarProjeto($pdo, $nome, $duracao, $responsavel)
{
    $stmt = $pdo->prepare("INSERT INTO projetos (nome, duracao, responsavel) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $duracao, $responsavel]);
}

// LISTAR
function listarProjetos($pdo)
{
    $stmt = $pdo->prepare("SELECT * FROM projetos ORDER BY id DESC");
    $stmt->execute();
    return $stmt->fetchAll();
}

// BUSCAR
function buscarProjeto($pdo, $id)
{
    $stmt = $pdo->prepare("SELECT * FROM projetos WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

// EDITAR
function editarProjeto($pdo, $id, $nome, $duracao, $responsavel)
{
    $stmt = $pdo->prepare("UPDATE projetos SET nome = ?, duracao = ?, responsavel = ? WHERE id = ?");
    $stmt->execute([$nome, $duracao, $responsavel, $id]);
}

// EXCLUIR
function excluirProjeto($pdo, $id)
{
    $stmt = $pdo->prepare("DELETE FROM projetos WHERE id = ?");
    $stmt->execute([$id]);
}
