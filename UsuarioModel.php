<?php

// Busca um usuário pelo e-mail.
function buscarUsuarioPorEmail($pdo, $email)
{
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch();
}

function cadastrarUsuario($pdo, $dados)
{
    // Nunca salva a senha diretamente.
    $senhaHash = password_hash($dados["senha"], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) 
        VALUES (?, ?, ?)");
    $stmt->execute([
        $dados["nome"],
        $dados["email"],
        $senhaHash
    ]);

    return $pdo->lastInsertId();
}
