<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conectando-db.php';

    // Conectar ao banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Obter dados do formulário
    $nome = $conn->real_escape_string($_POST['nome']);
    $tipo = $conn->real_escape_string($_POST['tipo']);
    $marca = $conn->real_escape_string($_POST['marca']);
    $modelo = $conn->real_escape_string($_POST['modelo']);

    // Formatar o preço
    $preco_str = $_POST['preco']; // Valor como string
    $preco = str_replace('.', '', $preco_str); // Remove pontos
    $preco = str_replace(',', '.', $preco); // Troca vírgula por ponto
    $descricao = $conn->real_escape_string($_POST['descricao']);
    $especificacoes = $conn->real_escape_string($_POST['especificacoes']);
    $imagem = $conn->real_escape_string($_POST['imagem']); // Caminho da imagem
    $estoque = intval($_POST['estoque']); // Estoque como inteiro
    $data_adicao = date('Y-m-d H:i:s'); // Data atual

    // Preparar a consulta SQL
    $sql = "INSERT INTO Loja (nome, tipo, marca, modelo, preco, descricao, especificacoes, imagem, estoque, data_adicao) VALUES ('$nome', '$tipo', '$marca', '$modelo', '$preco', '$descricao', '$especificacoes', '$imagem', $estoque, '$data_adicao')";

    // Executar a consulta
    if ($conn->query($sql) === TRUE) {
        echo "Produto adicionado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    // Fechar a conexão
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de produtos - ZenZone</title>
    <link rel="stylesheet" href="adicionar-produto.css">
    <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.rtl.min.css">
</head>

<style>
  /* styles.css */
body {
    font-family: Arial, sans-serif;
    background: radial-gradient(circle at center, #00c6fb, #005bea 30%, #002758 70%);
  background-attachment: fixed;
    margin: 0;
    padding: 20px;
}

.container {
    max-width: 800px;
    margin: auto;
    background: radial-gradient(circle at center, #00c6fb, #005bea 30%, #002758 70%);
    background-attachment: fixed;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    color: #f0f0f0;
}

label {
    display: block;
    margin: 10px 0 5px;
}

input[type="text"],
input[type="number"],
input[type="email"],
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="submit"] {
    background-color: #5cb85c;
    color: f0f0f0;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #4cae4c;
}

.error {
    color: red;
}
.button {
  --main-focus: #2d8cf0;
  --font-color: #dedede;
  --bg-color-sub: #222;
  --bg-color: #323232;
  --main-color: #dedede;
  position: relative;
  width: 150px;
  height: 40px;
  cursor: pointer;
  display: flex;
  align-items: center;
  border: 2px solid var(--main-color);
  box-shadow: 4px 4px var(--main-color);
  background-color: var(--bg-color);
  border-radius: 10px;
  overflow: hidden;
  background: linear-gradient(to right, #002758, #005bea);
}

.button,
.button__icon,
.button__text {
  transition: all 0.3s;
}

.button .button__text {
  transform: translateX(26px);
  color: #f0f0f0;
  font-weight: 700;
}

.button .button__icon {
  background: linear-gradient(to left, #004CC1, #002758);
  background-attachment: fixed;
  position: absolute;
  transform: translateX(109px);
  height: 100%;
  width: 39px;
  background-color: var(--bg-color-sub);
  display: flex;
  align-items: center;
  justify-content: center;
}

.button .svg {
  width: 20px;
  stroke: var(--main-color);
}

.button:hover {
  background: linear-gradient(to right, #002758, #005bea);
}

.button:hover .button__text {
  color: transparent;
}

.button:hover .button__icon {
  width: 148px;
  transform: translateX(0);
}

.button:active {
  transform: translate(3px, 3px);
  box-shadow: 0px 0px var(--main-color);
}


</style>
<body>
    <div class="container">
        <h1 class="mt-5">Adicionar Produto</h1>
        <form method="POST" action="adicionar-produto.php">
            <div class="form-group">
                <label style="color: #f0f0f0;" for="nome">Nome:</label>
                <input type="text" class="form-control" name="nome" required>
            </div>
            <div class="form-group">
                <label style="color: #f0f0f0;" for="tipo">Tipo:</label>
                <input type="text" class="form-control" name="tipo" required>
            </div>
            <div class="form-group">
                <label  style="color: #f0f0f0;" for="marca">Marca:</label>
                <input type="text" class="form-control" name="marca" required>
            </div>
            <div class="form-group">
                <label style="color: #f0f0f0;" for="modelo">Modelo:</label>
                <input type="text" class="form-control" name="modelo" required>
            </div>
            <div class="form-group">
                <label style="color: #f0f0f0;" for="preco">Preço:</label>
                <input type="text" class="form-control" name="preco" required>
                <small style="color: #f0f0f0 !important;" class="form-text text-muted">Formato: 3.533,99</small>
            </div>
            <div class="form-group">
                <label style="color: #f0f0f0;" for="especificacoes">Especificação:</label>
                <textarea class="form-control" name="especificacoes" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label style="color: #f0f0f0;" for="descricao">Descrição:</label>
                <textarea class="form-control" name="descricao" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label style="color: #f0f0f0;" for="estoque">Estoque:</label>
                <input type="number" class="form-control" name="estoque" min="0" required>
            </div>
            <div class="form-group">
                <label style="color: #f0f0f0;" for="imagem">Caminho da Imagem:</label>
                <input type="text" class="form-control" name="imagem" required>
                <small style="color: #f0f0f0 !important;" class="form-text text-muted">Insira o caminho relativo da imagem (ex: imagens/nome-do-produto.png).</small>
            </div>
            <button class="button" class="btn btn-primary" type="submit">
                <span class="button__text">Adicionar</span>
                <span class="button__icon"
                  ><svg
                    class="svg"
                    fill="none"
                    height="24"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    width="24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <line x1="12" x2="12" y1="5" y2="19"></line>
                    <line x1="5" x2="19" y1="12" y2="12"></line></svg
                ></span>
              </button>
              
        </form>
    </div>
</body>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</html>