<?php

class GameOfLifeSetup{

    private $board;
    private $boardSize;

    public function __construct($size)
    {
        if(is_integer($size)){
            $this->boardSize = $size;
        } else{
            $this->boardSize = 10;
        }
        $this->board = [];
        for($i = 0; $i < $this->boardSize; $i++){
            $this->board[$i] = [];
            for($j = 0; $j < $this->boardSize; $j++){
                $this->board[$i][$j] = false;
            }
        }

    }

    public function printBoard(){
        echo ("<table>");
        for($i = 0; $i < $this->boardSize; $i++){
            echo ("<tr>");
            for($j = 0; $j < $this->boardSize; $j++){
                if($this->board[$i][$j] === true){
                    echo("<td class='alive'> </td>");
                } else {
                    echo("<td><center><input type='checkbox' name='pick[$i$j]'></center></td>");
                }
            }
            echo ("</tr>");
        }
        echo ("</table>");
    }
}