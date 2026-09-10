<?php

// Registra no banco uma ação realizada pelo usuário.
function registrarLog($pdo, $usuarioId, $acao, $projetoId = null)
{
    $stmt = $pdo->prepare(
        "INSERT INTO logs (usuario_id, projeto_id, acao)VALUES (?, ?, ?)"
    );

    $stmt->execute([
        $usuarioId,
        $projetoId,
        $acao
    ]);
}
