<?php
session_start();

require_once('./src/GameOfLife.php');
require_once('./src/GameOfLifeSetup.php');

$game = new GameOfLife($_SESSION['size']);

$click = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['sizeSubmit'] == "Zatwierdz rozmiar") {
        settype($_POST['size'], "integer");
        $_SESSION['size'] = $_POST["size"];
        $click = "size";
        $gameSet = new GameOfLifeSetup($_SESSION['size']);
    }
    if ($_POST['pickSubmit'] == "Wybierz pola startowe") {
        $_SESSION['pick'] = $_POST["pick"];
        $click = "pick";
    }
    if ($_POST['reload'] == "Przeladuj") {
        $game->board = $_SESSION['NewBoard'];
        $click = "reload";
    }
}
?>
<html>
    <head>
        <link type="text/css" rel="stylesheet" href="style/style.css"
    </head>
    <body>
        <form method="POST">
            <fieldset>
                <legend>Game Of Life</legend>
                Wielkosc planszy:
                <select name="size">
                    <?php
                    for ($i = 1; $i < 10; $i++) {
                        echo("<option value=$i");
                        echo $_SESSION['size'] == $i ? ' selected' : '';
                        echo(">$i</option>");
                    }
                    ?>
                </select>
                <input type="submit" name="sizeSubmit" value="Zatwierdz rozmiar"></label>
                <?php
                if ($click === "size") {
                    echo('<hr><input type="submit" name="pickSubmit" value="Wybierz pola startowe"></label><hr>');
                    $gameSet->printBoard();
                } elseif ($click === "pick") {
                    echo('<hr><input type="submit" name="reload" value="Przeladuj"></label><hr>');
                    $game->setSerial($_SESSION['pick']);
                    $game->printBoard();
                    $_SESSION['NewBoard'] = $game->board;

                } elseif ($click === "reload") {
                    echo('<hr><input type="submit" name="reload" value="Przeladuj"></label><hr>');
                    $game->computeNextStep();
                    $game->printBoard();
                    $_SESSION['NewBoard'] = $game->board;
                }
                ?>
            </fieldset>
        </form>
    </body>
</html>

