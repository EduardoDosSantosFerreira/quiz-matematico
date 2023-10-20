<!DOCTYPE html>
<html>
<head>
    <title>Resultado do Quiz</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image" sizes="50x50" href="img/matico.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<style>
        body {
            text-allign: center
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .container {
            text-allign: center
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .btn-12 {
            -webkit-tap-highlight-color: transparent;
            -webkit-appearance: button;
            background-color: #000;
            background-image: none;
            color: #fff;
            cursor: pointer;
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont,
                Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif,
                Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            font-size: 80%; /* Reduz a fonte para caber no botão */
            font-weight: 900;
            line-height: 1.5;
            margin: 0;
            -webkit-mask-image: -webkit-radial-gradient(#000, #fff);
            padding: 0.8rem 3rem;
            text-transform: uppercase;
        }

        .btn-12:disabled {
            cursor: default;
        }

        .btn-12:-moz-focusring {
            outline: auto;
        }

        .btn-12 svg {
            display: block;
            vertical-align: middle;
        }

        .btn-12 [hidden] {
            display: none;
        }

        .btn-12 {
            border-radius: 99rem;
            border-width: 2px;
            overflow: hidden;
            padding: 0.8rem 4rem; /* Aumenta o tamanho do botão para acomodar o texto */
            position: relative;
        }

        .btn-12 span {
            mix-blend-mode: difference;
        }

        .btn-12:after,
        .btn-12:before {
            background: linear-gradient(
                90deg,
                #fff 25%,
                transparent 0,
                transparent 50%,
                #fff 0,
                #fff 75%,
                transparent 0
            );
            content: "";
            inset: 0;
            position: absolute;
            transform: translateY(var(--progress, 100%));
            transition: transform 0.2s ease;
        }

        .btn-12:after {
            --progress: -100%;
            background: linear-gradient(
                90deg,
                transparent 0,
                transparent 25%,
                #fff 0,
                #fff 50%,
                transparent 0,
                transparent 75%,
                #fff 0
            );
            z-index: -1;
        }

        .btn-12:hover:after,
        .btn-12:hover:before {
            --progress: 0;
        }
    </style>
    <div class="container">
        <h1>Resultado do Quiz</h1>
        <?php
        session_start();

        if (isset($_SESSION['nome'])) {
            echo "<p>Nome: " . $_SESSION['nome'] . "</p>";
            echo "<p>Pontuação: " . $_SESSION['pontuacao'] . " respostas corretas</p>";

            // Adicione um botão "Reiniciar" que redireciona o usuário de volta à página inicial do quiz.
            echo "<a href='index.php' class='btn-12'><span>Reiniciar</span></a>";

            // Reinicie a sessão para permitir fazer o quiz novamente.
            session_destroy();
        } else {
            header("Location: index.php");
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
