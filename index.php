<?php
include './conectando-db.php';
$sql = "SELECT id, nome, categoria, marca, modelo, preco, descricao, imagem, estoque, especificacoes, subcategoria FROM Loja";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <link rel="icon" type="image/png" sizes="16x16" href="./favicons/favicon-16x16.png" />
  <meta name="msapplication-TileColor" content="#ffffff" />
  <meta name="theme-color" content="#ffffff" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Nexus Overclock - Melhor loja de tecnologia e eletrônicos" />
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./style.css" />
  <link rel="stylesheet" href="./cookie-banner.css">
  <title>Nexus Overclock - Melhor loja de tecnologia e eletrônicos</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>
  <div class="alert-banner">
    <p>⚠️ Este site está em desenvolvimento. Muitas alterações ainda virão e todos os produtos são fictícios.</p>
    <button onclick="this.parentElement.style.display='none';">✖️</button>
  </div>

  <div id="cookie-banner" class="cookie-banner">
    <p>Usamos cookies para melhorar sua experiência. Ao continuar, você concorda com nossa <a href="/politica-de-privacidade.html" style="color: #00BFFF;">Política de Privacidade</a>.</p>
    <button id="accept-cookies" class="btn btn-primary">Aceitar Cookies</button>
  </div>

  <header style="background: radial-gradient(circle at center, #00c6fb, #005bea 30%, #002758 70%);
  background-attachment: carousel;">
    <nav class="navbar navbar-expand-lg navbar-light"
      style=style="background: radial-gradient(circle at center, #00c6fb, #005bea 30%, #002758 70%);
  background-attachment: carousel;">
      <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="Fotos/logo2.0.png" alt="Nexus Overclocking Logo" style="height: 120px;">
        </a>

        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a
                class="nav-link text-white fw-bold"
                aria-current="page"
                href="#">
                <i class="fas fa-home"></i> Home
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white fw-bold" href="#">
                <i class="fas fa-th-large"></i> Produtos
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white fw-bold" href="#">
                <i class="fas fa-tags"></i> Ofertas
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white fw-bold" href="#">
                <i class="fas fa-phone-alt"></i> Contato
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white fw-bold" href="#">
                <i class="fas fa-shopping-cart"></i> Carrinho
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white fw-bold" href="./login.php">
                <i class="fas fa-user"></i> Login
              </a>
            </li>
          </ul>
            
            <div class="search-container">
              <div class="search-bar">
                <input type="text" class="search-input" placeholder="Pesquisar..." />
                <div class="search-icon">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="24"
                    viewBox="0 0 24 24"
                    width="24"
                  >
                    <path d="M0 0h24v24H0z" fill="none"></path>
                    <path
                      d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zM9.5 14C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"
                    ></path>
                  </svg>
                </div>
              </div>
              <div class="glow"></div>
            </div>
        </div>
      </div>
    </nav>
  </header>
  <div
    id="carouselExample"
    class="carousel slide"
    data-bs-ride="carousel"
    data-bs-interval="3000">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img
          src="./Fotos/foto1-carrosel.png"
          class="d-block w-100"
          alt="Imagem 1" />
      </div>
      <div class="carousel-item">
        <img
          src="./Fotos/foto2-carrosel.png"
          class="d-block w-100"
          alt="Imagem 2" />
      </div>
      <div class="carousel-item">
        <img
          src="./Fotos/foto3-carrosel.png"
          class="d-block w-100"
          alt="Imagem 3" />
      </div>
    </div>
    <button
      class="carousel-control-prev"
      type="button"
      data-bs-target="#carouselExample"
      data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Anterior</span>
    </button>
    <button
      class="carousel-control-next"
      type="button"
      data-bs-target="#carouselExample"
      data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Próximo</span>
    </button>
  </div>
  <!-- Seção de Categorias -->
  <section
    class="categories-section py-5"
    style="background: radial-gradient(circle at center, #00c6fb, #005bea 30%, #002758 70%);
  background-attachment: fixed;">
    <div class="container">
      <h2 class="text-center mb-4 text-whitegit push -u origin main">Categorias</h2>
      <div class="row text-center">
        <div class="col-lg-2 col-md-4 col-sm-6 mb-4 text-white">
        <a href="?cateegoria[]=Hardware">
            <img
              src="./Fotos/foto_produtos/placamae-gigabyte-intel-b760m.png"
              class="img-fluid mb-2 "
              alt="Hardware" />
            <p>Hardware</p>
          </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
        <a href="?categoria[]=Perifericos">
            <img
              src="./Fotos/foto_produtos/shopping.png"
              class="img-fluid mb-2"
              alt="Periféricos" />
            <p>Periféricos</p>
          </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
        <a href="?categoria[]=Gabinete">
            <img
              src="./Fotos/foto_produtos/gabinete.png"
              class="img-fluid mb-2"
              alt="Eletrônicos" />
            <p>Gabinetes</p>
          </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
          <a href="categoria[]=Monitor">
            <img
              src="./Fotos/foto_produtos/monitor-gamer-lg-ultragear-27-ips.png"
              class="img-fluid mb-2"
              alt="Monitores" />
            <p>Monitores</p>
          </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
          <a href="categoria[]=Notebook">
            <img
              src="./Fotos/foto_produtos/ace-rnitroA17.png"
              class="img-fluid mb-2"
              alt="Notebooks" />
            <p>Notebooks</p>
          </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
          <a href="#">
            <img
              src="./Fotos/menu-categorias.png"
              class="img-fluid mb-2"
              alt="Mais Categorias" />
            <p>Mais Categorias</p>
          </a>
        </div>
      </div>
    </div>
  </section>
  <section style=" background: radial-gradient(circle at center, #00c6fb, #005bea 30%, #002758 70%);
">>
    <style>
      .container-produtos {
        display: flex;
      }

      .filtros {
        width: 20%;
        background-color: #ffffff;
        /* Cor de fundo branca para um visual limpo */
        padding: 20px;
        margin-right: 20px;
        border-radius: 10px;
        /* Bordas arredondadas para suavizar a aparência */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        /* Sombra mais suave */
        border: 1px solid #007bff;
        /* Borda azul de destaque */
        transition: box-shadow 0.3s, transform 0.3s;
        /* Efeito de transição */
      }

      /* Efeito de hover nos filtros */
      .filtros:hover {
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        /* Sombra mais intensa ao passar o mouse */
        transform: translateY(-4px);
        /* Eleva a área de filtros ao passar o mouse */
      }

      /* Títulos e rótulos dos filtros */
      .filtros h3 {
        font-size: 18px;
        /* Tamanho maior para títulos */
        font-weight: bold;
        /* Negrito para destaque */
        color: #343a40;
        /* Cor escura para boa legibilidade */
        margin-bottom: 15px;
        /* Espaço abaixo do título */
      }

      /* Estilo dos inputs e selects */
      .filtros input[type="text"],
      .filtros select {
        width: 100%;
        /* Ocupa toda a largura disponível */
        padding: 10px;
        /* Espaçamento interno */
        margin-bottom: 15px;
        /* Espaçamento abaixo dos campos */
        border: 1px solid #ced4da;
        /* Borda suave */
        border-radius: 5px;
        /* Bordas arredondadas */
        transition: border-color 0.3s;
        /* Efeito de transição */
      }

      /* Efeito de foco nos inputs e selects */
      .filtros input[type="text"]:focus,
      .filtros select:focus {
        border-color: #913b0a;
        /* Borda azul ao focar */
        outline: none;
        /* Remove o contorno padrão */
      }

      /* Botão de aplicar filtro */
      .filtros button {
        background-color: #ce520a;
        /* Azul para o botão */
        color: white;
        border: none;
        padding: 10px;
        /* Aumenta o padding do botão */
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        /* Aumenta o tamanho da fonte do botão */
        font-weight: bold;
        width: 100%;
        /* Ocupa toda a largura disponível */
        transition: background-color 0.3s, transform 0.3s;
        /* Transições para interatividade */
      }

      .filtros button:hover {
        background-color:  #913b0a;
        /* Azul mais escuro ao passar o mouse */
        transform: translateY(-2px);
        /* Eleva o botão ao passar o mouse */
      }

      /* Estilos responsivos para a área de filtros */
      @media (max-width: 1200px) {
        .filtros {
          width: 25%;
          /* Ajusta a largura dos filtros */
        }
      }

      @media (max-width: 992px) {
        .filtros {
          width: 30%;
          /* Ajusta a largura dos filtros */
        }
      }

      @media (max-width: 768px) {
        .filtros {
          width: 40%;
          /* Ajusta a largura dos filtros */
        }
      }

      @media (max-width: 576px) {
        .filtros {
          width: 100%;
          /* Filtros ocupam a largura total em telas muito pequenas */
          margin-right: 0;
          /* Remove a margem à direita */
          margin-bottom: 20px;
          /* Adiciona espaço abaixo dos filtros */
        }
      }

      /* Área de produtos */
      .produtos {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        /* Alinha os cards à esquerda */
        width: 80%;
        gap: 10px;
      }

      /* Cada card de produto */
      .produto-card {
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        width: calc(20% - 10px);
        /* 5 cards por linha */
        margin: 10px 0;
        padding: 10px;
        text-align: center;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
      }

      .produto-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        cursor: pointer;
      }

      .produto-card img {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
        margin-bottom: 10px;
      }

      .produto-card h2 {
        font-size: 14px;
        font-weight: bold;
        color: #333;
        min-height: 48px;
        /* Altura mínima para o título */
        overflow: hidden;
        /* Oculta o texto que extrapolar o espaço */
        word-wrap: break-word;
        /* Faz com que o texto quebre para a próxima linha */
        text-align: center;
        /* Centraliza o texto */
        margin: 8px 0;
        /* Margem ao redor do título */
      }

      .produto-card .preco {
        font-size: 16px;
        font-weight: bold;
        color: #2ecc71;
        margin: 8px 0;
      }

      .produto-card .estoque {
        font-size: 12px;
        color: #ff0000;
      }

      .produto-card .tipo,
      .produto-card .marca,
      .produto-card .modelo {
        font-size: 12px;
        color: #999;
      }

      .produto-card button {
        background-color: #FFA500;
        /* Cor laranja */
        color: white;
        border: none;
        padding: 8px 10px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 12px;
        font-weight: bold;
        margin-top: auto;
        /* Mantém o botão na parte inferior do card */
        transition: background-color 0.3s;
      }

      .produto-card button:hover {
        background-color: #FF8C00;
        /* Cor laranja mais escura */
      }

      /* Estilos responsivos para telas menores */
      @media (max-width: 1200px) {
        .produto-card {
          width: calc(20% - 10px);
          /* 5 produtos por linha em telas grandes */
        }
      }

      @media (max-width: 992px) {
        .produto-card {
          width: calc(25% - 10px);
          /* 4 produtos por linha em telas médias */
        }
      }

      @media (max-width: 768px) {
        .filtros {
          display: none;
        }

      }

      .filtros h4 {
        margin-top: 10px;
        /* Adiciona espaço entre os títulos dos filtros */
      }

      @media (max-width: 576px) {
        .filtros {
          display: none;
        }

        .produto-card {
          width: 100%;
          /* 1 produto por linha em telas muito pequenas */
        }
    </style>
    <h1 color: #F0F0F0;>Produtos Disponíveis</h1>
    <div class="container-produtos">

      <div class="filtros" style="background: radial-gradient(circle at center, #00c6fb, #005bea 30%, #002758 70%);
  background-attachment: fixed;">
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtrosOffcanvas" aria-controls="filtrosOffcanvas">
          <i class="fas fa-filter"></i> Filtrar
        </button>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="filtrosOffcanvas" aria-labelledby="filtrosOffcanvasLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="filtrosOffcanvasLabel">Filtros</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <form method="GET" action="">
              <h4>Tipo</h4>
              <input type="checkbox" name="categoria[]" value="Hardware">Hardware<br>
              <input type="checkbox" name="categoria[]" value="Perifericos">Periféricos<br>
              <input type="checkbox" name="categoria[]" value="Console">Console<br>
              <input type="checkbox" name="categoria[]" value="Volantes e Pedais">Volantes e Pedais<br>
              <input type="checkbox" name="categoria[]" value="Placa-mãe">Placa-mãe<br>

              <h4>Marca</h4>
              <input type="checkbox" name="marca[]" value="Gigabyte">Gigabyte<br>
              <input type="checkbox" name="marca[]" value="Intel">Intel<br>
              <input type="checkbox" name="marca[]" value="Acer">Acer<br>
              <input type="checkbox" name="marca[]" value="Sony">Sony<br>
              <input type="checkbox" name="marca[]" value="ASRock">ASrock<br>
              <input type="checkbox" name="marca[]" value="Logitech">Logitech<br>

              <h4>Preço</h4>
              <label for="preco_min">Preço Mínimo:</label>
              <input type="number" name="preco_min" id="preco_min" min="0" placeholder="0"><br>

              <label for="preco_max">Preço Máximo:</label>
              <input type="number" name="preco_max" id="preco_max" min="0" placeholder="1000"><br>

              <button type="submit">Aplicar Filtros</button>
            </form>
            <?php

            $erro = false; // Variável para controlar se houve algum erro
            $mensagem_erro = ""; // Variável para armazenar a mensagem de erro

            // Construir a consulta SQL com base nos filtros
            $sql = "SELECT id, nome, categoria, marca, modelo, preco, descricao, imagem, estoque, especificacoes, subcategoria FROM Loja WHERE 1=1";

            if (isset($_GET['categoria']) && !empty($_GET['categoria'])) {
              $categorias = implode("','", $_GET['categoria']);
              $sql .= " AND tipo IN ('$tipos')";
            }

            if (isset($_GET['marca']) && !empty($_GET['marca'])) {
               $categorias = implode("','", $_GET['categoria']);
              $sql .= " AND marca IN ('$marcas')";
            }

            if (isset($_GET['preco_min']) && !empty($_GET['preco_min'])) {
              $preco_min = $_GET['preco_min'];
              if (!is_numeric($preco_min)) {
                $erro = true;
                $mensagem_erro = "O preço mínimo deve ser um número.";
              } else {
                $sql .= " AND preco >= $preco_min";
              }
            }

            if (isset($_GET['preco_max']) && !empty($_GET['preco_max'])) {
              $preco_max = $_GET['preco_max'];
              if (!is_numeric($preco_max)) {
                $erro = true;
                $mensagem_erro = "O preço máximo deve ser um número.";
              } else {
                $sql .= " AND preco <= $preco_max";
              }
            }

            // Verificar se houve algum erro
            if ($erro) {
              // Exibir mensagem de erro
              echo "<p class='mensagem-erro'>Erro: $mensagem_erro</p>";
            } else {
              // Executar a consulta
              $result = $conn->query($sql);

              // Verificar se a consulta retornou algum resultado
              if ($result->num_rows > 0) {
                // Exibir os produtos (código para exibir os produtos aqui)
              } else {
                // Exibir mensagem se nenhum produto for encontrado
                echo '<p>Nenhum produto encontrado com esses filtros.</p>';
              }
            }

            // Fechar a conexão
            $conn->close();
            ?>
          </div>
        </div>
      </div>

      <script>
        const precoMinInput = document.getElementById('preco_min');
        const precoMaxInput = document.getElementById('preco_max');

        precoMinInput.addEventListener('input', () => {
          if (precoMinInput.value < 0) {
            precoMinInput.value = 0;
          }
        });

        precoMaxInput.addEventListener('input', () => {
          if (precoMaxInput.value < 0) {
            precoMaxInput.value = 0;
          }
        });
      </script>

      <div class="produtos">
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<div class="produto-card" onclick="window.location.href=\'produtos.php?id=' . $row["id"] . '\'">';
            echo '<img src="https://visaoglobalnoticias.com.br/' . $row["imagem"] . '" alt="' . $row["nome"] . '">';
            echo '<h2>' . $row["nome"] . '</h2>';
            echo '<p class="categoria">Categoria: ' . $row["categoria"] . '</p>';
            echo '<p class="marca">Marca: ' . $row["marca"] . '</p>';
            echo '<p class="modelo">Modelo: ' . $row["modelo"] . '</p>';
            echo '<p class="preco">R$' . number_format($row["preco"], 2, ',', '.') . '</p>';
            echo '<p class="estoque">Em estoque: ' . $row["estoque"] . '</p>';
            echo '<button>Adicionar ao carrinho</button>';
            echo '</div>'; // Fecha produto-card
          }
        } else {
          echo '<p>Nenhum produto encontrado.</p>';
        }
        ?>
      </div>
    </div>
 
<button class="faq-button">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
    <path
      d="M80 160c0-35.3 28.7-64 64-64h32c35.3 0 64 28.7 64 64v3.6c0 21.8-11.1 42.1-29.4 53.8l-42.2 27.1c-25.2 16.2-40.4 44.1-40.4 74V320c0 17.7 14.3 32 32 32s32-14.3 32-32v-1.4c0-8.2 4.2-15.8 11-20.2l42.2-27.1c36.6-23.6 58.8-64.1 58.8-107.7V160c0-70.7-57.3-128-128-128H144C73.3 32 16 89.3 16 160c0 17.7 14.3 32 32 32s32-14.3 32-32zm80 320a40 40 0 1 0 0-80 40 40 0 1 0 0 80z"
    ></path>
  </svg>
  <span class="tooltip">FAQ</span>
</button>

    </main>
    <!-- Rodapé -->
    <footer class="footer text-center text-lg-star" style="background: radial-gradient(circle at center, #00c6fb, #005bea 30%, #002758 70%);
  background-attachment: fixed;">
      <div class="container p-3" style="background: radial-gradient(circle at center, #00c6fb, #005bea 30%, #002758 70%);
  background-attachment: fixed;">
        <div class="row">
          <!-- Links rápidos -->
          <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase">Links Rápidos</h5>
            <ul class="list-unstyled mb-0">
              <li><a href="#!">Home</a></li>
              <li><a href="#!">Sobre Nós</a></li>
              <li><a href="#!">Serviços</a></li>
              <li><a href="#!">Contato</a></li>
            </ul>
          </div>
          <!-- Contato -->
          <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase">Contato</h5>
            <ul class="list-unstyled mb-0">
              <li>
                <a href="mailto:contato@zenzonemart.com">contato@zenzonemart.com</a>
              </li>
              <li><a href="tel:+55993196550">+55 81 99319-6550</a></li>
              <li><a href="#!">Endereço: Penambuco</a></li>
            </ul>
          </div>
          <!-- Redes sociais -->
        <!-- Redes sociais -->
<div class="col-lg-3 col-md-6 mb-4 mb-md-0">
  <h5 class="text-uppercase">Siga-nos</h5>
  <div class="social-icons">
    <a href="https://www.facebook.com/" class="facebook" title="Siga-nos no Facebook"  aria-label="Facebook"></a>
    <a href="https://www.instagram.com/" class="instagram" title="Siga-nos no Instagram" aria-label="Instagram"></a>
    <a href="https://x.com/?lang=pt-br" class="twitter" title="Siga-nos no X" aria-label="X"></a>
    <a href="https://br.linkedin.com/" class="linkedin" title="Siga-nos no Linkedin" aria-label="LinkedIn"></a>
  </div>
</div>
          <!-- Newsletter -->
          <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase">Newsletter</h5>
            <form class="newsletter">
              <input type="email" placeholder="Seu email" />
              <button type="submit">Assinar</button>
            </form>
          </div>


          <div class="text-center p-3">
            <p>ZenZone Mart &copy; 2024. Todos os direitos reservados.</p>
          </div>
        </div>
      </div>
    </footer>
</body>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
<script src="./temporizador.js"></script>
<script src="./cookie-permissao.js"></script>

</html>

<?php
// Fechar a conexão
$conn->close();
?>