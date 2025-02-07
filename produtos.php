<?php
require_once './conectando-db.php';

// Função para limpar dados de entrada
function cleanInput($data) {
    return htmlspecialchars(trim($data));
}

try {
    // Verifica e sanitiza o ID do produto
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        throw new Exception("ID do produto inválido ou não especificado.");
    }

    $id = intval($_GET['id']);

    // Usa prepared statements para prevenir SQL injection
    $stmt = $conn->prepare("SELECT id, nome, categoria, marca, modelo, preco, descricao, especificacoes, imagem, estoque FROM Loja WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        throw new Exception("Produto não encontrado.");
    }

    $produto = $result->fetch_assoc();

    // Produtos relacionados
    $stmt_relacionados = $conn->prepare("SELECT id, nome, categoria, marca, preco, descricao, imagem 
                                       FROM Loja 
                                       WHERE categoria = ? AND id != ? 
                                       LIMIT 4");
    $stmt_relacionados->bind_param("si", $produto['categoria'], $id);
    $stmt_relacionados->execute();
    $produtos_relacionados = $stmt_relacionados->get_result()->fetch_all(MYSQLI_ASSOC);

    // Produtos recomendados
    $stmt_recomendados = $conn->prepare("SELECT id, nome, categoria, marca, preco, descricao, imagem 
                                       FROM Loja 
                                       WHERE marca = ? AND id != ? 
                                       LIMIT 4");
    $stmt_recomendados->bind_param("si", $produto['marca'], $id);
    $stmt_recomendados->execute();
    $produtos_recomendados = $stmt_recomendados->get_result()->fetch_all(MYSQLI_ASSOC);

} catch (Exception $e) {
    error_log($e->getMessage());
    header("Location: error.php?message=" . urlencode($e->getMessage()));
    exit;
} finally {
    if (isset($stmt)) $stmt->close();
    if (isset($stmt_relacionados)) $stmt_relacionados->close();
    if (isset($stmt_recomendados)) $stmt_recomendados->close();
    if (isset($conn)) $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($produto['nome']); ?> - Loja de Vendas</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="produtos.css">
</head>
<body>
    <!-- Navbar principal -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background: radial-gradient(circle at center, #00c6fb, #005bea 30%, #002758 70%);">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="Fotos/logo2.0.png" alt="Nexus Overclocking Logo" style="height: 120px;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link text-white fw-bold" href="#"><i class="fas fa-home"></i> Home</a></li>
            <li class="nav-item"><a class="nav-link text-white fw-bold" href="#"><i class="fas fa-th-large"></i> Produtos</a></li>
            <li class="nav-item"><a class="nav-link text-white fw-bold" href="#"><i class="fas fa-tags"></i> Ofertas</a></li>
            <li class="nav-item"><a class="nav-link text-white fw-bold" href="#"><i class="fas fa-phone-alt"></i> Contato</a></li>
            <li class="nav-item"><a class="nav-link text-white fw-bold" href="#"><i class="fas fa-shopping-cart"></i> Carrinho</a></li>
            <li class="nav-item"><a class="nav-link text-white fw-bold" href="./login.php"><i class="fas fa-user"></i> Login</a></li>
          </ul>
          
          <div class="search-container">
            <div class="search-bar">
              <input type="text" class="search-input" placeholder="Pesquisar..." />
              <div class="search-icon">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                  <path d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zM9.5 14C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                </svg>
              </div>
            </div>
            <div class="glow"></div>
          </div>
        </div>
      </div>
    </nav>

    <!-- Navbar secundária para categorias -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Computadores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Hardware</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Periféricos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Smartphones</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="/<?php echo strtolower($produto['categoria']); ?>" class="text-decoration-none"><?php echo $produto['categoria']; ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $produto['nome']; ?></li>
            </ol>
        </nav>

        <div class="row bg-white p-4 rounded shadow-sm">
            <div class="col-md-5">
                <img src="<?php echo $produto['imagem']; ?>" alt="<?php echo $produto['nome']; ?>" class="img-fluid">
            </div>
            <div class="col-md-7">
                <h1 class="product-title"><?php echo $produto['nome']; ?></h1>
                <p class="text-muted mb-2">Código: <?php echo $produto['id']; ?></p>
                <p class="product-price mb-3">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                <p><strong>Marca:</strong> <?php echo $produto['marca']; ?></p>
                <p><strong>Modelo:</strong> <?php echo $produto['modelo']; ?></p>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-lg">COMPRAR</button>
                    <button class="btn btn-outline-secondary btn-lg">ADICIONAR AO CARRINHO</button>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Descrição</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button" role="tab" aria-controls="specs" aria-selected="false">Especificações</button>
                    </li>
                </ul>
                <div class="tab-content bg-white p-4 rounded shadow-sm" id="myTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                        <p><?php echo $produto['descricao']; ?></p>
                    </div>
                    <div class="tab-pane fade" id="specs" role="tabpanel" aria-labelledby="specs-tab">
                        <p><?php echo $produto['especificacoes']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="mt-5 mb-4">Produtos Relacionados</h2>
        <div class="row">
            <?php foreach ($produtos_relacionados as $prod_rel): ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="<?php echo $prod_rel['imagem']; ?>" class="card-img-top" alt="<?php echo $prod_rel['nome']; ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo $prod_rel['nome']; ?></h5>
                        <p class="card-text text-muted"><?php echo $prod_rel['marca']; ?></p>
                        <p class="card-text product-price mt-auto">R$ <?php echo number_format($prod_rel['preco'], 2, ',', '.'); ?></p>
                        <a href="produto.php?id=<?php echo $prod_rel['id']; ?>" class="btn btn-primary mt-2">Ver Produto</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
