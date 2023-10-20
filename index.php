<!DOCTYPE html>
<html>
<head>
    <title>Quiz de Matemática</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="50x50" href="img/matico.png">
    <link rel="icon" type="image" sizes="50x50" href="img/matico.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .btn-12,
        .btn-12 *,
        .btn-12 :after,
        .btn-12 :before,
        .btn-12:after,
        .btn-12:before {
            border: 0 solid;
            box-sizing: border-box;
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
            font-size: 100%;
            font-weight: 900;
            line-height: 1.5;
            margin: 0;
            -webkit-mask-image: -webkit-radial-gradient(#000, #fff);
            padding: 0;
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
            padding: 0.8rem 3rem;
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
</head>
<body>
<div class="container">
    <?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['nome'])) {
            $_SESSION['nome'] = $_POST['nome'];
            $_SESSION['pontuacao'] = 0;
            $_SESSION['questao_atual'] = 1;
        } else {
            $resposta_correta = $_POST['resposta_correta'];
            $resposta_usuario = $_POST['resposta_usuario'];

            if ($resposta_correta == $resposta_usuario) {
                $_SESSION['pontuacao']++;
            }

            $_SESSION['questao_atual']++;

            if ($_SESSION['questao_atual'] > 10) {
                header("Location: resultado.php");
            }
        }
    }
    ?>

    <?php if (!isset($_SESSION['nome'])) : ?>
        <h1>Quiz de Matemática</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="nome">Seu nome:</label>
                <input type="text" class="form-control" name="nome" required>
            </div>
            <button type="submit" class="btn-12"><span>Iniciar</span></button>
        </form>
    <?php else : ?>
        <?php
        $perguntas = array(
            "Qual é o resultado de 2 + 2?",
            "Quanto é 5 x 3?",
            "Resolva: 10 - 4",
            "Quanto é 8 ÷ 2?",
            "Qual é a raiz quadrada de 25?",
            "Calcule: 7 x 6",
            "Quanto é 9 + 7?",
            "Resolva: 15 - 9",
            "Qual é 3 x 9?",
            "Quanto é 24 ÷ 4"
        );

        $respostas = array(
            "b", "e", "f", "a", "b", "g", "c", "a", "d", "c"
        );

        $alternativas = array(
            array("a) 3", "b) 4", "c) 5", "d) 6", "e) 7", "f) 8", "g) 9"),
            array("a) 10", "b) 3", "c) 5", "d) 8", "e) 15", "f) 1", "g) 7"),
            array("a) 5", "b) 4", "c) 8", "d) 3", "e) 10", "f) 6", "g) 2"),
            array("a) 4", "b) 3", "c) 2", "d) 5", "e) 8", "f) 6", "g) 7"),
            array("a) 4", "b) 5", "c) 6", "d) 7", "e) 8", "f) 9", "g) 10"),
            array("a) 36", "b) 24", "c) 49", "d) 54", "e) 63", "f) 48", "g) 42"),
            array("a) 14", "b) 15", "c) 16", "d) 17", "e) 18", "f) 19", "g) 20"),
            array("a) 6", "b) 7", "c) 8", "d) 9", "e) 10", "f) 11", "g) 12"),
            array("a) 18", "b) 21", "c) 24", "d) 27", "e) 30", "f) 33", "g) 36"),
            array("a) 4", "b) 5", "c) 6", "d) 7", "e) 8", "f) 9", "g) 10")
        );

        $questao_atual = $_SESSION['questao_atual'];
        if ($questao_atual <= 10) {
            echo "<h1>Questão $questao_atual</h1>";
            echo "<form method='post' action=''>";
            echo "<p class='pergunta'>" . $perguntas[$questao_atual - 1] . "</p>";

            foreach ($alternativas[$questao_atual - 1] as $alternativa) {
                echo "<div class='alternativa'><label><input type='radio' name='resposta_usuario' value='" . substr($alternativa, 0, 1) . "'> " . $alternativa . "</label></div>";
            }

            echo "<input type='hidden' name='resposta_correta' value='" . $respostas[$questao_atual - 1] . "'>";
            echo "<br>";
            echo "<button type='submit' class='btn-12' onclick='return validaResposta()'><span>Próxima Pergunta</span></button>";
            echo "</form>";
        }
        ?>
        <script>
            function validaResposta() {
                var opcoes = document.querySelectorAll('input[name="resposta_usuario"]');
                var respostaSelecionada = false;
                for (var i = 0; i < opcoes.length; i++) {
                    if (opcoes[i].checked) {
                        respostaSelecionada = true;
                        break;
                    }
                }

                if (!respostaSelecionada) {
                    alert("Por favor, selecione uma resposta antes de continuar.");
                    return false;
                }

                return true;
            }
        </script>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

