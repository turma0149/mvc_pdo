<?php

// ==========================================
// ARQUIVO DE CONEXÃO COM O BANCO DE DADOS
// ==========================================


// Dados necessários para acessar o MySQL
$host = "localhost";     // Servidor do banco
$banco = "aula_pdo";    // Nome do banco de dados
$usuario = "root";      // Usuário do MySQL
$senha = "";            // Senha do MySQL


// Função responsável por conectar ao banco
function conectarBanco()
{
    // Permite usar as variáveis criadas acima
    global $host, $banco, $usuario, $senha;

    try {

        // Cria a conexão com o banco usando PDO
        $pdo = new PDO(
            "mysql:host=$host;dbname=$banco;",
            $usuario,
            $senha
        );

        // Faz o PHP mostrar um erro caso algo dê errado no banco
        $pdo->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );

        // Retorna a conexão para ser usada em outros arquivos
        return $pdo;
    } catch (PDOException $erro) {

        // Mostra uma mensagem caso não consiga conectar
        die("Erro ao conectar: " . $erro->getMessage());
    }
}
