<?php

class Cell
{
    public $hasBomb;
    public $x;
    public $y;
    public $displayed;
    public $numero;
    public $exploded;
    public $marked;
    public $question;
    function __construct($hasBomb, $x, $y, $displayed, $numero, $exploded, $marked, $question)
    {
        $this->hasBomb = $hasBomb;
        $this->x = $x;
        $this->y = $y;
        $this->displayed = $displayed;
        $this->numero = $numero;
        $this->exploded = $exploded;
        $this->marked = $marked;
        $this->question = $question;
    }
    function __toString()
    {
        if ($this->displayed) {

            if ($this->exploded) {
                return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M37.6 4.2C28-2.3 15.2-1.1 7 7s-9.4 21-2.8 30.5l112 163.3L16.6 233.2C6.7 236.4 0 245.6 0 256s6.7 19.6 16.6 22.8l103.1 33.4L66.8 412.8c-4.9 9.3-3.2 20.7 4.3 28.1s18.8 9.2 28.1 4.3l100.6-52.9 33.4 103.1c3.2 9.9 12.4 16.6 22.8 16.6s19.6-6.7 22.8-16.6l33.4-103.1 100.6 52.9c9.3 4.9 20.7 3.2 28.1-4.3s9.2-18.8 4.3-28.1L392.3 312.2l103.1-33.4c9.9-3.2 16.6-12.4 16.6-22.8s-6.7-19.6-16.6-22.8L388.9 198.7l25.7-70.4c3.2-8.8 1-18.6-5.6-25.2s-16.4-8.8-25.2-5.6l-70.4 25.7L278.8 16.6C275.6 6.7 266.4 0 256 0s-19.6 6.7-22.8 16.6l-32.3 99.6L37.6 4.2z"/></svg>';
            }
            if ($this->hasBomb) {
                return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M459.1 52.4L442.6 6.5C440.7 2.6 436.5 0 432.1 0s-8.5 2.6-10.4 6.5L405.2 52.4l-46 16.8c-4.3 1.6-7.3 5.9-7.2 10.4c0 4.5 3 8.7 7.2 10.2l45.7 16.8 16.8 45.8c1.5 4.4 5.8 7.5 10.4 7.5s8.9-3.1 10.4-7.5l16.5-45.8 45.7-16.8c4.2-1.5 7.2-5.7 7.2-10.2c0-4.6-3-8.9-7.2-10.4L459.1 52.4zm-132.4 53c-12.5-12.5-32.8-12.5-45.3 0l-2.9 2.9C256.5 100.3 232.7 96 208 96C93.1 96 0 189.1 0 304S93.1 512 208 512s208-93.1 208-208c0-24.7-4.3-48.5-12.2-70.5l2.9-2.9c12.5-12.5 12.5-32.8 0-45.3l-80-80zM200 192c-57.4 0-104 46.6-104 104v8c0 8.8-7.2 16-16 16s-16-7.2-16-16v-8c0-75.1 60.9-136 136-136h8c8.8 0 16 7.2 16 16s-7.2 16-16 16h-8z"/></svg>';
            }
            if ($this->numero == 0) {
                return "";
            }
            if ((int) $this->numero > 0) {
                return (string) $this->numero;
            }
        } else {
            if ($this->marked) {
                return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M64 32C64 14.3 49.7 0 32 0S0 14.3 0 32V64 368 480c0 17.7 14.3 32 32 32s32-14.3 32-32V352l64.3-16.1c41.1-10.3 84.6-5.5 122.5 13.4c44.2 22.1 95.5 24.8 141.7 7.4l34.7-13c12.5-4.7 20.8-16.6 20.8-30V66.1c0-23-24.2-38-44.8-27.7l-9.6 4.8c-46.3 23.2-100.8 23.2-147.1 0c-35.1-17.6-75.4-22-113.5-12.5L64 48V32z"/></svg>';
            }
            if ($this->question) {
                return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M96 96c-17.7 0-32 14.3-32 32s-14.3 32-32 32s-32-14.3-32-32C0 75 43 32 96 32h97c70.1 0 127 56.9 127 127c0 52.4-32.2 99.4-81 118.4l-63 24.5 0 18.1c0 17.7-14.3 32-32 32s-32-14.3-32-32V301.9c0-26.4 16.2-50.1 40.8-59.6l63-24.5C240 208.3 256 185 256 159c0-34.8-28.2-63-63-63H96zm48 384c-22.1 0-40-17.9-40-40s17.9-40 40-40s40 17.9 40 40s-17.9 40-40 40z"/></svg>';
            }
            return "";
        }
    }
}

session_start();

if (!empty($_POST['resetar'])) {
    $_SESSION = [];
}

if (empty($_SESSION['jogoRodando'])) {
    $_SESSION['jogoRodando'] = false;
    $_SESSION['status'] = "iniciando";

    $_SESSION['numLinhas'] = 0;
    $_SESSION['numColunas'] = 0;
    $_SESSION['numBombas'] = 0;
    $_SESSION['markedBombs'] = 0;
    $_SESSION['tabela'] = [];

    $_COOKIE['microseconds'] = 0;
    $_COOKIE['miliseconds'] = 0;
    $_COOKIE['seconds'] = "00";
    $_COOKIE['minutes'] = "00";
    $_COOKIE['hours'] = "00";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Campo Minado</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php

    if (!empty($_POST['linhas']) && !empty($_POST['colunas']) && !empty($_POST['bombas'])) {
        if ($_POST['linhas'] * $_POST['colunas'] >= $_POST['bombas']) {
            $_SESSION['numLinhas'] = $_POST['linhas'];
            $_SESSION['numColunas'] = $_POST['colunas'];
            $_SESSION['numBombas'] = $_POST['bombas'];
            $_SESSION['markedBombs'] = 0;
            $_SESSION['tabela'] = [];

            $_SESSION['jogoRodando'] = true;
            $_SESSION['status'] = "jogando";

            setcookie("microseconds", 0);
            setcookie("miliseconds", 0);
            setcookie("seconds", "00");
            setcookie("minutes", "00");
            setcookie("hours", "00");
            setcookie("timerOn", false);

            unset($_POST);
            header("Location: " . $_SERVER['PHP_SELF']);
        }
    }

    function gerarPosicoesBombas($numLinhas, $numColunas, $numBombas)
    {
        $posicoes = [0, 0];
        for ($i = 1; $i <= $numBombas; $i++) {
            $x = rand(1, $numColunas);
            $y = rand(1, $numLinhas);
            if (!array_search([$x, $y], $posicoes)) {
                $posicoes[] = [$x, $y];
            } else {
                $i--;
            }
        }
        return $posicoes;
    }
    function criarTabuleiro($numLinhas, $numColunas, $numBombas)
    {
        $tabuleiro = [];

        $posicoes = gerarPosicoesBombas($numLinhas, $numColunas, $numBombas);

        for ($l = 1; $l <= $numLinhas; $l++) {
            for ($c = 1; $c <= $numColunas; $c++) {
                if (array_search([$c, $l], $posicoes)) {
                    $tabuleiro[$c][$l] = new Cell(true, $l, $c, false, "*", false, false, false);
                } else {
                    $tabuleiro[$c][$l] = new Cell(false, $l, $c, false, "0", false, false, false);
                }
            }
        }
        return $tabuleiro;
    }
    function checarCelulas($celula, $linhaC, $colunaC, $tabuleiro)
    {
        if (!empty($tabuleiro[$linhaC - 1][$colunaC - 1])) {
            if ($tabuleiro[$linhaC - 1][$colunaC - 1]->hasBomb) {
                $celula->numero++;
            }
        }
        if (!empty($tabuleiro[$linhaC - 1][$colunaC])) {
            if ($tabuleiro[$linhaC - 1][$colunaC]->hasBomb) {
                $celula->numero++;
            }
        }
        if (!empty($tabuleiro[$linhaC - 1][$colunaC + 1])) {
            if ($tabuleiro[$linhaC - 1][$colunaC + 1]->hasBomb) {
                $celula->numero++;
            }
        }
        if (!empty($tabuleiro[$linhaC][$colunaC - 1])) {
            if ($tabuleiro[$linhaC][$colunaC - 1]->hasBomb) {
                $celula->numero++;
            }
        }
        if (!empty($tabuleiro[$linhaC][$colunaC + 1])) {
            if ($tabuleiro[$linhaC][$colunaC + 1]->hasBomb) {
                $celula->numero++;
            }
        }
        if (!empty($tabuleiro[$linhaC + 1][$colunaC - 1])) {
            if ($tabuleiro[$linhaC + 1][$colunaC - 1]->hasBomb) {
                $celula->numero++;
            }
        }
        if (!empty($tabuleiro[$linhaC + 1][$colunaC])) {
            if ($tabuleiro[$linhaC + 1][$colunaC]->hasBomb) {
                $celula->numero++;
            }
        }
        if (!empty($tabuleiro[$linhaC + 1][$colunaC + 1])) {
            if ($tabuleiro[$linhaC + 1][$colunaC + 1]->hasBomb) {
                $celula->numero++;
            }
        }

        return [$celula, $tabuleiro];
    }
    function adicionarNumeros($tabuleiro)
    {
        for ($l = 1; $l <= count($tabuleiro); $l++) {
            for ($c = 1; $c <= count($tabuleiro[$l]); $c++) {
                [$tabuleiro[$l][$c], $tabuleiro] = checarCelulas($tabuleiro[$l][$c], $l, $c, $tabuleiro);
            }
        }
        return $tabuleiro;
    }
    function mostrarTabuleiro($tabuleiro)
    {
        $gridTemplateColumns = [];
        $gridTemplateRows = [];

        for ($c = 0; $c <= count($tabuleiro); $c++) {
            $gridTemplateColumns[] = "auto";
        }
        for ($l = 0; $l <= count($tabuleiro[1]); $l++) {
            $gridTemplateRows[] = "auto";
        }

        echo "<div class='table' style='grid-template-columns: " . implode(" ", $gridTemplateColumns) . "; grid-template-rows: " . implode(" ", $gridTemplateRows) . ";'>";
        for ($i = 0; $i <= count($tabuleiro); $i++) {
            echo "<button class='hcell'>" . $i . "</button>";
        }
        for ($i = 1; $i <= count($tabuleiro[1]); $i++) {
            echo "<button class='hcell'>" . $i . "</button>";
            for ($y = 1; $y <= count($tabuleiro); $y++) {
                if ($tabuleiro[$y][$i]->displayed) {
                    if ($tabuleiro[$y][$i]->exploded) {
                        echo "<button id='" . $i . ":" . $y . "' type='submit' value='" . $i . ":" . $y . "' name='input' class='cell hidden exploded'>" . $tabuleiro[$y][$i] . "</button>";
                    } else if ($tabuleiro[$y][$i]->hasBomb) {
                        echo "<button id='" . $i . ":" . $y . "' type='submit' value='" . $i . ":" . $y . "' name='input' class='cell hidden hasBomb'>" . $tabuleiro[$y][$i] . "</button>";
                    } else {
                        echo "<button id='" . $i . ":" . $y . "' type='submit' class='cell b" . $tabuleiro[$y][$i]->numero . "'>" . $tabuleiro[$y][$i] . "</button>";
                    }
                } else {
                    if ($tabuleiro[$y][$i]->marked) {
                        echo "<button id='" . $i . ":" . $y . "' type='submit' value='" . $i . ":" . $y . "' name='input' class='cell hidden marked'>" . $tabuleiro[$y][$i] . "</button>";
                    } else if ($tabuleiro[$y][$i]->question) {
                        echo "<form method='post'>";
                        echo "<button id='" . $i . ":" . $y . "' type='submit' value='" . $i . ":" . $y . "' name='input' class='cell hidden question'>" . $tabuleiro[$y][$i] . "</button>";
                        echo "</form>";
                    } else {
                        echo "<form method='post'>";
                        echo "<button id='" . $i . ":" . $y . "' type='submit' value='" . $i . ":" . $y . "' name='input' class='cell hidden'>" . $tabuleiro[$y][$i] . "</button>";
                        echo "</form>";
                    }
                }
            }
        }
        echo "</div>";
    }
    function mostrarTudo($tabuleiro)
    {
        for ($i = 1; $i <= count($tabuleiro[1]); $i++) {
            for ($y = 1; $y <= count($tabuleiro); $y++) {
                $tabuleiro[$y][$i]->displayed = true;
                $tabuleiro[$y][$i]->marked = false;
            }
        }
    }
    function verificarCelula($celula, $x, $y)
    {
        if ($celula->numero == 0) {
            if (!empty($_SESSION['tabela'][$x - 1][$y - 1])) {
                if (!$_SESSION['tabela'][$x - 1][$y - 1]->displayed) {
                    $_SESSION['tabela'][$x - 1][$y - 1]->displayed = true;
                    verificarCelula($_SESSION['tabela'][$x - 1][$y - 1], $x - 1, $y - 1);
                }
            }
            if (!empty($_SESSION['tabela'][$x - 1][$y])) {
                if (!$_SESSION['tabela'][$x - 1][$y]->displayed) {
                    $_SESSION['tabela'][$x - 1][$y]->displayed = true;
                    verificarCelula($_SESSION['tabela'][$x - 1][$y], $x - 1, $y);
                }
            }
            if (!empty($_SESSION['tabela'][$x - 1][$y + 1])) {
                if (!$_SESSION['tabela'][$x - 1][$y + 1]->displayed) {
                    $_SESSION['tabela'][$x - 1][$y + 1]->displayed = true;
                    verificarCelula($_SESSION['tabela'][$x - 1][$y + 1], $x - 1, $y + 1);
                }
            }
            if (!empty($_SESSION['tabela'][$x][$y - 1])) {
                if (!$_SESSION['tabela'][$x][$y - 1]->displayed) {
                    $_SESSION['tabela'][$x][$y - 1]->displayed = true;
                    verificarCelula($_SESSION['tabela'][$x][$y - 1], $x, $y - 1);
                }
            }
            if (!empty($_SESSION['tabela'][$x][$y + 1])) {
                if (!$_SESSION['tabela'][$x][$y + 1]->displayed) {
                    $_SESSION['tabela'][$x][$y + 1]->displayed = true;
                    verificarCelula($_SESSION['tabela'][$x][$y + 1], $x, $y + 1);
                }
            }
            if (!empty($_SESSION['tabela'][$x + 1][$y - 1])) {
                if (!$_SESSION['tabela'][$x + 1][$y - 1]->displayed) {
                    $_SESSION['tabela'][$x + 1][$y - 1]->displayed = true;
                    verificarCelula($_SESSION['tabela'][$x + 1][$y - 1], $x + 1, $y - 1);
                }
            }
            if (!empty($_SESSION['tabela'][$x + 1][$y])) {
                if (!$_SESSION['tabela'][$x + 1][$y]->displayed) {
                    $_SESSION['tabela'][$x + 1][$y]->displayed = true;
                    verificarCelula($_SESSION['tabela'][$x + 1][$y], $x + 1, $y);
                }
            }
            if (!empty($_SESSION['tabela'][$x + 1][$y + 1])) {
                if (!$_SESSION['tabela'][$x + 1][$y + 1]->displayed) {
                    $_SESSION['tabela'][$x + 1][$y + 1]->displayed = true;
                    verificarCelula($_SESSION['tabela'][$x + 1][$y + 1], $x + 1, $y + 1);
                }
            }
        }
    }
    function checarSePerdeu()
    {
        if (!empty($_POST['input'])) {

            [$y, $x] = explode(":", $_POST['input']);

            if (!$_SESSION['tabela'][$x][$y]->marked) {
                verificarCelula($_SESSION['tabela'][$x][$y], $x, $y);
                $_SESSION['tabela'][$x][$y]->displayed = true;

                if ($_SESSION['tabela'][$x][$y]->hasBomb) {
                    $_SESSION['tabela'][$x][$y]->exploded = true;
                    $_SESSION['status'] = "perdeu";
                    setcookie('timerOn', false);
                    mostrarTudo($_SESSION['tabela']);
                }
            }
        }
    }
    function checarSeGanhou()
    {
        if (!empty($_SESSION['tabela'] && $_SESSION['status'] !== "perdeu")) {
            $total = ($_SESSION['numLinhas'] * $_SESSION['numColunas']) - $_SESSION['numBombas'];
            $count = 0;

            for ($i = 1; $i <= count($_SESSION['tabela']); $i++) {
                for ($y = 1; $y <= count($_SESSION['tabela'][1]); $y++) {
                    if ($_SESSION['tabela'][$i][$y]->hasBomb === false && $_SESSION['tabela'][$i][$y]->displayed === true) {
                        $count++;
                    }
                }
            }

            if ($total === $count) {
                $_SESSION['status'] = "ganhou";
                setcookie('timerOn', false);
                mostrarTudo($_SESSION['tabela']);
            }
        }
    }

    ?>
    <div class="headerContainer">
        <form class="form" method="post">
            <input class="input" type="submit" name="resetar" value="Resetar" />
        </form>
        <form class="form" method="post">
            <div class="input-container">
                <input class="input" type="submit" value="<?php if ($_SESSION['jogoRodando']) echo "Recomeçar"; else echo "Começar"; ?>" />
            </div>

            <div class="input-container">
                <label class="label" for="linhas">Linhas</label>
                <input class="input" min="1" type="number" name="linhas" id="linhas" value="<?php echo $_SESSION['numLinhas'] ?>" />
            </div>

            <div class="input-container">
                <label class="label" for="colunas">Colunas</label>
                <input class="input" min="1" type="number" name="colunas" id="colunas" value="<?php echo $_SESSION['numColunas'] ?>" />
            </div>

            <div class="input-container">
                <label class="label" for="bombas">Bombas</label>
                <input class="input" min="1" type="number" name="bombas" id="bombas" value="<?php echo $_SESSION['numBombas'] ?>" />
            </div>
        </form>
        <?php

        checarSePerdeu();

        checarSeGanhou();

        echo "<p class='info bombs'>" . $_SESSION['markedBombs'] . "/" . $_SESSION['numBombas'] . "</p>";
        echo "<p class='info timer'>" . $_COOKIE['hours'] . ":" . $_COOKIE['minutes'] . ":" . $_COOKIE['seconds'] . "</p>";

        if ($_SESSION['status'] === "perdeu") {
            echo "<p class='message'>Você perdeu!</p>";
        }
        if ($_SESSION['status'] === "ganhou") {
            echo "<p class='message'>Você Ganhou!</p>";
        }
        ?>
    </div>
    <div class="tableContainer">
        <?php

        if ($_SESSION['jogoRodando']) {

            if ($_SESSION['tabela'] === []) {
                $_SESSION['tabela'] = criarTabuleiro($_SESSION['numLinhas'], $_SESSION['numColunas'], $_SESSION['numBombas']);
                $_SESSION['tabela'] = adicionarNumeros($_SESSION['tabela']);
            }
            if (!empty($_COOKIE['rclick'])) {
                [$x, $y] = explode(":", $_COOKIE['rclick']);

                setcookie('rclick', "");
                if (!empty($_SESSION['tabela'])) {
                    if (!$_SESSION['tabela'][$y][$x]->marked && !$_SESSION['tabela'][$y][$x]->question && $_SESSION['markedBombs'] < $_SESSION['numBombas']) {
                        $_SESSION['markedBombs']++;
                        $_SESSION['tabela'][$y][$x]->marked = !$_SESSION['tabela'][$y][$x]->marked;
                    } else if ($_SESSION['tabela'][$y][$x]->marked) {
                        $_SESSION['markedBombs']--;
                        $_SESSION['tabela'][$y][$x]->marked = !$_SESSION['tabela'][$y][$x]->marked;
                        $_SESSION['tabela'][$y][$x]->question = !$_SESSION['tabela'][$y][$x]->question;
                    } else {
                        $_SESSION['tabela'][$y][$x]->question = !$_SESSION['tabela'][$y][$x]->question;
                    }
                }
                header("Location: " . $_SERVER['PHP_SELF']);
            }
            mostrarTabuleiro($_SESSION['tabela']);
        }

        ?>
    </div>

</body>
<script>
    const getCookie = (cookieName) => {
        let cookie = {};
        document.cookie.split(';').forEach((el) => {
            let [key, value] = el.split('=');
            cookie[key.trim()] = value;
        });
        return cookie[cookieName];
    }
    if (getCookie('timerOn')) {
        setInterval(() => {
            let hours = getCookie('hours') || "00";
            let minutes = getCookie('minutes') || "00";
            let seconds = getCookie('seconds') || "00";
            let miliseconds = getCookie('miliseconds');
            let microseconds = getCookie('microseconds');

            microseconds += 1;

            if (microseconds >= 1000) {
                microseconds = 0;
                miliseconds++;
            }
            if (miliseconds >= 60) {
                miliseconds = 0;
                seconds++;
            }
            if (seconds >= 60) {
                seconds = 0;
                minutes++;
            }
            if (minutes >= 60) {
                minutes = 0;
                hours++;
            }
            if (String(miliseconds).length === 1) {
                miliseconds = `0${miliseconds}`
            }
            if (String(seconds).length === 1) {
                seconds = `0${seconds}`
            }
            if (String(minutes).length === 1) {
                minutes = `0${minutes}`
            }
            document.cookie = `minutes=${minutes}`;
            document.cookie = `seconds=${seconds}`;
            document.cookie = `miliseconds=${miliseconds}`;
            document.cookie = `microseconds=${microseconds}`;
            document.querySelector('.timer').innerHTML = `${hours}:${minutes}:${seconds}`;
        }, 1);
    }
    document.addEventListener('contextmenu', (e) => {
        e.preventDefault();
    });
    let cells = document.getElementsByClassName("cell");
    if (cells) {
        for (const cell of cells) {
            cell.addEventListener('click', (e) => {
                document.cookie = `click=${e.target.value}`;
                document.cookie = `timerOn=true`;
            });
            cell.addEventListener('contextmenu', (e) => {
                e.preventDefault();
                document.cookie = `click=${e.target.value}`;
                document.cookie = `rclick=${e.target.value}`;
                window.location.reload();
            });
        }
    }
    document.getElementById(getCookie('click'))?.scrollIntoView({
        block: "center",
        inline: "center"
    });
</script>

</html>