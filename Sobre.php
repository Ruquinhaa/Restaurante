<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>O Américo - O Rei do Peixe Assado</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header class="content">
        <div class="logo">
            <img src="./logoRestaurante.png" alt="Logo do Restaurante">
        </div>
        <h3>O Américo - O Rei do Peixe Assado</h3>
        <nav>
            <ul class="Lista-Menu">
                <li><a href="/index.php">Home</a></li>
                <li><a href="/Menu.php">Menu</a></li>
                <li><a href="/Sobre.php">Sobre</a></li>
                <li><a href="/Contato.php">Contato</a></li>
                <li><a href="#"><i class="bi bi-facebook"></i></a></li>
                <li><a href="#"><i class="bi bi-instagram"></i></a></li>
            </ul>
        </nav>
    </header>

    <section class="sobre-nos2" id="sobrenos2">
        <div class="main2">
            <div class="contentsobre2">
                <h2>Sobre nós</h2>
                <p>O ambiente do restaurante é acolhedor e familiar, ideal para um almoço descontraído.
                    A decoração reflete a cultura marítima da região, criando uma atmosfera agradável para os visitantes.
                    Os clientes frequentemente elogiam a qualidade dos pratos e o atendimento amigável.
                    Se você está em Olhão e deseja saborear um excelente peixe assado, o Américo é uma escolha imperdível.</p>
            </div>
            <div class="imgRestaurante2">
                <img src="./imagens/interior.jpg" alt="">
            </div>
        </div>
    </section>

    <div class="divisao-branca"></div>

    <section class="Historia" id="historia">
        <div class="main3">
            <div class="HistoriaDonos">
                <h2>Historia Donos</h2>
                <p>O ambiente do restaurante é acolhedor e familiar, ideal para um almoço descontraído.
                    A decoração reflete a cultura marítima da região, criando uma atmosfera agradável para os visitantes.
                    Os clientes frequentemente elogiam a qualidade dos pratos e o atendimento amigável.
                    Se você está em Olhão e deseja saborear um excelente peixe assado, o Américo é uma escolha imperdível.</p>
            </div>
            <div class="imgRestaurante2">
                <img id="figura" src="./dono1.jpg" alt="">
                <button id="trocarImagem" onclick="trocar()">
                     <i class="bi bi-arrow-right"></i>
                </button>
            </div>
        </div>
    </section>

    <script>
        var imgAtual = "./imagens/dono1.jpg"; // Imagem atual
        var imgAnterior = "./imagens/interior.jpg"; // Imagem anterior

        function trocar() {
            document.getElementById("figura").src = imgAtual; // Troca a imagem
            let aux = imgAtual; // Armazena a imagem atual
            imgAtual = imgAnterior; // Atualiza a imagem atual para a anterior
            imgAnterior = aux; // Armazena a imagem anterior
        }
    </script>

</body>
</html>