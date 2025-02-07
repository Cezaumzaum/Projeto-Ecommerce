<?php
// Incluindo a conexão com o banco de dados
include 'conectando-db.php';

// Supondo que você tenha uma sessão iniciada
session_start();

// O resto do seu código continua aqui...

// Adiciona produtos ao carrinho (exemplo simples)
if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $sql = "SELECT * FROM Loja WHERE id = $id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $produto = $result->fetch_assoc();
    $_SESSION['carrinho'][] = $produto;
  }
}

// Remove produto do carrinho
if (isset($_GET['remove'])) {
  $removeId = intval($_GET['remove']);
  foreach ($_SESSION['carrinho'] as $key => $produto) {
    if ($produto['id'] == $removeId) {
      unset($_SESSION['carrinho'][$key]);
    }
  }
}

// Cálculo de frete
$frete = 0;
if (isset($_POST['cep'])) {
  $cep = $_POST['cep'];
  // Simulação de cálculo de frete (apenas um valor fixo aqui)
  $frete = 20.00; // valor fixo para simulação
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Carrinho de Compras</title>
  <style>
    body {
      background-color: #000B2B;
      color: white;
      font-family: 'Arial', sans-serif;
    }

    .header {
      background-color: #0086DD;
      padding: 10px;
    }

    .card {
      background-color: #1A1A1A;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .total,
    .frete {
      font-weight: bold;
      margin-top: 20px;
      font-size: 1.2em;
    }

    .btn-comprar {
      background-color: #FFCC00;
      color: black;
    }

    .btn-comprar:hover {
      background-color: #FFAA00;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <div class="header text-center">
      <h1>Carrinho de Compras</h1>
    </div>

    <div class="card p-3">
      <?php if (empty($_SESSION['carrinho'])): ?>
        <p>Seu carrinho está vazio.</p>
      <?php else: ?>
        <?php $total = 0; ?>
        <?php foreach ($_SESSION['carrinho'] as $produto): ?>
          <div class="row border-bottom py-3">
            <div class="col-3">
              <img src="<?php echo $produto['imagem']; ?>" alt="<?php echo $produto['nome']; ?>" class="img-fluid">
            </div>
            <div class="col-6">
              <h2><?php echo $produto['nome']; ?></h2>
              <p>Preço: R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
            </div>
            <div class="col-3 text-right">
              <a href="?remove=<?php echo $produto['id']; ?>" class="text-danger">Remover</a>
            </div>
          </div>
          <?php $total += $produto['preco']; ?>
        <?php endforeach; ?>
        <div class="total font-weight-bold mt-3">Total: R$ <?php echo number_format($total, 2, ',', '.'); ?></div>

        <!-- Seção de cálculo de frete -->
        <div class="mt-4">
          <form method="POST" class="form-inline">
            <label for="cep" class="mr-2">Digite seu CEP:</label>
            <input type="text" id="cep" name="cep" class="form-control mr-2" required>
            <button type="submit" class="btn btn-primary">Calcular Frete</button>
          </form>
          <?php if ($frete > 0): ?>
            <div class="frete font-weight-bold mt-2">Frete: R$ <?php echo number_format($frete, 2, ',', '.'); ?></div>
            <div class="total font-weight-bold">Total com Frete: R$ <?php echo number_format($total + $frete, 2, ',', '.'); ?></div>
          <?php endif; ?>
        </div>

        <button class="btn btn-warning btn-block mt-3">Finalizar Compra</button>
      <?php endif; ?>
    </div>
  </div>

</body>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>

</html>

<?php
$conn->close();
?>