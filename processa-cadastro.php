<?php
include './conectando-db.php';
session_start();

// Gerar um token CSRF
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Verifica se o token CSRF é válido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('CSRF token inválido.');
    }

    // Conexão com o banco de dados
    require 'conectando-db.php'; // Inclua seu arquivo de conexão com o banco de dados

    // Sanitização e validação de dados
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'];
    $confirm_senha = $_POST['confirm_senha'];
    $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
    $data_nascimento = filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_STRING);
    $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
    $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
    $estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);
    $cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING);
    
    // Verificação de senhas
    if ($senha !== $confirm_senha) {
        die('As senhas não coincidem.');
    }

    // Validação do CPF
    function validar_cpf($cpf) {
        // Remove caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        
        // Verifica se o CPF tem 11 dígitos
        if (strlen($cpf) !== 11 || !preg_match('/^\d{11}$/', $cpf)) {
            return false; // CPF inválido
        }

        // Verifica se o CPF é uma sequência de números iguais (ex.: 111.111.111-11)
        if (preg_match('/^(\d)\1{10}$/', $cpf)) {
            return false; // CPF inválido
        }

        // Calcula o primeiro dígito verificador
        $soma = 0;
        for ($i = 0; $i < 9; $i++) {
            $soma += $cpf[$i] * (10 - $i);
        }
        $primeiro_digito = ($soma * 10) % 11;
        if ($primeiro_digito === 10) {
            $primeiro_digito = 0;
        }

        // Calcula o segundo dígito verificador
        $soma = 0;
        for ($i = 0; $i < 10; $i++) {
            $soma += $cpf[$i] * (11 - $i);
        }
        $segundo_digito = ($soma * 10) % 11;
        if ($segundo_digito === 10) {
            $segundo_digito = 0;
        }

        // Verifica se os dígitos verificadores estão corretos
        return $cpf[9] == $primeiro_digito && $cpf[10] == $segundo_digito;
    }

    // Verifica se o CPF é válido
    if (!validar_cpf($cpf)) {
        die('CPF inválido.');
    }

    // Hash da senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Prepara e executa a consulta para inserir o usuário
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, cpf, data_nascimento, endereco, cidade, estado, cep) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $nome, $email, $senha_hash, $cpf, $data_nascimento, $endereco, $cidade, $estado, $cep);
    
    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
