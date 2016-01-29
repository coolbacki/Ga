<?php

class GameOfLife{

    public $board;
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
                    echo("<td> </td>");
                }
            }
            echo ("</tr>");
        }
        echo ("</table>");
    }
    public function setCell($row, $col, $value)
    {
        if (is_int($row) === false ||
            is_int($col) === false ||
            is_bool($value) === false||
            $row <= 0 ||
            $col <= 0 ||
            $row >= $this->boardSize ||
            $col >= $this->boardSize){
            return;
        } else {
            $this->board[$row][$col] = $value;
        }
    }

    public function setSerial($serial)
    {
        foreach($serial as $key => $el){
            $row = substr($key, 0, 1);
            $col = substr($key, 1, 1);
            $this->board[$row][$col] = true;
        }
    }

    public function getNextStepForCell($row, $col){
        $liveNeighbours = 0;
        for($i = $row-1; $i <= $row+1; $i++){
            for($j = $col-1; $j <= $col+1; $j++){
                if(!($i === $row && $j === $col)){
                    if($i >= 0 && $j >= 0 && $i < $this->boardSize && $j < $this->boardSize){
                        if( $this->board[$i][$j] === true){
                            $liveNeighbours++;
                        }
                    }
                }
            }
        }

        if($this->board[$row][$col] === true){
            if($liveNeighbours === 2 || $liveNeighbours === 3){
                return true;
            } else {
                return false;
            }
        } else{
            if($liveNeighbours === 3){
                return true;
            } else{
                return false;
            }
        }
    }
    public function computeNextStep(){
        $tempBoard = [];
        for ($i = 0; $i < $this->boardSize; $i++){
            $tempBoard[$i] = [];
            for($j = 0; $j < $this->boardSize; $j++){
                $tempBoard[$i][$j] = $this->getNextStepForCell($i, $j);
            }
        }
        $this->board = $tempBoard;
    }
}