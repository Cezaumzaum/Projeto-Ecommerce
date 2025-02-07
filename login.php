<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexão com o banco de dados
include('conectando-db.php'); // Altere para o caminho correto do seu arquivo de conexão

// Incluindo a biblioteca do Google Client
require_once 'vendor/autoload.php'; // Certifique-se de que o autoload do Composer esteja incluído

$client = new Google_Client();
$client->setClientId('64794754807-8q1jv79a1v5enbfvc0vp74a6su9ups0b.apps.googleusercontent.com'); // ID do cliente
$client->setClientSecret('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'); // Chave secreta
$client->setRedirectUri('https://visaoglobalnoticias.com.br/index.php'); // URI de redirecionamento
$client->addScope("email");
$client->addScope("profile");

// Lógica de login com Google
if (isset($_GET['code'])) {
    // Se há um código de autenticação na URL
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // Verifique se o token é válido e obtenha as informações do usuário
    $payload = $client->verifyIdToken($token['id_token']);
    if ($payload) {
        // (continua o código de login do usuário)
    } else {
        echo "Erro ao verificar o token.";
    }
} else {
    // Se não há código, redireciona para a autenticação do Google
    if (isset($_GET['error'])) {
        echo "Erro ao autenticar com o Google: " . htmlspecialchars($_GET['error']);
        exit();
    }
}

// Fechando a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login ZenZone-Mart</title>
    <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="login.css" />
</head>
<body>
<div class="form-container">
    <p class="title">Bem-vindo de volta</p>
    <form action="login_usuario.php" method="POST" class="form">
        <input type="email" class="input" name="email" placeholder="Email" required />
        <input type="password" class="input" name="password" placeholder="Senha" required />
        <p class="page-link">
            <span class="page-link-label">Esqueceu a senha?</span>
        </p>
        <button type="submit" class="form-btn">Log in</button>
    </form>

    <p class="sign-up-label">
        Não tem conta?<a href="cadastro_usuario.html"><span class="sign-up-link">cadastre-se</span></a>
    </p>
    
     <div class="buttons-container">
    <div class="apple-login-button">
      <svg
        stroke="currentColor"
        fill="currentColor"
        stroke-width="0"
        class="apple-icon"
        viewBox="0 0 1024 1024"
        height="1em"
        width="1em"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M747.4 535.7c-.4-68.2 30.5-119.6 92.9-157.5-34.9-50-87.7-77.5-157.3-82.8-65.9-5.2-138 38.4-164.4 38.4-27.9 0-91.7-36.6-141.9-36.6C273.1 298.8 163 379.8 163 544.6c0 48.7 8.9 99 26.7 150.8 23.8 68.2 109.6 235.3 199.1 232.6 46.8-1.1 79.9-33.2 140.8-33.2 59.1 0 89.7 33.2 141.9 33.2 90.3-1.3 167.9-153.2 190.5-221.6-121.1-57.1-114.6-167.2-114.6-170.7zm-105.1-305c50.7-60.2 46.1-115 44.6-134.7-44.8 2.6-96.6 30.5-126.1 64.8-32.5 36.8-51.6 82.3-47.5 133.6 48.4 3.7 92.6-21.2 129-63.7z"
        ></path>
      </svg>
      <span>Fazer login com a Apple</span>
    </div>
    <style>
        .google-login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    margin-top: 10px;
}

.buttons-container {
    width: 100%;
    display: flex;
    justify-content: center;
}
    </style>
 <div class="buttons-container">
    <div class="google-login-container">
        <div id="google-login" class="google-login"></div>
    </div>
</div>
</div>

<script src="./bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
<script>
    function handleCredentialResponse(response) {
        // Enviar o token para o seu servidor
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "login_usuario.php"); // Alterar para o arquivo que lida com o login
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
            if (xhr.status === 200) {
                window.location.href = "pagina_inicial.php"; // Redirecionar após login bem-sucedido
            } else {
                console.error('Erro no login:', xhr.responseText);
            }
        };
        xhr.send("id_token=" + response.credential); // Envia o token ID
    }

    window.onload = function() {
        google.accounts.id.initialize({
            client_id: "64794754807-8q1jv79a1v5enbfvc0vp74a6su9ups0b.apps.googleusercontent.com",
            callback: handleCredentialResponse,
        });
        google.accounts.id.renderButton(
            document.getElementById("google-login"), {
                theme: "outline",
                size: "large"
            } // Opções de personalização
        );
        google.accounts.id.prompt(); // Exibe o prompt de login se necessário
    };
</script>
</body>
</html>
